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
            'password' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
        ];

        $message = [
            'name_ar.required' => "يرجي ادخال الاسم بالعربي",
            'name_en.required' => "يرجي ادخال الاسم بالانجليزي",
            'membership_id.required' => "يرجي اختيار نوع العضوية",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
            'password.required' => "يرجي ادخال كلمة المرور",
            // 'start_date.required' => "يرجي ادخال تاريخ البداية",
            // 'end_date.required' => "يرجي ادخال تاريخ النهاية",

        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    protected function validatePayment($input){
        $rules = [
            'card_no' => 'required',
            'card_holder' => 'required',
            'payment_type' => 'required',
            'year' => 'required',
            'expire_date' => 'required',
            'cvc' => 'required',
        ];

        $message = [
            'card_no.required' => "يرجي ادخال رقم البطاقة",
            'card_holder.required' => "يرجي ادخال اسم حامل البطاقة",
            'payment_type.required' => "يرجي اختيار نوع الدفع",
            'year.required' => "يرجي ادخال سنة الانتهاء",
            'expire_date.required' => "يرجي ادخال تاريخ انتهاء البطاقة",
            'cvc.required' => "يرجي ادخال الرقم السري",
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
        $data['code'] = '000000';//(string) UserCard::getNewCode(); 
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

        $start_date = now()->format('Y-m-d');
        $end_date = date("Y-m-d", strtotime(now()->format('Y-m-d'). " + ".$membershipObj->period." year"));

        $rand = rand(100,100000);
        $username = str_replace(' ', '', $input['name_en']) . '-' . $rand;
        $checkUser = User::checkUserByUserName($username);
        while ($checkUser != null) {
            $rand = rand(1000,1000000);
            $username = str_replace(' ', '', $input['name_en']) . '-' . $rand;
        }
    
        $userObj = new User;
        $userObj->name_ar = $input['name_ar'];
        $userObj->name_en = $input['name_en'];
        $userObj->username = $username;
        $userObj->email = $username.'@alshabalriyadi.com';
        $userObj->password = \Hash::make($input['password']);
        $userObj->group_id = 3;
        $userObj->phone = $input['phone'];
        $userObj->show_details = 0;
        $userObj->lang = 0;
        $userObj->status = 0;
        $userObj->is_active = 0;
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
        // $menuObj->status = 1;
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
            // $userRequestObj->status = 1;
            $userRequestObj->sort = UserRequest::newSortIndex();
            $userRequestObj->created_at = DATE_TIME;
            $userRequestObj->created_by = $userObj->id;
            $userRequestObj->save();
            WebActions::newType(1,'UserRequest',$userObj->id);
            \Session::put('user_request_id',$userRequestObj->id);
        }

        \Session::put('user_id',$userObj->id);
        \Session::put('user_card_id',$menuObj->id);
        WebActions::newType(1,'UserCard',$userObj->id);
        WebActions::newType(1,'User',$userObj->id);
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        // return redirect()->back();
        return redirect('/memberships/payment');
    }

    public function payment(){
        $data['url'] = \URL::to('/memberships/payment');
        return view('Membership.Views.payment')->with('data',(object) $data);
    }

    public function postPayment(){
        $input = \Request::all();

        $validate = $this->validatePayment($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        if($input['payment_type'] == 1){
            $company = 'master';
        }elseif($input['payment_type'] == 2){
            $company = 'visa';
        }elseif($input['payment_type'] == 3){
            $company = 'mada';
        }

        $userObj = User::getOne(\Session::get('user_id'));
        $userCardObj = UserCard::getOne(\Session::get('user_card_id'));
        $price = $userCardObj->Membership->price;
        if(\Session::has('user_request_id')){
            $userRequestObj = UserRequest::getOne(\Session::get('user_request_id'));
            $price += 100;
        }

        $name = explode(' ', $userObj->name_en, 2);

        $data = [
            'type' => 'credit',
            'amount' =>  $price,
            'currency' => 'SAR',
            'callback_url' => \URL::to('/profile'),
            'customer' => [
                'name' => $userObj->name,
                'first_name' => isset($name[0]) ? $name[0]  : '',
                'last_name' => isset($name[1]) ? $name[1]  : '',
                "email" => $userObj->email,
                "phone" => $userObj->phone,
                "ip" => \Request::ip(),
            ],
            "source" => [
                "company" => $company,
                "card_number" => $input['card_no'],
                "cvc" =>  $input['cvc'],
                "month" =>  $input['expire_date'],
                "year" =>  $input['year'],
            ]
        ];

        $paymentObj = new \PaymentHelper();
        $checkStatus = $paymentObj->payTabs($data);
        if(!isset($checkStatus['errors']) && empty($checkStatus['errors'])){
            $userObj->status = 1;
            $userObj->is_active = 1;
            $userObj->save();
            \Session::forget('user_id');

            $userCardObj->status = 1;
            $userCardObj->save();
            \Session::forget('user_card_id');

            if(\Session::has('user_request_id')){
                $userRequestObj->status = 1;
                $userRequestObj->save();
                \Session::forget('user_request_id');
            }

            $isAdmin = in_array($userObj->group_id, [1,]) ? true : false;
            session(['group_id' => $userObj->group_id]);
            session(['user_id' => $userObj->id]);
            session(['email' => $userObj->email]);
            session(['username' => $userObj->username]);
            session(['is_admin' => $isAdmin]);
            session(['group_name' => $userObj->Group->title]);

            \Session::flash('success', 'تم الدفع وتفعيل البطاقة بنجاح');
            return redirect()->to('/profile');
        }else{
            $erros = [];
            foreach ($checkStatus['errors'] as $key => $error) {
                \Session::flash('error', $key . ' '. $error[0]);   
            }
            return redirect()->back();
        }   
    }

    public function features(){
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.features')->with('data',(object) $data);
    }

}
