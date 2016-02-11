<?php

require_once('OptimiseOrders.php');
require_once('Drone.php');
require_once('Product.php');
require_once('Warehouse.php');
//require_once('Order.php');
require_once('src/parser.php');
require_once('Utils.php');


function getClosestWHWithProduct($pId) {

}

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
                foreach($order["deliveries"] as $delivery) {
                    // FROM WHERE?
                    // Get closest WH with the product
                    $possibleWH = [];
                    foreach($world["warehouses"] as $wh) {
                        if ($wh->hasProduct($delivery["pId"], $delivery["amount"])) {
                            $possibleWH[] = $wh;
                        }
                    }

                    // can make order
                    if (count($possibleWH) > 0) {

                        $whIndex = 0;
                        $minDist = 100000000;
                        // find closest
                        foreach($possibleWH as $i => $wh) {
                            $dist = Utils::distance($wh["x"], $wh["y"], $drone["x"], $drone["y"]);
                            if ($dist < $minDist) {
                                $minDist = $dist;
                                $whIndex = $i;
                            }
                        }

                        $chosenWh = $world["warehouses"][$whIndex];

                        if ($drone->addAction('LOAD', $chosenWh["x"], $chosenWh["y"], $delivery["pId"], $delivery["amount"])) {
                            $drone->addAction('DELIVER', $delivery["x"], $delivery["y"], $delivery["pId"], $delivery["amount"]);
                        }
                    }
                }
            }
        }
    }
}
