<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use App\Classes\LibraryDB;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    public $library;
    public $library_original;
    public $type;
    public $search;
    public $toUpdate;
    public $statuses = [];

    public $listeners = ["updateItem", "favoriteItem"];

    // Filtering
    public $filter = "none";
    public $onlyFavorites = false;
    public $onlyAnime = false;

    // Form Validation
    protected $rules = [
        'toUpdate.rating' => 'nullable|integer|max:10|min:1',
        'toUpdate.episode' => 'nullable|integer',
        'toUpdate.pages_read' => 'nullable|integer'
    ];

    // Validation Error Messages
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
        $this->statuses = Status::where("type", $this->type)->firstOrFail();
        $this->library = Auth::user()->getByType($this->type);
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

    public function render()
    {
        return view('livewire.library', [
            "library" => $this->library,
            "type" => $this->type,
        ])->extends('app')
            ->section('content');
    }
}
