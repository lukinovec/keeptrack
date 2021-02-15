<?php

namespace App\Models;

use App\Classes\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['statuses'];
    protected $primaryKey = 'apiID';
    protected $casts = ['apiID' => 'string', 'progress' => 'array'];
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(ItemUser::class, "item_id");
    }

    public function statuses()
    {
        return $this->hasOne(Status::class, "type", "searchtype");
    }

    /**
     * Update item status in DB, if the item doesn't exist in DB, create a new record
     */
    public static function updateStatus($item, String $status): void
    {
        $get_item = self::find($item["id"]);

        $createItemUsersModel = [
            "user_id" => auth()->id(),
            "item_id" => $item["id"],
            "user_progress" => [],
            "type" => $item["type"],
            "searchtype" => $item["searchtype"],
            "status" => $status
        ];

        if ($get_item) {
            ItemUser::updateOrCreate($createItemUsersModel, ["status" => $status]);
        } else {
            $createItemModel = [
                "apiID" => $item["id"],
                "searchtype" => $item["searchtype"],
                "image" => $item["image"],
                "name" => $item["title"],
                "type" => $item["type"],
                "year" => $item["year"],
            ];

            /**
             * Některé typy výsledků potřebují speciální úpravy, například seriály a knihy,
             * kde je třeba do databáze uložit postup (série, epizody, stránky,...) - přidáme case.
             *
             * Aby byla změna správně provedena, je třeba rozšířit pole
             * $createItemModel a $createItemUsersModel (ukázka v case 'series'), nebo přepsat některou z jeho hodnot (ukázka v case 'book')
             */
            switch ($item["type"]) {
                case 'series':
                        $request_details = Request::create("movie_details", $item["id"]);
                        $totalSeasons = (int) $request_details->search()["totalSeasons"];
                        $seasons = [];
                        for ($i = 1; $i <= $totalSeasons; $i++) {
                            $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                        }
                        $createItemModel["progress"] = ["seasons" => $seasons, "totalSeasons" => $totalSeasons];
                        $createItemUsersModel["user_progress"] = ["episode" => 1, "season" => 1];
                        break;

                    case 'book':
                        $createItemModel["image"] = preg_replace('/._.*_/', '._SY385_', $item["image"]);
                        $createItemUsersModel["user_progress"] = ["pages_read" => 0];
                        break;

                    default:
                        break;
            }

            self::create($createItemModel);

            ItemUser::create($createItemUsersModel);
        }
    }
}
