<style type="text/css">
	.current {
		pointer-events: none;
	  cursor: default;
	  text-decoration: none;
	  color: black;
	}
	.hal
	{
		background-color: white;
		border: 1px solid #e3e6f0;
		border-radius: calc(-1px + 0.35rem);
		padding-top: 15px;
		padding-left: 15px;
	}
	.card:hover{
		box-shadow: none !important;
	}
	.card-body{		
		height: 200px;
		overflow-y: auto;
	}
	.hal p, .lis {display: inline-block;}
	#pagin li {display: inline-block;}
</style>
<div class="container">
	<div class="row">

<?php
$date = date("Y-m-d");
$studi = @$_GET['jur'];

$sql = "SELECT * FROM tb_lowongan WHERE TGL_MULAI <= CURDATE() AND NOT TGL_SELESAI < CURDATE() AND STATUS = '' ";
if ($studi != '') {
	$sql .= " AND STUDI = '$studi'";
}

$lowongan = $proses->cari($sql);
$row = $lowongan->num_rows;
if ($row > 0) {
	while ($data = $lowongan->fetch_object()) {
		?>
		<div class="col-md-6 line-content">
			<div class="card shadow mb-4">
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary"><?php echo $data->NAMA; ?> || <?php echo $data->PT; ?></h6>
					<?php
						if (@$_SESSION['guru']) {
							?>
								<div class="dropdown no-arrow">
	                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                  <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
	                </a>
	                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
	                  <div class="dropdown-header">Edit Data:</div>
	                  <a class="dropdown-item" href="?page=edit&id=<?php echo $data->ID_JOB; ?>">Edit</a>
	                  <a id="hapus" class="dropdown-item" href=""  data-id="<?php echo $data->ID_JOB; ?>" data-nama="<?php echo $data->NAMA; ?>">Hapus</a>                  
	                </div>
	              </div>
							<?php
						}
					?>
				</div>
				<div class="card-body">								
					<b>Gaji yang ditawarkan : <?php echo "Rp. ".number_format($data->GAJI); ?></b>
					<hr>
					<b>Requirement : <?php echo $data->REQUIREMENT; ?></b>
					<hr>
					<p style="white-space: pre-line"><?php echo $data->DETAIL; ?></p>
				</div>
				<div class="card-footer">
					<a href="mailto:<?php echo $data->EMAIL; ?>" target="_top">Kirim Lamaran</a>
				</div>
			</div>
		</div>
		<?php
	}
} else {
	?>
		<div id="kosong" class="d-sm-flex align-items-center justify-content-between mb-4 kosong">
		  <h1 class="h3 mb-0 text-gray-800">Tidak ada data ditemukan</h1>
		</div>
	<?php
}
?>
	</div>
</div>

<div class="col-md-12 stt">
	<div class="hal shadow">
		<p>Halaman </p><ul id="pagin" class="lis"></ul>
	</div>
</div>

<div class="hasil"></div>
	

<!-- Bootstrap core JavaScript-->
<script src="_assets/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	//Pagination
	pageSize = 4;

	var pageCount =  $(".line-content").length / pageSize;
    
     for(var i = 0 ; i<pageCount;i++){
        
       $("#pagin").append('<li><a href="#">'+(i+1)+'</a></li> ');
     }
        $("#pagin li").first().find("a").addClass("current")
    showPage = function(page) {
	    $(".line-content").hide();
	    $(".stt").hide();	    
	    $(".line-content").each(function(n) {
	        if (n >= pageSize * (page - 1) && n < pageSize * page)
	            $(this).show();
	          	$(".stt").show();	          	
	    });        
	}
    
	showPage(1);

	$("#pagin li a").click(function() {
	    $("#pagin li a").removeClass("current");
	    $(this).addClass("current");
	    showPage(parseInt($(this).text())) 
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#hapus").on("click", (function(e){
			e.preventDefault();
			var id = $(this).data('id');
			var nama = $(this).data('nama');

			var r = confirm("Anda yakin akan menghapus lowongan "+nama);
			if (r == true) {
				$.ajax({
					type: "POST",
					url: "_config/hapus.php",
					data: {
						id: id
					},
					success: function(msg){
						$(".hasil").html(msg);
					}
				})
			}
		}));
	});
</script>