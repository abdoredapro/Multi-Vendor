<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\CurrencyConverter;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('currency.converter', function() {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        

        app()->setLocale(request('local', 'en'));

        JsonResource::withoutWrapping();

        Validator::extend('filter', function($attr, $value, $params) {
            return ! in_array(strtolower($value), $params);
        }, 'This word blocked to use it!');

        Paginator::useBootstrapFour();
    }
    
}
