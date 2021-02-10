
<div class="card shadow">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
	</div>
	<div class="card-body">		
		<div class="row">
			<?php
				$user = $proses->user(@$_SESSION['guru']);
				while ($us = $user->fetch_object()) {
					?>
					<div class="col-md-3 text-center" style="border:solid 0.5px #CCC; padding: 40px;">								
						<img class="img-profile rounded-circle" src="img/user/guru/<?php echo $us->FOTO; ?>" style="box-shadow: 2px 2px 5px 2px #CCC;" width="200" height="250">
					</div>							
					<div class="col-md-6" style="border:solid 0.5px #CCC;">
						<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input class="form-control form-control-user" type="text" name="nama" id="nama" value="<?php echo $us->NAMA_LENGKAP; ?>" disabled>
						</div>
						<div class="form-group">
							<label>NIK</label>
							<input class="form-control" type="text" name="nik" id="nik" value="<?php echo $us->NIK; ?>" disabled>
						</div>
						<div class="form-group">
							<label>Foto</label><br>
							<input class="custom-form-control" type="file" name="foto" id="foto" disabled>
						</div>
						<hr style="border: solid 0.05px red;">
						<div class="form-group">
							<label id="edit" class="btn btn-warning btn-icon-split">
                <span class="icon text-white-50">
                  <i class="fas fa-edit"></i>
                </span>
                <span id="tulisan" class="text">Edit</span>
              </label>
							<label id="btn-simpan" class="btn btn-success btn-icon-split" for="simpan">
                <span class="icon text-white-50">
                  <i class="fas fa-save"></i>
                </span>
                <span class="text">Simpan</span>
              </label>
							<input type="submit" name="simpan" id="simpan" style="display:none;" onclick="form.submit()">
						</div>
						</form>
					</div>
					<?php
						$nama = @$_POST['nama'];
						$nik = @$_POST['nik'];								

						if (@$_POST['simpan']) {
							$extensi = explode(".", $_FILES['foto']['name']);
						  $user_pic = $nama."-".round(microtime(true)).".".end($extensi);
						  $sumber = $_FILES['foto']['tmp_name'];
						  $upload = move_uploaded_file($sumber, "img/user/guru/".$user_pic);

						  if ($upload) {
						  	$ganti = $proses->cari("UPDATE tb_user SET NAMA_LENGKAP = '$nama', NIK = '$nik', FOTO = '$user_pic'");
								echo "<meta http-equiv='refresh' content='0'>";
						  } else {
						  	$ganti = $proses->cari("UPDATE tb_user SET NAMA_LENGKAP = '$nama', NIK = '$nik'");
						  	echo "<script>alert('Upload gambar Gagal.')</script>";
						  	echo "<meta http-equiv='refresh' content='0'>";
						  }
						}
					?>
					<?php
				}
			?>					
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="_assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	//Hide Button Simpan
	$('#btn-simpan').hide();
	$(document).ready(function(){
		//Enable Form on Click Edit
		$('#edit').on("click", (function(){
			if ($("#edit #tulisan").html() === "Edit") {
				$('#nama').attr("disabled", false);
				$('#nik').attr("disabled", false);
				$('#foto').attr("disabled", false);
				$('#edit #tulisan').html("Batal");
				$('#btn-simpan').hide().fadeIn(800);
			} else if ($("#edit #tulisan").html() === "Batal"){
				$('#nama').attr("disabled", true);
				$('#nik').attr("disabled", true);
				$('#foto').attr("disabled", true);
				$('#edit #tulisan').html("Edit");
				$('#btn-simpan').show().fadeOut(500);
			}			
		}));
	})
</script>