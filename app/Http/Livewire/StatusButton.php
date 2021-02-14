<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;

class StatusButton extends Component
{
    public $item;
    public $status = "";
    public $statuses = [];

    public function mount($item)
    {
        $this->item = $item;
        $this->statuses = Status::where("type", $item["type"]);
    }

    public function render()
    {
        return view('livewire.search.status-button', [
            "status" => $this->status,
            "statuses" => $this->statuses,
            "item" => $this->item
        ]);
    }
}
