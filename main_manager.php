<?php

require_once('OptimiseOrders.php');
require_once('Drone.php');
//require_once('product.php');
require_once('Warehouse.php');
//require_once('delivery.php');
require_once('src/parser.php');


$world = [
    "droneMaxWeight" => 0,
    "simLength" => 0,
    "currentTurn" => 0,
    "rows" => 0,
    "cols" => 0,
    "warehouses" => [],
    "products" => [],
    "drones" => [],
    "orders" => []
];


$world = parser::Parse();

// Event loop
for ($currStep = 0; $currStep < $world["simLength"]; $currStep++) {
    $world["orders"] = OptimiseOrders::sortOrders($world);

    foreach ($world["drones"] as $drone) {
        if ($drone->getState() == "busy") {
            $result = $drone->doStep();
        }
        else {
            // find next suitable delivery

            foreach($world["orders"] as $order) {

            }
        }
    }
}
