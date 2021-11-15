<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center" style="padding: 0 15px;">
			<ul class="navbar-nav nav-left">
				<li class="nav-item">
					<a href="javascript:void(0)" data-toggle-state="aside-left-open" style="min-width: unset;">
						<i class="fa fa-bars d-flex align-items-center justify-content-center"></i>
					</a>
				</li>
			</ul>
			<ul class="navbar-nav nav-center site-logo">
				<li class="d-flex align-items-center">
					<a href="<?= base_url(); ?>">
						<div class="mobile_logo d-flex">
							<img src="<?= base_url(); ?>assets/img/new/logo_pendana.png" alt="Logo Pendana" width="50" height="50"
								class="img-fluid">
							<div class="d-block d-lg-none d-flex align-items-center">
								<img class="mr-2" style="max-height: 35px;" src="<?= base_url(); ?>assets/img/new/logo_ojk.png" alt="Otoritas Jasa Keuangan">
								<img style="max-height: 35px;" src="<?= base_url(); ?>assets/img/partner/logo_mui.png" alt="Otoritas Jasa Keuangan">
							</div>
						</div>
					</a>
				</li>
			</ul>
		</nav>

		<div class="content">
			<!--START PAGE HEADER -->
			<header class="page-header">
				<h1>Laporan Bisnis: <?= $bisnis->judul; ?></h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th scope="col">No</th> 
								<th scope="col">Keuntungan Bisnis</th>
								<th scope="col">Kerugian Bisnis</th>
								<th scope="col">Dividen</th> 
								<th scope="col">Pendapatan</th> 
								<th scope="col">Detail</th> 
								<th scope="col">Tanggal </th>  
							</tr>
						</thead>
						<?php
						if($laporanbisnis->num_rows()>0){
						?>
						<tbody>
							<?php
							$num=0;
							$t1=0;
							$t2=0;
							foreach($laporanbisnis->result() as $par){
								$num++; 
								?>
								<tr>
								<td><?php echo $num; ?></td>
									
								<td class="text-right">Rp. <?php echo number_format($par->laba,0,",","."); ?></td>
								<td class="text-right">Rp. <?php echo number_format($par->rugi,0,",","."); ?></td>
								<td><?php echo $par->dividen; ?>%</td>
								<td class="text-right">Rp. <?php echo number_format($par->profit,0,",","."); ?></td>
								<td><?php echo $par->keterangan; ?></td>
								<td><?php echo date('d F Y', strtotime($par->tanggal)); ?></td>
									
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