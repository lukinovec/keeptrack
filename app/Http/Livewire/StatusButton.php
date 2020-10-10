<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusButton extends Component
{
    public $item;
    public $status = "";
    public $statuses = [
        "ptw" => "Plan to Watch",
        "completed" => "Completed",
        "watching" => "Watching",
        "" => ""
    ];

    public function mount($item)
    {
        $this->item = $item;
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
