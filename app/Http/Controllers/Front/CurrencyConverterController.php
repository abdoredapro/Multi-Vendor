<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class CurrencyConverterController extends Controller
{
    public function store(Request $request) 
    {
        $request->validate([
            'currency_code' => 'required|string|size:3',
        ]);
        $baseCurrency = config('app.currency');
        $currencyCode = $request->currency_code;

        $cacheKey = 'currency_rate_' . $currencyCode;

        $rate = Cache::get($cacheKey, 0);

        if(!$rate) {
            
            // $converter =  new CurrencyConverter(config('services.currency_converter.api_key'));
            $converter =  App::make('currency.converter');
            $rate = $converter->convert($baseCurrency, $currencyCode);
            Cache::put($cacheKey, $rate, now()->addMinute(60));
        }

        Session::put('currency_code', $currencyCode);

        
        return redirect()->back();

    }

}
