<style type="text/css">
	tr, td {white-space: nowrap;}
</style>

<div class="card shadow">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Data Alumni SMKS Fadilah</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table id="dataAlumni" width="100%" class="table table-bordered dataTable" role="grid" aria-describedby="dataTable_info" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>J/K</th>
						<th>Studi</th>
						<th>Alamat</th>
						<th>Status <br><small>*Klik untuk detail</small></th>
						<?php
							if (@$_SESSION['guru'] || @$_SESSION['siswa']) {
								?>									
									<th>Telepon</th>
									<th>Action</th>
								<?php
							}
						?>
						
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php
							$no = 1;
							$alumni = $proses->alumni();
							$sis = $proses->alumni(@$_SESSION['siswa'])->fetch_array();

							while ($data = $alumni->fetch_object()) {
								?>
									<td><?php echo $no++; ?></td>
									<td><?php echo $data->NAMA; ?></td>
									<td><?php echo $data->JK; ?></td>
									<td><?php echo $data->STUDI; ?></td>
									<td><?php echo $data->ALAMAT; ?></td>
									<td>
										<a id="detail-modal" href="" style="text-decoration: none; color: #858796" data-toggle="modal" data-target="#modal-dtl" data-status="<?php echo $data->STATUS; ?>" data-dtl="<?php echo $data->DETAIL; ?>"><?php echo $data->STATUS; ?></a>
										</td>
									<?php
										if (@$_SESSION['guru'] || @$_SESSION['siswa']) {
											?>
												<td><?php echo $data->TELP; ?></td>
												<td>
										<?php
										if (@$_SESSION['guru']) {
											?>
											<a id="editStat" class="btn btn-xs py-0 btn-info" style="font-size: 0.8em;" href="" data-toggle="modal" data-target="#abc" data-id="<?php echo $data->NO; ?>" data-alumni="<?php echo $data->NAMA; ?>" data-status="<?php echo $data->STATUS; ?>" data-telepon="<?php echo $data->TELP; ?>" data-detail="<?php echo $data->DETAIL; ?>" aria-haspopup="true" aria-expanded="true" > Edit</a>
											<?php
										} elseif (@$_SESSION['siswa']) {
											if ($data->NIS == $sis['1']) {
												?>
												<a id="editStat" class="btn btn-xs py-0 btn-info" style="font-size: 0.8em;" href="" data-toggle="modal" data-target="#abc" data-id="<?php echo $data->NO; ?>" data-alumni="<?php echo $data->NAMA; ?>" data-status="<?php echo $data->STATUS; ?>" data-telepon="<?php echo $data->TELP; ?>" data-detail="<?php echo $data->DETAIL; ?>" aria-haspopup="true" aria-expanded="true" > Edit</a>
												<?php
											}
										}
										?>										
									</td>
											<?php
										}
									?>
								</tr>								
								<?php
							}
						?>					
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Modal Detail-->
<div class="modal fade" id="modal-dtl" tabindex="-1" role="dialog" aria-labelledby="DetailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title" id="DetailModalLabel">Detail Universitas / Pekerjaan</h5>
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
      <div class="modal-body">
      	<div id="isi"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="abc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
	      <div class="modal-body">
	        <div class="form-group">
	        	<input type="hidden" name="id" id="id">
	        	<label>Nama</label>
	        	<input class="form-control" type="text" name="alumni" id="alumni" disabled>
	        </div>
	        <div class="form-group">
	        	<label>Status Pekerjaan</label>
	        	<select class="form-control" id="status" name="status">
	        		<option value="Bekerja">Bekerja</option>
	        		<option value="Kuliah">Kuliah</option>
	        		<option value="Wirausaha">Wirausaha</option>
	        	</select>
	        </div>	        
	        <div class="form-group">
	        	<label>Detail Pekerjaan / Universitas</label>
	        	<input class="form-control" type="text" name="detail" id="detail">
	        </div>
	        <div class="form-group">
	        	<label>Telepon</label>
	        	<input class="form-control" type="text" name="telepon" id="telepon">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	        
	        <button id="save" type="button" class="btn btn-primary">Save changes</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<div class="hasil"></div>

<!-- Bootstrap core JavaScript-->
<script src="_assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
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
		$("#telepon").inputFilter(function(value) {
		  return /^-?\d*$/.test(value); });			
	$(document).ready(function(){		
		$(document).on("click", "#detail-modal", function(){
			var status = $(this).data('status');
			var detail = $(this).data('dtl');

			if (status === "Bekerja") {
				$("#isi").html("Detail Pekerjaan : "+detail);
			} else if (status === "Kuliah") {
				$("#isi").html("Detail Universitas : "+detail);
			} else if (status === "Wirausaha") {
				$("#isi").html("Detail Usaha : "+detail);
			}
			
		});
		//Fill Modal when Click Edit
		$(document).on("click", "#editStat", function(){
			var id = $(this).data('id');
			var nama = $(this).data('alumni');
			var status = $(this).data('status');
			var telepon = $(this).data('telepon');
			var detail = $(this).data('detail');

			$("#id").val(id);
			$("#alumni").val(nama);
			$('#status').val(status);
			$('#telepon').val(telepon);
			$('#detail').val(detail);
		});
		//Save Function
		$("#save").on("click", (function(e) {
      e.preventDefault();
      var id = $("#id").val();
      var dtl = $("#detail").val();
      var status = $("#status").val();
      var telepon = $("#telepon").val();

      $.ajax({
        url : '_config/edit_status.php',
        type : 'POST',
        data : {
        	id: id,
        	status: status,
        	dtl: dtl,
        	telepon: telepon
        },        
        success : function(msg) {
          $('.hasil').html(msg);
        }
      });
    }));
	})
</script>