<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_page extends CI_Model {

	public function select_all() {
		$sql = "SELECT * FROM tbl_page";
		$data = $this->db->query($sql);

		return $data;
	}

	public function select_url($url) {
		$sql = "SELECT link_page FROM tbl_page WHERE link_page='{$url}'";
		$data = $this->db->query($sql);

		return $data;
	}

	public function select_by_url($url) {
		$sql = "SELECT * FROM tbl_page WHERE link_page = '{$url}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_page WHERE id_page = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}
	

	public function insert($data) {
        $this->db->insert('tbl_page',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_page',$id);
      $this->db->update('tbl_page',$data);
      return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_page WHERE id_page='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */