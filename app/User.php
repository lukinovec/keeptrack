<?php

namespace App;

use App\Models\UserItem;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function items()
    {
        return $this->hasMany(UserItem::class);
    }

    // Use with '()'
    /**
     * @param Integer $count  How many results do you want
     * @return Collection All movies with statuses where the user ID is the current logged users ID
     */

    public function getItems($count = 0)
    {
        $result = $this->items->sortByDesc("updated_at")->sortByDesc("is_favorite")->map(function ($result) {
            return collect($result)->merge($result->item);
        });

        if ($count != 0) {
            return $result->sortByDesc("updated_at")->sortByDesc("is_favorite")->slice(0, $count);
        }
        return $result;
    }
}
