<!DOCTYPE html>
<html>
<head>
    <title>Insert Page</title>
    <style>
            marquee{
            font-size: 30px;
            font-weight: 800;
            color: #8ebf42;
            font-family: sans-serif;
            }
    </style>
</head>
<body>
    <marquee>
        <a href="./index.php"><h1><center>TERNAK KODOK INFINITE</center></h1></a>
    </marquee>
    <br>
    <?php 
        session_start();
        if(isset($_SESSION['admin']) && isset($_POST['token']) && isset($_POST['submit']))
        {
            $token = $_POST['token'];
            if(preg_match('/^[a-zA-Z0-9]{64}/',$token) == true)
            {
                if($_SESSION['token'] === $token)
                {
                    require_once "./assets/generateToken.php";
                    getToken();
    ?>
                    <form action="./controllers/insertcontrollers.php" method="POST"  enctype="multipart/form-data">
                        <input type="text" id="" placeholder="Product Name" name="productname">
                        <input type="text" id="" placeholder="Product Type" name="producttype">
                        <input type="number" id="" placeholder="Product Price" name="productprice">
                        <div>
                        <input type="file" name="productImage" id="inputFile" required="">
                        </div>
                        <br>
                        <input type="password" name="password" placeholder="password"><br>
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="insert">Insert</button>
                    </form>
                    <?php 
                        if(isset($_SESSION['error']))
                        {
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                    ?>
    <?php
                }
                else
                {
                    header('location:./index.php');
                }
            }
            else
            {
                header('location:./index.php');
            }
        }
        else
        {
            header('location:./index.php');
        }
    ?>
    <?php include "footer.php";?>
</body>
</html>