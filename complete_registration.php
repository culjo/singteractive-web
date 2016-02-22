<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 1/10/2016
 * Time: 8:53 AM
 */

require 'include/db_functions.php';

//Open a new DB Connection here
$db = new DB_Functions();

// Json response array
$response = array("error" => FALSE);

if(isset($_POST['user_id']) && isset($_POST['firstname']) && isset($_POST['lastname'])  && isset($_POST['displayname'])){

    //collect the post variables
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $displayname = $_POST['displayname'];

    //Before we do anything check if this person is already logged in
    if(isset($_POST['is_logged_in'])){
        $is_logged_in = $_POST['is_logged_in'];
        if($is_logged_in = true){

            //Continue the process
            //Update the userData profile here
            $db->updateAfterRegister($user_id, $firstname, $lastname, $displayname);

        }else{
            //Terminate the process

        }
    }

}
