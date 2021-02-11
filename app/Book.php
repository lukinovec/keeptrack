<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['apiID', 'image', 'name', 'author', 'type', 'year'];
    protected $primaryKey = 'apiID';
    protected $casts = ['apiID' => 'string'];
    public $incrementing = false;

    public function users()
    {
        return $this->hasMany(BookUser::class, "book_id");
    }

    // Update book's status in DB, if the movie doesn't exist in DB, create a new record
    public static function updateStatus($book, $status)
    {
        $get_book = self::find($book["id"]);
        if ($get_book) {
            BookUser::updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "book_id" => $get_book->apiID
                ],
                ["status" => $status]
            );
        } else {
            self::create([
                "apiID" => $book["id"],
                "image" => preg_replace('/._.*_/', '._SY385_', $book["image"]),
                "name" => $book["title"],
                "type" => "book",
                "year" => $book["year"]
            ]);
            BookUser::create([
                "user_id" => auth()->id(),
                "book_id" => $book["id"],
                "status" => $status,
            ]);
        }
    }
}
