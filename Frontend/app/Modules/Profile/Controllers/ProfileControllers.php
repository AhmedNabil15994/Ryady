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

    public function profile(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function update(){
        $input = \Request::all();
        $userObj = User::getOne(USER_ID);
        if(isset($input['brief']) && !empty($input['brief'])){
            $userObj->brief = $input['brief'];
        }
        if(isset($input['password']) && !empty($input['password'])){
            $rules = [
                'password' => 'min:6',
            ];

            $message = [
                'password.min' => "كلمة المرور يجب ان تكون 6 خانات علي الاقل",
            ];

            $validate = \Validator::make($input, $rules, $message);
            if($validate->fails()){
                \Session::flash('error', $validate->messages()->first());
                return redirect()->back()->withInput();
            }
            $userObj->password = \Hash::make($input['password']);
        }
        if(isset($input['email']) && !empty($input['email'])){
            $rules = [
                'email' => 'email',
            ];

            $message = [
                'email.email' => "يرجي ادخال صيغة صحيحة للبريد الالكتروني",
            ];

            $validate = \Validator::make($input, $rules, $message);
            if($validate->fails()){
                \Session::flash('error', $validate->messages()->first());
                return redirect()->back()->withInput();
            }
            $checkUser = User::checkUserByEmail($input['email'],$userObj->id);
            if($checkUser != null){
                \Session::flash('error', 'هذا البريد الالكتروني مستخدم من قبل');
                return redirect()->back()->withInput();
            }
            $userObj->email = $input['email'];
        }
        if(isset($input['email']) && !empty($input['email'])){
            $rules = [
                'phone' => 'min:10',
            ];

            $message = [
                'phone.min' => "رقم الجوال يجب ان يكون 10 خانات علي الاقل",
            ];

            $validate = \Validator::make($input, $rules, $message);
            if($validate->fails()){
                \Session::flash('error', $validate->messages()->first());
                return redirect()->back()->withInput();
            }
            $checkUser = User::checkUserByPhone($input['phone'],$userObj->id);
            if($checkUser != null){
                \Session::flash('error', 'هذا رقم الجوال مستخدم من قبل');
                return redirect()->back()->withInput();
            }
            $userObj->phone = $input['phone'];
        }

        $userObj->updated_by = USER_ID;
        $userObj->updated_at = DATE_TIME;
        $userObj->save();

        \Session::flash('success', 'تم تحديث البيانات الشخصية');
        return redirect()->back();
    }

    public function membership(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['qrCode'] = \QrCode::size(50)->generate($data['membership']->code);
        $data['points'] = User::getPoints();
        $membership_id = $data['membership']->membership_id;
        $membership = Membership::getData(Membership::getOne($membership_id));
        $data['mainMembership'] = $membership;
        $ids = $membership->features;
        $data['features'] = Feature::dataList(1,$ids)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function addRequest(){
        // $userObj = User::getData(User::getOne(USER_ID));
        $userCardObj = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        if($userCardObj){
            $userRequestObj = UserRequest::NotDeleted()->where('status',2)->where('user_id',USER_ID)->where('user_card_id',$userCardObj->id)->first();
            if($userRequestObj != null){
                \Session::flash('error', 'تم ارسال الطلب من قبل');
            }else{
                $userRequestObj = new UserRequest();
                $userRequestObj->user_id = USER_ID;
                $userRequestObj->membership_id = $userCardObj->membership_id;
                $userRequestObj->user_card_id = $userCardObj->id;    
                $userRequestObj->status = 2;
                $userRequestObj->sort = UserRequest::newSortIndex();
                $userRequestObj->created_by = USER_ID;
                $userRequestObj->created_at = DATE_TIME;
                $userRequestObj->save();
                \Session::flash('success', 'تم ارسال الطلب بنجاح');
            }
        }
        

        return redirect()->back();
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
        $data['categories'] = BlogCategory::dataList(1)['data'];
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
        Session::flash('success','تم الارسال بنجاح');
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

        $userObj = User::getOne($user_id);
        $avail = UserCard::getAvailableForUser($user_id);
        $oldMembership = $avail->membership_id;
        if($oldMembership == 3){
            \Session::flash('error', 'عفوا ! لا يمكنك ترقية البطاقة');
            return redirect()->back()->withInput();
        }

        if($input['new_membership_id'] <= $oldMembership){
            \Session::flash('error', 'عفوا ! يجب اختيار بطاقة اعلي من بطاقتك الحالية');
            return redirect()->back()->withInput();
        }

        $membershipObj = Membership::getOne($input['new_membership_id']);
        if($membershipObj == null){
            \Session::flash('error', 'هذه العضوية غير موجودة');
            return redirect()->back()->withInput();
        }

        $availableCoupons = Coupon::availableCoupons();
        $availableCoupons = reset($availableCoupons);
        
        $coupons = $input['coupons'];
        if(!empty($coupons[0])){
            foreach ($coupons as $coupon) {
                if(count($availableCoupons) > 0 && !in_array($coupon, $availableCoupons)){
                    return \Session::flash('error', 'هذا الكود ('.$coupon.') غير متاح حاليا');
                }
            }
        }

        $start_date = date('Y-m-d',strtotime(str_replace('/', '-', $avail->start_date)));
        $end_date = date('Y-m-d',strtotime(str_replace('/', '-', $avail->end_date)));

        $avail->status = 4;
        $avail->updated_at = DATE_TIME;
        $avail->updated_by = $user_id;
        $avail->save();

        $menuObj = new UserCard;
        $menuObj->user_id = $userObj->id;
        $menuObj->code = $avail->code;
        $menuObj->membership_id = $input['new_membership_id'];
        $menuObj->start_date = $start_date;
        $menuObj->end_date = $end_date;
        // $menuObj->status = 1;
        $menuObj->status = 2;
        if(isset($coupons) && !empty($coupons)){
            $menuObj->coupons = serialize($coupons);
        }
        $menuObj->sort = UserCard::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = $user_id;
        $menuObj->save();

        \Session::put("user_card_id",$menuObj->id);

        if(isset($input['user_request']) && $input['user_request'] == 'on'){
            $userRequestObj = new UserRequest;
            $userRequestObj->user_id = $userObj->id;
            $userRequestObj->membership_id = $input['new_membership_id'];
            $userRequestObj->user_card_id = $menuObj->id;
            $userRequestObj->status = 2;
            // $userRequestObj->status = 1;
            $userRequestObj->sort = UserRequest::newSortIndex();
            $userRequestObj->created_at = DATE_TIME;
            $userRequestObj->created_by = $user_id;
            $userRequestObj->save();
            \Session::put("user_request_id",$userRequestObj->id);
            WebActions::newType(1,'UserRequest',$user_id);
        }

        $discounts = 0;
        if(!empty($coupons[0])){
            foreach ($coupons as $coupon) {
                if(in_array($coupon, $availableCoupons)){
                    $couponObj = Coupon::getOneByCode($coupon);
                    if($couponObj->discount_type == 1){
                        $couponVal = $couponObj->discount_value;
                    }else{
                        $couponVal = round(($couponObj->discount_value * $membershipObj->price ) / 100, 2);
                    }
                    $discounts+= $couponVal;
                    if($couponObj->valid_type == 1){
                        $oldVal = $couponObj->valid_value;
                        $couponObj->valid_value = $oldVal - 1;
                        $couponObj->save();
                    }
                }
            }
        }
        \Session::put("must_paid", $membershipObj->price - $discounts);

        WebActions::newType(1,'UserCard',$user_id);
        WebActions::newType(2,'User',$user_id);
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        return redirect('/profile/payment');
        // return redirect()->back();
    }

    public function payment(){
        $data['url'] = \URL::to('/profile/payment');
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

        $userObj = User::getOne(USER_ID);
        $userCardObj = UserCard::getOne(\Session::get('user_card_id'));
        $price = \Session::get('must_paid');
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
        // return $checkStatus;
        // dd($checkStatus);
        if(!isset($checkStatus['errors']) && empty($checkStatus['errors'])){
            // dd($checkStatus);
            $userObj->status = 1;
            $userObj->is_active = 1;
            $userObj->save();

            $userCardObj->status = 1;
            $userCardObj->save();
            \Session::forget('user_card_id');
            \Session::forget('must_paid');

            if(\Session::has('user_request_id')){
                $userRequestObj->status = 1;
                $userRequestObj->save();
                \Session::forget('user_request_id');
            }

            \Session::flash('success', 'تم الدفع وترقية البطاقة بنجاح');
            return redirect()->to('/profile');
        }else{
            $erros = [];
            foreach ($checkStatus['errors'] as $key => $error) {
                \Session::flash('error', $key . ' '. $error[0]);   
            }
            return redirect()->back();
        }
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
        $menuObj->coupons = $input['coupons'];
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
