<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;
use App\Models\ItemUser;
use Illuminate\Support\Facades\Auth;

class RecentlyUpdated extends Component
{
    public $current;

    public function mount()
    {
        $this->current = Auth::user()->items->where("status", "watching")->whereNotNull("user_progress")->map(function ($item) {
            return collect($item)->merge($item->item);
        })->sortByDesc("updated_at");
    }

    public function submitChanges($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        ItemUser::updateDetails((object) $item);
    }

    public function render()
    {
        return view("livewire.recently-updated", [
            "current" => $this->current
        ])->extends("app")->section("content");
    }
}
