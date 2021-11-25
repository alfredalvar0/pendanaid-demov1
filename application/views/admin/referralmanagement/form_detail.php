<div class="content-wrapper">
  <div class=" col-md-12 well">
    <div class="form-msg"></div>
    <h3 style="display:block; text-align:center;">Detail Komisi Referral</h3>
    <form class="form-horizontal">
      <div class="box-body">				

        <div class="form-group">
          <label class="col-sm-3 control-label">Investor</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $referral->nama_investor ?>" name="investor" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Tanggal Join</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= date('d/m/Y H:i:s', strtotime($referral->tanggal_join)) ?>" name="produk" readonly="tanggal-join">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Tanggal Invest</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= date('d/m/Y H:i:s', strtotime($referral->tanggal_invest)) ?>" name="tanggal-invest" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Jumlah Invest</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= number_format($referral->jumlah_invest, 0, ',', '.') ?>" name="jumlah-invest" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">No. Transaksi Invest</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $referral->no_trx_invest ?>" name="no-trx-invest" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">% Komisi</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $referral->persen_komisi ?>" name="persen-komisi" readonly="readonly">
          </div>
        </div>

        <?php $komisi = $referral->jumlah_invest * ($referral->persen_komisi / 100); ?>
        <div class="form-group">
          <label class="col-sm-3 control-label">Jumlah Komisi</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= number_format($komisi, 0, ',', '.') ?>" name="komisi" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Referral</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $referral->nama_referral ?>" name="nama-referral" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Kode Referral</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" value="<?= $referral->kode_referral ?>" name="kode-referral" readonly="readonly">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Status</label>
          <div class="col-sm-6">
            <?= form_dropdown('status', ['' => 'Pending', '1' => 'Approve', '0' => 'Refuse'], $referral->status, 'class="form-control" readonly="readonly"') ?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">Keterangan</label>
          <div class="col-sm-6">
            <textarea readonly="readonly" class="form-control" name="keterangan"><?= $referral->keterangan ?></textarea>
          </div>
        </div>

      </div>


      <div class="col-md-3"></div>

      <div class="col-md-3">
        <button type="button" class="form-control btn btn-primary" disabled="disabled">
          <i class="glyphicon glyphicon-ok"></i> Submit Data
        </button>
      </div>

      <div class="col-md-3">
        <a href="<?php echo base_url() ?>Referralmanagement" class="form-control btn btn-danger">
          <i class="glyphicon glyphicon-remove"></i> Kembali
        </a>
      </div>
    </form>
  </div>
</div>