<?php
require '../db/db.php';
session_start();
if(isset($_GET['id']) && !isset($_SESSION['cart'])){
    $id = $_GET['id'];
    $_SESSION['cart'][] = $id;
    $_SESSION['notif'] = "Your item choice has been added to your cart";
    header('location:./../index.php');
}
else if(isset($_GET['id']) && isset($_SESSION['cart'])){
    array_push($_SESSION['cart'],$_GET['id']);
    $_SESSION['notif'] = "Your item choice has been added to your cart";
    header('location:./../index.php');
}
else{
    $_SESSION['notif'] = "Error on adding or removing your item from the cart!";
    header('location:./../index.php');
}
?>