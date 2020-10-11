<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
     * @return Collection ID of all movies with statuses where the user ID is the current logged users ID
     */
    public function movies()
    {
        return $this->hasMany(MovieUser::class);
    }

    // Use with '()'
    /**
     * @return Array All movies with statuses where the user ID is the current logged users ID
     */
    public function movieList()
    {
        $movies = $this->movies;
        $movieList = [];
        foreach ($movies as $movie) {
            $found_movie = Movie::find($movie->movie_id);
            $found_movie->status = $movie->status;
            array_push($movieList, $found_movie);
        }
        return $movieList;
    }

    // Use with '()'
    /**
     * @return Array All books with statuses where the user ID is the current logged users ID
     */
    public function bookList()
    {
        $books = $this->books;
        $bookList = [];
        foreach ($books as $book) {
            $found_book = Book::find($book->book_id);
            $found_book->status = $book->status;
            array_push($bookList, $found_book);
        }
        return $bookList;
    }
}
