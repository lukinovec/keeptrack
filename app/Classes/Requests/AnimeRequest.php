<?php

namespace App\Classes\Requests;

// rozšiřitelnost
use Illuminate\Support\Facades\Http;

/**
 * @method create(String $searchtype, String $query)
 * @method search
 * @method getSeason(Int $season = 1)
 */
class AnimeRequest extends AbstractRequest
{
    public function make($params)
    {
        return Http::get('https://api.jikan.moe/v3/search/anime', [
            'q' => $params['query']
        ])->json()['results'];
    }
}
