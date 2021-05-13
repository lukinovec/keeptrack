<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserItem extends Model
{
    use HasFactory;

    protected $table = 'user_item';
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
        return $this->hasOne(Item::class, 'apiID', 'item_id');
    }

    public static function updateDetails($item)
    {
        $item = collect($item);
        $to_find = [
            'user_id' => Auth::id(),
            'item_id' => $item['id']
        ];

        if ($item['status'] !== 'none') {
            self::where($to_find)->update([
                'user_progress' => $item['user_progress'],
                'rating' => $item['rating'],
                'note' => $item['note'],
                'status' => $item['status'],
                'is_favorite' => $item['is_favorite']
            ]);
        } else {
            self::where($to_find)->delete();
        }
    }
}
