<?php

namespace App\Classes;

use App\Movie;
use App\MovieUser;
use App\Book;
use App\BookUser;
use App\User;

class LibraryDB
{
    /**
     *  @param  number $authUser  ID of current logged in user
     */
    public function __construct($authUser = null)
    {
        $this->authUser = $authUser ?: auth()->id();
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
}
