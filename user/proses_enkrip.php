<?php
  	include '../koneksi.php';
  	include '../session.php';
  	include 'header.php';

  	//Memanggil class aes
	include 'class/aes.class.php';
	include 'class/aesctr.class.php';

	//Memanggil class huffman
	include 'class/huffmancoding.php';

	ini_set('memory_limit', '-1');
	ini_set('max_execution_time', '-1');

	$timer = microtime(true);

	$pw = $_POST['kunci'];
	$pt = $_FILES['file']['name'];
  	$uploaded_ext = substr($pt, strrpos($pt, '.') + 1);
	$cipher = empty($_POST['cipher']) ? '' : $_POST['cipher'];

	$encr = empty($_POST['encr']) ? $cipher : AesCtr::encrypt($pt, $pw, 256);

	function microtime_float(){
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}

	$time_start = microtime_float();

	if ($_FILES['file']['error'] == UPLOAD_ERR_OK
		&& is_uploaded_file($_FILES['file']['tmp_name'])){
			$pt = file_get_contents($_FILES['file']['tmp_name']);
			$cipher = AesCtr::encrypt($pt, $pw, 256);

			//Memulai proses kompresi
			$komp = $cipher;

			$encoding = HuffmanCoding::createCodeTree($komp);
			$encoded = HuffmanCoding::encode ($komp, $encoding);

			if(strlen($pw)<8){
				echo "<script>alert('Password Kurang dari 8 Karakter');window.location='enkrip.php';</script>";
       			return;
			}

     		if($uploaded_ext != "txt" && $uploaded_ext != "xls" && $uploaded_ext != "xlsx" && $uploaded_ext != "pdf" && $uploaded_ext != "docx" && $uploaded_ext != "doc"){
    				echo "<script>alert('File Harus .doc, .docx, .xls, .xlsx, .pdf, atau .txt');window.location='enkrip.php';</script>";
    				return;
    		}

    	//Menyimpan File Hasil
      	move_uploaded_file($_FILES["file"]["tmp_name"],$_FILES["file"]["name"]);
		$namafile = $_FILES['file']['name'];
      	$nm_file= str_replace(" ","_", $namafile);

		$fp = fopen("../hasil/Enkrip_".$namafile,"w");
		fwrite($fp, $encoded);
		fclose($fp);
		$time_end = microtime_float();
		$time = $time_end - $time_start;
      	$nama_file = "Enkrip_".$nm_file;
?>

	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		<div id="page-inner">
			<div class="row">
				<div class="col-lg-12">
					<h2><i class="fa fa-edit"></i> Hasil Encrypt</h2>
				</div>
			</div>

			<!-- /. ROW  -->
			<hr />
			<div class="row">
				<div class="col-lg-12 ">
					<div class="alert alert-info">
						<table border="0" width="600px">
							<tr>
								<td width="150"><font color="black"><b>Nama File</b></font></td>
								<td width="30"><font color="black">:</font></td>
								<td width="300"><font color="black"><?php echo $_FILES["file"]["name"];?></font></td>
							</tr>
							<tr>
								<td><font color="black"><b>Type File</font></b></td>
								<td><font color="black">:</font></td>
								<td><font color="black"><?php echo $_FILES["file"]["type"];?></font></td>
							</tr>
							<tr>
								<td><font color="black"><b>Ukuran File</b></font></td>
								<td><font color="black">:</font></td>
								<td><font color="black"><?php echo ($_FILES["file"]["size"] / 1024);?> Kb</font></td>
                				<td><?php echo "<a href= download.php?download_file=".$nama_file."><button name ='Download' class='btn btn-success'>DOWNLOAD</button></a>";?></td>
							</tr>
             				<tr>
								<td><font color="black"><b>File Hasil</b></font></td>
								<td><font color="black">:</font></td>
								<td><font color="black"><?php echo $nama_file;?></font></td>
							</tr>
							<tr>
								<td><font color="black"><b>Waktu Proses</b></font></td>
								<td><font color="black">:</font></td>
								<td><font color="black"><?php echo "$time seconds\n";?></font></td>
							</tr>
						</table>
						<br />

						<?php
							mysqli_query($konek, "INSERT INTO FILE (nama_file,kunci,nip) values('$nama_file','$pw','$nip')");
						?>

						<table style="width: 100px">
							<tr>
								<td><a href="enkrip.php"><button name ='Kembali' class="btn btn-primary">KEMBALI</button></a></td>
							</tr>
						</table>

						<?php
							}else{
								echo "<script>alert('File Gagal di Enkrip');window.location = 'enkrip.php';</script>";
							}
						?>
					</div>
				</div>
            </div>
		</div>
    </div>
</div>

<?php
	include 'footer.php';
?>
