<?php
namespace App\Classes;

use App\Models\ItemUser;

class ItemUsersBlueprint {
    public function __construct($item, $status) {
        $this->user_id = auth()->id();
        $this->item_id = $item["id"];
        $this->status = $status;
        $this->type = $item["type"];
        $this->searchtype = $item["searchtype"];
    }

    public function updateOrCreate() {
        $item = ItemUser::firstWhere([
            "user_id" => $this->user_id,
            "item_id" => $this->item_id
        ]);

        if($item) {
            $item->update(["status" => $this->status]);
        } else {
            ItemUser::create((array) $this);
        }
    }
}