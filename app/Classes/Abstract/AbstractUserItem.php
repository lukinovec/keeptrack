<?php
namespace App\Classes\Abstract;

abstract class AbstractUserItem {
    public string $status;
    public int $user_id;
    public array $user_progress;
    public string $item_id;
    public string $searchtype;
    public string $type;

    public abstract function __construct($item, string $status);
    public abstract function updateOrCreate();
    public abstract function prepare();
}