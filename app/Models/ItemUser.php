<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemUser extends Model
{
    use HasFactory;

    protected $table = 'item_users';
    protected $guarded = ['id'];
    protected $casts = ['user_progress' => 'object'];

    protected $attributes = [
        'user_progress' => '[]'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->hasOne(Item::class, "apiID", "item_id");
    }

    public static function updateDetails($item)
    {
        $item = collect($item);
        if($item["status"] !== "none") {
            self::where([
                "user_id" => Auth::id(),
                "item_id" => $item["id"]
            ])->update([
                "user_progress" => $item["user_progress"],
                "rating" => $item["rating"],
                "note" => $item["note"],
                "status" => $item["status"],
                "is_favorite" => $item["is_favorite"]
            ]);
        } else {
            self::where([
                "user_id" => Auth::id(),
                "item_id" => $item["id"]
            ])->delete();
        }
    }
}
