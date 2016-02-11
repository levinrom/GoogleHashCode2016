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

    function __construct($payload, $x, $y)
    {
        $this->maxPayload   = $payload;
        $this->x            = $x;
        $this->y            = $y;
        $this->status       = false;
    }




}