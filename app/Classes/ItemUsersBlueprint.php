<?php
namespace App\Classes;

use App\Models\ItemUser;

class ItemUsersBlueprint {
    public function __construct($item, $status) {
        $this->user_id = auth()->id();
        $this->item_id = $item["id"];
        $this->user_progress = [];
        $this->status = $status;
        $this->type = $item["type"];
        $this->searchtype = $item["searchtype"];
    }

    public function create()
    {
        ItemUser::updateOrCreate((array) $this, ["status" => $this->status]);
    }
}