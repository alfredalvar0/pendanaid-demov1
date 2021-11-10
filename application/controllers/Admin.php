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

	public function resetpass($key=""){
		$wh=array(
			"a.reset_token"=>$key,
			"a.status"=>"aktif"
		);
		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()){
			$now = date("Y-m-d H:i:s");
			$dt = $var->row();
			$exp = $dt->reset_token!=""?$dt->reset_exp:date("Y-m-d H:i:s");
			// Declare and define two dates
			$date1 = strtotime($now);
			$date2 = strtotime($exp);
			$days = $this->dayCount($now,$exp);

			if($days>=1 ){
				// $result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Token Expire');
				$result['notif'] = '<div class="alert alert-danger">
								  <i class="fa fa-check-circle"></i>Token Expire
							  </div>';
				$this->session->set_flashdata($result);
				redirect("admin");
			} else {
				$data['key']=$key;
				$data['datatoken']=$dt;
				//$data['dataPerguruanRow'] = $this->M_mhs->dataPerguruanTinggi()->row();
				$this->load->view("admin/form-reset-pass", $data);
				// $this->load->view('index',$data);
			}
		} else {
			$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data not Found');
			$result['notif'] = '<div class="alert alert-danger">
				<i class="fa fa-times-circle"></i> Data Not Found
			</div>';
			$this->session->set_flashdata($result);
			redirect("admin");
		}
	}

	public function dayCount($now,$exp){
		// Declare and define two dates
		$date1 = strtotime($now);
		$date2 = strtotime($exp);
		// Formulate the Difference between two dates
		$diff = abs($date2 - $date1);
		// To get the year divide the resultant date into total seconds in a year (365*60*60*24)
		$years = floor($diff / (365*60*60*24));
		// To get the month, subtract it with years and divide the resultant date into total seconds in a month (30*60*60*24)
		$months = floor(($diff - $years * 365*60*60*24)  / (30*60*60*24));
		// To get the day, subtract it with years and months and divide the resultant date into total seconds in a days (60*60*24)
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		// To get the hour, subtract it with years, months & seconds and divide the resultant date into total seconds in a hours (60*60)
		$hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));
		// To get the minutes, subtract it with years, months, seconds and hours and divide the resultant date into total seconds i.e. 60
		$minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
		// To get the minutes, subtract it with years, months, seconds, hours and minutes
		$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
		// Print the result
		//echo $now." - ".$exp."</br>";
		//printf("%d years, %d months, %d days, %d hours, ". "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds);
		return $days;
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
