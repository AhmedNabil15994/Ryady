<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model{

    use \TraitsFunc;

    protected $table = 'user_events';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

     public function Event(){
        return $this->hasOne('App\Models\Event','id','event_id');
    }

    static function getOne($id) {
        return self::NotDeleted()
            ->find($id);
    }

    static function getOneByData($user_id,$event_id){
        return self::NotDeleted()->where('user_id',$user_id)->where('event_id',$event_id)->first();
    }

    static function dataList($status=null) {        
        $input = \Request::all();
        $source = self::NotDeleted()->where(function ($query) use ($input) {
                if (isset($input['id']) && !empty($input['id'])) {
                    $query->where('id', $input['id']);
                }
                if (isset($input['user_id']) && !empty($input['user_id'])) {
                    $query->where('user_id', $input['user_id']);
                }
                if (isset($input['event_id']) && !empty($input['event_id'])) {
                    $query->where('event_id', $input['event_id']);
                }
                if (isset($input['status']) && !empty($input['status'])) {
                    $query->where('status', $input['status']);
                }
                if (isset($input['created_at']) && !empty($input['created_at'])) {
                    $query->where('created_at','>=', $input['created_at'].' 00:00:00')->where('created_at','<=',$input['created_at']. ' 23:59:59');
                }
            });
        if($status != null){
            $source->where('status',$status);
        }
        $source->orderBy('id','DESC');
        return self::getObj($source);
    }

    static function getObj($source) {
        $sourceArr = $source->get();

        $list = [];
        foreach ($sourceArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key] = self::getData($value);
        }

        $data['data'] = $list;
        return $data;
    }



    static function getData($source) {
        $dataObj = new \stdClass();
        $dataObj->id = $source->id;
        $dataObj->user_id = $source->user_id;
        $dataObj->event_id = $source->event_id;
        $dataObj->user = $source->User ? User::getData($source->User) : '';
        $dataObj->event = $source->Event ? User::getData($source->Event) : '';
        $dataObj->status = $source->status;
        $dataObj->statusText = self::getStatus($source->status);
        $dataObj->sort = $source->sort;
        $dataObj->created_at = \Helper::formatDate($source->created_at,'Y-m-d H:i:s');

        return $dataObj;
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

}
