<!DOCTYPE html>
<html>
<head>
	<title>TOKO KODOK</title>
<style>
        marquee{
         font-size: 30px;
         font-weight: 800;
         color: #8ebf42;
         font-family: sans-serif;
        }
</style>
</head>
<style>
table, td, th {
  border: 1.5px solid black;
}

table {
  border-collapse: collapse;
  width: 46%;
}

td{
  height: 50px;
  vertical-align: middle;;
  }
</style>
<body>
    <marquee>
        <a href="./index.php"><h1><center>TERNAK KODOK INFINITE</center></h1></a>
    </marquee>
	<br>
	<?php
		require_once "./db/db.php";
		require_once "./header.php";
		require_once "./assets/generateToken.php";
	?>
	<div>		
		<?php 
		if (isset($_SESSION['username']))
		{ 
			$sql = "SELECT * FROM product";
			$result = $connection->query($sql);
			if ($result->num_rows > 0)
			{ ?>
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
                <?php while($row = $result->fetch_assoc()) { ?>
					<tr align="center">
						<td><img src="<?php echo $row['productimage'];?>" width="300" height="200"></td>
						<td><?php echo $row['productname'];?></td>
						<td><?php echo $row['producttype'];?></td>
						<td><?php echo $row['productprice'];?></td>
						<?php if ($_SESSION['username'] == "kodok" && isset($_SESSION['admin']))
						{ ?>
						<td>
							<form action="./update.php?id=<?php echo $row['id'];?>" method="POST">
								<button type="submit" name="submit" value="Submit">Update Product</button>
								<input type="hidden" name="token" value="<?php getToken2($row['producttype']); echo $_SESSION['token_'.$row['producttype']];?>"/>
								<input type="hidden" name="type" value="<?php echo $row['producttype'];?>">
							</form>
						</td>
						<td>
							<form action="./controllers/deletecontrollers.php?id=<?php echo $row['id'];?>" method="POST">
								<button type="submit" name="submit" value="Submit">Delete Product</button>
								<input type="hidden" name="token" value="<?php getToken2($row['producttype']."_"); echo $_SESSION['token_'.$row['producttype'].'_'];?>"/>
								<input type="hidden" name="type" value="<?php echo $row['producttype'].'_';?>">
							</form>
						</td> 
						<?php } else {?>
						<td>
							<form action="./controllers/buycontrollers.php?id=<?php echo $row['id']?>" method="POST">
								<button type="submit" name="submit" value="Submit">Buy</button>
								<input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>"/>
							</form>
						</td>
						<?php } ?>
					</tr>
					<?php } } else { ?> 
					<p class="lead">Kodok sudah habis terjual</p>
				<?php } ?>
					<?php if ($_SESSION['username'] === "kodok" && isset($_SESSION['admin'])){?>
						<form action="./payment.php" method="POST">
							<button type="submit" name="submit" value="Submit">Rincian Penjualan</button>
							<input type="hidden" name="token" value="<?php getToken3(); echo $_SESSION['token3'];?>"/>
						</form>
					<?php } else { ?>
						<form action="./cart.php" method="POST">
							<div class="container">
								<footer>
									<button type="submit" name="submit" value="Submit">Rincian Pembelian</button>
									<input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>"/>
								</footer>
							</div>
						</form>

						<form action="./history.php" method="POST">
							<div class="container">
								<footer>
									<button type="submit" name="submit" value="Submit">History</button>
								</footer>
							</div>
						</form>
					<?php }?>

		<?php 
		if (isset($_SESSION['admin']) && $_SESSION['username'] === "kodok") 
			{ ?>
				<form action="./insert.php" method="POST">
					<button type="submit" name="submit" value="Submit">Insert Product</button>
					<input type="hidden" name="token" value="<?php getToken(); echo $_SESSION['token'];?>"/>
				</form>
				<br>
		<?php } } ?>
	</div>
	<?php
		if(isset($_SESSION['notif']))
		{
			echo $_SESSION['notif'];
			unset($_SESSION['notif']);
		}
	?>
	<?php include"footer.php";?> 
	<a href="./aboutus.php">About Us</a>
</body>
</html>