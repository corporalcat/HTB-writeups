<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
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
	<?php
		session_start();
		if(isset($_SESSION['username'])) header('location:./index.php');
		require_once "./assets/capthca.php";
		require_once "./assets/generateToken.php";
	?>
	<form action="./controllers/registercontrollers.php" method="POST">
		<center>Sign up</center>
		<div>
			<label>Username</label>
			<br>
			<input type="text" name="username">
			<br>
			<label>E-mail</label>
			<br>
			<input type="text" name="email">
			<br>
			<label>Password</label>
			<br>
			<input type="password" name="password">
			<br>
			<br>
            <div> 
                <img src="captcha_image.png">
            </div><br>
			<label>Input capthca:</label>
			<input type="text" name="captcha">
			<input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>"/>
		</div>
		<button type="submit" name="signin">Sign up</button>
		<br>
	</form>	
	<?php 
		if (isset($_SESSION['error']))
		{
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
	?>
</body>
</html>