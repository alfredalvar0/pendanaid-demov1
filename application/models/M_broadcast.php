<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_broadcast extends CI_Model {

	public function select_bisnis($where=""){
		$this->db->select('*');
		$this->db->from('tbl_bisnis');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function select_investor($wh="")
	{
		$this->db->select('a.*');
		$this->db->from('tbl_admin a');
		$this->db->join('tbl_pengguna b', 'a.id_admin = b.id_admin', 'inner');
		$this->db->join('trx_dana_invest c', 'c.id_pengguna = b.id_pengguna', 'inner');
		$this->db->join('trx_produk d', 'd.id_produk = c.id_produk', 'inner');
		$this->db->where('a.tipe', 'investor');
		$this->db->where('a.investstatus', 'aktif');
		$this->db->where('a.status', 'aktif');
		if ($wh!="") {
			$this->db->where($wh);
		}
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('trx_broadcast',$data);
        return $this->db->affected_rows();
	}

	public function update($data,$id) {
	 	$this->db->where('id_bank',$id);
      	$this->db->update('tbl_bank',$data);
      	return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }

		public function get_produk_bisnis($wh="")
		{
			$this->db->select('*');
			$this->db->from('trx_produk');
			if ($wh!="") {
				$this->db->where($wh);
			}
			return $this->db->get();
		}
}
