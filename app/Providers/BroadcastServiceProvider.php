<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        $this->loadChannels();
    }

    /**
     * Load the channel definitions.
     */
    protected function loadChannels()
    {
        require base_path('routes/channels.php');
    }
}
