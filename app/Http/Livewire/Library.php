<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use App\Models\UserItem;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    protected $library = [];
    protected $library_original = [];
    public $toUpdate;
    public $user_is_owner;

    public function mount(User $library_owner)
    {
        $this->user_is_owner = auth()->user() == $library_owner;
        $this->library = $library_owner->getItems();
        $this->library_original = $this->library;
    }

    // Update or delete
    public function updateItem($item, $type = '')
    {
        $item['id'] = $item['apiID'];
        $this->toUpdate = $item;

        UserItem::updateDetails($item);

        $this->library = Auth::user()->getItems();
        $this->library_original = $this->library;

        if ($type == 'favorite') {
            return redirect('library');
        }
    }

    public function render()
    {
        return view('livewire.library', [
            'library' => $this->library
        ])->extends('app')
            ->section('content');
    }
}
