<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiPasarSekunder extends CI_Controller {
	function __construct(){
		parent::__construct();
    $this->load->helper('url');
    $this->load->model('M_transaksipasarsekunder');
    $this->load->model('m_invest');
    $this->load->model('M_admin');
    $this->load->library(array("session","form_validation"));
	}

	public function index() {
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/transaksipasarsekunder';
			$this->load->view('admin/indexadmin', $data);
		} else {
			$this->load->view('login');
		}
	}
	
	public function tampil()
	{
		$data['dataProduk'] = $this->M_transaksipasarsekunder->select_all();
		$this->load->view('admin/transaksipasarsekunder/list_data', $data);
	}

	public function update($id) {
		$where = array('ps.id_dana' => $id);
		$data['dataProduk'] = $this->M_transaksipasarsekunder->select_all($where)->row();
		$data['content'] = 'admin/transaksipasarsekunder/form_update';
		$this->load->view('admin/indexadmin', $data);
	}

	public function prosesUpdate($id){
		if (!empty($this->input->post('status') && !empty($this->input->post('jenis_transaksi')))) {
			$out = array();
			$kembalikanAset = '';

			$data = ['status' => $this->input->post('status')];
			$id = $this->input->post('id');

			$currData = $this->M_transaksipasarsekunder->select_all(['ps.id' => $id])->row();
			$jenis_transaksi = $currData->jenis_transaksi;

			if ($jenis_transaksi == 'beli') {

				$updateStatus = $this->M_transaksipasarsekunder->update($data, $id);

				if ($updateStatus > 0) {
					$gross = $currData->harga_per_lembar * $currData->lembar_saham;
					$filterSaldoAwal = array("id_pengguna" => $currData->id_pengguna);
					$saldoAwal = $this->m_invest->dataDana($filterSaldoAwal)->row('saldo');

					$dataSaldo = ["saldo" => ($saldoAwal + $gross)];
					$filterSaldo = ["id_pengguna" => $currData->id_pengguna];

					$kembalikanAset = $this->m_invest->updatedata("trx_dana_saldo", $dataSaldo, $filterSaldo);
				}

			} elseif ($jenis_transaksi == 'jual') {
				$updateStatus = $this->M_transaksipasarsekunder->update($data, $id);
				$kembalikanAset = 1;
			}
			
			if ($kembalikanAset > 0) {
				$out['status'] = '';
				$out['msg'] = '
					<p class="box-msg">
					  <div class="info-box alert-success">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">Berhasil</div>
					  </div>
					</p>';
			} else{
				$out['status'] = '';
				$out['msg'] = '
					<p class="box-msg">
					  <div class="info-box alert-error">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">Gagal</div>
					  </div>
					</p>';
			}

			$this->session->set_flashdata('msg', $out['msg']);
			redirect('TransaksiPasarSekunder?id='.$id);
			// code...
		} else {
			die('invalid post');
		}
		
	}

	public function generateReportTrxPasarSekunder()
	{
		include APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';
		$excel = new PHPExcel();

		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Secondary Market Transaction Report');
		$excel->setActiveSheetIndex(0)->setCellValue('A2', '');

		$headers = array(
			// 'id',
			'Waktu Transaksi',
			'ID Transaksi',
			'Nama Pengguna',
			'Jenis Transaksi',
			'Bisnis',
			'Produk',
			'Lembar Saham',
			'Harga Per Lembar',
			// 'id_pengguna',
			// 'id_produk',
			'Total',
			'Status',
			// 'id_bisnis',
		);

		$excel->getActiveSheet()->fromArray($headers, NULL, 'A3');

		// $data = $this->M_dana->select_report_withdraw();
		$data = $this->M_transaksipasarsekunder->select_for_export()->result_array();

		$excel->getActiveSheet()->fromArray($data, NULL, 'A4');

		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3:J3')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A3:J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('H4:H10000')->getNumberFormat()->setFormatCode('#,##0');
		$excel->getActiveSheet()->getStyle('I4:I10000')->getNumberFormat()->setFormatCode('#,##0');
		$excel->getActiveSheet()->getStyle('B4:B10000')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Daftar Transaksi Pasar Sekunder.xlsx"');
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
	}

}

