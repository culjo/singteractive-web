<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/11/2016
 * Time: 9:29 AM
 */

//include ('include/db_tables.php');

spl_autoload_register(function($class_name){
    include "classes/" . $class_name . "_class.php";
});

$eventOb = new Events();

$event_data = $eventOb->getEventsForHome();
echo  json_encode($event_data);