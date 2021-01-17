<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCard extends Model{

    use \TraitsFunc;

    protected $table = 'user_cards';
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

    public function MemberShip(){
        return $this->hasOne('App\Models\Membership','id','membership_id');
    }

    static function dataList($status=null,$membership_id=null) {
        $input = \Request::all();

        $source = self::NotDeleted()->where(function ($query) use ($input,$status,$membership_id) {
                    if (isset($input['name_ar']) && !empty($input['name_ar'])) {
                        $query->where('name_ar', 'LIKE', '%' . $input['name_ar'] . '%');
                    } 
                    if (isset($input['name_en']) && !empty($input['name_en'])) {
                        $query->where('name_en', 'LIKE', '%' . $input['name_en'] . '%');
                    }
                    if (isset($input['membership_id']) && !empty($input['membership_id'])) {
                        $query->where('membership_id',  $input['membership_id']);
                    }  
                    if (isset($input['code']) && !empty($input['code'])) {
                        $query->where('code',  $input['code']);
                    }
                    if (isset($input['start_date']) && !empty($input['start_date'])) {
                        $query->where('start_date',  $input['start_date']);
                    }
                    if (isset($input['end_date']) && !empty($input['end_date'])) {
                        $query->where('end_date',  $input['end_date']);
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
                    if($membership_id != null){
                        $query->where('membership_id',$membership_id);
                    }
                })->orderBy('sort','ASC');

        return self::generateObj($source);
    }

    static function generateObj($source){
        $sourceArr = $source->paginate(15);

        $list = [];
        foreach($sourceArr as $key => $value) {
            $list[$key] = new \stdClass();
            $list[$key] = self::getData($value);
        }

        $data['pagination'] = \Helper::GeneratePagination($sourceArr);
        $data['data'] = $list;

        return $data;
    }

    static function getData($source) {
        $data = new  \stdClass();
        $data->id = $source->id;
        $data->user_id = $source->user_id;
        $data->username = $source->user_id != null ? $source->User->username : '';
        $data->user = $source->user_id != null ? User::getData($source->User) : '';
        $data->name_ar = $source->user_id != null ? $source->User->name_ar : '';
        $data->name_en = $source->user_id != null ? $source->User->name_en : '';
        $data->code = $source->code;
        $data->membership_id = $source->membership_id;
        $data->start_date = $source->start_date;
        $data->end_date = $source->end_date;
        $data->membership_name = $source->membership_id != null ? $source->Membership->title : '';
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = self::getStatus($source->status);
        $data->created_at = \Helper::formatDateForDisplay($source->created_at,true);
        return $data;
    }

    static function newSortIndex(){
        return self::count() + 1;
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

    static function getNewCode(){
        $code = '000001';
        $lastCode = self::orderBy('id','DESC')->first();
        if($lastCode != null){
            $code = str_pad(intval($lastCode->code) + 1, strlen($lastCode->code), '0', STR_PAD_LEFT);
        }
        return $code;
    }

}
