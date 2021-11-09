<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Msetting extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_msetting');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/msetting';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataMsetting'] = $this->M_msetting->select_setting();
		$this->load->view('admin/msetting/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/msetting/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataMsetting 	= array('modul'=>$this->input->post('modul'),
						'value'=>$this->input->post('value')
						);

		$result = $this->M_msetting->insert($dataMsetting);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Master Setting Berhasil Ditambahkan</div>
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
		        	Data Master Setting Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Msetting');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id_setting'=>$id);
		$data['dataMsetting'] 	= $this->M_msetting->select_setting($where)->row();
		$data['content'] = 'admin/msetting/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idsetting = $this->input->post('id_setting');

		$dataMsetting 	= array('modul'=>$this->input->post('modul'),
						'value'=>$this->input->post('value')
						);
		if($this->input->post('modul')=="whatsapp"){
			$data=array(
				"phone"=>$this->input->post('phone'),
				"text"=>$this->input->post('text')
			);
			$val =json_encode($data);
			$dataMsetting['value']=$val;
		} else if($this->input->post('modul')=="midtrans"){
			$data=array(
				"server_key"=>$this->input->post('server_key'),
				"production"=>$this->input->post('production')
			);
			$val =json_encode($data);
			$dataMsetting['value']=$val;
		}
		
		$result = $this->M_msetting->update($dataMsetting,$idsetting);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Master Setting Berhasil Diupdate</div>
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
				        	Data Master Setting Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Msetting');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_setting'=>$this->input->post('id'));
		$result = $this->M_msetting->del_data('tbl_setting',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Master Setting Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Master Setting Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

