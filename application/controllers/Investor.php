<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Investor extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/indexagreement
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
        // Your own constructor code
		$helper=array("url","cookie",'pdf_helper');
		$this->load->helper($helper);
       // $this->load->helper('url');
		$this->load->model('m_invest');
		$this->load->model('google_login_model');
		$this->load->library("session");
	}
	public function index(){
		if($this->checkRole()=="investor"){
			$data=array();
			//$wh=array("p.status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running")
		);
			$data['data_produk']=$this->m_invest->dataProduk("","","",$whi);

			$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
			$data['content']=$this->load->view("home", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}

	}

	//dashboard
	public function dashboard_saya(){
		if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
			$data=array();

			$data['content']=$this->load->view("dokumen-saya", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function daftar_rekening(){
		if($this->checkRole()=="investor"){
			$data=array();

			$data['data_rekening']=$this->db->query("select * from  tbl_bank where no_rek!='' and atas_nama!=''");


			$data['content']=$this->load->view("daftar_rekening", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function oy(){
		if($this->checkRole()=="investor"){
			$data=array();

			$data['data_rekening']=$this->db->query("select * from  tbl_bank where no_rek!='' and atas_nama!=''");


			$data['content']=$this->load->view("oy", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function proses_pembayaran($id_transaksi)
	{
		$data['metode_pembayaran']=$this->db->query("select * from  tbl_payment_method where active = 1");
		$data['nomor_rekening']=$this->db->query("
				select a.*, b.nama_bank from  tbl_payment_account a
				join tbl_bank b ON a.bank_id = b.id_bank
				where a.active = 1
			");
		$data['amount'] = $this->db->get_where('trx_dana', array('id' => $id_transaksi))->row();

		$data['content']=$this->load->view("pembayaran", $data, TRUE);
		$this->load->view('index',$data);
	}

	public function pembayaran($id_transaksi){
		if($this->checkRole()=="investor"){
			$data=array();

			$data['metode_pembayaran']=$this->db->query("select * from  tbl_payment_method where active = 1");
			$data['nomor_rekening']=$this->db->query("
					select a.*, b.nama_bank from  tbl_payment_account a
					join tbl_bank b ON a.bank_id = b.id_bank
					where a.active = 1
				");
			$data['amount'] = $this->db->get_where('trx_dana', array('id' => $id_transaksi))->row();
			$data['id_transaksi'] = $id_transaksi;
			$data['content']=$this->load->view("pembayaran", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function konfirmasi_pembayaran($id_transaksi)
	{
		if($this->checkRole()=="investor"){
			$data=array();

			$data["id_transaksi"] = $id_transaksi;
			$data['transaksi'] = $this->db->get_where('trx_dana', array('id' => $id_transaksi))->row();
			$data['bank'] = $this->db->get_where('tbl_bank');
			$data['payment_accounts'] = $this->db->query("SELECT
					a.id,
					CONCAT(a.account_no, ' ', b.nama_bank, ' a/n ', a.account_owner) AS rekening
				FROM tbl_payment_account a
				JOIN tbl_bank b ON a.bank_id = b.id_bank
				WHERE a.active = 1");
			$data['metode_pembayaran']=$this->db->query("select * from  tbl_payment_method where active = 1");
			$data['nomor_rekening']=$this->db->query("
					select a.*, b.nama_bank from  tbl_payment_account a
					join tbl_bank b ON a.bank_id = b.id_bank
					where a.active = 1
				");
			$data['amount'] = $this->db->get_where('trx_dana', array('id' => $id_transaksi))->row();
			$data['content']=$this->load->view("konfirmasi_pembayaran", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function doKonfirmasi()
	{
		$id_transaksi = $this->input->post("id_transaksi");
		$amount = $this->input->post("amount");
		$payment_account_id = $this->input->post("payment_account_id");
		$bank_id_from = $this->input->post("bank_id_from");
		$account_no = $this->input->post("account_no");
		$account_name = $this->input->post("account_name");

		if (isset($_FILES['transfer_proof']['name']) && $_FILES['transfer_proof']['name'] != "") {

			$ex_filename = explode('.', $_FILES['transfer_proof']['name']);
			$extension = $ex_filename[1];
			$filename = "konfirmasi_pembayaran_".$id_transaksi."_".date('YmdHis').".".$extension;

			$config['upload_path']          = 'assets/img/dokumen/konfirmasi_pembayaran/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//upload execute
			$this->upload->do_upload('transfer_proof');

			$path_uploaded_file = 'assets/img/dokumen/konfirmasi_pembayaran/'.$filename;
		}

		$this->db->insert('trx_konfirmasi_pembayaran', array(
			'id_transaksi' => $id_transaksi,
			'amount' => $amount,
			'payment_account_id' => $payment_account_id,
			'bank_id_from' => $bank_id_from,
			'account_no' => $account_no,
			'account_name' => $account_name,
			'transfer_proof' => $path_uploaded_file
		));

		$res['notif'] = '<div class="alert alert-success">Konfirmasi pembayaran sudah terkirim. Admin akan melakukan konfirmasi atas pembayaran Anda.</div>';

		$this->session->set_flashdata($res);

		redirect('investor/konfirmasi_pembayaran/'.$id_transaksi);
	}

	public function complete(){
		if($this->checkRole()=="investor"){
			$data=array();

			$data['data_rekening']=$this->db->query("select * from  tbl_bank where no_rek!='' and atas_nama!=''");

			$data['content']=$this->load->view("complete", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}

	public function saveOy(){
		$amount = $_POST['amount'];
		$name = $_POST['sender_name'];
		$status = $_POST['status'];
		$email = $_POST['email'];
		$unik = rand(100, 999);
		$amount = $amount + $unik;
		$id = $this->google_login_model->get_user_data($email);
		$admin_id = $this->google_login_model->get_user_id($id->id_admin);

		// $this->google_login_model->add_user_amount($amount,$admin_id->id_pengguna);
		$this->google_login_model->record_transaction(array(
			'id_dana' => date('YmdHis'),
			'id_pengguna' => $this->input->post('id_pengguna'),
			'id_bank' => NULL,
			'nama_akun' => NULL,
			'no_rek' => NULL,
			'type_dana' => 'tambah',
			'jumlah_dana' => $amount,
			'status_approve' => 'pending',
			'createddate' => date('Y-m-d H:i:s')
		));

		redirect('investor/pembayaran/'.$this->db->insert_id());
	}


	public function oyPay()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone_number = $this->input->post('phone_number');
		$amount = $this->input->post('amount');
		$description = $this->input->post('description');



		$curl = curl_init();
		$data = array(

			"description"=> $description,
			"partner_tx_id"=> "",
			"notes"=> "",
			"sender_name"=> $name,
			"amount"=> $amount,
			"email"=> $email,
			"phone_number"=> $phone_number,
			"is_open"=> false,
			"step"=> "input-amount",
			"include_admin_fee"=> false,
			"list_disabled_payment_methods"=> "",
			"list_enabled_banks"=> "002, 008, 009, 013, 022",
			"list_enabled_ewallet"=> "shopeepay_ewallet"

		);
		// print_r($data);exit();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api-stg.oyindonesia.com/api/payment-checkout/create-v2',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>$data,
			CURLOPT_HTTPHEADER => array(
				'content-type: application/json',
				'X-Api-Key: d4223670-1abb-491c-be03-c32370774324',
				'X-Oy-Username: pendanaid'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function pasar_sekunder(){
		if($this->checkRole()=="investor"){
			$data   = array();
			//$wh=array("p.status_approve"=>"approve");
			$whi    = array("p.status_approve"=>array("approve","complete","invest","running") );
			$data['data_produk']=$this->m_invest->dataProdukSekunder("","","",$whi);
			$data['content']=$this->load->view("home_sekunder", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}

	}

	public function portfolio_pasar_sekunder(){
		$data = [];
		$data['sidebar'] = $this->load->view("template/sidebar_investor", $data, TRUE);
		$data['content'] = $this->load->view("proyeksi_pasar_sekunder", $data, TRUE);
		$this->load->view('index', $data);
  }

	    function daftarBank(){

	    	$curl = curl_init();
	    	curl_setopt($curl, CURLOPT_URL, 'https://app.moota.co/api/v1/bank');
	    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	    		'Accept: application/json',
	    		'Authorization: Bearer 0Z7LKYxWkSijHQs0HmdtkalIQtcOTRiKdxZjW08PBaFuVa81nM'
	    	]);
	    	$response = curl_exec($curl);

	    	$convert = json_decode($response);
	    	$data = $convert->data;

		//var_dump($data[0]->username);
	    }

	    function cekMutasi(){

	    	$jumlah =$this->input->post("nominal");

	    	$curl = curl_init();
	    	curl_setopt($curl, CURLOPT_URL, 'https://app.moota.co/api/v1/bank/DlVW1MyrWxL/mutation/recent/10');
	    	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	    	curl_setopt($curl, CURLOPT_HTTPHEADER, [
	    		'Accept: application/json',
	    		'Authorization: Bearer 0Z7LKYxWkSijHQs0HmdtkalIQtcOTRiKdxZjW08PBaFuVa81nM'
	    	]);
	    	$response = curl_exec($curl);

	    	var_dump($response);

	    	$convert = json_decode($response);

	    	foreach($convert as $val){
	    		if($val->amount == $jumlah){

	    			$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    				"type_dana"=>"tambah",
	    				"jumlah_dana"=>$val->amount,
	    			);

				 //cek pernah atau blum di proses
	    			$cek =$this->m_invest->dataDanaCek($whd)->num_rows();

	    			if($cek>0){

						//get last saldo
	    				$dana=$this->m_invest->dataDana($whd)->row()->saldo;

	    				$date = date('Y-m-d H:i:s');

	    				$data=array(
	    					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    					"id_bank"=>$this->session->userdata("invest_bank"),
	    					"jumlah_dana"=>$jumlah,
	    					"type_dana"=>"tambah",
	    					"status_approve"=>"approve",
	    					"createddate"=>$date
	    				);
	    				$this->m_invest->insertdata("trx_dana",$data);
	    				$dana = $dana+$jumlah;
	    				$this->session->set_userdata("invest_dana",$dana);
						//$res=array("hasil"=>"Sukses","act"=>"Tarik Dana");
	    				$msg='Deposit Dana Berhasil, sebesar Rp. '.number_format($jumlah,0,".",".").' pada tanggal '.$date;
	    				$res['msg'] = '<p class="box-msg">
	    				<div class="info-box alert-success">
	    				<div class="info-box-icon">
	    				<i class="fa fa-check-circle"></i>
	    				</div>
	    				<div class="info-box-content" style="font-size:20px">
	    				'.$msg.'</div>
	    				</div>
	    				</p>';
	    				$this->session->set_flashdata($res);
	    				$dtp=array(
	    					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    					"pesan"=>$msg,
	    					"createddate"=>$date
	    				);
	    				$this->m_invest->insertdata("tbl_pesan",$dtp);


	    				echo "success";


	    			}else{
	    				echo "failed";
	    			}
	    			break;
	    		}
	    	}

	    	echo "failed";

	    }

	    public function tarikDana(){
	    	$otp=$this->input->post("otp");
	    	$jumlah_tarik=$this->input->post("nominal");

	    	$checkOtp = $this->m_invest->checkOtp(array('otp' => $otp, 'otp_exp >= ' => date('Y-m-d H:i:s')));

	    	if($checkOtp > 0){

	    		$this->m_invest->updatedata('tbl_admin', array('otp' => NULL, 'otp_exp' => NULL), array('email' => $this->session->userdata('invest_email')));

			//get last saldo
			$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna")); // ,"a.id_bank"=>$this->session->userdata("invest_bank"));

			$dana=$this->m_invest->dataDana($whd)->row()->saldo;

			$date = date('Y-m-d H:i:s');

			$data=array(
				"id_dana"=>date('YmdHis'),
				"id_pengguna"=>$this->session->userdata("invest_pengguna"),
				"id_bank"=>$this->session->userdata("invest_bank"),
				"jumlah_dana"=>$jumlah_tarik,
				"type_dana"=>"tarik",
				"status_approve"=>"pending",
				"createddate"=>$date
			);
			$this->m_invest->insertdata("trx_dana",$data);
			$dana = $dana-$jumlah_tarik;

			$this->m_invest->updatedata('trx_dana_saldo', array('saldo' => $dana), array('id_pengguna' => $this->session->userdata('invest_pengguna')));

			$this->session->set_userdata("invest_dana",$dana);
			//$res=array("hasil"=>"Sukses","act"=>"Tarik Dana");
			$msg='Penarikan Dana Berhasil, sebesar Rp. '.number_format($jumlah_tarik,0,".",".").' pada tanggal '.$date;
			$res['msg'] = '<p class="box-msg">
			<div class="info-box alert-success">
			<div class="info-box-icon">
			<i class="fa fa-check-circle"></i>
			</div>
			<div class="info-box-content" style="font-size:20px">
			'.$msg.'</div>
			</div>
			</p>';
			$this->session->set_flashdata($res);
			$dtp=array(
				"id_pengguna"=>$this->session->userdata("invest_pengguna"),
				"pesan"=>$msg,
				"createddate"=>$date
			);
			$this->m_invest->insertdata("tbl_pesan",$dtp);

			echo "success";


		}else{
			echo "failed";
		}
	}

	public function kirimotp()
	{
		$otp = rand(1000, 9999);
		$otp_exp = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . '+ 30 second'));
		$this->m_invest->updatedata('tbl_admin', array('otp' => $otp, 'otp_exp' => $otp_exp), array('email' => $this->session->userdata('invest_email')));

		$title="OTP";
		$data['mailtitle'] = $title;
		$data['email'] = $this->session->userdata("invest_email");
		$data['otp'] = $otp;
		$data['mailformat'] = $this->input->post("format");
		$content = $this->load->view('template/v-mail-format-otp',$data,TRUE);
		$send = $this->m_invest->kirimEmailnya($data['email'],$content);

		if ($send == "success") {
			echo "success";
		} else {
			echo "failed";
		}
	}

	// function kirimotp(){
	// 	$notelp = "62".$this->session->userdata("invest_hp");
	// 	if($notelp !=""){
	// 		$fourRandomDigit = "1234"; // mt_rand(1000,9999);
	//
	// 		$arraydata = array(
  //               'otp'  => $fourRandomDigit
	// 		);
	// 		$this->session->set_userdata($arraydata);
	//
	//
	// 		$userkey = '604gbs';
	// 		$passkey = 'b26656279603bcbbce51fe64';
	// 		$telepon = $notelp;
	// 		$message = '[Pendana Usaha] Berikut adalah kode OTP '.$fourRandomDigit;
	// 		$url = 'https://gsm.zenziva.net/api/sendsms/';
	// 		$curlHandle = curl_init();
	// 		curl_setopt($curlHandle, CURLOPT_URL, $url);
	// 		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
	// 		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
	// 		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
	// 		curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
	// 		curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
	// 		curl_setopt($curlHandle, CURLOPT_POST, 1);
	// 		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
	// 			'userkey' => $userkey,
	// 			'passkey' => $passkey,
	// 			'nohp' => $telepon,
	// 			'pesan' => $message
	// 		));
	// 		$results = json_decode(curl_exec($curlHandle), true);
	// 		curl_close($curlHandle);
	//
	// 		echo "success";
	// 	}else{
	// 		echo "failed";
	// 	}
	// }

	public function dana_anda(){
		if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
			if($this->session->userdata("invest_status")=="aktif"){
				$data=array();
				$data['data_produk']=$this->m_invest->dataProduk();
				$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna")); // ,"a.id_bank"=>$this->session->userdata("invest_bank"));

				$data['dana']=$this->m_invest->dataDana($whd);

				$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
				$data['danadtl']=$this->m_invest->dataDanaHistoryTransaksi2($whd);

				$whd['type_dana'] = "tarik";
				$whd['status_approve'] = "approve";
				$data['totalDanaTarik']=$this->m_invest->dataDanaHistory($whd);

				$whd['type_dana'] = "tambah";
				$data['totalDanaDeposit']=$this->m_invest->dataDanaHistory($whd);

				$data['confirmation'] = $this->db->query("SELECT
						a.*
					FROM trx_konfirmasi_pembayaran a
					JOIN trx_dana b ON a.id_transaksi = b.id
					WHERE b.id_pengguna = {$this->session->userdata("invest_pengguna")}")->result();

				$data['content']=$this->load->view("dana-anda", $data, TRUE);

				$this->load->view('index',$data);
			} else {
				$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
				$this->session->set_flashdata($result);
				redirect("invest/result");
			}
		} else {
			redirect("invest");
		}
	}
	public function dokumen_saya(){
		if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
			$data=array();
			$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
			$data['content']=$this->load->view("dokumen-saya", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}
	public function laporan_saya(){
		if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
			$data=array();
			$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
			$data['content']=$this->load->view("laporan-saya", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest");
		}
	}
	public function proyeksi(){
		//if($this->checkRole()=="investor"){
		$data=array();
		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
		$data['content']=$this->load->view("proyeksi", $data, TRUE);
		$this->load->view('index',$data);
	    /* } else {
	        redirect("invest");
	      } */
	    }

	    public function jual($url) {
	    	$data = [];
	    	$wh = ["siteurl" => $url];
		// $wh['p.status_approve'] = "approve";
		// $wh = array("status_approve" => "approve");
	    	$whi = [
	    		"p.status_approve" => array("approve", "complete", "invest", "running"),
	    		"p.siteurl" => $url
	    	];

	    	$produk = $this->m_invest->dataProduk("", "", "", $whi);

	    	if($produk->num_rows() > 0){
	    		$wh['p.status_approve'] = "approve";
	    		$idp = "";

	    		if($this->session->userdata("invest_pengguna") != "") {
	    			$idp = $this->session->userdata("invest_pengguna");
	    		}

	    		if($this->input->get('type') == 'sekunder') {
	    			$data['data_produk']=$this->m_invest->dataProdukSekunder("", "", $idp, $whi);
	    		} else {
	    			$data['data_produk']=$this->m_invest->dataProduk("", "", $idp, $whi);
	    		}

	    		$wh2['status_approve'] = "approve";
	    		$wh2['id_produk'] = $data['data_produk']->row()->id_produk;
	    		$data['total_invest'] = $this->m_invest->dataTotalinvest($wh2)->row();
	    		$data['total_investor'] = $this->m_invest->dataTotalinvestor($wh2)->num_rows();

	    		$whi = ["id_pengguna" => $this->session->userdata("invest_pengguna")];
	    		$data['saldo'] = $this->m_invest->dataDana($whi)->row();

	    		$whd=array(
	    			"i.id_pengguna"=>$this->session->userdata("invest_pengguna") ,
	    			"p.siteurl"=>$url
	    		);
	    		$data['data_produk_investor'] =$this->m_invest->dataDanaInvest($whd)->row();

	    		$whsaham['id_produk'] = !empty($data['data_produk_investor']->id_produk) ? $data['data_produk_investor']->id_produk : 0;
	    		$whsaham['id_pengguna'] = $idp;
	    		$whsaham["status_approve != 'refuse'"] = null;
				//get lembar saham jual
	    		$data['data_produk_saham_jual'] = $this->m_invest->dataTotalinvestJual($whsaham)->row();

				//get lembar saham gadai
	    		$whsaham['status_approve'] = "approve";
	    		$data['data_produk_saham_gadai'] = $this->m_invest->dataTotalinvestGadai($whsaham)->row();

				//get lembar saham
	    		$data['data_produk_saham'] = $this->m_invest->dataTotalinvest($whsaham)->row();

	    		$data['url']=$url;
	    		$data['msg']="";
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		if($this->input->get('type') == 'sekunder'){
	    			$data['content']=$this->load->view("jual_sekunder", $data, TRUE);
	    		} else {
	    			$data['content']=$this->load->view("jual", $data, TRUE);
	    		}
	    		$this->load->view('index',$data);
	    	} else {
	    		if($this->session->userdata("invest_status")=="tidak aktif"){
	    			$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
	    			$this->session->set_flashdata($result);
	    			redirect("invest/result");
	    		} else {
	    			redirect("invest");
	    		}
	    	}
	    }

	    public function gadai($url){
	    	$data=array();
	    	$wh=array("siteurl"=>$url);
			//$wh['p.status_approve']="approve";
			//$wh=array("status_approve"=>"approve");
	    	$whi=array("p.status_approve"=>array("approve","complete","invest","running"),
	    		"p.siteurl"=>$url
	    	);
	    	$produk=$this->m_invest->dataProduk("","","",$whi);
	    	if($produk->num_rows()>0){
	    		$wh['p.status_approve']="approve";
	    		$idp="";
	    		if($this->session->userdata("invest_pengguna")!=""){
	    			$idp=$this->session->userdata("invest_pengguna");
	    		}
	    		$data['data_produk']=$this->m_invest->dataProduk("","",$idp,$whi);

	    		$wh2['status_approve']="approve";
	    		$wh2['id_produk']=$data['data_produk']->row()->id_produk;
	    		$data['total_invest']=$this->m_invest->dataTotalinvest($wh2)->row();
	    		$data['total_investor']=$this->m_invest->dataTotalinvestor($wh2)->num_rows();
	    		$whi=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['saldo']= $this->m_invest->dataDana($whi)->row();

	    		$whd=array(
	    			"i.id_pengguna"=>$this->session->userdata("invest_pengguna") ,
	    			"p.siteurl"=>$url
	    		);
	    		$data['data_produk_investor'] =$this->m_invest->dataDanaInvest($whd)->row();

				//get lembar saham
	    		$whsaham['id_produk'] = $data['data_produk_investor']->id_produk;
	    		$whsaham['id_pengguna'] = $idp;
	    		$data['data_produk_saham'] = $this->m_invest->dataTotalinvest($whsaham)->row();

				//get lembar saham jual
	    		$data['data_produk_saham_jual'] = $this->m_invest->dataTotalinvestJual($whsaham)->row();

				//get lembar saham gadai
	    		$whsaham['status_approve'] = "approve";
	    		$data['data_produk_saham_gadai'] = $this->m_invest->dataTotalinvestGadai($whsaham)->row();


	    		$data['url']=$url;
	    		$data['msg']="";
	    		$data['content']=$this->load->view("gadai", $data, TRUE);
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		if($this->session->userdata("invest_status")=="tidak aktif"){
	    			$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
	    			$this->session->set_flashdata($result);
	    			redirect("invest/result");
	    		} else {
	    			redirect("invest");
	    		}
	    	}
	    }

	    public function laporanhistory($id){

	    	$data=array();

	    	$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    	$data['laporanbisnis']=$this->m_invest->dataLaporanDanaHistory($whd, $id);

		//get bisnis
	    	$data['bisnis'] = $this->db->query("select * from trx_produk where id_produk=".$id)->row();

	    	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    	$data['content']=$this->load->view("laporan-history", $data, TRUE);
	    	$this->load->view('index',$data);

	    }

	    public function laporanbisnis($id){

	    	$data=array();

	    	$whd=array("share.id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    		"share.id_produk"=>$id);
	    	$data['laporanbisnis']=$this->m_invest->dataDanaShare($whd);
	    	// var_dump($this->db->last_query());die();
		//get bisnis
	    	$data['bisnis'] = $this->db->query("select * from trx_produk where id_produk=".$id)->row();

	    	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    	$data['content']=$this->load->view("laporan-bisnis", $data, TRUE);
	    	$this->load->view('index',$data);

	    }

	    public function laporangadai($id){
	    	$data=array();

	    	$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    		"id_produk"=>$id);
	    	$data['laporanbisnis']=$this->m_invest->dataDanaShareGadai($whd);
	    	$data['id_produk']=$id;

		//get bisnis
	    	$data['bisnis'] = $this->db->query("select * from trx_produk where id_produk=".$id)->row();

	    	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    	$data['content']=$this->load->view("laporan-gadai", $data, TRUE);
	    	$this->load->view('index',$data);

	    }

	    public function laporanjual($id){

	    	$data=array();

	    	$whd=array("id_pengguna"=>$this->session->userdata("invest_pengguna"),
	    		"id_produk"=>$id);
	    	$data['laporanbisnis']=$this->m_invest->dataDanaShareJual($whd);

		//get bisnis
	    	$data['bisnis'] = $this->db->query("select * from trx_produk where id_produk=".$id)->row();

	    	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    	$data['content']=$this->load->view("laporan-jual", $data, TRUE);
	    	$this->load->view('index',$data);

	    }

	    public function erups(){
		//if($this->checkRole()=="investor"){
				$portfolio = $this->m_invest->getPortfolio($this->session->userdata("invest_pengguna"))->result();
				foreach ($portfolio as $index => $item) {
					$id_produk[] = $item->id_produk;
				}
	    	$data=array();
	    	$whd=array("trx_dana_invest.id_pengguna"=>$this->session->userdata("invest_pengguna"), 'trx_dana_invest.id_produk IN ('.implode(',', $id_produk).')' => null);
	    	$data['dataerups']=$this->m_invest->dataerups($whd);
// var_dump($this->db->last_query());die();
	    	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    	$data['content']=$this->load->view("erups", $data, TRUE);
	    	$this->load->view('index',$data);
	    /* } else {
	        redirect("invest");
	      } */
	    }

	    public function prosesvote($idvote){
	 	/**
	 	 * Get User Device
	 	 * Output: User Device berdasarkan informasi User Agent
	 	 */

	 	$this->load->library('user_agent');
	 	if ($this->agent->is_browser()) {
	 		$agent = $this->agent->browser().' '.$this->agent->version();
	 	} elseif ($this->agent->is_robot()) {
	 		$agent = $this->agent->robot();
	 	} elseif ($this->agent->is_mobile()) {
	 		$agent = $this->agent->mobile();
	 	} else {
	 		$agent = 'Unidentified User Agent';
	 	}

	 	if (isset($_SERVER['HTTP_CLIENT_IP']))
	 		$_IP_ADDRESS = $_SERVER['HTTP_CLIENT_IP'];
	 	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	 		$_IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED_FOR'];
	 	else if(isset($_SERVER['HTTP_X_FORWARDED']))
	 		$_IP_ADDRESS = $_SERVER['HTTP_X_FORWARDED'];
	 	else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	 		$_IP_ADDRESS = $_SERVER['HTTP_FORWARDED_FOR'];
	 	else if(isset($_SERVER['HTTP_FORWARDED']))
	 		$_IP_ADDRESS = $_SERVER['HTTP_FORWARDED'];
	 	else if(isset($_SERVER['REMOTE_ADDR']))
	 		$_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
	 	else
	 		$_IP_ADDRESS = 'UNKNOWN';

	 	$macCommandString   =   "arp " . $_IP_ADDRESS . " | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'";

	 	$mac_address = exec($macCommandString);

	 	$locByIPinfo = json_decode(file_get_contents("http://ipinfo.io/"));
	 	$coordinates = explode(',', $locByIPinfo->loc);

	 	/**
	 	 * Get User Coordinates
	 	 * Output: User Location berdasarkan Public IP Address
	 	 */

		// $locByIPinfo = json_decode(file_get_contents("http://ipinfo.io/"));
		// $coordinates = explode(",", $locByIPinfo->loc);

	 	/**
	 	 * Get User MAC Address
	 	 * Output IP Address Device Client
	 	 */

		// $_IP_ADDRESS = '192.168.43.1'; // Bekas uji coba
		// $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; // Baca IP Address Device Client

		// $checkIP = file_get_contents('http://checkip.dyndns.com/');
		// preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $checkIP, $data);
		// $_IP_ADDRESS = $data[1]; // Alternatif baca IP Address Device Client

		// $_COMMAND = "arp -a $_IP_ADDRESS";
		// ob_start();
		// system($_COMMAND);
		// $_RESULT = ob_get_contents();
		// ob_clean();
		// $_SPLIT = strstr($_RESULT, $_IP_ADDRESS);
		// if($_SPLIT === false){
		// 	$_RESULT = 'Unidentified';
		// } else {
		// 	$_SPLIT_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_SPLIT));
		// 	$_RESULT = substr($_SPLIT_STRING[1], 3, 17);
		// }
		// $mac_address = $_RESULT;

		//insert vote
	 	$data=array(
	 		"id_pengguna"=>$this->session->userdata("invest_pengguna"),
	 		"id_vote"=>$idvote,
	 		"jawaban"=>$_GET['opsi'],
	 		"createddate"=>date('Y-m-d H:i:s'),

	 		'device' => !empty($this->agent->platform()) ? $this->agent->platform() : 'Unidentified',
				// 'ip_address' => $this->input->ip_address(),
	 		'ip_address' => $_IP_ADDRESS,
	 		'mac_address' => $mac_address,
	 		'lat' => $coordinates[0],
	 		'lon' => $coordinates[1]
	 	);

	 	$this->m_invest->insertdata("tbl_vote_pengguna",$data);

	 	redirect("investor/evote");
	 }

	 public function evote(){
		//if($this->checkRole()=="investor"){
	 	$portfolio = $this->m_invest->getPortfolio($this->session->userdata("invest_pengguna"))->result();
	 	foreach ($portfolio as $index => $item) {
	 		$id_produk[] = $item->id_produk;
	 	}

	 	$data=array();
	 	$whd = array(
	 		"trx_dana_invest.id_pengguna" => $this->session->userdata("invest_pengguna"),
	 		"trx_dana_invest.status_approve" => 'approve',
	 		"trx_dana_invest.id_produk IN (".implode(',', $id_produk).")" => null
	 	);
	 	$data['dataevote']=$this->m_invest->dataevote($whd);
	 	// var_dump($this->db->last_query());die();
	 	$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	 	$data['content']=$this->load->view("evote", $data, TRUE);
	 	$this->load->view('index',$data);
    /* } else {
        redirect("invest");
      } */
    }
	//pdf perjanjian
	    function pdf_perjanjiananggota(){
	    	tcpdf();
	    	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    	$obj_pdf->SetCreator(PDF_CREATOR);
	    	$title = "";
	    	$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	    	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	    	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    	$obj_pdf->SetFont('helvetica', '', 9);
	    	$obj_pdf->setFontSubsetting(false);
	    	$obj_pdf->AddPage();
	    	ob_start();
			// we can have any view part here like HTML, PHP etc
	    	$content = $this->load->view('draft_perjanjiananggota', null,true);
	    	ob_end_clean();
	    	$obj_pdf->writeHTML($content, true, false, true, false, '');
	    	$obj_pdf->Output('output1.pdf', 'I');

	    }

	    function pdf_perjanjianpinjaman(){
	    	tcpdf();
	    	$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	    	$obj_pdf->SetCreator(PDF_CREATOR);
	    	$title = "PDF Report";
	    	$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	    	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	    	$obj_pdf->SetDefaultMonospacedFont('helvetica');
	    	$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	    	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	    	$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	    	$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	    	$obj_pdf->SetFont('helvetica', '', 9);
	    	$obj_pdf->setFontSubsetting(false);
	    	$obj_pdf->AddPage();
	    	ob_start();
			// we can have any view part here like HTML, PHP etc
	    	$content = $this->load->view('draft_perjanjianpinjaman', null,true);
	    	ob_end_clean();
	    	$obj_pdf->writeHTML($content, true, false, true, false, '');
	    	$obj_pdf->Output('output2.pdf', 'I');

	    }

	//perjanjian anggota
	    public function perjanjiananggota(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_pengguna']=$this->m_invest->dataPengguna($wh);

	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("perjanjiananggota", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }

	    public function perjanjianpinjaman(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_pengguna']=$this->m_invest->dataPengguna($wh);

	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("perjanjianpinjaman", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }

	    public function agreement(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh = array("d.id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_foto']=$this->m_invest->dataDokumen($wh);
	    		if($data['data_foto'] == null){
	    			$data=array(
	    				"id_pengguna" =>$this->session->userdata("invest_pengguna"),
	    				"foto_ktp"      =>'',
	    				"foto_npwp"     =>'',
	    				"foto_sim"      =>'',
	    				"foto_bpjs"     =>'',
	    				"foto_slipgaji" =>''
	    			);
	    			$this->m_invest->insertdata("tbl_dokumen",$data);

	    			$data['data_foto']=$this->m_invest->dataDokumen($wh);
	    		}
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("agreement", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }

	//my document upload
	    public function proses_agreement(){
	    	$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));

	    	$data=array();
	    	$datauser=array();
	    	$out=array();

		//foto ktp
	    	if (isset($_FILES['ttd']['name']) && $_FILES['ttd']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['ttd']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/ttd/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('ttd');
	    		$data['ttd']=$filename;
	    		$data['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$data,$wh);
	    	}

		//foto ktp
	    	if (isset($_FILES['foto_ktp']['name']) && $_FILES['foto_ktp']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['foto_ktp']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/dokumen/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('foto_ktp');
	    		$data["foto_ktp"] = $filename;
	    		$this->m_invest->updatedata("tbl_dokumen",$data,$wh);

	    		$datauser['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$datauser,$wh);
	    	}
		//foto npwp
	    	if (isset($_FILES['foto_npwp']['name']) && $_FILES['foto_npwp']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['foto_npwp']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/dokumen/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('foto_npwp');
	    		$data["foto_npwp"] = $filename;
	    		$this->m_invest->updatedata("tbl_dokumen",$data,$wh);

	    		$datauser['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$datauser,$wh);
	    	}

		//foto bpjs
	    	if (isset($_FILES['foto_bpjs']['name']) && $_FILES['foto_bpjs']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['foto_bpjs']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/dokumen/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('foto_bpjs');
	    		$data["foto_bpjs"] = $filename;
	    		$this->m_invest->updatedata("tbl_dokumen",$data,$wh);

	    		$datauser['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$datauser,$wh);
	    	}
		//foto sim
	    	if (isset($_FILES['foto_sim']['name']) && $_FILES['foto_sim']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['foto_sim']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/dokumen/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('foto_sim');
	    		$data["foto_sim"] = $filename;
	    		$this->m_invest->updatedata("tbl_dokumen",$data,$wh);

	    		$datauser['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$datauser,$wh);
	    	}

		//foto slip gaji
	    	if (isset($_FILES['foto_slipgaji']['name']) && $_FILES['foto_slipgaji']['name'] != '') {
	    		$filename = str_replace(' ', '_', $_FILES['foto_slipgaji']['name']);
	    		$filename = str_replace('(', '', $filename);
	    		$filename = str_replace(')', '', $filename);


	    		$config['upload_path']          = 'assets/img/dokumen/';
	    		$config['allowed_types']        = 'gif|jpg|png';
	    		$config['file_name']        = $filename;
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
			//upload execute
	    		$this->upload->do_upload('foto_slipgaji');
	    		$data["foto_slipgaji"] = $filename;
	    		$this->m_invest->updatedata("tbl_dokumen",$data,$wh);

	    		$datauser['verif']=1;
	    		$this->m_invest->updatedata("tbl_pengguna",$datauser,$wh);
	    	}


	    	$out['status'] = '';
	    	$out['msg'] = '<p class="box-msg">
	    	<div class="info-box alert-success">
	    	<div class="info-box-icon">
	    	<i class="fa fa-check-circle"></i>
	    	</div>
	    	<div class="info-box-content" style="font-size:20px">
	    	Data Dokumen Berhasil Ditambahkan</div>
	    	</div>
	    	</p>';




		//print_r($out);

	    	$this->session->set_flashdata('msg', $out['msg']);
	    	redirect("investor/agreement");
	    }

	//delete foto
	    public function delete_agreement($jenis){
	    	$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));

	    	$data=array(
	    		$jenis     =>''
	    	);
	    	$out=array();
	    	$out['status'] = '';
	    	$out['msg'] = '<p class="box-msg">
	    	<div class="info-box alert-success">
	    	<div class="info-box-icon">
	    	<i class="fa fa-check-circle"></i>
	    	</div>
	    	<div class="info-box-content" style="font-size:20px">
	    	Data Dokumen Berhasil Dihapus</div>
	    	</div>
	    	</p>';

	    	$this->m_invest->updatedata("tbl_dokumen",$data,$wh);
	    	$this->session->set_flashdata('msg', $out['msg']);
	    	redirect("investor/agreement");
	    }
	//delete ttd
	    public function delete_ttd(){
	    	$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));

	    	$data=array(
	    		"ttd" =>''
	    	);
	    	$out=array();
	    	$out['status'] = '';
	    	$out['msg'] = '<p class="box-msg">
	    	<div class="info-box alert-success">
	    	<div class="info-box-icon">
	    	<i class="fa fa-check-circle"></i>
	    	</div>
	    	<div class="info-box-content" style="font-size:20px">
	    	Data Dokumen Berhasil Dihapus</div>
	    	</div>
	    	</p>';

	    	$this->m_invest->updatedata("tbl_pengguna",$data,$wh);
	    	$this->session->set_flashdata('msg', $out['msg']);
	    	redirect("investor/agreement");
	    }

	    public function invest($url){
	    	if($this->checkRole()=="investor"){
	    		$data=array();
	    		$wh=array("siteurl"=>$url);
	    		$produk=$this->m_invest->dataProduk($wh);
	    		if($produk->num_rows()>0){
	    			$data['data_produk']=$this->m_invest->dataProduk($wh);
	    			$data['content']=$this->load->view("invest", $data, TRUE);
	    			$this->load->view('index',$data);
	    		} else {
	    			redirect("investor");
	    		}
	    	} else {
	    		redirect("invest/login");
	    	}
	    }
	    public function my_invest(){
	    	if($this->checkRole()=="investor"){
	    		$data=array();
	    		$data['data_produk']=$this->m_invest->dataProduk();
	    		$data['content']=$this->load->view("my_invest", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function home(){
	    	if($this->checkRole()=="investor"){
	    		$data=array();
	    		$data['data_produk']=$this->m_invest->dataProduk();
	    		$data['content']=$this->load->view("home", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function detail($url){
	    	if($this->checkRole()=="investor"){
	    		$data=array();
	    		$wh=array("p.siteurl"=>$url);
	    		$produk=$this->m_invest->dataProduk($wh);
	    		if($produk->num_rows()>0){
	    			$data['data_produk']=$this->m_invest->dataProduk($wh);

	    			$data['content']=$this->load->view("detail", $data, TRUE);
	    			$this->load->view('index',$data);
	    		} else {
	    			redirect("invest");
	    		}

	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function bank_account(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_bank']=$this->m_invest->dataBank($wh);
	    		$data['mbank']=$this->m_invest->dataBanks();
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("investor/my-bank", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function add_bank(){
	    	if($this->checkRole()=="investor"){
	    		$data['content']=$this->load->view("investor/my-bank-add", null, TRUE);
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function proses_add_bank(){
	    }
	    public function edit_bank($id){
	    	if($this->checkRole()=="investor"){
	    		$wh=array("id_bank_pengguna"=>$id);
	    		$data['bank_user']=$this->m_invest->dataBank($wh);
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("investor/my-bank-edit", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function proses_edit_bank(){
	    	$wh = array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    	$bank_user=$this->m_invest->dataBank($wh);
	    	$data=array(
	    		"nama_akun"=>$this->input->post("nama_akun"),
	    		"no_rek"=>$this->input->post("no_rek"),
	    		"bank"=>$this->input->post("bank"),
	    		"createddate"=>date("Y-m-d H:i:s")
	    	);
	    	if($bank_user->num_rows()>0){
	    		$this->m_invest->updatedata("tbl_bank_pengguna",$data,$wh);
	    	} else {
	    		$data['id_pengguna']=$this->session->userdata("invest_pengguna");
	    		$this->m_invest->insertdata("tbl_bank_pengguna",$data);
	    	}
	    	$result=array("result"=>"success","msg"=>"Sukses");
	    	$this->session->set_flashdata($result);
	    	redirect("investor/bank_account");
	    }
	    public function delete_bank($id){
	    	if($this->checkRole()=="investor"){
	    		$wh=array("id_bank_pengguna"=>$id);
	    		$data['bank_user']=$this->m_invest->dataBank($wh);
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("investor/my-bank-delete", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }
	    public function proses_delete_bank(){
	    }
	    public function checkRole(){
	    	$role="";
	    	if($this->session->userdata("invest_username")!="" && $this->session->userdata("invest_email")!=""){
	    		$role=$this->session->userdata("invest_tipe");
	    	} else {
	    		$role="user";
	    	}
	    	return $role;
	    }


	//kode referal
	    public function kode_referral(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_referral']=$this->m_invest->dataReferral($wh);
	    		$wh=array("a.kode_referral"=>$data['data_referral']->kode_referral);
	    		$data['list_referral']=$this->m_invest->listReferral($wh);
	    		$data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
	    		$data['content']=$this->load->view("investor/my-referral", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }

	//pesan
	    public function pesan(){
	    	if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	    		$data=array();
	    		$wh=array("a.id_pengguna"=>$this->session->userdata("invest_pengguna"));
	    		$data['data_pesan']=$this->m_invest->dataPesan($wh);

	    		$data['content']=$this->load->view("investor/my-message", $data, TRUE);
	    		$this->load->view('index',$data);
	    	} else {
	    		redirect("invest");
	    	}
	    }

	  }
