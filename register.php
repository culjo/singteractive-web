<?php
/**
 * Created by Lekan Olad.
 * User: Singtractive
 * Date: 12/30/2015
 * Time: 9:05 PM
 */

include 'include/db_tables.php';

spl_autoload_register(function($class_name){
    require 'classes/' . strtolower($class_name) . '_class.php';
});

$usersOb = new Users();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    // $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $is_artist = $_POST['is_artist'];

    // check if userData is already existed with the same email
    if ($usersOb->isUserExisted($email)) {
        // userData already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);

    } else {
        // create a new userData
        $user_data = $usersOb->storeUser($email, $password);

        if ($user_data) {
            // userData stored successfully

            if($is_artist == "1"){//Check if this person is an artist
                //insert into artist table
                $artistOb = new Artists();
                $artist_id = $artistOb->createArtist($user_data['user_id']);
                if($artist_id){
                    $response['user']['artist_id'] = $artist_id;
                }else{ //Perform some other conditions and retrial
                    $response['error_artist'] = "Failed to create the artist id data";
                }
            }

            $response["error"] = FALSE;
            $response['user']['user_id'] = $user_data['user_id'];
            $response["user"]["unique_id"] = $user_data["unique_id"];
            $response["user"]["email"] = $user_data["email"];
            $response["user"]["is_artist"] = $user_data["is_artist"];
            $response["user"]["created_at"] = $user_data["created_at"];

            echo json_encode($response);

        } else {
            // userData failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {

    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (email or password) is missing!";
    echo json_encode($response);
}