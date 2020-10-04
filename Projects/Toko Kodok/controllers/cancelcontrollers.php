<?php
    require_once '../db/db.php';
    require_once '../assets/checkStr.php';
	require_once '../assets/generateToken.php';

    session_start();
    if(isset($_GET['id']) && isset($_SESSION['cart']))
    {
        $token = $_POST['token'];
        $id = $_GET['id'];
        if(!filter_var($id, FILTER_VALIDATE_INT) === false)
        {
            $key = array_search($id,$_SESSION['cart']);
            unset($_SESSION['cart'][$key]);
            $_SESSION['notif'] = "Your item choice has been removed from your cart";

?>
            <!-- <form action="location:./../cart.php" method="POST">
                <input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>">
                <button type="submit" name="submit" value="Submit"></button>
            </form> -->
<?php
            header('location:./../cart.php');
        }
        header('location:./../index.php');
    }
    else
    {
        header('location:./../index.php');
    }
?>
