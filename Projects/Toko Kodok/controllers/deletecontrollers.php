<?php
require_once './../db/db.php';

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET['id']))
{
    if (preg_match('/^[0-9]/',$_GET['id']))
    {
        $id = $_GET['id'];

        $stmt = $connection->prepare("DELETE FROM product WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        header('location:./../index.php');
    }
    else
    {
        header('location:./../index.php');
    }
}
else
{
    header('location:./../index.php');
}
?>