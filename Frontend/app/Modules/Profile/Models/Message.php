<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model{

    use \TraitsFunc;

    protected $table = 'messages';
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

    static function dataList($mine=null) {
        $input = \Request::all();

        $source = self::NotDeleted();
        if($mine != null){
            $source->where('user_id',USER_ID);
        }
        $source->orderBy('id','DESC');
        return self::generateObj($source);
    }

    static function generateObj($source,$withPaginate=null){
        if($withPaginate != null){
            $sourceArr = $source->get();
        }else{
            $sourceArr = $source->paginate(16);
        }

        $list = [];
        foreach($sourceArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key] = self::getData($value);
        }
        if($withPaginate == null){
            $data['pagination'] = \Helper::GeneratePagination($sourceArr);
        }
        $data['data'] = $list;

        return $data;
    }

    static function getData($source) {
        $data = new  \stdClass();
        $data->id = $source->id;
        $data->message = $source->message;
        $data->user_id = $source->user_id;
        $data->user = $source->user_id != null ? User::getData($source->User) : '';
        $data->creator = $source->created_by != null ? User::getData($source->Creator) : '';        
        $data->created_at = \Helper::formatDate($source->created_at);
        return $data;
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
