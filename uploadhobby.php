<?php
header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';

$upload_path = 'uploads/';
$server_ip = gethostbyname(gethostname());
$upload_url = 'http://' . $server_ip . '/hobby/' . $upload_path;

if (!is_dir($upload_url)) {
	mkdir("uploads", 0775, true);

}
$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$iduser = $_POST['iduser'];
	$idketogori = $_POST['idketogori'];
	$namahobby = $_POST['namahobby'];
	$deschobby = $_POST['deschobby'];
	$timeinsert = $_POST['timeinsert'];

	try {
		$temp = explode(".", $_FILES["image"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);

		move_uploaded_file($_FILES['image']['tmp_name'], $upload_path . $newfilename);

		$query = "INSERT INTO tb_hobby (id_user, id_kategori, nama_hobby, desc_hobby, foto_hobby, insert_time) VALUES ('$iduser','$idketogori','$namahobby', '$deschobby','$newfilename','$timeinsert')";

		if (mysqli_query($connection, $query)) {
			$response['result'] = 1;
			$response['message'] = "Upload berhasil";
			$response['url'] = $upload_url . $newfilename;
			$response['name'] = $namahobby;
		}else {
			$response['result'] = 0;
			$response['message'] = "Upload Gagal";
		}
	}catch (Exception $e){
		$response['result'] = 0;
		$response['message'] = $e->getMessage();
	}

	echo json_encode($response);
	mysqli_close($connection);

}
  ?>