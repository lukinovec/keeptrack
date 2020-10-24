<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieUser extends Model
{
    protected $table = 'movie_user';
    protected $fillable = ['user_id', 'movie_id', 'status', 'rating', 'season', 'episode'];
    protected $attributes = ['season' => 1, 'episode' => 1];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
