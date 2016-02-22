<?php
/**
 * Created by Lekan Olad.
 * User: Singteractive
 * Date: 12/30/2015
 * Time: 9:10 PM
 */

include 'include/db_tables.php';

spl_autoload_register(function($class_name){
    require 'classes/' . strtolower($class_name) . '_class.php';
});

$userOb = new Users();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = "singteractive@yahoo.com";//$_POST['email'];
    $password = 'singteractive';//$_POST['password'];
    //$response['email'] = $email . ' *** '. $password;

    // get the userData by email and password
    $user_data = $userOb->getUserByEmailAndPassword($email, $password);

    if ($user_data != null) {

    	if($user_data["is_artist"] == 1){
    		//Go to the Db and retrieve is artist details
    		$artist = $userOb->getArtistId($user_data["user_id"]);
            //var_dump($artist);
    		if($artist != null){
    			$response["user"]["artist_id"] = $artist["artist_id"];
    		}else{
    			$response["user"]["artist_id"] = 0;
    		}
    	}
        // user is found
        $response["error"] = FALSE;
        $response["user"]["user_id"] = $user_data["user_id"];
        $response["user"]["unique_id"] = $user_data["unique_id"];
        $response["user"]["display_name"] = $user_data["displayname"];
        $response["user"]["email"] = $user_data["email"];
        $response["user"]["is_artist"] = $user_data["is_artist"];
        $response["user"]["created_at"] = $user_data["created_at"];
        echo json_encode($response);

    } else {
        // userData is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}