<?php
	
	include './config/koneksi.php';
	$response = array();

	if (isset($_POST["username"]) && isset($_POST["password"])) {

		$username = $_POST["username"];
		$password = md5($_POST["password"]);

		$sql = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";

		$check = mysqli_query($connection, $sql);

		if (!$check) {
			echo "Tidak bisa jalankan query: " . myqli_error($connection);
			exit;
		}
		$row = mysqli_fetch_row($check);

		$result_data = array(
			'id_user' => $row[0],
			'nama_user' => $row[1],
			'alamat' => $row[2],
			'jenkel' => $row[3],
			'no_telp' => $row[4],
			'username' => $row[5],
			'password' => $row[6],
			'level' => $row[7]);

		if (mysqli_num_rows($check) > 0) {
			$response['result'] = 1;
			$response['message'] = "berhasil login!";
			$response['data'] = $result_data;
			# code...
		}else {
			$response['result'] = 0;
			$response['message'] = "Gagal login !";
		}
		echo json_encode($response);
	}

?>