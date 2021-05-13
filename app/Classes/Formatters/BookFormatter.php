<?php

namespace App\Classes\Formatters;

class BookFormatter extends Formatter
{
    public function validate($response)
    {
        if ($response) {
            // Convert XML to JSON - https://stackoverflow.com/a/19391553
            $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
            $decodedResponse = json_decode(json_encode($xml))->search->results->work ?? false;

            if ($decodedResponse) {
                if (gettype($decodedResponse) !== 'array') {
                    $decodedResponse = [$decodedResponse];
                }
            }

            return $response;
        }

        return false;
    }

    public function attributes($item)
    {
        return [
            'id' => is_object($item->best_book->id) ? $item->best_book->id->{'0'} : $item->best_book->id,
            'searchtype' => 'book',
            'title' => $item->best_book->title,
            'year' => is_object($item->original_publication_year) ? $item->original_publication_year->{'0'} ?? null : $item->original_publication_year ?? null,
            'type' => 'book',
            'image' => preg_replace('/._.*_/', '._SY385_', $item->best_book->image_url),
        ];
    }
}
