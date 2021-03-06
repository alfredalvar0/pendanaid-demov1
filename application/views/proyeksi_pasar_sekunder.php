<?php
setlocale(LC_ALL, 'id_ID.utf8');

$filter = array(
	"ps.id_pengguna" => $this->session->userdata("invest_pengguna"),
);

$data_portfolio = $this->m_invest->getPortfolioPasarSekunder($filter);
?>
<style type="text/css">
.btn-group-xs > .btn, .btn-xs {
  /*padding: .25rem .4rem;*/
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>

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
				<h1>Transaksi Pasar Sekunder</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="card card-body border-0 shadow">
					<div class="table-responsive">
						<table id="example" class="table table-striped mb-5" style="width:100%">
							<thead>
								<tr>
									<th scope="col">No</th> 
									<th scope="col">Tanggal</th>
									<th scope="col">Nama Bisnis</th>
									<th scope="col">Transaksi</th>
									<th scope="col">Jumlah</th>
									<th scope="col">Harga</th>
									<th scope="col">Jasa Transaksi</th>
									<!-- <th scope="col">Kustodian</th> -->
									<th scope="col">Jasa Kustodian</th>
									<th scope="col">Total</th>
									<th scope="col">Status</th> 
									<th scope="col">Aksi</th> 
								</tr>
							</thead>
							<?php if($data_portfolio->num_rows() > 0){ ?>
							<tbody>
								<?php
								$num = 1;
								foreach($data_portfolio->result() as $value){
									?>
									<tr>
										<td><?php echo $num++; ?></td> 
										<td class="small"><?php echo date('d M Y, H:i', strtotime($value->created_at)); ?></td>
										<td class="small"><?php echo $value->judul; ?></td>
										<td>
											<?php
												$total_kotor = $value->harga_per_lembar * $value->lembar_saham;

												switch ($value->jenis_transaksi) {
													case 'beli':
														echo '<label class="badge bg-info text-light">Beli</label>';
														$admin_fee = !empty($value->admin_fee) ? $value->admin_fee : ($value->total - $total_kotor);
														$custodian_fee = $value->custodian_fee;
														break;

													case 'jual':
														echo '<label class="badge bg-danger text-light">Jual</label>';
														$admin_fee = !empty($value->admin_fee) ? $value->admin_fee : ($total_kotor - $value->total);
														$custodian_fee = $value->custodian_fee;
														break;
													
													default:
														// code...
														break;
												}
											?>
										</td>
										<td><?php echo $value->lembar_saham . ' Lembar'; ?></td>
										<td style="text-align: right;"><?php echo number_format($value->harga_per_lembar, 0, '', '.'); ?></td>
										<td style="text-align: right;"><?php echo number_format($admin_fee, 0, '', '.'); ?></td>
										<!-- <td><img src="<?= base_url('assets/img/logo_ksei.png') ?>" width="100px;" title="PT Kustodian Sentral Efek Indonesia"> </td> -->
										<td style="text-align: right;"><?php echo number_format($custodian_fee, 0, '', '.'); ?></td>
										<td style="text-align: right;"><?php echo number_format($value->total, 0, '', '.'); ?></td>
										<td class="text-center">
											<?php
												switch ($value->status) {
													case 'pending':
														echo '<label class="badge bg-secondary text-light">Pending</label>';
														break;

													case 'confirm':
														echo '<label class="badge bg-secondary text-light">Pending</label>';
														break;

													case 'success':
														echo '<label class="badge bg-success text-light">Success</label>';
														break;

													case 'cancel':
														echo '<label class="badge bg-danger text-light">Cancel</label>';
														break;

													case 'hold':
														echo '<label class="badge bg-warning text-dark mb-2">On Hold</label>';
														break;
													
													default:
														// code...
														break;
												}

												if ($value->status == 'hold') {
													// echo '
													// 	  <a href="' . base_url('invest/onHoldTransactions/continue/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-info" onclick="return confirm(\'Anda yakin akan melanjutkan sisa transaksi?\')">Continue</a>
													// 	  <a href="' . base_url('invest/onHoldTransactions/cancel/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-danger" onclick="return confirm(\'Anda yakin akan membatalkan sisa transaksi?\')">Cancel</a>
													// ';
												}
											?>
										</td>
										<td>
											<?php
												if ($value->status == 'confirm') {
													// $this->db->select('reserved_for');
													$this->db->from('trx_pasar_sekunder');
													$this->db->where('reserved_for IS NOT NULL', NULL);
													$this->db->where('reserved_for', $value->id);
													$qLawan = $this->db->get();
// var_dump($qLawan);die();
													if ($qLawan->num_rows() > 0) {
														// $this->db->select();
														// $this->db->from('trx_pasar_sekunder');
														// $this->db->where('reserved_for', $value->id);
														// $reserved_transaction = $this->db->get_compiled_select();
														// $queueFilter['ps.reserved_for NOT IN ('.$reserved_transaction.')'] = null;
														$lawan = $qLawan->row();
														$filterLawan = [
															'ps.id' => $lawan->id
														];
														$dataLawan = $this->m_invest->getPortfolioPasarSekunder($filterLawan)->row();
														// var_dump($dataLawan);die();
													} else {
														// $this->db->select('reserved_for');
														$this->db->from('trx_pasar_sekunder');
														// $this->db->where('reserved_for IS NOT NULL', NULL);
														$this->db->where('id', $value->reserved_for);
														$qLawan = $this->db->get();
// var_dump($qLawan->num_rows());die();
														// $this->db->select();
														// $this->db->from('trx_pasar_sekunder');
														// $this->db->where('reserved_for', $value->id);
														// $reserved_transaction = $this->db->get_compiled_select();
														// $queueFilter['ps.reserved_for NOT IN ('.$reserved_transaction.')'] = null;

														$lawan = $qLawan->row();
														$filterLawan = [
															'ps.id' => $lawan->id
														];
														$dataLawan = $this->m_invest->getPortfolioPasarSekunder($filterLawan)->row();

														// var_dump($dataLawan);die();
													}
												}

												// if (!empty($value->reserved_for)) {
												// 	$idLawan = $value->reserved_for;

												// 	$filterLawan = array(
												// 		"ps.id" => $idLawan
												// 	);

												// 	$dataLawan = $this->m_invest->getPortfolioPasarSekunder($filterLawan)->row();
												// }

												switch($value->status) {
													case 'hold':
														if ($value->jenis_transaksi == 'beli') {
															echo '<small>Dana tersisa <b>'.number_format($value->total_hold, 0, ',', '.').'</b>, kekurangan dana  sebesar <b>'.number_format(($value->total - $value->total_hold), 0, ',', '.').'</b> akan diambil dari saldo deposit anda.</small>';
														}
														echo '
															  <a href="' . base_url('invest/onHoldTransactions/continue/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-info" onclick="return confirm(\'Anda yakin akan melanjutkan sisa transaksi?\')">Continue</a>
															  <a href="' . base_url('invest/onHoldTransactions/cancel/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-danger" onclick="return confirm(\'Anda yakin akan membatalkan sisa transaksi?\')">Cancel</a>
														';
														echo '
															<small class="text-danger">Otomatis <b>cancel</b> dalam <b>10 menit</b> jika tidak ada aksi.</small>
														';
														break;

													case 'confirm':
														echo "<small>Terdapat ".(($dataLawan->jenis_transaksi == 'jual') ? 'Penjualan' : 'Pembelian')." ".$dataLawan->lembar_saham." lembar saham, harga ".number_format($dataLawan->harga_per_lembar, 0, ',', '.')." per lembar</small>";
														if ($value->jenis_transaksi == 'beli') {
															echo '
																  <a href="' . base_url('invest/confirmBuyTransactions/continue/' . $value->id_produk . '/' . $value->id_dana . '/' . $dataLawan->id) . '" class="btn btn-block btn-xs btn-info" onclick="return confirm(\'Anda yakin akan melanjutkan transaksi?\')">Continue</a>';
															echo '
																  <a href="' . base_url('invest/onHoldTransactions/cancel/' . '/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-danger" onclick="return confirm(\'Anda yakin akan membatalkan transaksi?\')">Cancel</a>
															';
														} elseif ($value->jenis_transaksi == 'jual') {
															echo '
																  <a href="' . base_url('invest/confirmSellTransactions/continue/' . $value->id_produk . '/' . $value->id_dana . '/' . $dataLawan->id) . '" class="btn btn-block btn-xs btn-info" onclick="return confirm(\'Anda yakin akan melanjutkan transaksi?\')">Continue</a>';
															echo '
																  <a href="' . base_url('invest/onHoldTransactions/cancel/' . $value->id_dana) . '" class="btn btn-block btn-xs btn-danger" onclick="return confirm(\'Anda yakin akan membatalkan transaksi?\')">Cancel</a>
															';
														}
														break;

													default:
														// code...
														break;
												}
											?>
										</td>
									</tr>
									<?php
								}
								?>
							</tbody>
							<?php } else { ?>
								<tbody>
									<tr>
										<td colspan="11" class="text-center">Data tidak ditemukan</td>
									</tr>
								</tbody>
							<?php } ?>
						</table>
					</div>
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