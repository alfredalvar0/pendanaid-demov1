<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Article extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
        $this->load->model('M_article');
	}

	public function index()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['data'] = $this->M_article->select('tbl_article');
			$data['content'] = 'admin/article';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('Admin');
		}
	}

	public function tambah()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['category'] = $this->M_article->select('tbl_article_category');
			$data['content'] = 'admin/article/form_add';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('Admin');
		}
	}

	public function store()
	{
		$title = $this->input->post('title');
		$id_category = $this->input->post('id_category');
		$content = $this->input->post('content');

		$insert_data = array(
			'title' => $title,
			'id_category' => $id_category,
			'content' => $content,
			'created_by' => $this->session->userdata('id_admins'),
			'created_at' => date('Y-m-d H:i:s')
		);
		$insert = $this->db->insert('tbl_article', $insert_data);

		if ($insert) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Disimpan</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Disimpan</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article');
	}

	public function edit($id)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['category'] = $this->M_article->select('tbl_article_category');
			$data['article'] = $this->db->get_where('tbl_article', array('id' => $id))->row();
			$data['content'] = 'admin/article/form_edit';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('Admin');
		}
	}

	public function update($id)
	{
		$title = $this->input->post('title');
		$id_category = $this->input->post('id_category');
		$content = $this->input->post('content');

		$update_data = array(
			'title' => $title,
			'id_category' => $id_category,
			'content' => $content,
			'updated_by' => $this->session->userdata('id_admins'),
			'updated_at' => date('Y-m-d H:i:s')
		);
		$update = $this->db->set($update_data)->where('id', $id)->update('tbl_article');

		if ($update) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Disimpan</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Disimpan</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article');
	}

	public function delete($id)
	{
		$delete = $this->db->delete('tbl_article', array('id' => $id));

		if ($delete) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Didelete</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Didelete</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article');
	}

	public function list_data_article()
	{
		$search_id_category = $this->input->post('id_category');
		$search_title = $this->input->post('title');

		echo $this->M_article->get_list_data(array('id_category' => $search_id_category, 'title' => $search_title));
	}

	// category
	public function category()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['data'] = $this->M_article->select('tbl_article_category');
			$data['content'] = 'admin/category_article';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('Admin');
		}
	}

	public function tampil_category()
	{
		$data['category'] = $this->M_article->select('tbl_article_category');
    	$this->load->view('admin/category_article/list_data', $data);
	}

	public function category_store()
	{
		$category = $this->input->post('category');

		$insert = $this->db->insert('tbl_article_category', array('category' => $category));
		if ($insert) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Disimpan</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Disimpan</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article/category');
	}

	public function category_update($id)
	{
		$category = $this->input->post('category');

		$update = $this->db->set(array('category' => $category))->where('id', $id)->update('tbl_article_category');
		if ($update) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Disimpan</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Disimpan</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article/category');
	}

	public function category_delete($id)
	{
		$delete = $this->db->delete('tbl_article_category', array('id' => $id));

		if ($delete) {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-success">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Berhasil Dihapus</div>
	          </div>
	        </p>';
	    } else {
	      $out['status'] = '';
	      $out['msg'] = '<p class="box-msg">
	          <div class="info-box alert-danger">
	            <div class="info-box-icon">
	            <i class="fa fa-check-circle"></i>
	            </div>
	            <div class="info-box-content" style="font-size:20px">
	            Data Gagal Dihapus</div>
	          </div>
	        </p>';
	    }

	    $this->session->set_flashdata('msg', $out['msg']);
    	redirect('Article/category');
	}
}