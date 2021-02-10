<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model{

    use \TraitsFunc;

    protected $table = 'blogs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    static function getOne($id){
        return self::NotDeleted()
            ->where('id', $id)
            ->first();
    }

    public function Category(){
        return $this->hasOne('App\Models\BlogCategory','id','category_id');
    }

    public function Creator(){
        return $this->hasOne('App\Models\User','id','created_by');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    static function getPhotoPath($id, $photo) {
        return \ImagesHelper::GetImagePath('blogs', $id, $photo,false);
    }

    static function dataList($status=null,$ids=null,$category_id=null,$notInIds=null,$count = null) {
        $input = \Request::all();

        $source = self::NotDeleted()->where(function ($query) use ($input,$status,$ids,$category_id,$notInIds) {
                    if (isset($input['title']) && !empty($input['title'])) {
                        $query->where('title', 'LIKE', '%' . $input['title'] . '%');
                    } 
                    if (isset($input['description']) && !empty($input['description'])) {
                        $query->where('description', 'LIKE', '%' . $input['description'] . '%');
                    } 
                    if (isset($input['category_id']) && !empty($input['category_id'])) {
                        $query->where('category_id',  $input['category_id']);
                    } 
                    if (isset($input['status']) && !empty($input['status'])) {
                        $query->where('status',  $input['status']);
                    } 
                    if (isset($input['created_at']) && !empty($input['created_at'])) {
                        $query->where('created_at','>=', $input['created_at'].' 00:00:00')->where('created_at','<=',$input['created_at']. ' 23:59:59');
                    }
                    if($status != null){
                        $query->where('status',$status);
                    }
                    if($category_id != null){
                        $query->where('category_id',$category_id);
                    }
                    if($ids != null){
                        $query->whereIn('id',$ids);
                    }
                    if($notInIds != null){
                        $query->whereNotIn('id',$notInIds);
                    }
                })->orderBy('id','DESC');

        if($count != null){
            $source->take($count)->inRandomOrder();
        }

        return self::generateObj($source);
    }

    static function generateObj($source){
        $sourceArr = $source->paginate(PAGINATION);

        $list = [];
        foreach($sourceArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key] = self::getData($value);
        }

        $data['pagination'] = \Helper::GeneratePagination($sourceArr);
        $data['data'] = $list;

        return (object)$data;
    }

    static function getData($source) {
        $data = new  \stdClass();
        $data->id = $source->id;
        $data->title = $source->title;
        $data->title2 = str_split($source->title, 50)[0].' ...';
        $data->category_id = $source->category_id;
        $data->category = $source->category_id ? $source->Category->title : '';
        $data->views = $source->views != null ? $source->views : 0;
        $data->description = $source->description;
        $data->description2 = str_split(strip_tags($source->description), 200)[0];
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = self::getStatus($source->status);
        $data->fileType = $source->fileType;
        $data->photo = self::getPhotoPath($source->id, $source->file);
        $data->photo_name = $source->file;
        $data->photo_size = $data->photo != '' ? self::getPhotoSize($data->photo) : '';
        $data->creator = $source->created_by ? $source->Creator->name_ar : '';
        $data->creator_photo = $source->created_by ? User::getData($source->Creator)->photo : '';
        $data->created_at = \Helper::formatDate($source->created_at,'d - m - Y');
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

    static function getPhotoSize($url){
        if($url == "" || !is_file($url)){
            return '';
        }
        $image = get_headers($url, 1);
        $bytes = $image["Content-Length"];
        $mb = $bytes/(1024 * 1024);
        return number_format($mb,2) . " MB ";
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

}
