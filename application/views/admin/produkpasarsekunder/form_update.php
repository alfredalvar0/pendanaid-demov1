<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Ubah Data Produk Pasar Sekunder</h3>
    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?php echo base_url(); ?>ProdukPasarSekunder/prosesUpdate/<?php echo $dataProduk->id_bisnis ?>">
      <input type="hidden" name="id_produk" value="<?php echo $dataProduk->id_produk ?>"> 
      <div class="box-body">				
		    <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Status Produk/Bisnis</label>
          <div class="col-sm-6">
            <select name="status_approve" class="form-control " aria-describedby="sizing-addon2" required disabled="disabled">
              <option disabled selected="">Tipe</option>
              <option value="refuse" <?php echo $dataProduk->status_approve == "refuse"?'selected':'' ?> >Refuse</option>
              <option value="approve" <?php echo $dataProduk->status_approve == "approve"?'selected':'' ?>>Approve</option>
      			  <option value="invest" <?php echo $dataProduk->status_approve == "invest"?'selected':'' ?>>Invest</option>
      			  <option value="running" <?php echo $dataProduk->status_approve == "running"?'selected':'' ?>>Running</option>
              <option value="pending" <?php echo $dataProduk->status_approve == "pending"?'selected':'' ?>>Pending</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nama Produk</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataProduk->judul ?>" name="judul" aria-describedby="sizing-addon2" required disabled="disabled">
          </div>
        </div> 

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nama Bisnis</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" placeholder="" value="<?php echo $dataProduk->nama_binsis ?>" name="judul" aria-describedby="sizing-addon2" required disabled="disabled">
          </div>
        </div> 

		    <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Harga Perlembar</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?php echo $dataProduk->harga_perlembar ?>"  name="harga_perlembar" aria-describedby="sizing-addon2" required disabled="disabled">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Min. Harga Jual/Beli</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= isset($dataProduk->min_harga_perlembar) ? $dataProduk->min_harga_perlembar : $dataProduk->harga_perlembar?>"  name="min_harga_perlembar" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Maks. Harga Jual/Beli</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= isset($dataProduk->maks_harga_perlembar) ? $dataProduk->maks_harga_perlembar : $dataProduk->harga_perlembar?>"  name="maks_harga_perlembar" aria-describedby="sizing-addon2" required>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Kelipatan</label> 
          <div class="col-sm-3">
            <input type="number" class="form-control" value="<?= isset($dataProduk->nilai_kelipatan) ? $dataProduk->nilai_kelipatan : 0 ?>"  name="nilai_kelipatan" aria-describedby="sizing-addon2" required>
          </div>
          <div class="col-sm-3">
            <?php
              echo form_dropdown('jenis_kelipatan', [
                'persen' => 'Persen (%) per transaksi',
                'nominal' => 'Nominal (Rp) per transaksi'
              ], (isset($dataProduk->jenis_kelipatan) ? $dataProduk->jenis_kelipatan : 'persen'),
              'class="form-control"');
            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Biaya Admin</label> 
          <div class="col-sm-3">
            <input type="number" class="form-control" value="<?= isset($dataProduk->nilai_biaya_admin) ? $dataProduk->nilai_biaya_admin : 0 ?>"  name="nilai_biaya_admin" aria-describedby="sizing-addon2" required>
          </div>
          <div class="col-sm-3">
            <?php
              echo form_dropdown('jenis_biaya_admin', [
                'persen' => 'Persen (%) per transaksi',
                'nominal' => 'Nominal (Rp) per transaksi'
              ], (isset($dataProduk->jenis_biaya_admin) ? $dataProduk->jenis_biaya_admin : 'persen'),
              'class="form-control"');
            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Biaya Kustodian</label> 
          <div class="col-sm-3">
            <input type="number" class="form-control" value="<?= isset($dataProduk->nilai_biaya_kustodian) ? $dataProduk->nilai_biaya_kustodian : 0 ?>"  name="nilai_biaya_kustodian" aria-describedby="sizing-addon2" required>
          </div>
          <div class="col-sm-3">
            <?php
              echo form_dropdown('jenis_biaya_kustodian', [
                'persen' => 'Persen (%) per transaksi',
                'nominal' => 'Nominal (Rp) per transaksi'
              ], (isset($dataProduk->jenis_biaya_kustodian) ? $dataProduk->jenis_biaya_kustodian : 'persen'),
              'class="form-control"');
            ?>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Tampilkan di Pasar Sekunder ?</label> 
          <div class="col-sm-6">
            <?php
              echo form_dropdown('publish', [
                '1' => 'Ya, tampilkan produk di modul Pasar Sekunder.',
                '0' => 'Tidak, jangan tampilkan produk di modul Pasar Sekunder.'
              ], (isset($dataProduk->publish) ? $dataProduk->publish : '0'),
              'class="form-control"');
            ?>
          </div>
        </div>

      </div>

      <div class="form-group">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
          <button type="submit" class="form-control btn btn-primary">
            <i class="glyphicon glyphicon-ok"></i> Update Data
          </button>
        </div>
        <div class="col-sm-3">
          <a href="<?= base_url('ProdukPasarSekunder') ?>" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </form>
    
  </div>
</div>