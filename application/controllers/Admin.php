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

	public function list_data()
	{
		$search_tipe = $this->input->post('tipe');
		$search_produk = $this->input->post('produk');
		$search_user = $this->input->post('user');
		$search_status_approve = $this->input->post('status_approve');

		echo $this->M_admin->get_list_data(array('trx_dana.type_dana' => $search_tipe, 'trx_produk.judul' => $search_produk, 'tbl_admin.username' => $search_user, 'trx_dana.status_approve' => $search_status_approve));
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

	function generateReport() {
		$params = $this->input->post('fieldList');
		$periode_from = $this->input->post('report_from');
		$periode_until = $this->input->post('report_until');
		$s_tipe = $this->input->post('s_tipe');
		$s_produk = $this->input->post('s_produk');
		$s_user = $this->input->post('s_user');
		$s_status = $this->input->post('s_status');

		include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
		$excel = new PHPExcel();

		$arr = array(
			'id' => array('title' => 'ID', 'dataindex' => 'CONVERT(trx_dana.id_dana, CHAR) AS id_dana'),
			'jumlahdana' => array('title' => 'Jumlah Dana', 'dataindex' => 'trx_dana.jumlah_dana'),
			'tipe' => array('title' => 'Tipe', 'dataindex' => 'type_dana'),
			'lembarsaham' => array('title' => 'Lembar Saham', 'dataindex' => 'trx_dana_invest.lembar_saham'),
			'produkinvest' => array('title' => 'Produk', 'dataindex' => 'trx_produk.judul'),
			'user' => array('title' => 'User', 'dataindex' => 'username'),
			'nama' => array('title' => 'Nama Pengguna', 'dataindex' => 'nama_pengguna'),
			'nik' => array('title' => 'NIK', 'dataindex' => 'no_ktp'),
			'no_hp' => array('title' => 'No. Hp', 'dataindex' => 'no_hp'),
			'email' => array('title' => 'Email', 'dataindex' => 'email'),
			'statusapprove' => array('title' => 'Status Approval', 'dataindex' => 'trx_dana.status_approve'),
			'tanggal' => array('title' => 'Date', 'dataindex' => 'trx_dana.createddate'),
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Report Transaksi Periode '.$periode_from.' s/d '.$periode_until);
		$excel->setActiveSheetIndex(0)->setCellValue('A2', '');

		$headers = array();
		$selects = array();

		foreach ($params as $p) {
			array_push($headers, $arr[$p]['title']);
			array_push($selects, $arr[$p]['dataindex']);
		}

		$excel->getActiveSheet()->fromArray($headers, NULL, 'A3');

		$wh2 = array();
		if ($s_tipe != "") {
			$wh2['type_dana LIKE "%'.$s_tipe.'%"'] = NULL;
		}

		if ($s_produk != "") {
			$wh2['trx_produk.judul LIKE "%'.$s_produk.'%"'] = NULL;
		}

		if ($s_user != "") {
			$wh2['username LIKE "%'.$s_user.'%"'] = NULL;
		}

		if ($s_status != "") {
			$wh2['trx_dana.status_approve LIKE "%'.$s_user.'%"'] = NULL;
		}

		$data = $this->m_invest->dataDanaHistoryTransaksiAdmin2($selects, array('periode_from' => $periode_from, 'periode_until' => $periode_until), $wh2);

		$excel->getActiveSheet()->fromArray($data->result_array()	, NULL, 'A4');

		// styling
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3:K3')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3:K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(35);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="History_Transaksi_'.date('Ymd').'.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');
	}

}
