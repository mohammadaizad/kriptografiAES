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
					<h2><i class="fa fa-home"></i> Home</h2>   
				</div>
			</div>
					
			<!-- /. ROW  -->
			<hr />
			<div class="row">
				<div class="col-lg-12 ">
					<div class="alert alert-info">
						<font color="black">
							Hai, <strong><?php echo $login_session; ?> (<?php echo $nip; ?>)</strong>
							<br />
							Selamat Datang di <strong>Aplikasi Kriptografi</strong>
						</font>
					</div>
				</div>
            </div>
		</div>
    </div>
</div>

<?php
	include 'footer.php';
?>