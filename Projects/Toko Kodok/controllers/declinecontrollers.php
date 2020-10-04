<?php
require_once'./../db/db.php';

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['token']) && isset($_POST['submit']) && isset($_GET['id']) && $_POST['type'])
{
    if(preg_match('/^[0-9_]*/',$_POST['type']) && filter_var($_GET['id'], FILTER_VALIDATE_INT))
    {
        session_start();

        $type = $_POST['type'];
        if(preg_match('/^[a-zA-Z0-9]{64}/', $_POST['token'])==true && $_POST['token'] === $_SESSION['token_'.$type])
        {
            $stmt = $connection->prepare("DELETE FROM payment2 WHERE id=?");
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();
            $stmt->close();
        }
    }
}
header('location:./../index.php');
?>