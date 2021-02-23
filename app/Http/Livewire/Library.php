<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ItemUser;
use Illuminate\Support\Facades\Auth;

class Library extends Component
{
    protected $library = [];
    protected $library_original = [];
    protected $type;
    public $favorite_only = false;
    public $toUpdate;
    public $ratingDesc = true;
    public $nameAsc = true;

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

    public function sortBy(string $criteria, bool $descending)
    {
        switch($criteria) {
            case "name":
                if($descending) {
                    $this->library =Auth::user()->getItems()->sortByDesc("item.name");
                } else {
                    $this->library =Auth::user()->getItems()->sortBy("item.name");
                }
                break;

            case "rating":
                if ($descending) {
                    $this->library = Auth::user()->getItems()->sortByDesc("rating");
                } else {
                    $this->library = Auth::user()->getItems()->sortBy("rating");
                }
                break;
            default:
                $this->library = Auth::user()->getItems()->sortBy($criteria);
                break;
        }
    }

    // Update or delete
    public function updateItem($item, $type = "")
    {
        $item["id"] = $item["apiID"];
        $this->toUpdate = $item;
        $this->validate();

        ItemUser::updateDetails($item);

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
