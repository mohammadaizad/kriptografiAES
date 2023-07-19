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
					<h2><i class="fa fa-question"></i> Help</h2>
				</div>
			</div>
					
			<!-- /. ROW  -->
			<hr />
			<div class="row">
				<div class="col-lg-12 ">
					<div class="alert alert-info">
						<strong>
							<center>
								<font color="black">
									CARA PENGGUNAAN APLIKASI
								</font>
							</center>
						</strong>
						<font color="black">
							<ol>
								<li><b>Enkripsi</b> : Digunakan untuk mengenkrip data</li>
									<ul>
										<li>Pilih Menu <font color="black"><b>Enkripsi</b></font> pada Form Menu</li>
										<li>Pilih File yang akan di enkripsi</li>
										<li>Tipe File berupa <font color="red">.txt, .doc, .docx, .xls, .xlsx, dan .pdf</font></li>
										<li>Masukan kunci (minimal 8 karakter)</li>
										<li>Klik <font color="black"><b>Submit</b> untuk melakukan enkrip file</font></li>
										<li>Lalu klik <font color="black"><b>Download</b> untuk melihat hasil</font></li>
									</ul>
									
								<li><b>Deskripsi</b> : Digunakan untuk membuka enkrip data</li>
									<ul>
										<li>Pilih Menu <font color="black"><b>Deskripsi</b></font> pada Form Menu</li>
										<li>Pilih File Enkripsi yang akan di didekripsi</li>
										<li>Masukan kunci yang sama dengan file yang di enkripsi</li>
										<li>Klik <font color="black"><b>Submit</b> untuk melakukan dekrip file</font></li></li>
										<li>Lalu klik <font color="black"><b>Download</b> untuk melihat hasil</font></li>
									</ul>
							</ol>
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