<!DOCTYPE html>
<html>
<head>
	<title>History Page</title>
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
    <h2 class="lead">History Transaction</h2>
    <?php 
    session_start();
    require_once"./db/db.php";
    $status = "Approve";
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM payment WHERE user = '$username'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0 )
    { 
    while($row = $result->fetch_assoc()){?>
    	<table class="table table-striped mt-5" border="1px">
				<thead>
					<tr>
						<th scope="col">Payment Image</th>
                        <th scope="col">Payment Status</th>
					</tr>
				</thead>

				<tr align="center">
					<td><img src="<?php echo $row['payment'];?>" width="300" height="200"></td>
                    <td><?php echo $row['status']?></td>
				</tr>
		</table>
		<?php } } else { ?>
			<b>You not have any history transaction</b><br>
			<a href="index.php">Home</a>
		<?php } ?>
</body>
</html>