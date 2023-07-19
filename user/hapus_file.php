<?php
	include '../koneksi.php';

	$cek = mysqli_query($konek, "SELECT * FROM file WHERE kd_file=" . $_GET['id']);
	$row = mysqli_fetch_array($cek);
	mysqli_query($konek, "DELETE FROM file WHERE kd_file=" . $_GET['id']);
	unlink("hasil/" . $row['nama_file']);

	echo "<script type='text/javascript'>alert('File Berhasil di Hapus!');</script>";
	echo "<meta http-equiv='refresh' content='0; url=list.php'>";
?>