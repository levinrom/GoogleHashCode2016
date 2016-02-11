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

    public function sortOrders($world) {

        $orders = $world->orders;
        $warehouses = $world->warehouses;
        $drones = $world->drones;

        // Give each order a score
        $orderByScore = array();
        $warehousesForOrder = array();
        foreach ($orders as $order) {
            $cOrderScore = 0;

            foreach ($order->products as $productId => $productCount) {
                list($cWarehouse, $cMinDist) = self::findClosestWarehouseDistance($productId, $productCount, $order, $warehouses);
                $cOrderScore += $cMinDist;
                $warehousesForOrder[$cWarehouse->id] = array('id' => $productId, 'quantity' => $productCount);
            }
            $orderByScore[$cOrderScore] = array(
                'order' => $order,
                'warehouses' => $warehousesForOrder,
            );
        }
        // Pick best one
        ksort($orderByScore);
        $selectedOrder = $orderByScore[0];

        // Update warehouses
        foreach ($selectedOrder['warehouses'] as $wId => $wProduct ) {
            $cWarehouse = $warehouses[$wId];
            /** @var $cWarehouse Warehouse */
            $cWarehouse->fetchProduct($wProduct['id'], $wProduct['quantity']);
            $warehouses[$wId] = $cWarehouse;
        }


        if (count($orderByScore) == 1) {
            $this->listOfOrders[] = $orderByScore[0];
            return $this->listOfOrders;
        }
        else {
            $this->listOfOrders[] = $orderByScore[0];
            $this->sortOrders($warehouses, array_slice($orderByScore, 1), $drones);
        }

    }

    public static function findClosestWarehouseDistance($productId, $productCount, $order, $warehouses) {
        $minDist = PHP_INT_MAX;
        $minWarehouse = null;
        foreach ($warehouses as $warehouse) {
            /** @var $warehouse Warehouse */
            if ($warehouse->hasProduct($productId, $productCount)) {
                $cDist = Utils::distance($warehouse, $order);
                if ($cDist < $minDist) {
                    $minDist = $cDist;
                    $minWarehouse = $warehouse;
                }
            }
        }

        return array($minWarehouse, $minDist);
    }




}