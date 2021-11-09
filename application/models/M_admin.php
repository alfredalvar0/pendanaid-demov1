<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
	
	function select($id = '') {
		if ($id != '') {
			$this->db->where($id);
		}

		$data = $this->db->get('tbl_admin');

		return $data;
	}

	public function data_admin($tipe){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where($tipe);
		return $this->db->get();
	}

	public function get_admin(){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('tipe','super admin');
		return $this->db->get()->row();
	}

	public function upd_admin($id,$data){
	  $this->db->where('id_admin',$id);
      $this->db->update('tbl_admin',$data);
      return $this->db->affected_rows();
	}

	public function data_adminNumRows($idadmin){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where($idadmin);
		return $this->db->get()->row();
	}

}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */