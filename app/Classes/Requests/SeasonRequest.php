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
class SeasonRequest extends AbstractRequest
{
    public function make($params)
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => config('services.apikey.omdb'),
            'i' => $params['query'],
            'season' => $params['season']
        ])->json();

        if (!array_key_exists('Episodes', $response)) {
            $response['Episodes'] = ['Title' => 'Season request failed'];
        };

        return $response;
    }
}
