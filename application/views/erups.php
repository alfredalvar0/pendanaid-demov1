<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center">
			<ul class="navbar-nav nav-left">
				<li class="nav-item">
					<a href="javascript:void(0)" data-toggle-state="aside-left-open">
						<i class="icon dripicons-align-left"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-center site-logo">
				<li class="d-flex align-items-center">
					<a href="<?= base_url(); ?>">
						<div class="mobile_logo d-block">
							<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" width="50" height="50"
								class="img-fluid">
						</div>
						
					</a>
				</li>
			</ul>
		</nav>

		<div class="content">
			<!--START PAGE HEADER -->
			<header class="page-header">
				<h1>Jadwal E-RUPS</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<row class="table-responsive p-2">
					<div class="col-12">
					<table id="example" class="table table-striped table-bordered" style="width: 100%;">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama Bisnis</th>
										<th scope="col">Judul Bahasan</th>
										<th scope="col">Jam</th>
										<th scope="col">Tanggal</th>  
										<th scope="col">Link</th>
										<!--<th scope="col">Status</th>-->
									</tr>
								</thead>
								<?php
								if($dataerups->num_rows()>0){
								?>
								<tbody>
									<?php
									$num=0;
									$t1=0;
									$t2=0;
									foreach($dataerups->result() as $par){
										$num++;
										  
										?>
										<tr>
										<td><?php echo $num; ?></td>
										<td><?php echo $par->produk; ?></td>
										<td><?php echo $par->judul; ?></td>
										<td><?php echo $par->jam; ?></td>
										<td><?php echo date('d F Y', strtotime($par->tanggal)); ?></td>
										 
										<td>
										<?php if($par->status==0){?>
										<a target="_blank" href="<?php echo $par->link; ?>" class="btn btn-success">Join</a>
										<?php }else{ echo "selesai";}?>
										</td>
										<!--<td><?php echo $par->status_approve; ?></td>-->
									</tr>
										<?php
									}
									?>
								</tbody>
								<!--<tfoot>
									<tr>
										<td colspan="2">Total</td>
										<td class="text-right">Rp. <?php echo number_format($t1,0,",","."); ?></td>
										<td>&nbsp;</td>
										<td class="text-right">Rp. <?php echo number_format($t2,0,",","."); ?></td>
										<td colspan="2">&nbsp;</td>
									</tr>
								</tfoot>-->
								<?php
								} else {
									?>
									<tbody>
										<tr>
											<td colspan="7" class="text-center">Data tidak ditemukan</td>
										</tr>
									</tbody>
									<?php
								}
								?>
							</table>
					</div>
				</row>
			</section>
		</div>

	</div>
</div>
<form id="formpdf" action="<?php echo base_url(); ?>invest/pdfproyeksi" method="post">
	
</form>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>

<script>

	$(document).ready(function(){
		$('#example').DataTable();
		
		$("#export").on("click",function(){
			$('#formpdf').html("");
			var periode=$("#periode option:selected").val();
			$('<input>').attr({
				type: 'hidden',
				id: 'periodepdf',
				name: 'periode',
				value:periode
			}).appendTo($('#formpdf'));
			$('#formpdf').submit();
			/* 
			$.post("<?php echo base_url(); ?>invest/pdfproyeksi", {periode:periode},function(result){
				//alert(result);
			}); */
		});
	});
</script>