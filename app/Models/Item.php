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
     * Zjistíme, jestli položka existuje v databázi, pokud neexistuje, vytvoříme nový model Item ($createItemModel) a Item User ($createItemUsersModel)
     * Item User vytvoříme pomocí metody updateOrCreate - provedeme pokaždé, ať položka existuje, nebo ne,
     * protože metoda ověří existenci položky, pokud existuje jen upraví její status, pokud neexistuje, vytvoří novou
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
         * Instrukce pro novou položku (create) dáme do if(!$get_item) {} - provede se jen v případě,
         * že položka v databázi neexistuje, hned za tím budou instrukce, které se provedou pokaždé.
         *
         * Aby byla změna správně provedena, je třeba rozšířit pole
         * $createItemModel a $createItemUsersModel (ukázka v case 'series'), nebo přepsat některou z jeho hodnot (ukázka v case 'book')
         */
        switch ($item["type"]) {
            case 'series':
                // Když položka není v databázi, proveď
                if (!$get_item) {
                    $request_details = Request::create("movie_details", $item["id"]);
                    $totalSeasons = (int) $request_details->search()["totalSeasons"];
                    $seasons = [];
                    for ($i = 1; $i <= $totalSeasons; $i++) {
                        $seasons[] = ["number" => $i, "episodes" => $request_details->getSeason($i)];
                    }
                    $createItemModel["progress"] = ["seasons" => $seasons, "totalSeasons" => $totalSeasons];
                }
                // Proveď pokaždé
                $createItemUsersModel["user_progress"] = ["episode" => 1, "season" => 1];
                break;

            case 'book':
                if (!$get_item) {
                    $createItemModel["image"] = preg_replace('/._.*_/', '._SY385_', $item["image"]);
                }
                $createItemUsersModel["user_progress"] = ["pages_read" => 0];
                break;

            default:
                break;
        }

        if (!$get_item) {
            self::create($createItemModel);
        }

        ItemUser::updateOrCreate($createItemUsersModel, ["status" => $status]);
    }
}
