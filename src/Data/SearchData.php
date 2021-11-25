<?php

namespace App\Data;

class SearchData {


    /**
     * @var string
     */
    public $q = '';


    /**
    *  @var string
    */
    public $brand = '';

    /**
    *  @var string
    */
    public $model = '';

    /**
    *  @var string
    */
    public $location = '';

    /**
    *  @var string
    */
    public $engine = '';

    /**
     * @var null|integer
     */
    public $maxPrice;

    /**
     * @var null|integer
     */
    public $minPrice;

    /**
     * @var null|integer
     */
    public $maxYear;

    /**
     * @var null|integer
     */
    public $minYear;

    /**
     * @var null|integer
     */
    public $maxMile;

    /**
     * @var null|integer
     */
    public $minMile;

    /**
     * Undocumented variable
     *
     * @var integer
     */
    public $page = 1;

}