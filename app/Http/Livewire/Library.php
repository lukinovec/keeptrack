<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;

class Library extends Component
{
    public $library;
    public $library_original;
    public $type;
    public $search;
    public $toUpdate;
    public $statuses = [];

    // Filtering
    public $filter = "none";
    public $onlyFavorites = false;
    public $onlyAnime = false;


    protected $rules = [
        'toUpdate.rating' => 'nullable|integer|max:10|min:1',
        'toUpdate.episode' => 'nullable|integer',
        'toUpdate.pages_read' => 'nullable|integer'
    ];

    protected $messages = [
        'toUpdate.rating.integer' => "Rating must be a number (1-10)",
        'toUpdate.rating.max' => "Rating must be a number from 1 to 10",
        'toUpdate.rating.min' => "Rating must be a number from 1 to 10",
        'toUpdate.episode.integer' => "Episode must be a number",
        'toUpdate.pages_read.integer' => "Page must be a number",
    ];

    public function mount()
    {
        $this->type = request()->segment(2);
        $this->statuses = LibraryDB::open()->getStatuses($this->type);
        if ($this->type == "movie") {
            $this->library = auth()->user()->movieList();
        } else {
            $this->library = auth()->user()->bookList();
        }
        $this->library_original = $this->library;
    }

    public function updatedSearch($search)
    {
        if ($this->library->count() > 0 && $search !== "") {
            $this->library = $this->library->filter(function ($item) use ($search) {
                return stripos($item['name'], $search) !== false;
            });
        } else {
            $this->library = $this->library_original;
        }
    }

    public function updatedFilter($filter)
    {
        if ($filter == "none") {
            $this->filter = $filter;
            $this->library = $this->library_original;
        } elseif ($filter != "favorite") {
            $this->library = $this->library_original->filter(function ($item) use ($filter) {
                return $item["status"] == $filter;
            });
        } else {
            $this->library = $this->library_original->filter(function ($item) {
                return $item["is_favorite"];
            });
        }
    }


    public function updateItem($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        $this->toUpdate = $item;
        $this->validate();
        $this->library_original = LibraryDB::open()->updateDetails((object) $item);
        $this->library = $this->library_original;
    }

    public function favoriteItem($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        $this->library_original = LibraryDB::open()->updateDetails((object) $item);
        $this->library = $this->library_original;
    }
}
