<!DOCTYPE html>
<html>
<head>
	<title>Cart Page</title>
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
	<h2 class="lead">Rincian pembelian</h2>
	<?php
		require_once './db/db.php';
		require_once './assets/generateToken.php';

		session_start();

		function removeItem($id)
		{
			// echo "HAI";
            $key = array_search($id,$_SESSION['cart']);
            unset($_SESSION['cart'][$key]);
		}

		$token = $_POST['token'];
		if(!isset($_SESSION['cart']) && !isset($_SESSION['username']) && !isset($_POST['submit']))
		{
			header('location:index.php');
		}
		else if(preg_match('/^[a-zA-Z0-9]{64}/', $token) == false)
		{
			header('location:index.php');
		}

		if($_SESSION['token'] === $token && isset($_SESSION['cart']))
		{
			$total = 0;
			$stmt = $connection->prepare("SELECT * FROM product WHERE id=?");
	?>
				<?php
			foreach($_SESSION['cart'] as $id)
			{
				?>
			<table class="table table-striped mt-5" border="1px">
				<thead>
					<tr>
						<th scope="col">Product Image</th>
						<th scope="col">Product Name</th>
						<th scope="col">Product Type</th>
						<th scope="col">Product Price</th>
						<th scope="col"></th>
					</tr>
				</thead> 
	<?php
				$stmt->bind_param("i", $id);
				$stmt->execute();
				$row = $stmt->get_result()->fetch_assoc();

				// $query="SELECT * from product where id = '$id'";
				// $result = $connection->query($query);
				// $row = $result->fetch_assoc();
	?>
				<tr align="center">
					<td><img src="<?php echo $row['productimage'];?>" width="300" height="200"></td>
					<td><?php echo $row['productname'];?></td>
					<td><?php echo $row['producttype'];?></td>
					<td><?php echo $row['productprice'];?></td>
					<td><a href="./controllers/cancelcontrollers.php?id=<?php echo $row['id'];?>">Remove</a></td>
				</tr>
			</table>

	<?php
				// echo "Nama Produk : ".$row['productname']."<br>";
				// echo "Harga : ".$row['productprice']."<br>";
				// echo "Tipe : ".$row['producttype']."<br>";
				// echo "Nomor id produk : ".$row['id']."<br><br><br>";
				$total = $total + $row['productprice'];
			}
			if($total>0)
			{
	?>
			<b>Total Tagihan : Rp <?php echo $total ?>,00</b><br>
			<b>
				<form action="./payment.php" method="POST">
					<input type="hidden" name="token" value="<?php getToken3(); echo $_SESSION['token3'];?>">
					<button type="submit" name="submit" value="Submit">Check out</button>
				</form>
        	</b>
	<?php 
			}
			else
			{
	?>
				<b>Your cart is empty! Click the button below to look at more frogs to buy!</b><br>
				<a href="index.php">Home</a>
	<?php
			}
		}
		else
		{ ?>
			<b>Your cart is empty! Click the button below to look at more frogs to buy!</b><br>
				<a href="index.php">Home</a>	
		<?php } ?>
</body>
</html>