<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Feature;
use App\Models\Benefit;
use App\Models\Advantage;
use App\Models\Target;
use App\Models\UserCard;
use App\Models\UserRequest;
use App\Models\User;
use App\Models\WebActions;


class MembershipControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'membership_id' => 'required',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $message = [
            'name_ar.required' => "يرجي ادخال الاسم بالعربي",
            'name_en.required' => "يرجي ادخال الاسم بالانجليزي",
            'membership_id.required' => "يرجي اختيار نوع العضوية",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
            'start_date.required' => "يرجي ادخال تاريخ البداية",
            'end_date.required' => "يرجي ادخال تاريخ النهاية",

        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index(){
        $data['advantages'] = Advantage::dataList(1)['data'];
        $data['benefits'] = Benefit::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['targets'] = Target::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.index')->with('data',(object) $data);
    }

    public function requestMemberShip($id){
        $id = (int) $id;
        $membershipObj = Membership::getOne($id);
        if($membershipObj == null){
            return redirect('404');
        }
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['data'] = Membership::getData($membershipObj);
        $data['code'] = (string) UserCard::getNewCode(); 
        $data['qrCode'] = \QrCode::size(80)->generate($data['code']);
        $data['end_date'] = date('d/m/Y',strtotime(date("Y-m-d", strtotime(now()->format('Y-m-d'))) . " + ".$membershipObj->period." year"));
        $data['end_date2'] = date('m/Y',strtotime(date("Y-m-d", strtotime(now()->format('Y-m-d'))) . " + ".$membershipObj->period." year"));
        return view('Membership.Views.requestMemberShip')->with('data',(object) $data);
    }

    public function postRequestMemberShip($id){
        $id = (int) $id;
        $input = \Request::all();
        $membershipObj = Membership::getOne($id);
        if($membershipObj == null){
            return redirect('404');
        }

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        $membershipObj = Membership::getOne($input['membership_id']);
        if(!$membershipObj){
            \Session::flash('error', 'هذه العضوية غير موجودة');
            return redirect()->back()->withInput();
        }

        $start_date = date('Y-m-d',strtotime(str_replace('/', '-', $input['start_date'])));
        $end_date = date('Y-m-d',strtotime(str_replace('/', '-', $input['end_date'])));

        $rand = rand(100,100000);
        $username = str_replace(' ', '', $input['name_en']) . '-' . $rand;
        $checkUser = User::checkUserByUserName($username);
        while ($checkUser != null) {
            $rand = rand(1000,1000000);
            $username = str_replace(' ', '', $input['name_en']) . '-' . $rand;
        }
    
        $userObj = new User;
        $userObj->name_ar = $input['name_ar'];
        $userObj->name_en = $input['name_ar'];
        $userObj->username = $username;
        $userObj->group_id = 3;
        $userObj->phone = $input['phone'];
        $userObj->show_details = 0;
        $userObj->lang = 0;
        $userObj->status = 1;
        $userObj->is_active = 1;
        $userObj->sort = User::newSortIndex();
        $userObj->created_at = DATE_TIME;
        $userObj->created_by = 0;
        $userObj->save();

        $menuObj = new UserCard;
        $menuObj->user_id = $userObj->id;
        $menuObj->code = UserCard::getNewCode();
        $menuObj->membership_id = $input['membership_id'];
        $menuObj->start_date = $start_date;
        $menuObj->end_date = $end_date;
        $menuObj->status = 2;
        $menuObj->sort = UserCard::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = $userObj->id;
        $menuObj->save();

        if(isset($input['user_request']) && $input['user_request'] == 'on'){
            $userRequestObj = new UserRequest;
            $userRequestObj->user_id = $userObj->id;
            $userRequestObj->membership_id = $input['membership_id'];
            $userRequestObj->user_card_id = $menuObj->id;
            $userRequestObj->status = 2;
            $userRequestObj->sort = UserRequest::newSortIndex();
            $userRequestObj->created_at = DATE_TIME;
            $userRequestObj->created_by = $userObj->id;
            $userRequestObj->save();
        }


        WebActions::newType(2,'UserCard',1);
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        return redirect()->back();
        
    }

    public function features(){
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.features')->with('data',(object) $data);
    }

}
