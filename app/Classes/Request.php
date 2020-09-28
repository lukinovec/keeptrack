<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;


class Request
{
    public function __construct($searchtype)
    {
        $this->searchtype = $searchtype;
    }

    public function search(String $query)
    {
        if ($this->searchtype === "movie") {
            return Http::get('https://www.omdbapi.com', [
                'apikey' => config('services.apikey.omdb'),
                's' => $query,
            ])->json();
        }

        if ($this->searchtype === "movie_details") {
            return Http::get('https://www.omdbapi.com', [
                'apikey' => config('services.apikey.omdb'),
                'i' => $query,
            ])->json();
        }

        if ($this->searchtype === "book") {
            return Http::get('https://www.goodreads.com/search/index.xml', [
                'key' => config('services.apikey.goodreads'),
                'q' => $query,
            ]);
        }

        if ($this->searchtype === "book_details") {
            return Http::get("https://www.goodreads.com/book/show/$query.xml", [
                'key' => config('services.apikey.goodreads'),
            ]);
        }
    }
}
