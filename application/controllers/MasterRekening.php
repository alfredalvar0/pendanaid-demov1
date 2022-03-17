<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterRekening extends CI_Controller {

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
			$data['bank'] = $this->db->get('tbl_bank');
			$data['content'] = 'admin/masterrekening';
			$this->load->view('admin/indexadmin',$data);
		}else{
            redirect('Admin');
		}
	}

	public function list_data()
    {
        $bank_id= $this->input->post('bank_id');
        $account_no= $this->input->post('account_no');

        echo $this->get_list_data(array(
            'bank_id' => $bank_id,
            'account_no' => $account_no
        ));
    }

    public function get_list_data($wh="")
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

        $sql = "SELECT
					b.nama_bank, a.account_no, a.account_owner, a.bank_id, a.id
				FROM tbl_payment_account a	
				JOIN tbl_bank b ON a.bank_id = b.id_bank";

        $num_rows = $this->db->query($sql)->num_rows();

        if ($wh['bank_id'] != "") {
            $sql .= " AND a.bank_id = '{$wh['bank_id']}'";
        }

        if ($wh['account_no'] != "") {
            $sql .= " AND a.account_no LIKE '%{$wh['account_no']}%'";
        }

        $num_rows_filtered = $this->db->query($sql)->num_rows();

        $sql .= " LIMIT {$start}, {$limit}";

		$data = $this->db->query($sql)->result_array();

        foreach ($data as $key => $value) {
        	
            $data[$key]['action'] = "<a class='btn btn-sm btn-primary' href='".base_url()."MasterRekening/edit/".$value['id']."'>Edit</a> <a class='btn btn-sm btn-danger' onclick='return confirm(\"Anda Yakin ?\")' href='".base_url()."MasterRekening/delete/".$value['id']."'>Delete</a>"; 
            
        }

		$callback = array(
            'draw' => $this->input->post('draw'), // Ini dari datatablenya
            'recordsTotal' => $num_rows,
            'recordsFiltered'=>$num_rows_filtered,
            'data'=>$data
        );
        return json_encode($callback);
	}


	public function add()
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['content'] = 'admin/masterrekening/form_add';
			$data['bank'] = $this->db->get('tbl_bank');
			$this->load->view('admin/indexadmin',$data);

		}else{
			redirect('Admin');
		}
	}

	public function store()
	{
		$bank_id = $this->input->post('bank_id');
		$account_no = $this->input->post('account_no');
		$account_owner = $this->input->post('account_owner');

		$insert = $this->db->insert('tbl_payment_account', array('bank_id' => $bank_id, 'account_no' => $account_no, 'account_owner' => $account_owner));
		if ($insert) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Rekening Berhasil Disimpan';
			$this->session->set_flashdata($out);
			redirect('MasterRekening');
		} else {
			$out['status'] = 'danger';
			$out['msg'] = 'Data Rekening Gagal Disimpan';
			$this->session->set_flashdata($out);
			redirect('MasterRekening');
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$data['content'] = 'admin/masterrekening/form_update';
			$data['bank'] = $this->db->get('tbl_bank');
			$data['masterrekening'] = $this->db->get_where('tbl_payment_account', array('id' => $id))->row_array();
			$this->load->view('admin/indexadmin',$data);
		}else{
			redirect('Admin');
		}
	}

	public function update($id)
	{
		$bank_id = $this->input->post('bank_id');
		$account_no = $this->input->post('account_no');
		$account_owner = $this->input->post('account_owner');

		$update = $this->db->set(array('bank_id' => $bank_id, 'account_no' => $account_no, 'account_owner' => $account_owner))->where('id', $id)->update('tbl_payment_account');
		if ($update) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Berhasil Diupdate';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Tidak gagal diupdate';
			$this->session->set_flashdata($out);
		}
		redirect('MasterRekening');
	}

	public function delete($id)
	{
		$isDeleted = $this->db->delete('tbl_payment_account', array('id' => $id));
		if ($isDeleted > 0) {
			$out['status'] = 'success';
			$out['msg'] = 'Data Berhasil Dihapus';
			$this->session->set_flashdata($out);
		} else {
			$out['status'] = 'failed';
			$out['msg'] = 'Data gagal dihapus';
			$this->session->set_flashdata($out);
		}
		redirect('MasterRekening');
	}
}