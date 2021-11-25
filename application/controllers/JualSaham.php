<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class JualSaham extends CI_Controller {
		function __construct(){
			parent::__construct();
	        $this->load->helper('url');
	        $this->load->model('M_jualsaham');
	        $this->load->model('M_admin');
			$this->load->model('m_invest');
	        $lib=array("session","form_validation");
	        $this->load->library($lib);
		}

		public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/jualsaham';
			$this->load->view('admin/indexadmin',$data);
			}else{
				$this->load->view('login');
			}
		}

		public function tampil()
		{			
			$where="";			
			if($this->input->get("idproduk")!=""){				
				$where=array("a.id_produk"=>$this->input->get("idproduk"));			
			}
			$data['dataJualSaham'] = $this->M_jualsaham->select_dana($where);
			$this->load->view('admin/jualsaham/list_data', $data);
		}

		public function update($id) {
			
			// $id 				= $id;
			$where = array('a.id_jual'=>$id);
			$data['dataJualSaham'] 	= $this->M_jualsaham->select_dana($where)->row();
			$data['content'] = 'admin/jualsaham/form_update';
			$this->load->view('admin/indexadmin',$data);
		}

		public function prosesUpdate(){
			$out = array();
			// $data = array();
			$iddana = $this->input->post('id_jual');
			$idpengguna = $this->input->post('id_pengguna');

			$dataDana 	= array('status_approve'=>$this->input->post('status_approve'),
								'jumlah_dana'=>$this->input->post('jumlah_dana'));
			$pesan = $this->input->post('pesan');
			$where = array('a.id_jual'=>$iddana);
			$dataJualSaham= $this->M_jualsaham->select_dana($where)->row();
			$date=date('Y-m-d H:i:s');
			$msg="";
			if($this->input->post('status_approve')=="approve"){
				$msg ="Pengajuan Jual Saham kamu sebesar Rp. ".number_format($this->input->post('jumlah_dana'),0,".",".")." berhasil di approve pada tanggal ".$date;
			} else if($this->input->post('status_approve')=="pending"){
				$msg ="Pengajuan Jual Saham kamu sebesar Rp. ".number_format($dataJualSaham->jumlah_dana,0,".",".")." di pending pada tanggal ".$date;
			} else if($this->input->post('status_approve')=="refuse"){
				$msg ="Pengajuan Jual Saham kamu sebesar Rp. ".number_format($dataJualSaham->jumlah_dana,0,".",".")." di tolak pada tanggal ".$date;
			}
			
			//if ($this->input->post('status_approve') == "") {
				$dataPesan = array('pesan'=>$msg,
								'id_pengguna'=>$idpengguna,
								'createddate'=>$date
							);
				$result = $this->M_jualsaham->insertpesan($dataPesan);
			//}

			$result = $this->M_jualsaham->update($dataDana,$iddana);
			

			if ($result > 0) {
				
				if($this->input->post('status_approve') == "approve"){
					 //get last saldo
					$whi=array("id_pengguna"=>$this->input->post('id_pengguna'));
					$saldo=$this->m_invest->dataDana($whi)->row();
			
					 $jum = $saldo->saldo + $this->input->post('jumlah_dana');
					//update saldo 
					$data=array(
						"saldo"=>  $jum
					);
					$wh=array("id_pengguna"=>$this->input->post('id_pengguna'));
					$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo",$data,$wh);
					
					
					//update history
					$wh=array("id_dana"=>$iddana);
					$data=array(
						"jumlah_dana"=>  $this->input->post('jumlah_dana'),
						"status_approve"=>"approve"
					);
					$updatesaldo = $this->m_invest->updatedata("trx_dana",$data,$wh);
				}else{
					//update history
					$wh=array("id_dana"=>$iddana);
					$data=array(
						"jumlah_dana"=> 0,
						"status_approve"=>"refuse"
					);
					$updatesaldo = $this->m_invest->updatedata("trx_dana",$data,$wh);
				}
				
				
				$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Pengajuan Jual Saham Berhasil Dirubah</div>
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
				        	Pengajuan Jual Saham Gagal Dirubah</div>
					  </div>
				    </p>';
			}

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('JualSaham');
		}
	}
 ?>