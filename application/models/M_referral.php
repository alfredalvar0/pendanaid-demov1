<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_referral extends CI_Model {

	public function all_product($where = ""){
		$this->db->select('k.id, p.judul, k.persen_komisi');
		$this->db->from('trx_produk p');
		$this->db->join('tbl_komisi_referral k', 'k.id_produk = p.id_produk', 'LEFT');
		if ($where != "") {
			$this->db->where($where);
		}
		return $this->db->get();
	}

	public function update_komisi($data, $id) {
		return $this->db->update('tbl_komisi_referral', $data, ['id' => $id]);
	}

}
