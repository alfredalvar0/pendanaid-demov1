<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Komisi Referral
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard"></i> Home</li>
      <li>Referral</li>
      <li class="active">Komisi Referral</li>
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
                  <th>Produk</th>
                  <th>% Komisi</th>
                  <th>Kelola</th>
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

