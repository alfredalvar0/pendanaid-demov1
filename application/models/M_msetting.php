<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_msetting extends CI_Model {

	

	public function select_setting($where=""){
		$this->db->select('*');
		$this->db->from('tbl_setting');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('tbl_setting',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_setting',$id);
      $this->db->update('tbl_setting',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */