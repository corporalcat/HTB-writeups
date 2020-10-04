<?php
require '../db/db.php';
session_start();
if(isset($_GET['id']) && isset($_SESSION['cart'])){
    $key = array_search($_GET['id'],$_SESSION['cart']);
    unset($_SESSION['cart'][$key]);
    $_SESSION['notif'] = "Your item choice has been removed from your cart";
    header('location:./../cart.php');
}
else{
    header('location:./../index.php');
}
?>