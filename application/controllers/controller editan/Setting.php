<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Setting extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_setting');
        $this->load->model('M_admin');
        $lib=array("session","form_validation","upload");
        $this->load->library($lib);
	}


	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataProduk'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'setting';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}


	public function update($id) {
			
		$id 				= $id;
		$data['dataSetting'] 	= $this->M_setting->select_by_id($id);
		$data['content'] = 'admin/setting/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		//$data = array();
		
		$idsetting = $this->input->post('id_admin');

		$dataSetting 	= array('username'=>$this->input->post('username'),
							'email'=>$this->input->post('email'),
							'password'=>md5($this->input->post('password'))
						);
		

		$result = $this->M_setting->update($dataSetting,$idsetting);
		
		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Setting Berhasil Diupdate</div>
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
				        	Data Setting Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		if ($this->session->userdata('tipe') == 'admin') {
			redirect('Akun');
		}else {
			redirect('Admin/home');	
		}
		
	}

}

