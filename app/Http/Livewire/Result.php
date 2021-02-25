<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Status;
use Livewire\Component;
use App\Models\UserItem;

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

    public function mount($result, String $searchtype, Status $status): void
    {
        $this->result = $result;
        $this->searchtype = $searchtype;
        $this->resultStatus = $result["status"];
        $this->statuses = $status->where("type", $searchtype)->firstOrFail();
    }

    /**
     * Funkce se aktivuje pokaždé, co se proměnná resultStatus změní
     *
     * Aktualizuje status položky pomocí metody handleUpdate
     *
     * @param String $status parametr funkce automaticky obdrží po změně proměnné resultStatus a obsahuje změnu
     * @return void
     */

    public function updatedResultStatus(String $status): void
    {
        // Delete item from user's library
        if ($status === "none") {
            $this->result["status"] = "none";
            UserItem::updateDetails(json_decode(collect($this->result)->toJson()));
            $this->resultStatus = "none";
            $this->emit("changing-status", "<span>Item deleted from <a class='underline' href='/library'>your library</a></span>", "success");
        } else {
            // Update status
            Item::handleUpdate($this->result, $status);
            $this->emit("changing-status", "<span>Item status updated. See it in <a class='underline' href='/library'>your library</a></span>", "success");
        }
    }

    public function render()
    {
        return view('livewire.search.result', ["result" => $this->result]);
    }
}
