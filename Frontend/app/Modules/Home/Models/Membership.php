<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model{

    use \TraitsFunc;

    protected $table = 'memberships';
    protected $primaryKey = 'id';
    public $timestamps = false;

    static function getOne($id){
        return self::NotDeleted()
            ->where('id', $id)
            ->first();
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    static function getPhotoPath($id, $photo) {
        return \ImagesHelper::GetImagePath('memberships', $id, $photo,false);
    }

    static function dataList($status=null,$ids=null) {
        $input = \Request::all();

        $source = self::NotDeleted();

        if (isset($input['title']) && !empty($input['title'])) {
            $source->where('title', 'LIKE', '%' . $input['title'] . '%');
        } 
        if (isset($input['id']) && !empty($input['id'])) {
            $source->where('id',  $input['id']);
        } 
        if(isset($input['price']) && !empty($input['price'])){
            if (strpos($input['price'], '||') !== false) {
                $arr = explode('||', $input['price']);
                $min = (int) $arr[0];
                $max = (int) $arr[1];
                $source->where('price','>=',$min)->where('price','<=',$max);
            }else{
                $source->where('price',$input['price']);
            }
        }
        if($status != null){
            $source->where('status',$status);
        }
        if($ids != null){
            $source->whereIn('id',$ids);
        }    

        $source->orderBy('sort','ASC');

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

    static function getYears($number){
        $text = '';
        if($number == 1){
            $text = 'سنة';
        }elseif($number == 2){
            $text = 'سنتين';
        }else{
            $text = $number.' سنوات';
        }
        return $text;
    }

    static function getData($source) {
        $data = new  \stdClass();
        $data->id = $source->id;
        $data->title = $source->title;
        $data->price = $source->price != null ? $source->price : '';
        $data->period = $source->period;
        $data->periodText = self::getYears($source->period); 
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = $source->status == 0 ? 'مسودة' : 'مفعلة';
        $data->photo = self::getPhotoPath($source->id, $source->image);
        $data->photo_name = $source->image;
        $data->photo_size = $data->photo != '' ? self::getPhotoSize($data->photo) : '';
        $data->created_at = \Helper::formatDateForDisplay($source->created_at,true);
        return $data;
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
