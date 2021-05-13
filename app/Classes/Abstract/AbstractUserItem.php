<?php

namespace App\Classes\Abstract;

use App\Models\UserItem;

abstract class AbstractUserItem
{
    public string $status;
    public int $user_id;
    public array $user_progress;
    public string $item_id;
    public string $searchtype;
    public string $type;

    public function __construct($item, string $status)
    {
        $this->user_id = auth()->id();
        $this->item_id = $item['id'];
        $this->status = $status;
        $this->user_progress = [];
        $this->type = $item['type'];
        $this->searchtype = $item['searchtype'];
    }

    public function updateOrCreate()
    {
        $item = UserItem::firstWhere([
            'user_id' => $this->user_id,
            'item_id' => $this->item_id
        ]);

        if ($item) {
            $item->update(['status' => $this->status]);
        } else {
            UserItem::create((array) $this);
        }
    }
}
