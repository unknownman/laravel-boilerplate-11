<?php

namespace App\Http\Controllers;

use App\Events\OTPGenerated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Inertia;

class AuthMobileLoginController extends Controller
{
    //

    public function view()
    {
        return Inertia::render("Auth/View");
    }

    public function sendOTP(Request $request)
    {
        $user = User::where("mobile", $request->mobile)->firstOrFail();
        // if (RateLimiter::tooManyAttempts("otp-{$user->id}", 5)) {
        //     return redirect("/login");
        // }
        // RateLimiter::hit("otp-{$user->id}", 250);
        $user->otps()->create();
        Event::dispatch(new OTPGenerated($user, $user->otps->last()));
        return Inertia::render("Auth/VerifyMobile", compact("user"));
    }

    public function verifyOtp(Request $request)
    {
        $user = User::where("mobile", $request->mobile)->firstOrFail();
        $otp = $user->otps()->active()->where("code", $request->otp)->first();
        if (!$otp) {
            return redirect("/auth/mobile")->with(['error' => 'login failed']);
        }

        DB::beginTransaction();
        try {
            $user->is_verified_mobile = 1;
            $otp->is_used = true;
            $user->save();
            $otp->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        auth()->login($user);
        return redirect()->route("dashboard");
    }
}
