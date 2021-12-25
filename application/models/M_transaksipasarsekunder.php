<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_transaksipasarsekunder extends CI_Model {

	public function select_all($where = ""){
		$this->db->select('
			ps.id,
			ps.id_dana,
			ps.id_pengguna,
			ps.id_produk,
			ps.jenis_transaksi,
			ps.lembar_saham,
			ps.harga_per_lembar,
			ps.total,
			ps.status,
			ps.created_at,
			p.judul,
			p.id_bisnis,
			b.nama_binsis,
			u.nama_pengguna
		');
		$this->db->from('trx_pasar_sekunder ps');
		$this->db->join('trx_produk p','p.id_produk = ps.id_produk','left');
		$this->db->join('tbl_bisnis b','b.id_bisnis = p.id_bisnis','left');
		$this->db->join('tbl_pengguna u','u.id_pengguna = ps.id_pengguna','left');

		if ($where != "") {
			$this->db->where($where);
		}

		return $this->db->get();
	}	
/*
	public function insert($data) {
    $this->db->insert('trx_produk_pasar_sekunder',$data);
    return $this->db->affected_rows(); 
	}

	public function getDataProduk($filter = ''){
		$this->db->select();
		$this->db->from('trx_produk_pasar_sekunder a');

		if (is_array($filter) && !empty($filter)) {
			$this->db->where($filter);
		}

		return $this->db->get();
	}	

*/
	public function update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('trx_pasar_sekunder', $data);
		return $this->db->affected_rows();
	}
}
