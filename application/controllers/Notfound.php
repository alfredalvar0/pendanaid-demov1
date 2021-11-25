<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Notfound extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index()
	{
		 
		$this->load->view('template/notfound');
		 
		
	}

	 

}
