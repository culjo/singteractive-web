<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/20/2016
 * Time: 12:40 PM
 */

if(isset($_POST["u"]) && isset($_POST["a"])){

    if(!empty($_POST["u"]) && isset($_POST["a"])){

        $user_id = $_POST['u']; $artist_id = $_POST['a'];

        include ('include/db_tables.php');
        spl_autoload_register(function($class_name){
            include "classes/" . $class_name . "_class.php";
        });

        $userContent = new UserContent();

        $contentData = $userContent->mySongs($user_id, $artist_id);

        if(!empty($contentData)){
            echo json_encode($contentData);
        }else{ echo "empty"; }//json_encode(["empty" => true]); }

    }else{ echo json_encode(["post" => "Post data Is empty"]); }

}


/*$user_id = 1; $artist_id = 2;

include ('include/db_tables.php');
spl_autoload_register(function($class_name){
    include "classes/" . $class_name . "_class.php";
});

$userContent = new UserContent();

$contentData = $userContent->mySongs($user_id, $artist_id);

if(!empty($contentData)){
    echo json_encode($contentData);
}else{ echo "empty"; }*/
