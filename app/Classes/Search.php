<?php

namespace App\Classes;

use Illuminate\Support\Collection;

/**
 * @method start()
 * @method make(string $searchtype)
 * @method type(string $searchtype)
 */
class Search
{
    public function __construct(string $searchtype, string $search)
    {
        $this->search = $search;
        $this->searchtype = $searchtype;
    }

    public static function start(string $searchtype, string $search)
    {
        return new static($searchtype, $search);
    }

    /**
     * @return Collection   Výsledky vyhledávání ve správném formátu pro zobrazení
     * Pro rozšíření backendu aplikace je třeba upravit tento soubor, Request.php a database/seeders/StatusSeeder.php
     * Pokud rozšíření ještě potřebuje další úpravy, například nastavení postupu, nebo získávání sérií, rozšiřte třídy ItemBlueprint a UserItemBlueprint
     * Pro rozšíření frontendu aplikace je třeba upravit soubor resources/views/livewire/search/result.blade.php - sekce @if($searchtype == ...)
     * Pokud rozšíření obsahuje položku user_progress,
     * je třeba upravit soubor resources/views/components/progress-component.blade.php
     * - najděte section tag a dovnitř přidejte <template x-if="item.type == jmeno_noveho_typu">, do tohoto tagu vložte svůj design pro úpravu uživatelova postupu.
     * Doporučuji <template> zkopírovat a jen přepsat hodnoty, které jsou pro vaše rozšíření jiné.
     */
    public function make()
    {
        $formatters = [
            'movie' => Formatters\MovieFormatter::class,
            'book' => Formatters\BookFormatter::class,
            'anime' => Formatters\AnimeFormatter::class,
        ];

        return (new $formatters[$this->searchtype])->format(
            Request::create($this->searchtype, $this->search)->search()
        );
    }
}
