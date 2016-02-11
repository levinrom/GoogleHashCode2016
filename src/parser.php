<?php
/**
 * Created by PhpStorm.
 * User: Main
 * Date: 2/11/16
 * Time: 21:03
 */

class parser {

    static function Parse()
    {
        $inputFile = scandir("./Input");
        foreach ($inputFile as $fileName) {
            $file = file($fileName);
        }

    }


}
//Get the file from command line


echo ("1");
