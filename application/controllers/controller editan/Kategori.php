<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kategori extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_kategori');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/kategori';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataKategori'] = $this->M_kategori->select_kategori();
		$this->load->view('admin/kategori/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/kategori/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataKategori 	= array('kategori'=>$this->input->post('kategori') 
						);

		$result = $this->M_kategori->insert($dataKategori);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Kategori Berhasil Ditambahkan</div>
				  </div>
			    </p>';
        } else {
		$out['status'] = '';
		$out['msg'] = '<p class="box-msg">
		      <div class="info-box alert-error">
			      <div class="info-box-icon">
			      	<i class="fa fa-warning"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Data Kategori Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Kategori');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id_kategori'=>$id);
		$data['dataKategori'] 	= $this->M_kategori->select_kategori($where)->row();
		$data['content'] = 'admin/kategori/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idkategori = $this->input->post('id_kategori');

		$dataKategori 	= array('kategori'=>$this->input->post('kategori') 
						);

		$result = $this->M_kategori->update($dataKategori,$idkategori);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Kategori Berhasil Diupdate</div>
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
				        	Data Kategori Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Kategori');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_kategori'=>$this->input->post('id'));
		$result = $this->M_kategori->del_data('tbl_kategori',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Kategori Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Kategori Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

