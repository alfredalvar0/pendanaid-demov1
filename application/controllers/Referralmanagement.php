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
	  $id_referral = $this->input->post("id_referral");
	  $id_produk = $this->input->post("id_produk");
	  $no_trx_invest = $this->input->post("no-trx-invest");
	  $persen_komisi = $this->input->post("persen-komisi");
	  $komisi = $this->input->post("komisi");
	  $status = $this->input->post("status");
	  $keterangan = $this->input->post("keterangan");

		$data 	= array(
			'id_dana' => $no_trx_invest,
			'id_pengguna' => $id_user,
			'id_produk' => $id_produk,
			'persen_komisi' => $persen_komisi,
			'status' => $status,
			'keterangan' => $keterangan,
			'created_at' => date('Y-m-d H:i:s')
		);

		$detail = '
			<table border="0">
				<tr>
					<th align="right">No Trx Invest</th><td>:</td><td>'.$no_trx_invest.'</td>
				</tr>
				<tr>
					<th align="right">ID User</th><td>:</td><td>'.$id_user.'</td>
				</tr>
				<tr>
					<th align="right">Komisi</th><td>:</td><td>Rp '.$komisi.' ('.$persen_komisi.'%)</td>
				</tr>
			</table>
		';
	
		// $push_notif = $this->kirimEmail($id_referral, $detail, $status);

		if($status == '1') {
			$saldo = $this->M_invest->dataDana(array(
				"id_pengguna" => $id_referral
			))->row()->saldo;
			
			$data_dana = array(
				"id_dana" => date('YmdHis'),
				"id_pengguna" => $id_referral,
				"jumlah_dana" => str_replace(['.', ','], '', $komisi),
				"type_dana" => "komisi",
				"status_approve" => "approve",
				"createddate" => date('Y-m-d H:i:s')
			);

			$this->M_invest->insertdata("trx_dana", $data_dana);

			$saldo = $saldo + $data_dana['jumlah_dana'];
			$this->M_invest->updatedata('trx_dana_saldo', array('saldo' => $saldo), array('id_pengguna' => $id_referral));
		}

		$result = $this->M_referral->insert_invest_komisi($data);

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

	public function kirimEmail($id_referral, $detail, $status){
		$conditions = array("b.id_pengguna" => $id_referral);
		$userDetail = $this->M_invest->checkPengguna($conditions)->row();
		
		if ($status == '1') {
			$title = "Komisi Referral Anda Disetujui";
		} else {
			$title = "Komisi Referral Anda Ditolak";
		}

		$mailformat = $this->formatEmail($userDetail->nama_pengguna, $title, $detail, $status);

		$this->M_invest->kirimEmailnya($userDetail->mailto, $mailformat);

  }


	public function formatEmail($username, $title, $detail, $status){
    $data['title'] = $title;
		$data['username'] = $username;
		$data['detail'] = $detail;

		if($status == '0') {
			return $this->load->view('template/v-mail-format-komisi-refuse', $data, TRUE);
		} else {
			return $this->load->view('template/v-mail-format-komisi-approve', $data, TRUE);
		}
  }

}

