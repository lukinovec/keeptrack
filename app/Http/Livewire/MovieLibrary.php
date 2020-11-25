<?php

namespace App\Http\Livewire;

class MovieLibrary extends Library
{
    public $type = "movie";

    public function render()
    {
        return view('livewire.movie-library', [
            "library" => $this->library,
            "type" => $this->type,
        ])->extends('app')
            ->section('content');
    }
}
