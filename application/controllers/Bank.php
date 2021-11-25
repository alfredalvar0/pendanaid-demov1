<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bank extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_bank');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/bank';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataBank'] = $this->M_bank->select_bank();
		$this->load->view('admin/bank/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/bank/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataBank 	= array('nama_bank'=>$this->input->post('nama_bank'),
						'no_rek'=>$this->input->post('no_rek'),
						'atas_nama'=>$this->input->post('atas_nama'),
						'datecreated'=>date('Y-m-d H:i:s'),
						'userid'=>$this->session->userdata('id_admins')
						);

		$result = $this->M_bank->insert($dataBank);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Bank Berhasil Ditambahkan</div>
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
		        	Data Bank Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Bank');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id_bank'=>$id);
		$data['dataBank'] 	= $this->M_bank->select_bank($where)->row();
		$data['content'] = 'admin/bank/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idbank = $this->input->post('id_bank');

		$dataBank 	= array('nama_bank'=>$this->input->post('nama_bank'),
						'no_rek'=>$this->input->post('no_rek'),
						'atas_nama'=>$this->input->post('atas_nama'),
						'datecreated'=>date('Y-m-d H:i:s'),
						'userid'=>$this->session->userdata('id_admins')
						);

		$result = $this->M_bank->update($dataBank,$idbank);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bank Berhasil Diupdate</div>
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
				        	Data Bank Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Bank');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_bank'=>$this->input->post('id'));
		$result = $this->M_bank->del_data('tbl_bank',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bank Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bank Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

