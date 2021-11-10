<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
		$this->load->model('M_akun');
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

	public function reset_pass()
	{
		$this->load->view('admin/reset-pass');
	}

	public function home(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['pendingVerif'] = $this->M_akun->select_akun_verif()->num_rows();
			$data['content'] = 'admin/dashboard';
			$data['history']=$this->m_invest->dataDanaHistoryTransaksiAdmin();
			$this->load->view('admin/indexadmin',$data);
			
		}else{
			redirect('Admin');
		}
	}

	public function export_csv(){ 	
		/* file name */
		$filename = 'transection_'.date('Ymd').'.csv'; 
		header("Content-Description: File Transfer"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Content-Type: application/csv; ");
	   /* get data */
		$history = $this->m_invest->dataDanaHistoryTransaksiAdmin();
		/* file creation */
		$file = fopen('php://output', 'w');
		$header = array("Username","Email","Tipe","Tipe User","Login From","Status","Investor Status"); 
		fputcsv($file, $header);
		foreach ($history as $key=>$line){ 
			fputcsv($file,$line); 
		}
		fclose($file); 
		exit; 
	}

}
