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
			$return_arr = array("status" => 'sudah',
		                    "kode" => $kode);
		}else{
			$insert = mysqli_query($koneksi,"INSERT INTO tb_formulir 
				(id_formulir,kode_daftar,nama,jenis_kelamin, alamat,asal_sekolah,tujuan_sekolah,no_telp) 
				VALUES 
				(NULL, '$kode', '$nama', '$jenis_kelamin','$alamat', '$asal_sekolah', '$unit_dituju' ,'$no_telp')");
			if($insert)
			{
				//sukses insert
				$return_arr = array("status" => 'sukses',
		                    "kode" => $kode);
			}else{
				//gagal insert
				$return_arr = array("status" => 'gagal',
		                    "kode" => $kode);
			}	
			
		}
		echo json_encode($return_arr);


 ?>