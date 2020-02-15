<?php 
include '../koneksi.php';

		$username =mysqli_real_escape_string($koneksi,$_POST['username']);
		$password =mysqli_real_escape_string($koneksi,$_POST['password']);
		$cek = mysqli_query($koneksi,"SELECT * FROM admin where username = '$username' AND password = '$password' ");
		if(mysqli_num_rows($cek)>0)
		{
			session_start();
			$_SESSION["username"]=$username;
			$return_arr = array("status" => 'ok');
		}else{
			$return_arr = array("status" => 'gagal');
			
		}
		
		echo json_encode($return_arr);

 ?>