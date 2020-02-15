<?php 
		include '../koneksi.php';

		$kode = mysqli_real_escape_string($koneksi,$_POST['kode']);
		$cek = mysqli_query($koneksi,"DELETE FROM tb_pendaftar where kode_daftar = '$kode' ");
		if($cek)
		{
			
			$return_arr = array("status" => 'ok',
		                    "kode" => $kode);
		}else{
			$return_arr = array("status" => 'gagal',
		                    "kode" => $kode);
		}
		echo json_encode($return_arr);

 ?>