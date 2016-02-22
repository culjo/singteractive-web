<?php
/**
 * Created by PhpStorm.
 * User: REDEEM
 * Date: 18/01/2016
 * Time: 07:48
 */

//require_once 'include/db_functions.php';
//$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['artist_id']) && isset($_POST['title'])){

    $artist_id = $_POST['artist_id'];
    $title = $_POST['title'];
    $file_name = $_POST['file_name'];
    $file_type = $_POST['file_type'];
    $file_ext = $_POST['file_ext'];
    $url = $_POST['url'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $year = $_POST['year'];

    //Attend to this
    $filename = 'user/dummy.mp3';

    if (file_exists($filename)){

        $response["error"] = true;
        $response["error message"] = "This file exist in your folder" . $title;
        echo json_encode($response);
    }
    else{
        //save the file
        $music = true;# $db->store_music_details($artist_id, $title, $file_name, $file_type, $file_ext, $url, $album,
        # $genre, $year);
        if ($music){
            $response["error"] = FAlSE;
            $response["aid"] = $music["artist_id"];
            $response["music"]["title"] = $music["title"];
            $response["music"]["file_name"] = $music["file_name"];
            $response["music"]["file_type"] = $music["file_type"];
            $response["music"]["file_ext"] = $music["file_ext"];
            $response["music"]["url"] = $music["url"];
            $response["music"]["album"] = $music["album"];
            $response["music"]["genre"] = $music["genre"];
            $response["music"]["year"] = $music["year"];
            $response["music"]["music_uploaded_on"] = $music["music_uploaded_on"];
            $response["music"]["music_update_on"] = $music["music_update_on"];

            echo json_encode($response);
        }

    }

} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (Artist_id, title) is missing!";
    echo json_encode($response);
}