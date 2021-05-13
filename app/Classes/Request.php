<?php

namespace App\Classes;

// rozšiřitelnost
use ErrorException;

/**
 * @method create(String $searchtype, String $query)
 * @method search
 * @method getSeason(Int $season = 1)
 */
class Request
{
    public array $requests;

    /**
     * @param String $searchtype    typ vyhledávání
     * @param String $query         uživatelův vstup
     */
    public function __construct(public String $searchtype, public String $query)
    {
        // Add new requests here
        $this->requests = [
            'movie' => Requests\MovieRequest::class,
            'movie_details' => Requests\MovieDetailsRequest::class,
            'season' => Requests\SeasonRequest::class,
            'book' => Requests\BookRequest::class,
            'anime' => Requests\AnimeRequest::class,
        ];
    }

    /**
     * Inicializuje třídu
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
    public function search(Int $season = 1)
    {
        $params = [
            'searchtype' => $this->searchtype,
            'query' => $this->query,
            'season' => $season,
        ];

        $response = (new $this->requests[$this->searchtype])->make($params);

        if ($response) {
            return $response;
        }

        throw new ErrorException('Fetching results failed (probably invalid searchtype) in Request class. Make sure to add API request case (search()) and a format case for your new searchtype (in Search class - format()).');
    }
}
