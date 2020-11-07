<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notes extends Component
{
    public $note;
    public $item;

    public function mount($item)
    {

        $note = User::find(Auth::id())->findItem($item['type'], $item['apiID'])->first();
        $this->note = $note->note;
        // ->findItem($item['type'], $item['id'])->note);
    }

    // public function updatedItem($item)
    // {

    // }

    public function render()
    {
        return view('livewire.notes', ["note" => $this->note]);
    }
}
