<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Referral Management
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Referral Management</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <div class="msg" style="display:none;">
              <?php echo @$this->session->flashdata('msg'); ?>
            </div>
          </div>
          <div class="box-body table-responsive">
            <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Investor</th>
                  <th>Tgl. Join</th>
                  <th>Tgl. Invest</th>
                  <th>Jml. Invest</th>
                  <th>Trx. Invest</th>
                  <th>% Komisi</th>
                  <th>Jml. Komisi</th>
                  <th>Referral</th>
                  <th>Ref. Kode</th>
                  <th>Proses</th>
                </tr>
              </thead>
              <tbody id="data-referral"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
  
<?php $this->load->view($content.'/ajax'); ?>

