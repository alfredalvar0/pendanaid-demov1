<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_gadaisaham extends CI_Model {

	public function select_dana($where=""){
		$this->db->select('a.*,b.nama_pengguna,c.judul,d.nama_pengguna');
		$this->db->from('trx_dana_invest_gadai a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_pengguna d','d.id_pengguna=a.id_pengguna','left');
		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('trx_dana_invest_gadai',$data);
        return $this->db->affected_rows(); 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_jual',$id);
      $this->db->update('trx_dana_invest_gadai',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */