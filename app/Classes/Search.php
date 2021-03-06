<?php

namespace App\Classes;

use Exception;
use App\Classes\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * @method start()
 * @method makeRequest(string $searchtype)
 * @method type(string $searchtype)
 * @method format()
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
     */

    public function makeRequest()
    {
        $request = Request::create($this->searchtype, $this->search)->search();
        return $this->format($this->searchtype, $request);
    }

    public function getStatusByApiId($apiID) {
        $statuses = Auth::user()->items->map(function ($item) {
            return ["apiID" => $item->item_id, "status" => $item->status];
        });
        return $statuses->firstWhere("apiID", $apiID)["status"] ?? "";
    }

    /**
     * Pro rozšíření backendu aplikace je třeba upravit tento soubor, Request.php a database/seeders/StatusSeeder.php
     * Pokud rozšíření ještě potřebuje další úpravy, například nastavení postupu, nebo získávání sérií, rozšiřte třídy ItemBlueprint a UserItemBlueprint
     * Pro rozšíření frontendu aplikace je třeba upravit soubor resources/views/livewire/search/result.blade.php - sekce @if($searchtype == ...)
     * Pokud rozšíření obsahuje položku user_progress,
     * je třeba upravit soubor resources/views/components/progress-component.blade.php
     * - najděte section tag a dovnitř přidejte <template x-if="item.type == jmeno_noveho_typu">, do tohoto tagu vložte svůj design pro úpravu uživatelova postupu.
     * Doporučuji <template> zkopírovat a jen přepsat hodnoty, které jsou pro vaše rozšíření jiné.
     */

    /**
     * @param string $type      Typ vyhledávání v jednotném čísle (movie, book,...)
     * @param mixed $response   Odpověď API ve formátu JSON
     * @return Collection|false Výsledky vyhledávání ve správném formátu pro zobrazení, nebo false - když vyhledávání selže
     */
    public function format($type, $response)
    {
        switch ($type) {
            case 'movie':
                if ($response["Response"] !== "True") {
                    return false;
                }

                return collect($response["Search"])->map(function ($item) {
                    return [
                        "id" => $item["imdbID"],
                        "searchtype" => "movie",
                        "title" => $item["Title"],
                        "year" => $item["Year"],
                        "type" => $item["Type"],
                        "image" => preg_replace('/_.*.jpg/', 'SX385', $item["Poster"]),
                        "status" => $this->getStatusByApiId($item["imdbID"])
                    ];
                });

            /**
             * Odpověď od Goodreads API je ve formátu XML, je třeba jej převést na JSON
             */
            case 'book':
                // Convert XML to JSON - https://stackoverflow.com/a/19391553
                $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
                $response = json_decode(json_encode($xml))->search->results->work ?? false;
                if ($response === false) {
                    return false;
                }

                if(gettype($response) !== "array") {
                    $response = [$response];
                }

                return collect($response)->map(function ($item) {
                    return collect([
                        "id" => is_object($item->best_book->id) ? $item->best_book->id->{"0"} : $item->best_book->id,
                        "searchtype" => "book",
                        "title" => $item->best_book->title,
                        "year" => is_object($item->original_publication_year) ? $item->original_publication_year->{"0"} ?? null : $item->original_publication_year ?? null,
                        "type" => "book",
                        "image" => preg_replace('/._.*_/', '._SY385_', $item->best_book->image_url),
                        "status" => $this->getStatusByApiId($item->best_book->id)
                    ]);
                })->whereNotNull("year");

            case 'anime':
                if (empty($response)) {
                    return false;
                }

                return collect($response)->map(function ($item) {
                    return [
                        "id" => $item["mal_id"],
                        "searchtype" => "anime",
                        "title" => $item["title"],
                        "year" => explode("-", $item["start_date"])[0],
                        "type" => $item["type"],
                        "image" => $item["image_url"],
                        "progress" => ["episodes" => $item["episodes"]],
                        "status" => $this->getStatusByApiId($item["mal_id"])
                    ];
                });

            default:
                throw new Exception("Invalid type supplied to the format function (Search.php class)", 1);
                break;
        }
    }
}
