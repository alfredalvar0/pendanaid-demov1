<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class M_produk extends CI_Model {

	public function select_all($where=""){
		$this->db->select('a.*,b.nama_binsis,coalesce(c.jum,0) as jum');
		$this->db->from('trx_produk a');
		$this->db->join('tbl_bisnis b','a.id_bisnis=b.id_bisnis','left');
		$this->db->join('(select id_produk,count(*) as jum from trx_dana_invest group by id_produk) c','c.id_produk=a.id_produk','left');
		if ($where!="") {
			$this->db->where($where);
		}
		return $this->db->get();
	}	

	public function insert($data) {
        $this->db->insert('trx_produk',$data);
        return $this->db->affected_rows(); 
	}

	public function insertpesan($data) {
        $this->db->insert('tbl_pesan',$data);
        return $this->db->affected_rows(); 
	}

	public function update($data,$id) {
	  $this->db->where('id_produk',$id);
      $this->db->update('trx_produk',$data);
      return $this->db->affected_rows();
	}

	public function del_data($table,$id){
        $this->db->delete($table,$id);
        return $this->db->affected_rows();
    }

    public function get_list_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

		$query=array();
		$this->db->start_cache();
		$this->db->select('a.*,b.nama_binsis,coalesce(c.jum,0) as jum');
		$this->db->from('trx_produk a');
		$this->db->join('tbl_bisnis b','a.id_bisnis=b.id_bisnis','left');
		$this->db->join('(select id_produk,count(*) as jum from trx_dana_invest group by id_produk) c','c.id_produk=a.id_produk','left');
		$num_rows = $this->db->get()->num_rows();
		
		// if ($this->input->post('tipe') != "") {
		// 	$this->db->like('trx_dana.type_dana', $this->input->post('tipe'));
		// }

		// if ($this->input->post('produk') != "") {
		// 	$this->db->like('trx_produk.judul', $this->input->post('produk'));
		// }

		// if ($this->input->post('user') != "") {
		// 	$this->db->like('tbl_admin.username', $this->input->post('user'));
		// }

		// if ($this->input->post('status_approve') != "") {
		// 	$this->db->like('trx_dana.status_approve', $this->input->post('status_approve'));
		// }
		
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

	function refund_produk($idproduk) {

		$sql = "SELECT
					id_pengguna,
					id_produk,
					SUM(lembar_saham) AS lembar_saham,
					SUM(jumlah_dana) AS jumlah_dana
				FROM trx_dana_invest
				WHERE id_produk = '{$idproduk}' AND status_approve NOT IN ('cancel', 'refuse')
				GROUP BY id_pengguna";
		$get_investor = $this->db->query($sql)->result();

		foreach ($get_investor as $inv) {
			$id_refund = date('YmdHiu');
			$data_refund = array(
				'id_refund' => $id_refund,
				'id_pengguna' => $inv->id_pengguna,
				'id_produk' => $inv->id_produk,
				'lembar_saham' => $inv->lembar_saham,
				'jumlah_dana' => $inv->jumlah_dana,
				'createddate' => date('Y-m-d H:i:s'),
				'status_approve' => 'completed'
			);
			$this->db->insert('trx_dana_invest_refund', $data_refund);

			$data_trx_dana = array(
				'id_dana' => $id_refund,
				'id_pengguna' => $inv->id_pengguna,
				'id_bank' => NULL,
				'nama_akun' => NULL,
				'no_rek' => NULL,
				'type_dana' => 'tambah',
				'jumlah_dana' => $inv->jumlah_dana,
				'status_approve' => 'approve',
				'notes' => 'Refund produk saham',
				'createddate' => date('Y-m-d H:i:s')
			);
			$this->db->insert('trx_dana', $data_trx_dana);

			$this->db->query("UPDATE trx_dana_saldo SET saldo = saldo + {$inv->jumlah_dana} WHERE id_pengguna = '{$inv->id_pengguna}'");
		}
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */