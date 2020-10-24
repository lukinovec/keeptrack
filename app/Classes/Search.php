<?php

namespace App\Classes;

use App\Classes\Request;
use App\Classes\LibraryDB;
use Illuminate\Support\Facades\Auth;

class Search
{
    public function __construct($search)
    {
        $this->search = $search;
    }

    public function makeRequest($searchtype)
    {
        $request = new Request($searchtype, $this->search);
        return $request->search();
    }


    public function makeSearch(String $searchtype)
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
            $library = new LibraryDB;
            $statuses = $library->movieStatus();
            $formatted = [];
            foreach ($query["Search"] as $item) {
                $item_status = "";
                $id_column = array_column($statuses, "movie_id");
                if (in_array($item["imdbID"], $id_column)) {
                    foreach ($statuses as $status) {
                        if ($status["movie_id"] == $item["imdbID"]) {
                            $item_status = $status["status"];
                            break;
                        }
                    }
                }

                array_push($formatted, [
                    "id" => $item["imdbID"],
                    "title" => $item["Title"],
                    "year" => $item["Year"],
                    "type" => $item["Type"],
                    "image" => $item["Poster"],
                    "status" => $item_status
                ]);
            }
            return $formatted;
        } else {
            return false;
        }
    }

    public function formatBooks($query)
    {
        $library = new LibraryDB;
        $statuses = $library->bookStatus();
        $formatted = [];
        foreach ($query as $item) {
            $item_status = "";
            $id_column = array_column($statuses, "book_id");
            if (in_array($item->best_book->id->{'0'}, $id_column)) {
                foreach ($statuses as $status) {
                    if ($status["book_id"] == $item->best_book->id->{'0'}) {
                        $item_status = $status["status"];
                        break;
                    }
                }
            }
            $year = "";
            if ($item->original_publication_year->{"0"}) {
                $year = $item->original_publication_year->{"0"};
            }
            array_push($formatted, [
                "id" => $item->best_book->id->{'0'},
                "rating" => $item->average_rating,
                "title" => $item->best_book->title,
                "year" => $item->original_publication_year->{"0"},
                "type" => "book",
                "creator_name" => $item->best_book->author->name,
                "creator_id" => $item->best_book->author->id->{"0"},
                "image" => $item->best_book->image_url,
                "status" => $item_status
            ]);
        }
        return $formatted;
    }
}
