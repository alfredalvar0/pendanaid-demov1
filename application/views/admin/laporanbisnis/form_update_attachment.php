<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Edit Attachment Laporanbisnis</h3>

    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url() ?>Laporanbisnis/prosesUpdate">
      <input type="hidden" name="id" value="<?php echo $dataLaporanbisnis->id ?>">
      <div class="box-body">
        <!-- Nama Laporanbisnis -->

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Produk/Bisnis</label>

          <div class="col-sm-10">
              <input type="hidden" name="id_produk" value="<?= $dataLaporanbisnis->id_produk ?>">
      				<?php $data = $this->db->query("select * from trx_produk where status_approve!='refuse' && status_approve!='complete' order by judul asc ");
      				foreach($data->result() as $par){
                if($dataLaporanbisnis->id_produk==$par->id_produk) {
                  echo $par->judul;
                }
              } ?>		

          </div>
        </div>


        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Laba</label>

          <div class="col-sm-10">
            <input type="hidden" class="form-control" placeholder="Laba" name="laba" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->laba ?>">
            <?php echo number_format($dataLaporanbisnis->laba) ?>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Rugi</label>

          <div class="col-sm-10">
            <input type="hidden" class="form-control" placeholder="Rugi" name="rugi" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->rugi ?>">
            <?php echo number_format($dataLaporanbisnis->rugi) ?>
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Dividen</label>

          <div class="col-sm-10">
            <input type="hidden" class="form-control" placeholder="Persentase dividen" name="dividen" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->dividen ?>">
            <?php echo number_format($dataLaporanbisnis->dividen) ?>%
          </div>
        </div>

		<div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Dividen Saham Gadai</label>

          <div class="col-sm-10">
            <input type="hidden" class="form-control" placeholder="Persentase dividen saham yang digadaikan" name="dividen_gadai" aria-describedby="sizing-addon2" value="<?php echo $dataLaporanbisnis->dividen_gadai ?>">
            <?php echo number_format($dataLaporanbisnis->dividen_gadai) ?>%
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Dokumen Tambahan</label>
          <div class="col-sm-10">
            <?php if ($dataLaporanbisnis->dokumen != ""): ?>
              <a href="<?= base_url() ?>assets/attachment/laporan_bisnis/<?= $dataLaporanbisnis->dokumen ?>" target="_blank"><?= $dataLaporanbisnis->dokumen ?></a>
              <span style="color: red" title="Hapus">(<a href="<?= base_url() ?>Laporanbisnis/hapusattachment/<?= $dataLaporanbisnis->id ?>/update_attachment">X</a>)</span>
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
