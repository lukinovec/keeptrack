<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserItem;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    protected $library = [];
    protected $library_original = [];
    public $toUpdate;

    public function mount()
    {
        $this->library = $this->getUserLibrary();
        $this->library_original = $this->library;
    }

    public function getUserLibrary()
    {
        return Auth::user()->getItems();
    }

    // Update or delete
    public function updateItem($item, $type = "")
    {
        $item["id"] = $item["apiID"];
        $this->toUpdate = $item;

        UserItem::updateDetails($item);

        $this->library = Auth::user()->getItems();
        $this->library_original = $this->library;

        if($type == "favorite") {
            return redirect("library");
        }
    }

    public function render()
    {
        return view('livewire.library', [
            "library" => $this->library
        ])->extends('app')
            ->section('content');
    }
}
