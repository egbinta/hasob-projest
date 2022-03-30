<?php

namespace App\Listeners;

use App\Events\AssetAssignmentRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class StoreRegisterdAssetAssignment
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
     * @param  \App\Events\AssetAssignmentRegistered  $event
     * @return void
     */
    public function handle(AssetAssignmentRegistered $event)
    {
        Log::info('Asset Assignment registration completed', [$event->assetAssignment]);
    }
}
