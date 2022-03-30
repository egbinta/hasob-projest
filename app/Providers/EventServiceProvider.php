<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\LoginHistory::class=> [
            \App\Listeners\StoreUserLoginHistory::class,
        ],
        \App\Events\AssetRegistered::class=> [
            \App\Listeners\StoreRegisterdAsset::class,
        ],
        \App\Events\VendorRegistered::class=> [
            \App\Listeners\StoreRegisterdVendor::class,
        ],
        \App\Events\AssetAssignmentRegistered::class=> [
            \App\Listeners\StoreRegisterdAssetAssignment::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
