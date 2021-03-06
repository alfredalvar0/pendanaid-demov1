<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Referal extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_referal');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/referal';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataReferal'] = $this->M_referal->select_all();
		$this->load->view('admin/referal/list_data', $data);
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id_referral'=>$id);
		$data['dataReferal'] 	= $this->M_referal->select_all($where)->row();
		$data['content'] = 'admin/referal/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idreferal = $this->input->post('id_referral');

		$dataReferal 	= array('kode_reveral'=>$this->input->post('kode_reveral')
						);

		$result = $this->M_referal->update($dataReferal,$idreferal);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Referal Berhasil Diupdate</div>
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
			        	Data Referal Gagal Diupdate</div>
				  </div>
			    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Referal');
	}

}

