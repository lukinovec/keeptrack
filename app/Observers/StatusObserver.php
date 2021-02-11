<?php

namespace App\Observers;

use App\Models\Status;
use Illuminate\Support\Facades\File;

class StatusObserver
{
    /**
     * Handle the Status "created" event.
     *
     * @param  \App\Models\Status  $status
     * @return void
     */
    public function created(Status $status)
    {
        $status->update([
            "image" => file_exists(public_path("images/" . $status->type . ".svg")) ? "images/" . $status->type . ".svg" : "images/default-image.svg"
        ]);
    }

    /**
     * Handle the Status "updated" event.
     *
     * @param  \App\Models\Status  $status
     * @return void
     */
    public function updated(Status $status)
    {
        if(file_exists(public_path("images/" . $status->type . ".svg"))) {
            $status->update(["image" => "images/" . $status->type . ".svg"]);
        };
    }

    /**
     * Handle the Status "deleted" event.
     *
     * @param  \App\Models\Status  $status
     * @return void
     */
    public function deleted(Status $status)
    {
        //
    }

    /**
     * Handle the Status "restored" event.
     *
     * @param  \App\Models\Status  $status
     * @return void
     */
    public function restored(Status $status)
    {
        //
    }

    /**
     * Handle the Status "force deleted" event.
     *
     * @param  \App\Models\Status  $status
     * @return void
     */
    public function forceDeleted(Status $status)
    {
        //
    }
}
