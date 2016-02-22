<?php




//header('Content-Type: text/plain; charset=utf-8');


function music_upload(){
    $music_ext = array('mp3' => 'audio/mp3');
    upload_file(30000, $music_ext);//30mb
}

function image_upload(){
    $image_ext = array(
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'bmp' => 'image/bmp',
    );

    $uploaded = upload_file(8000, $image_ext);//7mb
    if($uploaded) return TRUE;
    else return FALSE;
}

/**
 * This function uploads any kind of file comming from the client
 * @param  int $size             [description]
 * @param  array $allowed_ext_type [description]
 * @return boolean                   [description]
 */
function upload_file($size, $allowed_ext_type = []){


    try {

        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.

        if ( !isset($_FILES['uploadedfile']['error']) || is_array($_FILES['uploadedfile']['error'])) {
            throw new RuntimeException('Invalid parameters.');
        }

        $file_path = "uploads/";
        //$file_path = $file_path . basename( $_FILES['uploadedfile']['name']);

        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['uploadedfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        // You should also check filesize here.
        if ($_FILES['uploadedfile']['size'] > $size) {
            throw new RuntimeException('Exceeded filesize limit.');
        }

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search($finfo->file($_FILES['uploadedfile']['tmp_name']),$allowed_ext_type ,
                true
            )) {
            throw new RuntimeException('Invalid file format.');
        }

        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        if (!move_uploaded_file(
            $_FILES['uploadedfile']['tmp_name'],
            sprintf('./uploads/%s.%s', sha1_file($_FILES['uploadedfile']['tmp_name']), $ext)
        )) {
            throw new RuntimeException('Failed to move uploaded file.');
        }

        return TRUE;

    } catch (RuntimeException $e) {

        return FALSE;

    }

}

