<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Evoting extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_evoting');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/evoting';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataEvoting'] = $this->M_evoting->select_evoting();
		$this->load->view('admin/evoting/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/evoting/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataEvoting 	= array('id_produk'=>$this->input->post('id_produk') ,
							'judul'=>$this->input->post('judul') ,
							'opsi1'=>$this->input->post('opsi1') ,
							'opsi2'=>$this->input->post('opsi2') ,
							'opsi3'=>$this->input->post('opsi3') ,
							'opsi4'=>$this->input->post('opsi4') ,
							'status'=>0 ,
							'createddate'=>date('Y-m-d H:i:s')
						);

		$result = $this->M_evoting->insert($dataEvoting);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Evoting Berhasil Ditambahkan</div>
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
		        	Data Evoting Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Evoting');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id'=>$id);
		$data['dataEvoting'] 	= $this->M_evoting->select_evoting($where)->row();
		$data['content'] = 'admin/evoting/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idevoting = $this->input->post('id');

		$dataEvoting 	= array('id_produk'=>$this->input->post('id_produk') ,
							'judul'=>$this->input->post('judul') ,
							'opsi1'=>$this->input->post('opsi1') ,
							'opsi2'=>$this->input->post('opsi2') ,
							'opsi3'=>$this->input->post('opsi3') ,
							'opsi4'=>$this->input->post('opsi4') ,
							'status'=>0 ,
							'createddate'=>date('Y-m-d H:i:s')
						);

		$result = $this->M_evoting->update($dataEvoting,$idevoting);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Evoting Berhasil Diupdate</div>
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
				        	Data Evoting Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Evoting');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id'=>$this->input->post('id'));
		$result = $this->M_evoting->del_data('tbl_evoting',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Evoting Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Evoting Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

