<?php

namespace App\Listeners;

use App\Events\TagCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class sendTagNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TagCreated $event): void
    {
        //
        Log::channel("single")->info("برچسب جدید اضافه شد : ". $event->tag->name);
    }
}
