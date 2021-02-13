<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ItemUser;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    public $library;
    public $library_original;
    public $type;
    public $search;
    public $toUpdate;

    // Form Validation
    protected $rules = [
        'toUpdate.rating' => 'nullable|integer|max:10|min:1',
        'toUpdate.episode' => 'nullable|integer',
        'toUpdate.pages_read' => 'nullable|integer'
    ];

    // Validation Error Messages
    protected $messages = [
        'toUpdate.rating.integer' => "Rating must be a number (1-10)",
        'toUpdate.rating.max' => "Rating must be a number from 1 to 10",
        'toUpdate.rating.min' => "Rating must be a number from 1 to 10",
        'toUpdate.episode.integer' => "Episode must be a number",
        'toUpdate.pages_read.integer' => "Page must be a number",
    ];

    public function mount($type = "any")
    {
        $this->type = $type;
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
        dd($item);
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
            "library" => $this->library,
            "type" => $this->type,
        ])->extends('app')
            ->section('content');
    }
}
