<?php
$date=$this->input->post("periode")."-01";
$dateny2=strftime('%B %Y', strtotime($date));
$whd=array(
	"i.id_pengguna"=>$this->session->userdata("invest_pengguna"),
	"MONTH(p.tglakhir)"=>date("m"),
	"YEAR(p.tglakhir)"=>date("Y")
); 
if($this->input->post("periode")!=""){
	$exp=explode("-",$this->input->post("periode"));
	$whd["YEAR(p.tglakhir)"]=$exp[0];
	$whd["MONTH(p.tglakhir)"]=$exp[1];
}
$danadtl=$this->m_invest->dataDanaInvest($whd);
?>
<style>
	.table {
		display: table;
		border-collapse: collapse;
	}

	.table tr {
		display: table-row;
	}

	.table tr td {
		display: table-cell;
		vertical-align: top;
		border: 1px solid black;
	}
	.table-bordered tr td, .table-bordered tr th {
		border: 1px solid #dee2e6;
		padding: .75rem;
		white-space: nowrap;
	}
	.text-right {
		text-align: right!important;
	}
</style>
<h1>Report Proyeksi <?php echo $dateny2; ?></h1>
<table class="mt-3 table table-bordered " style="border: 1px solid #dee2e6;width: 100%;margin-bottom: 1rem;">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama Kampanye</th>
			<th scope="col">Jumlah Investasi</th>
			<th scope="col">Bagi Hasil</th>
			<th scope="col">Jumlah Pengembalian</th>
			<th scope="col">Tanggal Berakhir</th>
			<th scope="col">Status</th>
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
			$kembali = $par->jumlah_dana+(($par->jumlah_dana*$par->bagi_hasil)/100);
			$t2=$t2+$kembali;
			?>
			<tr>
			<td><?php echo $num; ?></td>
			<td><?php echo $par->judul; ?></td>
			
			<td class="text-right">Rp. <?php echo number_format($par->jumlah_dana,0,",","."); ?></td>
			<td><?php echo $par->bagi_hasil; ?>%</td>
			<td class="text-right">Rp. <?php echo number_format($kembali,0,",","."); ?></td>
			<td><?php echo date('d F Y', strtotime($par->tglakhir)); ?></td>
			<td><?php echo $par->status_approve; ?></td>
		</tr>
			<?php
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">Total</td>
			<td class="text-right">Rp. <?php echo number_format($t1,0,",","."); ?></td>
			<td>&nbsp;</td>
			<td class="text-right">Rp. <?php echo number_format($t2,0,",","."); ?></td>
			<td colspan="2">&nbsp;</td>
		</tr>
	</tfoot>
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