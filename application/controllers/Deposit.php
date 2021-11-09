<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Deposit extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_deposit');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
		
		$this->load->model('m_invest');
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/deposit';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataDeposit'] = $this->M_deposit->select_deposit();
		$this->load->view('admin/deposit/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/deposit/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataDeposit 	= array(
								'id_dana'=>date('YmdHis'),
								'id_pengguna'=>$this->input->post('id_pengguna') ,
								'id_bank'=>0 ,
								'nama_akun'=>"",
								'no_rek'=>"",
								'type_dana'=>"tambah",
								'jumlah_dana'=>$this->input->post('jumlah_dana') ,
								'status_approve'=>"approve",
								'createddate'=>date('Y-m-d H:i:s')
							);

		$result = $this->M_deposit->insert($dataDeposit);

		if ($result > 0) {
			//get last saldo
			$whi=array("id_pengguna"=>$this->input->post('id_pengguna'));
			//script asli
			//$saldo=$this->m_invest->dataDana($whi)->row()->saldo;

			//script fix
			//cek jumlah baris
			$jmlbaris = $this->m_invest->dataDana($whi)->num_rows();

			if($jmlbaris>0)
			{
				$saldo=$this->m_invest->dataDana($whi)->row()->saldo;
				$jum = $saldo + $this->input->post('jumlah_dana');

				//update saldo 
				$data=array(
					"saldo"=>  $jum
				);
				$wh=array("id_pengguna"=>$this->input->post('id_pengguna'));
				$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo",$data,$wh);
			}
			else
			{
				$saldo=0;
				$jum = $saldo + $this->input->post('jumlah_dana');
				//update saldo 
				$data=array(
					"id_pengguna" => $this->input->post('id_pengguna'),
					"saldo"=>  $jum
				);

				$updatesaldo = $this->m_invest->insertdata("trx_dana_saldo",$data);
			}
			
			

			//script asli
			//$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo",$data,$wh);
		 
		  
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Deposit Berhasil Ditambahkan</div>
				  </div>
			    </p>';
				
				
			$msg='Deposit Dana Berhasil, sebesar Rp. '.number_format($this->input->post('jumlah_dana'),0,".",".").' pada tanggal '.date('Y-m-d H:i:s');
			 
			//$this->session->set_flashdata($res);
			$dtp=array(
				"id_pengguna"=>$this->input->post('id_pengguna'),
				"pesan"=>$msg,
				"createddate"=>date('Y-m-d H:i:s')
			);
			$this->m_invest->insertdata("tbl_pesan",$dtp);
			
        } else {
		$out['status'] = '';
		$out['msg'] = '<p class="box-msg">
		      <div class="info-box alert-error">
			      <div class="info-box-icon">
			      	<i class="fa fa-warning"></i>
			      </div>
			      <div class="info-box-content" style="font-size:20px">
		        	Data Deposit Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Deposit');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('id_deposit'=>$id);
		$data['dataDeposit'] 	= $this->M_deposit->select_deposit($where)->row();
		$data['content'] = 'admin/deposit/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$iddeposit = $this->input->post('id_deposit');

		$dataDeposit 	= array('deposit'=>$this->input->post('deposit') 
						);

		$result = $this->M_deposit->update($dataDeposit,$iddeposit);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Deposit Berhasil Diupdate</div>
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
				        	Data Deposit Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Deposit');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_deposit'=>$this->input->post('id'));
		$result = $this->M_deposit->del_data('tbl_deposit',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Deposit Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Deposit Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

