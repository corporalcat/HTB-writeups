<?php 
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		require_once "./../db/db.php";
		require_once "./../assets/generateToken.php";
		session_start();
		$username = $_POST['username'];
		$pass = $_POST['password'];
		$email = $_POST['email'];
		$captcha = trim($_POST['captcha']);
		$token = $_POST['token'];

		if (empty($username) || empty($pass) || empty($email) || empty($captcha))
		{
			$_SESSION['error'] = 'Please fill all form';
			header('location:./../register.php');
		}
		else if (preg_match('/^[a-zA-Z0-9_\s]/', $username) == false || preg_match('/^[a-zA-Z0-9_\s]/', $pass) == false || preg_match('/^[a-zA-Z0-9\s]+/', $captcha) == false || !filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
		{
			$_SESSION['error'] = "Please fill the form correctly";
			header('location: ./../register.php');	
		}
		else
		{
			if(preg_match('/^[a-zA-Z0-9]{64}/', $token) == true)
			{
				// echo $_SESSION['token']."\n";
				// echo $token;
				if ($_POST['captcha'] == $_SESSION['code'] && $_SESSION['token'] == $token)
				{
					$hashpassword = password_hash($pass,PASSWORD_BCRYPT);
	
					$res = $connection->query("SELECT MAX(id) from users");
					$res = $res->fetch_assoc();
					$res = $res['MAX(id)'];
					
					if($res>30)
					{
						$_SESSION['error'] = "whoops, too many account";
						header('location:./../register.php');
					}

					//validasi biar username gk same
					$stmt = $connection->prepare("SELECT * FROM users WHERE username=?");
					$stmt->bind_param("s", $username);
					$stmt->execute();
					$stmt = $stmt->get_result();

					if($stmt->num_rows>0){
						$_SESSION['error'] = "Tak semudah itu Ferguso!!!";
						$stmt->close();
						header('location:./../register.php');
					}
					else
					{
						$stmt->close();
			
						$stmt = $connection->prepare("INSERT INTO users(username, password, email) VALUES(?, ?, ?)");
						$stmt->bind_param("sss", $username, $hashpassword, $email);
						$stmt->execute();
						$stmt->close();
		
						$stmt = $connection->prepare("INSERT INTO limiter(username) VALUES(?)");
						$stmt->bind_param("s", $username);
						$stmt->execute();
						$stmt->close();
		
						header('location: ./../login.php');
					}
				}
				else
				{
					$_SESSION['error'] = "Wrong Captcha";
					header('location:./../register.php');
				}
			}
			else
			{
				header('location:./../register.php');
			}
		}
	}
?>