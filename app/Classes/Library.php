<?php

namespace App\Classes;

use App\Movie;
use App\MovieUser;
use App\Book;
use App\BookUser;
use App\User;

use Illuminate\Support\Facades\Auth;

class Library
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

    public function statuses($type)
    {
        if ($type == "book") {
            return [
                "ptw" => "Plan to Read",
                "completed" => "Completed",
                "watching" => "Reading",
                "" => ""
            ];
        } else {
            return [
                "completed" => "Completed",
                "ptw" => "Plan to Watch",
                "watching" => "Watching",
                "" => ""
            ];
        }
    }

    /**
     *  @return Array All movie statuses where the current logged user has set some status 
     */
    public function movieStatus()
    {
        $statuses = [];
        foreach ($this->findUser()->movies as $record) {
            array_push($statuses, ["movie_id" => $record->movie_id, "status" => $record->status]);
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
