<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_deposit extends CI_Model {

	

	public function select_deposit($where=""){
		$this->db->select('a.*,b.nama_pengguna,c.nama_bank,e.username,e.login_from,d.nama_akun,d.no_rek');
		$this->db->from('trx_dana a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_admin e','e.id_admin=b.id_admin','left');
		$this->db->join('tbl_bank_pengguna d','d.id_pengguna=b.id_pengguna','left');
		$this->db->join('tbl_bank c','c.id_bank=d.bank','left');
		$this->db->where('type_dana', 'tambah');
		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('trx_dana',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id',$id);
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