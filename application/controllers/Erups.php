<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Erups extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_erups');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/erups';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataErups'] = $this->M_erups->select_erups();
		$this->load->view('admin/erups/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/erups/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataErups 	= array('id_produk'=>$this->input->post('id_produk') ,
							'judul'=>$this->input->post('judul') ,
							'jam'=>$this->input->post('jam') ,
							'tanggal'=>$this->input->post('tanggal') ,
							'link'=>$this->input->post('link') ,
							'status'=>0 
						);

		$result = $this->M_erups->insert($dataErups);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Erups Berhasil Ditambahkan</div>
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
		        	Data Erups Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Erups');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id'=>$id);
		$data['dataErups'] 	= $this->M_erups->select_erups($where)->row();
		$data['content'] = 'admin/erups/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$iderups = $this->input->post('id');

		$dataErups 	= array('id_produk'=>$this->input->post('id_produk') ,
							'judul'=>$this->input->post('judul') ,
							'jam'=>$this->input->post('jam') ,
							'tanggal'=>$this->input->post('tanggal') ,
							'link'=>$this->input->post('link') ,
							'status'=>$this->input->post('status')
						);

		$result = $this->M_erups->update($dataErups,$iderups);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Erups Berhasil Diupdate</div>
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
				        	Data Erups Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Erups');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id'=>$this->input->post('id'));
		$result = $this->M_erups->del_data('tbl_erups',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Erups Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Erups Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

