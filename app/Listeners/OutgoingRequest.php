<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Events\RequestSent;
use Illuminate\Queue\InteractsWithQueue;

class OutgoingRequest
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Http\Events\RequestSent  $event
     * @return void
     */
    public function handle(RequestSent $event)
    {
        //
    }
}
