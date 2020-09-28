<?php

namespace App\Classes;

use App\Classes\Request;

class Search
{
    public $response;
    public function __construct($searchtype, $search)
    {
        $this->searchtype = $searchtype;
        $this->search = $search;
        $this->request = new Request($this->searchtype);
        $this->response = $this->request->search($this->search);
    }

    public function makeSearch()
    {
        if ($this->searchtype === "movie") {
            return $this->formatMovies($this->response);
        }

        if ($this->searchtype === "details") {
            return $this->request->search($this->search, "i");
        }

        if ($this->searchtype === "book") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($this->response, 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = json_decode(json_encode($xml))->search->results->work;
            return $this->formatBooks($results);
        }
    }

    public function formatMovies($query)
    {
        if ($query["Response"] === "True") {
            $query = $query["Search"];
            $formatted = [];
            foreach ($query as $item) {
                array_push($formatted, [
                    "id" => $item["imdbID"],
                    "title" => $item["Title"],
                    "year" => $item["Year"],
                    "type" => $item["Type"],
                    "image" => $item["Poster"],
                ]);
            }
            return $formatted;
        } else {
            return false;
        }
    }

    public function formatBooks($query)
    {
        $formatted = [];
        foreach ($query as $item) {
            array_push($formatted, [
                "id" => $item->best_book->id->{'0'},
                "rating" => $item->average_rating,
                "title" => $item->best_book->title,
                "year" => $item->original_publication_year->{"0"},
                "creator_name" => $item->best_book->author->name,
                "creator_id" => $item->best_book->author->id->{"0"},
                "image" => $item->best_book->image_url
            ]);
        }
        return $formatted;
    }
}
