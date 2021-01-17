<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use App\Models\WebActions;
use App\Models\Project;
use App\Models\Coupon;
use App\Models\City;
use App\Models\User;
use App\Models\Photo;

class ProfileControllers extends Controller {

    use \TraitsFunc;

    protected function validateObject($input){
        $rules = [
            'title' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'city_id' => 'required',
            'category_id' => 'required',
        ];

        $message = [
            'title.required' => "يرجي ادخال العنوان",
            'address.required' => "يرجي ادخال العنوان",
            'phone.required' => "يرجي ادخال العنوان",
            'email.required' => "يرجي ادخال البريد الالكتروني",
            'city_id.required' => "يرجي ادخال العنوان",
            'category_id.required' => "يرجي ادخال العنوان",
        ];

        $validate = \Validator::make($input, $rules, $message);

        return $validate;
    }

    public function profile(){
        return view('Profile.Views.profile');
    }

    public function addProject(){
    	$data['categories'] = ProjectCategory::dataList(1)['data'];
    	$data['cities'] = City::dataList(1)['data'];
        return view('Profile.Views.addProject')->with('data',(object) $data);
    }

    public function postAddProject(Request $request){
    	$input = \Request::all();

        $validate = $this->validateObject($input);
        if($validate->fails()){
        	return \TraitsFunc::ErrorMessage($validate->messages()->first());
        }

        $availableCoupons = Coupon::availableCoupons();
        $availableCoupons = reset($availableCoupons);
        
        $coupons = explode(',', $input['coupons']);
        foreach ($coupons as $coupon) {
        	if(!in_array($coupon, $availableCoupons)){
        		return \TraitsFunc::ErrorMessage('هذا الكود ('.$coupon.') غير متاح حاليا');
        	}
        }


        $menuObj = new Project;
        $menuObj->title = $input['title'];
        $menuObj->address = $input['address'];
        $menuObj->email = $input['email'];
        $menuObj->phone = $input['phone'];
        $menuObj->city_id = $input['city_id'];
        $menuObj->category_id = $input['category_id'];
        $menuObj->brief = $input['brief'];
        $menuObj->lat = isset($input['lat']) ? $input['lat'] : '';
        $menuObj->lng = isset($input['lng']) ? $input['lng'] : '';
        if(isset($coupons) && !empty($coupons)){
            $menuObj->coupons = serialize($coupons);
        }
        $menuObj->status = 2;
        $menuObj->sort = Project::newSortIndex();
        $menuObj->created_at = DATE_TIME;
        $menuObj->created_by = USER_ID;
        $menuObj->save();


        if(!empty($input['logo'])){
        	$check = $this->uploadImage($menuObj->id,$input['logo'],'logo',$request);
        	if($check != 1){
        		return $check;
        	}
        }

        if(!empty($input['images'])){
        	$check = $this->uploadImage($menuObj->id,$input['images'],'images',$request);
        	if($check != 1){
        		return $check;
        	}
        }

        WebActions::newType(1,'Project');
        Session::flash('success','تم الحفظ بنجاح');
        return \TraitsFunc::SuccessResponse("تنبيه! تم الحفظ بنجاح");
    }

    public function uploadImage($id,$images,$type,$request){
        $menuObj = Project::getOne($id);
    	$otherImages = [];
    	if($type == 'images'){
    		for ($i=0; $i <count($images) ; $i++) { 
	            $image = \ImagesHelper::UploadImage('projects', $images[$i], $id);
	            if ($image == false) {
	                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
	            }
	            $photoObj = new Photo;
		        $photoObj->filename = $image;
		        $photoObj->imageable_type = 'App\Models\Project';
		        $photoObj->imageable_id = $id;
		        $photoObj->link = asset('/uploads').'/projects/'.$id.'/'.$image;
		        $photoObj->status = 1;
		        $photoObj->sort = Photo::newSortIndex();
		        $photoObj->created_at = DATE_TIME;
		        $photoObj->created_by = USER_ID;
		        $photoObj->save();
	            $otherImages[] = $image;
	        }
	        $menuObj->images = serialize($otherImages);
    	}else {
    		$image = \ImagesHelper::UploadImage('projects', $images, $id);
            if ($image == false) {
                return \TraitsFunc::ErrorMessage("حدث مشكلة في رفع الملفات");
            }

            $photoObj = new Photo;
	        $photoObj->filename = $image;
	        $photoObj->imageable_type = 'App\Models\Project';
	        $photoObj->imageable_id = $id;
	        $photoObj->link = asset('/uploads').'/projects/'.$id.'/'.$image;
	        $photoObj->status = 1;
	        $photoObj->sort = Photo::newSortIndex();
	        $photoObj->created_at = DATE_TIME;
	        $photoObj->created_by = USER_ID;
	        $photoObj->save();
	        $menuObj->logo = $image;
    	}
        $menuObj->save();
        return 1;
    }
}
