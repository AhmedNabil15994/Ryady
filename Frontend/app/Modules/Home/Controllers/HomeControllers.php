<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\TopMenu;
use App\Models\Page;
use App\Models\BottomMenu;
use App\Models\SideMenu;

use App\Models\Slider;
use App\Models\Benefit;
use App\Models\ContactUs;
use App\Models\Advantage;
use App\Models\Variable;
use App\Models\WebActions;
use App\Models\Order;
use App\Models\City;

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
            'identity' => 'required',
            'address' => 'required',
            'city' => 'required',
        ];

        $message = [
            'name.required' => "يرجي ادخال الاسم بالكامل",
            'phone.required' => "يرجي ادخال رقم الجوال",
            'phone.min' => "رقم الجوال يجب ان يكون 10 خانات",
            'identity.required' => "يرجي ادخال رقم الهوية او جواز السفر",
            'address.required' => "يرجي ادخال العنوان",
            'city.required' => "يرجي اختيار المدينة",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function index()
    {   
    	$data['topMenu'] = TopMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['bottomMenu'] = BottomMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
    	$data['sideMenu'] = SideMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['privacyContent'] = Page::NotDeleted()->where('status',1)->where('title','سياسة الخصوصية')->first();
        $data['pages'] = Page::dataList(1,[2,3,4,5])['data'];
        $data['slider'] = Slider::dataList(1)['data'];
        $data['advantages'] = Advantage::dataList(1)['data'];

    	// $data['sliders'] = Slider::dataList(1)['data'];
    	// $data['cities'] = City::dataList(1)['data'];
    	$data['tele'] = Variable::getVar('رقم الهاتف:');
    	$data['tele2'] = Variable::getVar('رقم الواتس اب:');
    	$data['title'] = Variable::getVar('العنوان عربي');
    	$data['desc'] = Variable::getVar('الوصف عربي');

    	$meta = Variable::getVar('الكلمات الدليلية عربي');
    	$data['meta'] = json_decode($meta)[0]->value;
        return view('Home.Views.index')->with('data',(object) $data);
    }
    
    public function memberShip(){
        $data['topMenu'] = TopMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['bottomMenu'] = BottomMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['sideMenu'] = SideMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['privacyContent'] = Page::NotDeleted()->where('status',1)->where('title','سياسة الخصوصية')->first();
        $data['benefits'] = Benefit::dataList(1)['data'];
        return view('Home.Views.memberShip')->with('data',(object) $data);
    }

    public function requestMemberShip(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.requestMemberShip')->with('data',(object) $data);
    }

    public function profile(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.profile')->with('data',(object) $data);
    }

    public function members(){
        $data['topMenu'] = TopMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['bottomMenu'] = BottomMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['sideMenu'] = SideMenu::NotDeleted()->where('status',1)->orderBy('sort','ASC')->get();
        $data['privacyContent'] = Page::NotDeleted()->where('status',1)->where('title','سياسة الخصوصية')->first();
        $data['pages'] = Page::dataList(1,[6])['data'];
        return view('Home.Views.members')->with('data',(object) $data);
    }

    public function membersProjects(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.membersProjects')->with('data',(object) $data);
    }

    public function project(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.project')->with('data',(object) $data);
    }

    public function blogs(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.blogs')->with('data',(object) $data);
    }

    public function blogDetails(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.blogDetails')->with('data',(object) $data);
    }

    public function addProject(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.addProject')->with('data',(object) $data);
    }

    public function contactUs(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.contactUs')->with('data',(object) $data);
    }

    public function vip(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.vip')->with('data',(object) $data);
    }

    public function order(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.order')->with('data',(object) $data);
    }

    public function packageFeatures(){
        $data['privacyContent'] =(object) ['description'=>''];
        return view('Home.Views.vip')->with('data',(object) $data);
    }

}
