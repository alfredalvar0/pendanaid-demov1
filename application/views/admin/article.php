

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Article
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
                <a href="<?php echo base_url() ?>article/tambah">
                  <button class="form-control btn btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
                </a>
              </div>
              <div class="msg" style="display:none;">
                <?php echo @$this->session->flashdata('msg'); ?>
              </div>
            </div>
            <div class="box-header">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <label>Search</label>
                    </div>
                    <div class="panel-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-9">
                              <select class="form-control" id="search_id_category" name="search_id_category">
                                <option value="">-- All Category --</option>
                                <option value="tambah">Tambah</option>
                                <option value="tarik">Tarik</option>
                                <option value="beli">Beli</option>
                                <option value="gadai">Gadai</option>
                                <option value="jual">Jual</option>
                                <option value="tebus">Tebus</option>
                                <option value="dividen">Dividen</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label for="staticEmail" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="search_title" name="search_title" placeholder="All Title">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="panel-footer" style="text-align: right;">
                      <button class="btn btn-primary" id="btn_search">Search</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="list-data-article" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline" style="width: 100%">
                <thead>
                  <tr>
                    <th width="5%">No.</th>
                    <th width="20%">Category</th>
					          <th>Title</th>
                    <th width="150">Action</th>
                  </tr>
                </thead>
                <tbody id="data-bank">

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
  <script>
    $(document).ready(function () {

      var dataTable = $('#list-data-article').DataTable( {
        "serverSide": true,
        "processing": true,
        "ajax": {
          url: "<?= base_url() ?>Article/list_data_article",
          type: 'post',
          data: function (data) {
            var id_category= $('#search_id_category').val();
            var title= $('#search_title').val();

            data.id_category = id_category;
            data.title = title;
          }
        },
        "searching": false,
        "lengthChange": false,
        "columns": [
            { "data": 'category' },
            { "data": "title" },
            { "data": "title" },
            { "data": "action" }
        ],
      } );

      // renderData();

      
    })    

    function renderData() {
      
    }
  </script>
