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
        $this->statuses = $this->getStatuses($item["type"]);
    }

    public function getStatuses($type)
    {
        if ($type == "book") {
            return [
                "ptw" => "Plan to Read",
                "completed" => "Completed",
                "watching" => "Reading",
                "" => ""
            ];
        } else {
            return [
                "completed" => "Completed",
                "ptw" => "Plan to Watch",
                "watching" => "Watching",
                "" => ""
            ];
        }
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
