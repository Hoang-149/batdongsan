<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('includes.header', function ($view) {
            $notifications = auth()->check() ? auth()->user()->unreadNotifications : collect();
            $view->with('notifications', $notifications);
        });
    }
}
