<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ItemUser;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    protected $library;
    protected $library_original;
    protected $type;
    protected $search;
    public $toUpdate;

    // Form Validation
    protected $rules = [
        'toUpdate.user_progress.episode' => 'nullable|integer',
        'toUpdate.user_progress.pages_read' => 'nullable|integer'
    ];

    // Validation Error Messages
    protected $messages = [
        'toUpdate.user_progress.episode.integer' => "Episode must be a number",
        'toUpdate.user_progress.pages_read.integer' => "Page must be a number",
    ];

    public function mount()
    {
        $this->library = Auth::user()->getItems();
        $this->library_original = $this->library;
    }

    public function updatedSearch($search)
    {
        if ($this->library->count() > 0 && $search !== "") {
            $this->library = $this->library->filter(function ($item) use ($search) {
                return stripos($item['name'], $search) !== false;
            });
        } else {
            $this->library = $this->library_original;
        }
    }

    // Update or delete
    public function updateItem($item)
    {
        $item["id"] = $item["apiID"];
        $this->toUpdate = $item;
        $this->validate();

        ItemUser::updateDetails($item);

        $this->library_original = Auth::user()->getItems();
        $this->library = $this->library_original;
    }

    public function render()
    {
        return view('livewire.library', [
            "library" => $this->library
        ])->extends('app')
            ->section('content');
    }
}
