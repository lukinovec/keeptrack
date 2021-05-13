<?php

namespace App\Classes\Formatters;

interface FormatterInterface
{
    public function validate($response);

    public function transform($response);

    public function format($response);
}
