<?php

namespace App\Classes;

use ErrorException;
use Illuminate\Support\Facades\Http;

/**
 * @method create(String $searchtype, String $query)
 * @method search
 * @method getSeason(Int $season = 1)
 */
class Request
{
    /**
     * @param String $searchtype    typ vyhledávání
     * @param String $query         uživatelův vstup
     */
    public function __construct(String $searchtype, String $query)
    {
        $this->searchtype = $searchtype;
        $this->query = $query;
    }

    /**
     * Inicializuje třídu
     * Statická funkce pro čitelnější kód, jinak dělá to samé, co konstruktor
     *
     * @param String $searchtype    typ vyhledávání
     * @param String $query         uživatelův vstup
     */

    public static function create(String $searchtype, String $query)
    {
        return new static($searchtype, $query);
    }

    /**
     * Vyhledá položku podle vlastností inicializovaných konstruktorem
     * @return mixed    Odpověď koncového bodu ve formátu JSON
     */

    public function search()
    {
        switch ($this->searchtype) {
            case "movie":
                return Http::get("https://www.omdbapi.com", [
                    'apikey' => config('services.apikey.omdb'),
                    's' => $this->query,
                ])->json();

            case "movie_details":
                return Http::get("https://www.omdbapi.com", [
                    'apikey' => config('services.apikey.omdb'),
                    'i' => $this->query,
                ])->json();

            case "anime":
                return Http::get("https://api.jikan.moe/v3/search/anime", [
                    'q' => $this->query
                ])->json()["results"];

            case "book":
                return Http::get("https://www.goodreads.com/search/index.xml", [
                    'key' => config('services.apikey.goodreads'),
                    'q' => $this->query,
                ]);

            default:
                throw new ErrorException("Fetching results failed (probably invalid searchtype) in Request class. Make sure to add API request case (search()) and a format case for your new searchtype (in Search class - format()).");
        }
    }

    /**
     * @param Int $season   Číslo požadované série, výchozí hodnota je 1
     * @return mixed        Odpověď koncového bodu ve formátu JSON
     */

    public function getSeason(Int $season = 1)
    {
        $response = Http::get('https://www.omdbapi.com', [
            'apikey' => config('services.apikey.omdb'),
            'i' => $this->query,
            'season' => $season
        ])->json();

        if(!array_key_exists("Episodes", $response)) {
            $response["Episodes"] = ["Title" => "Season request failed"];
        };

        return $response;
    }
}
