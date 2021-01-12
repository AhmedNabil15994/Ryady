<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\TopMenu;
use App\Models\Page;
use App\Models\BottomMenu;
use App\Models\SideMenu;
use App\Models\Membership;

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
        $data['pages'] = Page::dataList(1,[2,3,4,5])['data'];
        $data['slider'] = Slider::dataList(1)['data'];
        $data['advantages'] = Advantage::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $tele = Variable::getVar('رقم الهاتف:');
        $tele2 = Variable::getVar('رقم الواتس اب:');
        return view('Home.Views.index')->with('data',(object) $data);
    }
    
    public function memberShip(){
        $data['benefits'] = Benefit::dataList(1)['data'];
        return view('Home.Views.memberShip')->with('data',(object) $data);
    }

    public function requestMemberShip(){
        return view('Home.Views.requestMemberShip');
    }

    public function profile(){
        return view('Home.Views.profile');
    }

    public function members(){
        $data['pages'] = Page::dataList(1,[6])['data'];
        return view('Home.Views.members')->with('data',(object) $data);
    }

    public function membersProjects(){
        return view('Home.Views.membersProjects');
    }

    public function project(){
        return view('Home.Views.project');
    }

    public function blogs(){        
        return view('Home.Views.blogs');
    }

    public function blogDetails(){
        return view('Home.Views.blogDetails');
    }

    public function addProject(){
        return view('Home.Views.addProject');
    }

    public function contactUs(){
        return view('Home.Views.contactUs');
    }

    public function vip(){
        return view('Home.Views.vip');
    }

    public function order(){
        return view('Home.Views.order');
    }

    public function packageFeatures(){
        return view('Home.Views.vip');
    }

}
