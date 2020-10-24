<?php

namespace App;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Classes\Request;
use App\Classes\LibraryDB;
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
     * @return Array All movies with statuses where the user ID is the current logged users ID
     */
    public function movieList()
    {
        $movies = $this->movies;
        $movieList = [];
        // ["movie_id" => $record->movie_id, "status" => $record->status, "rating" => $record->rating, "note" => $record->note, "season" => $record->season, "episode" => $record->episode]
        foreach ($movies as $movie) {
            $found_movie = Movie::find($movie->movie_id);
            $found_movie->status = $movie->status;
            $found_movie->note = $movie->note;
            $found_movie->rating = $movie->rating;
            $found_movie->season = $movie->season;
            $found_movie->episode = $movie->episode;
            array_push($movieList, $found_movie);
        }

        foreach ($movieList as $movie) {
            if ($movie["type"] == "series") {
                $request_details = new Request("movie_details", $movie->imdbID);
                $totalSeasons = $request_details->search()["totalSeasons"];
                $seasons = [];
                for ($i = 1; $i <= $totalSeasons; $i++) {
                    array_push($seasons, ["number" => $i, "episodes" => $request_details->getSeason($i)["Episodes"]]);
                }
                $movie["seasons"] = $seasons;
            }
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
