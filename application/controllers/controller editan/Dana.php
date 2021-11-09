<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Dana extends CI_Controller {
		function __construct(){
			parent::__construct();
	        $this->load->helper('url');
	        $this->load->model('M_dana');
	        $this->load->model('M_admin');
			$this->load->model('M_invest');
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

		public function prosesUpdate(){
			$out = array();
			// $data = array();
			$iddana = $this->input->post('id_dana');
			$idpengguna = $this->input->post('id_pengguna');
			$nominal = $this->input->post('nominal');
			
			$dataDana 	= array('status_approve'=>$this->input->post('status_approve'));
			
			// $pesan = $this->input->post('pesan');
			/*if ($pesan == "") {
				
			}else{ */			$where = array('a.id_dana'=>$iddana);			$dataDanany 	= $this->M_dana->select_dana($where)->row();			$date=date('Y-m-d H:i:s');			$msg="";			if($this->input->post('status_approve')=="approve"){				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." berhasil di approve pada tanggal ".$date;			} else if($this->input->post('status_approve')=="pending"){				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." di pending pada tanggal ".$date;			} else if($this->input->post('status_approve')=="refuse"){				$msg ="Penarikan Dana kamu sebesar Rp. ".number_format($dataDanany->jumlah_dana,0,".",".")." di tolak pada tanggal ".$date;			}
				$dataPesan = array('pesan'=>$msg,
								'id_pengguna'=>$idpengguna,
								'createddate'=>$date
							);
				$result = $this->M_dana->insertpesan($dataPesan);
			//}

			$result = $this->M_dana->update($dataDana,$iddana);
			
			
			
		 
			
			

			if ($result > 0 ) {
				
				if($this->input->post('status_approve') == "approve"){
					//update saldo
					$whd=array("id_pengguna"=>$idpengguna); // ,"a.id_bank"=>$this->session->userdata("invest_bank"));
						 
					$dana=$this->M_invest->dataDana($whd)->row()->saldo;
					
					$data = array('saldo'=>$dana-$nominal);
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

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('Dana');
		}
	}
 ?>