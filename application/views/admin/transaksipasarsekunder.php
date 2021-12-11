<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Monitoring Transaksi Pasar Sekunder
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Pasar Sekunder</a></li>
      <li class="active">Monitoring Transaksi</li>
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
        					<th>Tanggal</th>
                  <th>Status</th>
                  <th>Nama Produk</th>
                  <th>Nama Bisnis</th>
                  <th>Transaksi</th>
                  <th>Jumlah</th>
        					<th>Harga</th>
                  <th>Total</th>					
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="data-produk"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
  <?php $this->load->view($content.'/ajax'); ?>

