<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_danainvest extends CI_Model {

	public function select_dana($where=""){
		$this->db->select('a.*,b.nama_pengguna,c.judul,d.username,e.type_dana,b.nama_pengguna,b.no_ktp,IF(b.jenis_kelamin = "L", "Laki-laki", "Perempuan") AS jenis_kelamin,
		CONCAT(b.tempat_lahir, " / ", b.tgl_lahir) AS ttl, f.nama_agama AS agama, g.nama_pendidikan AS pendidikan, h.profesi AS pekerjaan, b.alamat_ktp');
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_admin d','d.id_admin=b.id_admin','left');
		$this->db->join('trx_dana e','e.id_dana = a.id_dana','left');
		$this->db->join('tbl_agama f','f.id_agama = b.agama','left');
		$this->db->join('tbl_pendidikan g','g.id_pendidikan = b.pendidikan_terakhir','left');
		$this->db->join('tbl_profesi h','h.id_profesi = b.pekerjaan','left');
		if ($where!="") {
			$this->db->where($where);
		}
		$this->db->order_by("a.createddate","desc");
		return $this->db->get();
	}

	public function get_list_data($where=""){
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

		$query=array();
		$this->db->start_cache();
		$this->db->select('a.*,b.nama_pengguna,c.judul,d.username,e.type_dana,b.nama_pengguna,b.no_ktp,IF(b.jenis_kelamin = "L", "Laki-laki", "Perempuan") AS jenis_kelamin,
		CONCAT(b.tempat_lahir, " / ", b.tgl_lahir) AS ttl, f.nama_agama AS agama, g.nama_pendidikan AS pendidikan, h.profesi AS pekerjaan, b.alamat_ktp');
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_admin d','d.id_admin=b.id_admin','left');
		$this->db->join('trx_dana e','e.id_dana = a.id_dana','left');
		$this->db->join('tbl_agama f','f.id_agama = b.agama','left');
		$this->db->join('tbl_pendidikan g','g.id_pendidikan = b.pendidikan_terakhir','left');
		$this->db->join('tbl_profesi h','h.id_profesi = b.pekerjaan','left');
		$this->db->order_by("a.createddate", "asc");
		$num_rows = $this->db->get()->num_rows();

		if ($this->input->post('tipe') != "") {
			$this->db->like('a.type_dana', $this->input->post('tipe'));
		}

		if ($this->input->post('produk') != "") {
			$this->db->like('c.judul', $this->input->post('produk'));
		}

		if ($this->input->post('user') != "") {
			$this->db->like('d.username', $this->input->post('user'));
		}

		if ($this->input->post('status_approve') != "") {
			$this->db->like('a.status_approve', $this->input->post('status_approve'));
		}

		$num_rows_filtered = $this->db->get()->num_rows();
		$this->db->limit($limit, $start);
		$raw_data = $this->db->get()->result_array();

		$data = array();
		foreach ($raw_data as $idx => $dt) {
			$data[$idx] = $dt;
			$data[$idx]["action"] = '<a href="'.base_url().'DanaInvest/update/'.$dt[id_dana].'">
						<button class="btn btn-warning btn-sm">
							<input type="hidden" name="id_dana" value="'.$dt[id_dana].'">
							<i class="glyphicon glyphicon-repeat"></i> Update
						</button>
					</a>';
		}

		$this->db->flush_cache();
		$callback = array(
        'draw' => $this->input->post('draw'), // Ini dari datatablenya
        'recordsTotal' => $num_rows,
        'recordsFiltered'=>$num_rows_filtered,
        'data'=>$data
    );
    return json_encode($callback);
	}

	public function select_dana2($where, $additional_info){



		$this->db->select('a.*,b.nama_pengguna,c.judul,d.username,e.type_dana,b.nama_pengguna,b.no_ktp,IF(b.jenis_kelamin = "L", "Laki-laki", "Perempuan") AS jenis_kelamin,
		CONCAT(b.tempat_lahir, " / ", b.tgl_lahir) AS ttl, f.nama_agama AS agama, g.nama_pendidikan AS pendidikan, h.profesi AS pekerjaan, b.alamat_ktp, (SELECT name FROM tbl_kabkota WHERE id = b.kabkota_ktp) AS kabkota_ktp,
	(SELECT name FROM tbl_provinsi WHERE id = b.prov_ktp) AS prov_ktp,
	(SELECT country_name FROM tbl_negara WHERE id = b.negara_ktp) AS negara_ktp,
	b.no_hp,
	b.alamat_domisili,
	(SELECT name FROM tbl_kabkota WHERE id = b.kabkota_domisili) AS kabkota_domisili,
	(SELECT name FROM tbl_provinsi WHERE id = b.prov_domisili) AS prov_domisili,
	(SELECT country_name FROM tbl_negara WHERE id = b.negara_domisili) AS negara_domisili');
		$this->db->from('trx_dana_invest a');
		$this->db->join('tbl_pengguna b','a.id_pengguna=b.id_pengguna','left');
		$this->db->join('trx_produk c','a.id_produk=c.id_produk','left');
		$this->db->join('tbl_admin d','d.id_admin=b.id_admin','left');
		$this->db->join('trx_dana e','e.id_dana = a.id_dana','left');
		$this->db->join('tbl_agama f','f.id_agama = b.agama','left');
		$this->db->join('tbl_pendidikan g','g.id_pendidikan = b.pendidikan_terakhir','left');
		$this->db->join('tbl_profesi h','h.id_profesi = b.pekerjaan','left');

		if ($where["periode_from"] != "" && $where["periode_until"] != "") {
			$this->db->where("(a.createddate BETWEEN '".$where["periode_from"]."' AND '".$where["periode_until"]."')", NULL);
		}

		if ($where["produk"] != "") {
			$this->db->where("c.judul LIKE '%".$where["produk"]."%'", NULL);
		}

		if ($where["user"] != "") {
			$this->db->where("d.username LIKE '%".$where["user"]."%'", NULL);
		}

		if ($where["status"] != "") {
			$this->db->where("a.status_approve LIKE '%".$where["status"]."%'", NULL);
		}

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

	public function refundSaldo($price, $iddana, $id)
	{
		$dataDataInvest = $this->db->get_where('trx_dana_invest', array('id_dana' => $iddana));

		foreach ($dataDataInvest->result() as $row) {
			$this->db->insert('trx_dana_invest_refund', array(
				'id_pengguna' => $id,
				'id_produk' => $row->id_produk,
				'lembar_saham' => $row->lembar_saham,
				'jumlah_dana' => $row->jumlah_dana,
				'createddate' => date('Y-m-d H:i:s')
			));
		}
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
