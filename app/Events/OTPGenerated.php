<?php

namespace App\Events;

use App\Models\OTP;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OTPGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $otp;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, OTP $otp)
    {
        //
        $this->user = $user;
        $this->otp = $otp;
    }
}
