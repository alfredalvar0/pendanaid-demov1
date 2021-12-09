<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_danainvest extends CI_Model {

	public function select_dana($where=""){
		$this->db->select('a.*,b.nama_pengguna,c.judul,d.username,e.type_dana');
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_admin d','d.id_admin=b.id_admin','left');
		$this->db->join('trx_dana e','e.id_dana = a.id_dana','left');
		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function select_dana2($select="*"){

		$sel = implode(',', $select);

		$this->db->select($sel);
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_admin d','d.id_admin=b.id_admin','left');
		$this->db->join('trx_dana e','e.id_dana = a.id_dana','left');
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function insert($data) {
        $this->db->insert('trx_dana_invest',$data);
        return $this->db->affected_rows(); 
	}

	public function insertDana($data) {
        $this->db->insert('tbl_dana',$data);
        return $this->db->affected_rows(); 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function addpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function refundBack($price,$id) {
	  $this->db->set('saldo', 'saldo + ' .  $price, FALSE)
	  ->where('id_pengguna',$id);
      $this->db->update('trx_dana_saldo');
      return $this->db->affected_rows();
	}

	public function refundCheck($id) {
		$this->db->select('saldo')->where('id_pengguna',$id);
		$q = $this->db->get('trx_dana_saldo');
		$response = $q->result_array();
	 	return $response;
	}

	public function fundAdd($price,$id) {
	  $this->db->set('saldo', 'saldo + ' .  $price, FALSE)
	  ->where('id_pengguna',$id);
      $this->db->update('trx_dana_saldo');
      return $this->db->affected_rows();
	}

	public function prosesWithdraw($price,$id) {
	  $this->db->set('saldo', 'saldo - ' .  $price, FALSE)
	  ->where('id_pengguna',$id);
      $this->db->update('trx_dana_saldo');
      return $this->db->affected_rows();
	}

	public function refundGet($price,$id) {
	  $this->db->set('saldo', 'saldo - ' .  $price, FALSE)
	  ->where('id_pengguna',$id);
      $this->db->update('trx_dana_saldo');
      return $this->db->affected_rows();
	}

	public function update($data,$id) {
	  $this->upd($data,$id);
	  $this->db->where('id_dana',$id);
      $this->db->update('trx_dana_invest',$data);
      return $this->db->affected_rows();
	}

	public function upd($data,$id) {
	  $this->db->where('id_dana',$id);
      $this->db->update('trx_dana',$data);
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */