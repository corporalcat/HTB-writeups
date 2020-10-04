<?php
require_once'./../db/db.php';

$productid = $_GET['id'];
$sql = "DELETE FROM payment WHERE id = $productid";
$connection->query($sql);

header('location:./../index.php');
?>