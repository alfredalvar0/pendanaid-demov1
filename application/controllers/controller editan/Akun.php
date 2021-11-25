<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Akun extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_akun');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/akun';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataAkun'] = $this->M_akun->select_akun();
		$this->load->view('admin/akun/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/akun/form';
		$data['dataProvinsi'] = $this->M_akun->dataProvinsi();
		$data['dataKabupaten'] = $this->M_akun->dataKabupaten();
		$data['dataAgama'] = $this->M_akun->dataAgama();
		$data['dataPendidikan'] = $this->M_akun->dataPendidikan();
		$data['dataNegara'] = $this->M_akun->dataNegara();
		$data['dataBank'] = $this->M_akun->dataBank();
		$this->load->view('admin/indexadmin',$data);
	}

	public function pilihKabKota(){
		$idprov = $this->input->post("id_prov");
		$wh=array("province_id"=>$idprov);
		$dataKabKota=$this->M_akun->dataKabupaten($wh);
		$html = "<option selected disabled value=''>-- Pilih Kabupaten --</option>";
        foreach($dataKabKota->result() as $dtl){
            $html .= "<option value='".$dtl->id."'>".$dtl->name."</option>"; 
        }
        $callback = array('data_kabkota'=>$html);
        echo json_encode($callback);
	}

	public function prosesEmail(){
		$email = $this->input->post('email');

		$url = $this->M_akun->select_email($email);
		
		if ($url->num_rows() > 0) {
			echo "Email sudah ada yang menggunakan";
		}else{
			echo "Email Belum ada ";
		}
	}

	public function prosesTambah() {
		$out = array();
		// $data = array();
		
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('username', 'username', 'trim|required');

		$dataAkun 	= array('username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'password'=>md5($this->input->post('password')),
						'tipe'=>$this->input->post('tipe'),
						'tipeuser'=>$this->input->post('tipeuser'),
						'status'=>'aktif'
						);
		$result = $this->M_akun->insert($dataAkun);
		$idadmin = $result;
		$dataReferral = $this->M_akun->generateReferral($idadmin);
		$dataPengguna = array('id_admin'=>$idadmin,
								'kode_referral'=>$dataReferral,
								'nama_pengguna' 	=> 	$this->input->post('name'),
								'jenis_kelamin'		=>	$this->input->post('seljk'),
								'tempat_lahir'		=>	$this->input->post('birthplace'),
								'tgl_lahir'			=>	$this->input->post('birthdate'),
								'sts_kawin'			=>	$this->input->post('selmrg'),
								'agama'				=>	$this->input->post('selrlg'),
								'pendidikan_terakhir'=> $this->input->post('seledu'),
								'pekerjaan'			=>	$this->input->post('job'),
								'alamat_ktp'		=>	$this->input->post('aktp'),
								'negara_ktp'		=>	$this->input->post('selcnt'),
								'prov_ktp'			=>	$this->input->post('selpro'),
								'kabkota_ktp'		=>	$this->input->post('selkk'),
								'no_hp'				=>	$this->input->post('hp'),
								'no_alt'			=>	$this->input->post('noa'),
								'alamat_domisili'	=>	$this->input->post('aktp'),
								'negara_domisili'	=>	$this->input->post('selcnt'),
								'prov_domisili'		=>	$this->input->post('selpro'),
								'kabkota_domisili'	=>	$this->input->post('selkk'),
								'alamat_surat'		=>	$this->input->post('aktp'),
								'createddate'=>date('Y-m-d H:i:s')
								);
		
		$result = $this->M_akun->insertpengguna($dataPengguna);
		$idpengguna = $result;
		$dataBankPengguna = array('id_pengguna'=>$idpengguna,
									'nama_akun'=>$this->input->post('account'),
									'no_rek'=>$this->input->post('norek'),
									'bank'=>$this->input->post('selbank'),
									'createddate'=>date('Y-m-d H:i:s')
									);
		$result = $this->M_akun->insertbankpengguna($dataBankPengguna);
		// print_r($result);
		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Akun Berhasil Ditambahkan</div>
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
		        	Data Akun Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}
		
		
		 //set modul
		$result = $this->db->query("select * from tbl_modul modul order by urutan asc ");
		foreach($result->result() as $val){
			$modul = $this->input->post('akses'.$val->id);
			$cekakses = $this->db->query("select * from tbl_user_akses  where id_user=".$idadmin." and id_modul=".$val->id);
			if($cekakses->num_rows() > 0){
				 
			
				$this->db->where('id_user', $idadmin);
				$this->db->where('id_modul', $val->id);
				$this->db->update('tbl_user_akses', array('status' => $modul));
			
			}else{
				if($modul == NULL || $modul == ""){ $modul = 0;} 
				$data = array('id_user'=>$idadmin,
							  'id_modul'=>$val->id, 
							  'status'=>$modul);
				$this->db->insert('tbl_user_akses', $data);
			}
			
			
			
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Akun');
	}

	public function update($id) {
			
		// $id 				= $id;
		$where = array('a.id_admin'=>$id);
		$data['dataAkun'] 	= $this->M_akun->select_akun($where)->row();
		$data['content'] = 'admin/akun/form_update';
		$data['dataProvinsi'] = $this->M_akun->dataProvinsi();
		$data['dataKabupaten'] = $this->M_akun->dataKabupaten();
		$data['dataAgama'] = $this->M_akun->dataAgama();
		$data['dataPendidikan'] = $this->M_akun->dataPendidikan();
		$data['dataNegara'] = $this->M_akun->dataNegara();
		$data['dataBank'] = $this->M_akun->dataBank();
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idadmin = $this->input->post('id_admin');
		$idpengguna = $this->input->post('id_pengguna'); 

		$dataAkun 	= array('username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'tipe'=>$this->input->post('tipe'),
						'tipeuser'=>$this->input->post('tipeuser'),
						'status'=>$this->input->post('status')
						);
		$result = $this->M_akun->update($dataAkun,$idadmin);

		$dataPesan = array('pesan'=>"Akun anda sudah aktif",
								'id_pengguna'=>$idpengguna,
								'createddate'=>date('Y-m-d H:i:s')
							);
			
		$result = $this->M_akun->insertpesan($dataPesan);
		
		$dataPengguna = array(
								'nama_pengguna' 	=> 	$this->input->post('name'),
								'jenis_kelamin'		=>	$this->input->post('seljk'),
								'tempat_lahir'		=>	$this->input->post('birthplace'),
								'tgl_lahir'			=>	$this->input->post('birthdate'),
								'sts_kawin'			=>	$this->input->post('selmrg'),
								'agama'				=>	$this->input->post('selrlg'),
								'pendidikan_terakhir'=> $this->input->post('seledu'),
								'pekerjaan'			=>	$this->input->post('job'),
								'alamat_ktp'		=>	$this->input->post('aktp'),
								'negara_ktp'		=>	$this->input->post('selcnt'),
								'prov_ktp'			=>	$this->input->post('selpro'),
								'kabkota_ktp'		=>	$this->input->post('selkk'),
								'no_hp'				=>	$this->input->post('hp'),
								'no_alt'			=>	$this->input->post('noa'),
								'alamat_domisili'	=>	$this->input->post('aktp'),
								'negara_domisili'	=>	$this->input->post('selcnt'),
								'prov_domisili'		=>	$this->input->post('selpro'),
								'kabkota_domisili'	=>	$this->input->post('selkk'),
								'alamat_surat'		=>	$this->input->post('aktp'),
								'createddate'		=>	date('Y-m-d H:i:s')
								);

		$result = $this->M_akun->updatepengguna($dataPengguna,$idpengguna);
		 
		$dataBankPengguna = array(
									'nama_akun'=>$this->input->post('account'),
									'no_rek'=>$this->input->post('norek'),
									'bank'=>$this->input->post('selbank'),
									'createddate'=>date('Y-m-d H:i:s')
									);
		$result = $this->M_akun->updatebankpengguna($dataBankPengguna,$idpengguna);

		 
			
		if ($result > 0) {
			
			
			
			
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Akun Berhasil Diupdate</div>
					  </div>
				    </p>';
		} 
		 else{
		 	$out['status'] = '';
		 		$out['msg'] = '<p class="box-msg">
		 		      <div class="info-box alert-error">
		 			      <div class="info-box-icon">
		 			      	<i class="fa fa-check-circle"></i>
		 			      </div>
		 			      <div class="info-box-content" style="font-size:20px">
		 		        	Data Akun Gagal Diupdate</div>
		 			  </div>
		 		    </p>';
		 }	
		 
		 
		//set modul
		$result = $this->db->query("select * from tbl_modul modul order by urutan asc ");
		foreach($result->result() as $val){
			$modul = $this->input->post('akses'.$val->id);
			$cekakses = $this->db->query("select * from tbl_user_akses  where id_user=".$idadmin." and id_modul=".$val->id);
			if($cekakses->num_rows() > 0){
				 
			
				$this->db->where('id_user', $idadmin);
				$this->db->where('id_modul', $val->id);
				$this->db->update('tbl_user_akses', array('status' => $modul));
			
			}else{
				if($modul == NULL || $modul == ""){ $modul = 0;} 
				$data = array('id_user'=>$idadmin,
							  'id_modul'=>$val->id, 
							  'status'=>$modul);
				$this->db->insert('tbl_user_akses', $data);
			}
			
			
			
		}
		
		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Akun');
	}

	public function detail($id) {
			
		// $id 				= $id;
		$where = array('a.id_admin'=>$id);
		$data['dataAkun'] 	= $this->M_akun->select_akun($where)->row();
		$data['data_foto'] 	= $this->M_akun->select_foto($where)->row();
		$data['content'] = 'admin/akun/detail_akun';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function delete() {
		// $id = $_POST['id'];
		$id = array('id_admin'=>$this->input->post('id'));
		// Pengguna
		$selpengguna = $this->M_akun->select_pengguna($id)->result();
		$idpengguna = array('id_pengguna'=>$selpengguna[0]->id_pengguna);
		
		// Dana 
		$selDana = $this->M_akun->select_dana($idpengguna);
		// Dana Ivest
		$selDanaInvest = $this->M_akun->select_danainvest($idpengguna);
		// Referral
		$selReferral = $this->M_akun->select_referal($idpengguna);
		

		if ($selDana->num_rows() <= 0 && $selDanaInvest->num_rows() <= 0 && $selReferral->num_rows() <= 0) {
			// Bank Pengguna
			$selBankPengguna = $this->M_akun->select_bankpengguna($idpengguna)->row();
			$idbankpengguna = array('id_pengguna'=>$selBankPengguna->id_pengguna);
			$result = $this->M_akun->del_data('tbl_admin',$id);
			$result = $this->M_akun->del_data('tbl_pengguna',$idpengguna);
			$result = $this->M_akun->del_data('tbl_bank_pengguna',$idbankpengguna);
				echo '<p class="box-msg">
						      <div class="info-box alert-success">
							      <div class="info-box-icon">
							      	<i class="fa fa-check-circle"></i>
							      </div>
							      <div class="info-box-content" style="font-size:20px">
						        	Data Akun Berhasil Dihapus</div>
							  </div>
						    </p>';
		}else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Akun Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

