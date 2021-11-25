<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_produk extends CI_Model {

	public function select_all($where=""){
		$this->db->select('a.*,b.nama_binsis,coalesce(c.jum,0) as jum');
		$this->db->from('trx_produk a');
		$this->db->join('tbl_bisnis b','a.id_bisnis=b.id_bisnis','left');
		$this->db->join('(select id_produk,count(*) as jum from trx_dana_invest group by id_produk) c','c.id_produk=a.id_produk','left');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}	

	public function insert($data) {
        $this->db->insert('trx_produk',$data);
        return $this->db->affected_rows(); 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_produk',$id);
      $this->db->update('trx_produk',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */