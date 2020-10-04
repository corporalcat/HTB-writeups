<?php 
try {
	$connection = new mysqli('localhost', 'root', '', 'toko_kodok');
	$connection->set_charset("utf8mb4");
} catch (Exception $e) {
	echo 'Connection failed';
}
?>