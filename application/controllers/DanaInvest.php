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
			$params = $this->input->post('fieldList');

			include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
			$excel = new PHPExcel();

			$arr = array(
				'id' => array('title' => 'ID', 'dataindex' => 'a.id_dana'),
				'jumlahdana' => array('title' => 'Jumlah Dana', 'dataindex' => 'a.jumlah_dana'),
				'tipe' => array('title' => 'Tipe', 'dataindex' => 'type_dana'),
				'lembarsaham' => array('title' => 'Lembar Saham', 'dataindex' => 'a.lembar_saham'),
				'produkinvest' => array('title' => 'Produk', 'dataindex' => 'judul'),
				'user' => array('title' => 'User', 'dataindex' => 'username'),
				'statusapprove' => array('title' => 'Status Approval', 'dataindex' => 'a.status_approve'),
				'tanggal' => array('title' => 'Date', 'dataindex' => 'a.createddate'),
			);

			$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Report Dana Investasi Per Tanggal '.date('d-m-Y'));
			$excel->setActiveSheetIndex(0)->setCellValue('A2', '');

			$headers = array();
			$selects = array();

			foreach ($params as $p) {
				array_push($headers, $arr[$p]['title']);
				array_push($selects, $arr[$p]['dataindex']);
			}

			$excel->getActiveSheet()->fromArray($headers, NULL, 'A3');

			$data = $this->M_danainvest->select_dana2($selects);
			$excel->getActiveSheet()->fromArray($data->result_array()	, NULL, 'A4');

			// styling
			$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold(TRUE);
			$excel->getActiveSheet()->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		    header('Content-Disposition: attachment; filename="Report_Dana_Invest_'.date('Ymd').'.xlsx"'); // Set nama file excel nya
		    header('Cache-Control: max-age=0');
		    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		    $write->save('php://output');
		}
	}
 ?>