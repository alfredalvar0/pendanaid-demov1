<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_akun extends CI_Model {

	public function select_akun($where=""){
		$this->db->select('a.*,b.id_pengguna,b.nama_pengguna,b.kode_referral,b.jenis_kelamin,b.tempat_lahir,b.tgl_lahir,b.sts_kawin,b.agama,b.pendidikan_terakhir,b.pekerjaan,b.alamat_ktp,b.negara_ktp,b.prov_ktp,b.kabkota_ktp,b.no_hp,b.no_alt,b.alamat_domisili,b.negara_domisili,b.prov_domisili,b.kabkota_domisili,b.alamat_surat,b.ttd,c.name as provinsi,d.name as kota,e.country_name as negara,f.nama_akun,f.no_rek,f.bank,
			b.no_ktp, b.alamat_surat, g.nama_bank');
		$this->db->from('tbl_admin a');
		$this->db->join('tbl_pengguna b','a.id_admin=b.id_admin','left');
		$this->db->join('tbl_provinsi c','b.prov_ktp=c.id','left');
		$this->db->join('tbl_kabkota d','b.kabkota_ktp=d.id','left');
		$this->db->join('tbl_negara e','b.negara_ktp=e.id','left');
		$this->db->join('tbl_bank_pengguna f','b.id_pengguna=f.id_pengguna','left');
		$this->db->join('tbl_bank g','g.id_bank=f.bank','left');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_akun_verif($where=""){
		$this->db->select('a.*,b.id_pengguna,b.nama_pengguna,b.kode_referral,b.jenis_kelamin,b.tempat_lahir,b.tgl_lahir,b.sts_kawin,b.agama,b.pendidikan_terakhir,b.pekerjaan,b.alamat_ktp,b.negara_ktp,b.prov_ktp,b.kabkota_ktp,b.no_hp,b.no_alt,b.alamat_domisili,b.negara_domisili,b.prov_domisili,b.kabkota_domisili,b.alamat_surat,b.ttd,c.name as provinsi,d.name as kota,e.country_name as negara,f.nama_akun,f.no_rek,f.bank');
		$this->db->from('tbl_admin a');
		$this->db->join('tbl_pengguna b','a.id_admin=b.id_admin','left');
		$this->db->join('tbl_provinsi c','b.prov_ktp=c.id','left');
		$this->db->join('tbl_kabkota d','b.kabkota_ktp=d.id','left');
		$this->db->join('tbl_negara e','b.negara_ktp=e.id','left');
		$this->db->join('tbl_bank_pengguna f','b.id_pengguna=f.id_pengguna','left');
		if ($where!="") {
			$this->db->where($where);
			$this->db->where('status="aktif"');
			$this->db->where('investstatus="tidak aktif"');
			$this->db->where('verif=1');
		}
		else
		{
			$this->db->where('status="aktif"');
			$this->db->where('investstatus="tidak aktif"');
			$this->db->where('verif=1');
		}
		return $this->db->get();
	}

	public function dataAgama($where=""){
		$this->db->select('*');
		$this->db->from('tbl_agama');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	public function dataPendidikan($where=""){
		$this->db->select('*');
		$this->db->from('tbl_pendidikan');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	public function dataNegara($where=""){
		$this->db->select('*');
		$this->db->from('tbl_negara');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	public function dataBank($where=""){
		$this->db->select('*');
		$this->db->from('tbl_bank');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	public function dataProvinsi($where=""){
		$this->db->select('*');
		$this->db->from('tbl_provinsi');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	public function dataKabupaten($where=""){
		$this->db->select('*');
		$this->db->from('tbl_kabkota');
		if($where!=""){
            $this->db->where($where);
        }
		return $this->db->get();
	}

	function generateReferral($idadmin, $strength = 6) {
		$input = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string.str_pad($idadmin, 4, '0', STR_PAD_LEFT);
	}
	public function select_pengguna($where=""){
		$this->db->select('*');
		$this->db->from('tbl_pengguna');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_bankpengguna($where=""){
		$this->db->select('*');
		$this->db->from('tbl_bank_pengguna');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_dana($where=""){
		$this->db->select('*');
		$this->db->from('trx_dana');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_danainvest($where=""){
		$this->db->select('*');
		$this->db->from('trx_dana_invest');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_referal($where=""){
		$this->db->select('*');
		$this->db->from('tbl_referral');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}
	
	public function select_foto($where=""){
		$this->db->select('c.*');
		$this->db->from('tbl_admin a');
		$this->db->join('tbl_pengguna b','a.id_admin=b.id_admin','left');
		$this->db->join('tbl_dokumen c','b.id_pengguna=c.id_pengguna','left');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_email($email) {
		$sql = "SELECT email FROM tbl_admin WHERE email='{$email}'";
		$data = $this->db->query($sql);

		return $data;
	}

	public function insert($data) {
        $this->db->insert('tbl_admin',$data);
        return $this->db->insert_id(); 
	}

	public function insertpengguna($data) {
        $this->db->insert('tbl_pengguna',$data);
        return $this->db->insert_id(); 
	}

	public function insertbankpengguna($data) {
        $this->db->insert('tbl_bank_pengguna',$data);
        return $this->db->affected_rows(); 
	}

	public function getUserDetails() {
        $response = array();
		$this->db->select('id_admin,username,email,tipe,tipeuser,login_from,status,investstatus');
		$q = $this->db->get('tbl_admin');
		$response = $q->result_array();
	 	return $response; 
	}

	public function getMDanaDetails() {
        $response = array();
		$this->db->select('*')->where('status','Menambahkan');
		$this->db->order_by("id","desc");
		$q = $this->db->get('tbl_dana');
		$response = $q->result_array();
	 	return $response; 
	}

	public function getNDanaDetails() {
        $response = array();
		$this->db->select('*')->where('status','Menarik');
		$this->db->order_by("id","desc");
		$q = $this->db->get('tbl_dana');
		$response = $q->result_array();
	 	return $response; 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_admin',$id);
      $this->db->update('tbl_admin',$data);
      return $this->db->affected_rows();
	}

	public function updatepengguna($data,$id) {
	  $this->db->where('id_pengguna',$id);
      $this->db->update('tbl_pengguna',$data);
      return $this->db->affected_rows();
	}

	public function updatebankpengguna($data,$id) {
	  $this->db->where('id_pengguna',$id);
      $this->db->update('tbl_bank_pengguna',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
