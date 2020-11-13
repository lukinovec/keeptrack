<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Request;

class Movie extends Model
{
    protected $fillable = ['apiID', 'image', 'name', 'type', 'year', 'totalSeasons', 'seasons', 'episodes'];
    protected $primaryKey = 'apiID';
    protected $casts = ['apiID' => 'string', 'seasons' => 'array'];
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(MovieUser::class, "movie_id");
    }

    // Update movie's status in DB, if the movie doesn't exist in DB, create a new record
    public static function updateStatus($movie, $status)
    {
        $movie = (object) $movie;
        $get_movie = self::find($movie->id);
        if ($get_movie) {
            MovieUser::updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "movie_id" => $get_movie->apiID
                ],
                ["status" => $status]
            );
        } else {
            $movie->totalSeasons = 0;
            $movie->seasons = "";
            if ($movie->type == "series") {
                $request_details = new Request("movie_details", $movie->id);
                $totalSeasons = (int) $request_details->search()["totalSeasons"];
                $seasons = [];
                for ($i = 1; $i <= $totalSeasons; $i++) {
                    $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                }
                $movie->seasons = $seasons;
                $movie->totalSeasons = $totalSeasons;
            }
            self::create([
                "apiID" => $movie->id,
                "image" => $movie->image,
                "name" => $movie->title,
                "type" => $movie->type,
                "year" => $movie->year,
                "totalSeasons" => $movie->totalSeasons,
                "seasons" => $movie->seasons,
                "episodes" => $movie->episodes ?? null
            ]);
            MovieUser::create([
                "user_id" => auth()->id(),
                "movie_id" => $movie->id,
                "status" => $status
            ]);
        }
    }
}
