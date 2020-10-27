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

    // Update book's status in DB, if the movie doesn't exist in DB, create a new record
    public static function updateStatus($book, $status)
    {
        $get_book = self::find($book->id);
        if ($get_book) {
            $book_id = $get_book->imdbID;
            BookUser::updateOrCreate(
                [
                    "user_id" => auth()->id(),
                    "book_id" => $book_id
                ],
                ["status" => $status]
            );
        } else {
            self::create([
                "goodreadsID" => $book->id,
                "image" => $book->image,
                "author" => $book->creator_name,
                "name" => $book->title,
                "type" => "book",
                "year" => $book->year
            ]);
            BookUser::create([
                "user_id" => auth()->id(),
                "book_id" => $book->id,
                "status" => $status
            ]);
        }
    }
}
