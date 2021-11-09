<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Loginadmin extends CI_Controller {
	
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function do_login()
	{
		
		$data = array('email' => $this->input->post('email'),
					'password' => md5($this->input->post('password'))
					);
		
		$var = $this->M_admin->select($data);
		
		if ($var->num_rows() > 0 && ($var->row()->tipe == 'admin' || $var->row()->status == 'aktif')) {
			$data_session = array(
				'emails' => $this->input->post('email'),
				'passwords' => md5($this->input->post('password')),
				'tipe' => $var->row()->tipe,
				'status' => $var->row()->status,
				'id_admins' => $var->row()->id_admin
			);
			$this->session->set_userdata($data_session);
			redirect('Admin/home');
		}else{
			// redirect('admin_menstruasi');
			redirect('Admin');
		}
	}

	function logout(){
		unset($_SESSION['id_admins'],$_SESSION['emails'],$_SESSION['passwords'],$_SESSION['tipe']);
		
		// redirect('admin_menstruasi');
		redirect('Admin');
	}
}
