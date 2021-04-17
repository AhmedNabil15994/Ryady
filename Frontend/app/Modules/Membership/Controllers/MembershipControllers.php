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
use App\Models\UserEvent;
use App\Models\Coupon;
use App\Models\WebActions;
use App\Models\Variable;


class MembershipControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
            'membership_id' => 'required',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'password' => 'required|min:6',
            'email' => 'required|email',
            // 'end_date' => 'required',
        ];

        $message = [
            'name_ar.required' => "يرجي ادخال الاسم بالعربي",
            'name_en.required' => "يرجي ادخال الاسم بالانجليزي",
            'membership_id.required' => "يرجي اختيار نوع العضوية",
            'email.required' => "يرجي ادخال البريد الالكتروني",
            'email.email' => "يرجي ادخال صيغة صحيحة للبريد الالكتروني",
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
        // $data['advantages'] = Advantage::dataList(1)['data'];
        // $data['benefits'] = Benefit::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['targets'] = Target::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.index')->with('data',(object) $data);
    }

    public function features(){
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
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

        $nameArArr = explode(' ', $input['name_ar']);
        if(count($nameArArr) < 3){
            \Session::flash('error', 'يرجي ادخال الاسم العربي ثلاثي');
            return redirect()->back()->withInput();
        }

        $nameEnArr = explode(' ', $input['name_en']);
        if(count($nameEnArr) < 3){
            \Session::flash('error', 'يرجي ادخال الاسم الانجليزي ثلاثي');
            return redirect()->back()->withInput();
        }

        $membershipObj = Membership::getOne($input['membership_id']);
        if(!$membershipObj){
            \Session::flash('error', 'هذه العضوية غير موجودة');
            return redirect()->back()->withInput();
        }

        $userObj = User::checkUserByEmail($input['email']);
        if($userObj != null){
            $userCardObj = UserCard::where('user_id', $userObj->id)->first();
            if($userCardObj != null &&  $userCardObj->status == 1){
                \Session::flash('error', 'عفوا انت مشترك بالفعل!');
                return redirect()->back()->withInput();
            }
        }

        $userObj = User::checkUserByPhone($input['phone']);
        if($userObj != null){
            $userCardObj = UserCard::where('user_id', $userObj->id)->first();
            if($userCardObj != null &&  $userCardObj->status == 1){
                \Session::flash('error', 'عفوا انت مشترك بالفعل!');
                return redirect()->back()->withInput();
            }
        }

        $start_date = now()->format('Y-m-d');
        $end_date = date("Y-m-d", strtotime(now()->format('Y-m-d'). " + ".$membershipObj->period." year"));

        $username = $input['name_en'];

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
        $userObj->gender = $input['gender'];
        $userObj->phone = $input['phone'];
        $userObj->show_details = 0;
        $userObj->show_images = 0;
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

        // Create Invoice
        // $invoiceData =[
        //     'amount' => $membershipObj->price * 100 - $discounts,
        //     'currency' => 'SAR',
        //     'description' => 'عضوية '.$membershipObj->title . ' بطاقة رقم '.$menuObj->code,
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
        WebActions::newType(1,'UserCard',$userObj->id);
        WebActions::newType(1,'User',$userObj->id);

        $names = explode(' ', $userObj->name_en ,2);
        $invoiceData = [
            'title' => $userObj->name_en,
            'cc_first_name' => $names[0],
            'cc_last_name' => isset($names[1]) ? $names[1] : '',
            'email' => $userObj->email,
            'cc_phone_number' => '',
            'phone_number' => $userObj->phone,
            'products_per_title' => 'New Membership',
            'reference_no' => 'alshabalriyadi-'.$userObj->id,
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
    }

    public function delayedPayment($id){
        $id = decrypt($id);
        $userObj = User::getOne($id);
        if($userObj->status == 1){
            \Session::flash('error', 'تنبيه! تم الدفع وتفعيل العضوية من قبل');
            return redirect('/');
        }
        $userCardObj = UserCard::NotDeleted()->where('user_id',$userObj->id)->where('status',2)->orderBy('id','DESC')->first();
        $membershipObj = Membership::getOne($userCardObj->membership_id);

        $availableCoupons = Coupon::availableCoupons();
        $availableCoupons = reset($availableCoupons);
        $coupons = $userCardObj->coupons != null ? unserialize($userCardObj->coupons) : [];
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

        \Session::put('new_user_id',$userObj->id);
        \Session::put('user_card_id',$userCardObj->id);

        $names = explode(' ', $userObj->name_en ,2);
        $invoiceData = [
            'title' => $userObj->name_en,
            'cc_first_name' => $names[0],
            'cc_last_name' => isset($names[1]) ? $names[1] : '',
            'email' => $userObj->email,
            'cc_phone_number' => '',
            'phone_number' => $userObj->phone,
            'products_per_title' => 'New Membership',
            'reference_no' => 'user-'.$userObj->id.'-'.$userCardObj->id,
            'unit_price' => $membershipObj->price - $discounts,
            'quantity' => 1,
            'amount' => $membershipObj->price - $discounts,
            'other_charges' => 'VAT',
            'discount' => '',
            'payment_type' => 'mastercard',
            'OrderID' => 'user-'.$userObj->id.'-'.$userCardObj->id,
            'SiteReturnURL' => \URL::to('/memberships/pushInvoice/'.$userObj->id.'/membership'),
        ];
        // dd($invoiceData);
        $paymentObj = new \PaymentHelper();        
        return $paymentObj->RedirectWithPostForm($invoiceData);
    }

    // public function pushInvoice($id){
    //     $input = \Request::all();
    //     $status = $input['status'];
    //     $invoice_id = $input['id'];
    //     if($status == 'paid'){
    //         $userCardObj = UserCard::NotDeleted()->where('status',2)->where('user_id',$id)->orderBy('id','DESC')->first();
    //         $userCardObj->invoice_id = $invoice_id;
    //         $userCardObj->save();
    //         // $userRequestObj = UserRequest::NotDeleted()->where('status',2)->where('user_id',$id)->orderBy('id','DESC')->first();
    //         // $userRequestObj->invoice_id = $invoice_id;
    //         // $userRequestObj->save();
    //     }
    // }

    public function pushInvoice($id,$type='membership'){
        $input = \Request::all();
        $id = (int) $id;
        // dd($input);
        if (isset($input['cartId']) && !empty($input['cartId'])) {
            $postData['OrderID'] = $input['cartId'];
            $paymentObj = new \PaymentHelper();        
            $createPayment = $paymentObj->OpenURLWithPost($postData);
            $CreateaPage = json_decode($createPayment, TRUE);
        
            if ($CreateaPage['Code'] == "1001") {
                if ($CreateaPage['Data']['Status'] == "Success") {
                    $userObj = User::getOne($id);
                    $emailData['firstName'] = $userObj->name_ar;
                    $emailData['subject'] = 'رسالة تفعيل العضوية';
                    $emailData['content'] = '<p>مرحبا '.$userObj->name_ar.' في مجتمع الشاب الريادي</p><br><p>لتفعيل عضويتك الرجاء الضغط على الرابط </p><a href="'.\URL::to('/profile').'">(اضغط هنا)</a>';
                    $emailData['to'] = $userObj->email;
                    $emailData['template'] = "emailUsers.emailReplied";
                    \App\Helpers\MailHelper::SendMail($emailData);

                    if($type == 'membership'){
                        $userCardObj = UserCard::NotDeleted()->where('status',2)->where('user_id',$id)->orderBy('id','DESC')->first();
                        $userCardObj->invoice_id = $CreateaPage['Data']['OrderID'];
                        $userCardObj->save();
                    }

                    return $this->activate($id,$type);
                }
                if ($CreateaPage['Data']['Status'] == "Rejected") {
                    $UpdateOrder['Status'] = "تم رفض العملية";
                }
                if ($CreateaPage['Data']['Status'] == "Canceled") {
                    $UpdateOrder['Status'] = "تم الالغاء";
                }
                if ($CreateaPage['Data']['Status'] == "Expired Card") {
                    $UpdateOrder['Status'] = "البطاقة المستخدمة منتهية";
                }
                \Session::flash('error',$UpdateOrder['Status']);
                return redirect()->to('/');
            }else{
                \Session::flash('error','حدثت مشكلة في عملية الدفع');
                return redirect()->to('/');
            }
        }
    }

    // public function pushRequest($id){
    //     $input = \Request::all();
    //     $status = $input['status'];
    //     $invoice_id = $input['id'];
    //     if($status == 'paid'){
    //         $userRequestObj = UserRequest::NotDeleted()->where('status',2)->where('user_id',$id)->orderBy('id','DESC')->first();
    //         $userRequestObj->invoice_id = $invoice_id;
    //         $userRequestObj->save();
    //     }
    // }

    // public function pushRequest($id){
    //     $input = \Request::all();
    //     // dd($input);
    //     if (isset($input['cartId']) && !empty($input['cartId'])) {
    //         $postData['OrderID'] = $input['cartId'];
    //         $paymentObj = new \PaymentHelper();        
    //         $createPayment = $paymentObj->OpenURLWithPost($postData);
    //         $CreateaPage = json_decode($createPayment, TRUE);
       
    //        if ($CreateaPage['Code'] == "1001") {
    //             if ($CreateaPage['Data']['Status'] == "Success" || $CreateaPage['Data']['Status'] == "Canceled") {
    //                 $userRequestObj = UserRequest::NotDeleted()->where('status',2)->where('user_id',$id)->orderBy('id','DESC')->first();
    //                 $userRequestObj->invoice_id = $CreateaPage['Data']['OrderID'];
    //                 $userRequestObj->save();

    //                 return $this->activate($id,'card');
    //             }
    //             if ($CreateaPage['Data']['Status'] == "Rejected") {
    //                 $UpdateOrder['Status'] = "تم رفض العملية";
    //             }
    //             // if ($CreateaPage['Data']['Status'] == "Canceled") {
    //             //     $UpdateOrder['Status'] = "تم الالغاء";
    //             // }
    //             if ($CreateaPage['Data']['Status'] == "Expired Card") {
    //                 $UpdateOrder['Status'] = "البطاقة المستخدمة منتهية";
    //             }
    //             \Session::flash('error',$UpdateOrder['Status']);
    //             return redirect()->to('/');
    //         }else{
    //             \Session::flash('error','حدثت مشكلة في عملية الدفع');
    //             return redirect()->to('/');
    //         }
    //     }
    // }

    public function activate($id,$type='membership'){
        $id = (int) $id;//\Session::get('new_user_id');//decrypt($id);
        $userObj = User::getOne($id);
        if(!$userObj || !$id){
            return redirect('404');
        }

        $message = '';
        if($type == 'membership'){
            $userCardObj = UserCard::NotDeleted()->where('user_id',$userObj->id)->orderBy('id','DESC')->first();
            if($userCardObj != null){
                if($userCardObj->status != 2 && $userCardObj->invoice_id != null ){
                    return redirect('404');
                }
                $userCardObj->status = 1;
                $userCardObj->save();
                $message = 'تم تفعيل العضوية بنجاح';
                if(\Session::has('upgrade')){
                    $message = 'تم الدفع وترقية البطاقة بنجاح';
                }
                \Session::forget('user_card_id');
            }    
        }
        
        if($type == 'card'){
            $userRequestObj = UserRequest::NotDeleted()->where('user_id',$userObj->id)->orderBy('id','DESC')->first();
            if($userRequestObj != null){
                if($userRequestObj->invoice_id != null && $userRequestObj->status != 2){
                    return redirect('404');
                }
                $userRequestObj->status = 1;
                $userRequestObj->save();
                $message = 'تم الدفع للبطاقة المطبوعة بنجاح';
                \Session::forget('user_request_id');
            }
        }

        if($type == 'event'){
            $userEventObj = UserEvent::NotDeleted()->where('user_id',$userObj->id)->orderBy('id','DESC')->first();
            if($userEventObj != null){
                if($userEventObj->status != 2){
                    return redirect('404');
                }
                $userEventObj->status = 1;
                $userEventObj->save();
                $message = 'تم الانضمام الي الفعالية بنجاح';
            }
        }

        $userObj->status = 1;
        $userObj->is_active = 1;
        $userObj->save();
        \Session::forget('new_user_id');

        $isAdmin = in_array($userObj->group_id, [1,]) ? true : false;
        session(['group_id' => $userObj->group_id]);
        session(['user_id' => $userObj->id]);
        session(['email' => $userObj->email]);
        session(['username' => $userObj->username]);
        session(['is_admin' => $isAdmin]);
        session(['group_name' => $userObj->Group->title]);
        session(['full_name' => $userObj->name_ar]);

        \Session::forget('upgrade');
        
        if($type == 'event'){
            \Session::flash('success','لقد قمت بانضمام الي الفعالية.');
            return redirect()->to('/events/'.$userEventObj->event_id.'/');
        }else{
            UserMember::newRecord($userObj->id);
            \Session::flash('success', $message);
            return redirect()->to('/profile');
        }
    }
}
