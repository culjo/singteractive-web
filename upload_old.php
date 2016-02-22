<?php
$file_path = "uploads/";
$file_path = $file_path . basename( $_FILES['uploadedfile']['name']);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $file_path)) {
echo "success";//Mess with the post data sent too
} else{
echo "fail";
}
?>