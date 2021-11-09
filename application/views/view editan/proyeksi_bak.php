<?php
//date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.utf8');

$whsaham = array(
	"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	"MONTH(createddate)"=>date("m"),
	"YEAR(createddate)"=>date("Y")
);

$whd=array(
	"i.id_pengguna"=>$this->session->userdata("invest_pengguna"),
	"MONTH(p.tglakhir)"=>date("m"),
	"YEAR(p.tglakhir)"=>date("Y")
); 
if($this->input->post("periode")!=""){
	$exp=explode("-",$this->input->post("periode"));
	$whd["YEAR(p.tglakhir)"]=$exp[0];
	$whd["MONTH(p.tglakhir)"]=$exp[1];
	
	$whsaham = array(
	"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	"MONTH(createddate)"=>$exp[1],
	"YEAR(createddate)"=>$exp[0]
);
}
$danadtl=$this->m_invest->dataDanaInvest($whd);
?>
<br><br>
<section id="team" >
    <div class="container"  >
        <div class="section">
            <div class="row mt-5">
                <div class="col-12" align="center">
                    <h4 class="text-center"><b>Daftar Bisnis</b></h4>
                </div>
				<!-- <div class="col-12" align="center">
                    <embed name="E" id="E" src="<?php echo base_url() ?>assets/img/ico-report.svg" width="100px" height="100px">
                </div> -->
            </div>
			<div class="row mt-5">
				<div class="col-md-12">
					<form class="form-inline row" action="<?php echo base_url(); ?>investor/proyeksi" method="post">
						<label class="col-1 mr-1" for="periode">Periode</label>
						<select class="col-2 form-control" name="periode" id="periode" onchange="this.form.submit()">
							<?php
							$dateStart = (date("Y")-1)."-01-01";
							$endYear=(date("Y"))."-12-01";
							$dateEnd = date("Y-m-t", strtotime($endYear));
							$current_date = $dateStart;
							$now=date("Y-m");
							while(strtotime($current_date) < strtotime($dateEnd)){
								//echo $current_date."<br>";
								$mc=date("m", strtotime($current_date));
								$yc=date("Y", strtotime($current_date));
								$whd=array(
									"i.id_pengguna"=>$this->session->userdata("invest_pengguna"),
									"MONTH(p.tglakhir)"=>$mc,
									"YEAR(p.tglakhir)"=>$yc
								); 
								$danap=$this->m_invest->dataDanaInvest($whd);
								$yes=$danap->num_rows()>0?"yes":"";
								$dateny=date("Y-m", strtotime($current_date));
								$dateny2=strftime('%B %Y', strtotime($current_date));
								$sel="";
								if($this->input->post("periode")==""){
									$sel=$dateny==$now?"selected":"";
								} else {
									$sel=$dateny==$this->input->post("periode")?"selected":"";
								}
								?>
								<option class="<?php echo $yes; ?>" value="<?php echo $dateny; ?>" <?php echo $sel; ?>><?php echo $dateny2; ?></option>
								<?php
								$current_date= date("Y-m-d",strtotime("+1 month",strtotime($current_date)));
							} 
							?>
						</select>
						<?php
						if($danadtl->num_rows()>0){
							?>
							<!--<input id="export" type="button" class=" ml-3 col-2 btn btn-primary" value="Export" />-->
							<?php
						}
						?>
					</form>
				</div>
				<div class="col-md-12 mt-5 table-responsive">
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Bisnis</th>
							<th scope="col">Saham</th>
							<th scope="col">Jumlah Investasi</th>
							<th scope="col">Dividen</th>
							<th scope="col">Waktu</th>
							<!--<th scope="col">Pendapatan</th>-->
							<th scope="col">Tanggal Beli</th>
							<th scope="col">Laporan</th>
							<!--<th scope="col">Status</th>-->
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
							$num++;
							$t1=$t1+$par->jumlah_dana;
							$kembali = $par->jumlah_dana+(($par->jumlah_dana*$par->finansial_dividen)/100);
							$t2=$t2+$kembali;
							
							//get lembar saham
							$whsaham['id_produk'] = $par->id_produk;
							$saham = $this->m_invest->dataTotalinvest($whsaham)->row();
							?>
							<tr>
							<td><?php echo $num; ?></td>
							<td><a href="<?php echo base_url()?>invest/detail/<?php echo $par->siteurl; ?>"><?php echo $par->judul; ?></a></td>
							<td><?php echo $saham->lembar; ?> Lembar</td>
							<td class="text-right">Rp. <?php echo number_format($saham->total,0,",","."); ?></td>
							<td><?php echo $par->finansial_dividen; ?>%</td>
							<td><?php echo $par->jangka; ?> Bulan</td>
							<!--<td class="text-right">Rp. <?php echo number_format($kembali,0,",","."); ?></td>-->
							<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>
							<td>
								
								<a href="<?php echo base_url()?>investor/laporanbisnis/<?php echo $par->id_produk?>" class="btn btn-success">Lihat</a> 
								<a href="<?php echo base_url()?>investor/laporanbisnis/<?php echo $par->id_produk?>" class="btn btn-warning">Gadai</a>
								<a href="<?php echo base_url()?>investor/jual/<?php echo $par->siteurl?>" class="btn btn-primary">Jual</a>
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
			</div>
		</div>
    </div>
</section>
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