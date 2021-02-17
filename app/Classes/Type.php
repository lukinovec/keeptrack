<?php
namespace App\Classes;

class Type {
    public function __construct(string $type) {
        $this->type = $type;
        $this->in_progress = "In progress";
        $this->planning = "Planning";
        $this->none = "None";
        $this->completed = "Completed";
        $this->image = file_exists(public_path("images/" . $this->type . ".svg")) ? "images/" . $this->type . ".svg" : "images/default-image.svg";
    }

    public static function new($type) {
        return new static($type);
    }

    public function change(string $attribute, string $change) {
        $this->$attribute = $change;
        return $this;
    }
}