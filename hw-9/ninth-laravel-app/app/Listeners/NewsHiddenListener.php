<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Log;

class NewsHiddenListener
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



    public function handle(NewsHidden $event)
    {
        Log::info('News ' . $event->news->id . ' hidden');
    }
//    public function handle(object $event): void
//    {
//        //
//    }
}
