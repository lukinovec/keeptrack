<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieUser extends Model
{
    protected $table = 'movie_user';
    protected $guarded = ['id'];
    protected $with = ['movie'];
    protected $attributes = ['season' => 1, 'episode' => 1, 'is_favorite' => false];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->hasOne(Movie::class, "apiID", "movie_id");
    }
}
