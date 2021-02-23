<?php

namespace App\Classes;
use App\Models\Item;

class UpdateStatus {
    public function __construct($item, string $status)
    {
        $this->item = $item;
        $this->item_blueprint = new ItemBlueprint($item);
        $this->item_users_blueprint = new ItemUsersBlueprint($item, $status);
        $this->status = $status;
        $this->item_found = Item::find($item["id"]) ? true : false;
    }

    public function run()
    {
        if ($this->item_found) {

            switch ($this->item["type"]) {
                case 'series':
                        $this->item_users_blueprint->user_progress = ["episode" => 1, "season" => 1];
                        break;

                case 'book':
                        $this->item_users_blueprint->user_progress = ["pages_read" => 0];
                        break;

                default:
                        break;
            }
            $this->item_users_blueprint->updateOrCreate();

        } else {
            switch ($this->item["searchtype"]) {
                case 'movie':
                    if($this->item["type"] == "series") {
                        $request_details = Request::create("movie_details", $this->item["id"]);
                        $total_seasons = (int) $request_details->search()["totalSeasons"];
                        $seasons = [];
                        for ($i = 1; $i <= $total_seasons; $i++) {
                            $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                        }
                        $this->item_blueprint->progress = ["seasons" => $seasons, "totalSeasons" => $total_seasons];
                        $this->item_users_blueprint->user_progress = ["episode" => 1, "season" => 1];
                    }
                    break;

                case 'book':
                    $this->item_blueprint->image = preg_replace('/._.*_/', '._SY385_', $this->item["image"]);
                    $this->item_users_blueprint->user_progress = ["pages_read" => 0];
                    break;

                case 'anime':
                    $this->item_blueprint->progress = ["episodes" => $this->item["progress"]["episodes"]];
                    $this->item_users_blueprint->user_progress = ["episode" => 1];
                    break;

                default:
                    break;
            }
            $this->item_blueprint->create();
            $this->item_users_blueprint->updateOrCreate();
        }
    }
}