<?php
require "./../db/db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload'])) {
 
 	// print_r($_FILES['payment']);
    $save_directory = "assets/payment";
    $image_name = $_FILES['payment']['name'];
    $save_path_db = "$save_directory/$image_name";

    $root_directory = $_SERVER['DOCUMENT_ROOT'];
    $project_directory = "$root_directory/Latihan PHP";
    $target_path_upload = "$project_directory/$save_path_db";

    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
    $allowed_extensions = ["jpg", "png"];

    session_start();
    if(in_array($image_extension, $allowed_extensions) == false) {
        $_SESSION['error'] = "file must be jpg or png";
    } else if($_FILES['payment']['size'] > 2000*1000) {
        $_SESSION['error'] = "file size cannot exceed 2MB";
    } else {
        
        $sql = "INSERT INTO payment VALUES(null,'$save_path_db')";

        $connection->query($sql);

        move_uploaded_file($_FILES['payment']['tmp_name'], $target_path_upload);   
    }
    header("location: ./../index.php");
}