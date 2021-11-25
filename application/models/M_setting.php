<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_setting extends CI_Model {

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_admin WHERE id_admin = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update($data,$id) {
	  $this->db->where('id_admin',$id);
      $this->db->update('tbl_admin',$data);
      return $this->db->affected_rows();
	}

}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */