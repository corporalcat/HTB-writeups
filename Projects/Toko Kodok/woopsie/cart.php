<!DOCTYPE html>
<html>
<head>
	<title>Cart Page</title>
</head>
<body>
	<h2 class="lead">Rincian pembelian</h2>
	<?php
	require 'db/db.php';
	session_start();
	if(!isset($_SESSION['cart'])){
		header('location:index.php');
	}
	$total = 0;
	foreach($_SESSION['cart'] as $id){
		$query="SELECT * from product where id = '$id'";
		$result = $connection->query($query);
		$row = $result->fetch_assoc();
		?>
		<a href="./controllers/cancelcontrollers.php?id=<?php echo $row['id'];?>">Remove <?php echo $row['productname'] ?></a>
		<br>
		<img src="<?php echo $row['productimage']; ?>"><br>
		<?php
		echo "Nama Produk : ".$row['productname']."<br>";
		echo "Harga : ".$row['productprice']."<br>";
		echo "Tipe : ".$row['producttype']."<br>";
		echo "Nomor id produk : ".$row['id']."<br><br><br>";
		$total = $total + $row['productprice'];
	}
	if($total>0){
	?>
	<b>Total Tagihan : Rp <?php echo $total ?>,00</b><br>
	<a href="payment.php">Check out</a><br>
	<?php }
	else{
		?>
		<b>Your cart is empty! Click the button below to look at more frogs to buy!</b><br>
		<?php
	}
	?>
	<a href="index.php">Home</a>
</body>
</html>