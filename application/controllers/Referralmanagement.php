<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Referralmanagement extends CI_Controller {
	function __construct() {
		parent::__construct();

    $this->load->helper('url');
    $this->load->model(array('M_referral', 'M_admin', 'M_invest'));
    $this->load->library(array("session", "form_validation"));
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe' => $this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/referralmanagement';
			$this->load->view('admin/indexadmin', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$wh = array("d.jumlah_dana IS NOT NULL" => null);
		$data['dataReferral'] = $this->M_invest->listReferral($wh);
		$this->load->view('admin/referralmanagement/list_data', $data);
	}

	public function update($id_user, $no_trx_invest) {

		$wh = array("b.id_pengguna" => $id_user, "d.id_dana" => $no_trx_invest);
		$data['referral'] = $this->M_invest->listReferral($wh)->row();
		$data['content'] = 'admin/referralmanagement/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function detail($id_user, $no_trx_invest) {

		$wh = array("b.id_pengguna" => $id_user, "d.id_dana" => $no_trx_invest);
		$data['referral'] = $this->M_invest->listReferral($wh)->row();
		$data['content'] = 'admin/referralmanagement/form_detail';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
	  $id_user = $this->input->post("id_user");
	  // $investor = $this->input->post("investor");
	  // $produk = $this->input->post("produk");
	  // $tanggal_invest = $this->input->post("tanggal-invest");
	  // $jumlah_invest = $this->input->post("jumlah-invest");
	  $no_trx_invest = $this->input->post("no-trx-invest");
	  $persen_komisi = $this->input->post("persen-komisi");
	  // $komisi = $this->input->post("komisi");
	  // $nama_referral = $this->input->post("nama-referral");
	  // $kode_referral = $this->input->post("kode-referral");
	  $status = $this->input->post("status");
	  $keterangan = $this->input->post("keterangan");

		$data 	= array(
			'id_dana' => $no_trx_invest,
			'id_pengguna' => $id_user,
			'persen_komisi' => $persen_komisi,
			'status' => $status,
			'keterangan' => $keterangan,
			'created_at' => date('Y-m-d H:i:s')
		);

		$result = $this->M_referral->insert_invest_komisi($data,$idreferal);

		if ($result > 0) {
			$out['status'] = '';
			$out['msg'] = '
				<p class="box-msg">
		      <div class="info-box alert-success">
			      <div class="info-box-icon">
			      	<i class="fa fa-check-circle"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Data Referal Berhasil Diupdate</div>
					  </div>
					</div>
		    </p>';
		} else{
			$out['status'] = '';
			$out['msg'] = '
				<p class="box-msg">
		      <div class="info-box alert-error">
			      <div class="info-box-icon">
			      	<i class="fa fa-check-circle"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Data Referal Gagal Diupdate</div>
					  </div>
					</div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Referralmanagement');
	}

}

