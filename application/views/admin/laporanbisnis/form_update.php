<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Data Laporanbisnis</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Laporanbisnis/prosesUpdate">
      <input type="hidden" name="id" value="<?php echo $dataLaporanbisnis->id ?>">
      <div class="box-body">
        <!-- Nama Laporanbisnis -->

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Produk/Bisnis</label>

          <div class="col-sm-10">
            <select name="id_produk" class="form-control">
				<option>Pilih Bisnis/Produk</option>
				<?php $data = $this->db->query("select * from trx_produk where status_approve!='refuse' && status_approve!='complete' order by judul asc ");
				foreach($data->result() as $par){
				?>
				<option value="<?php echo $par->id_produk?>" <?php if($dataLaporanbisnis->id_produk==$par->id_produk) echo "selected"; ?>><?php echo $par->judul?></option>
				<?php } ?>
			</select>

          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Laba</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Laba" name="laba" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->laba ?>">
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Rugi</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Rugi" name="rugi" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->rugi ?>">
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Dividen</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Persentase dividen" name="dividen" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->dividen ?>">
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Dividen Saham Gadai</label>

          <div class="col-sm-10">
            <input type="number" class="form-control" placeholder="Persentase dividen saham yang digadaikan" name="dividen_gadai" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->dividen_gadai ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Dokumen Tambahan</label>
          <div class="col-sm-10">
            <?php if ($dataLaporanbisnis->dokumen != ""): ?>
              <a href="<?= base_url() ?>assets/attachment/laporan_bisnis/<?= $dataLaporanbisnis->dokumen ?>" target="_blank"><?= $dataLaporanbisnis->dokumen ?></a>
              <span style="color: red" title="Hapus">(<a href="<?= base_url() ?>Laporanbisnis/hapusattachment/<?= $dataLaporanbisnis->id ?>">X</a>)</span>
            <?php else: ?>
              <input type="file" class="form-control" name="additional_file">
            <?php endif; ?>
          </div>
        </div>

      </div>

      <div class="form-group">
        <div class="col-md-3">

        </div>

        <div class="col-md-3">
            <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
        </div>

        <div class="col-md-3">
          <a href="<?php echo base_url() ?>Laporanbisnis" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>

        <div class="col-md-3">

        </div>

      </div>
    </form>

  </div>
</div>
