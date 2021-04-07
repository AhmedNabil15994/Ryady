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
use App\Models\Message;
use PDF;
use PKPass\PKPass;

class ProfileControllers extends Controller {

    use \TraitsFunc;

    public function addToWallet(){
        $userObj = User::getData(User::getOne(USER_ID));
        $cardObj = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        setlocale(LC_MONETARY, 'en_US');

        // Variables
        $id = $cardObj->code;//rand(100000, 999999) . '-' . rand(100, 999) . '-' . rand(100, 999); // Every card should have a unique serialNumber
        $balance = 'SAR ' . $cardObj->membership->price; // Create random balance
        $name = $userObj->name_en;
        dd($name);

        // Create pass
        // Set the path to your Pass Certificate (.p12 file)
        $pass = new PKPass('../../Certificates.p12', 'password');
        $pass->setData('{
        "passTypeIdentifier": "pass.com.scholica.flights", 
        "formatVersion": 1,
        "organizationName": "AlshabAlriyadi",
        "teamIdentifier": "KN44X8ZLNC",
        "serialNumber": "' . $id . '",
        "backgroundColor": "rgb(240,240,240)",
        "logoText": "alshabalriyadi",
        "description": "alshabalriyadi Card",
        "storeCard": {
            "secondaryFields": [
                {
                    "key": "balance",
                    "label": "BALANCE",
                    "value": "' . $balance . '"
                },
                {
                    "key": "name",
                    "label": "NICKNAME",
                    "value": "' . $name . '"
                }
            ],
            "backFields": [
                {
                    "key": "id",
                    "label": "Card Number",
                    "value": "' . $id . '"
                }
            ]
        },
        "barcode": {
            "format": "PKBarcodeFormatPDF417",
            "message": "' . $id . '",
            "messageEncoding": "iso-8859-1",
            "altText": "' . $id . '"
        }
        }');

        // add files to the PKPass package
        $pass->addFile('icon.png');
        $pass->addFile('icon@2x.png');
        $pass->addFile('logo.png');
        $pass->addFile('background.png', 'strip.png');

        if(!$pass->create(true)) { // Create and output the PKPass
            echo 'Error: ' . $pass->getError();
        }

        \Session::flash('success', 'تم الاضافة الي المحفظة');
        return redirect()->back();
    }

    protected function validateObject($input){
        $rules = [
            'title' => 'required',
            'type' => 'required',
            'phone' => 'required',
            // 'email' => 'required',
            'city_id' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال اسم المشروع",
            'type.required' => "يرجي اختيار نوع المشروع",
            'phone.required' => "يرجي ادخال رقم الجوال",
            // 'email.required' => "يرجي ادخال البريد الالكتروني",
            'city_id.required' => "يرجي ادخال المدينة",
            'category_id.required' => "يرجي اختيار التصنيف",
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
        $data['points'] = User::getPoints();
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function update(){
        $input = \Request::all();
        $userObj = User::getOne(USER_ID);
        if(isset($input['brief']) && !empty($input['brief'])){
            $userObj->brief = $input['brief'];
        }
        if(isset($input['facebook']) && !empty($input['facebook'])){
            $userObj->facebook = $input['facebook'];
        }
        if(isset($input['twitter']) && !empty($input['twitter'])){
            $userObj->twitter = $input['twitter'];
        }
        if(isset($input['snapchat']) && !empty($input['snapchat'])){
            $userObj->snapchat = $input['snapchat'];
        }
        if(isset($input['youtube']) && !empty($input['youtube'])){
            $userObj->youtube = $input['youtube'];
        }
        if(isset($input['instagram']) && !empty($input['instagram'])){
            $userObj->instagram = $input['instagram'];
        }
        if(isset($input['gender']) && !empty($input['gender'])){
            $userObj->gender = $input['gender'];
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

        $userObj->updated_by = USER_ID;
        $userObj->updated_at = DATE_TIME;
        $userObj->save();

        \Session::flash('success', 'تم تحديث البيانات الشخصية');
        return redirect()->back();
    }

    public function membership(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['qrCode'] = $cardObj != null ? \QrCode::size(50)->generate($data['membership']->code) : null;
        $data['points'] = User::getPoints();
        $membership_id = $cardObj != null ? $data['membership']->membership_id : null;
        $membership = $cardObj != null ? Membership::getData(Membership::getOne($membership_id)) : null;
        $data['mainMembership'] = $membership;
        $ids = $cardObj != null ? $membership->features : null;
        $data['features'] = Feature::dataList(1,$ids)['data'];
        $data['printCards'] = $cardObj != null ? UserRequest::NotDeleted()->where('user_id',USER_ID)->where('status',1)->where('user_card_id',$cardObj->id)->first() : null;
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function addRequest(){
        $userObj = User::getData(User::getOne(USER_ID));
        $menuObj = UserCard::getAvailableForUser(USER_ID);
        $membershipObj = $menuObj->Membership;
        $menuObj = UserCard::getData($menuObj);
        // dd($membershipObj);
        // Create Invoice
        // $invoiceData =[
        //     'amount' => 100 * 100 ,
        //     'currency' => 'SAR',
        //     'description' => 'بطاقة مطبوعة لعضوية '.$membershipObj->title . ' بطاقة رقم '.$menuObj->code,
        //     'callback_url' => \URL::to('/memberships/pushRequest/'.$userObj->id),
        //     'expired_at' => date("Y-m-d", strtotime(now()->format('Y-m-d'). " + 1 day")),
        // ];
        // $paymentObj = new \PaymentHelper();        
        // $createPayment = $paymentObj->moyasar('invoices',$invoiceData);
        // $invoiceResult = $createPayment->json();

        // $checkResult = $paymentObj->formatResponse($invoiceResult);
        // if($checkResult[0] == 0){
        //     \Session::flash('error', $checkResult[1]);
        //     return redirect()->back();
        // }

        $userRequestObj = new UserRequest();
        $userRequestObj->user_id = USER_ID;
        $userRequestObj->membership_id = $menuObj->membership_id;
        $userRequestObj->user_card_id = $menuObj->id;    
        $userRequestObj->status = 2;
        $userRequestObj->sort = UserRequest::newSortIndex();
        $userRequestObj->invoice_id = '';
        $userRequestObj->created_by = USER_ID;
        $userRequestObj->created_at = DATE_TIME;
        $userRequestObj->save();

        \Session::put('new_user_id',$userObj->id);
        \Session::put('user_request_id',$userRequestObj->id);
        WebActions::newType(1,'UserRequest',$userRequestObj->id);

        $names = explode(' ', $userObj->name_en ,2);
        $invoiceData = [
            'title' => $userObj->name_en,
            'cc_first_name' => $names[0],
            'cc_last_name' => isset($names[1]) ? $names[1] : '',
            'email' => $userObj->email,
            'cc_phone_number' => '',
            'phone_number' => $userObj->phone,
            'products_per_title' => 'Printed Card',
            'reference_no' => 'user-'.$userObj->id.'-'.$userRequestObj->id,
            'unit_price' => 100,
            'quantity' => 1,
            'amount' => 100,
            'other_charges' => 'VAT',
            'discount' => '',
            'payment_type' => 'mastercard',
            'OrderID' => 'user-'.$userObj->id.'-'.$userRequestObj->id,
            'SiteReturnURL' => \URL::to('/memberships/pushInvoice/'.$userObj->id.'/card'),
        ];
        // dd($invoiceData);
        $paymentObj = new \PaymentHelper();        
        return $paymentObj->RedirectWithPostForm($invoiceData);
    }

    public function newProject(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['cities'] = City::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function projects(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        $data['projects'] = Project::dataList(null,null,USER_ID)['data'];
         $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function addBlog(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
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
        if(Variable::getVar('REQUEST_SERVICE') == 0){
            return redirect(404);
        }
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        $data['data'] = OrderCategory::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function postOrder() {
        if(Variable::getVar('REQUEST_SERVICE') == 0){
            return redirect(404);
        }
        $input = \Request::all();

        $validate = $this->validateOrder($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }

        $brief = str_split($input['service_brief'],140);

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
        $menuObj->service_brief = $brief[0];
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

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d',strtotime(date('Y-m-d',strtotime($start_date)).'+1 year'));

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

        // Create Invoice
        // $invoiceData =[
        //     'amount' => $membershipObj->price * 100 - $discounts,
        //     'currency' => 'SAR',
        //     'description' => 'ترقية من عضوية '.$avail->Membership->title.' الي عضوية '.$membershipObj->title . ' بطاقة رقم '.$menuObj->code,
        //     'callback_url' => \URL::to('/memberships/pushInvoice/'.$userObj->id),
        //     'expired_at' => date("Y-m-d", strtotime(now()->format('Y-m-d'). " + 1 day")),
        // ];
        // $paymentObj = new \PaymentHelper();        
        // $createPayment = $paymentObj->moyasar('invoices',$invoiceData);
        // $invoiceResult = $createPayment->json();

        // $checkResult = $paymentObj->formatResponse($invoiceResult);
        // if($checkResult[0] == 0){
        //     \Session::flash('error', $checkResult[1]);
        //     return redirect()->back();
        // }

        \Session::put('new_user_id',$userObj->id);
        \Session::put('user_card_id',$menuObj->id);
        \Session::put('upgrade',1);
        WebActions::newType(1,'UserCard',$menuObj->id);
        WebActions::newType(2,'UserCard',$avail->id);

        $names = explode(' ', $userObj->name_en ,2);
        $invoiceData = [
            'title' => $userObj->name_en,
            'cc_first_name' => $names[0],
            'cc_last_name' => isset($names[1]) ? $names[1] : '',
            'email' => $userObj->email,
            'cc_phone_number' => '',
            'phone_number' => $userObj->phone,
            'products_per_title' => 'New Membership',
            'reference_no' => 'user-'.$userObj->id.'-'.$menuObj->id,
            'unit_price' => $membershipObj->price - $discounts,
            'quantity' => 1,
            'amount' => $membershipObj->price - $discounts,
            'other_charges' => 'VAT',
            'discount' => '',
            'payment_type' => 'mastercard',
            'OrderID' => 'user-'.$userObj->id.'-'.$menuObj->id,
            'SiteReturnURL' => \URL::to('/memberships/pushInvoice/'.$userObj->id.'/membership'),
        ];
        // dd($invoiceData);
        $paymentObj = new \PaymentHelper();        
        return $paymentObj->RedirectWithPostForm($invoiceData);

        // return redirect()->away($invoiceResult['url']);
    }

    public function download($id){

        $certificateObj = UserCard::getOne($id);
        if($certificateObj == null || (!empty($certificateObj) && $certificateObj->user_id != USER_ID) ){
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
        $data['points'] = User::getPoints();
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
        $menuObj->type = $input['type'] == '@' ? 'أخري' : $input['type'];
        $menuObj->type_text = $input['type'] == '@' ? $input['type_text'] : '';
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

    public function editProject($id){
        $id = (int) $id;
        $blogObj = Project::getOne($id);
        if(!$blogObj || $blogObj->created_by != USER_ID){
            return redirect('404');
        }
        $data['data'] = Project::getData($blogObj);
        $data['categories'] = ProjectCategory::dataList(1)['data'];
        $data['cities'] = City::dataList(1)['data'];
        $data['membership'] = UserCard::getData(UserCard::getAvailableForUser(USER_ID));
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function updateProject($id,Request $request){
        $id = (int) $id;
        $input = \Request::all();

        $validate = $this->validateObject($input);
        if($validate->fails()){
            return \TraitsFunc::ErrorMessage($validate->messages()->first());
        }

        $menuObj = Project::getOne($id);
        if(!$menuObj || $menuObj->created_by != USER_ID){
            return \TraitsFunc::ErrorMessage("تنبيه! هذا المشروع غير موجود");
        }

        $menuObj->title = $input['title'];
        $menuObj->type = $input['type'] == '@' ? 'أخري' : $input['type'];
        $menuObj->type_text = $input['type'] == '@' ? $input['type_text'] : '';
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

        WebActions::newType(2,'Project');
        Session::flash('success','تم التعديل بنجاح');
        return \TraitsFunc::SuccessResponse("تنبيه! تم التعديل بنجاح");
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

    public function messages(){
        $data['user'] = User::getData(User::getOne(USER_ID));
        $data['points'] = User::getPoints();
        $cardObj = UserCard::getAvailableForUser(USER_ID);
        $data['membership'] = $cardObj != null ? UserCard::getData($cardObj) : null;
        $data['messages'] = Message::dataList(1)['data'];
        return view('Profile.Views.profile')->with('data',(object) $data);
    }

    public function newMessage(Request $request){
        $input = \Request::all();
        $menuObj = new Message;
        $menuObj->user_id = $input['user_id'];
        $menuObj->message = $input['message'];
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();

        WebActions::newType(1,'Message');
        Session::flash('success','تم الارسال بنجاح');
        return \TraitsFunc::SuccessResponse("تنبيه! تم الارسال بنجاح");
    }
}
