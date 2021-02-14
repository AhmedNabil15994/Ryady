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
use App\Models\UserMember;
use App\Models\UserRequest;
use App\Models\User;
use App\Models\Coupon;
use App\Models\WebActions;


class MembershipControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'membership_id' => 'required',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'password' => 'required|min:6',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
        ];

        $message = [
            'name_ar.required' => "يرجي ادخال الاسم بالعربي",
            'name_en.required' => "يرجي ادخال الاسم بالانجليزي",
            'membership_id.required' => "يرجي اختيار نوع العضوية",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات علي الاقل",
            'password.required' => "يرجي ادخال كلمة المرور",
            'password.min' => "كلمة المرور يجب ان تكون 6 خانات علي الاقل",
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
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('Membership.Views.index')->with('data',(object) $data);
    }

    public function features($id){
        $data['membership'] = Membership::getData(Membership::getOne($id));
        $data['features'] = Feature::NotDeleted()->whereIn('id',$data['membership']->features)->get();
        return view('Membership.Views.features')->with('data',(object) $data);
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
        $data['qrCode'] = \QrCode::size(50)->generate($data['code']);
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

        $userObj = User::checkUserByEmail($input['email']);
        if($userObj != null){
            \Session::flash('error', 'هذا البريد الالكتروني مستخدم من قبل');
            return redirect()->back()->withInput();
        }

        $userObj = User::checkUserByPhone($input['phone']);
        if($userObj != null){
            \Session::flash('error', 'هذا رقم التليفون مستخدم من قبل');
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

        $availableCoupons = Coupon::availableCoupons();
        $availableCoupons = reset($availableCoupons);
        // dd($availableCoupons);
        
        $coupons = $input['coupons'];
        if(!empty($coupons[0])){
            foreach ($coupons as $coupon) {
                if(count($availableCoupons) > 0 && !in_array($coupon, $availableCoupons)){
                    \Session::flash('error', 'هذا الكود ('.$coupon.') غير متاح حاليا');
                    return redirect()->back()->withInput();
                }
            }
        }

        $userObj = new User;
        $userObj->name_ar = $input['name_ar'];
        $userObj->name_en = $input['name_en'];
        $userObj->username = $username;
        $userObj->email = $input['email'];
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
        if(isset($coupons) && !empty($coupons)){
            $menuObj->coupons = serialize($coupons);
        }
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

        $discounts = 0;
        if(!empty($coupons[0])){
            foreach ($coupons as $coupon) {
                if(count($availableCoupons) > 0 && in_array($coupon, $availableCoupons)){
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

        \Session::put('discounts',$discounts);
        \Session::put('user_id',$userObj->id);
        \Session::put('user_card_id',$menuObj->id);
        WebActions::newType(1,'UserCard',$userObj->id);
        WebActions::newType(1,'User',$userObj->id);
        // \Session::flash('success', 'تنبيه! تم ارسال طلب التأكيد الى بريدك الالكتروني');
        \Session::flash('success', 'تنبيه! تم حفظ بيانات العضوية بنجاح');
        return redirect('/memberships/payment');
    }

    public function payment(){
        $data['url'] = \URL::to('/memberships/payment');
        return view('Membership.Views.payment')->with('data',(object) $data);
    }

    public function delayedPayment($id){
        $id = decrypt($id);
        $userObj = User::getOne($id);
        if($userObj->status == 1){
            \Session::flash('error', 'تنبيه! تم الدفع وتفعيل العضوية من قبل');
            return redirect('/');
        }
        \Session::put('user_id',$id);
        $userCardObj = UserCard::NotDeleted()->where('user_id',$userObj->id)->where('status',2)->orderBy('id','DESC')->first();
        \Session::put('user_card_id',$userCardObj->id);
        $userRequestObj = UserRequest::NotDeleted()->where('user_id',$userObj->id)->where('user_card_id',$userCardObj->id)->where('status',2)->orderBy('id','DESC')->first();
        if($userRequestObj != null){
            \Session::forget('user_request_id',$userRequestObj->id);
        }
        $data['url'] = \URL::to('/memberships/payment');
        return view('Membership.Views.payment')->with('data',(object) $data);
    }

    public function postPayment(){
        $input = \Request::all();
        $date = explode(' / ', $input['expire_date'], 2);
        $input['expire_date'] = $date[0];
        $input['year'] = '20'.$date[1];

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

        if(!\Session::has('user_id') || !\Session::has('user_card_id')){
            return redirect()->back()->withInput();
        }

        $userObj = User::getOne(\Session::get('user_id'));
        $userCardObj = UserCard::getOne(\Session::get('user_card_id'));
        $price = $userCardObj->Membership->price;
        if(\Session::has('user_request_id')){
            $userRequestObj = UserRequest::getOne(\Session::get('user_request_id'));
            $price += 100;
        }

        $name = explode(' ', $input['card_holder'], 2);
        $data = [
            'type' => 'credit',
            'amount' =>  $price - \Session::get('discounts'),
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
            $userCryptedID = encrypt($userObj->id);
            $emailData['firstName'] = $userObj->name_ar;
            $emailData['subject'] = 'تفعيل العضوية :';
            $emailData['content'] = '<a href="'.\URL::to('/memberships/activate/'.$userCryptedID).'">تفعيل العضوية</a>';
            $emailData['to'] = $userObj->email;
            $emailData['template'] = "emailUsers.emailReplied";
            \App\Helpers\MailHelper::SendMail($emailData);
            \Session::forget('discounts');
            \Session::forget('user_id');
            \Session::forget('user_card_id');           
            if(\Session::has('user_request_id')){
                \Session::forget('user_request_id');
            }            \Session::flash('success', 'تم الدفع وتم ارسال رابط تأكيد التفعيل الي بريدك الالكتروني');
            return redirect()->to('/');
        }else{
            $erros = [];
            foreach ($checkStatus['errors'] as $key => $error) {
                \Session::flash('error', $key . ' '. $error[0]);   
            }
            return redirect()->back();
        }   
    }

    public function activate($id){
        $id = decrypt($id);
        $userObj = User::getOne($id);
        $userObj->status = 1;
        $userObj->is_active = 1;
        $userObj->save();
        \Session::forget('user_id');

        $userCardObj = UserCard::NotDeleted()->where('user_id',$userObj->id)->orderBy('id','DESC')->first();
        $userCardObj->status = 1;
        $userCardObj->save();
        \Session::forget('user_card_id');

        if(\Session::has('user_request_id')){
            $userRequestObj = UserRequest::NotDeleted()->where('user_id',$userObj->id)->orderBy('id','DESC')->first();
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
        session(['full_name' => $userObj->name_ar]);

        $userMemberObj = new UserMember;
        $userMemberObj->user_id = $userObj->id;
        $userMemberObj->status = 1;
        $userMemberObj->sort = UserMember::newSortIndex();
        $userMemberObj->created_at = DATE_TIME;
        $userMemberObj->created_by = $userObj->id;
        $userMemberObj->save();
        \Session::flash('success', 'تم تفعيل العضوية بنجاح');
        return redirect()->to('/profile');
    }



   

}
