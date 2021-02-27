<?php
namespace App\Classes;

use App\Models\Item;

class ItemBlueprint extends Abstract\AbstractItem {
    public function __construct($item) {
        $this->apiID = $item["id"];
        $this->progress = array_key_exists("progress", (array) $item) ? $item["progress"] : [];
        $this->searchtype = $item["searchtype"];
        $this->image = $item["image"];
        $this->name = $item["title"];
        $this->type = $item["type"];
        $this->year = $item["year"];
    }

    public function prepare()
    {
        switch ($this->searchtype) {
                case 'movie':
                    if ($this->type == "series") {
                        $total_seasons = (int) Request::create("movie_details", $this->apiID)->search()["totalSeasons"];
                        $seasons = [];
                        for ($i = 1; $i <= $total_seasons; $i++) {
                            $seasons[] = ["number" => $i, "episodes" => Request::create("season", $this->apiID)->search($i)];
                        }
                        $this->progress = ["seasons" => $seasons, "totalSeasons" => $total_seasons];
                    }
                    break;

                case 'book':
                    $this->image = preg_replace('/._.*_/', '._SY385_', $this->image);
                    break;

                case 'anime':
                    $this->progress = ["episodes" => $this->progress["episodes"]];
                    break;

                default:
                    break;
        }
        return $this;
    }

    public function create()
    {
        Item::create((array) $this);
    }
}