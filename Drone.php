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
        $this->steps        = 0;
    }

    function changeStatus()
    {
        $this->status = !$this->status;
    }

    function isBusy()
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

    function doStep() {
        if ($this->steps > 0) {
            $this->steps--;
        } else {
            // get next command
            if (count($this->commands) > 0) {

            } else {
                // not busy
                $this->status = false;
            }
        }
    }

}