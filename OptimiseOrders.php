<?php
/**
 * Created by PhpStorm.
 * User: shimon
 * Date: 2/11/16
 * Time: 21:26
 */

require_once("./Utils.php");

class OptimiseOrders {
    public $listOfOrders = array();

    public function sortOrders($warehouses, $orders, $drones) {

        // Give each order a score
        $orderByScore = array();
        //$warehousesForOrder
        foreach ($orders as $order) {
            $cOrderScore = 0;
            foreach ($order->products as $product) {
                list($cWarehouse, $cMinDist) += self::findClosestWarehouseDistance($product, $order, $warehouses);
                $cOrderScore += $cMinDist;
            }
            $orderByScore[$cOrderScore] = $order;
        }
        // Pick best one
        ksort($orderByScore);

        // update warehouses
        if (count($orderByScore) == 1) {
            $this->listOfOrders[] = $orderByScore[0];
            return;
        }
        else {
            $this->listOfOrders[] = $orderByScore[0];
            $this->sortOrders($warehouses, array_slice($orderByScore, 1), $drones);
        }
        // Order them by score
    }

    public static function findClosestWarehouseDistance($product, $order, $warehouses) {
        $minDist = -1;
        $minWarehouse = null;
        foreach ($warehouses as $warehouse) {
            if ($warehouse->hasProduct($product)) {
                $cDist = Utils::distance($warehouse, $order);
                if ($minDist == -1 || $cDist < $minDist) {
                    $minDist = $cDist;
                    $minWarehouse = $warehouse;
                }
            }
        }

        $closestWarehouseDistance = Utils::distance($minWarehouse, $order);
        return array($minWarehouse, $closestWarehouseDistance);
    }




}