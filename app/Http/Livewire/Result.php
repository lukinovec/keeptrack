<?php

namespace App\Http\Livewire;

use App\Classes\LibraryDB;
use App\Book;
use App\Movie;
use Livewire\Component;

class Result extends Component
{
    public $result;
    public $searchtype;
    public $resultStatus;
    public $updating;
    public $statuses = [];

    /**
     * Po nasazení komponentu přiřadit props proměnným v komponentu
     *
     * Pomocí třídy LibraryDB získá statusy příslušného typu (např. film - "plan to watch", kniha - "plan to read")
     *
     * @param array|object $item   prop - výsledek vyhledávání
     * @param String $searchtype   prop - typ vyhledávané položky (film nebo kniha)
     */

    public function mount($item, String $searchtype): void
    {
        $this->result = $item;
        $this->searchtype = $searchtype;
        $this->statuses = LibraryDB::open()->getStatuses($item["type"]);
    }

    /**
     * Funkce se aktivuje pokaždé, co se proměnná resultStatus změní
     *
     * Aktualizuje status položky pomocí metody updateStatus
     *
     * @param String $status parametr funkce automaticky obdrží po změně proměnné resultStatus a obsahuje změnu
     * @return void
     */

    public function updatedResultStatus(String $status): void
    {
        $this->updating = true;
        if ($this->result["type"] == "book") {
            Book::updateStatus($this->result, $status);
        } else {
            Movie::updateStatus($this->result, $status);
        }
        $this->updating = false;
        session()->flash('message', 'Item is now available in your library!');
    }

    public function render()
    {
        return view('livewire.search.result', ["result" => $this->result, "updating" => $this->updating]);
    }
}
