<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_referral extends CI_Model {

	public function all_product($where = ""){
		$this->db->select('p.id_produk, k.id, p.judul, k.persen_komisi');
		$this->db->from('trx_produk p');
		$this->db->join('tbl_komisi_referral k', 'k.id_produk = p.id_produk', 'LEFT');
		if ($where != "") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function insert_komisi($data) {
		return $this->db->insert('tbl_komisi_referral', $data);
	}


	public function update_komisi($data, $id) {
		return $this->db->update('tbl_komisi_referral', $data, ['id' => $id]);
	}

	public function insert_invest_komisi($data) {
		return $this->db->insert('trx_dana_invest_komisi', $data);
	}

}
