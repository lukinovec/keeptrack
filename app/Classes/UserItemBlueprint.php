<?php

namespace App\Classes;

// rozšiřitelnost
class UserItemBlueprint extends Abstract\AbstractUserItem
{
    // Přidejte typ do pole v případě, že v nové položce
    // uživatel může mít nějaký progress (epizody, knihy)
    public $userProgressTypes = [
        'series' => ['episode' => 0, 'season' => 1],
        'book' => ['pages_read' => 0],
        'anime' => ['episode' => 0],
    ];

    public function prepare()
    {
        if (array_key_exists($this->searchtype, $this->userProgressTypes)) {
            $this->user_progress = $this->userProgressTypes[$this->searchtype];
        } elseif (array_key_exists($this->type, $this->userProgressTypes)) {
            $this->user_progress = $this->userProgressTypes[$this->type];
        }

        return $this;
    }
}
