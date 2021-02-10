<?php
$id = @$_GET['id'];

$edit = $proses->cari("SELECT * FROM tb_lowongan WHERE ID_JOB = '$id' ");

foreach ($edit as $data) {
	?>

<div class="card shadow">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Edit Lowongan</h6>
	</div>
	<div class="card-body">		
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Lowongan</label>
						<input class="form-control" type="text" name="nmLow" id="nmLow" required value="<?php echo $data['NAMA']; ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama Perusahaan</label>
						<input class="form-control" type="text" name="nmPt" id="nmPt" required value="<?php echo $data['PT']; ?>">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Program Studi</label>
						<select class="form-control" name="studi" id="studi" required>
							<option selected disabled>Pilih...</option>
							<option <?php if ($data['STUDI'] == "TIK") {echo "selected";} ?> value="TIK">TIK</option>
							<option <?php if ($data['STUDI'] == "APH") {echo "selected";} ?> value="APH">APH</option>
							<option <?php if ($data['STUDI'] == "TKR") {echo "selected";} ?> value="TKR">TKR</option>
							<option <?php if ($data['STUDI'] == "TSM") {echo "selected";} ?> value="TSM">TSM</option>
						</select> 						
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Gaji yang ditawarkan</label>
						<input class="form-control" type="text" name="gaji" id="gaji" value="<?php echo $data['GAJI']; ?>">						
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Tanggal Mulai</label>
						<input class="form-control" type="date" name="mulai" id="mulai" required value="<?php echo $data['TGL_MULAI']; ?>">						
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Tanggal Berakhir</label>
						<input class="form-control" type="date" name="akhir" id="akhir" required value="<?php echo $data['TGL_SELESAI']; ?>">						
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Detail Pekerjaan</label>
						<textarea id="detail" name="detail" class="form-control" rows="4" cols="50" style="white-space: pre-line">
							<?php echo $data['DETAIL']; ?>"
						</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email Perusahaan</label>
						<input class="form-control" type="email" name="email" id="email" value="<?php echo $data['EMAIL']; ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<input class="btn btn-success btn-block" type="submit" name="simpan" value="Simpan">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<?php
}


if (isset($_POST['simpan'])) {
	$nmLow = $connection->conn->real_escape_string($_POST['nmLow']);
	$nmPt = $connection->conn->real_escape_string($_POST['nmPt']);
	$studi = $connection->conn->real_escape_string($_POST['studi']);
	$gaji = $connection->conn->real_escape_string($_POST['gaji']);
	$email = $connection->conn->real_escape_string($_POST['email']);
	$mulai = $connection->conn->real_escape_string($_POST['mulai']);
	$akhir = $connection->conn->real_escape_string($_POST['akhir']);
	$detail = $connection->conn->real_escape_string($_POST['detail']);
	
	
	$proses->cari("UPDATE tb_lowongan SET NAMA = '$nmLow', PT = '$nmPt', STUDI = '$studi', GAJI = '$gaji', EMAIL = '$email', TGL_MULAI = '$mulai', TGL_SELESAI = '$akhir', DETAIL = '$detail' WHERE ID_JOB = '$id' ");

	echo "<script>alert('Berhasil merubah lowongan ".$nmLow."')</script>";
	echo "<script>window.location='?page=lowongan&jur=".$studi."'</script>";
}
?>

<!-- Bootstrap core JavaScript-->
<script src="_assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		//Set Minimum Start Day
		var today = new Date().toISOString().split('T')[0];
  	document.getElementsByName("mulai")[0].setAttribute('min', today);
  	document.getElementsByName("akhir")[0].setAttribute('min', today+1);
  	// Restricts input for each element in the set of matched elements to the given inputFilter.
		(function($) {
		  $.fn.inputFilter = function(inputFilter) {
		    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
		      if (inputFilter(this.value)) {
		        this.oldValue = this.value;
		        this.oldSelectionStart = this.selectionStart;
		        this.oldSelectionEnd = this.selectionEnd;
		      } else if (this.hasOwnProperty("oldValue")) {
		        this.value = this.oldValue;
		        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
		      }
		    });
		  };
		}(jQuery));

		// Install input filters.
		$("#gaji").inputFilter(function(value) {
		  return /^-?\d*$/.test(value); });
	});
</script>


