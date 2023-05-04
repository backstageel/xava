<?php

namespace App\Listeners;


use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Support\Facades\Artisan;

class EnsureDatabaseStatesAreLoaded
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


    public function handle(MigrationsEnded $event)
    {
        Artisan::call('ensure-database-state-is-loaded');
    }
}
