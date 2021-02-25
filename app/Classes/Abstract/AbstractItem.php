<?php
namespace App\Classes\Abstract;

abstract class AbstractItem {
    /**
     * @var string $apiID
     * @var array $progress
     * @var string $searchtype
     * @var string $image
     * @var string $name
     * @var string $type
     * @var string $year
     *
     * @method __construct() $item
     * @method create()
     * @method prepare()
     */

    public string $apiID;
    public array $progress;
    public string $searchtype;
    public string $image;
    public string $name;
    public string $type;
    public string $year;

    public abstract function __construct($item);
    public abstract function create();
    public abstract function prepare();
}