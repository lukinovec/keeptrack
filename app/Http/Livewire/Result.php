<?php

namespace App\Http\Livewire;

use App\Book;
use App\Movie;
use App\Models\Item;
use App\Models\Status;
use Livewire\Component;
use App\Classes\LibraryDB;
use App\Models\ItemUser;

class Result extends Component
{
    public $result;
    public $searchtype;
    public $resultStatus;
    public $message = "";
    public $statuses = [];

    /**
     * Po nasazení komponentu přiřadit props proměnným v komponentu
     *
     * Pomocí modelu Status získá statusy příslušného typu (např. film - "plan to watch", kniha - "plan to read")
     *
     * @param array|object $item   prop - výsledek vyhledávání
     * @param String $searchtype   prop - typ vyhledávané položky (film nebo kniha)
     */

    public function mount($item, String $searchtype): void
    {
        $this->result = $item;
        $this->searchtype = $searchtype;
        $this->statuses = Status::where("type", $searchtype)->firstOrFail();
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
        $this->message = "Changing item status...";

        // Delete item from user's library
        if ($status === "none") {
            $this->result["status"] = "none";
            ItemUser::updateDetails(json_decode(collect($this->result)->toJson()));
            $this->resultStatus = "";
            $this->message = "
            <span>
                Item deleted from <a class='underline' href='/library/{$this->searchtype}'>your library</a>
            </span>
            ";
        } else {
            // Update status
            Item::updateStatus($this->result, $status);

            $this->message = "
            <span>
                Item added to <a class='underline' href='/library/{$this->searchtype}'>your library</a>
            </span>
            ";
        }
    }

    public function render()
    {
        return view('livewire.search.result', ["result" => $this->result, "message" => $this->message]);
    }
}
