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

	public function get_list_data($wh="")
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

		$query=array();
		$this->db->start_cache();
		$this->db->select("trx_dana.*, tbl_pengguna.nama_pengguna, tbl_admin.username,IFNULL(p1.judul, p2.judul) AS jdl,IFNULL(trx_dana_invest.lembar_saham, trx_dana_invest_jual.lembar_saham) AS lbr");
		$this->db->from("trx_dana");
		$this->db->join('trx_dana_invest', 'trx_dana_invest.id_dana=trx_dana.id_dana', 'left');
		$this->db->join('trx_dana_invest_jual', 'trx_dana_invest_jual.id_jual=trx_dana.id_dana', 'left');
		$this->db->join('trx_produk AS p1', 'p1.id_produk=trx_dana_invest.id_produk', 'left');
		$this->db->join('trx_produk AS p2', 'p2.id_produk=trx_dana_invest_jual.id_produk', 'left');
		$this->db->join("tbl_pengguna","tbl_pengguna.id_pengguna=trx_dana.id_pengguna","left");
		$this->db->join('tbl_admin', 'tbl_admin.id_admin=tbl_pengguna.id_admin', 'left');
		$this->db->order_by("trx_dana.id_dana", "desc"); //tbl_pengguna.createddate
		$num_rows = $this->db->get()->num_rows();

		if ($this->input->post('tipe') != "") {
			$this->db->like('trx_dana.type_dana', $this->input->post('tipe'));
		}

		if ($this->input->post('produk') != "") {
			$this->db->like('trx_produk.judul', $this->input->post('produk'));
		}

		if ($this->input->post('user') != "") {
			$this->db->like('tbl_admin.username', $this->input->post('user'));
		}

		if ($this->input->post('status_approve') != "") {
			$this->db->like('trx_dana.status_approve', $this->input->post('status_approve'));
		}
		
		$num_rows_filtered = $this->db->get()->num_rows();
		$this->db->limit($limit, $start);
		$data = $this->db->get()->result_array();

		$this->db->flush_cache();
		$callback = array(    
            'draw' => $this->input->post('draw'), // Ini dari datatablenya    
            'recordsTotal' => $num_rows,    
            'recordsFiltered'=>$num_rows_filtered,    
            'data'=>$data
        );
        return json_encode($callback);
	}

	public function select_data_record()
	{
		$this->db->select('a.*, b.nama_pengguna');
		$this->db->from('trx_record_log a');
		$this->db->join('tbl_pengguna b', 'a.id_pengguna = b.id_pengguna', 'left');
		return $this->db->get();
	}

	public function select_data_broadcast($wh="")
	{
		$this->db->select('a.*, b.nama_binsis AS nama_bisnis, c.judul');
		$this->db->from('trx_broadcast a');
		$this->db->join('tbl_bisnis b', 'a.id_bisnis = b.id_bisnis', 'left');
		$this->db->join('trx_produk c', 'a.id_produk = c.id_produk', 'left');
		if ($wh!="") {
			$this->db->where($wh);
		}
		return $this->db->get();
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
