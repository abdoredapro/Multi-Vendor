<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter 
{
    private $api_key;
    protected  $base_url = 'https://free.currconv.com/api/v7';

    function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    public function convert(string $from, string $to, float $amount = 1) {
        $q = "$from,$to";
        $response = Http::baseUrl($this->base_url)

        ->get('/convert', [
            'q' => $q,
            'compact' => 'y',
            'apiKey' => $this->api_key,
        ]);

        $result = $response->json();

        return $result[$q]['val'] * $amount;
    }
}