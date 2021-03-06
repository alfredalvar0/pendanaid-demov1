<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_laporanbisnis extends CI_Model {



	public function select_laporanbisnis($where=""){
		$this->db->select('tbl_dana_laporan.*,trx_produk.judul');
		$this->db->from('tbl_dana_laporan');
		$this->db->join('trx_produk','tbl_dana_laporan.id_produk=trx_produk.id_produk');
		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by('id', 'DESC');
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('tbl_dana_laporan',$data);
        return $this->db->affected_rows();
	}

	public function share($data) {
        $this->db->insert('tbl_dana_laporan_share',$data);
        return $this->db->affected_rows();
	}

	public function update($data,$id) {
	  $this->db->where('id',$id);
      $this->db->update('tbl_dana_laporan',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }

	public function getAllInvestor($id)
	{
		$this->db->select('c.email');
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b', 'a.id_pengguna = b.id_pengguna', 'inner');
		$this->db->join('tbl_admin c', 'c.id_admin = b.id_admin', 'inner');
		$this->db->where('id_produk', $id);
		$this->db->where('status_approve', 'approve');
		return $this->db->get();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
