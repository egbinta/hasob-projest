<?php

namespace App\Listeners;

use App\Events\VendorRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class StoreRegisterdVendor
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
     * @param  \App\Events\VendorRegistered  $event
     * @return void
     */
    public function handle(VendorRegistered $event)
    {
        Log::info('Vendor registration cpmpleted...', [$event->vendor]);
    }
}
