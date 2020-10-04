<?php
require "./../db/db.php";

session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload']) && isset($_POST['token'])) 
{
    if(preg_match('/^[a-zA-Z0-9]{64}/', $_POST['token']) == true && $_POST['token'] === $_SESSION['token'])
    {
        $save_directory = "assets/payment";
        $image_name = $_FILES['payment']['name'];
        $save_path_db = "$save_directory/$image_name";
    
        $root_directory = $_SERVER['DOCUMENT_ROOT'];
        $project_directory = "$root_directory/LatihanPHP22";
        $target_path_upload = "$project_directory/$save_path_db";
    
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions  = ["jpg", "png", "jpeg"];
        if(in_array($image_extension, $allowed_extensions) == false) 
        {
            $_SESSION['error'] = "file must be jpg, png, or jpeg";
            header('location:./../payment.php');
        }
        else if($_FILES['payment']['size'] > 500000) 
        {
            $_SESSION['error'] = "file size cannot exceed 5000kb";
            header('location:./../payment.php');
        } 
        else 
        {
            $status = "Not Approve";
            $stmt = $connection->prepare("INSERT INTO payment VALUES (null, ?, ?, ?)");
            $stmt->bind_param("sss", $save_path_db, $_SESSION['username'],$status);
            $stmt->execute();
            move_uploaded_file($_FILES['payment']['tmp_name'], $target_path_upload);
            $stmt->close();

            $stmt = $connection->prepare("INSERT INTO payment2 VALUES (null, ?, ?, ?)");
            $stmt->bind_param("sss", $save_path_db, $_SESSION['username'],$status);
            $stmt->execute();
            move_uploaded_file($_FILES['payment']['tmp_name'], $target_path_upload);
            $stmt->close();
           unset($_SESSION['cart']);
           // header("location: ./../index.php");
       }
       // header('location:./../payment.php');
    }
}