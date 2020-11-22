<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $table = 'book_user';
    protected $fillable = ['user_id', 'book_id', 'status', 'pages_read'];
    protected $attributes = ['pages_read' => 0];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
