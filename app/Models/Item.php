<?php

namespace App\Models;

use App\Classes\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'apiID';
    protected $casts = ['apiID' => 'string', 'progress' => 'array'];
    public $incrementing = false;

    public function users() {
        return $this->hasMany(ItemUser::class, "item_id");
    }

    /**
     * Update item status in DB, if the item doesn't exist in DB, create a new record
     */
    public static function updateStatus(array $item, String $status): void
    {
        $get_item = self::find($item["id"]);
        if ($get_item) {
            ItemUser::updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "item_id" => $get_item->apiID,
                ],
                ["status" => $status]
            );
        } else {
            $create = [
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
             * $create (ukázka v case 'series'), nebo přepsat některou z jeho hodnot (ukázka v case 'book')
             */
            switch ($item["type"]) {
                case 'series':
                    $request_details = Request::create("movie_details", $item["id"]);
                    $totalSeasons = (int) $request_details->search()["totalSeasons"];
                    $seasons = [];
                    for ($i = 1; $i <= $totalSeasons; $i++) {
                        $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                    }
                    $create["progress"] = ["seasons" => $seasons, "totalSeasons" => $totalSeasons];
                    break;

                case 'book':
                    $create["image"] = preg_replace('/._.*_/', '._SY385_', $item["image"]);
                    break;

                default:
                    break;
            }

            self::create($create);

            ItemUser::create([
                "user_id" => auth()->id(),
                "item_id" => $item["id"],
                "type" => $item["type"],
                "searchtype" => $item["searchtype"],
                "status" => $status
            ]);
        }
    }
}
