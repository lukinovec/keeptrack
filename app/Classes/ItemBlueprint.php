<?php
namespace App\Classes;

use App\Models\Item;

class ItemBlueprint {
    public function __construct($item) {
        $this->apiID = $item["id"];
        $this->searchtype = $item["searchtype"];
        $this->image = $item["image"];
        $this->name = $item["title"];
        $this->type = $item["type"];
        $this->year = $item["year"];
    }

    public function create()
    {
        Item::create((array) $this);
    }
}