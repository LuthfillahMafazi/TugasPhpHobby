<?php
	$server = "localhost";

	$username = "root";
	$password = "";
	$database = "hobby";

	$connection = mysqli_connect($server, $username, $password, $database) or die ("Koneksi Gagal");
?>