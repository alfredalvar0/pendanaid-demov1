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
        Konfirmasi Pembayaran
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
											    <label for="staticEmail" class="col-sm-3 col-form-label">Rek. Pembayaran</label>
											    <div class="col-sm-9">
											      <select class="form-control" id="search_payment_account_id" name="search_payment_account_id">
											      	<option value="">-- All --</option>
                                                    <?php foreach ($rekening_pembayaran->result() as $row): ?>
                                                        <option value="<?php echo $row->id ?>"><?php echo $row->account_no." ".$row->nama_bank." a/n ".$row->account_owner ?></option>
                                                    <?php endforeach; ?>
											      </select>
											    </div>
											  </div>
                                              <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-3 col-form-label">Bank Pengirim</label>
                                                  <div class="col-sm-9">
                                                    <select class="form-control" id="search_bank_id_from" name="search_bank_id_from">
                                                      <option value="">-- All --</option>
                                                      <?php foreach ($bank->result() as $row): ?>
                                                          <option value="<?php echo $row->id_bank ?>"><?php echo $row->nama_bank ?></option>
                                                      <?php endforeach; ?>
                                                    </select>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label for="staticEmail" class="col-sm-3 col-form-label">No. Rek. Pengirim</label>
                                                  <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="search_account_no" name="search_account_no" placeholder="All User">
                                                  </div>
                                            </div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
											    <label for="staticEmail" class="col-sm-3 col-form-label">Nama Pengirim</label>
											    <div class="col-sm-9">
											      <input type="text" class="form-control" id="search_account_owner" name="search_account_owner" placeholder="All">
											    </div>
											  </div>
											  <div class="form-group row">
											    <label for="inputPassword" class="col-sm-3 col-form-label">Status Approve</label>
											    <div class="col-sm-9">
											      <select class="form-control" id="search_approval_status" name="search_approval_status">
											      	<option value="">-- All Status Approve --</option>
											      	<option value="pending" selected>Pending</option>
											      	<option value="approve">Approve</option>
											      	<option value="reject">Reject</option>
											      </select>
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
							<!-- <div class="panel-heading">
								<button type="button" class="btn btn-primary" onclick="showModal()">
		              Export Data
		            </button>
							</div> -->
							<div class="panel-body">
							  <table id="list-data-dana" class="table table-hover dataTable table-custom table-striped table-bordered nowrap dataTable dtr-inline">
								<thead>
								  <tr>
									<th>Rekening Pembayaran</th>
									<th>Pengirim</th>
									<th>No. Rek. Pengirim</th>
									<th>Bank Pengirim</th>
									<th>Amount</th>
									<th>Bukti Pembayaran</th>
									<th>Status Approve</th>
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




  <script type="text/javascript">

  	function showModal() {
  		var s_tipe = $('#search_tipe').val();
  		var s_user = $('#search_user').val();
  		var s_produk = $('#search_produk').val();
  		var s_status = $('#search_status_approve').val();


  		$('#s_tipe').val(s_tipe);
  		$('#s_user').val(s_user);
  		$('#s_produk').val(s_produk);
  		$('#s_status').val(s_status);

  		$('#modalOptionDownload').modal('show');
  	}

  	function closeModal() {
  		$('#s_tipe').val('');
  		$('#s_user').val('');
  		$('#s_produk').val('');
  		$('#s_status').val('');
  		$('#report_form').val('');
  		$('#report_until').val('');

  		$('#modalOptionDownload').modal('hide');
  	}

  	function export2csv() {
  let data = "";
  const tableData = [];
  const rows = document.querySelectorAll("#csv_table tr");
  for (const row of rows) {
    const rowData = [];
    for (const [index, column] of row.querySelectorAll("th, td").entries()) {
      // To retain the commas in the "Description" column, we can enclose those fields in quotation marks.
      if ((index + 1) % 3 === 0) {
        rowData.push('"' + column.innerText + '"');
      } else {
        rowData.push(column.innerText);
      }
    }
    tableData.push(rowData.join(","));
  }
  data += tableData.join("\n");
  const a = document.createElement("a");
  a.href = URL.createObjectURL(new Blob([data], { type: "text/csv" }));
  a.setAttribute("download", "Transaksi.csv");
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
}
  </script>
  <script src="<?php echo base_url(); ?>assets/admin/dist/js/pages/dashboard.js"></script>

  <script>
  	$(document).ready(function () {

  		var dataTable = $('#list-data-dana').DataTable( {
				"serverSide": true,
				"processing": true,
				"ajax": {
					url: "<?= base_url() ?>PaymentConfirmation/list_data",
					type: 'post',
					data: function (data) {
						var payment_account_id= $('#search_payment_account_id').val();
						var bank_id_from= $('#search_bank_id_from').val();
						var account_no= $('#search_account_no').val();
						var account_owner= $('#search_account_owner').val();
						var approval_status= $('#search_approval_status').val();

						data.payment_account_id = payment_account_id;
						data.bank_id_from = bank_id_from;
						data.account_no = account_no;
						data.account_owner = account_owner;
						data.approval_status = approval_status;
					}
				},
				"order": [[ 0, "desc" ]],
				"searching": false,
				"lengthChange": false,
				"columns": [
	          { "data": 'rekening_pembayaran'},
	          { "data": "account_name" }, // Tampilkan judul
	          { "data": "account_no" },  // Tampilkan kategori
	          { "data": "nama_bank" },  // Tampilkan penulis
	          { "data": "amount" },  // Tampilkan tgl posting
	          { "data": "transfer_proof"},
	          { "data": "approval_status"},
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
