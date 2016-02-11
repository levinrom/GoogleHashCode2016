<?php
/**
 * Created by PhpStorm.
 * User: shimon
 * Date: 2/11/16
 * Time: 21:26
 */


class OptimiseOrders {
    public static function sortOrders($world) {

        // Give each order a score
        $orderScores = array();
        foreach ($orders as $order) {
            $cOrderScore = 0;
            foreach ($order->products as $product) {
                $cOrderScore += self::findClosestWarehouse($product, $order, $warehouses);

            }
        }
        // Pick best one

        // Order them by score
    }

    public static function findClosestWarehouse($product, $order, $warehouses) {
        $minDist = -1;
        foreach ($warehouses as $warehouse) {
            if ($warehouse->has($product)) {
                $dist = ceil(sqrt(pow($warehouse->x - $order->x, 2) + pow($warehouse->y - $order->y,2)));
                if ($minDist == -1)
            }
        }
    }
}