<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Coupon;
use App\Models\WebActions;
use Illuminate\Http\Request;
use DataTables;


class CouponControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'code' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'valid_type' => 'required',
            'valid_value' => 'required',
        ];

        $message = [
            'code.required' => "يرجي ادخال كود كوبون الخصم",
            'discount_type.required' => "يرجي اختيار نوع الخصم",
            'discount_value.required' => "يرجي ادخال قيمة الخصم",
            'valid_type.required' => "يرجي اختيار نوع المدة المتاحة للخصم",
            'valid_value.required' => "يرجي ادخال متاح ل الخصم",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = Coupon::dataList();
            return Datatables::of($data['data'])->make(true);
        }
        return view('Coupon.Views.index');
    }

    public function add() {
        return view('Coupon.Views.add');
    }

    public function edit($id) {
        $id = (int) $id;

        $menuObj = Coupon::NotDeleted()->find($id);

        if($menuObj == null) {
            return Redirect('404');
        }

        $data['data'] = Coupon::getData($menuObj);
        return view('Coupon.Views.edit')->with('data', (object) $data);      
    }

    public function update($id) {
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Coupon::NotDeleted()->find($id);

        if($menuObj == null) {
            return Redirect('404');
        }

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back();
        }

        $checkObj = Coupon::checkCouponByCode($input['code'],$id);
        if($checkObj != null){
            \Session::flash('error', 'هذا الكود مستخدم من قبل');
            return redirect()->back()->withInput();
        }

        $menuObj->code = $input['code'];
        $menuObj->discount_type = $input['discount_type'];
        $menuObj->discount_value = doubleval($input['discount_value']);
        $menuObj->valid_type = $input['valid_type'];
        $menuObj->valid_value = $input['valid_value'];
        $menuObj->status = $input['status'];
        $menuObj->updated_at = DATE_TIME;
        $menuObj->updated_by = USER_ID;
        $menuObj->save();

        WebActions::newType(2,'Coupon');
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
        
        $checkObj = Coupon::checkCouponByCode($input['code']);
        if($checkObj != null){
            \Session::flash('error', 'هذا الكود مستخدم من قبل');
            return redirect()->back()->withInput();
        }

        $menuObj = new Coupon;
        $menuObj->code = $input['code'];
        $menuObj->discount_type = $input['discount_type'];
        $menuObj->discount_value = doubleval($input['discount_value']);
        $menuObj->valid_type = $input['valid_type'];
        $menuObj->valid_value = $input['valid_value'];
        $menuObj->status = $input['status'];
        $menuObj->sort = Coupon::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        WebActions::newType(1,'Coupon');
        \Session::flash('success', "تنبيه! تم الحفظ بنجاح");
        return redirect()->to('coupons/');
    }

    public function delete($id) {
        $id = (int) $id;
        $menuObj = Coupon::getOne($id);
        WebActions::newType(3,'Coupon');
        return \Helper::globalDelete($menuObj);
    }

    public function fastEdit() {
        $input = \Request::all();
        foreach ($input['data'] as $item) {
            $col = $item[1];
            $menuObj = Coupon::NotDeleted()->find($item[0]);
            $menuObj->$col = $item[2];
            $menuObj->updated_at = DATE_TIME;
            $menuObj->updated_by = USER_ID;
            $menuObj->save();
        }

        WebActions::newType(4,'Coupon');
        return \TraitsFunc::SuccessResponse('تم التعديل بنجاح');
    }

    public function arrange() {
        $data = Coupon::dataList();
        return view('Coupon.Views.arrange')->with('data', (Object) $data);;
    }

    public function sort(){
        $input = \Request::all();

        $ids = json_decode($input['ids']);
        $sorts = json_decode($input['sorts']);

        for ($i = 0; $i < count($ids) ; $i++) {
            Coupon::where('id',$ids[$i])->update(['sort'=>$sorts[$i]]);
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

        $addCount = WebActions::getByDate($date,$start,$end,1,'Coupon')['count'];
        $editCount = WebActions::getByDate($date,$start,$end,2,'Coupon')['count'];
        $deleteCount = WebActions::getByDate($date,$start,$end,3,'Coupon')['count'];
        $fastEditCount = WebActions::getByDate($date,$start,$end,4,'Coupon')['count'];

        $data['chartData1'] = $this->getChartData($start,$end,1,'Coupon');
        $data['chartData2'] = $this->getChartData($start,$end,2,'Coupon');
        $data['chartData3'] = $this->getChartData($start,$end,4,'Coupon');
        $data['chartData4'] = $this->getChartData($start,$end,3,'Coupon');
        $data['counts'] = [$addCount , $editCount , $deleteCount , $fastEditCount];
        $data['title'] = 'كوبونات الخصم';
        $data['miniTitle'] = 'كوبونات الخصم';
        $data['url'] = 'coupons';

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
