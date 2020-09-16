<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class Search
{
    public function __construct($searchtype, $search)
    {
        $this->searchtype = $searchtype;
        $this->search = $search;
    }

    public function getMovies()
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => config('services.apikey.omdb'),
            's' => $this->search,
        ]);

        return dd($response->json()["Search"]);
    }

    public function getBooks()
    {
        $response = Http::get('https://www.goodreads.com/search/index.xml', [
            'key' => config('services.apikey.goodreads'),
            'q' => $this->search,
        ]);
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        return dd(json_decode(json_encode($xml))->search->results->work);
    }

    public function makeSearch()
    {
        $this->searchtype === "movie" ? $this->getMovies() : $this->getBooks();
    }
}
