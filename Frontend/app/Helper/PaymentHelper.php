<?php
use App\Models\Variable;

class PaymentHelper {
    protected $secret_key;

    function __construct() {
        $this->secret_key = Variable::getVar('SECRET_KEY');
    }

    public function payTabs($data) {  
        $url = "https://pay.servers.com.sa/api/v1/payment";            
        return Http::withToken($this->secret_key)
               ->post($url,$data);

    }

}
