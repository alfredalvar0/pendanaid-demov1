<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toc extends CI_Controller {
  function __construct(){
    parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_toc');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
  }

  public function index(){
    if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
      $tipe = array('tipe'=>$this->session->userdata('tipe'));
      $data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
      $data['content'] = 'admin/toc';
      $this->load->view('admin/indexadmin',$data);
      }else{
        $this->load->view('login');
      }
  }

  public function tampil()
  {
    $data['dataToc'] = $this->M_toc->select_toc();
    $this->load->view('admin/toc/list_data', $data);
  }

  public function tambah()
  {
    $data['content'] = 'admin/toc/tambah';
    $this->load->view('admin/indexadmin',$data);
  }

  public function update($id)
  {
    $data['toc'] = $this->M_toc->get_data_toc(array('id' => $id))->row();
    $data['content'] = 'admin/toc/update';
    $this->load->view('admin/indexadmin',$data);
  }

  public function proses_add()
  {
    $title = $this->input->post('title');
    $mulai_berlaku = $this->input->post('mulai_berlaku');
    $toc = $this->input->post('toc');
    $is_aktif = $this->input->post('is_aktif');

    $data = array(
      'title' => $title,
      'mulai_berlaku' => $mulai_berlaku,
      'toc' => $toc,
      'is_aktif' => $is_aktif
    );

    $inactive_all = $this->M_toc->inactive_all();
    $insert = $this->M_toc->insertdata('tbl_toc', $data);
    if ($insert > 0) {
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
    redirect('Toc');
  }

  public function proses_update($id)
  {
    $title = $this->input->post('title');
    $mulai_berlaku = $this->input->post('mulai_berlaku');
    $toc = $this->input->post('toc');
    $is_aktif = $this->input->post('is_aktif');

    $data = array(
      'title' => $title,
      'mulai_berlaku' => $mulai_berlaku,
      'toc' => $toc,
      'is_aktif' => $is_aktif
    );

    $update = $this->M_toc->updatedata('tbl_toc', $data, array('id' => $id));
    if ($update > 0) {
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
    redirect('Toc');
  }
}
