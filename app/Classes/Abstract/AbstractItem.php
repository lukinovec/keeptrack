<?php

namespace App\Classes\Abstract;

use App\Models\Item;

abstract class AbstractItem
{
    public string $apiID;
    public array $progress;
    public string $searchtype;
    public string $image;
    public string $name;
    public string $type;
    public string $year;

    public function __construct($item)
    {
        $this->apiID = $item['id'];
        $this->progress = array_key_exists('progress', (array) $item) ? $item['progress'] : [];
        $this->searchtype = $item['searchtype'];
        $this->image = $item['image'];
        $this->name = $item['title'];
        $this->type = $item['type'];
        $this->year = $item['year'];
    }

    public function create()
    {
        Item::create((array) $this);
    }

    abstract public function prepare();
}
