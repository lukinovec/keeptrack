<?php

namespace App\Classes;

use App\Classes\Request;
use App\Classes\LibraryDB;

class Search
{


    public function __construct($search)
    {
        $this->search = $search;
    }
    public static function start($search)
    {
        return new static($search);
    }

    public function makeRequest($searchtype)
    {
        return (new Request($searchtype, $this->search))->search();
    }


    public function type(String $searchtype)
    {
        // Get movies by name
        if ($searchtype === "movie") {
            return $this->formatMovies($this->makeRequest($searchtype));
        }

        // Get a movie by ID
        if ($searchtype === "movie_details") {
            return $this->makeRequest($searchtype);
        }

        // Get a book by name
        if ($searchtype === "book") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($this->makeRequest($searchtype), 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = json_decode(json_encode($xml))->search->results->work;
            return $this->formatBooks($results);
        }

        // Get a book by ID
        if ($searchtype === "book_details") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($this->makeRequest($searchtype), 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = (array) json_decode(json_encode($xml))->book;
            return $results;
        }
    }

    // Format response to be displayed as results
    public function formatMovies($query)
    {
        if ($query["Response"] === "True") {
            $statuses = LibraryDB::open()->movieStatus()->map(function ($movie) {
                return ["imdbID" => $movie->movie_id, "status" => $movie->status];
            });
            return collect($query["Search"])->map(function ($item) use ($statuses) {
                return [
                    "id" => $item["imdbID"],
                    "title" => $item["Title"],
                    "year" => $item["Year"],
                    "type" => $item["Type"],
                    "image" => $item["Poster"],
                    "status" => $statuses->firstWhere("imdbID", $item["imdbID"])["status"] ?? ""
                ];
            });
        } else {
            return false;
        }
    }

    public function formatBooks($query)
    {
        $statuses = LibraryDB::open()->bookStatus()->map(function ($book) {
            return ["goodreadsID" => $book->book_id, "status" => $book->status];
        });
        return collect($query)->map(function ($item) use ($statuses) {
            return [
                "id" => $item->best_book->id->{'0'},
                "rating" => $item->average_rating,
                "title" => $item->best_book->title,
                "year" => $item->original_publication_year->{'0'},
                "type" => "book",
                "creator_name" => $item->best_book->author->name,
                "creator_id" => $item->best_book->author->id->{"0"},
                "image" => $item->best_book->image_url,
                "status" => $statuses->firstWhere("goodreadsID", $item->best_book->id->{'0'})["status"] ?? ""
            ];
        });
    }
}
