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
        return Request::create($searchtype, $this->search)->search();
    }


    public function type(String $searchtype)
    {
        // Get movies by name
        if ($searchtype === "movie") {
            return $this->formatMovies($this->makeRequest($searchtype));
        }

        // Get a movie by ID
        elseif ($searchtype === "movie_details") {
            return $this->makeRequest($searchtype);
        } elseif ($searchtype === "anime") {
            return $this->formatAnime($this->makeRequest($searchtype));
        }

        // Get a book by name
        elseif ($searchtype === "book") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($this->makeRequest($searchtype), 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = json_decode(json_encode($xml))->search->results->work;
            return $this->formatBooks($results);
        }

        // Get a book by ID
        elseif ($searchtype === "book_details") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($this->makeRequest($searchtype), 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = collect(json_decode(json_encode($xml))->book)->all();
            return $results;
        }
    }

    // Format response to be displayed as results
    public function formatMovies($query)
    {
        if ($query["Response"] === "True") {
            $statuses = LibraryDB::statuses("movie")->map(function ($movie) {
                return ["apiID" => $movie->movie_id, "status" => $movie->status];
            });
            return collect($query["Search"])->map(function ($item) use ($statuses) {
                return [
                    "id" => $item["imdbID"],
                    "formattedId" => (int) preg_replace("/[^0-9]/", "", $item["imdbID"]),
                    "title" => $item["Title"],
                    "year" => $item["Year"],
                    "type" => $item["Type"],
                    "image" => $item["Poster"],
                    "image_valid" => getimagesize($item["Poster"])[0] < getimagesize($item["Poster"])[1] ? true : false,
                    "status" => $statuses->firstWhere("apiID", $item["imdbID"])["status"] ?? ""
                ];
            })->reject(function ($item) {
                return $item["type"] == "game" || !$item["image_valid"];
            });
        } else {
            return false;
        }
    }

    public function formatAnime($query)
    {
        $statuses = LibraryDB::statuses("movie")->map(function ($anime) {
            return ["apiID" => $anime["mal_id"], "status" => $anime->status];
        });
        return collect($query)->map(function ($item) use ($statuses) {
            return [
                "id" => $item["mal_id"],
                "title" => $item["title"],
                "year" => substr($item["start_date"], 0, 4),
                "type" => strtolower($item["type"]),
                "episodes" => $item["episodes"],
                "isAnime" => true,
                "image" => $item["image_url"],
                "status" => $statuses->firstWhere("apiID", $item["mal_id"])["status"] ?? ""
            ];
        });
    }

    public function formatBooks($query)
    {
        $statuses = LibraryDB::statuses("book")->map(function ($book) {
            return ["apiID" => $book->book_id, "status" => $book->status];
        });
        return collect($query)->map(function ($item) use ($statuses) {
            return collect([
                "id" => is_object($item->best_book->id) ? $item->best_book->id->{"0"} : $item->best_book->id,
                "rating" => $item->average_rating,
                "title" => $item->best_book->title,
                "year" => is_object($item->original_publication_year) ? $item->original_publication_year->{"0"} ?? null : $item->original_publication_year ?? null,
                "type" => "book",
                "creator_name" => $item->best_book->author->name,
                "creator_id" => is_object($item->best_book->author->id) ? $item->best_book->author->id->{"0"} ?? "" : $item->best_book->author->id ?? "",
                "image" => preg_replace('/._.*_/', '._SY385_', $item->best_book->image_url),
                "status" => $statuses->firstWhere("apiID", $item->best_book->id)["status"] ?? ""
            ]);
        })->whereNotNull("year");
    }
}
