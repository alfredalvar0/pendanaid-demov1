<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_produkpasarsekunder extends CI_Model {

	public function select_all($where = ""){
		$this->db->select('
			a.*,
			b.nama_binsis,
			coalesce(c.jum, 0) as jum,
			d.maks_harga_perlembar,
			d.min_harga_perlembar,
			d.nilai_biaya_admin,
			d.jenis_biaya_admin,
			d.nilai_biaya_kustodian,
			d.jenis_biaya_kustodian,
			d.nilai_kelipatan,
			d.jenis_kelipatan,
			d.publish
		');
		$this->db->from('trx_produk a');
		$this->db->join('tbl_bisnis b','a.id_bisnis=b.id_bisnis','left');
		$this->db->join('(select id_produk,count(*) as jum from trx_dana_invest group by id_produk) c','c.id_produk=a.id_produk','left');
		$this->db->join('trx_produk_pasar_sekunder d','d.id_produk=a.id_produk','left');
		$this->db->where_in("a.status_approve", ["approve","complete","invest","running"]);
		
		if ($where != "") {
			$this->db->where($where);
		}

		return $this->db->get();
	}	

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

	public function update($data, $id) {
		$this->db->where('id_produk', $id);
		$this->db->update('trx_produk_pasar_sekunder', $data);
		return $this->db->affected_rows();
	}

}
