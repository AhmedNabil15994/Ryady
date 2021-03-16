<?php namespace App\Http\Middleware;

use App\Models\Users;
use Closure;
use Illuminate\Support\Facades\Session;

class AuthEngine {

    public function handle($request, Closure $next){
        if ($request->segment(1) == null && !(USER_ID && USER_ID != '')) {
            \Auth::logout();
            session()->flush();

            \Session::flash('error', "يرجي تسجيل الدخول اولا!");
            return Redirect()->to('/');
        }

        if (in_array($request->segment(1), ['profile'])) {
            if (in_array($request->segment(2), ['login','logout','sendResetCode','checkCode','resetPassword'])) {
                return $next($request);
            }
        }

        define('USER_ID', Session::get('user_id'));
        if (!(USER_ID && USER_ID != '')) {
            \Auth::logout();
            session()->flush();

            \Session::flash('error', "يرجي تسجيل الدخول اولا!");
            return Redirect()->to('/');
        }

        define('FIRST_NAME', Session::get('first_name'));
        define('LAST_NAME', Session::get('last_name'));
        define('FULL_NAME', Session::get('full_name'));
        
        return $next($request);
    }
}
