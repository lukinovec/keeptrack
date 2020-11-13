<?php

namespace App\Http\Livewire;

use App\Classes\LibraryDB;
use App\Book;
use App\Movie;
use Livewire\Component;

class Result extends Component
{
    public $item;
    public $infoid;
    public $statuses = [];
    protected $listeners = ['changeStatus'];

    public function mount($item, $infoid)
    {
        $this->item = $item;
        $this->infoid = $infoid;
        $this->statuses = LibraryDB::open()->getStatuses($item["type"]);
    }

    // public function changeStatus($item, $status)
    // {
    //     $this->item["status"] = $status;
    // }

    public function updatedItemStatus($status)
    {
        if ($this->item["type"] == "book") {
            Book::updateStatus($this->item, $status);
        } else {
            Movie::updateStatus($this->item, $status);
        }
    }

    public function render()
    {
        return view('livewire.result', ["item" => $this->item, "infoid" => $this->infoid]);
    }
}
