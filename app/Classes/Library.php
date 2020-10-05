<?php

namespace App\Classes;

use App\Movie;
use App\MovieUser;

use App\Book;
use App\BookUser;

use App\User;

class Library
{
    // @param  number  $authUser  ID of current logged in user
    public function __construct($authUser)
    {
        $this->authUser = $authUser;
    }

    public function movies()
    {
        return User::find($this->authUser)->movies();
    }

    public function books()
    {
        return User::find($this->authUser)->books();
    }

    public function movieStatus()
    {
        $statuses = [];
        foreach (MovieUser::where("user_id", $this->authUser)->get() as $record) {
            array_push($statuses, ["movie_id" => Movie::find($record->movie_id)->imdbID, "status" => $record->status]);
        }
        return $statuses;
    }

    public function bookStatus()
    {
        $statuses = [];
        foreach (BookUser::where("user_id", $this->authUser)->get() as $record) {
            array_push($statuses, ["book_id" => Book::find($record->book_id)->goodreadsID, "status" => $record->status]);
        }
        return $statuses;
    }

    public function updateMovieStatus($movie, $status)
    {
        $get_movie = Movie::where("imdbID", $movie->id)->first();
        if ($get_movie) {
            $movie_id = $get_movie->id;
            $record = MovieUser::where("movie_id", $movie_id)->where("user_id", $this->authUser)->first();
            if ($record) {
                $record->status = $status;
                $record->save();
                $record;
            } else {
                MovieUser::create([
                    "user_id" => $this->authUser,
                    "movie_id" => $movie_id,
                    "status" => $status
                ]);
            }
        } else {
            Movie::create([
                "imdbID" => $movie->id,
                "image" => $movie->image,
                "name" => $movie->title,
                "type" => "movie",
                "year" => $movie->year
            ]);
            MovieUser::create([
                "user_id" => $this->authUser,
                "movie_id" => $movie->id,
                "status" => $status
            ]);
        }
    }
}
