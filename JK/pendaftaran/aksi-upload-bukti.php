<?php 
include 'koneksi.php';

$kode=mysqli_real_escape_string($koneksi,$_POST['kode']);
$gambar=$_POST['image'];

$cek= mysqli_query($koneksi,"SELECT * FROM tb_pendaftar where kode_daftar = '$kode' ");

if(mysqli_num_rows($cek)>0)
{
	$update= mysqli_query($koneksi,"UPDATE tb_pendaftar SET status='1', bukti_bayar = '$gambar' WHERE kode_daftar = '$kode' ");
	if($update)
	{
		//kode belum terdaftar
		$return_arr = array("status" => 'sukses',
                "kode" => $kode);
	}else{
		//kode belum terdaftar
		$return_arr = array("status" => 'gagal',
                "kode" => $kode);
	}
}else{
	//kode belum terdaftar
	$return_arr = array("status" => 'belum',
                "kode" => $kode);
}	
			
echo json_encode($return_arr);


 ?>