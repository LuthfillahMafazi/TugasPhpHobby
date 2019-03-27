<?php  
header("Content-Type: application/json; charset=UTF-8");
include './config/koneksi.php';

$upload_path = 'uploads/';
$server_ip = gethostbyname(gethostname());
$upload_url = 'http://'. $server_ip . '/hobby/' . $upload_path;

$query = "SELECT th.id_hobby, th.id_user, th.id_kategori, th.nama_hobby, th.desc_hobby, th.foto_hobby, th.insert_time, th.view, tu.nama_user, tk.nama_kategori FROM tb_user tu, tb_hobby th, tb_kategori tk WHERE tu.id_user = th.id_user && tk.id_kategori = th.id_kategori ORDER BY th.id_hobby DESC";

$result = mysqli_query($connection, $query) or die("Error in selection " . mysqli_error($connection));

$temparray = array();
$response = array();

$cek = mysqli_num_rows($result);

if ($cek > 0 ) {
	while ($row = mysqli_fetch_assoc($result)) {
		array_push($row['url_hobby'] = $upload_url . $row['foto_hobby']);
		$temparray[] = $row;

	}
	$response['result'] = 1;
	$response['message'] = "Data berhasil";
	$response['data'] = $temparray;
}else {
	$response['result'] = 0;
	$response['message'] = "Data kosong";
}
echo json_encode($response);
mysql_close($connection);
?>