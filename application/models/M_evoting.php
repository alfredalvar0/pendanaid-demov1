<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_evoting extends CI_Model {

	

	public function select_evoting($where=""){
		$this->db->select('tbl_vote.*,trx_produk.judul as produk');
		$this->db->from('tbl_vote');
		$this->db->join('trx_produk',' tbl_vote.id_produk=trx_produk.id_produk');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('tbl_vote',$data);
        return $this->db->affected_rows(); 
	}
	
	 

	public function update($data,$id) {
	  $this->db->where('id',$id);
      $this->db->update('tbl_vote',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */