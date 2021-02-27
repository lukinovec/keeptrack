<?php
namespace App\Classes;

use App\Models\UserItem;

class UserItemBlueprint extends Abstract\AbstractUserItem {
    public function __construct($item, string $status) {
        $this->user_id = auth()->id();
        $this->item_id = $item["id"];
        $this->status = $status;
        $this->user_progress = [];
        $this->type = $item["type"];
        $this->searchtype = $item["searchtype"];
    }

     // Přidejte typ do pole v případě, že v nové položce uživatel může mít nějaký progress (epizody, knihy)
    public $userProgressTypes = [
        "series" => ["episode" => 0, "season" => 1],
        "book" => ["pages_read" => 0],
        "anime" => ["episode" => 0],
    ];

    public function prepare() {
        if(array_key_exists($this->searchtype, $this->userProgressTypes)) {
            $this->user_progress = $this->userProgressTypes[$this->searchtype];
        } elseif(array_key_exists($this->type, $this->userProgressTypes)) {
            $this->user_progress = $this->userProgressTypes[$this->type];
        }

        return $this;
    }

    public function updateOrCreate() {
        $item = UserItem::firstWhere([
            "user_id" => $this->user_id,
            "item_id" => $this->item_id
        ]);

        if($item) {
            $item->update(["status" => $this->status]);
        } else {
            UserItem::create((array) $this);
        }
    }
}