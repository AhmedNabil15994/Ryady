<?php
use App\Models\Variable;

class PaymentHelper {
    protected $secret_key;

    function __construct() {
        $this->secret_key = Variable::getVar('SECRET_KEY');
        $this->publish_key = Variable::getVar('PUBLISH_KEY');
    }

    public function moyasar($url,$data) {  
        $url = "https://api.moyasar.com/v1/".$url;         
        return Http::withBasicAuth($this->secret_key,'')->post($url,$data);

    }

    public function formatResponse($result){
        if(isset($result['errors']) && !empty($result['errors'])){
            $extraResult = array_values($result['errors']);
            if(is_array($extraResult[0])){
                $msg = implode(',', $extraResult[0]);
            }else{
                $msg = $extraResult[0];
            }
            return [0,$msg];
        }
        return [1,''];
    }

}

