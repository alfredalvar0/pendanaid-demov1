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
				<h1>Daftar E-Voting</h1>
			</header>
			<!--END PAGE HEADER -->
			<!--START PAGE CONTENT -->
			<section class="page-content container-fluid">
				<div class="card card-body border-0 shadow">

					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th scope="col">No</th>
												<th scope="col">Nama Bisnis</th>
												<th scope="col">Pembahasan</th> 
												<th scope="col">Pilihan</th>
												<th scope="col">Tanggal</th> 
												<!--<th scope="col">Status</th>-->
											</tr>
										</thead>
										<?php
										if($dataevote->num_rows()>0){
										?>
										<tbody>
											<?php
											$num=0;
											$t1=0;
											$t2=0;
											foreach($dataevote->result() as $par){
												$num++;
	
		for ($i=1; $i < 5; $i++) { 
			$total_saham = $this->db->query("
				SELECT
					SUM(di.lembar_saham) AS lembar_saham, di.id_pengguna AS id_pengguna
				FROM
					tbl_vote_pengguna vp
					LEFT JOIN tbl_vote v ON  v.id = vp.id_vote
					LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk
				WHERE
					vp.id_vote = ".$par->id." 
					AND di.id_pengguna = vp.id_pengguna
					AND di.status_approve = 'approve'
			")->row()->lembar_saham;
			$filter['id_produk'] = $par->id_produk;
			// $filter['id_pengguna'] = $saham->id_pengguna;
			$filter['status_approve'] = "approve";
			$total_jual = $this->m_invest->dataTotalinvestJual($filter)->row()->lembar;

			$total = $total_saham - $total_jual;

			$saham = $this->db->query("
				SELECT
					SUM(di.lembar_saham) AS lembar_saham, di.id_pengguna AS id_pengguna
				FROM
					tbl_vote_pengguna vp
					LEFT JOIN tbl_vote v ON  v.id = vp.id_vote
					LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk
				WHERE
					vp.id_vote = ".$par->id." 
					AND vp.jawaban = ".$i."
					AND di.id_pengguna = vp.id_pengguna
					AND di.status_approve = 'approve'
			")->row();
/*
			$saham = $this->db->query("
				SELECT SUM(lembar_saham) as lembar_saham, id_pengguna AS id_pengguna FROM (
					SELECT
						di.lembar_saham AS lembar_saham, di.id_pengguna AS id_pengguna
					FROM
						tbl_vote_pengguna vp
						LEFT JOIN tbl_vote v ON v.id = vp.id_vote
						LEFT JOIN trx_dana_invest di ON di.id_produk = v.id_produk 
					WHERE
						vp.id_vote = ".$par->id." 
						AND vp.jawaban = ".$i." 
						AND di.status_approve = 'approve'
						GROUP BY di.id_dana
				) AS invest
			")->row();
*/	
			$filter['id_produk'] = $par->id_produk;
			$filter['id_pengguna'] = $saham->id_pengguna;
			$filter['status_approve'] = "approve";
			$saham_jual = $this->m_invest->dataTotalinvestJual($filter)->row()->lembar;		
			// $saham_gadai = $this->m_invest->dataTotalinvestGadai($filter)->row()->lembar;
			
			if($saham_jual=="") $saham_jual = 0;
			// if($saham_gadai=="") $saham_gadai = 0;
	
			// $opsi[$i] = $saham->lembar_saham - $saham_jual - $saham_gadai;
			$opsi[$i] = $saham->lembar_saham - $saham_jual;
		}
								// $opsi1 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and jawaban=1")->row()->total;
								// $opsi2 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and jawaban=2")->row()->total;
								// $opsi3 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and jawaban=3")->row()->total;
								// $opsi4 = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and jawaban=4")->row()->total;
								
								// $all_invest = $this->db->query("select * from trx_dana_invest where id_produk=".$par->id_produk." AND status_approve='approve' GROUP BY id_pengguna")->num_rows();

								// $all_vote = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id."")->row()->total;

								$all_invest = $opsi['1'] + $opsi['2'] + $opsi['3'] + $opsi['4'];

								$all_vote = $total;
								
								//cekpernah pilih blum
								$cek = $this->db->query("select count(*) as total from tbl_vote_pengguna where id_vote=".$par->id." and id_pengguna=".$this->session->userdata("invest_pengguna"))->row()->total;
								
								?>
								<tr>
								<td><?php echo $num; ?></td>
								<td><?php echo $par->produk; ?></td>
								<td><?php echo $par->judul; ?> </td>
								<?php
									$now = new DateTime();
									$exp = new DateTime($par->expired_at);
									$expired = ($exp->diff($now)->format("%a") > 0) ? TRUE : FALSE;
								?>
								<td>
								<?php if(!empty($par->opsi1)){ ?>
								<?php if($cek==0 && $expired == FALSE){?>
								<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=1" class="btn btn-success"><?php echo $par->opsi1; ?></a>
								<?php }else{ echo $par->opsi1;}?>&nbsp;<?php echo ($opsi['1'] > 0) ? '<label class="badge badge-success">'.$opsi['1'] . '</label> <label class="badge badge-info">' . number_format(($opsi['1']/$total*100), 1) . '%</label>' : '<label class="badge badge-secondary">0</label>'; ?>&nbsp;&nbsp;
								<?php } ?>

								<?php if(!empty($par->opsi2)){ ?>
								<br>
								<?php if($cek==0 && $expired == FALSE){?>
								<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=2" class="btn btn-success"><?php echo $par->opsi2; ?></a>
								<?php }else{ echo $par->opsi2;}?>&nbsp;<?php echo ($opsi['2'] > 0) ? '<label class="badge badge-success">'.$opsi['2'] . '</label> <label class="badge badge-info">' . number_format(($opsi['2']/$total*100), 1) . '%</label>' : '<label class="badge badge-secondary">0</label>'; ?>
								<?php } ?>

								<?php if(!empty($par->opsi3)){ ?>
								<br>
								<?php if($cek==0 && $expired == FALSE){?>
								<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=3" class="btn btn-success"><?php echo $par->opsi3; ?></a>
								<?php }else{ echo $par->opsi3;}?>&nbsp;<?php echo ($opsi['3'] > 0) ? '<label class="badge badge-success">'.$opsi['3'] . '</label> <label class="badge badge-info">' . number_format(($opsi['3']/$total*100), 1) . '%</label>' : '<label class="badge badge-secondary">0</label>'; ?>&nbsp;&nbsp;
								<?php } ?>

								<?php if(!empty($par->opsi4)){ ?>
								<br>
								<?php if($cek==0 && $expired == FALSE){?>
								<a target="_blank" href="<?php echo base_url()?>investor/prosesvote/<?php echo $par->id; ?>?opsi=4" class="btn btn-success"><?php echo $par->opsi4; ?></a>
								<?php }else{ echo $par->opsi4;}?>&nbsp;<?php echo ($opsi['4'] > 0) ? '<label class="badge badge-success">'.$opsi['4'] . '</label> <label class="badge badge-info">' . number_format(($opsi['4']/$total*100), 1) . '%</label>' : '<label class="badge badge-secondary">0</label>'; ?> 
								<?php } ?>

								<br>
								<br>
								<?php
								if($expired == TRUE){
									if($all_invest != $all_vote){ ?>
								
								<!-- Abstain&nbsp;(<?php echo ($all_invest > 0) ? number_format(($all_invest - $all_vote)/$all_invest*100, 0, '', '') : 0; ?>%)   -->

								<?= 'Abstain <label class="badge badge-success">'. ($all_vote - $all_invest) . '</label> <label class="badge badge-info">' . number_format((($all_vote - $all_invest) / $all_vote) * 100, 1) . '%</label>' ?>
								<!-- Abstain&nbsp;(<?php echo ($all_invest > 0) ? number_format(($all_invest - $all_vote)/$all_invest*100, 0, '', '') : 0; ?>%)   -->
								
								<?php
									}
								}
								?>
								 
								</td>
								<td><?php echo date('d F Y', strtotime($par->createddate)); ?></td>
								 
								   
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