<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_dana extends CI_Model {

	public function select_dana($where=""){
		$this->db->select('a.*,b.nama_pengguna,c.nama_bank,e.username,e.login_from,d.nama_akun,d.no_rek,b.no_ktp');
		$this->db->from('trx_dana a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_admin e','e.id_admin=b.id_admin','left');
		$this->db->join('tbl_bank_pengguna d','d.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_bank c','c.id_bank=d.bank','left');

		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function select_report_withdraw($where=""){
		$this->db->select('b.no_ktp, b.nama_pengguna, c.nama_bank, d.nama_akun,d.no_rek,a.jumlah_dana,a.status_approve');
		$this->db->from('trx_dana a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_admin e','e.id_admin=b.id_admin','left');
		$this->db->join('tbl_bank_pengguna d','d.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_bank c','c.id_bank=d.bank','left');

		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get()->result_array();
	}

	public function select_data_saldo()
	{
		$this->db->select('b.nama_pengguna, c.username, a.saldo');
		$this->db->from('trx_dana_saldo a');
		$this->db->join('tbl_pengguna b', 'a.id_pengguna = b.id_pengguna', 'left');
		$this->db->join('tbl_admin c', 'c.id_admin = b.id_admin', 'left');
		$this->db->order_by('a.id', 'DESC');
		return $this->db->get();
	}

	public function select_user($id){
		$this->db->select('email,username')->where('id_admin',$id);
		$q = $this->db->get('tbl_admin');
		$response = $q->result_array();
	 	return $response;
	}

	public function select_add($id){
		$this->db->select('id_pengguna')->where('id_admin',$id);
		$q = $this->db->get('tbl_pengguna');
		$response = $q->result_array();
	 	return $response;
	}

	public function insert($data) {
        $this->db->insert('trx_dana',$data);
        return $this->db->affected_rows();
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows();
	}

	public function update($data,$id) {
	  $this->db->where('id_dana',$id);
      $this->db->update('trx_dana',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
