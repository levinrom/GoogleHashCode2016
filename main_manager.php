<?php

require_once('OptimiseOrders.php');
require_once('Drone.php');
require_once('Product.php');
require_once('Warehouse.php');
require_once('Order.php');
require_once('src/parser.php');
require_once('Utils.php');


function parseCommand($drone, $cmd, $p1, $p2, $p3, $p4='') {
    return $drone->Id." ".$cmd." ".$p1." ".$p2." ".$p3;
}

function printCommands($commands) {
    foreach($commands as $command) {
        echo $command;
    }
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

$commands = [];

$world = parser::Parse();

// Event loop
for ($currStep = 0; $currStep < $world["simLength"]; $currStep++) {
    $optimize = new OptimiseOrders();
    $world["orders"] = $optimize->sortOrders($world);

    foreach ($world["drones"] as $drone) {
        if ($drone->getState() == "busy") {
            $result = $drone->doStep();
        }
        else {
            // find next suitable delivery. Sorted by importance.
            foreach($world["orders"] as $order) {
                foreach($order["deliveries"] as $delivery) {
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
                        $minDist = PHP_INT_MAX;
                        // find closest
                        foreach($possibleWH as $i => $wh) {
                            $dist = Utils::distance($wh, $drone);
                            if ($dist < $minDist) {
                                $minDist = $dist;
                                $whIndex = $i;
                            }
                        }

                        $chosenWh = $world["warehouses"][$whIndex];

                        if ($drone->addAction('L', $chosenWh["x"], $chosenWh["y"], $delivery["pId"], $delivery["amount"])) {
                            $drone->addAction('D', $delivery["x"], $delivery["y"], $delivery["pId"], $delivery["amount"]);

                            // Add to commands
                            // for Load: droneId L whId pId amount
                            $commands[] = parseCommand($drone, 'L', $chosenWh->id, $delivery["pId"], $delivery["amount"]);
                            $commands[] = parseCommand($drone, 'D', $order->id, $delivery["pId"], $delivery["amount"]);
                        }
                    }
                }
            }
        }
    }
}

printCommands($commands);