<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<style>
			marquee{
			font-size: 30px;
			font-weight: 800;
			color: #8ebf42;
			font-family: sans-serif;
			}
	</style>
</head>

<marquee>
    <a href="./index.php"><h1><center>TERNAK KODOK INFINITE</center></h1></a>
</marquee>

<?php
	session_start();
	if(isset($_SESSION['username']) && !empty($_SESSION['username'])) 
		header('location:./index.php');
	require_once "./assets/capthca.php";
	require_once "./assets/generateToken.php";
?>

<body class = "text-centre">
	<form class = "form-signin" action="./controllers/logincontrollers.php" method="POST">
		<center>SIGN IN</center>
		<div>
			<label>Username</label>
			<br>
			<input type="text" name="username">
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
			<br>
			<input type="text" name="captcha">
			<br>
			<input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>"/>
		</div>
		<button type="submit" name="signin">Sign in</button>
		<br>
		Don't have account?
		<a href="./register.php">Sign Up</a>
		<br>
		<?php 
		if (isset($_SESSION['error']))
		{
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
		if (isset($_SESSION['error2']))
		{
	?>
			<marquee behaviour="scroll">
			<h1>
	<?php
			echo $_SESSION['error2'];
	?>
			<h1>
			</marquee>
	<?php
			unset($_SESSION['error2']);
		}
	?>
	</form>
</body>
</html>