<?php
	include 'koneksi.php';

	session_start();
	$user_check=$_SESSION['login_user'];
	$ses_sql=mysqli_query($konek, "SELECT * FROM user WHERE nip='$user_check'");
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session = $row['nama'];
	$nip = $row['nip'];
	$password = $row['password'];

	if(!isset($login_session)){
		header('Location: index.php');
	}
?>