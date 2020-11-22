<?php

namespace App\Http\Livewire;

class BookLibrary extends Library
{
    public $type = "book";

    public function render()
    {
        return view('livewire.book-library', [
            "library" => $this->library,
            "type" => $this->type
        ])->extends('app')
            ->section('content');
    }
}
