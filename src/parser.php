<?php
/**
 * Created by PhpStorm.
 * User: Main
 * Date: 2/11/16
 * Time: 21:03
 */

require_once(__DIR__.'/../Product.php');
require_once(__DIR__.'/../Warehouse.php');

class parser {

    static function Parse()
    {
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

        $inputFiles = scandir("./Input");
        foreach ($inputFiles as $fileName) {
            If($fileName == "." || $fileName == "..") {
                continue;
            }
            $file = file("./Input/".$fileName);


            $inputArray  = [];
            foreach ($file as $lineNum => $line) {
                $inputArray[] = $line;
            }

            $i = 0;
            $size = count($inputArray);


            for($i; $i < $size; ) {
                if ($i == 0) {
                    $line = explode(" ", trim($inputArray[$i]));
                    $world["rows"]                  = $line[0];
                    $world["cols"]                  = $line[1];
//                    $numDrones  = $line[2];
                    $world["simLength"]             = $line[3];
                    $world["droneMaxWeight"]        = $line[4];
                    $i += 2;
                } else if ($i == 2) {
                    $line = explode(" ", trim($inputArray[$i]));
                    foreach ($line as $productNum => $productWeight) {
                        $product = new Product($productNum, $productWeight);
                        $world["products"][] = $product;
                        $i++;
                    }
                } else if($i == 3) {
                    $numOfWarehouse = $inputArray[$i];
                    parser::getWarehouses($numOfWarehouse, $inputArray, $world["products"]);
                    $i += 2*$numOfWarehouse;
                } else {
                    parser::getOrders();
                }

            }
                echo ("1");




        }

        return $world;

    }

    function getWarehouses($numOfWarehouses, $inputFile, $products)
    {
        $i = 4;
        
        for($i;$i<=$numOfWarehouses;$i++)
        {
            $wareHouse = array();

            if($i%2 == 0){

            }
        }
    }

    function getOrders()
    {

    }


}
//Get the file from command line



