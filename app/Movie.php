<?php

namespace App;

use App\Models\Item;
use App\Classes\Request;

class Movie extends Item
{
    /**
     * Update movie's status in DB, if the movie doesn't exist in DB, create a new record
     */
    public static function updateStatus(array $movie, String $status): void
    {
        $get_movie = self::find($movie["id"]);
        if ($get_movie) {
            MovieUser::updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "movie_id" => $get_movie->apiID
                ],
                ["status" => $status]
            );
        } else {
            $movie["totalSeasons"] = 0;
            $movie["seasons"] = "";

            if ($movie["type"] == "series") {
                $request_details = Request::create("movie_details", $movie["id"]);
                $totalSeasons = (int) $request_details->search()["totalSeasons"];
                $seasons = [];
                for ($i = 1; $i <= $totalSeasons; $i++) {
                    $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                }
                $movie["seasons"] = $seasons;
                $movie["totalSeasons"] = $totalSeasons;
            }

            self::create([
                "apiID" => $movie["id"],
                "image" => $movie["image"],
                "name" => $movie["title"],
                "type" => $movie["type"],
                "year" => $movie["year"],
                "totalSeasons" => $movie["totalSeasons"],
                "seasons" => $movie["seasons"],
                "episodes" => $movie["episodes"] ?? null
            ]);

            MovieUser::create([
                "user_id" => auth()->id(),
                "movie_id" => $movie["id"],
                "status" => $status
            ]);
        }
    }
}
