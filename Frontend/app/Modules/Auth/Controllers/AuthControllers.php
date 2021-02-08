<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LoginHistory;
use App\Models\BlockedUser;
use App\Models\Variable;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class AuthControllers extends Controller {

    use \TraitsFunc;

	public function doLogin() {

        $input = \Request::all();
        $attempts = session()->get('login.attempts', 0);
        $rules = array(
            'password' => 'required',
            'phone' => 'required',
        );

        $message = array(
            'password.required' => "يرجي ادخال كلمة المرور",
            'phone.required' => "يرجي ادخال رقم الجوال",
        );

        $validate = \Validator::make($input, $rules,$message);
        
        if($validate->fails()){
            return \TraitsFunc::ErrorMessage($validate->messages()->first());
        }
       
        $userObj = User::getLoginUser($input['phone']);

        if ($userObj == null) {
            return \TraitsFunc::ErrorMessage("هذا المستخدم غير موجود او غير مفعل");
        }

        $checkPassword = Hash::check($input['password'], $userObj->password);

        if ($checkPassword == null) {
            return \TraitsFunc::ErrorMessage("كلمة المرور غير صحيحة");
        }

        $username = $userObj->username;
        $blockedUser = BlockedUser::checkForUsername($username,\Request::ip());
        if($blockedUser){
            return \TraitsFunc::ErrorMessage("تم حظر هذا المستخدم. يرجي الانتظار حتي: ".$blockedUser->ended_at);
        }

        $isAdmin = in_array($userObj->group_id, [1,]) ? true : false;

        $session_time = (int) $userObj->session_time ? $userObj->session_time : Variable::getVar('وقت قفل الشاشه:');
        $endedTime = date('Y-m-d H:i:s', strtotime('+'.$session_time. ' minutes', strtotime(DATE_TIME)));

        $dataObj = new \stdClass();
        $dataObj->email = $userObj->email;
        $dataObj->group_id = (int) $userObj->group_id;

        session(['group_id' => $dataObj->group_id]);
        session(['user_id' => $userObj->id]);
        session(['email' => $dataObj->email]);
        session(['username' => $userObj->username]);
        session(['is_admin' => $isAdmin]);
        session(['full_name' => $userObj->name_ar]);
        // session(['group_name' => $userObj->Group->title]);

        $now = now()->format('Y-m-d H:i:s');

        $check = LoginHistory::checkForUsername($userObj->username);
        if($check){
            if($check->to_date <= $now){
                $check->ended = 1;
                $check->save();
                LoginHistory::insert([
                    'username' => $userObj->username,
                    'from_date' => $now,
                    'to_date' => $endedTime,
                    'sort'  => LoginHistory::newSortIndex(),
                    'ended' => 0,
                    'created_at' => $now,
                    'created_by' => $userObj->id,
                ]);
            }
        }else{
            LoginHistory::insert([
                'username' => $userObj->username,
                'from_date' => $now,
                'to_date' => $endedTime,
                'sort'  => LoginHistory::newSortIndex(),
                'ended' => 0,
                'created_at' => $now,
                'created_by' => $userObj->id,
            ]);
        }

        \Session::flash('success', "اهلا بك في الشاب الريادي " . $userObj->name_ar);
        return \TraitsFunc::SuccessResponse("اهلا بك في الشاب الريادي " . $userObj->name_ar);
	}

    public function checkFailAttempts($attempts,$username){
        $newNumber = $attempts + 1; 
        session()->put('login.attempts', $newNumber);
        if($newNumber == 3 && $username){
            $now = now()->format('Y-m-d H:i:s');
            $banPeriod = Variable::getVar('مدة الحظر:');
            $endedTime = date('Y-m-d H:i:s', strtotime('+'.$banPeriod. ' minutes', strtotime($now)));
            BlockedUser::insert([
                'username' => $username,
                'ip_address' => \Request::ip(),
                'ended_at' => $endedTime,
                'sort' => BlockedUser::newSortIndex(),
                'created_at' => $now,
            ]);
        }
    }

	public function logout() {
        \Auth::logout();
        LoginHistory::where('username',\Session::get('username'))->where('ended',0)->update([
            'ended' => 1,
            'to_date' => now()->format('Y-m-d H:i:s'),
        ]);
        session()->flush();
        \Session::flash('success', "نراك قريبا ;)");
        return redirect('/');
	}
}
