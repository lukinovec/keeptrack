<?php

namespace App\Classes;

use App\Classes\Request;
use App\Classes\LibraryDB;
use Illuminate\Support\Collection;

/**
 * @method start()
 * @method makeRequest(string $searchtype)
 * @method type(string $searchtype)
 * @method formatMovies()
 * Format response to be displayed as results
 * @method formatAnime()
 * Format response to be displayed as results
 * @method formatBooks()
 * Format response to be displayed as results
 */
class Search
{
    public function __construct(string $searchtype, string $search)
    {
        $this->search = $search;
        $this->searchtype = $searchtype;
    }

    public static function start(string $searchtype, string $search)
    {
        return new static($searchtype, $search);
    }

    /**
     * @return Collection   Výsledky vyhledávání ve správném formátu pro zobrazení
     */

    public function makeRequest()
    {

        $request = Request::create($this->searchtype, $this->search)->search();

        // Get movies by name
        if ($this->searchtype === "movie") {
            return $this->formatMovies($request);
        }

        // Get a movie by ID
        elseif ($this->searchtype === "movie_details") {
            return $request;
        } elseif ($this->searchtype === "anime") {
            return $this->formatAnime($request);
        }

        // Get a book by name
        elseif ($this->searchtype === "book") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($request, 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = json_decode(json_encode($xml))->search->results->work ?? false;
            return $this->formatBooks($results);
        }

        // Get a book by ID
        elseif ($this->searchtype === "book_details") {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($request, 'SimpleXMLElement', LIBXML_NOCDATA);
            $results = collect(json_decode(json_encode($xml))->book)->all();
            return $results;
        }
    }


    /**
     * @param mixed $json   Odpověď API ve formátu JSON
     * @return Collection|false   Výsledky vyhledávání ve správném formátu pro zobrazení, nebo false - když vyhledávání selže
     */

    public function formatMovies($json): Collection|bool
    {
        if ($json["Response"] === "True") {
            $statuses = LibraryDB::statuses("movie")->map(function ($movie) {
                return ["apiID" => $movie->movie_id, "status" => $movie->status];
            });
            return collect($json["Search"])->map(function ($item) use ($statuses) {
                $image_valid = false;

                if ($item["Poster"] != "N/A") {
                    if (getimagesize($item["Poster"])[0] < getimagesize($item["Poster"])[1]) {
                        $image_valid = true;
                    }
                }

                return [
                    "id" => $item["imdbID"],
                    "formattedId" => (int) preg_replace("/[^0-9]/", "", $item["imdbID"]),
                    "title" => $item["Title"],
                    "year" => $item["Year"],
                    "type" => $item["Type"],
                    "image" => $item["Poster"],
                    "image_valid" => $image_valid,
                    "status" => $statuses->firstWhere("apiID", $item["imdbID"])["status"] ?? ""
                ];
            })->reject(function ($item) {
                return $item["type"] == "game" || !$item["image_valid"];
            });
        } else {
            return false;
        }
    }

    /**
     * @param array $response   Odpověď API
     * @return Collection       Výsledky vyhledávání ve správném formátu pro zobrazení
     */

    public function formatAnime(array $response): Collection
    {
        $statuses = LibraryDB::statuses("movie")->map(function ($anime) {
            return ["apiID" => $anime["mal_id"], "status" => $anime->status];
        });
        return collect($response)->map(function ($item) use ($statuses) {
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

    /**
     * @param array|bool $response   Odpověď API
     * @return Collection|bool   Výsledky vyhledávání ve správném formátu pro zobrazení
     */

    public function formatBooks(array|bool $response): Collection|bool
    {
        if ($response === false) {
            return false;
        }
        $statuses = LibraryDB::statuses("book")->map(function ($book) {
            return ["apiID" => $book->book_id, "status" => $book->status];
        });
        return collect($response)->map(function ($item) use ($statuses) {
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
