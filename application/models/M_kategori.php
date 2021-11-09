<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_kategori extends CI_Model {

	

	public function select_kategori($where=""){
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('tbl_kategori',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_kategori',$id);
      $this->db->update('tbl_kategori',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */