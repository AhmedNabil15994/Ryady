<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

    use \TraitsFunc;

    protected $table = 'projects';
    protected $primaryKey = 'id';
    public $timestamps = false;

    static function getOne($id){
        return self::NotDeleted()
            ->where('id', $id)
            ->first();
    }

    public function Creator(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

    public function City(){
        return $this->hasOne('App\Models\City','id','city_id');
    }

    public function Category(){
        return $this->hasOne('App\Models\ProjectCategory','id','category_id');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    static function getPhotoPath($id, $photo) {
        return \ImagesHelper::GetImagePath('projects', $id, $photo,false);
    }

    static function dataList($status=null,$ids=null) {
        $input = \Request::all();

        $source = self::NotDeleted()->where(function ($query) use ($input,$status,$ids) {
                    if (isset($input['title']) && !empty($input['title'])) {
                        $query->where('title', 'LIKE', '%' . $input['title'] . '%');
                    }
                    if (isset($input['address']) && !empty($input['address'])) {
                        $query->where('address', 'LIKE', '%' . $input['address'] . '%');
                    } 
                    if (isset($input['id']) && !empty($input['id'])) {
                        $query->where('id',  $input['id']);
                    } 
                    if (isset($input['phone']) && !empty($input['phone'])) {
                        $query->where('phone',  $input['phone']);
                    } 
                    if (isset($input['category_id']) && !empty($input['category_id'])) {
                        $query->where('category_id',  $input['category_id']);
                    }
                    if (isset($input['created_at']) && !empty($input['created_at'])) {
                        $query->where('created_at','>=', $input['created_at'].' 00:00:00')->where('created_at','<=',$input['created_at']. ' 23:59:59');
                    }
                    if (isset($input['city_id']) && !empty($input['city_id'])) {
                        $query->where('city_id',  $input['city_id']);
                    } 
                    if($status != null){
                        $query->where('status',$status);
                    }
                    if($ids != null){
                        $query->whereIn('id',$ids);
                    }
                })->orderBy('id','DESC');

        return self::generateObj($source);
    }

    static function generateObj($source){
        $sourceArr = $source->get();

        $list = [];
        foreach($sourceArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key] = self::getData($value);
        }

        // $data['pagination'] = \Helper::GeneratePagination($sourceArr);
        $data['data'] = $list;

        return $data;
    }

    static function getData($source) {
        $data = new  \stdClass();
        $data->id = $source->id;
        $data->title = $source->title;
        $data->address = $source->address;
        $data->phone = $source->phone;
        $data->city_id = $source->city_id;
        $data->city = $source->city_id ? $source->City->title : '';
        $data->category_id = $source->category_id;
        $data->category = $source->category_id ? $source->Category->title : '';
        $data->lat = $source->lat;
        $data->lng = $source->lng;
        $data->brief = $source->brief;
        $data->briefs = strip_tags($source->brief);
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = self::getStatus($source->status);
        $data->logo = self::getPhotoPath($source->id, $source->logo);
        $data->logo_name = $source->logo;
        $data->logo_size = $data->logo != '' ? self::getPhotoSize($data->logo) : '';
        $data->images = $source->images != '' ? self::getImages(unserialize($source->images),$source->id) : [];
        $data->created_at = \Helper::formatDate($source->created_at);
        $data->creator = $source->created_by ? $source->Creator->username : '';
        return $data;
    }

    static function getStatus($status){
        $text = '';
        if($status == 0){
            $text =  'مسودة';
        }elseif ($status == 1) {
            $text = 'مفعلة';
        }elseif ($status == 2) {
            $text = 'تم ارسال الطلب';
        }elseif ($status == 3) {
            $text = 'تم الرفض';
        }
        return $text;
    }

    static function getImages($images,$id){
        $myImages = [];
        foreach ($images as $value) {
            $dataObj = new \stdClass();
            $dataObj->photo = self::getPhotoPath($id, $value);
            $dataObj->photo_name = $value;
            $dataObj->photo_size = self::getPhotoSize($dataObj->photo);
            array_push($myImages, $dataObj);
        }
        return $myImages;
    }

    static function getPhotoSize($url){
        $image = get_headers($url, 1);
        $bytes = $image["Content-Length"];
        $mb = $bytes/(1024 * 1024);
        return number_format($mb,2) . " MB ";
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

}
