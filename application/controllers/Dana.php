<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dana extends CI_Controller {
		function __construct(){
			parent::__construct();
	        $this->load->helper('url');
	        $this->load->model('M_dana');
	        $this->load->model('M_admin');
			$this->load->model('M_invest');
			$this->load->model('M_akun');
	        $lib=array("session","form_validation");
	        $this->load->library($lib);
		}

		public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/dana';
			$this->load->view('admin/indexadmin',$data);
			}else{
				$this->load->view('login');
			}
		}

		public function menambahkan()
		{
			if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '')
			{
				$tipe = array('tipe'=>$this->session->userdata('tipe'));
				$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
				$data['dataUser'] = $this->M_akun->getUserDetails();
				$data['dataTable'] = $this->M_akun->getMDanaDetails();
				$data['content'] = 'admin/danaMenambahkan';
				$this->load->view('admin/indexadmin',$data);
			}else{
				$this->load->view('login');
			}
		}

		public function menarik()
		{
			if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '')
			{
				$tipe = array('tipe'=>$this->session->userdata('tipe'));
				$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
				$data['dataUser'] = $this->M_akun->getUserDetails();
				$data['dataTable'] = $this->M_akun->getNDanaDetails();
				$data['content'] = 'admin/danaMenarik';
				$this->load->view('admin/indexadmin',$data);
			}else{
				$this->load->view('login');
			}
		}

		public function tampil()
		{
			$data['dataDana'] = $this->M_dana->select_dana();
			$this->load->view('admin/dana/list_data', $data);
		}

		public function update($id) {

			// $id 				= $id;
			$where = array('a.id_dana'=>$id);
			$data['dataDana'] 	= $this->M_dana->select_dana($where)->row();
			$data['content'] = 'admin/dana/form_update';
			$this->load->view('admin/indexadmin',$data);

		}

		public function add() {
			$id = $this->input->post('id');
			$user = $this->M_dana->select_user($id);
			$ids = $this->M_dana->select_add($id);
			if(!isset($ids[0]['id_pengguna'])){
				return redirect('Dana/menambahkan');
			}
			$id = $ids[0]['id_pengguna'];
			$data['id'] = $id;
			$data['user'] = $user;
			$data['content'] = 'admin/danainvest/add';
			$this->load->view('admin/indexadmin',$data);
		}

		public function withdraw() {
			$id = $this->input->post('id');
			$user = $this->M_dana->select_user($id);
			$ids = $this->M_dana->select_add($id);
			if(!isset($ids[0]['id_pengguna'])){
				return redirect('Dana/menarik');
			}
			$id = $ids[0]['id_pengguna'];
			$data['id'] = $id;
			$data['user'] = $user;
			$data['content'] = 'admin/danainvest/withdraw';
			$this->load->view('admin/indexadmin',$data);
		}

		public function prosesUpdate(){
			$out = array();
			// $data = array();
			$iddana = $this->input->post('id_dana');
			$idpengguna = $this->input->post('id_pengguna');
			$nominal = $this->input->post('nominal');
			$notes = $this->input->post('notes');

			$dataDana 	= array('status_approve'=>$this->input->post('status_approve'), 'notes' => $notes);

			// $pesan = $this->input->post('pesan');
			/*if ($pesan == "") {

			}else{ */
			$where = array('a.id_dana'=>$iddana);
			$dataDanany 	= $this->M_dana->select_dana($where)->row();
			$date=date('Y-m-d H:i:s');
			$msg="";
			if($this->input->post('status_approve')=="approve"){
				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." berhasil di approve pada tanggal ".$date;
				if ($notes != "") {
					$msg .= "<br>";
					$msg .= "Catatan : ".$notes;
				}
			} else if($this->input->post('status_approve')=="pending"){
				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." di pending pada tanggal ".$date;
				if ($notes != "") {
					$msg .= "<br>";
					$msg .= "Catatan : ".$notes;
				}
			} else if($this->input->post('status_approve')=="refuse"){
				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." di tolak pada tanggal ".$date;
				if ($notes != "") {
					$msg .= "<br>";
					$msg .= "Catatan : ".$notes;
				}
			}
				$dataPesan = array('pesan'=>$msg,
								'id_pengguna'=>$idpengguna,
								'createddate'=>$date
							);
				$result = $this->M_dana->insertpesan($dataPesan);
			//}

			$result = $this->M_dana->update($dataDana,$iddana);







			if ($result > 0 ) {

				if ($this->input->post('status_approve') == "refuse") {
					$whd=array("id_pengguna"=>$idpengguna); // ,"a.id_bank"=>$this->session->userdata("invest_bank"));

					$dana=$this->M_invest->dataDana($whd)->row()->saldo;

					$data = array('saldo'=>$dana+$nominal);
					$this->db->where(array('id_pengguna'=>$idpengguna));
					$this->db->update("trx_dana_saldo", $data);
				}

					$out['status'] = '';
					$out['msg'] = '<p class="box-msg">
						  <div class="info-box alert-success">
							  <div class="info-box-icon">
								<i class="fa fa-check-circle"></i>
							  </div>
							  <div class="info-box-content" style="font-size:20px">
								Penarikan Dana Berhasil Diubah</div>
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
				        	Penarikan Dana Gagal Dirubah</div>
					  </div>
				    </p>';
			}

			$dataUser = $this->M_invest->checkUser(array('id_pengguna' => $idpengguna))->row();

			$title="Penarikan Dana";
			$data['mailtitle'] = $title;
			$data['email'] = $dataUser->email;
			$data['message'] = $msg;
			$data['mailformat'] = $this->input->post("format");
			$content = $this->load->view('template/v-mail-format-notif',$data,TRUE);
			$send = $this->M_invest->kirimEmailnya($data['email'],$content);

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('Dana');
		}

		public function generateReportRequestWithdraw()
		{
			include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
			$excel = new PHPExcel();

			$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Report Request Withdrawal');
			$excel->setActiveSheetIndex(0)->setCellValue('A2', '');

			$headers = array('No. KTP/Passport', 'Nama', 'Nama Bank', 'Pemilik Rekening', 'Nomor Rekening', 'Jumlah Penarikan');

			$excel->getActiveSheet()->fromArray($headers, NULL, 'A3');

			$data = $this->M_dana->select_report_withdraw();

			$excel->getActiveSheet()->fromArray($data, NULL, 'A4');

			// styling
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:F3')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$excel->getActiveSheet()->getStyle('F4:F10000')->getNumberFormat()->setFormatCode('#,##0.00');

			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');
		}
	}
 ?>
