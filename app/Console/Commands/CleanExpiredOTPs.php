<?php

namespace App\Console\Commands;

use App\Models\OTP;
use Illuminate\Console\Command;

class CleanExpiredOTPs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean expired OTPs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        OTP::where("expires_at", "<", now())->delete();
        $this->info("Expired OTPs have been cleaned!");
    }
}
