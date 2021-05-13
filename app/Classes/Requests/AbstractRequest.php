<?php

namespace App\Classes\Requests;

abstract class AbstractRequest
{
    abstract public function make($params);
}
