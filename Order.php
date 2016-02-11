<?php

/**
 * Created by PhpStorm.
 * User: noam
 * Date: 2/11/16
 * Time: 10:07 PM
 */
class Order
{
    private $x;
    private $y;
    private $array;
    private $oLock;
    private $id;

    function __construct($x, $y, $array, $id)
    {
        $this->x = $x;
        $this->y = $y;
        $this->array = $array;
        $this->oLock = false;
        $this->id = $id;
    }

    function getArray()
    {
        return $this->array();
    }

    function lock()
    {
        $res = true;
        if ($this->oLock) {
            $res = false;
        } else {
            $this->oLock = true;
        }
        return $res;
    }

    function release()
    {
        $this->oLock = false;
    }

    function updateOrder($array)
    {
        $res = false;
        if ($this->lock()) {
            $this->array = $array;
            $this->release();
            $res = true;
        }
        return $res;
    }

    function getId()
    {
        return $this->id;
    }
    

}