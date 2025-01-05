<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\KavenegarApi;

class SmsService {
    private $sender;
    private $api;

    public function __construct()
    {
        $apiKey = config("services.kavenegar.api_key");
        $this->sender = config("services.kavenegar.sender");

        $this->api = new KavenegarApi($apiKey, true);
    }

    public function send($receptor, $message , $sender = null ) {
        $sender = $sender ?? $this->sender;

        try {
            $result= $this->api->send($sender, $receptor, $message);
        } catch(ApiException $e) {
            Log::error("error in sending sms");
        }
    }
}
