<?php

namespace App\Listeners;

use App\Events\OTPGenerated;
use App\Services\SmsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOTP
{
    protected $smsService;
    /**
     * Create the event listener.
     */
    public function __construct(SmsService $service)
    {
        //
        $this->smsService = $service;
    }

    /**
     * Handle the event.
     */
    public function handle(OTPGenerated $event): void
    {
        //
        $message = "کد تایید شما : {$event->otp->code}";
        $response = $this->smsService->send($event->user->mobile, $message);
    }
}
