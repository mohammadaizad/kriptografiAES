<?php
  	include '../koneksi.php';
  	include '../session.php';
  	include 'header.php';
?>

	<!-- /. NAV SIDE  -->
	<div id="page-wrapper" >
		<div id="page-inner">
			<div class="row">
				<div class="col-lg-12">
					<h2><i class="fa fa-edit"></i> Encrypt</h2>
				</div>
			</div>

			<!-- /. ROW  -->
			<hr />
			<div class="row">
				<div class="col-lg-12 ">
					<div class="alert alert-info">
						<form action="proses_enkrip.php" method="POST" enctype="multipart/form-data">
							<table style="width: 450px">
								<tr>
									<td width="250px"><font color="Red">Masukkan File</td>
									<td width="100px"></td>
									<td width="100px"><input type='file' name='file' /></td>
								</tr>
								<tr>
									<td width="250px"><font color="Red">Masukkan Kunci</td>
									<td width="100px"></td>
									<td width="100px"><input name="kunci" style="width:200px" type="password" class="form-control" placeholder="Kunci" maxlength="20"></td>
								</tr>
							</table>
							<br />

							<table style="width: 100px">
								<tr>
									<td><input type="submit" class="btn btn-primary" value="SUBMIT"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
            </div>
		</div>
    </div>
</div>

<?php
	include 'footer.php';
?>
