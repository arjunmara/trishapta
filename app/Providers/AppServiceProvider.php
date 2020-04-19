<?php

namespace App\Providers;

use App\PrimaryCategory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('frontend.layouts.master',function($view){
            $data = [];
            $data['categories'] = PrimaryCategory::get();
            $view->with(compact($data));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
