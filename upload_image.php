<?php
/**
 * Created by PhpStorm.
 * User: WeaverBird
 * Date: 2/7/2016
 * Time: 2:50 PM
 */

include('upload.php');

//echo "Please We Are Here oohhh";

if(isset($_FILES['uploadedfile']['name'])){

    $uploaded = image_upload();

    if($uploaded) {
        echo json_encode(['uploaded' => 'true',
            'fileUploaded' => $_FILES['uploadedfile']['name'],
            "post_email" => $_POST['email']
        ]);

    }
    else {
        echo json_encode(['uploaded' => 'false', 'fileToUploaded' => $_FILES['uploadedfile']['name']]);
    }

}else{
    echo json_encode(['validate' => 'false']);
}

//echo "Please Help us ohhhh";