<?php 
include 'koneksi.php';

		$kode = mysqli_real_escape_string($koneksi,$_POST['kode-pendaftaran']);
		$cek = mysqli_query($koneksi,"SELECT * FROM tb_pendaftar where kode_daftar = '$kode' ");
		if(mysqli_num_rows($cek)>0)
		{
			$cek = mysqli_query($koneksi,"SELECT * FROM tb_pendaftar where kode_daftar = '$kode' AND status='2' ");
			if(mysqli_num_rows($cek)>0)
			{
				$cek = mysqli_query($koneksi,"SELECT * FROM tb_formulir where kode_daftar = '$kode' ");
				if(mysqli_num_rows($cek)>0)
				{
					session_start();
					$_SESSION["kode"]=$kode;
					$return_arr = array("status" => 'sudah',
				                    "kode" => $kode);
				}else{
					session_start();
					$_SESSION["kode"]=$kode;
					$return_arr = array("status" => 'ok',
				                    "kode" => $kode);
				}
			}else{
				$return_arr = array("status" => 'belum',
			                    "kode" => $kode);
			}
		}else{
			$return_arr = array("status" => 'gagal',
		                    "kode" => $kode);
		}
		echo json_encode($return_arr);

 ?>