<?php

namespace App\Http\Livewire;

use App\Classes\LibraryDB;
use App\Book;
use App\Movie;
use Livewire\Component;

class Result extends Component
{
    public $item;
    public $searchtype;
    public $statuses = [];
    protected $listeners = ['changeStatus'];

    public function mount($item, $searchtype)
    {
        $this->item = $item;
        $this->searchtype = $searchtype;
        $this->statuses = LibraryDB::open()->getStatuses($item["type"]);
    }

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
        return view('livewire.result', ["item" => $this->item]);
    }
}
