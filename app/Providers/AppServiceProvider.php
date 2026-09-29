<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
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
        View::composer(['layouts.frontend', 'frontend.*', 'components.admin-layout', 'layouts.guest', 'admin.*'], function ($view) {
            static $setting = null;
            if ($setting === null) {
                try {
                    if (Schema::hasTable('settings')) {
                        $setting = Setting::current();
                    }
                } catch (\Throwable $e) {
                    $setting = null;
                }
            }
            $view->with('setting', $setting);
        });
    }
}
