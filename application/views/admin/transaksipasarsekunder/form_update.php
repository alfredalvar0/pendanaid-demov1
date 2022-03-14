<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Ubah Data Transaksi Pasar Sekunder</h3>
    <form method="POST" enctype="multipart/form-data" class="form-horizontal" action="<?= base_url() ?>TransaksiPasarSekunder/prosesUpdate/<?= $dataProduk->id ?>">
      <input type="hidden" name="id" value="<?= $dataProduk->id ?>"> 
      <div class="box-body">				
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Tanggal Transaksi</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $dataProduk->created_at ?>" disabled="disabled">
          </div>
        </div> 

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nama Produk</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $dataProduk->judul ?>" disabled="disabled">
          </div>
        </div> 

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Nama Bisnis</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $dataProduk->nama_binsis ?>" disabled="disabled">
          </div>
        </div> 

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Jenis Transaksi</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="jenis_transaksi" value="<?= strtoupper($dataProduk->jenis_transaksi) ?>" readonly>
          </div>
        </div> 

		    <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Lembar Saham Yang Di<?= $dataProduk->jenis_transaksi ?></label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= $dataProduk->lembar_saham ?>" disabled="disabled">
          </div>
        </div>
  
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Biaya Transaksi</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= $dataProduk->admin_fee ?>" disabled="disabled">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Biaya Bank Kustodian</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= $dataProduk->custodian_fee ?>" disabled="disabled">
          </div>
        </div>
  
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Harga per Lembar</label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= $dataProduk->harga_per_lembar ?>" disabled="disabled">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Total <?= ucfirst($dataProduk->jenis_transaksi) ?></label> 
          <div class="col-sm-6">
            <input type="number" class="form-control" value="<?= $dataProduk->total ?>" disabled="disabled">
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail3" class="col-sm-3 control-label">Status Transaksi</label> 
          <div class="col-sm-6">
            <select class="form-control" name="status">
              <option <?= ($dataProduk->status = 'success') ? 'selected' : '' ?> disabled>Success</option>
              <option <?= ($dataProduk->status = 'pending') ? 'selected' : '' ?> disabled>Pending</option>
              <option value="cancel">Cancel</option>
            </select>
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
          <a href="<?= base_url('TransaksiPasarSekunder') ?>" class="form-control btn btn-danger">
            <i class="glyphicon glyphicon-remove"></i> Kembali
          </a>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </form>
    
  </div>
</div>