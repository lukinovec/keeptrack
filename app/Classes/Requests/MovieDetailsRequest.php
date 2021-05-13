<?php

namespace App\Classes\Requests;

// rozšiřitelnost
use Illuminate\Support\Facades\Http;
use App\Classes\Request;

/**
 * @method create(String $searchtype, String $query)
 * @method search
 * @method getSeason(Int $season = 1)
 */
class MovieDetailsRequest extends AbstractRequest
{
    public function make($params)
    {
        return Http::get('https://www.omdbapi.com', [
            'apikey' => config('services.apikey.omdb'),
            'i' => $params['query'],
        ])->json();
    }
}
