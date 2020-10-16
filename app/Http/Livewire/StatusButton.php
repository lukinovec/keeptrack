<?php

namespace App\Http\Livewire;

use App\Classes\Library;
use Livewire\Component;

class StatusButton extends Component
{
    public $item;
    public $status = "";
    public $statuses = [];

    public function mount($item)
    {
        $this->item = $item;
        $this->statuses = (new Library())->statuses($item["type"]);
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
