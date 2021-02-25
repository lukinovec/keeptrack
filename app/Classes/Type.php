<?php
namespace App\Classes;

/**
 * Každá proměnná inicializovaná v konstruktoru je povinná
 * Proměnné určují, jak se statusy zobrazují uživateli (například in_progress -> "Watching")
 * Většinou nebudete upravovat žádné, nebo jen planning a in_progress (pomocí metody change())
 *
 * @method static new()         Vytvoří objekt třídy Type
 * @var string $type            například "movie"
 * @var string $in_progress     například "Watching"
 * @var string $planning        například "Plan to Watch"
 * @var string $none
 * @var string $completed
 * @var string $plural
 * @var array $restrict_types   nežádoucí typy, které se při vyhledávání nezobrazí
 * @var string $image           pokud existuje ve složce public/images/ existuje .svg soubor, který názvem odpovídá
 */
class Type {
    public function __construct(string $type) {
        $this->type = $type;
        $this->in_progress = "In progress";
        $this->planning = "Planning";
        $this->none = "None";
        $this->completed = "Completed";
        $this->restrict_type = "";
        $this->plural = $this->type . "s";
        $this->image = file_exists(public_path("images/" . $this->type . ".svg")) ? "images/" . $this->type . ".svg" : "images/default-image.svg";
    }

    public static function new($type) {
        return new static($type);
    }

    public function change(string $attribute, $change) {
        $this->$attribute = $change;
        return $this;
    }
}