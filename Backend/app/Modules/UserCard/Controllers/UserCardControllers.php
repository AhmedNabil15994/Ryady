<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\UserCard;
use App\Models\User;
use App\Models\Membership;
use App\Models\WebActions;
use Illuminate\Http\Request;
use DataTables;


class UserCardControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'user_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'membership_id' => 'required',
        ];

        $message = [
            'user_id.required' => 'يرجي اختيار المستخدم',
            'name_ar.required' => "يرجي ادخال الاسم عربي",
            'name_en.required' => "يرجي ادخال الاسم انجليزي",
            'membership_id.required' => "يرجي اختيار نوع العضوية",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = UserCard::dataList();
            return Datatables::of($data['data'])->make(true);
        }
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('UserCard.Views.index')->with('data', (object) $data);
    }

    public function add() {
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['users'] = User::dataList(1)['data'];
        $data['newCode'] = UserCard::getNewCode();
        return view('UserCard.Views.add')->with('data', (object) $data);
    }

    public function edit($id) {
        $id = (int) $id;

        $menuObj = UserCard::find($id);

        if($menuObj == null) {
            return Redirect('404');
        }

        $data['users'] = User::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['data'] = UserCard::getData($menuObj);
        return view('UserCard.Views.edit')->with('data', (object) $data);      
    }

    public function update($id) {
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = UserCard::find($id);
        $oldMembership = $menuObj->membership_id;
        if($menuObj == null) {
            return Redirect('404');
        }

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back();
        }

        if($oldMembership != $input['membership_id']){
            $memberShipObj = Membership::getOne($input['membership_id']);
            $period = $memberShipObj->period;
            $start_date = now()->format('Y-m-d');
            $end_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($start_date)) . " + ".$period." year"));
            
            $menuObj->start_date = $start_date;
            $menuObj->end_date = $end_date;
        }

        $menuObj->user_id = $input['user_id'];
        $menuObj->name_ar = $input['name_ar'];
        $menuObj->name_en = $input['name_en'];
        $menuObj->code = $input['code'];
        $menuObj->membership_id = $input['membership_id'];
        $menuObj->status = $input['status'];
        $menuObj->updated_at = DATE_TIME;
        $menuObj->updated_by = USER_ID;
        $menuObj->save();

        WebActions::newType(2,'UserCard');
        \Session::flash('success', "تنبيه! تم التعديل بنجاح");
        return \Redirect::back()->withInput();
    }
    
    public function create() {
        $input = \Request::all();
        
        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        $memberShipObj = Membership::getOne($input['membership_id']);
        $period = $memberShipObj->period;
        $start_date = now()->format('Y-m-d');
        $end_date = date('Y-m-d',strtotime(date("Y-m-d", strtotime($start_date)) . " + ".$period." year"));
        
        $menuObj = new UserCard;
        $menuObj->user_id = $input['user_id'];
        $menuObj->name_ar = $input['name_ar'];
        $menuObj->name_en = $input['name_en'];
        $menuObj->code = UserCard::getNewCode();
        $menuObj->membership_id = $input['membership_id'];
        $menuObj->start_date = $start_date;
        $menuObj->end_date = $end_date;
        $menuObj->status = $input['status'];
        $menuObj->sort = UserCard::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        WebActions::newType(1,'UserCard');
        \Session::flash('success', "تنبيه! تم الحفظ بنجاح");
        return redirect()->to('userCards/');
    }

    public function delete($id) {
        $id = (int) $id;
        $menuObj = UserCard::getOne($id);
        WebActions::newType(3,'UserCard');
        return \Helper::globalDelete($menuObj);
    }

    public function fastEdit() {
        $input = \Request::all();
        foreach ($input['data'] as $item) {
            $col = $item[1];
            $menuObj = UserCard::find($item[0]);
            $menuObj->$col = $item[2];
            $menuObj->updated_at = DATE_TIME;
            $menuObj->updated_by = USER_ID;
            $menuObj->save();
        }

        WebActions::newType(4,'UserCard');
        return \TraitsFunc::SuccessResponse('تم التعديل بنجاح');
    }

    public function arrange() {
        $data = UserCard::dataList();
        return view('UserCard.Views.arrange')->with('data', (Object) $data);;
    }

    public function sort(){
        $input = \Request::all();

        $ids = json_decode($input['ids']);
        $sorts = json_decode($input['sorts']);

        for ($i = 0; $i < count($ids) ; $i++) {
            UserCard::where('id',$ids[$i])->update(['sort'=>$sorts[$i]]);
        }
        return \TraitsFunc::SuccessResponse('تم الترتيب بنجاح');
    }

    public function charts() {
        $input = \Request::all();
        $now = date('Y-m-d');
        $start = $now;
        $end = $now;
        $date = null;
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $start = $input['from'].' 00:00:00';
            $end = $input['to'].' 23:59:59';
            $date = 1;
        }

        $addCount = WebActions::getByDate($date,$start,$end,1,'UserCard')['count'];
        $editCount = WebActions::getByDate($date,$start,$end,2,'UserCard')['count'];
        $deleteCount = WebActions::getByDate($date,$start,$end,3,'UserCard')['count'];
        $fastEditCount = WebActions::getByDate($date,$start,$end,4,'UserCard')['count'];

        $data['chartData1'] = $this->getChartData($start,$end,1,'UserCard');
        $data['chartData2'] = $this->getChartData($start,$end,2,'UserCard');
        $data['chartData3'] = $this->getChartData($start,$end,4,'UserCard');
        $data['chartData4'] = $this->getChartData($start,$end,3,'UserCard');
        $data['counts'] = [$addCount , $editCount , $deleteCount , $fastEditCount];
        $data['title'] = 'بطاقات الاعضاء';
        $data['miniTitle'] = 'بطاقات الاعضاء';
        $data['url'] = 'userCards';

        return view('TopMenu.Views.charts')->with('data',(object) $data);
    }

    public function getChartData($start=null,$end=null,$type,$moduleName){
        $input = \Request::all();
        
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $start = $input['from'];
            $end = $input['to'];
        }

        $datediff = strtotime($end) - strtotime($start);
        $daysCount = round($datediff / (60 * 60 * 24));
        $datesArray = [];
        $datesArray[0] = $start;

        if($daysCount > 2){
            for($i=0;$i<$daysCount;$i++){
                $datesArray[$i] = date('Y-m-d',strtotime($start.'+'.$i."day") );
            }
            $datesArray[$daysCount] = $end;  
        }else{
            for($i=1;$i<24;$i++){
                $datesArray[$i] = date('Y-m-d H:i:s',strtotime($start.'+'.$i." hour") );
            }
        }

        $chartData = [];
        $dataCount = count($datesArray);

        for($i=0;$i<$dataCount;$i++){
            if($dataCount == 1){
                $count = WebActions::where('type',$type)->where('module_name',$moduleName)->where('created_at','>=',$datesArray[0].' 00:00:00')->where('created_at','<=',$datesArray[0].' 23:59:59')->count();
            }else{
                if($i < count($datesArray)){
                    $count = WebActions::where('type',$type)->where('module_name',$moduleName)->where('created_at','>=',$datesArray[$i].' 00:00:00')->where('created_at','<=',$datesArray[$i].' 23:59:59')->count();
                }
            }
            $chartData[0][$i] = $datesArray[$i];
            $chartData[1][$i] = $count;
        }
        return $chartData;
    }


}
