<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\facades\DB;
use Illuminate\Support\facades\Log;
use App\Events\LoginHistory;
use App\Models\User;
use Carbon\Carbon;

class StoreUserLoginHistory
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
     * @param  object  $event
     * @return void
     */
    public function handle(LoginHistory $event)
    {
        // $current_timestamp = Carbon::now()->toDateTimeString();
        // $userInfo = $event->user;

        // $saveHistory = DB::table('login_history')->insert([
        //     'email' => $userInfo->email,
        //     'created_at' => $current_timestamp,
        //     'updated_at' => $current_timestamp
        // ]);

        // return $saveHistory;

        Log::info("User registretion process running...", [$event->user]);
    }
}
