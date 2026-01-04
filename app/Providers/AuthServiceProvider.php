<?php

namespace App\Providers;

use App\Models\Listing;
use App\Policies\ListingPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\DatabaseNotification;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        Listing::class => ListingPolicy::class,
        
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot(): void
    {
        Gate::define('view-notification', function ($user, DatabaseNotification $notification) {
        return $notification->notifiable_id === $user->id;
        });

        Gate::define('delete-notification', function ($user, DatabaseNotification $notification) {
            return $notification->notifiable_id === $user->id;
        });
    }
}
