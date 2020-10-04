<?php
require_once'./../db/db.php';

$productid = $_GET['id'];
$sql = "DELETE FROM payment WHERE id = $productid";
$connection->query($sql);

$productid1 = $_GET['id1'];
$sql1 = "DELETE FROM product WHERE id = $productid1";
$connection->query($sql1);

header('location:./../index.php');
?>