<?php
    require '../db/db.php';
    require_once '../assets/checkStr.php';
    require_once '../assets/generateToken.php';

    $_SESSION['cart'] = array();
    session_start();
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_GET['id']))
    {
        if(preg_match('/^[0-9]*/',$_GET['id'])==true)
        {
            $id = checkStr($_GET['id']);
            if(!isset($_SESSION['cart']))
            {
                $_SESSION['cart'][] = $id;
                $_SESSION['notif'] = "Your item choice has been added to your cart";
                header('location:./../index.php');
            }
            else if(isset($_SESSION['cart']))
            {
                array_push($_SESSION['cart'],$id);
                print_r($_SESSION['cart']);
                $_SESSION['notif'] = "Your item choice has been added to your cart";
                header('location:./../index.php');
            }
            else
            {
                $_SESSION['notif'] = "Error on adding or removing your item from the cart!";
                header('location:./../index.php');
            }
        }        
    }
    else
    {
        header('location:./../index.php');
    }
?>