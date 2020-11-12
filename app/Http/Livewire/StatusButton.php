<?php

namespace App\Http\Livewire;

use App\Classes\LibraryDB;
use Livewire\Component;

class StatusButton extends Component
{
    public $item;
    public $status = "";
    public $statuses = [];

    public function mount($item)
    {
        $this->item = $item;
        $this->statuses = LibraryDB::open()->getStatuses($item["type"]);
    }

    public function render()
    {
        return view('livewire.status-button', [
            "status" => $this->status,
            "statuses" => $this->statuses,
            "item" => $this->item
        ]);
    }
}
