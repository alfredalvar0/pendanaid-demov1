<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broadcast extends CI_Controller {
  function __construct(){
    parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
        $this->load->model('m_invest');
        $this->load->model('M_broadcast');
        $lib=array("session","form_validation");
        $this->load->library($lib);
  }

  public function index(){
    if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
      $tipe = array('tipe'=>$this->session->userdata('tipe'));
      $data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
      $data['content'] = 'admin/broadcast';
      $this->load->view('admin/indexadmin',$data);
      }else{
        $this->load->view('login');
      }
  }

  public function tampil()
  {
    $data['dataBroadcast'] = $this->M_admin->select_data_broadcast();
    $this->load->view('admin/broadcast/list_data', $data);
  }

  public function tambah()
  {
    $data['content'] = 'admin/broadcast/tambah';
    $data['dataBisnis'] = $this->M_broadcast->select_bisnis();
    $this->load->view('admin/indexadmin',$data);
  }

  public function send_broadcast()
  {
    $broadcast_type = $this->input->post('broadcast_type');
    $id_bisnis = $this->input->post('id_bisnis');
    $id_produk = $this->input->post('id_produk');
    $subject = $this->input->post('subject');
    $content = $this->input->post('content');
    $sent_time = date('Y-m-d H:i:s');

    if ($broadcast_type == "All Investor") {
      $investors = $this->M_broadcast->select_investor();
    } else if ($broadcast_type == "Investor Bisnis") {
      $investors = $this->M_broadcast->select_investor(array('d.id_bisnis' => $id_bisnis));
    } else if ($broadcast_type == "Investor Produk Bisnis") {
      $investors = $this->M_broadcast->select_investor(array('d.id_produk' => $id_produk));
    }

    foreach ($investors->result() as $inv) {
      $data['mailtitle'] = $subject;
      $data['email'] = $inv->email;
      $data['message'] = $content;
      $data['mailformat'] = $this->input->post("format");
      $content_email = $this->load->view('template/v-mail-format-notif',$data,TRUE);
      $send = $this->m_invest->kirimEmailnya($inv->email,$content_email);
    }

    $data = array(
      'broadcast_type' => $broadcast_type,
      'id_bisnis' => $id_bisnis,
      'id_produk' => $id_produk,
      'subject' => $subject,
      'content' => $content,
      'sent_time' => $sent_time
    );
    $insert= $this->M_broadcast->insert($data);

    $out['status'] = '';
    $out['msg'] = '<p class="box-msg">
        <div class="info-box alert-success">
          <div class="info-box-icon">
          <i class="fa fa-check-circle"></i>
          </div>
          <div class="info-box-content" style="font-size:20px">
          Broadcast Message Berhasil Dikirim</div>
        </div>
      </p>';
    $this->session->set_flashdata('msg', $out['msg']);
    redirect('broadcast');
  }

  public function detail($id)
  {
    $data['dataBroadcast'] = $this->M_admin->select_data_broadcast(array('id' => $id))->row();
    $data['content'] = 'admin/broadcast/detail';
    $data['dataBisnis'] = $this->M_broadcast->select_bisnis();
    $data['dataProdukBisnis'] = $this->M_broadcast->get_produk_bisnis();
    $this->load->view('admin/indexadmin',$data);
  }

  public function getprodukbisnis($id_bisnis)
  {
    $dataProdukBisnis = $this->M_broadcast->get_produk_bisnis(array('id_bisnis' => $id_bisnis))->result();
    $o = '<option value="">-- Select Produk Bisnis --</option>';
    foreach ($dataProdukBisnis as $produk) {
      $o .= "<option value='".$produk->id_produk."'>".$produk->judul."</option>";
    }
    echo $o;
  }
}
