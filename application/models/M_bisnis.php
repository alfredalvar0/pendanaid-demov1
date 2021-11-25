<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_bisnis extends CI_Model {

	public function select_all($where=""){
		$this->db->select('a.*,b.*');
		$this->db->from('tbl_bisnis a');
		$this->db->join('tbl_kategori b','a.id_kategori=b.id_kategori','left');
		$this->db->join('tbl_admin c','c.id_admin=a.userid','left'); 
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}	

	public function insert($data) {
        $this->db->insert('tbl_bisnis',$data);
        return $this->db->affected_rows(); 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_bisnis',$id);
      $this->db->update('tbl_bisnis',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */