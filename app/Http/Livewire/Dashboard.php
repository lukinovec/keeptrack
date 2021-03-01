<?php

namespace App\Http\Livewire;

use App\Classes\Search;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class Dashboard extends Component
{
    public $clicked = "";
    public $searching = false;
    public String $search = "";
    public String $searchtype = "movie";
    public $searchResponse = false;
    public $minYear = null;
    public $maxYear = null;
    public $authUser;
    public $status;
    public $noResultsMessage = "";

    protected $listeners = ["changing-status" => "onStatusChange"];
    /**
     *
     */
    public function mount(\App\Models\Status $status)
    {
        $this->authUser = Auth::id() ?: "Not logged in.";
        $this->status = $status;
    }

    public function getAllStatuses()
    {
        return $this->status->all();
    }

    public function getStatusPlural(string $status_name)
    {
        return $this->status->where("type", $status_name)->first()->plural;
    }

    public function getRestrictedType()
    {
        return $this->status->where("type", $this->searchtype)->first()->restrict_type;
    }

    /**
     *
     */
    public function startSearching()
    {
        $this->reset('searchResponse');
        if (strlen(trim($this->search)) > 2) {
            $this->searchResponse = Search::start($this->searchtype, trim($this->search))->makeRequest();
            $this->noResultsMessage = $this->searchResponse === false ? "No results found" : "";
            $this->searching = false;
        } else {
            $this->searchResponse = false;
        }
    }

    public function onStatusChange($message, $type = "info")
    {
        flash($message)->{$type}()->livewire($this);
    }

    /**
     *
     */
    public function updated($updated_property)
    {
        if ($updated_property == "search" || $updated_property == "searchtype" && !$this->searching) {
            $this->startSearching();
        }
    }

    public function render()
    {
        return view("livewire.dashboard", [
            "searchResponse" => $this->searchResponse,
            "authUser" => $this->authUser,
        ])
            ->extends("app")
            ->section("content");
    }
}
