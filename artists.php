<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 1/29/2016
 * Time: 7:41 PM
 */

include ('include/db_tables.php');

spl_autoload_register(function($class_name){
    include "classes/" . $class_name . "_class.php";
});

$artistsOb = new Artists();

$artist_data = $artistsOb->getArtistsForHome();//getAllArtists();
//var_dump($artist_data);
echo  json_encode($artist_data);