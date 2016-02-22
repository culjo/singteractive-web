<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 1/28/2016
 * Time: 2:04 PM
 */

//Auto load the required classes
spl_autoload_register(function ($class_name){

    //echo $class_name;
    include('classes/' . strtolower($class_name) . "_class.php");

});

$users = new Users();
$data = $users->storeUser("Adeyemo@yahoo.com", "adeyemo");

var_dump($data);