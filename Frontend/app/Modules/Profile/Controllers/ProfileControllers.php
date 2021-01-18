<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\OrderCategory;
use App\Models\WebActions;
use App\Models\Project;
use App\Models\Coupon;
use App\Models\UserCard;
use App\Models\Membership;
use App\Models\UserRequest;
use App\Models\Feature;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Photo;
use App\Models\Variable;
use PDF;

class ProfileControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city_id' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال العنوان",
            'address.required' => "يرجي ادخال العنوان",
            'phone.required' => "يرجي ادخال العنوان",
            'email.required' => "يرجي ادخال البريد الالكتروني",
            'city_id.required' => "يرجي ادخال العنوان",
            'category_id.required' => "يرجي ادخال العنوان",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    protected function validateBlog($input){
        $rules = [
            'title' => 'required',
            'file' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال العنوان",
            'file.required' => "يرجي اختيار المرفقات",
            'category_id.required' => "يرجي اختيار العنوان",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    protected function validateOrder($input){
        $rules = [
            'name' => 'required',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'email' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'name.required' => "يرجي ادخال الاسم بالكامل",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
            'email.required' => "يرجي ادخال البريد الالكتروني",
            'category_id.required' => "يرجي اختيار نوع الخدمة",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    protected function validateUpgradeObj($input){
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'start_date' => 'required',
            'end_date' => 'required',
            'logo' => 'required',
            'images' => 'required',
            'brief' => 'required',
        ];

        $message = [
            'name_ar.required' => "يرجي ادخال الاسم بالعربي",
            'name_en.required' => "يرجي ادخال الاسم بالانجليزي",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
            'start_date.required' => "يرجي ادخال تاريخ البداية",
            'end_date.required' => "يرجي ادخال تاريخ النهاية",
            'logo.required' => "يرجي ارفاق شعار النشاط",
            'images.required' => "يرجي ارفاق صور عن النشاط",
            'brief.required' => "يرجي ادخال نبذة عن المشروع",

        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function profile(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['qrCode'] = \QrCode::size(50)->generate($data['membership']->code);
        $membership_id = $data['membership']->membership_id;
        $membership = Membership::getData(Membership::getOne($membership_id));
        $data['mainMembership'] = $membership;
        $ids = $membership->features;
        $data['features'] = Feature::dataList(1,$ids)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function newProject(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['cities'] = City::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function addBlog(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['categories'] = OrderCategory::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function postBlog(){
        $input = \Request::all();
        
        $validate = $this->validateBlog($input);
        if($validate->fails()){
            return \TraitsFunc::ErrorMessage($validate->messages()->first());
        }
            
        $menuObj = new Blog;
        $menuObj->title = $input['title'];
        $menuObj->description = $input['description'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->status = 2;
        $menuObj->views = 0;
        $menuObj->sort = Blog::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        if(!empty($input['file'])){
            $image = \ImagesHelper::UploadImage('blogs', $input['file'], $menuObj->id);
            if ($image == false) {
                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
            }
            $photoObj = new Photo;
            $photoObj->filename = $image;
            $photoObj->imageable_type = 'App\Models\Blog';
            $photoObj->imageable_id = $menuObj->id;
            $photoObj->link = asset('/uploads').'/blogs/'.$menuObj->id.'/'.$image;
            $photoObj->status = 1;
            $photoObj->sort = Photo::newSortIndex();
            $photoObj->created_at = DATE_TIME;
            $photoObj->created_by = USER_ID;
            $photoObj->save();

            $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd'];
            $explodeImage = explode('.', $photoObj->link);
            $extension = end($explodeImage);

            if(in_array($extension, $imageExtensions)){
                $menuObj->fileType = 'photo';
            }else{
                $menuObj->fileType = 'video';
            }
            $menuObj->file = $photoObj->filename;
            $menuObj->save();
        }

        WebActions::newType(1,'Blog');
        Session::flash('success','تم الحفظ بنجاح');
        return \TraitsFunc::SuccessResponse("تنبيه! تم الحفظ بنجاح");
    }


    public function newOrder(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['data'] = OrderCategory::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function postOrder() {
        $input = \Request::all();

        $validate = $this->validateOrder($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        $categoryObj = OrderCategory::getOne($input['category_id']);
        if(!$categoryObj){
            \Session::flash('error', 'نوع الخدمة غير موجودة');
            return redirect()->back()->withInput();
        }
        
        $menuObj = new Order;
        $menuObj->name = $input['name'];
        $menuObj->phone = $input['phone'];
        $menuObj->email = $input['email'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->sort = Order::newSortIndex();
        $menuObj->status = 1;
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        WebActions::newType(2,'Order');
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        return redirect()->back();
    }

    public function uploadLogo(){
        $input = \Request::all();
        $image = \ImagesHelper::UploadImage('users', $input['image'], USER_ID);
        if ($image == false) {
            return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
        }
        $photoObj = new Photo;
        $photoObj->filename = $image;
        $photoObj->imageable_type = 'App\Models\User';
        $photoObj->imageable_id = USER_ID;
        $photoObj->link = asset('/uploads').'/users/'.USER_ID.'/'.$image;
        $photoObj->status = 1;
        $photoObj->sort = Photo::newSortIndex();
        $photoObj->created_at = DATE_TIME;
        $photoObj->created_by = USER_ID;
        $photoObj->save();

        $userObj = User::getOne(USER_ID);
        $userObj->image = $image;
        $userObj->save();

        return \TraitsFunc::SuccessResponse("تنبيه! تم رفع الصورة");
    }

    public function upgrade(){
        $user_id =  USER_ID;
        $input = \Request::all();

        $avail = UserCard::getAvailableForUser($user_id);
        $oldMembership = $avail->membership_id;
        if($oldMembership == 3){
            \Session::flash('error', 'عفوا ! لا يمكنك ترقية البطاقة');
            return redirect()->back()->withInput();
        }

        $validate = $this->validateUpgradeObj($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        $id = $oldMembership+1;
        $membershipObj = Membership::getOne($id);
        if($membershipObj == null){
            \Session::flash('error', 'هذه العضوية غير موجودة');
            return redirect()->back()->withInput();
        }

        $start_date = date('Y-m-d',strtotime(str_replace('/', '-', $input['start_date'])));
        $end_date = date('Y-m-d',strtotime(str_replace('/', '-', $input['end_date'])));

        $userObj = User::getOne($user_id);

        $userObj->name_ar = $input['name_ar'];
        $userObj->name_en = $input['name_ar'];
        $userObj->phone = $input['phone'];
        $userObj->status = 1;
        $userObj->is_active = 1;
        $userObj->updated_at = DATE_TIME;
        $userObj->updated_by = $user_id;
        $userObj->save();

        $avail->status = 4;
        $avail->updated_at = DATE_TIME;
        $avail->updated_by = $user_id;
        $avail->save();

        $menuObj = new UserCard;
        $menuObj->user_id = $userObj->id;
        $menuObj->code = $input['code'];
        $menuObj->membership_id = $id;
        $menuObj->start_date = $start_date;
        $menuObj->end_date = $end_date;
        $menuObj->status = 1;
        $menuObj->sort = UserCard::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = $user_id;
        $menuObj->save();

        if(isset($input['user_request']) && $input['user_request'] == 'on'){
            $userRequestObj = new UserRequest;
            $userRequestObj->user_id = $userObj->id;
            $userRequestObj->membership_id = $id;
            $userRequestObj->user_card_id = $menuObj->id;
            $userRequestObj->status = 2;
            $userRequestObj->sort = UserRequest::newSortIndex();
            $userRequestObj->created_at = DATE_TIME;
            $userRequestObj->created_by = $user_id;
            $userRequestObj->save();
            WebActions::newType(1,'UserRequest',$user_id);
        }


        WebActions::newType(1,'UserCard',$user_id);
        WebActions::newType(2,'User',$user_id);
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        return redirect()->back();
        
    }

    public function download($id){

        $certificateObj = UserCard::getOne($id);
        if($certificateObj == null){
            return redirect('404');
        }
        $certificateObj = UserCard::getData($certificateObj);
        
        $data['title'] = Variable::getVar('العنوان عربي') . ' - ' . 'شهادة عضوية';
        $data['code'] = $certificateObj->code;
        $data['user'] = $certificateObj->name_ar;
        $data['membership_name'] = $certificateObj->membership->title;
        $data['start_date'] = $this->translateDates($certificateObj->start_date);
        $data['end_date'] = $this->translateDates($certificateObj->end_date);

        $pdf = PDF::loadView('Profile.Views.certificate', $data)
                ->setPaper('a4', 'landscape')
                ->setOption('margin-bottom', '0mm')
                ->setOption('margin-top', '0mm')
                ->setOption('margin-right', '0mm')
                ->setOption('margin-left', '0mm');
        return $pdf->download('Certification.pdf');
    }

    public function translateDates($date){
        $arabicMonths = ['يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        $dateDay = date('d',strtotime($date));
        $month = date('M',strtotime($date));
        $monthIndex = date('m',strtotime($month)) - 1;
        $dateMonth = $arabicMonths[$monthIndex].' ';

        $dateYear = date('Y',strtotime($date));

        return [$dateDay,$dateMonth,$dateYear];
    }


    public function addProject(){
    	$data['categories'] = ProjectCategory::dataList(1)['data'];
    	$data['cities'] = City::dataList(1)['data'];
        return view('Profile.Views.addProject')->with('data',(object) $data);
    }

    public function postAddProject(Request $request){
    	$input = \Request::all();

        $validate = $this->validateObject($input);
        if($validate->fails()){
        	return \TraitsFunc::ErrorMessage($validate->messages()->first());
        }

        $availableCoupons = Coupon::availableCoupons();
        $availableCoupons = reset($availableCoupons);
        
        $coupons = explode(',', $input['coupons']);
        foreach ($coupons as $coupon) {
        	if(!in_array($coupon, $availableCoupons)){
        		return \TraitsFunc::ErrorMessage('هذا الكود ('.$coupon.') غير متاح حاليا');
        	}
        }


        $menuObj = new Project;
        $menuObj->title = $input['title'];
        $menuObj->address = $input['address'];
        $menuObj->email = $input['email'];
        $menuObj->phone = $input['phone'];
        $menuObj->city_id = $input['city_id'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->brief = $input['brief'];
        $menuObj->lat = isset($input['lat']) ? $input['lat'] : '';
        $menuObj->lng = isset($input['lng']) ? $input['lng'] : '';
        if(isset($coupons) && !empty($coupons)){
            $menuObj->coupons = serialize($coupons);
        }
        $menuObj->status = 2;
        $menuObj->sort = Project::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();


        if(!empty($input['logo'])){
        	$check = $this->uploadImage($menuObj->id,$input['logo'],'logo',$request);
        	if($check != 1){
        		return $check;
        	}
        }

        if(!empty($input['images'])){
        	$check = $this->uploadImage($menuObj->id,$input['images'],'images',$request);
        	if($check != 1){
        		return $check;
        	}
        }

        WebActions::newType(1,'Project');
        Session::flash('success','تم الحفظ بنجاح');
        return \TraitsFunc::SuccessResponse("تنبيه! تم الحفظ بنجاح");
    }

    public function uploadImage($id,$images,$type,$request){
        $menuObj = Project::getOne($id);
    	$otherImages = [];
    	if($type == 'images'){
    		for ($i=0; $i <count($images) ; $i++) { 
	            $image = \ImagesHelper::UploadImage('projects', $images[$i], $id);
	            if ($image == false) {
	                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
	            }
	            $photoObj = new Photo;
		        $photoObj->filename = $image;
		        $photoObj->imageable_type = 'App\Models\Project';
		        $photoObj->imageable_id = $id;
		        $photoObj->link = asset('/uploads').'/projects/'.$id.'/'.$image;
		        $photoObj->status = 1;
		        $photoObj->sort = Photo::newSortIndex();
		        $photoObj->created_at = DATE_TIME;
		        $photoObj->created_by = USER_ID;
		        $photoObj->save();
	            $otherImages[] = $image;
	        }
	        $menuObj->images = serialize($otherImages);
    	}else {
    		$image = \ImagesHelper::UploadImage('projects', $images, $id);
            if ($image == false) {
                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
            }

            $photoObj = new Photo;
	        $photoObj->filename = $image;
	        $photoObj->imageable_type = 'App\Models\Project';
	        $photoObj->imageable_id = $id;
	        $photoObj->link = asset('/uploads').'/projects/'.$id.'/'.$image;
	        $photoObj->status = 1;
	        $photoObj->sort = Photo::newSortIndex();
	        $photoObj->created_at = DATE_TIME;
	        $photoObj->created_by = USER_ID;
	        $photoObj->save();
	        $menuObj->logo = $image;
    	}
        $menuObj->save();
        return 1;
    }
}
