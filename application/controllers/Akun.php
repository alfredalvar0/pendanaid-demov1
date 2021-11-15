<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Akun extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_akun');
        $this->load->model('M_admin');
		$this->load->model('m_invest');
        $lib=array("session","form_validation","phpmailer_library"); //"PHPExcel","PHPExcel/IOFactory"
        $this->load->library($lib);
	}

	public function kirimEmailnyaVerif($id, $email,$statusreply,$statusremark){
		$result=array();
		$format="";

        $mailTo=$email;
		$mailformat = $this->MailFormatViewDaftar($format,$mailTo,$id,$statusreply,$statusremark);
        $msg="";
		$wh=array(
			//"a.email"=>$mailTo,
			"a.id_admin"=>$id,
			//"a.status"=>"Tidak Aktif"
		);

		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()>0){

			//$mailTo = $this->m_invest->checkPengguna($wh)->row()->mailto;
			$mail= $this->m_invest->kirimEmailnya($mailTo,$mailformat);

			if($mail=="success"){
				 echo "berhasil kirim email";
			} else {
				echo "gagal kirim email";
			}

		} else{
			echo "not found";
		}


    }



	public function MailFormatViewDaftar($format="",$email="",$resetkey="",$statusreply,$statusremark){
        //if($this->session->userdata('user_type')==3 && $this->session->userdata('username')!='' &&$this->session->userdata('status')=='login'){
			//$data['menuId']=array(52,62);
            $wh=array("mail_company"=>"PT Pendana Usaha");
            $data['mailserver'] = $this->m_invest->mailserver($wh)->row();
            $title="Verifikasi Akun";
            //$whnik=array("c.nik"=>$nik);
            //$data['datakar'] = $this->My_model->getUserKaryawan($whnik)->row();
            //$data['datajadwal'] = $this->My_model->dataJadwalLokerPelamar($data['datakar']->idlokerdl);
            $data['mailtitle'] = $title;
			$data['email'] = $email;
            $data['resetkey'] = $resetkey;
            $data['mailformat'] = "";

			if($statusreply==0 || $statusreply=='')
			{
				$data['remark'] = $statusremark;
				return $this->load->view('template/v-mail-format-verif-reject',$data,TRUE);
			}
			else
			{
				$data['remark'] = $statusremark;
				return $this->load->view('template/v-mail-format-verif-approve',$data,TRUE);
			}

		/* }else{
			redirect("home/login");
		} */
    }




	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '')
		{
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

	public function verifikasi()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '')
		{
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/verifikasi';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampilVerifikasi()
	{
		$data['dataAkun'] = $this->M_akun->select_akun_verif();
		$this->load->view('admin/verifikasi/list_data', $data);
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

	public function laporanAkun(){
		$data['dataProvinsi'] = $this->M_akun->dataProvinsi();
		$data['dataKabupaten'] = $this->M_akun->dataKabupaten();
		$data['dataAgama'] = $this->M_akun->dataAgama();
		$data['dataPendidikan'] = $this->M_akun->dataPendidikan();
		$data['dataNegara'] = $this->M_akun->dataNegara();
		$data['dataBank'] = $this->M_akun->dataBank();
		$data['content'] = 'admin/laporan/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function prosesLaporanAkun(){
		$username = $this->input->post("username");
		$email = $this->input->post("email");
		$nama = $this->input->post("nama");
		$noktp = $this->input->post("noktp");
		$nohp = $this->input->post("nohp");



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

	public function get_user(){
		$allUsers = $this->M_admin->get_admin();
		print_r($allUsers);
	}

	public function upd_user($id,$pass){
		$data = array(
		'password'=>$pass
		);
		$allUsers = $this->M_admin->upd_admin($id,$data);
		print_r($allUsers);
	}

	public function get_tipe($data){
		$data = array(
		'tipe'=>$data
		);
		$allUsers = $this->M_admin->data_admin($data)->row();
		print_r($allUsers);
	}

	public function export_csv(){
		/* file name */
		$filename = 'users_'.date('Ymd').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
	   /* get data */
		$usersData = $this->M_akun->getUserDetails();
		/* file creation */
		$file = fopen('php://output', 'w');
		$header = array("Username","Email","Tipe","Tipe User","Login From","Status","Investor Status");
		fputcsv($file, $header);
		foreach ($usersData as $key=>$line){
			fputcsv($file,$line);
		}
		fclose($file);
		exit;
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
		$data['dataPekerjaan'] = $this->M_akun->dataPekerjaan();
		$data['dataPenghasilan'] = $this->M_akun->dataPenghasilan();
		$data['data_foto'] 	= $this->M_akun->select_foto($where)->row();
		$this->load->view('admin/indexadmin',$data);

	}

	public function delete_agreement($idpengguna, $jenis, $idadmin){

		$wh = array("id_pengguna"=>$idpengguna);

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
        redirect("akun/update/".$idadmin);
	}

	public function updateVerifikasi($id) {

		// $id 				= $id;
		$where = array('a.id_admin'=>$id);
		$data['dataAkun'] 	= $this->M_akun->select_akun($where)->row();
		$data['content'] = 'admin/verifikasi/form_update';
		$data['dataProvinsi'] = $this->M_akun->dataProvinsi();
		$data['dataKabupaten'] = $this->M_akun->dataKabupaten();
		$data['dataAgama'] = $this->M_akun->dataAgama();
		$data['dataPendidikan'] = $this->M_akun->dataPendidikan();
		$data['dataNegara'] = $this->M_akun->dataNegara();
		$data['dataBank'] = $this->M_akun->dataBank();
		$data['data_foto'] 	= $this->M_akun->select_foto($where)->row();
		$data['dataPekerjaan'] = $this->M_akun->dataPekerjaan();
		$data['dataPenghasilan'] = $this->M_akun->dataPenghasilan();

		$this->load->view('admin/indexadmin',$data);

	}

	public function prosesUpdateVerif(){
		$out = array();
		// $data = array();
		$idadmin = $this->input->post('id_admin');
		$idpengguna = $this->input->post('id_pengguna');
		$email = $this->input->post('email');

		$statusreply = $this->input->post('reply');
		$statusremark = $this->input->post('remark');

		if($statusreply==0 || $statusreply=='')  //gagal verif
		{
			$investstatus = 'tidak aktif';
			$verif = 0;

			$dataPesan = array('pesan'=>"Akun anda gagal terverifikasi. Alasan: ".$statusremark,
								'id_pengguna'=>$idpengguna,
								'createddate'=>date('Y-m-d H:i:s')
							);

		}
		else  //berhasil verif
		{
			$investstatus = 'aktif';
			$verif = 2;

			$dataPesan = array('pesan'=>"Selamat, akun anda sudah terverifikasi.",
								'id_pengguna'=>$idpengguna,
								'createddate'=>date('Y-m-d H:i:s')
							);
		}

		$dataAkun 	= array(
							'investstatus' => $investstatus,
						);

		$result = $this->M_akun->update($dataAkun,$idadmin);

		$result = $this->M_akun->insertpesan($dataPesan);

		$dataPengguna = array(
								'verif' 	=> 	$verif,
								'alasan_verif' 	=> 	$statusremark,
								'createddate'		=>	date('Y-m-d H:i:s')
								);

		$result = $this->M_akun->updatepengguna($dataPengguna,$idpengguna);

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

		$this->session->set_flashdata('msg', $out['msg']);
		$this->kirimEmailnyaVerif($idadmin, $email, $statusreply,$statusremark);
		redirect('Akun/verifikasi');
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idadmin = $this->input->post('id_admin');
		$idpengguna = $this->input->post('id_pengguna');
		$password = $this->input->post('password');
		$md5_pass = "";

		if ($password != "") {
			$md5_pass = md5($password);
		}

		$dataAkun 	= array('username'=>$this->input->post('username'),
						'email'=>$this->input->post('email'),
						'tipe'=>$this->input->post('tipe'),
						'password' => $md5_pass,
						'tipeuser'=>$this->input->post('tipeuser'),
						'status'=>$this->input->post('status')
						);
		$result = $this->M_akun->update($dataAkun,$idadmin);

		$dataPesan = array('pesan'=>"Akun anda sudah aktif",
								'id_pengguna'=>$idpengguna,
								'createddate'=>date('Y-m-d H:i:s')
							);

		$result = $this->M_akun->insertpesan($dataPesan);

		$dok = array();

		if (isset($_FILES['foto_ktp']['name']) && $_FILES['foto_ktp']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto_ktp']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);


			$config['upload_path']          = 'assets/img/dokumen/ktp/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//upload execute
			$this->upload->do_upload('foto_ktp');

			$dok['foto_ktp']=$filename;
		}

		if (isset($_FILES['foto_npwp']['name']) && $_FILES['foto_npwp']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto_npwp']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);


			$config['upload_path']          = 'assets/img/dokumen/npwp/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//upload execute
			$this->upload->do_upload('foto_npwp');

			$dok['foto_npwp']=$filename;
		}

		if (isset($_FILES['buku_tabungan']['name']) && $_FILES['buku_tabungan']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['buku_tabungan']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);


			$config['upload_path']          = 'assets/img/dokumen/buku_tabungan/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//upload execute
			$this->upload->do_upload('buku_tabungan');

			$dok['buku_tabungan']=$filename;
		}

		if (isset($_FILES['selfie']['name']) && $_FILES['selfie']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['selfie']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);


			$config['upload_path']          = 'assets/img/dokumen/selfie/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			//upload execute
			$this->upload->do_upload('selfie');

			$dok['selfie']=$filename;
		}

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
			$this->m_invest->updatedata("tbl_pengguna",$data,$wh);

			$dok['ttd']=$filename;
		}

		$this->m_invest->updatedata('tbl_dokumen', $dok, array('id_pengguna' => $idpengguna));

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
								'alamat_domisili'	=>	$this->input->post('alamat_domisili'),
								'negara_domisili'	=>	$this->input->post('selcnt2'),
								'prov_domisili'		=>	$this->input->post('selpro2'),
								'kabkota_domisili'	=>	$this->input->post('selkk2'),
								'alamat_surat'		=>	$this->input->post('alamat_surat'),
								'penghasilan'		=>	$this->input->post('penghasilan'),
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
		redirect('Akun/update/'.$idadmin);
	}

	public function del_tipe($id){
		$id = array('id_admin'=>$id);
		$allUsers = $this->M_akun->del_data('tbl_admin',$id);;
		print_r($allUsers);
	}

	public function detail($id) {

		// $id 				= $id;
		$where = array('a.id_admin'=>$id);
		$data['dataAkun'] 	= $this->M_akun->select_akun($where)->row();
		$data['data_foto'] 	= $this->M_akun->select_foto($where)->row();
		$data['dataPekerjaan'] = $this->M_akun->dataPekerjaan();
		$data['dataPenghasilan'] = $this->M_akun->dataPenghasilan();
		$data['content'] = 'admin/akun/detail_akun';
		$this->load->view('admin/indexadmin',$data);

	}

	public function detailVerifikasi($id) {

		// $id 				= $id;
		$where = array('a.id_admin'=>$id);
		$data['dataAkun'] 	= $this->M_akun->select_akun($where)->row();
		$data['data_foto'] 	= $this->M_akun->select_foto($where)->row();
		$data['dataPekerjaan'] = $this->M_akun->dataPekerjaan();
		$data['dataPenghasilan'] = $this->M_akun->dataPenghasilan();
		$data['content'] = 'admin/verifikasi/detail_akun';
		$this->load->view('admin/indexadmin',$data);

	}

	public function prosesAktivasi(){
		$out = array();
		// $data = array();
		$idadmin = $this->input->post('id');
		$idpengguna = $this->M_akun->select_pengguna('id_admin='.$idadmin)->row()->id_pengguna;
		//$this->input->post('id_pengguna');

		$dataAkun 	= array(
						'investstatus'=>'aktif'
						);
		$result = $this->M_akun->update($dataAkun,$idadmin);

		$dataPesan = array('pesan'=>"Akun anda sudah aktif",
								'id_pengguna'=>$idpengguna,
								'createddate'=>date('Y-m-d H:i:s')
							);

		$result = $this->M_akun->insertpesan($dataPesan);

		if ($result > 0) {

			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Akun Berhasil Diaktifkan</div>
					  </div>
				    </p>';
		}
		 else{
		 	echo '<p class="box-msg">
		 		      <div class="info-box alert-error">
		 			      <div class="info-box-icon">
		 			      	<i class="fa fa-check-circle"></i>
		 			      </div>
		 			      <div class="info-box-content" style="font-size:20px">
		 		        	Data Akun Gagal Diaktifkan</div>
		 			  </div>
		 		    </p>';
		 }


		//$this->session->set_flashdata('msg', $out['msg']);
		//redirect('Akun/verifikasi');
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
