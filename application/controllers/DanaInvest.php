<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DanaInvest extends CI_Controller {
		function __construct(){
			parent::__construct();
	        $this->load->helper('url');
	        $this->load->model('M_danainvest');
	        $this->load->model('M_admin');
	        $lib=array("session","form_validation");
	        $this->load->library($lib);
		}

		public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();

			$data['additional_info'] = array(
				'no_ktp' => 'Nomor KTP',
				'nama_pengguna' => 'Nama Pengguna',
				'jenis_kelamin' => 'Jenis Kelamin',
				'tempat_lahir' => 'Tempat Lahir',
				'ttl' => 'Tanggal Lahir',
				'agama' => 'Agama',
				'pendidikan' => 'Pendidikan Terakhir',
				'pekerjaan' => 'Pekerjaan',
				'alamat_ktp' => 'Alamat KTP',
				'kabkota_ktp' => 'Kabupaten/Kota KTP',
				'prov_ktp' => 'Provinsi KTP',
				'negara_ktp' => 'Negara KTP',
				'no_hp' => 'No. Hp',
				'alamat_domisili' => 'Alamat Domisili',
				'kabkota_domisili' => 'Kabupaten/Kota Domisili',
				'prov_domisili' => 'Provinsi Domisili',
				'negara_domisili' => 'Negara Domisili',
			);

			$data['content'] = 'admin/danainvest';
			$this->load->view('admin/indexadmin',$data);
			}else{
				$this->load->view('login');
			}
		}

		public function tampil()
		{			$where="";			if($this->input->get("idproduk")!=""){				$where=array("a.id_produk"=>$this->input->get("idproduk"));			}
			$data['dataDanaInvest'] = $this->M_danainvest->select_dana($where);
			$this->load->view('admin/danainvest/list_data', $data);
		}

		public function list_data()
		{
			$search_tipe = $this->input->post('tipe');
			$search_produk = $this->input->post('produk');
			$search_user = $this->input->post('user');
			$search_status_approve = $this->input->post('status_approve');

			echo $this->M_danainvest->get_list_data(array('a.type_dana' => $search_tipe, 'c.judul' => $search_produk, 'd.username' => $search_user, 'a.status_approve' => $search_status_approve));
		}

		public function update($id) {

			// $id 				= $id;
			$where = array('a.id_dana'=>$id);
			$data['dataDanaInvest'] 	= $this->M_danainvest->select_dana($where)->row();
			$data['content'] = 'admin/danainvest/form_update';
			$this->load->view('admin/indexadmin',$data);
		}

		public function prosesAdd(){
			$out = array();
			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$amount = $this->input->post('amount');
			$note = $this->input->post('note');
			$date=date('Y-m-d H:i:s');
			$msg ="Note : ".$note." ".$date;
			$dataPesan = array('pesan'=>$msg,
				'id_pengguna'=>$id,
				'createddate'=>$date
			);
			$danaUser = array('username'=>$username,
				'email'=>$email,
				'amount'=>$amount,
				'status'=>'Menambahkan'
			);
			$this->M_danainvest->insertDana($danaUser);
			$result = $this->M_danainvest->insertpesan($dataPesan);
			$this->M_danainvest->fundAdd($amount,$id);
			$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
		      <div class="info-box alert-success">
			      <div class="info-box-icon">
			      	<i class="fa fa-check-circle"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Jumlah berhasil ditambahkan</div>
			  </div>
		    </p>';
		    $this->session->set_flashdata('msg', $out['msg']);
			redirect('Dana/menambahkan');

		}

		public function prosesWithdraw(){
			$out = array();
			$id = $this->input->post('id');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$amount = $this->input->post('amount');
			$note = $this->input->post('note');
			$date=date('Y-m-d H:i:s');
			$msg ="Note : ".$note." ".$date;
			$dataPesan = array('pesan'=>$msg,
				'id_pengguna'=>$id,
				'createddate'=>$date
			);
			$danaUser = array('username'=>$username,
				'email'=>$email,
				'amount'=>$amount,
				'status'=>'Menarik'
			);
			$this->M_danainvest->insertDana($danaUser);
			$result = $this->M_danainvest->insertpesan($dataPesan);
			$this->M_danainvest->prosesWithdraw($amount,$id);
			$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
		      <div class="info-box alert-success">
			      <div class="info-box-icon">
			      	<i class="fa fa-check-circle"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Jumlah berhasil ditambahkan</div>
			  </div>
		    </p>';
		    $this->session->set_flashdata('msg', $out['msg']);
			redirect('Dana/menarik');

		}

		public function prosesUpdate(){
			$out = array();
			// $data = array();
			$iddana = $this->input->post('id_dana');
			$idpengguna = $this->input->post('id_pengguna');
			$pre_status = $this->input->post('pre_status');
			$price = $this->input->post('price');

			$dataDana 	= array('status_approve'=>$this->input->post('status_approve'));
			$pesan = $this->input->post('pesan');
			$where = array('a.id_dana'=>$iddana);
			$dataDanaInvest= $this->M_danainvest->select_dana($where)->row();
			$date=date('Y-m-d H:i:s');
			$msg="";
			if($this->input->post('status_approve')=="approve"){
				$msg ="Dana invest kamu sebesar Rp. ".number_format($dataDanaInvest->jumlah_dana,0,".",".")." berhasil di approve pada tanggal ".$date;
			} else if($this->input->post('status_approve')=="pending"){
				$msg ="Dana invest kamu sebesar Rp. ".number_format($dataDanaInvest->jumlah_dana,0,".",".")." di pending pada tanggal ".$date;
			} else if($this->input->post('status_approve')=="refuse"){
				$msg ="Dana invest kamu sebesar Rp. ".number_format($dataDanaInvest->jumlah_dana,0,".",".")." di tolak pada tanggal. dan dana kembali ke dompet ".$date;
			} else if($this->input->post('status_approve')=="cancel"){
				$msg ="Dana invest kamu sebesar Rp. ".number_format($dataDanaInvest->jumlah_dana,0,".",".")." di tolak pada tanggal. dan dana kembali ke dompet ".$date;
			}

			if ($pre_status == "cancel") {
				$amount = $this->M_danainvest->refundCheck($idpengguna);
				$afterWithdraw = $amount[0]['saldo'] - $price;
				if($afterWithdraw < 0) {
					$msg ="Dana investasi sebesar Rp. ".number_format($dataDanaInvest->jumlah_dana,0,".",".").", Anda tidak memiliki dana yang cukup untuk menyetujuinya ".$date;
					$dataPesan = array('pesan'=>$msg,
								'id_pengguna'=>$idpengguna,
								'createddate'=>$date
							);
					$result = $this->M_danainvest->insertpesan($dataPesan);


					$out['status'] = '';
					$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Tidak Punya Cukup Dana</div>
					  </div>
				    </p>';
				    $this->session->set_flashdata('msg', $out['msg']);
					redirect('DanaInvest');
				}
				$this->M_danainvest->refundGet($price,$idpengguna);
			}

			if ($this->input->post('status_approve') == "cancel") {
				$this->M_danainvest->refundBack($price,$idpengguna);
			}

			if ($this->input->post('status_approve') == "refuse") {
				$this->M_danainvest->refundSaldo($price, $iddana, $idpengguna);
			}

				$dataPesan = array('pesan'=>$msg,
								'id_pengguna'=>$idpengguna,
								'createddate'=>$date
							);
				$result = $this->M_danainvest->insertpesan($dataPesan);

			$result = $this->M_danainvest->update($dataDana,$iddana);


			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Penarikan Dana Invest Berhasil Dirubah</div>
					  </div>
				    </p>';
			} else{
				$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Penarikan Dana Invest Gagal Dirubah, dan dana kembali ke dompet</div>
					  </div>
				    </p>';
			}

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('DanaInvest');
		}

		public function generateReport()
		{
			$additional_info = $this->input->post('additional_info');
			$periode_from = $this->input->post('report_from');
			$periode_until = $this->input->post('report_until');
			$s_tipe = $this->input->post('s_tipe');
			$s_produk = $this->input->post('s_produk');
			$s_user = $this->input->post('s_user');
			$s_status = $this->input->post('s_status');

			include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
			$excel = new PHPExcel();
			$data_shown = array('id_dana', 'jumlah_dana', 'type_dana', 'lembar_saham', 'judul', 'username', 'status_approve', 'createddate');
			$arr = array(
				'id' => array('title' => 'ID', 'dataindex' => 'id_dana'),
				'jumlahdana' => array('title' => 'Jumlah Dana', 'dataindex' => 'jumlah_dana'),
				'tipe' => array('title' => 'Tipe', 'dataindex' => 'type_dana'),
				'lembarsaham' => array('title' => 'Lembar Saham', 'dataindex' => 'lembar_saham'),
				'produkinvest' => array('title' => 'Produk', 'dataindex' => 'judul'),
				'user' => array('title' => 'User', 'dataindex' => 'username'),
				'statusapprove' => array('title' => 'Status Approval', 'dataindex' => 'status_approve'),
				'tanggal' => array('title' => 'Date', 'dataindex' => 'createddate'),
			);

			$add = array(
				'no_ktp' => 'Nomor KTP',
				'nama_pengguna' => 'Nama Pengguna',
				'jenis_kelamin' => 'Jenis Kelamin',
				'tempat_lahir' => 'Tempat Lahir',
				'ttl' => 'Tanggal Lahir',
				'agama' => 'Agama',
				'pendidikan' => 'Pendidikan Terakhir',
				'pekerjaan' => 'Pekerjaan',
				'alamat_ktp' => 'Alamat KTP',
				'kabkota_ktp' => 'Kabupaten/Kota KTP',
				'prov_ktp' => 'Provinsi KTP',
				'negara_ktp' => 'Negara KTP',
				'no_hp' => 'No. Hp',
				'alamat_domisili' => 'Alamat Domisili',
				'kabkota_domisili' => 'Kabupaten/Kota Domisili',
				'prov_domisili' => 'Provinsi Domisili',
				'negara_domisili' => 'Negara Domisili',
			);

			$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Report Dana Investasi Per Tanggal '.date('d-m-Y'));
			$excel->setActiveSheetIndex(0)->setCellValue('A2', '');

			$headers = array();
			$selects = array();

			foreach ($arr as $p) {
				array_push($headers, $p['title']);
			}

			foreach ($additional_info as $k => $v) {
				array_push($headers, $add[$v]);
			}

			$excel->getActiveSheet()->fromArray($headers, NULL, 'A3');

			$where = array(
				"periode_from" => $periode_from,
				"periode_until" => $periode_until,
				"produk" => $s_produk,
				"user" => $s_user,
				"status" => $s_status
			);

			$data = $this->M_danainvest->select_dana2($where, $additional_info);

			$list_data = array();

			$index_data = array_merge($data_shown, $additional_info);

			foreach ($data->result_array() as $k => $v) {
				foreach ($index_data as $y) {
					$list_data[$k][$y] = $v[$y];
				}
			}

			$excel->getActiveSheet()->fromArray($list_data	, NULL, 'A4');

			// styling
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:Z3')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:Z3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('L')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('M')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('P')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('R')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('S')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('T')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('U')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('V')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('W')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('X')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(35);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		    header('Content-Disposition: attachment; filename="Report_Dana_Invest_'.date('Ymd').'.xlsx"'); // Set nama file excel nya
		    header('Cache-Control: max-age=0');
		    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		    $write->save('php://output');
		}
	}
 ?>
