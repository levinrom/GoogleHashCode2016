<?php

/**
 * Created by PhpStorm.
 * User: noam
 * Date: 2/11/16
 * Time: 10:01 PM
 */
class Product
{
    private $id;
    private $weight;

    function __construct($id, $weight)
    {
        $this->id = $id;
        $this->weight = $weight;
    }

    function getId()
    {
        return $this->id;
    }

    function getWeight()
    {
        return $this->weight;
    }
}