<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiPasarSekunder extends CI_Controller {
	function __construct(){
		parent::__construct();
    $this->load->helper('url');
    $this->load->model('M_transaksipasarsekunder');
    $this->load->model('m_invest');
    $this->load->model('M_admin');
    $this->load->library(array("session","form_validation"));
	}

	public function index() {
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/transaksipasarsekunder';
			$this->load->view('admin/indexadmin', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function tampil()
	{
		$data['dataProduk'] = $this->M_transaksipasarsekunder->select_all();
		$this->load->view('admin/transaksipasarsekunder/list_data', $data);
	}

	public function update($id) {
		$where = array('ps.id_dana' => $id);
		$data['dataProduk'] = $this->M_transaksipasarsekunder->select_all($where)->row();
		$data['content'] = 'admin/transaksipasarsekunder/form_update';
		$this->load->view('admin/indexadmin', $data);
	}

	public function prosesUpdate($id){
		if (!empty($this->input->post('status') && !empty($this->input->post('jenis_transaksi')))) {
			$out = array();
			$kembalikanAset = '';

			$data = ['status' => $this->input->post('status')];
			$id = $this->input->post('id');

			$currData = $this->M_transaksipasarsekunder->select_all(['ps.id' => $id])->row();
			$jenis_transaksi = $currData->jenis_transaksi;

			if ($jenis_transaksi == 'beli') {

				$updateStatus = $this->M_transaksipasarsekunder->update($data, $id);

				if ($updateStatus > 0) {
					$gross = $currData->harga_per_lembar * $currData->lembar_saham;
					$filterSaldoAwal = array("id_pengguna" => $currData->id_pengguna);
					$saldoAwal = $this->m_invest->dataDana($filterSaldoAwal)->row('saldo');

					$dataSaldo = ["saldo" => ($saldoAwal + $gross)];
					$filterSaldo = ["id_pengguna" => $currData->id_pengguna];

					$kembalikanAset = $this->m_invest->updatedata("trx_dana_saldo", $dataSaldo, $filterSaldo);
				}

			} elseif ($jenis_transaksi == 'jual') {
				$updateStatus = $this->M_transaksipasarsekunder->update($data, $id);
				$kembalikanAset = 1;
			}
			
			if ($kembalikanAset > 0) {
				$out['status'] = '';
				$out['msg'] = '
					<p class="box-msg">
					  <div class="info-box alert-success">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">Berhasil</div>
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
						  <div class="info-box-content" style="font-size:20px">Gagal</div>
					  </div>
					</p>';
			}

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('TransaksiPasarSekunder?id='.$id);
			// code...
		} else {
			die('invalid post');
		}
		
	}

}

