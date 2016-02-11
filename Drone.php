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
    private $steps;

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

    /**
     * @param $type
     * @param $x
     * @param $y
     * @param Product $product
     * @param $productAmount
     */
    function addAction($type, $x, $y, $product, $productAmount) {
        $res = false;
        if (!$this->status) {
            if ($type == 'L') {
                if ($this->addProduct($product->getId(), $product->getWeight(), $productAmount)) {
                    $res = true;
                    $this->steps = ceil(sqrt(($this->x - $x)*($this->x - $x) + ($this->y - $y)*($this->y - $y)));
                    $this->status = true;
                    $this->x = $x;
                    $this->y = $y;
                }
            } else if ($type == 'D') {
                $res = true;
                $this->steps = ceil(sqrt(($this->x - $x)*($this->x - $x) + ($this->y - $y)*($this->y - $y)));
                $this->status = true;
                $this->x = $x;
                $this->y = $y;
            }
        }

        return $res;
    }

    function doStep() {
        if ($this->steps > 0) {
            $this->steps--;
        } else {
            $this->status = false;
        }
    }

}