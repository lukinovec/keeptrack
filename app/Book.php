<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['goodreadsID', 'image', 'name', 'author', 'type', 'year'];
    protected $primaryKey = 'goodreadsID';
    protected $casts = ['goodreadsID' => 'string'];
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(BookUser::class, "book_id");
    }
}
