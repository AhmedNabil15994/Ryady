<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\TopMenu;
use App\Models\Page;
use App\Models\BottomMenu;
use App\Models\SideMenu;
use App\Models\Membership;
use App\Models\ProjectCategory;
use App\Models\UserMember;
use App\Models\User;

use App\Models\Slider;
use App\Models\Benefit;
use App\Models\ContactUs;
use App\Models\Advantage;


class ProfileControllers extends Controller {

    use \TraitsFunc;

    public function profile(){
        return view('Profile.Views.profile');
    }

    public function addProject(){
        return view('Profile.Views.addProject');
    }


}
