<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Feature;
use App\Models\Benefit;
use App\Models\Advantage;
use App\Models\Target;


class MembershipControllers extends Controller {

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


    public function index(){
        $data['advantages'] = Advantage::dataList(1)['data'];
        $data['benefits'] = Benefit::dataList(1)['data'];
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['targets'] = Target::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.index')->with('data',(object) $data);
    }

    public function requestMemberShip($id){
        $id = (int) $id;
        return view('Membership.Views.requestMemberShip');
    }

    public function features(){
        $data['memberships'] = Membership::dataList(1)['data'];
        $data['features'] = Feature::dataList(1)['data'];
        return view('Membership.Views.features')->with('data',(object) $data);
    }

}
