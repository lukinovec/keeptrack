<?php

namespace App\Search;

interface SearchInterface
{
    /**
     * @param Array $payload    pole obsahující druh vyhledávání a uživatelův vstup
     *  [
     *      "searchtype" => "",
     *      "search" => ""
     *  ]
     */
    public function search($payload);
}
