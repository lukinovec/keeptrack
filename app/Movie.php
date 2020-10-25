<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['imdbID', 'image', 'name', 'type', 'year', 'totalSeasons', 'seasons'];
    protected $primaryKey = 'imdbID';
    protected $casts = ['imdbID' => 'string'];
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(MovieUser::class, "movie_id");
    }
}
