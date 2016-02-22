<?php
/**
 * Created by PhpStorm.
 * User: TK
 * Date: 06/02/2016
 * Time: 16:12
 */

/**
 * this file was used to test the singteracive server on the system logic
 */

include('upload.php');

if(isset($_FILES['uploadedfile']['name'])){
    $uploaded = music_upload();
    if($uploaded) {
        echo json_encode(['uploaded' => 'true', 'fileUploaded' => $_FILES['uploadedfile']['name']]);

    }
    else {
        echo json_encode(['uploaded' => 'false', 'fileToUploaded' => $_FILES['uploadedfile']['name']]);
    }

}else{
    echo json_encode(['validate' => 'false']);
}