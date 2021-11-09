<?php
/*
4811 1111 1111 1114
https://investpro.mynimstudio.id/payment/finish?order_id=5da5ea18eb44a&status_code=200&transaction_status=capture
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
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
        $helper=array("url","cookie");
        $this->load->helper($helper);
        $this->load->model('m_invest');
        $this->load->library("session");
		$wh=array("modul"=>"midtrans");
		$midtrans = $this->m_invest->refferal_setting($wh)->row();
		$val = json_decode($midtrans->value);
        //$params = array('server_key' => 'SB-Mid-server-yhZPMffxn038Xfln9rcSWTOH', 'production' => false);
		$production=$val->production=="true"?true:false;
		$params = array('server_key' => $val->server_key, 'production' => $production);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
    }
	public function index(){
	    if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
    	    $data=array();
    	    $data['data_produk']=$this->m_invest->dataProduk();
    	    $data['content']=$this->load->view("home", $data, TRUE);
    		$this->load->view('index',$data);
	    }
	}
	public function notif(){
	    $var=json_decode($this->session->userdata('Transaksi'));
		echo "<pre>";
	    print_r($_POST);
	    print_r($_GET);
	    print_r($var);
	    echo "</pre>"; 
	    $res=array("hasil"=>"Gagal","act"=>$var);
		/*
		pending,settlement,capture,expire
		*/
		/* $arrmasuk=array("pending","settlement","capture");
		$status = $_POST['transaction_status'];
		$gross_amount=exlpode(".",$_POST['gross_amount']);
		$date=date("Y-m-d H:i:s");
	    if($_POST['status_code']==200 && in_array($status,$arrmasuk)){
			$sts=$status=="pending"?$status:"approve";
			$orderid=explode("|",$_POST['transaction_status']);
	        if($orderid[1]=="tambahdana" && $sts=="approve"){
	             $data=array(
        	        "id_pengguna"=>$orderid[2],
        	        "id_bank"=>$orderid[3],
        	        "jumlah_dana"=>$gross_amount[0],
					"type_dana"=>"tambah",
					"status_approve"=>$sts,
        	        "createddate"=>$date
        	    );
    	        $this->m_invest->insertdata("trx_dana",$data); 
	        } else if($orderid[1]=="investdana" && $sts!="pending"){
	            $data=array(
        	        "id_pengguna"=>$orderid[2],
        	        "id_produk"=>$orderid[4],
        	        "jumlah_dana"=>$gross_amount[0],
        	        "createddate"=>$date
        	    );
        	    $this->m_invest->insertdata("trx_dana_invest",$data); 
	        } else {
				$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal");
			}
	    } else {
			$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal");
		}
	    $this->session->set_flashdata($res); */
	}
	public function finish(){
	    $var=json_decode($this->session->userdata('Transaksi'));
	   /* echo "<pre>";
	    print_r($_POST);
	    print_r($_GET);
	    print_r($var);
	    echo "</pre>"; */
	    $res=array("hasil"=>"Gagal","act"=>$var);
		/*
		pending,settlement,capture,expire
		*/
		$arrmasuk=array("pending","settlement","capture");
		$status = $_GET['transaction_status'];
		$date=date("Y-m-d H:i:s");
	    if(in_array($status,$arrmasuk)){
			$sts=$status=="pending"?$status:"approve";
	        if($var->action=="tambahdana"){
				$data=array(
        	        "id_pengguna"=>$this->session->userdata("invest_pengguna"),
        	        "id_bank"=>$this->session->userdata("invest_bank"),
        	        "jumlah_dana"=>$var->transaction_details->gross_amount,
					"type_dana"=>"tambah",
					"status_approve"=>$sts,
        	        "createddate"=>$date
        	    );
    	        $this->m_invest->insertdata("trx_dana",$data);
				
				$dana = $this->session->userdata("invest_dana")+$var->transaction_details->gross_amount;
    	        $this->session->set_userdata("invest_dana",$dana);
				$msg="Penambahan Dana Sukses, sebesar Rp. ".number_format($var->transaction_details->gross_amount,0,".",".")." pada tanggal ".$date;
				$dtp=array(
					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
					"pesan"=>$msg,
					"createddate"=>$date
				);
				$this->m_invest->insertdata("tbl_pesan",$dtp);
    	        $res=array("hasil"=>"Sukses","act"=>"Penambahan Dana","jumlah"=>$var->transaction_details->gross_amount,"tanggal"=>$date);
	        } else if($var->action=="investdana" && $sts!="pending"){
				$data=array(
        	        "id_pengguna"=>$$this->session->userdata("invest_pengguna"),
        	        "id_produk"=>$var->transaction_details->id_produk,
        	        "jumlah_dana"=>$var->transaction_details->gross_amount,
        	        "createddate"=>$date
        	    );
        	    $this->m_invest->insertdata("trx_dana_invest",$data);
        	    $dana = $this->session->userdata("invest_dana")-$var->transaction_details->gross_amount;
				$msg="Invest Dana Sukses, sebesar Rp. ".number_format($var->transaction_details->gross_amount,0,".",".")." pada tanggal ".$date;
				$dtp=array(
					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
					"pesan"=>$msg,
					"createddate"=>$date
				);
				$this->m_invest->insertdata("tbl_pesan",$dtp);
    	        $res=array("hasil"=>"Sukses","act"=>"Invest Dana","jumlah"=>$var->transaction_details->gross_amount,"tanggal"=>$date);
	        } else {
				$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal");
			}
	    } else {
			$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal");
		}
	    $this->session->set_flashdata($res);
	    redirect("invest/investresult");
	}
	public function unfinish(){
	    echo "<pre>";
	    print_r($_POST);
	    print_r($_GET);
	    echo "</pre>";
		$status = $_GET['transaction_status'];
		$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal, ".$status);
		$this->session->set_flashdata($res);
	    redirect("invest/investresult");
	}
	public function error(){
	    echo "<pre>";
	    print_r($_POST);
	    print_r($_GET);
	    echo "</pre>";
		$status = $_GET['transaction_status'];
		$res=array("hasil"=>"Gagal","act"=>"Transaksi Gagal".$status);
		$this->session->set_flashdata($res);
	    redirect("invest/investresult");
	}
	
	public function signature($data){
	    
      $orderId = $data['orderId'];// "1111";
      $statusCode = $data['statusCode'];// "200";
      $grossAmount = $data['grossAmount'];// "100000.00";
      $serverKey = $data['serverKey'];// "askvnoibnosifnboseofinbofinfgbiufglnbfg";
      $input = $orderId.$statusCode.$grossAmount.$serverKey;
      $signature = openssl_digest($input, 'sha512');
      //echo "INPUT: " , $input."<br/>";
      //echo "SIGNATURE: " , $signature;
        return $signature;
	}
}
?>