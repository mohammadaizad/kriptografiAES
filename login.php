<?php
	session_start();
	$error='';
	if (isset($_POST['submit'])) {
		if (empty($_POST['nip']) || empty($_POST['password'])) {
			$error = "NIP or Password is invalid";
		}
		else{
			$nip=$_POST['nip'];
			$password=$_POST['password'];
		
			include 'koneksi.php';
			$query = mysqli_query($konek, "SELECT * FROM user WHERE password='$password' AND nip='$nip'");
			$rows = mysqli_num_rows($query);
			if ($rows == 1) {
				$_SESSION['login_user']=$nip; // Membuat Sesi/session
				header("location: user/index.php"); // Mengarahkan ke halaman profil
			}
			else {
				$error = "NIP atau Password belum terdaftar";
			}
		}
	}
?>