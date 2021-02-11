<?php

namespace App\Classes;

use App\BookUser;
use App\Models\ItemUser;
use App\MovieUser;
use App\Models\Status;

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
     *  @return Collection Všechny filmy, které má uživatel v knihovně
     */
    // public function movies()
    // {
    //     return $this->authUser->usersMovies();
    // }

    /**
     *  @return Collection Všechny knihy, které má uživatel v knihovně
     */
    // public function books()
    // {
    //     return $this->authUser->usersBooks();
    // }

    /**
     * @param $item Collection  Item to be updated
     * Updates details of a submitted item
     */
    public function updateDetails($item)
    {
        try {
            if($item->status !== "none") {
                ItemUser::where("user_id", $this->authUser->id)->where("item_id", $item->id)->update(
                    ["progress" => $item->progress, "rating" => $item->rating, "note" => $item->note, "status" => $item->status, "is_favorite" => $item->is_favorite]
                );
            } else {
                ItemUser::where("user_id", $this->authUser->id)->where("item_id", $item->id)->delete();
            }
            return $this->authUser->getByType($item->searchtype);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
