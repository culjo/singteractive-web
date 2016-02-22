<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/17/2016
 * Time: 3:46 AM
 */

if(isset($_POST['ud']) && isset($_POST['a'])) {

    if (!empty($_POST['ud']) && !empty($_POST['a'])) {
        $artist_id = strip_tags($_POST['a']);//artist_id
        $unique_id = strip_tags($_POST['ud']);//unique_id

        include ('include/db_tables.php');

        spl_autoload_register(function($class_name){
            include "classes/" . $class_name . "_class.php";
        });

        $artistsOb = new Artists();

        $artist_data = $artistsOb->getArtistProfile($unique_id, $artist_id);//getAllArtists();
        //var_dump($artist_data);

        echo json_encode($artist_data);
    }
}else{
    exit;
}

