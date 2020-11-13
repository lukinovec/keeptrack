<?php

namespace App\Classes;

use App\MovieUser;
use App\BookUser;

class LibraryDB
{
    /**
     *  @param  number $authUser  ID of current logged in user
     */
    public function __construct()
    {
        $this->authUser = auth()->user();
    }

    public static function open()
    {
        return new static;
    }

    /**
     *  @return Collection All statuses where the current logged user has set some status
     *  @param  $type  String  "movie"/"book"
     */
    public static function statuses(String $type)
    {
        $type = eval("return '$type' . 's';");
        return auth()->user()->$type;
    }

    /**
     *  @return Collection  Collection of all statuses ("ptw" => "Plan to Watch")
     *  @param  $type   String  type of item
     */
    public function getStatuses($type)
    {
        if ($type == "book" || $type == "books") {
            return collect([
                "ptw" => "Plan to Read",
                "completed" => "Completed",
                "watching" => "Reading",
                "none" => "None"
            ]);
        } else {
            return collect([
                "ptw" => "Plan to Watch",
                "completed" => "Completed",
                "watching" => "Watching",
                "none" => "None"
            ]);
        }
    }

    /**
     *  @return Array All movies where the current logged user has set some status
     */
    public function movies()
    {
        return $this->authUser->movieList();
    }

    /**
     *  @return Array All books where the current logged user has set some status
     */
    public function books()
    {
        return $this->authUser->books();
    }

    /**
     * @param $item Array  Item to be updated
     * Updates details of a submitted item
     */
    public function updateDetails($item)
    {
        try {
            if ($item->type == "book") {
                $item->status !== "none" ? BookUser::where("user_id", $this->authUser->id)->where("book_id", $item->id)->update(
                    ["pages_read" => $item->pages, "rating" => $item->rating, "note" => $item->note, "status" => $item->status]
                ) : BookUser::where("user_id", $this->authUser->id)->where("book_id", $item->id)->delete();
            } else {
                $movie_user = MovieUser::where("user_id", $this->authUser->id)->where("movie_id", $item->id);
                if ($item->type == "series" || $item->type == "tv") {
                    $item->status !== "none" ? $movie_user->update(
                        ["season" => $item->season, "episode" => $item->episode, "rating" => $item->rating, "note" => $item->note, "status" => $item->status]
                    ) : $movie_user->delete();
                } elseif ($item->type == "movie") {
                    $item->status !== "none" ? $movie_user->update(
                        ["rating" => $item->rating, "note" => $item->note, "status" => $item->status]
                    ) : $movie_user->delete();;
                    return $this->movies();
                }
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
