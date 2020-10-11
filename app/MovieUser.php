<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieUser extends Model
{
    protected $table = 'movie_user';
    protected $fillable = ['user_id', 'movie_id', 'status'];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
