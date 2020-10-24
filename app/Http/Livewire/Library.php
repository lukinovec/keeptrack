<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;

class Library extends Component
{
    public $library;
    public $season;
    public $episodes;
    public $progress;

    public function mount($library)
    {
        $this->library = $library;
    }

    public function updatedProgress($item)
    {
        $item["id"] = $item["imdbID"];
        $librarydb = new LibraryDB;
        $this->library = $librarydb->updateDetails((object) $item);
    }

    public function render()
    {
        return view('livewire.library', ["library" => $this->library])
            ->extends('app')
            ->section('content');
    }
}
