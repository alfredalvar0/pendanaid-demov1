<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
		$this->load->model('m_invest');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			redirect('Admin/home');
		}else{
			$this->load->view('admin/login');
		}
		// $this->load->view('login');
		
	}

	public function home(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/dashboard';
			$data['history']=$this->m_invest->dataDanaHistoryTransaksiAdmin();
			$this->load->view('admin/indexadmin',$data);
			
		}else{
			redirect('Admin');
		}
	}

}
