<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardPromotion extends Model{

    use \TraitsFunc;

    protected $table = 'card_promotions';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function OldMembership(){
        return $this->hasOne('App\Models\Membership','id','from_membership_id');
    }

    public function NewMembership(){
        return $this->hasOne('App\Models\Membership','id','to_membership_id');
    }

    public function UserCard(){
        return $this->hasOne('App\Models\UserCard','id','user_card_id');
    }

    static function getOne($id) {
        return self::NotDeleted()
            ->find($id);
    }

    static function dataList($status=null) {        
        $input = \Request::all();
        $source = self::NotDeleted()->where(function ($query) use ($input) {
                if (isset($input['id']) && !empty($input['id'])) {
                    $query->where('id', $input['id']);
                }
                if (isset($input['from_membership_id']) && !empty($input['from_membership_id'])) {
                    $query->where('from_membership_id', $input['from_membership_id']);
                }
                if (isset($input['to_membership_id']) && !empty($input['to_membership_id'])) {
                    $query->where('to_membership_id', $input['to_membership_id']);
                }
                if (isset($input['user_id']) && !empty($input['user_id'])) {
                    $query->where('user_id', $input['user_id']);
                }
                if (isset($input['user_card_id']) && !empty($input['user_card_id'])) {
                    $query->where('user_card_id', $input['user_card_id']);
                }
                if (isset($input['start_date']) && !empty($input['start_date'])) {
                    $query->where('start_date',  $input['start_date']);
                }
                if (isset($input['end_date']) && !empty($input['end_date'])) {
                    $query->where('end_date',  $input['end_date']);
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
        $dataObj->from_membership_id = $source->from_membership_id;
        $dataObj->to_membership_id = $source->to_membership_id;
        $dataObj->user_card_id = $source->user_card_id;
        $dataObj->code = $source->user_card_id != null ? $source->UserCard->code : '';
        $dataObj->username = $source->user_id != null ? $source->User->username : '';
        $dataObj->from_membership_name = $source->from_membership_id != null ? $source->OldMembership->title : '';
        $dataObj->to_membership_name = $source->to_membership_id != null ? $source->NewMembership->title : '';
        $dataObj->start_date = $source->start_date;
        $dataObj->end_date = $source->end_date;
        $dataObj->status = $source->status;
        $dataObj->statusText = self::getStatus($source->status);
        $dataObj->sort = $source->sort;
        $dataObj->created_at = \Helper::formatDate($source->created_at,'Y-m-d H:i:s');

        return $dataObj;
    }

    static function getStatus($status){
        $text = '';
        if($status == 1){
            $text = 'طلب جديد';
        }elseif($status == 2){
            $text = 'تم الارسال';
        }elseif($status == 3){
            $text = 'تأجيل';
        }elseif($status == 4){
            $text = 'تم التسليم';
        }elseif($status == 5){
            $text = 'تم الرد';
        }elseif($status == 6){
            $text = 'ملغية';
        }elseif($status == 7){
            $text = 'المهملات';
        }
        return $text;
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

}
