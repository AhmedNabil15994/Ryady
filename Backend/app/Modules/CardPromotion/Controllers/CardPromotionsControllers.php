<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\CardPromotion;
use App\Models\Membership;
use App\Models\WebActions;
use Illuminate\Http\Request;
use DataTables;


class CardPromotionsControllers extends Controller {

    use \TraitsFunc;

    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = CardPromotion::dataList();
            return Datatables::of($data['data'])->make(true);
        }
        $data['title'] = 'ترقيات البطاقات';
        $data['name'] = 'card-promotion';
        $data['url'] = 'cardPromotions';
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('CardPromotion.Views.index')->with('data',(object) $data);
    }


    public function softDelete(Request $request) {
        $menuObj = CardPromotion::whereIn('id',$request->data)->update(['deleted_at'=>DATE_TIME,'deleted_by'=>USER_ID]);
        WebActions::newType(3,'CardPromotion');
        $data['status'] = \TraitsFunc::SuccessResponse("تم الحذف بنجاح");
        return response()->json($data);
    }

    public function delete($id) {
        $id = (int) $id;
        $menuObj = CardPromotion::getOne($id);
        WebActions::newType(3,'CardPromotion');
        return \Helper::globalDelete($menuObj);
    }

    public function fastEdit() {
        $input = \Request::all();
        foreach ($input['data'] as $item) {
            $col = $item[1];
            $menuObj = CardPromotion::NotDeleted()->find($item[0]);
            $menuObj->$col = $item[2];
            $menuObj->updated_at = DATE_TIME;
            $menuObj->updated_by = USER_ID;
            $menuObj->save();
        }

        WebActions::newType(4,'CardPromotion');
        return \TraitsFunc::SuccessResponse('تم التعديل بنجاح');
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

        $addCount = WebActions::getByDate($date,$start,$end,1,'CardPromotion')['count'];
        $editCount = WebActions::getByDate($date,$start,$end,2,'CardPromotion')['count'];
        $deleteCount = WebActions::getByDate($date,$start,$end,3,'CardPromotion')['count'];
        $fastEditCount = WebActions::getByDate($date,$start,$end,4,'CardPromotion')['count'];

        $data['chartData1'] = $this->getChartData($start,$end,1,'CardPromotion');
        $data['chartData2'] = $this->getChartData($start,$end,2,'CardPromotion');
        $data['chartData3'] = $this->getChartData($start,$end,4,'CardPromotion');
        $data['chartData4'] = $this->getChartData($start,$end,3,'CardPromotion');
        $data['counts'] = [$addCount , $editCount , $deleteCount , $fastEditCount];
        $data['title'] = 'ترقيات البطاقات';
        $data['miniTitle'] = 'ترقيات البطاقات';
        $data['url'] = 'cardPromotions';

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
