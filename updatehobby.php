<?php
header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';

$upload_path = 'uploads/';
$server_ip = gethostbyname(gethostname());
$upload_url = 'http://'. $server_ip . '/hobby/' . $upload_path;

$response = array();

if ($_SERVER['REQUEST_METHOD'] = 'POST') {
	if (isset($_POST["idhobby"]) &&
	isset($_POST["idkategori"]) && 
	isset($_POST["namahobby"]) && 
	isset($_POST["deschobby"]) &&
	isset($_POST["fotohobby"]) && 
	isset($_POST["inserttime"])) {
		
		$idhobby = $_POST["idhobby"];
		$idkategori = $_POST["idkategori"];
		$namahobby = $_POST["namahobby"];
		$deschobby = $_POST["deschobby"];
		$inserttime = $_POST["inserttime"];
		$fotohobby = $_POST["fotohobby"];
		$image = $_FILES["image"]['tmp_name'];

		if (isset($image)) {
			unlink("./uploads/" . $fotohobby);

			$temp = explode(".", $_FILES["image"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			move_uploaded_file($image, $upload_path . $newfilename);

			$sql = "UPDATE tb_hobby SET id_kategori = '$idkategori', nama_hobby = '$namahobby', desc_hobby = '$deschobby', insert_time = '$inserttime', foto_hobby = '$newfilename' WHERE id_hobby = '$idhobby'";
		}else {
			$newfilename = $fotohobby;

			$sql = "UPDATE tb_hobby SET id_kategori = '$idkategori', nama_hobby = '$namahobby', desc_hobby = '$deschobby', insert_time = '$inserttime' WHERE id_hobby = '$idhobby'";
		}

		if (mysqli_query($connection, $sql)) {
			$response["result"] = 1;
			$response["message"] = "Update Berhasil";
			$response['url'] = $upload_url . $newfilename;
			$response['mame'] = $namahobby;
		}else {
			$response["result"] = 0;
			$response["message"] = "Update Gagal";
		}
	}else {
		$response["result"] = 0;
		$response["message"] = "Update gagal, data kurang";
	}

	echo json_encode($response);
}
?>