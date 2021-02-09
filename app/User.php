<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

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
     * @param Integer $count  How many results do you want
     * @return Collection All movies with statuses where the user ID is the current logged users ID
     */
    public function usersMovies($count = 0)
    {
        $result = $this->movies->map(function ($movie) {
            return collect($movie)->merge($movie->movie);
        });

        if ($count != 0) {
            return $result->sortByDesc('updated_at')->slice(0, $count);
        }
        return $result;
    }

    public function getByType($type, $count = 0)
    {
        $result = $this->{$type . 's'}->map(function ($item) use ($type) {
            return collect($item)->merge($item->$type);
        });

        if ($count != 0) {
            return $result->sortByDesc('updated_at')->slice(0, $count);
        }
        return $result;
    }

    // Use with '()'
    /**
     * @return Collection All books with statuses where the user ID is the current logged users ID
     */
    public function usersBooks($count = 0)
    {
        $result = $this->books->map(function ($book) {
            return collect($book)->merge($book->book);
        });

        if ($count != 0) {
            return $result->slice(0, $count);
        }
        return $result;
    }
}
