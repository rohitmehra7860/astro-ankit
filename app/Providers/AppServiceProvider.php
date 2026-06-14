<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
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
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        app()->register(SMTPConfigServiceProvider::class);
        Paginator::useBootstrap();

        $settings = Setting::first();
        View::share(['settings' => $settings]);

        View::composer(['layouts.front'], function ($view) {
            $nav_services = Service::get();
            $footer_nav_services = Service::take(5)->get();
            $view->with([
                'nav_services' => $nav_services,
                'footer_nav_services' => $footer_nav_services
            ]);
        });
    }
}
