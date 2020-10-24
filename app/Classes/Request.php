<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class Request
{
    public function __construct(String $searchtype, String $query)
    {
        $this->searchtype = $searchtype;
        $this->query = $query;
    }
    // serial - prvni request JENOM pro first season, dalsi az user vybere
    public function search()
    {
        if ($this->searchtype === "movie") {
            return Http::get('https://www.omdbapi.com', [
                'apikey' => config('services.apikey.omdb'),
                's' => $this->query,
            ])->json();
        }

        if ($this->searchtype === "movie_details") {
            return Http::get('https://www.omdbapi.com', [
                'apikey' => config('services.apikey.omdb'),
                'i' => $this->query,
            ])->json();
        }

        if ($this->searchtype === "book") {
            return Http::get('https://www.goodreads.com/search/index.xml', [
                'key' => config('services.apikey.goodreads'),
                'q' => $this->query,
            ]);
        }

        if ($this->searchtype === "book_details") {
            return Http::get("https://www.goodreads.com/book/show/$this->query.xml", [
                'key' => config('services.apikey.goodreads'),
            ]);
        }
    }


    public function getSeason($season = 1)
    {
        return Http::get('https://www.omdbapi.com', [
            'apikey' => config('services.apikey.omdb'),
            'i' => $this->query,
            'season' => $season
        ])->json();
    }
}
