<?php

namespace App\Classes;
use App\Models\Item;

class ItemHandler {
    // Ověří, jestli položka existuje v databázi
    public function __invoke($item, string $status)
    {
        if (!Item::find($item["id"])) {
            (new ItemBlueprint($item))->prepare()->create();
        }

        (new UserItemBlueprint($item, $status))->prepare()->updateOrCreate();
    }
}