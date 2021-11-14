<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_toc extends CI_Model {

	public function select_toc() {
		return $this->db->get('tbl_toc');
	}

	public function update($data,$id) {
	  $this->db->where('id_admin',$id);
      $this->db->update('tbl_admin',$data);
      return $this->db->affected_rows();
	}

  public function insertdata($tbl, $data)
  {
    $this->db->insert($tbl, $data);
    return $this->db->affected_rows();
  }

  public function inactive_all()
  {
    $this->db->set(array('is_aktif' => 0))->update('tbl_toc');
    return $this->db->affected_rows();
  }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
