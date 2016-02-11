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

    function __construct($x, $y, $array)
    {
        $this->x = $x;
        $this->y = $y;
        $this->array = $array;
        $this->oLock = false;
        $this->id = $this->gen_uuid();
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

    function gen_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,

            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }

}