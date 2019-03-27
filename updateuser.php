<?php

include './config/koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	if (isset($_POST['iduser']) &&
		isset($_POST['namauser']) &&
		isset($_POST['alamat']) &&
		isset($_POST["jenkel"]) &&
		isset($_POST["notelp"])) {
		
		$iduser = $_POST["iduser"];
		$namauser = $_POST["namauser"];
		$alamat = $_POST["alamat"];
		$jenkel = $_POST["jenkel"];
		$notelp = $_POST["notelp"];

		$query = "UPDATE tb_user SET nama_user = '$namauser', alamat = '$alamat', jenkel = '$jenkel', no_telp = '$notelp' WHERE id_user = '$iduser'";

		if (mysqli_query($connection, $query)) {
			$response["result"] = 1;
			$response["message"] = "update berhasil";
		}else {
			$response["result"] = 0;
			$response["message"] = "update gagal";
		}
		echo json_encode($response);
	}
}

?>