<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model{

    use \TraitsFunc;

    protected $table = 'coupons';
    protected $primaryKey = 'id';
    public $timestamps = false;

    static function getOne($id){
        return self::NotDeleted()
            ->where('id', $id)
            ->first();
    }

    static function dataList($status=null) {
        $input = \Request::all();

        $source = self::NotDeleted()->where(function ($query) use ($input,$status) {
                    if (isset($input['code']) && !empty($input['code'])) {
                        $query->where('code', 'LIKE', '%' . $input['code'] . '%');
                    } 
                    if (isset($input['id']) && !empty($input['id'])) {
                        $query->where('id',  $input['id']);
                    } 
                    if (isset($input['discount_type']) && !empty($input['discount_type'])) {
                        $query->where('discount_type',  $input['discount_type']);
                    } 
                    if (isset($input['discount_value']) && !empty($input['discount_value'])) {
                        if (strpos($input['discount_value'], '||') !== false) {
                            $arr = explode('||', $input['discount_value']);
                            $min = (int) $arr[0];
                            $max = (int) $arr[1];
                            $query->where('discount_value','>=',$min)->where('discount_value','<=',$max);
                        }else{
                            $query->where('discount_value',$input['discount_value']);
                        }
                    } 
                    if (isset($input['valid_type']) && !empty($input['valid_type'])) {
                        $query->where('valid_type',  $input['valid_type']);
                    } 
                    if (isset($input['valid_value']) && !empty($input['valid_value'])) {
                        $query->where('valid_value',  $input['valid_value']);
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
        $data->code = $source->code;
        $data->discount_type = $source->discount_type;
        $data->discount_value = $source->discount_value;
        $data->valid_type = $source->valid_type;
        $data->valid_value = $source->valid_value;
        $data->discount_typeText = $source->discount_type == 1 ? 'قيمة محددة' : 'نسبة مئوية';
        $data->valid_typeText = $source->valid_type == 1 ? 'عدد مرات استخدام' : 'تاريخ معين';
        $data->sort = $source->sort;
        $data->status = $source->status;
        $data->statusText = $source->status == 0 ? 'مسودة' : 'مفعلة';
        $data->created_at = \Helper::formatDateForDisplay($source->created_at,true);
        return $data;
    }

    static function newSortIndex(){
        return self::count() + 1;
    }

    static function checkCouponByCode($code, $notId = false){
        $dataObj = self::NotDeleted()->where('code',$code);

        if ($notId != false) {
            $notId = (array) $notId;
            $dataObj->whereNotIn('id', $notId);
        }

        return $dataObj->first();
    }

}
