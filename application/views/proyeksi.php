<?php
//date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.utf8');

$whsaham = array(
	"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	//"MONTH(createddate)"=>date("m"),
	//"YEAR(createddate)"=>date("Y")
);

$whd=array(
	"i.id_pengguna"=>$this->session->userdata("invest_pengguna"),
	//"MONTH(p.tglakhir)"=>date("m"),
	//"YEAR(p.tglakhir)"=>date("Y")
); 
if($this->input->post("periode")!=""){
	$exp=explode("-",$this->input->post("periode"));
	//$whd["YEAR(p.tglakhir)"]=$exp[0];
	//$whd["MONTH(p.tglakhir)"]=$exp[1];
	
	$whsaham = array(
	"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	//"MONTH(createddate)"=>$exp[1],
	//"YEAR(createddate)"=>$exp[0]
);
}
$danadtl=$this->m_invest->dataDanaInvest($whd);
?>

<div id="app" class="dashboard">
	<?= $sidebar; ?>
	<div class="content-wrapper">
		<nav class="top-toolbar navbar navbar-mobile navbar-tablet align-items-center bg-white" style="padding: 0 15px;">
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
				<h1>Daftar Bisnis</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="table-responsive">
					<table id="example" class="table table-striped" style="width:100%">
						<thead>
							<tr>
									<th scope="col">No</th> 
								<th scope="col">Nama Bisnis</th>
								<th scope="col">Saham</th>
								<!--<th scope="col">Jual</th>
								<th scope="col">Gadai</th>  
								<th scope="col">Tanggal Aktif</th>-->
								<th scope="col">Laporan</th> 
							</tr>
						</thead>
						<?php
						if($danadtl->num_rows()>0){
						?>
						<tbody>
							<?php
							$num=0;
							$t1=0;
							$t2=0;
							foreach($danadtl->result() as $par){
								$idp=$this->session->userdata("invest_pengguna");
								
								$num++;
								$t1=$t1+$par->jumlah_dana;
								$kembali = $par->jumlah_dana+(($par->jumlah_dana*$par->finansial_dividen)/100);
								$t2=$t2+$kembali;
								
								//get lembar saham
								$whsaham['id_produk'] = $par->id_produk;
								$whsaham['id_pengguna'] = $idp;
								$saham = $this->m_invest->dataTotalinvest($whsaham)->row();
								
								//get lembar saham jual 
								$whsaham['status_approve'] = "approve";
								$saham_jual = $this->m_invest->dataTotalinvestJual($whsaham)->row()->lembar;
								
								//get lembar saham gadai 
								$saham_gadai = $this->m_invest->dataTotalinvestGadai($whsaham)->row()->lembar;
								
								if($saham_jual=="") $saham_jual = 0;
								if($saham_gadai=="") $saham_gadai = 0;
								
								$sisasaham = $saham->lembar - $saham_jual  - $saham_gadai ;
								?>
								<tr>
									<td><?php echo $num; ?></td> 
								<td><a href="<?php echo base_url()?>invest/detail/<?php echo $par->siteurl; ?>"><?php echo $par->judul; ?></a></td>
								<td><?php echo $sisasaham ; ?> Lembar</td>
								<!--<td><?php echo ($saham_jual->lembar=="")?0:$saham_jual->lembar; ?> Lbr</td>
								<td><?php echo ($saham_gadai->lembar=="")?0:$saham_gadai->lembar; ?> Lbr</td>
								<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>-->
								<td>
									<a href="<?php echo base_url()?>investor/laporanhistory/<?php echo $par->id_produk?>" class="btn btn-info mr-1">Lihat</a>
									<a href="<?php echo base_url()?>investor/laporanbisnis/<?php echo $par->id_produk?>" class="btn btn-success mr-1">Dividen</a> 
									<!--<a href="<?php echo base_url()?>investor/laporangadai/<?php echo $par->id_produk?>" class="btn btn-warning col-md-2 mr-1">Gadai</a>-->
									<a href="<?php echo base_url()?>investor/laporanjual/<?php echo $par->id_produk?>" class="btn btn-primary">Jual</a>
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
			</section>
			<form id="formpdf" action="<?php echo base_url(); ?>invest/pdfproyeksi" method="post"></form>
		</div>

	</div>
</div>

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