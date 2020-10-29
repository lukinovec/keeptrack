<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Classes\Request;
use Debugbar;
use App\Movie;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    // Use without '()'
    /**
     * @return Collection ID of all books with statuses where the user ID is the current logged users ID
     */
    public function books()
    {
        return $this->hasMany(BookUser::class);
    }

    /**
     * @return Collection ID of all movies with statuses and other things where the user ID is the current logged users ID
     */
    public function movies()
    {
        return $this->hasMany(MovieUser::class);
    }

    public function findItem($type, $item_id)
    {
        if ($type == "book") {
            return $this->book($item_id);
        } else {
            return $this->movie($item_id);
        }
    }

    /**
     * @param Integer $movie_id  ID of movie to search
     * @return Collection All movies with statuses and other things where the user ID is the current logged users ID and has movie ID that is submitted as a parameter
     */
    public function movie($movie_id)
    {
        return $this->movies->where("movie_id", $movie_id);
    }

    /**
     * @param Integer $book_id  ID of book to search
     * @return Collection All books with statuses and other things where the user ID is the current logged users ID and has book ID that is submitted as a parameter
     */
    public function book($book_id)
    {
        return $this->books->where("book_id", $book_id);
    }

    // Use with '()'
    /**
     * @return Collection All movies with statuses where the user ID is the current logged users ID
     */
    public function movieList()
    {
        return $this->movies->map(function ($movie) {
            return collect(
                Movie::find(collect($movie)
                    ->forget(["id", "user_id", "created_at", "updated_at"])
                    ->get("movie_id"))
            )->merge($movie);
        });
    }

    // Use with '()'
    /**
     * @return Collection All books with statuses where the user ID is the current logged users ID
     */
    public function bookList()
    {
        return $this->books->map(function ($book) {
            return collect(Book::find($book->book_id))->replace(["status" => $book->status]);
        });
    }
}
