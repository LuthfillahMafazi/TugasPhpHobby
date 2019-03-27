<?php
	include './config/koneksi.php';

	$response = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST["username"]) &&
			isset($_POST["password"]) &&
			isset($_POST["namauser"]) &&
			isset($_POST["alamat"]) &&
			isset($_POST["jenkel"]) &&
			isset($_POST["notelp"]) &&
			isset($_POST["level"])) {

		$username = $_POST["username"];
		$password = md5($_POST["password"]);
		$namauser = $_POST["namauser"];
		$alamat = $_POST["alamat"];
		$jenkel = $_POST["jenkel"];
		$notelp = $_POST["notelp"];
		$level = $_POST["level"];

		$sql = "SELECT * FROM tb_user WHERE username = '$username'";

		$check = mysqli_fetch_array(mysqli_query($connection, $sql));

		if (isset($check)) {
			$response["result"] = 0;
			$response["message"] = "Username sudah di pakai";
		}else {
			$sql = "INSERT INTO tb_user(nama_user, alamat, jenkel, no_telp, username, password, level) VALUES ('$namauser','$alamat','$jenkel','$notelp','$username','$password','$level') ";

			if (mysqli_query($connection, $sql)) {
				$response["result"] = 1;
				$response["message"] = "Register Berhasil";
			}else {
				$response["result"] = 0;
				$response["message"] = "Register Gagal";
			}
			
		}
		echo json_encode($response);
		}
	}
?>