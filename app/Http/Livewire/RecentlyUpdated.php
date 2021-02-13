<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Classes\LibraryDB;
use App\Models\ItemUser;
use Illuminate\Support\Facades\Auth;

class RecentlyUpdated extends Component
{
    public $current;
    public $filter = "";

    public function mount()
    {
        $this->current = Auth::user()->items->where("status", "watching")->whereNotNull("user_progress")->sortByDesc("updated_at")->map(function ($item) {
            return collect($item)->merge($item->item);
        });
    }

    public function submitChanges($item)
    {
        $item["id"] = $item["apiID"] ?: $item["apiID"];
        ItemUser::updateDetails((object) $item);
    }

    public function render()
    {
        return view("livewire.recently-updated", [
            "current" => $this->current,
            "filter" => $this->filter
        ])->extends("app")->section("content");
    }
}
