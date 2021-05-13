<?php

namespace App\Classes\Formatters;

class AnimeFormatter extends Formatter
{
    public function validate($response)
    {
        if (!empty($response)) {
            return $response;
        }

        return false;
    }

    public function attributes($item)
    {
        return [
            'id' => $item['mal_id'],
            'searchtype' => 'anime',
            'title' => $item['title'],
            'year' => explode('-', $item['start_date'])[0],
            'type' => $item['type'],
            'image' => $item['image_url'],
            'progress' => ['episodes' => $item['episodes']],
        ];
    }
}
