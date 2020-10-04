<?php
	require_once"./assets/checkStr.php";
	session_start();
	if (isset($_SESSION['username']))
	{ ?>
		<h2 class="lead">Welcome, <?php echo checkStr($_SESSION['username']);?>!</h2>

		<form action="./controllers/logoutcontrollers.php" method="POST">
			<input type="submit" value="Logout">
		</form>
	<?php } 
	else
		{ ?>
		<p class="lead">Please Login or Register to see our product</p>
		<a href="./login.php">Login</a>
    	<a href="./register.php">Register</a>
	<?php } ?>