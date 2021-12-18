

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Produk
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              
              <div class="col-md-2">
                <a href="<?php echo base_url() ?>Produk/tambah?id=<?php echo $_GET['id']?>">
                  <button class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
                </a>
              </div>
              <div class="msg" style="display:none;">
                <?php echo @$this->session->flashdata('msg'); ?>
              </div>
            </div>
            <!-- /.box-header -->
             <div class="box-body table-responsive">
              <table id="list-data" class="table table-hover js-basic-example dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
                <thead>
                  <tr>
                    <th>No</th>
					<th>Status</th>
                    <th>Judul</th>
                    <th>Nama Bisnis</th>
                    <th>Target Investasi</th>
					<th>Lembar Saham</th>
					<th>Harga /Lembar</th>
          <th>Minimal Beli</th>
					<th>Saham Dibagikan</th>
					<th>Pembagian Dividen</th> 
					<th>Waktu Pembagian Dividen</th>
					<th>Keuntungan /tahun</th>
					<th>Waktu balik modal</th>
					<th>Tentang Bisnis</th>
					<th>Lokasi</th>
					<th>Pemilik</th>
					<th>Tanggal Awal Kampanye</th>
					<th>Tanggal Berakhir Kampanye</th>
					<th>Proposal</th>
					<th>Foto</th> 					
					<th>Created date</th> 
					
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="data-produk">

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php $this->load->view($content.'/ajax'); ?>

