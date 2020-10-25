<?php

namespace App\Classes;

use App\Movie;
use App\MovieUser;
use App\Book;
use App\BookUser;
use App\User;

use Illuminate\Support\Facades\Auth;

class LibraryDB
{
    /**
     *  @param  number $authUser  ID of current logged in user
     */
    public function __construct($authUser = null)
    {
        $this->authUser = $authUser ?: Auth::id();
    }

    public function findUser()
    {
        return User::find($this->authUser);
    }

    /**
     *  @return Array All movies where the current logged user has set some status
     */
    public function movies()
    {
        return $this->findUser()->movieList();
    }

    /**
     *  @return Array All books where the current logged user has set some status
     */
    public function books()
    {
        return $this->findUser()->books();
    }

    /**
     *  @return Array All movie statuses where the current logged user has set some status
     * Maybe redundant, might delete this and use user->movieList() instead
     */
    public function movieStatus()
    {
        $statuses = [];
        foreach ($this->findUser()->movies as $record) {
            array_push($statuses, ["movie_id" => $record->movie_id, "status" => $record->status, "rating" => $record->rating, "note" => $record->note, "season" => $record->season, "episode" => $record->episode]);
        }
        return $statuses;
    }

    /**
     *  @return Array All book statuses where the current logged user has set some status
     */
    public function bookStatus()
    {
        $statuses = [];
        foreach ($this->findUser()->books as $record) {
            array_push($statuses, ["book_id" => $record->book_id, "status" => $record->status]);
        }
        return $statuses;
    }

    // Update movie's status in DB, if the movie doesn't exist in DB, create a new record
    public function updateMovieStatus($movie, $status)
    {
        $get_movie = Movie::find($movie->id);
        if ($get_movie) {
            $movie_id = $get_movie->imdbID;
            MovieUser::updateOrCreate(
                [
                    "user_id" => $this->authUser,
                    "movie_id" => $movie_id
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
                    array_push($seasons, ["number" => $i, "episodes" => $request_details->getSeason($i)]);
                }
                $movie->seasons = serialize($seasons);
                $movie->totalSeasons = $totalSeasons;
            }
            Movie::create([
                "imdbID" => $movie->id,
                "image" => $movie->image,
                "name" => $movie->title,
                "type" => $movie->type,
                "year" => $movie->year,
                "totalSeasons" => $movie->totalSeasons,
                "seasons" => $movie->seasons
            ]);
            MovieUser::create([
                "user_id" => $this->authUser,
                "movie_id" => $movie->id,
                "status" => $status
            ]);
        }
    }

    /**
     * @param $item Array  Item to be updated
     * Updates details of a submitted item
     */
    public function updateDetails($item)
    {
        if ($item->type == "series") {
            MovieUser::where("user_id", $this->authUser)->where("movie_id", $item->id)->update(
                ["season" => $item->season, "episode" => $item->episode, "rating" => $item->rating, "note" => $item->note]
            );
        } elseif ($item->type == "movie") {
            MovieUser::where("user_id", $this->authUser)->where("movie_id", $item->id)->update(
                ["rating" => $item->rating, "note" => $item->note]
            );
        } elseif ($item->type == "book") {
            BookUser::where("user_id", $this->authUser)->where("book_id", $item->id)->update(
                ["pages_read" => $item->pages, "rating" => $item->rating, "note" => $item->note]
            );
        }

        return $this->movies();
    }

    // Update book's status in DB, if the movie doesn't exist in DB, create a new record
    public function updateBookStatus($book, $status)
    {
        $get_book = Book::find($book->id);
        if ($get_book) {
            $book_id = $get_book->imdbID;
            BookUser::updateOrCreate(
                [
                    "user_id" => $this->authUser,
                    "book_id" => $book_id
                ],
                ["status" => $status]
            );
        } else {
            Book::create([
                "goodreadsID" => $book->id,
                "image" => $book->image,
                "author" => $book->creator_name,
                "name" => $book->title,
                "type" => "book",
                "year" => $book->year
            ]);
            BookUser::create([
                "user_id" => $this->authUser,
                "book_id" => $book->id,
                "status" => $status
            ]);
        }
    }
}
