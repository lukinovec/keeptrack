<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Result extends Component
{
    public $item;
    public $infoid;
    protected $listeners = ['changeStatus'];

    public function mount($item)
    {
        $this->item = $item;
    }

    public function changeStatus($item, $status)
    {
        $this->item["status"] = $status;
    }

    public function render()
    {
        return view('livewire.result', ["item" => $this->item]);
    }
}
