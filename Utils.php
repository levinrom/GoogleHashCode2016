<?php
/**
 * Created by PhpStorm.
 * User: shimon
 * Date: 2/11/16
 * Time: 22:24
 */

class Utils {
    public static function distance($a, $b) {
        return ceil(sqrt(pow($a->x - $b->x, 2) + pow($a->y - $b->y,2)));
    }
}