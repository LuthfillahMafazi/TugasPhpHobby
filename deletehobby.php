<?php  
header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['idhobby']) &&
	isset($_POST['fotohobby'])) {
		$idhobby = $_POST["idhobby"];
		$fotohobby = $_POST["fotohobby"];

		$query = "DELETE FROM tb_hobby WHERE id_hobby = '$idhobby'";

		if (mysqli_query($connection, $query)) {
			unlink("./uploads/" . $fotohobby);

			$response['result'] = 1;
			$response['message'] = "Data hobby berhasil di hapus";
		}else {
			$response['result'] = 0;
			$response['message'] = "Maaf! menghapus data gagal";
		}
	}else {
		$response['result'] = 0;
		$response['message'] = "Data kurang";

	}
	json_encode($response);
	mysqli_close($connection);
	
}
?>