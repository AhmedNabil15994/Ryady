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


class HomeControllers extends Controller {

    use \TraitsFunc;

    public function index()
    {   
        $data['projectCategories'] = ProjectCategory::dataList(1)['data'];
        $data['userMembers'] = UserMember::dataList(1,8)['data'];
        $data['userMembers2'] = UserMember::dataList(1,5)['data'];
        return view('Home.Views.index')->with('data',(object) $data);
    }

    public function home()
    {   
        $data['pages'] = Page::dataList(1,[2])['data'];
        return view('Home.Views.home')->with('data',(object) $data);
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

    public function members(){
        $data['data'] = (object) UserMember::dataList(1);
        return view('Home.Views.members')->with('data',(object) $data);
    }

    public function vip(){
        $data['data'] = (object) UserCard::dataList(1,3);
        return view('Home.Views.vip')->with('data',(object) $data);
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

    public function login() {
        if(\Session::has('user_id')){
            return redirect('/profile');
        }
        return view('Auth.Views.login');
    }

}
