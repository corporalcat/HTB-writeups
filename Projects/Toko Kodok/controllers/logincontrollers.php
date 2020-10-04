<?php 
	if ($_SERVER['REQUEST_METHOD'] === "POST")
	{
		require_once './../db/db.php';

		session_start();

		$username = $_POST['username'];
		$password = $_POST['password'];
		$captcha = trim($_POST['captcha']);
		$token = $_POST['token'];

		$login_limit = 4;
		$lockout_time = 300;

		$stmt = $connection->prepare("SELECT time,count FROM limiter WHERE username=?");
		$stmt->bind_param("s", $username);
		$stmt->execute();

		$res = $stmt->get_result()->fetch_assoc();

		$time_failed = $res['time'];
		$login_count = $res['count'];

		$stmt->close();

		function validateLogin($lockout_time, $time_failed, $login_count)
		{
			require "./../db/db.php";

			global $username;
			$time = time();

			$stmt = $connection->prepare("UPDATE limiter SET time=?, count=?  WHERE username=?");
			$stmt->bind_param("iis", $time, $login_count, $username);
			echo $time-$time_failed." | ".$lockout_time;
			if($time-$time_failed > $lockout_time)
			{
				$_SESSION['error']="set to 1 | ".$time-$time_failed." | ".$lockout_time;
				$login_count = 1;
				$stmt->execute();
				$stmt->close();
			}
			else
			{
				$_SESSION['error']="+1 | ".$time-$time_failed." | ".$lockout_time;
				$login_count+=1;
				$stmt->execute();
				$stmt->close();
			}
		}

		if(($login_count > $login_limit) && (time()-$time_failed < $lockout_time))
		{
			$timewait = time()-$time_failed;
			$_SESSION['error'] = "You are currently locked out for ".$lockout_time."s (".$timewait.")";
			$_SESSION['error2'] = "JANGAN HACK KAMI, KAMI HANYAK PETERNAK KODOK :)";
			header('location:./../login.php');
		}
		if (empty($username) || empty($password) || empty($captcha))
		{	
			validateLogin($lockout_time, $time_failed, $login_count);
			$_SESSION['error'] = 'Please fill all form';
			header('location: ./../login.php');
		}
		else if (preg_match('/^[a-zA-Z0-9_ ]*/', $username) == false || preg_match('/^[a-zA-Z0-9_ ]*/', $password) == false || preg_match('/^[a-zA-Z0-9 ]*/', $captcha) == false)
		{
			validateLogin($lockout_time, $time_failed, $login_count);
			$_SESSION['error'] = "Please fill the form correctly";
			header('location: ./../login.php');	
		}
		else
		{
			if ($_POST['captcha'] === $_SESSION['code'] && $_SESSION['token'] === $token)
			{
				setcookie("Coba-coba", 0, time()+(86400*30),"/");

				$stmt = $connection->prepare("SELECT * FROM users WHERE username=?");
				$stmt->bind_param("s",$username);
				$stmt->execute();
				$stmt = $stmt->get_result();

				if ( $stmt->num_rows > 0)
				{
					$row = $stmt->fetch_assoc();
					if (password_verify($password, $row['password']))
					{
						session_regenerate_id();
						$_SESSION['username'] = $username;
						if ($username == "kodok")
						{
							$_SESSION['admin'] = $username;
						}
						$stmt->close();
						header('location:./../index.php');
					}
					else
					{
						validateLogin($lockout_time, $time_failed, $login_count);
						$stmt->close();
						$_SESSION['error'] = 'invalid password or username';
						header('location: ./../login.php');		
					}
				}
				else
				{
					validateLogin($lockout_time, $time_failed, $login_count);
					$stmt->close();
					$_SESSION['error'] = 'no data available';
					header('location: ./../login.php');
				}
			}
			else
			{
				validateLogin($lockout_time, $time_failed, $login_count);
				$_SESSION['error'] = "Wrong Captcha";
				header('location:./../login.php');
			}
		}
	}
?>