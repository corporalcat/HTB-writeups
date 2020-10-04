<!DOCTYPE html>
<html>
<head>
	<title>Upload Payment</title>
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
	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SESSION['username']) && isset($_POST['token']) && isset($_POST['submit']))
	{
		if(preg_match('/^[a-zA-Z0-9]{64}/',$_POST['token']) == true && $_POST['token'] == $_SESSION['token3'])
		{
			if (isset($_SESSION['admin'])) 
			{ 
				require_once './db/db.php';
				require_once './assets/generateToken.php';

				$sql = "SELECT * FROM payment2";
				$result = $connection->query($sql);
				if ($result->num_rows > 0)
				{
					while($row = $result->fetch_assoc())
					{
						getToken2($row['id']);
						getToken2($row['id'].$row['id']);
?>
						<tr>
							<td><img src="<?php echo $row['payment'];?>" width="300px" height="200px"></td>
							<td>User: <?php echo $row['user'];?></td>
							<td>
								<form action="./controllers/approvecontrollers.php?id=<?php echo $row['id'];?>" method="POST">
									<input type="hidden" name="token" value="<?php echo $_SESSION['token_'.$row['id']];?>">
									<input type="hidden" name="type" value="<?php echo $row['id'];?>">
									<button type="submit" name="submit" value="Submit">Approve</button>
								</form>
							</td>
							<td>
								<form action="./controllers/declinecontrollers.php?id=<?php echo $row['id'];?>" method="POST">
									<input type="hidden" name="token" value="<?php echo $_SESSION['token_'.$row['id'].$row['id']];?>">
									<input type="hidden" name="type" value="<?php echo $row['id'].$row['id'];?>">
									<button type="submit" name="submit" value="Submit">Decline</button>
								</form>
							</td>
						</tr>
						<br>	
					 
<?php 			}	}  else { ?>
					<p>Tidak ada Struk pembelajaan</p>
					<a href="./index.php">Home</a>
<?php 		}  ?>
<?php		} else { 
				require_once "./assets/generateToken.php";
				getToken();
?>
				<p> Silahkan upload bukti pembayaran </p>
				<form action="./controllers/paymentcontrollers.php" method="POST" enctype="multipart/form-data">
					<div>
					<input type="file" name="payment" id="inputFile" required="">
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit" name="upload">Upload</button>
					<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>">
				</form>
<?php 
			}  
		}
		else
		{
			header('location: ./index.php');
		}
	}
	else
	{
			header('location: ./index.php');
	}
?>
	 <?php include "footer.php";?>
</body>
</html>