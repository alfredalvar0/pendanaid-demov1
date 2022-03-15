<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentConfirmation extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
		$this->load->library("session");
        $this->load->helper('url');
        $this->load->model('M_admin');
		$this->load->model('M_akun');
		$this->load->model('m_invest');
        $this->load->model('Google_login_model');
        $lib=array("session","form_validation");
        $this->load->library($lib);
    }

    public function index()
    {
        if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
            $tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['rekening_pembayaran'] = $data['nomor_rekening']=$this->db->query("
					select a.*, b.nama_bank from  tbl_payment_account a
					join tbl_bank b ON a.bank_id = b.id_bank
					where a.active = 1
				");
			$data['bank'] = $this->db->get('tbl_bank');
			$data['content'] = 'admin/paymentconfirm';
			$data['history']=$this->m_invest->dataDanaHistoryTransaksiAdmin();
			$this->load->view('admin/indexadmin',$data);
		}else{
            redirect('Admin');
		}
    }

    public function list_data()
    {
        $payment_account_id= $this->input->post('payment_account_id');
        $bank_id_from= $this->input->post('bank_id_from');
        $account_no= $this->input->post('account_no');
        $account_owner= $this->input->post('account_owner');
        $approval_status= $this->input->post('approval_status');

        echo $this->get_list_data(array(
            'payment_account_id' => $payment_account_id,
            'bank_id_from' => $bank_id_from,
            'account_no' => $account_no,
            'account_owner' => $account_owner,
            'approval_status' => $approval_status
        ));
    }

    public function get_list_data($wh="")
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');

        $sql = "SELECT
                    tkp.id,
                	CONCAT(tpa.account_no , ' ', tpa.nama_bank, ' a/n ', tpa.account_owner) AS rekening_pembayaran,
                	tkp.account_name ,
                	tkp.account_no ,
                	tb.nama_bank ,
                	tkp.amount ,
                	tkp.transfer_proof ,
                	UPPER(tkp.approval_status) AS approval_status
                FROM trx_konfirmasi_pembayaran tkp
                JOIN (
                	select a.*, b.nama_bank from  tbl_payment_account a
                	join tbl_bank b ON a.bank_id = b.id_bank
                ) tpa ON tkp.payment_account_id = tpa.id
                JOIN tbl_bank tb ON tb.id_bank = tkp.bank_id_from
                WHERE tkp.id = tkp.id";

        $num_rows = $this->db->query($sql)->num_rows();

        if ($wh['payment_account_id'] != "") {
            $sql .= " AND tkp.payment_account_id LIKE '%{$wh['payment_account_id']}%'";
        }

        if ($wh['bank_id_from'] != "") {
            $sql .= " AND tkp.bank_id_from LIKE '%{$wh['bank_id_from']}%'";
        }

        if ($wh['account_no'] != "") {
            $sql .= " AND tkp.account_no LIKE '%{$wh['account_no']}%'";
        }

        if ($wh['account_owner'] != "") {
            $sql .= " AND tkp.account_name LIKE '%{$wh['account_owner']}%'";
        }

        if ($wh['approval_status'] != "") {
            $sql .= " AND tkp.approval_status LIKE '%{$wh['approval_status']}%'";
        }

        $num_rows_filtered = $this->db->query($sql)->num_rows();

        $sql .= " LIMIT {$start}, {$limit}";

		$data = $this->db->query($sql)->result_array();

        foreach ($data as $key => $value) {
            $data[$key]['amount'] = number_format($value['amount']);
            $data[$key]['transfer_proof'] = "<a href='".base_url().$value['transfer_proof']."' target='_blank'>Bukti Transfer</a>";

            if ($value['approval_status'] != 'pending') {
                $data[$key]['action'] = "";
            } else {
                $data[$key]['action'] = "<button class='btn btn-sm btn-success' onclick='approve(".$value['id'].")'>Approve</button> <button class='btn btn-sm btn-danger' onclick='reject(".$value['id'].")'>Reject</button>"; 
            }
            
        }

		$callback = array(
            'draw' => $this->input->post('draw'), // Ini dari datatablenya
            'recordsTotal' => $num_rows,
            'recordsFiltered'=>$num_rows_filtered,
            'data'=>$data
        );
        return json_encode($callback);
	}

    public function confirm($id)
    {
        $approval_status = $this->input->post('approval_status');

        $sql = "UPDATE trx_konfirmasi_pembayaran
                SET approval_status = '{$approval_status}', approval_date = CURRENT_TIMESTAMP, approval_by = '{$this->session->userdata('id_admins')}'
                WHERE id = '{$id}'";

        $query = $this->db->query($sql);

        $data = $this->db->query("
            SELECT a.amount, b.id_pengguna FROM `trx_konfirmasi_pembayaran` a
            LEFT JOIN trx_dana b ON a.id_transaksi = b.id
            WHERE a.id = '{$id}'
        ")->row();

        if ($approval_status == "approve") {
            $this->Google_login_model->add_user_amount($data->amount,$data->id_pengguna);
        }

        if ($query) {
            echo "ok";
        } else {
            echo "fail";
        }
    }
}
