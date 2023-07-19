<?php
	include '../koneksi.php';
	include '../session.php';
	include 'header.php';
?>

<!-- /. NAV SIDE  -->
<div id="page-wrapper">
	<div id="page-inner">
		<div class="row">
			<div class="col-lg-12">
				<h2><i class="fa fa-file-o"></i> List File</h2>
			</div>
		</div>

		<!-- /. ROW  -->
		<hr />
		<div class="row">
			<div class="col-lg-12">
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th width="300px"><center>NAMA FILE</center></th>
									<th width="200px"><center>PASSWORD</center></th>
									<th width="150px"><center>TANGGAL</center></th>
									<th width="150px"><center>USER</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									$get = mysqli_query($konek, "SELECT * FROM file");
									while ($tampil=mysqli_fetch_array($get)) {
										echo "<tr>";
										echo "<td align='center'>".$tampil['nama_file']."</td>";
										echo "<td align='center'>".$tampil['kunci']."</td>";
										echo "<td align='center'>".$tampil['tgl']."</td>";
										echo "<td align='center'>".$tampil['nip']."</td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /. page-inner -->
</div>
<!-- /. page-wrapper -->

<?php
	include 'footer.php';
?>

