<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMember extends Model{

    use \TraitsFunc;

    protected $table = 'user_members';
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

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    static function dataList($status=null) {
        $input = \Request::all();

        $source = self::NotDeleted()->where(function ($query) use ($input,$status) {
                    if (isset($input['user_id']) && !empty($input['user_id'])) {
                        $query->where('user_id',  $input['user_id']);
                    } 
                    if (isset($input['id']) && !empty($input['id'])) {
                        $query->where('id',  $input['id']);
                    } 
                    if (isset($input['status']) && !empty($input['status'])) {
                        $query->where('status',  $input['status']);
                    } 
                    if($status != null){
                        $query->where('status',$status);
                    }
                })->orderBy('sort','ASC');

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
        $data->user_id = $source->user_id;
        $data->username = $source->user_id != null ? $source->User->username : '';
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = self::getStatus($source->status);
        $data->created_at = \Helper::formatDate($source->created_at);
        return $data;
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

    static function getStatus($status){
        $text = '';
        if($status == 0){
            $text =  'غير مفعل';
        }elseif ($status == 1) {
            $text = 'مفعل';
        }
        return $text;
    }

}
