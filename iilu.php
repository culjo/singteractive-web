<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/14/2016
 * Time: 4:39 PM
 */

spl_autoload_register(function($class_name){
    include "classes/" . $class_name . "_class.php";
});

$iilu = new Iilu();

echo json_encode($iilu->getAllIilu());
