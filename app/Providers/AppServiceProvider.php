<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\View;
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
        // 1. Memastikan skema URL (Opsional, bawaan kamu)
        \URL::forceScheme('http');

        // 2. Membagikan data profile ke SEMUA file Blade (Header, Footer, Home, dll)
        View::composer('*', function ($view) {
            // Mengambil data profile pertama dari database
            $profile = Profile::first();
            $view->with('profile', $profile);
        });
    }
}