<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_referal extends CI_Model {

	public function select_all($where=""){
		$this->db->select('a.*,b.nama_pengguna');
		$this->db->from('tbl_referral a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function update($data,$id) {
	  $this->db->where('id_referal',$id);
      $this->db->update('tbl_referal',$data);
      return $this->db->affected_rows();
	}

}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */