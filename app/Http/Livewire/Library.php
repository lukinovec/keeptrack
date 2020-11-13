<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;

class Library extends Component
{
    public $library;
    public $library_original;
    public $librarySearch;
    public $type;
    public $season;
    public $episodes;
    public $toUpdate;
    public $test;
    public $statuses = [];

    protected $rules = [
        'toUpdate.rating' => 'integer|max:10|min:1',
        'toUpdate.episode' => 'integer'
    ];

    protected $messages = [
        'toUpdate.rating.integer' => "Rating must be a number (1-10)",
        'toUpdate.rating.max' => "Rating must be a number from 1 to 10",
        'toUpdate.rating.min' => "Rating must be a number from 1 to 10",
        'toUpdate.episode.integer' => "Episode must be a number"
    ];

    protected $listeners = ["emitLibraryType" => "getLibraryType", "librarySearch" => "getLibrarySearch"];

    public function mount($library)
    {
        $this->library = $library;
        $this->library_original = $library;
        $this->statuses = LibraryDB::open()->getStatuses($this->type);
    }

    public function getLibraryType($type)
    {
        $this->type = $type;
    }

    public function getLibrarySearch($search)
    {
        if ($this->library->count() > 0 && $search !== "") {
            $this->library = $this->library->filter(function ($item) use ($search) {
                return stripos($item['name'], $search) !== false;
            });
        } else {
            $this->library = $this->library_original;
        }
    }

    public function updateItem($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        $this->toUpdate = $item;
        $this->validate();
        $this->library = LibraryDB::open()->updateDetails((object) $item);
    }

    public function render()
    {
        return view('livewire.library', [
            'library' => $this->library->sortByDesc('updated_at'),
            'type' => $this->type
        ])->extends('app')
            ->section('content');
    }
}
