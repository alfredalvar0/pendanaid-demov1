<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukPasarSekunder extends CI_Controller {
	function __construct(){
		parent::__construct();
    $this->load->helper('url');
    $this->load->model('M_produkpasarsekunder');
    $this->load->model('M_admin');
    $this->load->library(array("session","form_validation"));
	}

	public function index() {
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/produkpasarsekunder';
			$this->load->view('admin/indexadmin', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function tampil()
	{
		$data['dataProduk'] = $this->M_produkpasarsekunder->select_all();
		$this->load->view('admin/produkpasarsekunder/list_data', $data);
	}

	public function update($id) {
		$where = array('a.id_produk' => $id);
		$data['dataProduk'] = $this->M_produkpasarsekunder->select_all($where)->row();
		$data['content'] = 'admin/produkpasarsekunder/form_update';
		$this->load->view('admin/indexadmin', $data);
	}

	public function prosesUpdate($id){
		$out = array();
		$idProduk = $this->input->post('id_produk'); 
		$dataProduk = array(
			'id_produk' => $idProduk,
			'maks_harga_perlembar' => $this->input->post('maks_harga_perlembar'),
			'min_harga_perlembar' => $this->input->post('min_harga_perlembar'),
			'nilai_biaya_admin' => $this->input->post('nilai_biaya_admin'),
			'jenis_biaya_admin' => $this->input->post('jenis_biaya_admin'),
			'nilai_biaya_kustodian' => $this->input->post('nilai_biaya_kustodian'),
			'jenis_biaya_kustodian' => $this->input->post('jenis_biaya_kustodian'),
			'publish' => $this->input->post('publish'),
			'id_user'=>$this->session->userdata('id_admins'),
		);

		$dataExist = $this->M_produkpasarsekunder->getDataProduk([
			'id_produk' => $idProduk
		]);

		if ($dataExist->num_rows() == 0) {
			$dataProduk['created_at'] = date('Y-m-d H:i:s');
			$result = $this->M_produkpasarsekunder->insert($dataProduk);
		} else {
			$result = $this->M_produkpasarsekunder->update($dataProduk, $idProduk);
		}

		if ($result > 0) {
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
		redirect('ProdukPasarSekunder?id='.$id);
	}

}

