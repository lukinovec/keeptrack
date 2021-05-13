<?php

namespace App\Classes\Formatters;

abstract class Formatter implements FormatterInterface
{
    /**
     * @method Convert API response item to a format that is valid for displaying on the frontend
     *
     * 'id' => ID that is supplied by your API,
     * 'searchtype' => Keyword under which the user can search for this (movie, book... check StatusSeeder file),
     * 'title' => Title of the item,
     * 'year' => Year of release,
     * 'type' => Subtype of the item (movie, series...),
     * 'image' => Image of the item,
     *
     * @param mixed $item An item from the API response
     */
    abstract public function attributes($item);

    /**
     * @method validate Check if the response is valid, then prepare and return it
     * @param array|mixed $response API response
     */
    abstract public function validate($response);

    /**
     * @method transform Format item using attributes(), add status key with currently authenticated user's status
     * @param mixed $item An item from the API response
     */
    final public function transform($item)
    {
        $formattedItem = $this->attributes($item);

        $formattedItem['status'] = auth()->user()->items->map(function ($item) {
            return ['apiID' => $item->item_id, 'status' => $item->status];
        })->firstWhere('apiID', $formattedItem['id'])['status'] ?? '';

        return $formattedItem;
    }

    /**
     * @method format Validate response, format every response item using transform()
     * @param mixed $item An item from the API response
     */
    final public function format($response)
    {
        $response = $this->validate($response);
        if ($response) {
            return collect($response)->map(function ($item) {
                return $this->transform($item);
            });
        }

        return false;
    }
}
