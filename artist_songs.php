<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/17/2016
 * Time: 4:59 AM
 * Tracks displays list of a particular artist songs
 */

if(isset($_POST['a'])){
    if(!empty($_POST['a'])){
        $artist_id = strip_tags($_POST['a']);

        include ('include/db_tables.php');

        spl_autoload_register(function($class_name){
            include "classes/" . $class_name . "_class.php";
        });

        $artistsOb = new Artists();

        $artist_data = $artistsOb->getArtistTracks($artist_id);
        //var_dump($artist_data);

        if(!empty($artist_data)){
            echo json_encode($artist_data);
        }else{
            echo json_encode(["empty" => true]);
        }

    }else{ echo json_encode(["post" => "Get is empty"]);}
}else{
    //Terminate the whole thingy
    echo json_encode(["post" => "Get not set"]);
    exit;
}
