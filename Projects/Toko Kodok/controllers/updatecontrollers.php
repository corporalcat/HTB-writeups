<?php
require "./../db/db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['productname']) && isset($_POST['productprice']) && isset($_POST['producttype']) && isset($_POST['password']) && isset($_POST['token'])) 
{
    session_start();
    if(preg_match('/^[a-zA-Z0-9]{64}/',$_POST['token']) == true && $_SESSION['token'] === $_POST['token'])
    {
        $save_directory = "assets/images";
        $image_name = $_FILES['productImage']['name'];
        $save_path_db = "$save_directory/$image_name";
    
        $root_directory = $_SERVER['DOCUMENT_ROOT'];
        $project_directory = "$root_directory"."LatihanPHP22";
        $target_path_upload = "$project_directory/$save_path_db";
    
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $allowed_extensions = ["jpg", "png", "jpeg"];

        if(in_array($image_extension, $allowed_extensions) == false) 
        {
            $_SESSION['error'] = "file must be jpg, png, or jpeg";
        }
        else if($_FILES['productImage']['size'] > 500000) 
        {
            $_SESSION['error'] = "file size cannot exceed 5000kb";
        } 
        else 
        {
            $productname = $_POST['productname'];
            $productprice = $_POST['productprice'];
            $producttype = $_POST['producttype'];
            $productid = $_GET['id'];
            $password = $_POST['password'];
    
            if(preg_match('/[a-zA-Z_ ]*/', $productname)==true && preg_match('/^[0-9]*/', $productprice)==true && preg_match('/^[a-zA-Z_ ]*/', $producttype)==true && preg_match('/^[a-zA-Z0-9_ ]*/', $password))
            {
                $username = "kodok";
                $stmt = $connection->prepare("SELECT * FROM users where username=?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt = $stmt->get_result();
    
                if ( $stmt->num_rows > 0)
                {
                    $row = $stmt->fetch_assoc();
                    if (password_verify($password, $row['password']))
                    {
                        $stmt = $connection->prepare("UPDATE product SET productname=?, producttype=?, productprice=?, productimage=? WHERE id=?");
                        $stmt->bind_param("ssssi", $productname, $producttype, $productprice, $save_path_db, $productid);
                        $stmt->execute();
                        $stmt->close();
                        move_uploaded_file($_FILES['productImage']['tmp_name'], $target_path_upload);   
    
                        $stmt->close();
                    }
                    else
                    {
                        $stmt->close();
                        $_SESSION['error'] = "Tidak semudah itu ferguso";
                        header('location: ./../index.php');
                    }
                }
                else
                {
                    $stmt->close();
                    $_SESSION['error'] = "Tidak semudah itu ferguso";
                    header('location: ./../index.php');
                }
            }
            else
            {
                header("location: ./../index.php");
            }
            header("location: ./../index.php");
        }
    }
    else
    {
        header("location: ./../index.php");
    }
}
else
{
    header("location:/../../index.php");
}
?>