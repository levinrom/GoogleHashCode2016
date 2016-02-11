<?php

/**
 * Created by PhpStorm.
 * User: noam
 * Date: 2/11/16
 * Time: 9:53 PM
 */
class Warehouse
{
    /**
     * @param $id
     * @param $x
     * @param $y
     * @param array $products
     */
    function __construct($id, $x, $y, $products)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
        $this->products = $products;
    }
}