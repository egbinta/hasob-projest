<?php

namespace App\Listeners;

use App\Events\AssetRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\facades\Log;

class StoreRegisterdAsset
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
     * @param  \App\Events\AssetRegistered  $event
     * @return void
     */
    public function handle(AssetRegistered $event)
    {
        Log::info('Asset registration completed...', [$event->asset]);
    }
}
