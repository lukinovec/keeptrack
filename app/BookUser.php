<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $table = 'book_user';
    protected $guarded = ['id'];
    protected $with = ['book'];
    protected $attributes = ['pages_read' => 0, 'is_favorite' => false];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->hasOne(Book::class, "apiID", "book_id");
    }
}
