<?php

namespace App\Providers;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Gate::define('create-supplier', function (User $user) {
        //     return $user->role_id === 1;
        // });

        // Gate::define('update-supplier', function (User $user, Supplier $supplier) {
        //     return $user->id === $supplier->user_id;
        // });
    }
}
