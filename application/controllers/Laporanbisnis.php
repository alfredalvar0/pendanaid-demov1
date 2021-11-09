<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Laporanbisnis extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_laporanbisnis');
        $this->load->model('M_admin');
		$this->load->model('m_invest');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/laporanbisnis';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataLaporanbisnis'] = $this->M_laporanbisnis->select_laporanbisnis();
		$this->load->view('admin/laporanbisnis/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/laporanbisnis/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		

		$dataLaporanbisnis 	= array(
									'id'=>date('YmdHis'),
									'id_produk'=>$this->input->post('id_produk') ,
									'laba'=>$this->input->post('laba'),
									'rugi'=>$this->input->post('rugi'),
									'dividen'=>$this->input->post('dividen'),
									'dividen_gadai'=>$this->input->post('dividen_gadai'),
									'status'=>0,
									'createddate'=>date('Y-m-d H:i:s')
						);

		$result = $this->M_laporanbisnis->insert($dataLaporanbisnis);

		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Laporanbisnis Berhasil Ditambahkan</div>
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
		        	Data Laporanbisnis Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Laporanbisnis');
	}

	public function share($id) {
			
		// $id 				= $id;
		$where = array('id'=>$id);
		$laporan 	= $this->M_laporanbisnis->select_laporanbisnis($where)->row();
		 $profit = ($laporan->dividen * $laporan->laba)/100;
		
		//get totalsaham user
		 $totalsaham = $this->db->query("select  * from trx_produk where id_produk=".$laporan->id_produk)->row()->lembar_saham;
		
		//share profit
		//get list pengguna
		$pengguna = $this->db->query("select distinct id_pengguna from trx_dana_invest where status_approve='approve' group by id_pengguna");
		$total = $pengguna->num_rows();
		foreach($pengguna->result() as $val){
			
			$ket="";
			
		    $totalsahamuser = $this->db->query("select  sum(lembar_saham) as total from trx_dana_invest where id_produk=".$laporan->id_produk." and  id_pengguna=".$val->id_pengguna."")->row()->total;
			
			$totalsahamjual = $this->db->query("select  sum(lembar_saham) as total from  trx_dana_invest_jual where status_approve in ('approve','complete') and  id_produk=".$laporan->id_produk." and  id_pengguna=".$val->id_pengguna."")->row()->total;
			//kurangi saham yang dijual
			$totalsahamuser = $totalsahamuser - $totalsahamjual ;
			
			//$ket.="<br>Jual :Rp ".number_format(($totalsahamjual  * $profit) / 100);
			
			//kurangi saham yang digadai
			$totalsahamusergadai = $this->db->query("select  sum(lembar_saham) as total from  trx_dana_invest_gadai where status_approve in ('approve') and  id_produk=".$laporan->id_produk." and  id_pengguna=".$val->id_pengguna."")->row()->total;
			 
			//$totalsahamuser = $totalsahamuser - $totalsahamusergadai;
			
		    $persensaham = ($totalsahamuser / $totalsaham)*100;
			
			
			
			//calculate profit 
			$nilaiakhir = ($persensaham  * $profit) / 100;
			 
			$ket.="<br>Aktif Rp ".number_format($nilaiakhir);
			
			//kalkulasi saham yang digadai
			if($totalsahamusergadai>0){
				$persensaham = ($totalsahamusergadai / $totalsaham)*100;
				$nilaiakhirgadai = ($persensaham  * $profit) / 100;
				
				$nilaiakhirgadai = ($laporan->dividen /100) * $nilaiakhirgadai;
				
				$nilaiakhir = $nilaiakhir + $nilaiakhirgadai;
				
				$ket.="<br>Gadai Rp ".number_format($nilaiakhirgadai);
			}
			
			//insert to table share
			$dataLaporanbisnis 	= array('id_laporan'=>$id ,
									'id_produk'=>$laporan->id_produk,
									'id_pengguna'=>$val->id_pengguna,
									'profit'=>$nilaiakhir,
									'createddate'=>date('Y-m-d H:i:s'),
									'keterangan'=>$ket,
						);

			 $result = $this->M_laporanbisnis->share($dataLaporanbisnis);
			
			//update saldo
			$whd=array("id_pengguna"=>$val->id_pengguna);   
			$dana=$this->m_invest->dataDana($whd)->row()->saldo;
			
			$dana = $dana+$nilaiakhir;
			
			 
			//update saldo
		  
			$data = array('saldo'=>$dana);
			$this->db->where(array('id_pengguna'=>$val->id_pengguna));
			$this->db->update("trx_dana_saldo", $data);
			
			//pesan
			$msg='Dividen Dana Berhasil, sebesar Rp. '.number_format($nilaiakhir,0,".",".").' pada tanggal '.date('Y-m-d H:i:s');
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
				"id_pengguna"=>$val->id_pengguna,
				"pesan"=>$msg,
				"createddate"=>date('Y-m-d H:i:s')
			);
			 $this->m_invest->insertdata("tbl_pesan",$dtp);
			
			
			//wallet
			$datadana=array(
				"id_dana"=>$id,
				"id_pengguna"=>$val->id_pengguna,
				"type_dana"=>"dividen", 
				"jumlah_dana"=>$nilaiakhir,
				"createddate"=>date('Y-m-d H:i:s'),
				"status_approve"=>"approve" ,
				
				"id_bank"=>"",
				"nama_akun"=>"", 
				"no_rek"=>"" 
			);
			
			 
			  
			 $history = $this->m_invest->insert("trx_dana",$datadana);
			
			 
			  
		}
		
		//update status laporan
		$dataLaporanbisnis 	= array('status'=>1);

		$result = $this->M_laporanbisnis->update($dataLaporanbisnis,$id);
		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
							Profit bisnis Berhasil Dishare</div>
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
				        	Profit bisnis Gagal Dishare</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		 redirect('Laporanbisnis');
	}
	
	public function update($id) {
			
		// $id 				= $id;
		$where = array('id'=>$id);
		$data['dataLaporanbisnis'] 	= $this->M_laporanbisnis->select_laporanbisnis($where)->row();
		$data['content'] = 'admin/laporanbisnis/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idlaporanbisnis = $this->input->post('id');

		$dataLaporanbisnis 	= array('id_produk'=>$this->input->post('id_produk') ,
									'laba'=>$this->input->post('laba'),
									'rugi'=>$this->input->post('rugi'),
									'dividen'=>$this->input->post('dividen'),
									'dividen_gadai'=>$this->input->post('dividen_gadai'),
									'createddate'=>date('Y-m-d H:i:s')
						);

		$result = $this->M_laporanbisnis->update($dataLaporanbisnis,$idlaporanbisnis);

		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Laporan bisnis Berhasil Diupdate</div>
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
				        	Data Laporan bisnis Gagal Diupdate</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Laporanbisnis');
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_laporanbisnis'=>$this->input->post('id'));
		$result = $this->M_laporanbisnis->del_data('tbl_dana_laporan',$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Laporan bisnis Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Laporan bisnis Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

