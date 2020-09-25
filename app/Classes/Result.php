<?php

namespace App\Classes;

class Result
{
    public $unformatted;
    public $formattedResults;
    public function __construct(array $array)
    {
        $this->unformatted = $array;
    }

    public function format()
    {
    }
}
