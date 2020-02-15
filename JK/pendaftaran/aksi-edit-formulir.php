<?php 
		include 'koneksi.php';

		$kode=mysqli_real_escape_string($koneksi,$_POST['kode-pendaftaran']);
		$nama=mysqli_real_escape_string($koneksi,$_POST['nama']);
		$jenis_kelamin=mysqli_real_escape_string($koneksi,$_POST['jenis_kelamin']);
		$alamat=mysqli_real_escape_string($koneksi,$_POST['alamat']);
		$asal_sekolah=mysqli_real_escape_string($koneksi,$_POST['asal_sekolah']);
		$unit_dituju=mysqli_real_escape_string($koneksi,$_POST['unit_dituju']);
		$no_telp=mysqli_real_escape_string($koneksi,$_POST['no_telp']);

		$cek = mysqli_query($koneksi,"SELECT * FROM tb_formulir where kode_daftar = '$kode' ");
		if(mysqli_num_rows($cek)>0)
		{
			//tidak bisa insert karena sudah ada
			$insert = mysqli_query($koneksi,"UPDATE tb_formulir SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', asal_sekolah = '$asal_sekolah', tujuan_sekolah = '$unit_dituju' , no_telp = '$no_telp' WHERE kode_daftar = '$kode' ");
			if($insert)
			{
				//sukses insert
				$return_arr = array("status" => 'sukses edit',
		                    "kode" => $kode);
			}else{
				//gagal insert
				$return_arr = array("status" => 'gagal',
		                    "kode" => $kode);
			}	
			
		}else{
			$return_arr = array("status" => 'tidak',
		                    "kode" => $kode);
			
		}
		echo json_encode($return_arr);
 ?>