<?php
$file="";
$data="";
$act="add";
if($id!=""){
	$data = $data_produk->row();
	$file='data-default-file="'.base_url().'assets/img/produk/'.$data->foto.'"';
	$act="edit";
}
?>
<section id="team" >
    <div class="container"  >
        <div class="section">
			<form method="post" action="<?php echo base_url() ?>invest/prosesBuatPinjaman" enctype="multipart/form-data">
				<input type="hidden" name="act" value="<?php echo $act; ?>" />
				<?php if($id!=""){ ?>
				<input type="hidden" name="id" value="<?php echo $data->id_produk; ?>" />
				<?php } ?>
				<div class="row mt-5">
					
						<div class="col-1"></div>
						<div class="col-4">
							<div class="row">
								<div class="col-12 mb-5">
									<h5>Foto Kampanye</h5>
									<input type="file" class="dropify" name="foto" id="imgproduk" accept="image/*" <?php echo $file; ?>>
								</div>
							</div>
							
						</div>
						<div class="col-6">
							<div class="row">
								<div class="col-12">
									<div class="group">      
										<input type="text" name="judul" value="<?php echo $data!=""?$data->judul:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Judul</label>
									</div>
								</div>
								<div class="col-12">
									<div class="group">      
										<input type="text" name="siteurl" value="<?php echo $data!=""?$data->siteurl:""; ?>" onkeypress="return hanyaHuruf(event)" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Url</label>
									</div>
								</div>
								<div class="col-6">
									<div class="group">      
										<input type="date" name="tglawal" value="<?php echo $data!=""?$data->tglawal:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl lblr">Tanggal Awal</label>
									</div>
								</div>
								<div class="col-6">
									<div class="group">      
										<input type="date" name="tglakhir" value="<?php echo $data!=""?$data->tglakhir:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl lblr">Tanggal Akhir</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-1"></div>
						<div class="col-10">
							<div class="row">
								
								<div class="col-4">
									<div class="group">  
										<label class="grp">Rp.</label>
										<input class="inp2" type="number" name="jumlah_investasi" value="<?php echo $data!=""?$data->jumlah_investasi:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl lbl2">Jumlah dibutuhkan</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">
										<input type="text" name="pengembalian_pokok" value="<?php echo $data!=""?$data->pengembalian_pokok:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Pengembalian pokok investasi</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">
										<input type="number" name="slot" value="<?php echo $data!=""?$data->slot:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Slot</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">      
										<input class="inp2" type="number" name="tenor" value="<?php echo $data!=""?$data->tenor:""; ?>" required >
										<label class="grp">bulan</label>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl mb-0">Tenor</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">      
										<input class="inp2" type="number" min="0" max="100" name="bagi_hasil" value="<?php echo $data!=""?$data->bagi_hasil:""; ?>" required >
										<label class="grp">%</label>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl mb-0">Bagi hasil/bulan</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">
										<select name="agunan">
											<option value="Ada" <?php echo $data!="" && $data->agunan=="Ada"?"selected":""; ?>>Ada</option>
											<option value="Tidak" <?php echo $data!="" && $data->agunan=="Tidak"?"selected":""; ?>>Tidak Ada</option>
										</select>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Agunan</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">  
										<label class="grp">Rp.</label>
										<input class="inp2" type="number" name="minimal_pendanaan" value="<?php echo $data!=""?$data->minimal_pendanaan:""; ?>" required >
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl lbl2">Minimal Pendanaan</label>
									</div>
								</div>
								<div class="col-4">
									<div class="group">
										<select name="frekuensi_angsuran" required>
											<option value="bulanan" <?php echo $data!="" && $data->frekuensi_angsuran=="bulanan"?"selected":""; ?>>Bulanan</option>
											<option value="tahunan" <?php echo $data!="" && $data->frekuensi_angsuran=="tahunan"?"selected":""; ?>>Tahunan</option>
										</select>
										<span class="highlight"></span>
										<span class="bar"></span>
										<label class="lbl">Frek. Angsuran bagi hasil</label>
									</div>
								</div>
								<div class="col-4 mt-4">
									<input type="submit" class="btn btn-primary" value="Simpan" />
								</div>
							</div>
						</div>
					
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
    var step=0;
    $(document).ready(function(){
		$('#imgproduk').dropify();
	});
</script>