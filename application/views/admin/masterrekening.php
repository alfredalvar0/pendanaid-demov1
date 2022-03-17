<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <h1>
        Master Rekening
      </h1>


	  <br/>
	  <br/>
      <div class="row">


			<div class="col-md-12">
				<!-- /.box -->

				  <div class="box">

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
                                                  <label for="staticEmail" class="col-sm-3 col-form-label">Bank</label>
                                                  <div class="col-sm-9">
                                                    <select class="form-control" id="search_bank_id" name="search_bank_id">
                                                      <option value="">-- All --</option>
                                                      <?php foreach ($bank->result() as $row): ?>
                                                          <option value="<?php echo $row->id_bank ?>"><?php echo $row->nama_bank ?></option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                  </div>
                                              </div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-3 col-form-label">No. Rekening</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="search_account_no" name="search_account_no" placeholder="All">
                                                  </div>
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
						<div class="panel panel-default">
							<div class="panel-heading">
								<a type="button" class="btn btn-primary" href="<?php echo base_url() ?>MasterRekening/add">
					             	Tambah Rekening
					            </a>
							</div>
							<div class="panel-body">
								<?php if ($this->session->flashdata('msg') != ''): ?>
					                <script type="text/javascript">
					                  $(document).ready(function () {
					                    <?php if ($this->session->flashdata('status') == 'success'): ?>
					                      toastr.success('<?php echo $this->session->flashdata('msg'); ?>');                      
					                    <?php else: ?>
					                      toastr.error('<?php echo $this->session->flashdata('msg'); ?>');
					                    <?php endif ?>
					                  })
					                </script>

					              <?php endif ?>
							  <table id="list-data-dana" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
								<thead>
								  <tr>
									<th>Bank</th>
									<th>No. Rekening</th>
									<th>Atas Nama</th>
									<th>Action</th>
								  </tr>
								</thead>
								<tbody >

								</tbody>
							  </table>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
			<div>
	  <div>

    </section>
    <!-- /.content -->
  </div>

  <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>

  <script>
  	$(document).ready(function () {

  		var dataTable = $('#list-data-dana').DataTable( {
				"serverSide": true,
				"processing": true,
				"ajax": {
					url: "<?= base_url() ?>MasterRekening/list_data",
					type: 'post',
					data: function (data) {
						var bank_id= $('#search_bank_id').val();
						var account_no= $('#search_account_no').val();

						data.bank_id = bank_id;
						data.account_no = account_no;
					}
				},
				"order": [[ 0, "desc" ]],
				"searching": false,
				"lengthChange": false,
				"columns": [
	          { "data": 'nama_bank'},
	          { "data": "account_no" },  // Tampilkan kategori
	          { "data": "account_owner" },
	          { "data": "action"}
	      ],
			} );

  		// renderData();

  		$('#btn_search').click(function () {

  			console.log($('#search_tipe').val());

  			dataTable.draw();
  		})
  	})

		function approve(id) {
            var tanya = confirm('Approve data ini ?');
            if (tanya) {
                $.ajax({
                    url: '<?php echo base_url() ?>PaymentConfirmation/confirm/'+id,
                    type: 'POST',
                    data: {
                        approval_status: 'approve'
                    },
                    success: function (data) {
                        if (data == "ok") {
                            alert('Data Pembayaran Berhasil Diapprove');
                        } else {
                            alert('Data Pembayaran Gagal Diapprove');
                        }

                        $('#list-data-dana').DataTable().ajax.reload();
                    }
                })
            }
		}

        function reject(id) {
            var tanya = confirm('Reject data ini ?');
            if (tanya) {
                $.ajax({
                    url: '<?php echo base_url() ?>PaymentConfirmation/confirm/'+id,
                    type: 'POST',
                    data: {
                        approval_status: 'reject'
                    },
                    success: function (data) {
                        if (data == "ok") {
                            alert('Data Pembayaran Berhasil Direject');
                        } else {
                            alert('Data Pembayaran Gagal Direject');
                        }

                        $('#list-data-dana').DataTable().ajax.reload();
                    }
                })
            }
		}
  </script>
