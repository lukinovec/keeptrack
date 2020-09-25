<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;


class Request
{
    public function __construct($searchtype)
    {
        $this->searchtype = $searchtype;
    }

    public function search(String $query, String $param = "s")
    {
        if ($this->searchtype === "movie" || $this->searchtype === "details") {
            return Http::get('https://www.omdbapi.com', [
                'apikey' => config('services.apikey.omdb'),
                $param => $query,
            ])->json();
        }

        if ($this->searchtype === "book") {
            return Http::get('https://www.goodreads.com/search/index.xml', [
                'key' => config('services.apikey.goodreads'),
                'q' => $query,
            ]);
        }
    }
}
