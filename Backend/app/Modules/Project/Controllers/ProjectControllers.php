<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\City;
use App\Models\Photo;
use App\Models\WebActions;
use Illuminate\Http\Request;
use DataTables;


class ProjectControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال العنوان",
            'address.required' => "يرجي ادخال العنوان",
            'phone.required' => "يرجي ادخال العنوان",
            'city_id.required' => "يرجي ادخال العنوان",
            'category_id.required' => "يرجي ادخال العنوان",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index(Request $request){  
        if($request->ajax()){
            $data = Project::dataList();
            return Datatables::of($data['data'])->make(true);
        }
        $data['cities'] = City::dataList(1)['data'];
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        return view('Project.Views.index')->with('data', (object) $data);
    }

    public function add() {
        \Session::put('logo',[]);
        \Session::put('photos', []);
        $data['cities'] = City::dataList(1)['data'];
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        return view('Project.Views.add')->with('data', (object) $data);
    }

    public function edit($id) {
        $id = (int) $id;

        $menuObj = Project::find($id);
        if($menuObj == null) {
            return Redirect('404');
        }
        \Session::put('logo',[]);
        \Session::put('photos', []);
        $data['cities'] = City::dataList(1)['data'];
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['data'] = Project::getData($menuObj);
        return view('Project.Views.edit')->with('data', (object) $data);      
    }

    public function update($id) {
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Project::find($id);

        if($menuObj == null) {
            return Redirect('404');
        }

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back();
        }

        $menuObj->title = $input['title'];
        $menuObj->address = $input['address'];
        $menuObj->phone = $input['phone'];
        $menuObj->city_id = $input['city_id'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->brief = $input['brief'];
        $menuObj->lat = isset($input['lat']) ? $input['lat'] : '';
        $menuObj->lng = isset($input['lng']) ? $input['lng'] : '';
        $menuObj->status = $input['status'];
        $menuObj->updated_at = DATE_TIME;
        $menuObj->updated_by = USER_ID;
        $menuObj->save();

        $logo = \Session::get('logo');
        if($logo){
            $imagesData = Photo::where('imageable_type','App\Models\Project')->whereIn('id',$logo);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/projects/'.$menuObj->id.'/'.$image->filename;
                    $image->save();

                    $menuObj->logo = $image->filename;
                    $menuObj->save();
                }
            }
        }

        $photos = \Session::get('photos');
        if($photos){
            $imagesData = Photo::where('imageable_type','App\Models\Project')->whereIn('id',$photos);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            $otherImages = [];
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/projects/'.$menuObj->id.'/'.$image->filename;
                    $image->save();
                    $otherImages[] = $image->filename;
                }
            }
            $menuObj->images = serialize($otherImages);
            $menuObj->save();
        }

        \Session::forget('logo');
        \Session::forget('photos');
        WebActions::newType(2,'Project');
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
        
        $menuObj = new Project;
        $menuObj->title = $input['title'];
        $menuObj->address = $input['address'];
        $menuObj->phone = $input['phone'];
        $menuObj->city_id = $input['city_id'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->brief = $input['brief'];
        $menuObj->lat = isset($input['lat']) ? $input['lat'] : '';
        $menuObj->lng = isset($input['lng']) ? $input['lng'] : '';
        $menuObj->status = $input['status'];
        $menuObj->sort = Project::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        $logo = \Session::get('logo');
        if($logo){
            $imagesData = Photo::where('imageable_type','App\Models\Project')->whereIn('id',$logo);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/projects/'.$menuObj->id.'/'.$image->filename;
                    $image->save();

                    $menuObj->logo = $image->filename;
                    $menuObj->save();
                }
            }
        }

        $photos = \Session::get('photos');
        if($photos){
            $imagesData = Photo::where('imageable_type','App\Models\Project')->whereIn('id',$photos);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            $otherImages = [];
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/projects/'.$menuObj->id.'/'.$image->filename;
                    $image->save();
                    $otherImages[] = $image->filename;
                }
            }
            $menuObj->images = serialize($otherImages);
            $menuObj->save();
        }

        \Session::forget('logo');
        \Session::forget('photos');
        WebActions::newType(1,'Project');
        \Session::flash('success', "تنبيه! تم الحفظ بنجاح");
        return redirect()->to('projects/');
    }

    public function delete($id) {
        $id = (int) $id;
        $menuObj = Project::getOne($id);
        WebActions::newType(3,'Project');
        return \Helper::globalDelete($menuObj);
    }

    public function fastEdit() {
        $input = \Request::all();
        foreach ($input['data'] as $item) {
            $col = $item[1];
            $menuObj = Project::find($item[0]);
            $menuObj->$col = $item[2];
            $menuObj->updated_at = DATE_TIME;
            $menuObj->updated_by = USER_ID;
            $menuObj->save();
        }

        WebActions::newType(4,'Project');
        return \TraitsFunc::SuccessResponse('تم التعديل بنجاح');
    }

    public function arrange() {
        $data = Project::dataList();
        return view('Project.Views.arrange')->with('data', (Object) $data);;
    }

    public function sort(){
        $input = \Request::all();

        $ids = json_decode($input['ids']);
        $sorts = json_decode($input['sorts']);

        for ($i = 0; $i < count($ids) ; $i++) {
            Project::where('id',$ids[$i])->update(['sort'=>$sorts[$i]]);
        }
        return \TraitsFunc::SuccessResponse('تم الترتيب بنجاح');
    }

    public function uploadImage(Request $request,$id=false){
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $images = self::addImage($files,$id);
            if ($images == false) {
                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
            }
            $myArr = \Session::get('logo');
            $myArr[] = $images;
            \Session::put('logo',$myArr);
            return \TraitsFunc::SuccessResponse('');
        }

        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            $images = self::addImage($files,$id);
            if ($images == false) {
                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
            }
            $myArr = \Session::get('photos');
            $myArr[] = $images;
            \Session::put('photos',$myArr);
            return \TraitsFunc::SuccessResponse('');
        }
    }

    public function addImage($images,$nextID=false) {
        $lastID = Project::orderBy('id','DESC')->first();
        if($lastID){
            if(! $nextID){
                $nextID = $lastID->id + 1;
            }
        }else{
            $nextID = 1;
        }           
        $fileName = \ImagesHelper::UploadImage('projects', $images, $nextID);
        if($fileName == false){
            return false;
        }
        
        $photoObj = new Photo;
        $photoObj->filename = $fileName;
        $photoObj->imageable_type = 'App\Models\Project';
        $photoObj->imageable_id = $nextID;
        $photoObj->link = $fileName;
        $photoObj->status = 1;
        $photoObj->sort = Photo::newSortIndex();
        $photoObj->created_at = DATE_TIME;
        $photoObj->created_by = USER_ID;
        $photoObj->save();
        
        return $photoObj->id;        
    }

    public function deleteImage($id){
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Project::find($id);

        if($menuObj == null) {
            return \TraitsFunc::ErrorMessage("هذه الصفحة غير موجودة");
        }

        Photo::where('imageable_id',$id)->where('imageable_type','App\Models\Project')->where('filename',$menuObj->logo)->update(['updated_at'=> DATE_TIME,'updated_by' => USER_ID]);
        $menuObj->logo = '';
        $menuObj->save();

        return \TraitsFunc::SuccessResponse('تم حذف الصورة بنجاح');
    }

    public function deleteImages($id){
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Project::find($id);

        if($menuObj == null) {
            return \TraitsFunc::ErrorMessage("هذه الصفحة غير موجودة");
        }

        $myImages = unserialize($menuObj->images);
        Photo::where('imageable_id',$id)->where('imageable_type','App\Models\Project')->where('filename',$input['name'])->update(['updated_at'=> DATE_TIME,'updated_by' => USER_ID]);
        $newImage = array_diff( $myImages, [$input['name']] );
        $menuObj->images = serialize($newImage);
        $menuObj->save();

        return \TraitsFunc::SuccessResponse('تم حذف الصورة بنجاح');
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

        $addCount = WebActions::getByDate($date,$start,$end,1,'Project')['count'];
        $editCount = WebActions::getByDate($date,$start,$end,2,'Project')['count'];
        $deleteCount = WebActions::getByDate($date,$start,$end,3,'Project')['count'];
        $fastEditCount = WebActions::getByDate($date,$start,$end,4,'Project')['count'];

        $data['chartData1'] = $this->getChartData($start,$end,1,'Project');
        $data['chartData2'] = $this->getChartData($start,$end,2,'Project');
        $data['chartData3'] = $this->getChartData($start,$end,4,'Project');
        $data['chartData4'] = $this->getChartData($start,$end,3,'Project');
        $data['counts'] = [$addCount , $editCount , $deleteCount , $fastEditCount];
        $data['title'] = 'مشاريع الاعضاء';
        $data['miniTitle'] = 'مشاريع الاعضاء';
        $data['url'] = 'projects';

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
