<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Komisireferral extends CI_Controller {
	function __construct() {
		parent::__construct();
    // $this->load->helper('url');
    $this->load->model(array(
    	'M_produk',
    	'M_admin',
    	'M_referral'
    	// 'M_invest'
    ));
    $this->load->library(array(
    	"session",
    	// "form_validation"
    ));
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			// $tipe = array('tipe' => $this->session->userdata('tipe'));
			$data['dataProduk'] = $this->M_produk->select_all();
			$data['content'] = 'admin/komisireferral';
			$this->load->view('admin/indexadmin', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		// $data['dataReferral'] = $this->M_referal->select_all();
		// $wh = array("d.jumlah_dana IS NOT NULL" => null);
		$data['dataReferral'] = $this->M_referral->all_product();
		// var_dump($data['dataReferral']->num_rows());die();
		$this->load->view('admin/komisireferral/list_data', $data);
	}

	public function update($id) {
			
		// $id 				= $id;
		// $where = array('id_referral'=>$id);
		// $data['dataReferal'] 	= $this->M_referal->select_all($where)->row();
		$wh = array("k.id" => $id);
		$data['dataReferral'] = $this->M_referral->all_product($wh)->row();
		$data['content'] = 'admin/komisireferral/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();

		$id = $this->input->post('id');
		$persen_komisi = $this->input->post('persen_komisi');

		$result = $this->M_referral->update_komisi(['persen_komisi' => $persen_komisi],$id);

		if ($result) {
			$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Komisi Referral Berhasil Diupdate</div>
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
			        	Komisi Referral Gagal Diupdate</div>
				  </div>
			    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Komisireferral');
	}
}

