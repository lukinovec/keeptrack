<?php

namespace App\Classes\Formatters;

class MovieFormatter extends Formatter
{
    // Check if response valid and return the items
    public function validate($response)
    {
        if ($response['Response'] === 'True') {
            return $response['Search'];
        }

        return false;
    }

    public function attributes($item)
    {
        return [
            'id' => $item['imdbID'],
            'searchtype' => 'movie',
            'title' => $item['Title'],
            'year' => $item['Year'],
            'type' => $item['Type'],
            'image' => preg_replace('/_.*.jpg/', 'SX385', $item['Poster']),
        ];
    }
}
