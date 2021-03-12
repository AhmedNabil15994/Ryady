<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Photo;
use App\Models\WebActions;
use Illuminate\Http\Request;
use DataTables;


class BlogControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال العنوان",
            'category_id.required' => "يرجي اختيار العنوان",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index(Request $request)
    {   
        if($request->ajax()){
            $data = Blog::dataList();
            return Datatables::of($data['data'])->make(true);
        }
        $data['categories'] = BlogCategory::dataList(1)['data'];
        return view('Blog.Views.index')->with('data', (object) $data);
    }

    public function add() {
        $data['categories'] = BlogCategory::dataList(1)['data'];
        return view('Blog.Views.add')->with('data', (object) $data);
    }

    public function edit($id) {
        $id = (int) $id;

        $menuObj = Blog::find($id);
        if($menuObj == null) {
            return Redirect('404');
        }

        $data['categories'] = BlogCategory::dataList(1)['data'];
        $data['data'] = Blog::getData($menuObj);
        return view('Blog.Views.edit')->with('data', (object) $data);      
    }

    public function update($id) {
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Blog::find($id);

        if($menuObj == null) {
            return Redirect('404');
        }

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back();
        }

        $menuObj->title = $input['title'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->description = $input['description'];
        $menuObj->show_images = $input['show_images'];
        $menuObj->status = $input['status'];
        $menuObj->updated_at = DATE_TIME;
        $menuObj->updated_by = USER_ID;
        $menuObj->save();


        $photos = \Session::get('photos');

        if($photos){
            $imagesData = Photo::where('imageable_type','App\Models\Blog')->whereIn('id',$photos);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/blogs/'.$menuObj->id.'/'.$image->filename;
                    $image->save();

                    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
                    $explodeImage = explode('.', $image->link);
                    $extension = end($explodeImage);

                    if(in_array($extension, $imageExtensions)){
                        $menuObj->fileType = 'photo';
                    }else{
                        $menuObj->fileType = 'video';
                    }
                    $menuObj->file = $image->filename;
                    $menuObj->save();
                }
            }
        }

        \Session::forget('photos');
        WebActions::newType(2,'Blog');
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
        
        $menuObj = new Blog;
        $menuObj->title = $input['title'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->views = 0;
        $menuObj->description = $input['description'];
        $menuObj->show_images = $input['show_images'];
        $menuObj->status = $input['status'];
        $menuObj->sort = Blog::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        $photos = \Session::get('photos');
        if($photos){
            $imagesData = Photo::where('imageable_type','App\Models\Blog')->whereIn('id',$photos);
            $imagesData->update(['imageable_id'=>$menuObj->id]);
            foreach ($imagesData->get() as $image) {
                if($image->link == $image->filename){
                    $image->link = asset('/uploads').'/blogs/'.$menuObj->id.'/'.$image->filename;
                    $image->save();
                    
                    $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
                    $explodeImage = explode('.', $image->link);
                    $extension = end($explodeImage);

                    if(in_array($extension, $imageExtensions)){
                        $menuObj->fileType = 'photo';
                    }else{
                        $menuObj->fileType = 'video';
                    }
                    $menuObj->file = $image->filename;
                    $menuObj->save();
                    
                }
            }
        }

        \Session::forget('photos');
        WebActions::newType(1,'Blog');
        \Session::flash('success', "تنبيه! تم الحفظ بنجاح");
        return redirect()->to('blogs/');
    }

    public function delete($id) {
        $id = (int) $id;
        $menuObj = Blog::getOne($id);
        WebActions::newType(3,'Blog');
        return \Helper::globalDelete($menuObj);
    }

    public function fastEdit() {
        $input = \Request::all();
        foreach ($input['data'] as $item) {
            $col = $item[1];
            $menuObj = Blog::find($item[0]);
            $menuObj->$col = $item[2];
            $menuObj->updated_at = DATE_TIME;
            $menuObj->updated_by = USER_ID;
            $menuObj->save();
        }

        WebActions::newType(4,'Blog');
        return \TraitsFunc::SuccessResponse('تم التعديل بنجاح');
    }

    public function arrange() {
        $data = Blog::dataList();
        return view('Blog.Views.arrange')->with('data', (Object) $data);;
    }

    public function sort(){
        $input = \Request::all();

        $ids = json_decode($input['ids']);
        $sorts = json_decode($input['sorts']);

        for ($i = 0; $i < count($ids) ; $i++) {
            Blog::where('id',$ids[$i])->update(['sort'=>$sorts[$i]]);
        }
        return \TraitsFunc::SuccessResponse('تم الترتيب بنجاح');
    }

    public function uploadImage(Request $request,$id=false){
        \Session::put('photos', []);
        if ($request->hasFile('file')) {
            $files = $request->file('file');
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
        $lastID = Blog::orderBy('id','DESC')->first();
        if($lastID){
            if(! $nextID){
                $nextID = $lastID->id + 1;
            }
        }else{
            $nextID = 1;
        }           
        $fileName = \ImagesHelper::UploadImage('blogs', $images, $nextID);
        if($fileName == false){
            return false;
        }
        
        $photoObj = new Photo;
        $photoObj->filename = $fileName;
        $photoObj->imageable_type = 'App\Models\Blog';
        $photoObj->imageable_id = $nextID;
        $photoObj->link = $fileName;
        $photoObj->status = 1;
        $photoObj->sort = Photo::newSortIndex();
        $photoObj->created_at = DATE_TIME;
        $photoObj->created_by = USER_ID;
        $photoObj->save();
        
        return [$photoObj->id,$fileName];        
    }

    public function deleteImage($id){
        $id = (int) $id;
        $input = \Request::all();

        $menuObj = Blog::find($id);

        if($menuObj == null) {
            return \TraitsFunc::ErrorMessage("هذه الصفحة غير موجودة");
        }

        Photo::where('imageable_id',$id)->where('imageable_type','App\Models\Blog')->update(['updated_at'=> DATE_TIME,'updated_by' => USER_ID]);
        $menuObj->file = '';
        $menuObj->fileType = '';
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

        $addCount = WebActions::getByDate($date,$start,$end,1,'Blog')['count'];
        $editCount = WebActions::getByDate($date,$start,$end,2,'Blog')['count'];
        $deleteCount = WebActions::getByDate($date,$start,$end,3,'Blog')['count'];
        $fastEditCount = WebActions::getByDate($date,$start,$end,4,'Blog')['count'];

        $data['chartData1'] = $this->getChartData($start,$end,1,'Blog');
        $data['chartData2'] = $this->getChartData($start,$end,2,'Blog');
        $data['chartData3'] = $this->getChartData($start,$end,4,'Blog');
        $data['chartData4'] = $this->getChartData($start,$end,3,'Blog');
        $data['counts'] = [$addCount , $editCount , $deleteCount , $fastEditCount];
        $data['title'] = 'المدونة';
        $data['miniTitle'] = 'المدونة';
        $data['url'] = 'blogs';

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
