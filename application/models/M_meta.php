<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_meta extends CI_Model {

	public function getListPage()
	{
		return $this->db->get('tbl_meta_header');
	}

	public function getListMeta($wh)
	{
		return $this->db->get_where('tbl_meta_detail', $wh);
	}

	public function getHeaderWhereId($wh)
	{
		return $this->db->get_where('tbl_meta_header', $wh)->row_array();
	}

	public function getDetailWhereId($wh)
	{
		return $this->db->get_where('tbl_meta_detail', $wh)->row_array();
	}

	public function insert($data, $tbl = 'tbl_meta_header')
	{
		$insert_id = 0;
		$this->db->insert($tbl, $data);
		return $insert_id = $this->db->insert_id();
	}

	public function update($id, $data, $tbl = 'tbl_meta_header')
	{
		$this->db->set($data)->where('id', $id)->update($tbl);
		return $this->db->affected_rows();
	}

	public function delete($tbl_name, $wh)
	{
		$this->db->delete($tbl_name, $wh);
		return $this->db->affected_rows();
	}
}
