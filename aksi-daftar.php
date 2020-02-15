<?php 	
include 'koneksi.php';

function buat_kode()
{
	$code_feed = "ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789";
$code_length = 5;  // Set this to be your desired code length
$final_code = "";
$feed_length = strlen($code_feed);

for($i = 0; $i < $code_length; $i ++) {
	$feed_selector = rand(0,$feed_length-1);
	$final_code .= substr($code_feed,$feed_selector,1);
}
return $final_code;
}


function cek($koneksi)
{		
		$kode=buat_kode();
		$cek = mysqli_query($koneksi,"SELECT * FROM tb_pendaftar where kode_daftar = '$kode' ");
		if(mysqli_num_rows($cek)>0)
		{
			cek($koneksi);
		}else{
			
			return $kode;
			
		}
}
$kode = cek($koneksi);
date_default_timezone_set("Asia/Bangkok");
$date = date('Y-m-d H:i:s');
$tanggal = '"'.$date.'"';
$nama=mysqli_real_escape_string($koneksi,$_POST['nama']);
$email=mysqli_real_escape_string($koneksi,$_POST['email']);
$gambar=$_POST['image'];
$insert=mysqli_query($koneksi,"INSERT INTO 
	tb_pendaftar (id_pendaftar,kode_daftar,nama,no_telp,email,tanggal_daftar,status,bukti_bayar) VALUES 
				 (NULL,'$kode','$nama','','$email','$date','1','$gambar')");
if($insert)
{
	
	$return_arr = array("status" => 'ok',
                    "kode" => $kode);
	
}else{
	$return_arr = array("status" => 'gagal',
                    "kode" => $kode);
}
echo json_encode($return_arr);

 ?>