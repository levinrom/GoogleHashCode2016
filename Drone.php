<?php

/**
 * Created by PhpStorm.
 * User: noam
 * Date: 2/11/16
 * Time: 9:18 PM
 */
class Drone
{
    private $x;
    private $y;
    private $currentPayload;
    private $productsArray;
    private $status;
    private $maxPayload;

    function __construct($payload, $x, $y)
    {
        $this->maxPayload   = $payload;
        $this->x            = $x;
        $this->y            = $y;
        $this->status       = false;
    }

    function changeStatus()
    {
        $this->status = !$this->status;
    }

    function getStatus()
    {
        return $this->status;
    }

    function addProduct($prodId, $prodWeight ,$quantity)
    {
        $res = false;
        $totalWeight = $this->currentPayload + ($prodWeight * $quantity);
        if ($totalWeight <= $this->maxPayload) {
            $this->productsArray[$prodId] = $quantity;
            $this->currentPayload = $totalWeight;
            $res = true;
        }
        return $res;
    }


}