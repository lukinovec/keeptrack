<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Movie;
use App\Book;
use App\MovieUser;
use App\BookUser;

class Menu extends Component
{
    public $clicked = "";
    public $authUser;
    public $library = [];
    public $movieUser;
    public $bookUser;

    public function mount()
    {
        $this->library = [];
        $this->movieUser = MovieUser::where("user_id", $this->authUser)->get();
        $this->bookUser = BookUser::where("user_id", $this->authUser)->get();
    }

    public function getLibrary()
    {
        if ($this->clicked === "movies") {
            foreach ($this->movieUser as $result) {
                $movie = Movie::where("imdbID", $result->movie_id)->first();
                if ($movie) {
                    $movie->status = $result->status;
                    array_push($this->library, $movie);
                }
            }
            dd($this->library);
        } elseif ($this->clicked === "books") {
            foreach ($this->bookUser as $result) {
                $book = Book::where("goodreadsID", $result->book_id)->first();
                if ($book) {
                    $book->status = $result->status;
                    array_push($this->library, $book);
                }
            }
        } else {
            $this->library = "";
        }
    }

    public function updatedClicked()
    {
        $this->getLibrary();
    }

    public function render()
    {
        return view('livewire.menu', ['library' => $this->library]);
    }
}
