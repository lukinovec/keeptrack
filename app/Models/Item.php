<?php

namespace App\Models;

use App\Classes\Request;
use App\Classes\ItemHandler;
use App\Classes\ItemBlueprint;
use App\Classes\UserItemBlueprint;
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
        return $this->hasMany(UserItem::class, "item_id");
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, "searchtype", "type");
    }

    /**
     * Update item status in DB, if the item doesn't exist in DB, create a new record
     * Zjistíme, jestli položka existuje v databázi, pokud neexistuje, vytvoříme nový model Item (ItemBlueprint($item)->prepare()->create()) a Item User (UserItemBlueprint($item)->prepare()->updateOrCreate())
     * Item User vytvoříme pomocí metody updateOrCreate - provedeme pokaždé, ať položka existuje, nebo ne,
     * protože metoda ověří existenci položky, pokud existuje jen upraví její status, pokud neexistuje, vytvoří novou
     */
    public static function handleUpdate($item, string $status): void
    {
        if (!Item::find($item["id"])) {
            (new ItemBlueprint($item))->prepare()->create();
        }

        (new UserItemBlueprint($item, $status))->prepare()->updateOrCreate();
    }
}
