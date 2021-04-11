<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\TopMenu;
use App\Models\Page;
use App\Models\BottomMenu;
use App\Models\SideMenu;
use App\Models\Membership;
use App\Models\Feature;
use App\Models\ProjectCategory;
use App\Models\UserMember;
use App\Models\UserCard;
use App\Models\User;
use App\Models\OrderCategory;
use App\Models\Variable;
use App\Models\Slider;
use App\Models\Benefit;
use App\Models\Order;
use App\Models\WebActions;
use App\Models\ContactUs;
use App\Models\Advantage;
use App\Models\Event;
use App\Models\UserEvent;


class HomeControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:10',//|regex:/(01)[0-9]{9}/',
            'message' => 'required',
            'address' => 'required',
        ];

        $message = [
            'name.required' => "يرجي ادخال الاسم بالكامل",
            'email.required' => "يرجي ادخال البريد الالكتروني",
            'email.email' => "يرجي ادخال بريد الكتروني متاح",
            'message.required' => "يرجي ادخال تفاصيل الرسالة",
            'address.required' => "يرجي ادخال عنوان الرسالة",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
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

    public function index()
    {   
        $data['pages'] = Page::dataList(1,[2,3,4,5])['data'];
        $data['slider'] = Slider::dataList(1)['data'];
        $data['advantages'] = Advantage::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['projectCategories'] = ProjectCategory::dataList(1)['data'];
        $data['events'] = Event::dataList(1)['data'];
        $data['userMembers'] = UserMember::dataList(1,5)['data'];
        return view('Home.Views.index')->with('data',(object) $data);
    }

    public function events(){
        $data['data'] = Event::dataList(1)['data'];
        $data['pages'] = Page::dataList(1,[3])['data'];
        return view('Home.Views.events')->with('data',(object) $data);
    }

    public function getOneEvent($id){
        $id = (int) $id;
        $eventObj = Event::getOne($id);
        if(!$eventObj){
            return redirect('404');
        }
        $data['data'] = Event::getData($eventObj);
        return view('Home.Views.event')->with('data',(object) $data);
    }

    public function getUserData($id){
        $id = (int) $id;
        $userObj = User::getOne($id);
        if(!$userObj){
            return '';
        }else{
            return \Response::json(User::getData($userObj));
        }
    }
    
    public function members(){
        $data['data'] = (object) UserMember::dataList(1,null,1);
        $data['pages'] = Page::dataList(1,[6])['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        return view('Home.Views.members')->with('data',(object) $data);
    }

    public function vip(){
        $data['data'] = (object) UserCard::dataList(1,3);
        $data['pages'] = Page::dataList(1,[7])['data'];
        return view('Home.Views.vip')->with('data',(object) $data);
    }

    public function order(){
        $data['data'] = OrderCategory::dataList(1)['data'];
        return view('Home.Views.order')->with('data',(object) $data);
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
        $menuObj->save();

        WebActions::newType(2,'Order',1);
        \Session::flash('success', 'تنبيه! تم ارسال الطلب بنجاح');
        return redirect()->back();
    }

    public function contactUs(){
        $data['email'] = Variable::getVar('البريد الإلكتروني(للرسائل):');
        $data['phone'] = Variable::getVar('رقم الهاتف:');
        $data['address'] = Variable::getVar('العنوان:');
        $data['lat'] = Variable::getVar('latitude:');
        $data['lng'] = Variable::getVar('longitude:');
        return view('Home.Views.contactUs')->with('data',(object) $data);
    }

    public function postContactUs() {
        $input = \Request::all();

        $validate = $this->validateObject($input);
        if($validate->fails()){
            \Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withInput();
        }
        $ip_address = \Request::ip();

        $faqObj = ContactUs::NotDeleted()->where('ip_address',$ip_address)->where('reply',null)->whereDate('created_at',date('Y-m-d'))->first();
        if($faqObj != null){
            \Session::flash('error', 'لقد تم ارسال الرسالة مسبقا');
            return redirect()->back()->withInput();
        }

        $menuObj = new ContactUs;
        $menuObj->name = $input['name'];
        $menuObj->email = $input['email'];
        $menuObj->phone = $input['phone'];
        $menuObj->address = $input['address'];
        $menuObj->message = $input['message'];
        $menuObj->ip_address = $ip_address;
        $menuObj->reply = null;
        $menuObj->status = 1;
        $menuObj->created_at = DATE_TIME;
        $menuObj->save();

        WebActions::newType(2,'ContactUs',1);
        \Session::flash('success', 'تنبيه! تم الارسال بنجاح');
        return redirect()->back();
    }

    public function joinUs(){
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Home.Views.joinUs')->with('data',(object) $data);
    }

    public function whoUs(){
        return view('Home.Views.whoUs');
    }

    public function joinEvent($id){
        $id = (int) $id;
        $eventObj = Event::getOne($id);
        if(!$eventObj){
            return redirect('404');
        }

        if(\Session::has('user_id')){
            $user_id = \Session::get('user_id');
        }
        
        $userObj = User::getOne($user_id);
        if(!$userObj){
            return redirect('404');
        }

        $userEventObj = UserEvent::getOneByData($user_id,$id);
        if($userEventObj){
            \Session::flash('error','انت مشترك بالفعل في هذه الفعالية');
            return redirect()->back();

        }

        $userEventObj = new UserEvent;
        $userEventObj->user_id = $user_id;
        $userEventObj->event_id = $id;
        $userEventObj->status = 2;
        $userEventObj->sort = UserEvent::newSortIndex();
        $userEventObj->created_at = DATE_TIME;
        $userEventObj->created_by = $user_id;
        $userEventObj->save();

        $names = explode(' ', $userObj->name_en ,2);
        $invoiceData = [
            'title' => $userObj->name_en,
            'cc_first_name' => $names[0],
            'cc_last_name' => isset($names[1]) ? $names[1] : '',
            'email' => $userObj->email,
            'cc_phone_number' => '',
            'phone_number' => $userObj->phone,
            'products_per_title' => 'Joining Event',
            'reference_no' => 'user-'.$userObj->id.'-'.$id,
            'unit_price' => $eventObj->price,
            'quantity' => 1,
            'amount' => $eventObj->price,
            'other_charges' => 'VAT',
            'discount' => '',
            'payment_type' => 'mastercard',
            'OrderID' => 'user-'.$userObj->id.'-'.$id,
            'SiteReturnURL' => \URL::to('/memberships/pushInvoice/'.$userObj->id.'/event'),
        ];
        // dd($invoiceData);
        $paymentObj = new \PaymentHelper();        
        return $paymentObj->RedirectWithPostForm($invoiceData);
    }

    public function postNewEventUser($id){
        $id = (int) $id;
        $input = \Request::all();
        $nameArArr = explode(' ', $input['name_ar']);
        if(count($nameArArr) != 3){
            \Session::flash('error', 'يرجي ادخال الاسم العربي ثلاثي');
            return redirect()->back()->withInput();
        }

        $nameEnArr = explode(' ', $input['name_en']);
        if(count($nameEnArr) != 3){
            \Session::flash('error', 'يرجي ادخال الاسم الانجليزي ثلاثي');
            return redirect()->back()->withInput();
        }

        $userObj = User::checkUserByEmail($input['email']);
        if(!$userObj){
            $userObj = User::checkUserByPhone($input['phone']);
        }

        if(!$userObj){
            $userObj = new User;
            $userObj->name_ar = $input['name_ar'];
            $userObj->name_en = $input['name_en'];
            $userObj->username = $input['name_en'];
            $userObj->email = $input['email'];
            $userObj->password = \Hash::make($input['password']);
            $userObj->group_id = 3;
            $userObj->gender = $input['gender'];
            $userObj->phone = $input['phone'];
            $userObj->show_details = 0;
            $userObj->lang = 0;
            $userObj->status = 0;
            $userObj->is_active = 0;
            $userObj->sort = User::newSortIndex();
            $userObj->created_at = DATE_TIME;
            $userObj->created_by = 0;
            $userObj->save();
        }

        \Session::put('user_id',$userObj->id);
        return $this->joinEvent($id);
    }
}
