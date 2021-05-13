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
class BookRequest extends AbstractRequest
{
    public function make($params)
    {
        return Http::get('https://www.goodreads.com/search/index.xml', [
            'key' => config('services.apikey.goodreads'),
            'q' => $params['query'],
        ]);
    }
}
