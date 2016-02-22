<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/6/2016
 * Time: 8:46 AM
 */

include 'include/db_tables.php';

spl_autoload_register(function($class_name){
    require 'classes/' . strtolower($class_name) . '_class.php';
});

$usersObj = new Users();

$response = array("error" => FALSE);

if(isset($_POST['unique_id']) && isset($_POST['user_id'])){


    $unique_id = $_POST['unique_id'];
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $displayname = $_POST['displayname'];

    if(!empty($firstname) && !empty($lastname) && !empty($displayname)){

        if($usersObj->storeInfoAfterRegistration($user_id, $unique_id, $firstname, $lastname, $displayname)){

            $response['error'] = FALSE;
            echo json_encode($response);

        }else{

            $response['error'] = TRUE;
            $response['error_msg'] = "Error Completing your Information";
            echo json_encode($response);

        }

    }else{
        $response['error'] = TRUE;
        $response['error_msg'] = "Please Fill in Your Details";
        echo json_encode($response);
    }

}else{

    $response["error"] = TRUE;
    $response["error_msg"] = "Please Submit A valid Data to us";
    echo json_encode($response);

}