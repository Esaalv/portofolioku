<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Url schema
       if (config('app.env') === 'production') {
        
        URL::forceScheme('https');
    }
        View::composer('*', function ($view) {
            
            $profile = Profile::first();
            $view->with('profile', $profile);
        });
    }
}