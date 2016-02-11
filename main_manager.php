<?php

//require_once('optimization_strategy1.php');
//require_once('drone.php');
//require_once('product.php');
//require_once('warehouse.php');
//require_once('delivery.php');
//require_once('parser.php');




$world = [
    "droneMaxWeight" => 0,
    "simLength" => 0,
    "currentTurn" => 0,
    "rows" => 0,
    "cols" => 0,
    "warehouses" => [],
    "products" => [],
    "drones" => [],
    "deliveries" => []
];


$world = parser::Parse('input.in');

// Event loop
for ($currStep = 0; $currStep < $world["simLength"]; $currStep++) {

}