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

    /**
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    function hasProduct($productId, $quantity = 1) {
        $res = false;
        if ($this->products[$productId] >= $quantity) {
            $res = true;
        }
        return $res;
    }

    /**
     * @param int $productId
     * @param int $quantity
     * @return bool
     */
    function fetchProduct($productId, $quantity = 1) {
        if ($this->hasProduct($productId, $quantity)) {
            $this->products[$productId] -= $quantity;
            return false;
        } else {
            return false;
        }
    }


}