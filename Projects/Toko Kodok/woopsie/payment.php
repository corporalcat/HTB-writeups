<!DOCTYPE html>
<html>
<head>
	<title>Upload Payment</title>
</head>
<body>
	<h1><center>TOKO KODOK</center></h1>
    <br>
    <?php 
    session_start();
    if (isset($_SESSION['admin'])) { ?>
    	<?php 
    	require_once'./db/db.php';

    	$sql = "SELECT * FROM payment";
    	$result = $connection->query($sql);
    	$sql1 = "SELECT * FROM product";
    	$result1 = $connection->query($sql1);

    	if ($result->num_rows > 0)
    	{
    		while($row = $result->fetch_assoc()){
    		$row1 = $result1->fetch_assoc(); 
    		 ?>
    		<tr>
    			<td><img src="<?php echo $row['payment'];?>"></td>
    			<td><a href="./controllers/approvecontrollers.php?id=<?php echo $row['id'];?>?id1=<?php echo $row1['id'];?>">Approve</a></td>
    			<td><a href="./controllers/declinecontrollers.php?id=<?php echo $row['id'];?>">Decline</a></td>
    		</tr>
    		<br>	
    	<?php } } ?> 
    	<?php } else { ?>
   		<p> Silahkan upload bukti pembayaran </p>
		<form action="./controllers/paymentcontrollers.php" method="POST"enctype="multipart/form-data">
			<div>
		 	<input type="file" name="payment" id="inputFile" required="">
        	</div>
        	<button class="btn btn-lg btn-primary btn-block" type="submit" name="upload">Upload</button>
		</form>
   	<?php }  ?>
	 <?php include "footer.php";?>
</body>
</html>