<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meta extends CI_Controller {

	private $tableHeader = 'tbl_meta_header';

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_meta');
        $this->load->model('M_admin');
	}

	public function index()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['content'] = 'admin/meta';
			$data['data'] = $this->M_meta->getListPage();
			$this->load->view('admin/indexadmin',$data);

		}else{
			redirect('Admin');
		}
	}

	public function detail($id)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['content'] = 'admin/meta/detail';
			$data['data'] = $this->M_meta->getListMeta(array('id_header' => $id));
			$data['id_header'] = $id;
			$this->load->view('admin/indexadmin',$data);

		}else{
			redirect('Admin');
		}
	}

	public function add()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['content'] = 'admin/meta/form';
			$this->load->view('admin/indexadmin',$data);

		}else{
			redirect('Admin');
		}
	}

	public function add_detail($id_header)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['id_header'] = $id_header;
			$data['content'] = 'admin/meta/form_detail';
			$this->load->view('admin/indexadmin',$data);

		}else{
			redirect('Admin');
		}
	}

	public function insert()
	{
		$page_uri = $this->input->post('page_uri');

		$insert = $this->M_meta->insert(array('page_uri' => $page_uri));
		if ($insert > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data URL Berhasil Disimpan, silahkan setting tagnya';
			$this->session->set_flashdata($out);
			redirect('Meta/detail/'.$insert);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Data gagal disimpan';
			$this->session->set_flashdata($out);
			redirect('Meta');
		}
	}

	public function insert_detail($id_header)
	{
		$name = $this->input->post('name');
		$content = $this->input->post('content');

		$insert = $this->M_meta->insert(array('name' => $name, 'id_header' => $id_header, 'content' => $content), 'tbl_meta_detail');
		if ($insert > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Berhasil Disimpan';
			$this->session->set_flashdata($out);
			redirect('Meta/detail/'.$id_header);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Data gagal disimpan';
			$this->session->set_flashdata($out);
			redirect('Meta/detail/'.$id_header);
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['content'] = 'admin/meta/form_edit';
			$data['data'] = $this->M_meta->getHeaderWhereId(array('id' => $id));
			$this->load->view('admin/indexadmin',$data);
		}else{
			redirect('Admin');
		}
	}

	public function edit_detail($id_header, $id_detail)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['content'] = 'admin/meta/form_edit_detail';
			$data['id_header'] = $id_header;
			$data['data'] = $this->M_meta->getDetailWhereId(array('id' => $id_detail));
			$this->load->view('admin/indexadmin',$data);
		}else{
			redirect('Admin');
		}
	}

	public function update($id)
	{
		$page_uri = $this->input->post('page_uri');
		$update = $this->M_meta->update($id, array('page_uri' => $page_uri));
		if ($update > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data URL Berhasil Diupdate';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Tidak ada data yang diupdate';
			$this->session->set_flashdata($out);
		}
		redirect('Meta');
	}

	public function update_detail($id_header, $id_detail)
	{
		$name = $this->input->post('name');
		$content = $this->input->post('content');

		$update = $this->M_meta->update($id_detail, array('name' => $name, 'content' => $content), 'tbl_meta_detail');
		if ($update > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Berhasil Diupdate';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Tidak ada data yang diupdate';
			$this->session->set_flashdata($out);
		}
		redirect('Meta/detail/'.$id_header);
	}

	public function delete($id)
	{
		$isDeleted = $this->M_meta->delete($this->tableHeader, array('id' => $id));
		if ($isDeleted > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data URL Berhasil Dihapus';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Tidak ada data yang dihapus';
			$this->session->set_flashdata($out);
		}
		redirect('Meta');
	}

	public function delete_detail($id_header, $id_detail)
	{
		$isDeleted = $this->M_meta->delete('tbl_meta_detail', array('id' => $id_detail));
		if ($isDeleted > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Berhasil Dihapus';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Tidak ada data yang dihapus';
			$this->session->set_flashdata($out);
		}
		redirect('Meta/detail/'.$id_header);
	}
}