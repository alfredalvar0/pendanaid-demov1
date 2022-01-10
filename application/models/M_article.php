<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_article extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function select($table = 'tbl_article', $where = "")
	{
		$this->db->select('*');
		$this->db->from($table);
		if ($where != "") {
			$this->db->where($where);
		}
		return $this->db->get()->result();
	}

	public function get_list_data($wh="")
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

		$query=array();
		$this->db->start_cache();
		$this->db->select('a.*, b.category');
		$this->db->from('tbl_article a');
		$this->db->join('tbl_article_category b', 'a.id_category = b.id', 'LEFT');
		$num_rows = $this->db->get()->num_rows();
		
		if ($this->input->post('id_category') != "") {
			$this->db->like('id_category', $this->input->post('id_category'));
		}

		if ($this->input->post('title') != "") {
			$this->db->like('title', $this->input->post('title'));
		}
		
		$num_rows_filtered = $this->db->get()->num_rows();
		$this->db->limit($limit, $start);
		$data = $this->db->get()->result_array();

		$datatables = array();
		foreach ($data as $key => $value) {
			$datatables[$key] = $value;
			$datatables[$key]['action'] = "<a href='".base_url()."article/edit/".$value['id']."' class='btn btn-warning btn-sm'>Edit</a> <a href='".base_url()."article/delete/".$value['id']."' onclick='javascript:return confirm(\"Anda Yakin ?\")' class='btn btn-danger btn-sm'>Delete</a>";
		}

		$this->db->flush_cache();
		$callback = array(    
            'draw' => $this->input->post('draw'), // Ini dari datatablenya    
            'recordsTotal' => $num_rows,    
            'recordsFiltered'=>$num_rows_filtered,    
            'data'=>$datatables
        );
        return json_encode($callback);
	}
}