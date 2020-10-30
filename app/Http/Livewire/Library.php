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
    public $progress;

    protected $listeners = ["emitLibraryType" => "getLibraryType", "librarySearch" => "getLibrarySearch"];

    public function mount($library)
    {
        $this->library = $library;
        $this->library_original = $library;
    }

    public function getLibraryType($type)
    {
        $this->type = $type;
    }

    // public function goToLibrary($item)
    // {
    //     dd($this->library->firstWhere("imdbID", json_decode($item)->id)->forget());
    //     $this->library = $this->library->prepend();
    // }

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

    public function updatedProgress($item)
    {
        $item["id"] = $item["imdbID"] ?: $item["goodreadsID"];
        $this->library = LibraryDB::open()->updateDetails((object) $item);
    }

    public function render()
    {
        return view('livewire.library', ["library" => $this->library, "type" => $this->type])
            ->extends('app')
            ->section('content');
    }
}
