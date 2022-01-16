<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invest extends CI_Controller {

	/**up
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        // Your own constructor code
        $helper=array("url","cookie",'pdf_helper');
        $this->load->helper($helper);
        $this->load->model('m_invest');
        $this->load->library("session");
        $this->load->library('facebook');
        $this->load->library('google');
        //midtrns bode
        //$params = array('server_key' => 'SB-Mid-server-yhZPMffxn038Xfln9rcSWTOH', 'production' => false);

        //midtrans
        //$params = array('server_key' => 'SB-Mid-server-Z-7Ujc_1WG6cTZESCsGztuBe', 'production' => false);
		$wh=array("modul"=>"midtrans");
        $midtrans = $this->m_invest->refferal_setting($wh)->row();
		$val = json_decode($midtrans->value);
        //$params = array('server_key' => 'SB-Mid-server-yhZPMffxn038Xfln9rcSWTOH', 'production' => false);
		$production=$val->production=="true"?true:false;
		$params = array('server_key' => $val->server_key, 'production' => $production);
		$this->load->library('veritrans');
		$this->veritrans->config($params);


		$lib=array("phpmailer_library","session");
		$this->load->library($lib);
    }



	public function index(){
	    if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
    	    $data=array();
			//$wh=array("p.status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running"));
    	    $data['data_produk']=$this->m_invest->dataProduk("","","",$whi);
    	    $data['sidebar']=$this->load->view("template/sidebar_investor", $data, TRUE);
    	    $data['content']=$this->load->view("home", $data, TRUE);
    		$this->load->view('index',$data);
	    }
	}

	public function indexfilter(){
		$data=$this->input->post();
		$wh=array();
		$whi=array("p.status_approve"=>array("approve","complete","invest","running"));
		if($data['kampanye']!="all"){
			//$wh[]="";
		}
		if($data['tenor']!="all"){
			if($data['tenor']=="lt6"){
				$wh['p.finansial_dividen_waktu <=']="1";
			} else if($data['tenor']=="gt6"){
				$wh['p.finansial_dividen_waktu >']="1";
			}
		}
		if($data['bunga']!="all"){
			if($data['bunga']=="lt12"){
				$wh['p.finansial_dividen <=']="50";
			} else if($data['bunga']=="gt12"){
				$wh['p.finansial_dividen >']="50";
			}
		}
		/* if($data['agunan']!="all"){
			if($data['agunan']=="Ada"){
				$wh['p.agunan']=$data['agunan'];
			} else if($data['agunan']=="Tidak"){
				$wh['p.agunan']=$data['agunan'];
			}
		} */
		$or=array();
		if($data['urutan']!="all"){
			if($data['urutan']=="Oldest"){
				$or['p.datecreated']="asc";
			} else if($data['urutan']=="Newest"){
				$or['p.datecreated']="desc";
			} else if($data['urutan']=="Smallest"){
				$or['p.nilai_bisnis']="asc";
			} else if($data['urutan']=="Biggest"){
				$or['p.nilai_bisnis']="desc";
			} else if($data['urutan']=="smallrose"){
				$or['p.finansial_dividen']="asc";
			} else if($data['urutan']=="bigrose"){
				$or['p.finansial_dividen']="desc";
			}

			//$wh[]="";
		}

    	$data['data_produk']=$this->m_invest->dataProduk($wh,$or,"",$whi);
        $this->load->view("list-data",$data);




	}

	public function indexfilterSekunder(){
		$data=$this->input->post();
		$wh=array();
		$whi=array("p.status_approve"=>array("approve","complete","invest","running"));
		if($data['kampanye']!="all"){
			//$wh[]="";
		}
		if($data['tenor']!="all"){
			if($data['tenor']=="lt6"){
				$wh['p.finansial_dividen_waktu <=']="1";
			} else if($data['tenor']=="gt6"){
				$wh['p.finansial_dividen_waktu >']="1";
			}
		}
		if($data['bunga']!="all"){
			if($data['bunga']=="lt12"){
				$wh['p.finansial_dividen <=']="50";
			} else if($data['bunga']=="gt12"){
				$wh['p.finansial_dividen >']="50";
			}
		}
		/* if($data['agunan']!="all"){
			if($data['agunan']=="Ada"){
				$wh['p.agunan']=$data['agunan'];
			} else if($data['agunan']=="Tidak"){
				$wh['p.agunan']=$data['agunan'];
			}
		} */
		$or=array();
		if($data['urutan']!="all"){
			if($data['urutan']=="Oldest"){
				$or['p.datecreated']="asc";
			} else if($data['urutan']=="Newest"){
				$or['p.datecreated']="desc";
			} else if($data['urutan']=="Smallest"){
				$or['p.nilai_bisnis']="asc";
			} else if($data['urutan']=="Biggest"){
				$or['p.nilai_bisnis']="desc";
			} else if($data['urutan']=="smallrose"){
				$or['p.finansial_dividen']="asc";
			} else if($data['urutan']=="bigrose"){
				$or['p.finansial_dividen']="desc";
			}

			//$wh[]="";
		}

    	$data['data_produk']=$this->m_invest->dataProdukSekunder($wh,$or,"",$whi);
        $this->load->view("list-data-sekunder",$data);




	}
	public function angsuran(){
		$total=$this->input->post("jumlah");
		$bungaprs=(($this->input->post("bagi_hasil")/12)/100);
		$tb = $total*$bungaprs;
		$bungany=$tb;
		?>
		<div class="row p-1">
			<!-- <h5 class="col-12">Pengembalian</h5> -->
			<div class="col-6">Jumlah Pinjaman</div>
			<div class="col-6 text-right">Rp. <?php echo number_format($total,0,".","."); ?></div>
			<div class="col-6">Bunga</div>
			<div class="col-6 text-right">Rp. <?php echo number_format($tb,0,".","."); ?></div>
			<table class="col-12 table table-bordered">
				<thead>
					<tr>
						<th scope="col">Tanggal</th>
						<th scope="col">Pokok</th>
						<th scope="col">Bunga</th>
						<th scope="col">Total</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php

						// Start date
						$date = $this->input->post("tglakhir");

						// End date
						$end_date = date ("Y-m-d", strtotime("+".$this->input->post("tenor")." month", strtotime($date)));
						$i=0;
						$pokok=$total/$this->input->post("tenor");
						$tp=0;
						$tb=0;
						$ta=0;
						$sisa = $total;
						while (strtotime($date) < strtotime($end_date)) {
							$i++;

							$bunga = $sisa* $bungaprs;
							$ms = date ("m", strtotime("+1 month", strtotime($date)));
							$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
							$jum=$pokok+$bunga;
							$pokokny = $i<$this->input->post("tenor")?0:$total;
							$bungany = $total*$bungaprs;
							$jum=$i<$this->input->post("tenor")?$bungany:$total+$bungany;
							?>
							<tr>
								<td><?php echo $date; ?></td>
								<td class="text-right">Rp. <?php echo number_format($pokokny,0,".","."); ?></td>
								<td class="text-right">Rp. <?php echo number_format($bungany,0,".","."); ?></td>
								<td class="text-right">Rp. <?php echo number_format($jum,0,".","."); ?></td>
							</tr>
							<?php
							$ta=$ta+$jum;
							$sisa=$total-($pokok*$i);
						}
						?>
					</tr>
				</tbody>
				<!-- <tfoot>
					<tr>
						<td colspan="3"></td>
						<td class="text-right">Rp. <?php //echo number_format($ta,0,".","."); ?></td>
					</tr>
				</tfoot> -->
			</table>
		</div>
		<?php
	}
	public function besarangsuran(){
		$total=$this->input->post("jumlah");
		$bungaprs=(($this->input->post("bagi_hasil"))/100);
		$tb = $total*$bungaprs;
		$bungany=$tb;
		// Start date
		$date = $this->input->post("tglakhir");
		// End date
		$end_date = date ("Y-m-d", strtotime("+".$this->input->post("tenor")." month", strtotime($date)));
		$i=0;
		$pokok=$total/$this->input->post("tenor");
		$tp=0;
		$tb=0;
		$ta=0;
		$sisa = $total;
		while (strtotime($date) < strtotime($end_date)) {
			$i++;
			$bunga = $sisa* $bungaprs;
			$ms = date ("m", strtotime("+1 month", strtotime($date)));
			$date = date ("Y-m-d", strtotime("+1 month", strtotime($date)));
			$jum=$pokok+$bunga;
			$ta=$ta+$jum;
			$sisa=$total-($pokok*$i);
		}
		echo number_format($ta,0,".",".");
	}

	public function jadiInvestor(){
		if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
			if($this->checkRole()=="borrower"){
				redirect("invest/register");
			} else {
				redirect("invest/login");
			}
	    }
	}
	public function buatPinjaman($id=""){
		if($this->checkRole()=="borrower"){
	        $data=array();
			$data['id']=$id;
			$wh=array("siteurl"=>$id);
    	    $data['data_produk']=$this->m_invest->dataProduk($wh);
    	    $data['content']=$this->load->view("buat-pinjaman", $data, TRUE);
    		$this->load->view('index',$data);
	    } else {
			redirect("Invest");
	    }
	}
	public function prosesBuatPinjaman(){
		if($this->checkRole()=="borrower"){
			//print_r($this->input->post());
			$data=$this->input->post();
			$data['id_pengguna']=$this->session->userdata("invest_pengguna");
			$data['createddate']=date("Y-m-d H:i:s");

			if ( $_FILES['foto']['name'] != '') {
				$filename = str_replace(' ', '_', $_FILES['foto']['name']);
				$filename = str_replace('(', '', $filename);
				$filename = str_replace(')', '', $filename);
				$data['foto'] = $filename;
				//$result = $this->M_produk->insert($dataProduk);

				$config['upload_path']          = 'assets/img/produk/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $filename;
				// $config['max_size']             = 100;
				// $config['max_width']            = 1024;
				// $config['max_height']           = 768;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('foto')) {
					$out['status'] = '';
					$out['msg'] = '<p class="box-msg">
						  <div class="info-box alert-success">
							  <div class="info-box-icon">
								<i class="fa fa-check-circle"></i>
							  </div>
							  <div class="info-box-content" style="font-size:20px">
								Data Produk Berhasil Ditambahkan</div>
						  </div>
						</p>';
				} else{
					$out['status'] = '';
					$out['msg'] = '<p class="box-msg">
					  <div class="info-box alert-error">
						  <div class="info-box-icon">
							<i class="fa fa-warning"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">
							Data Produk Gagal Upload</div>
					  </div>
					</p>';
				}
			}
			if($this->input->post("act")=="add"){
				unset($data['act']);
				$data['status_approve']="pending";
				$this->m_invest->insertdata("trx_produk",$data);
				$out['msg'] = '<p class="box-msg">
						  <div class="info-box alert-success">
							  <div class="info-box-icon">
								<i class="fa fa-check-circle"></i>
							  </div>
							  <div class="info-box-content" style="font-size:20px">
								Data Produk Berhasil Ditambahkan</div>
						  </div>
						</p>';
			} else if($this->input->post("act")=="edit"){
				unset($data['act']);
				unset($data['id']);
				$wh=array("id_produk"=>$this->input->post("id"));
				$this->m_invest->updatedata("trx_produk",$data,$wh);
				$out['msg'] = '<p class="box-msg">
						  <div class="info-box alert-success">
							  <div class="info-box-icon">
								<i class="fa fa-check-circle"></i>
							  </div>
							  <div class="info-box-content" style="font-size:20px">
								Data Produk Berhasil Dirubah</div>
						  </div>
						</p>';
			}
			$this->session->set_flashdata('msg', $out['msg']);

			redirect("invest/ajukan_pinjaman");
	    } else {
			redirect("Invest");
	    }
	}
	public function home(){
	    if($this->checkRole()=="investor"){
	        redirect("investor");
	    } else {
    	    $data=array();
			$wh=array("p.status_approve"=>"approve");
    	    $data['data_produk']=$this->m_invest->dataProduk($wh);
    	    $data['content']=$this->load->view("home", $data, TRUE);
    		$this->load->view('index',$data);
	    }
	}

	public function doJual($id){
		$param = $this->input->post();

		if($this->session->userdata("invest_status") == "aktif") {
			$whi = ["p.id_produk" => $id];
			$produk = $this->m_invest->dataProduk("", "", "", $whi)->row();
			// $whi = ["id_pengguna" => $this->session->userdata("invest_pengguna")];
			// $saldo = $this->m_invest->dataDana($whi)->row();

			if($param['quant'][2]!=""){
				// Jika saham dijual ke pasar sekunder,
				if ($this->input->get('type') == 'sekunder') {
					// kurangi dulu total jual dengan biaya admin.
					$totalJual = $param['harga_perlembar'] * $param['quant'][2];
// var_dump($param);die();
					if ($param['jenis_biaya_admin'] == 'nominal') {
						$adminFee = $param['nilai_biaya_admin'];
					} elseif ($param['jenis_biaya_admin'] == 'persen') {
						$adminFee = $totalJual * ($param['nilai_biaya_admin'] / 100);
					}

					if ($param['jenis_biaya_kustodian'] == 'nominal') {
						$custodianFee = $param['nilai_biaya_kustodian'];
					} elseif ($param['jenis_biaya_kustodian'] == 'persen') {
						$custodianFee = $totalJual * ($param['nilai_biaya_kustodian'] / 100);
					}

					$totalJual -= $adminFee;
					$totalJual -= $custodianFee;
				} else {
					$totalJual = $param['total'];
				}

				$idx = date('YmdHis');
				$data = [
					"id_pengguna" => $this->session->userdata("invest_pengguna"),
					"id_produk" => $id,
					"lembar_saham" => $param['quant'][2]
				];

				if ($this->input->get('type') == 'sekunder') {
					$dataSekunder["id_pengguna"] = $data['id_pengguna'];
					$dataSekunder["id_produk"] = $data['id_produk'];
					$dataSekunder["lembar_saham"] = $data['lembar_saham'];

					$dataSekunder['id_dana'] = $idx;
					$dataSekunder['harga_per_lembar'] = $param['harga_perlembar'];
					$dataSekunder['admin_fee'] = $adminFee;
					$dataSekunder['custodian_fee'] = $custodianFee;
					$dataSekunder['total'] = $totalJual;
					$dataSekunder['jenis_transaksi'] = 'jual';
					$dataSekunder['created_at'] = date('Y-m-d H:i:s');
					$dataSekunder['status'] = 'pending';
// var_dump($dataSekunder);die();
					$queueFilter = [
						'ps.lembar_saham' => $dataSekunder['lembar_saham'],
						'ps.harga_per_lembar' => $dataSekunder['harga_per_lembar'],
						'ps.jenis_transaksi' => 'beli',
						'ps.status' => 'pending',
						'ps.id_pengguna != ' . $this->session->userdata('invest_pengguna') => null
					];

					$queue = $this->m_invest->getPortfolioPasarSekunder($queueFilter);

					if ($queue->num_rows() > 0) {
						$dataBeli = $queue->result_array();

						$valueBeli = [
							'status' => 'success'
						];

						$conditionBeli = [
							'id' => $dataBeli[0]['id']
						];

						$updateBeli = $this->m_invest->setPortfolioPasarSekunder($valueBeli, $conditionBeli);

						if ($updateBeli > 0) {
							$dataSekunder['status'] = 'success';
						}
					}
					$jual = $this->m_invest->insert("trx_pasar_sekunder", $dataSekunder);

					// $data["id_pengguna"] = $this->session->userdata("invest_pengguna");
					// $data["id_produk"] = $id;
					// $data["lembar_saham"] = $param['quant'][2];

					$data["id_jual"] = $idx;
					$data["jumlah_dana"] = $totalJual;
					$data["createddate"] = date('Y-m-d H:i:s');
					$data["status_approve"] = $dataSekunder['status'];

					$jual = $this->m_invest->insert("trx_dana_invest_jual", $data);
				} else {
					$data["id_jual"] = $idx;
					$data["jumlah_dana"] = $totalJual;
					$data["createddate"] = date('Y-m-d H:i:s');
					$data["status_approve"] = "pending";

					$jual = $this->m_invest->insert("trx_dana_invest_jual", $data);
				}

				if($jual) {
					$dataDana = array(
						"id_dana" => $idx,
						"id_pengguna" => $this->session->userdata("invest_pengguna"),
						"type_dana" => "jual",
						"jumlah_dana" => $totalJual,
						"createddate" => date('Y-m-d H:i:s'),
						"status_approve" => isset($data['status']) ? (($data['status'] == 'success') ? 'approve' : 'pending') : $data['status_approve']
					);

					$gadai = $this->m_invest->insert("trx_dana",$dataDana);
					$this->session->set_flashdata('message', 'success');
				} else {
					$this->session->set_flashdata('message', 'failed');
				}
			} else {
				$this->session->set_flashdata('message', 'failed');
			}
    } else {
			redirect("Invest");
    }

    if ($this->input->get('type') == 'sekunder') {
			redirect("investor/portfolio_pasar_sekunder");
    } else {
			redirect("investor/jual/".$produk->siteurl);
    }
	}

	public function doGadai($id){
		$param=$this->input->post();
		if($this->session->userdata("invest_status")=="aktif"){
		$whi=array("p.id_produk"=>$id);
		$produk=$this->m_invest->dataProduk("","","",$whi)->row();
		//get last saham
		$whi=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
		$saldo=$this->m_invest->dataDana($whi)->row();
			if($param['quant'][2]!=""){
				$idx = date('YmdHis');
				$date = date('Y-m-d H:i:s');
				$data=array(
					"id_jual"=>$idx,
					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
					"id_produk"=>$id,
					"lembar_saham"=>$param['quant'][2],
					"jumlah_dana"=>0,
					"createddate"=>$date,
					"status_approve"=>"pending"
				);

				$gadai = $this->m_invest->insert("trx_dana_invest_gadai",$data);
				if($gadai){

					$data=array(
						"id_dana"=>$idx,
						"id_pengguna"=>$this->session->userdata("invest_pengguna"),
						"type_dana"=>"gadai",
						"jumlah_dana"=>0,
						"createddate"=>$date,
						"status_approve"=>"pending"
					);

					$gadai = $this->m_invest->insert("trx_dana",$data);

					$this->session->set_flashdata('message', 'success');
					//get data

				}else{
					$this->session->set_flashdata('message', 'failed');
				}
			}else{
				$this->session->set_flashdata('message', 'failed');
			}
	    } else {
			redirect("Invest");
	    }

		redirect("investor/gadai/".$produk->siteurl);

	}

	public function checkBankAccount()
	{
		$ch = curl_init();
		$url = $this->m_invest->refferal_setting(array('modul' => 'url_oy'))->row();

		$apikey = $this->m_invest->refferal_setting(array('modul' => 'api_key_oy'))->row();
		$api_uname = $this->m_invest->refferal_setting(array('modul' => 'api_uname'))->row();

		$headers = array(
			'X-Oy-Username:'.$api_uname->value,
			'X-Api-Key:'.$apikey->value,
			'Content-Type:application/json'
		);

		$body = array('account_number' => $this->input->post('account_number'), 'bank_code' => $this->input->post('bank_code'));

		curl_setopt($ch, CURLOPT_URL, $url->value);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		$output = curl_exec($ch);
		echo $output;
	}

	public function ceknomorktp()
	{
		$no_ktp = $this->input->post('no_ktp');
		$wh = array('no_ktp' => $no_ktp);
		$check = $this->m_invest->dataReferral($wh);

		if (isset($check->id_pengguna)) {
			echo "false";
		} else {
			echo "true";
		}
	}

	public function doGadaiTebus($id, $id_produk){

		if($this->session->userdata("invest_status")=="aktif"){

			//cek saldo
			$whi=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
			$saldo=$this->m_invest->dataDana($whi)->row()->saldo;

			//cek harga saham
			$whi=array("id_jual"=>$id);
			$harga=$this->m_invest->dataDanaShareGadai($whi)->row()->jumlah_dana;

			if($saldo >= $harga){
				//update status
				$wh=array("id_jual"=>$id);
				$data=array( "status_approve"=>"complete"  );
				$updatecomplete = $this->m_invest->updatedata("trx_dana_invest_gadai",$data,$wh);


				if($updatecomplete){

					$jum = $saldo - $harga;
					//update saldo
					$data=array(
						"saldo"=>  $jum
					);
					$wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
					 $updatesaldo = $this->m_invest->updatedata("trx_dana_saldo",$data,$wh);

					$data=array(
						"id_dana"=>$id,
						"id_pengguna"=>$this->session->userdata("invest_pengguna"),
						"type_dana"=>"tebus",
						"jumlah_dana"=>$harga,
						"createddate"=>date('Y-m-d H:i:s'),
						"status_approve"=>"approve"
					);

					$gadai = $this->m_invest->insertdata("trx_dana",$data);
					// Set flash data
					$this->session->set_flashdata('message', 'success');
				}else{
					$this->session->set_flashdata('message', 'failed');
				}
			}else{
				$this->session->set_flashdata('message', 'failed_saldo');
			}
	    } else {
			redirect("Invest");
	    }
		 redirect("investor/laporangadai/".$id_produk);
	}

	public function doBeli($id){
		$param=$this->input->post();
		if($this->session->userdata("invest_status")=="aktif"){

			$filterSaldo=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
			$saldo=$this->m_invest->dataDana($filterSaldo)->row();

			if ($this->input->get('type') == 'sekunder') {
				$totalBeli = $param['harga_perlembar'] * $param['quant'][2];

				if ($param['jenis_biaya_admin'] == 'nominal') {
					$adminFee = $param['nilai_biaya_admin'];
				} elseif ($param['jenis_biaya_admin'] == 'persen') {
					$adminFee = $totalBeli * ($param['nilai_biaya_admin'] / 100);
				}

				$totalBeli += $adminFee;
			} else {
				$totalBeli = $param['total'];
			}

			if($saldo->saldo >= $totalBeli){
				$id_trx = date('YmdHis');
				$data=array(
					"id_dana"=>$id_trx ,
					"id_pengguna"=>$this->session->userdata("invest_pengguna"),
					"id_produk"=>$id,
					"lembar_saham"=>$param['quant'][2]
				);

				if ($this->input->get('type') == 'sekunder') {
					$data['harga_per_lembar'] = $param['harga_perlembar'];
					$data['total'] = $totalBeli;
					$data['jenis_transaksi'] = 'beli';
					$data['status'] = 'pending';
					$data['created_at'] = date('Y-m-d H:i:s');

					$queueFilter = [
						'ps.lembar_saham' => $data['lembar_saham'],
						'ps.harga_per_lembar' => $data['harga_per_lembar'],
						'ps.jenis_transaksi' => 'jual',
						'ps.status' => 'pending',
						'ps.id_pengguna != ' . $this->session->userdata('invest_pengguna') => null
					];

					$queue = $this->m_invest->getPortfolioPasarSekunder($queueFilter);

					if ($queue->num_rows() > 0) {
						$dataJual = $queue->result_array();

						$valueJual = [
							'status' => 'success'
						];

						$conditionJual = [
							'id' => $dataJual[0]['id']
						];

						$updateJual = $this->m_invest->setPortfolioPasarSekunder($valueJual, $conditionJual);

						if ($updateJual > 0) {
							$data['status'] = 'success';
						}
					}

					$beli = $this->m_invest->insert("trx_pasar_sekunder", $data);
					if($beli){
						$dataDanaInvest = $data;
						unset($dataDanaInvest['harga_per_lembar']);
						unset($dataDanaInvest['total']);
						unset($dataDanaInvest['jenis_transaksi']);
						unset($dataDanaInvest['status']);
						unset($dataDanaInvest['created_at']);

						$dataDanaInvest["jumlah_dana"] = $totalBeli;
						$dataDanaInvest["createddate"] = date('Y-m-d H:i:s');
						$dataDanaInvest["status_approve"] = "pending";

						$this->m_invest->insert("trx_dana_invest", $dataDanaInvest);
					}
				} else {
					$data["jumlah_dana"] = $totalBeli;
					$data["createddate"] = date('Y-m-d H:i:s');
					$data["status_approve"] = "approve";

					$beli = $this->m_invest->insert("trx_dana_invest",$data);
				}

				if($beli){

					$datadana=array(
						"id_dana"=>$id_trx,
						"id_pengguna"=>$this->session->userdata("invest_pengguna"),
						"type_dana"=>"beli",
						"createddate"=>date('Y-m-d H:i:s'),
						"id_bank"=>"",
						"nama_akun"=>"",
						"no_rek"=>"",
						"jumlah_dana"=>$totalBeli
					);

					if ($this->input->get('type') == 'sekunder') {
						$datadana["status_approve"] = isset($data['status']) ? (($data['status'] == 'success') ? 'approve' : 'pending') : $data['status_approve'];
					} else {
						$datadana["status_approve"] = "approve";
					}
					$history = $this->m_invest->insert("trx_dana",$datadana);

					if ($this->input->get('type') == 'sekunder') {
						// kurangi saldo pembeli
						$saldoAkhirPembeli = $saldo->saldo - $datadana["jumlah_dana"];
						$dataSaldoPembeli = ["saldo" => $saldoAkhirPembeli];
						$filterSaldoPembeli = ["id_pengguna" => $this->session->userdata("invest_pengguna")];
						$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo", $dataSaldoPembeli, $filterSaldoPembeli);

						if($data['status'] == 'success') {
							$dataHistoryJual = ["status_approve" => 'approve'];
							$condHistoryJual = ["id_dana" => $dataJual[0]['id_dana']];

							$historyJual = $this->m_invest->updatedata("trx_dana", $dataHistoryJual, $condHistoryJual);	

							// tambah saldo penjual
							$filterSaldoPenjual = array("id_pengguna" => $dataJual[0]['id_pengguna']);
							$saldoPenjual = $this->m_invest->dataDana($filterSaldoPenjual)->row();
							$saldoAkhirPenjual = $saldoPenjual->saldo + $dataJual[0]["total"];
							$dataSaldoPenjual = ["saldo" => $saldoAkhirPenjual];
							$filterSaldoAkhirPenjual = ["id_pengguna" => $dataJual[0]['id_pengguna']];
							$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo", $dataSaldoPenjual, $filterSaldoAkhirPenjual);
						}
					} else {
						$jum = $saldo->saldo - $datadana["jumlah_dana"];
						$data = array(
							"saldo" => $jum
						);
						
						$wh = array("id_pengguna" => $this->session->userdata("invest_pengguna"));
						$updatesaldo = $this->m_invest->updatedata("trx_dana_saldo", $data, $wh);
					}

					if($updatesaldo){
						$this->session->set_flashdata('message', 'success');
					}else{
						$this->session->set_flashdata('message', 'failed');
					}
				}else{
					$this->session->set_flashdata('message', 'failed');
				}
			}else{
				$this->session->set_flashdata('failed_saldo', 'failed');
			}
    } else {
			redirect("Invest");
    }

		$whi=array("p.id_produk"=>$id);
		$produk=$this->m_invest->dataProduk("","","",$whi)->row();

    if ($this->input->get('type') == 'sekunder') {
			redirect("investor/portfolio_pasar_sekunder");
    } else {
			// redirect("investor/jual/".$produk->siteurl);
			redirect("invest/detail/".$produk->siteurl);
    }
	}

	public function beli($url){
	    /* if($this->checkRole()=="investor" ){
	        redirect("investor/detail/".$url);
	    } else { */
    	    $data=array();
    	    $wh=array("siteurl"=>$url);
			//$wh['p.status_approve']="approve";
			//$wh=array("status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running"),
						"p.siteurl"=>$url
						);
    	    $produk=$this->m_invest->dataProduk("","","",$whi);
    	    if($produk->num_rows()>0){
				$wh['p.status_approve']="approve";
				$idp="";
				if($this->session->userdata("invest_pengguna")!=""){
					$idp=$this->session->userdata("invest_pengguna");
				}
				if(isset($_GET['type'])){
    	    	    $data['data_produk']=$this->m_invest->dataProdukSekunder("","",$idp,$whi);
	        	} else {
    	    	    $data['data_produk']=$this->m_invest->dataProduk("","",$idp,$whi);
	        	}
				$wh2['status_approve']="approve";
				$wh2['id_produk']=$data['data_produk']->row()->id_produk;
				$data['total_invest']=$this->m_invest->dataTotalinvest($wh2)->row();
				$data['total_investor']=$this->m_invest->dataTotalinvestor($wh2)->num_rows();
				$whi=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
				$data['saldo']= $this->m_invest->dataDana($whi)->row();

				$data['url']=$url;
				$data['msg']="";
        	    // $data['content']=$this->load->view("beli", $data, TRUE);
        	    if(isset($_GET['type'])){
					$data['content']=$this->load->view("beli_sekunder", $data, TRUE);
				}else{
					$data['content']=$this->load->view("beli", $data, TRUE);
				}
        		$this->load->view('index',$data);
    	    } else {
				if($this->session->userdata("invest_status")=="tidak aktif"){
					$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
					$this->session->set_flashdata($result);
					redirect("invest/result");
				} else {
					redirect("invest");
				}
    	    }
	    //}
	}

	public function detail_gagal($url){
	    /* if($this->checkRole()=="investor" ){
	        redirect("investor/detail/".$url);
	    } else { */
    	    $data=array();
    	    $wh=array("siteurl"=>$url);
			//$wh['p.status_approve']="approve";
			//$wh=array("status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running"),
						"p.siteurl"=>$url
						);
    	    $produk=$this->m_invest->dataProduk("","","",$whi);
    	    if($produk->num_rows()>0){
				$wh['p.status_approve']="approve";
				$idp="";
				if($this->session->userdata("invest_pengguna")!=""){
					$idp=$this->session->userdata("invest_pengguna");
				}
        	    $data['data_produk']=$this->m_invest->dataProduk("","",$idp,$whi);
				$wh2['status_approve']="approve";
				$wh2['id_produk']=$data['data_produk']->row()->id_produk;
				$data['total_invest']=$this->m_invest->dataTotalinvest($wh2)->row();
				$data['total_investor']=$this->m_invest->dataTotalinvestor($wh2)->num_rows();
				$data['url']=$url;
				$data['msg']="failed";
        	    $data['content']=$this->load->view("detail", $data, TRUE);
        		$this->load->view('index',$data);
    	    } else {
				if($this->session->userdata("invest_status")=="tidak aktif"){
					$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
					$this->session->set_flashdata($result);
					redirect("invest/result");
				} else {
					redirect("invest");
				}
    	    }
	    //}
	}

	public function detail_sukses($url){
	    /* if($this->checkRole()=="investor" ){
	        redirect("investor/detail/".$url);
	    } else { */
    	    $data=array();
    	    $wh=array("siteurl"=>$url);
			//$wh['p.status_approve']="approve";
			//$wh=array("status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running"),
						"p.siteurl"=>$url
						);
    	    $produk=$this->m_invest->dataProduk("","","",$whi);
    	    if($produk->num_rows()>0){
				$wh['p.status_approve']="approve";
				$idp="";
				if($this->session->userdata("invest_pengguna")!=""){
					$idp=$this->session->userdata("invest_pengguna");
				}
        	    $data['data_produk']=$this->m_invest->dataProduk("","",$idp,$whi);
				$wh2['status_approve']="approve";
				$wh2['id_produk']=$data['data_produk']->row()->id_produk;
				$data['total_invest']=$this->m_invest->dataTotalinvest($wh2)->row();
				$data['total_investor']=$this->m_invest->dataTotalinvestor($wh2)->num_rows();
				$data['url']=$url;
				$data['msg']="success";
        	    $data['content']=$this->load->view("detail", $data, TRUE);
        		$this->load->view('index',$data);
    	    } else {
				if($this->session->userdata("invest_status")=="tidak aktif"){
					$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
					$this->session->set_flashdata($result);
					redirect("invest/result");
				} else {
					redirect("invest");
				}
    	    }
	    //}
	}

	public function detail($url){
	    /* if($this->checkRole()=="investor" ){
	        redirect("investor/detail/".$url);
	    } else { */
    	    $data=array();
    	    $wh=array("siteurl"=>$url);
			//$wh['p.status_approve']="approve";
			//$wh=array("status_approve"=>"approve");
			$whi=array("p.status_approve"=>array("approve","complete","invest","running"),
						"p.siteurl"=>$url
						);
    	    $produk=$this->m_invest->dataProduk("","","",$whi);


    	    if($produk->num_rows()>0){
				$wh['p.status_approve']="approve";
				$idp="";
				if($this->session->userdata("invest_pengguna")!=""){
					$idp=$this->session->userdata("invest_pengguna");
				}
        	    $data['data_produk']=$this->m_invest->dataProduk("","",$idp,$whi);
				$wh2['status_approve']="approve";
				$wh2['id_produk']=$data['data_produk']->row()->id_produk;
				$data['total_invest']=$this->m_invest->dataTotalinvest($wh2)->row();
				$data['total_investor']=$this->m_invest->dataTotalinvestor($wh2)->num_rows();
				$data['url']=$url;
				$data['msg']="";
				$data['verif'] = $this->m_invest->checkUser('b.id_pengguna='.$this->session->userdata("invest_pengguna"))->row()->verif;

				if($this->input->get('type') == 'sekunder') {
					$filterKinerjaBisnis = [
						"share.id_pengguna" => $this->session->userdata("invest_pengguna"),
						"share.id_produk" => $data['data_produk']->row()->id_produk
					];
					$data['kinerjaBisnis'] = $this->m_invest->dataDanaShare($filterKinerjaBisnis);

					$filterERUPS = [
						"trx_dana_invest.id_pengguna" => $this->session->userdata("invest_pengguna"),
						"trx_produk.id_produk" => $data['data_produk']->row()->id_produk
					];
					$data['ERUPS'] = $this->m_invest->dataerups($filterERUPS);

					$filterEvote = [
						"trx_dana_invest.id_pengguna" => $this->session->userdata("invest_pengguna"),
						"trx_produk.id_produk" => $data['data_produk']->row()->id_produk
					];
					$data['EVote'] = $this->m_invest->dataevote($filterEvote);

					$filter = [
						'ps.id_produk' => $data['data_produk']->row()->id_produk,
						'ps.status' => 'pending'
					];
					$data['pendingOrder'] = $this->m_invest->getPortfolioPasarSekunder($filter);

					$data['content']=$this->load->view("detailsekunder", $data, TRUE);
				} else {
					$data['content']=$this->load->view("detail", $data, TRUE);
				}
        		$this->load->view('index',$data);
    	    } else {
				if($this->session->userdata("invest_status")=="tidak aktif"){
					$result=array("result"=>"fail","msg"=>"Akun tidak aktif");
					$this->session->set_flashdata($result);
					redirect("invest/result");
				} else {
					redirect("invest");
				}
    	    }
	    //}
	}

	public function forget(){
	    if($this->checkRole()=="investor" || $this->checkRole()=="borrower"){
	        redirect("investor");
	    } else {
    	    $data=array();
    	    $data['content']=$this->load->view("forget", null, TRUE);
    		$this->load->view('index',$data);
	    }
	}

	public function kirimEmailnyaDaftar($id, $email){
		$result=array();
		$format="";

        $mailTo=$email;
		$mailformat = $this->MailFormatViewDaftar($format,$mailTo,$id);
        $msg="";
		$wh=array(
			//"a.email"=>$mailTo,
			"a.id_admin"=>$id,
			"a.status"=>"Tidak Aktif"
		);

		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()>0){

			//$mailTo = $this->m_invest->checkPengguna($wh)->row()->mailto;
			$mail= $this->m_invest->kirimEmailnya($mailTo,$mailformat);

			if($mail=="success"){
				 echo "berhasil kirim email";
			} else {
				echo "gagal kirim email";
			}

		} else{
			echo "not found";
		}

		//redirect('');

    }

	public function aktivasi($id){
		$dt=array(
			"status"=>"aktif"
		);
		$wh=array(
			"id_admin"=>base64_decode($id),
			"status"=>"tidak aktif"
		);
		$this->m_invest->updatedata("tbl_admin",$dt,$wh);

		$data=array();
		$data['content']=$this->load->view("result-aktif", null, TRUE);
		$this->load->view('index',$data);
	}

	public function kirimEmailnya(){
		$result=array();
		$format="";
		$nik="";
		$resetkey = $this->generate_string(25);
        $mailTo=$_POST['email'];
		$mailformat = $this->MailFormatView($format,$mailTo,$resetkey);
        $msg="";
		$wh=array(
			"a.email"=>$mailTo,
			"a.status"=>"aktif"
		);
		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()>0){
			$now = date("Y-m-d H:i:s");
			$dt = $var->row();
			//$exp = $dt->RESET_TOKEN!=""?$dt->RESET_EXP:date("Y-m-d H:i:s");
			// Declare and define two dates
			//$date1 = strtotime($now);
			//$date2 = strtotime($exp);
			//$days=$this->dayCount($now,$exp);

			//if($days>=1 || $dt->RESET_TOKEN==""){
				$tomorrow = date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s") . "+1 days"));
				$dt=array(
					"reset_token"=>$resetkey,
					"reset_exp"=>$tomorrow
				);
				$wh=array(
					"email"=>$mailTo,
					"status"=>"aktif"
				);
				$this->m_invest->updatedata("tbl_admin",$dt,$wh);
				$mail= $this->m_invest->kirimEmailnya($mailTo,$mailformat);

				if($mail=="success"){
					$alert = '<div class="alert alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Email terkirim</div>
							  </div>';
				} else {
					$alert = '<div class="alert alert-danger">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Email gagal terkirim</div>
							  </div>';
				}
			/* } else {
				$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Anda sudah melakukan reset password, check email, max melakukan reset 1 kali per 24 jam');
			} */
		} else {
			$alert = '<div class="alert alert-danger">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">
							Email Belum Terdaftar</div>
					  </div>';
		}
		$this->session->set_flashdata(array('notif' => $alert));
		// $this->session->set_flashdata($result);
        //echo $mail;
		//echo $mailformat;
        redirect("invest/forget");
    }

	function generate_string($strength = 16) {
		$input = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string;
	}

	public function MailFormatViewDaftar($format="",$email="",$resetkey=""){
        //if($this->session->userdata('user_type')==3 && $this->session->userdata('username')!='' &&$this->session->userdata('status')=='login'){
			//$data['menuId']=array(52,62);
            $wh=array("mail_company"=>"PT Pendana Usaha");
            $data['mailserver'] = $this->m_invest->mailserver($wh)->row();
            $title="Aktivasi Akun";
            //$whnik=array("c.nik"=>$nik);
            //$data['datakar'] = $this->My_model->getUserKaryawan($whnik)->row();
            //$data['datajadwal'] = $this->My_model->dataJadwalLokerPelamar($data['datakar']->idlokerdl);
            $data['mailtitle'] = $title;
			$data['email'] = $email;
            $data['resetkey'] = $resetkey;
            $data['mailformat'] = "";
			return $this->load->view('template/v-mail-format-aktif',$data,TRUE);
		/* }else{
			redirect("home/login");
		} */
    }

	public function MailFormatView($format="",$nik="",$resetkey=""){
        //if($this->session->userdata('user_type')==3 && $this->session->userdata('username')!='' &&$this->session->userdata('status')=='login'){
			//$data['menuId']=array(52,62);
            $wh=array("mail_company"=>"PT Pendana Usaha");
            $data['mailserver'] = $this->m_invest->mailserver($wh)->row();
            $title="Reset Password";
            //$whnik=array("c.nik"=>$nik);
            //$data['datakar'] = $this->My_model->getUserKaryawan($whnik)->row();
            //$data['datajadwal'] = $this->My_model->dataJadwalLokerPelamar($data['datakar']->idlokerdl);
            $data['mailtitle'] = $title;
			$data['email'] = $nik;
            $data['resetkey'] = $resetkey;
            $data['mailformat'] = $this->input->post("format");
			return $this->load->view('template/v-mail-format',$data,TRUE);
		/* }else{
			redirect("home/login");
		} */
    }
	public function resetpass($key=""){
		$wh=array(
			"a.reset_token"=>$key,
			"a.status"=>"aktif"
		);
		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()){
			$now = date("Y-m-d H:i:s");
			$dt = $var->row();
			$exp = $dt->reset_token!=""?$dt->reset_exp:date("Y-m-d H:i:s");
			// Declare and define two dates
			$date1 = strtotime($now);
			$date2 = strtotime($exp);
			$days = $this->dayCount($now,$exp);

			if($days>=1 ){
				$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Token Expire');
				$result['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Token Expire</div>
							  </div>
							</p>';
				$this->session->set_flashdata($result);
				redirect("invest/login");
			} else {
				$data['key']=$key;
				$data['datatoken']=$dt;
				//$data['dataPerguruanRow'] = $this->M_mhs->dataPerguruanTinggi()->row();
				$data['content']=$this->load->view("reset-pass", $data, TRUE);
				$this->load->view('index',$data);
			}
		} else {
			$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data not Found');
			$this->session->set_flashdata($result);
			redirect("invest/login");
		}
	}
	public function dayCount($now,$exp){
		// Declare and define two dates
		$date1 = strtotime($now);
		$date2 = strtotime($exp);
		// Formulate the Difference between two dates
		$diff = abs($date2 - $date1);
		// To get the year divide the resultant date into total seconds in a year (365*60*60*24)
		$years = floor($diff / (365*60*60*24));
		// To get the month, subtract it with years and divide the resultant date into total seconds in a month (30*60*60*24)
		$months = floor(($diff - $years * 365*60*60*24)  / (30*60*60*24));
		// To get the day, subtract it with years and months and divide the resultant date into total seconds in a days (60*60*24)
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
		// To get the hour, subtract it with years, months & seconds and divide the resultant date into total seconds in a hours (60*60)
		$hours = floor(($diff - $years * 365*60*60*24  - $months*30*60*60*24 - $days*60*60*24) / (60*60));
		// To get the minutes, subtract it with years, months, seconds and hours and divide the resultant date into total seconds i.e. 60
		$minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
		// To get the minutes, subtract it with years, months, seconds, hours and minutes
		$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
		// Print the result
		//echo $now." - ".$exp."</br>";
		//printf("%d years, %d months, %d days, %d hours, ". "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds);
		return $days;
	}
	public function prosesResetPass(){
		$key = $this->input->post("key");
		$wh=array(
			"a.reset_token"=>$key,
			"a.status"=>"aktif"
		);
		$var = $this->m_invest->checkPengguna($wh);
		if($var->num_rows()){
			$now = date("Y-m-d H:i:s");
			$dt = $var->row();
			$exp = $dt->reset_token!=""?$dt->reset_exp:date("Y-m-d H:i:s");
			// Declare and define two dates
			$date1 = strtotime($now);
			$date2 = strtotime($exp);
			$days = $this->dayCount($now,$exp);
			if($days>=1 ){
				$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Token Expire');
				$result['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Token Expire</div>
							  </div>
							</p>';
				$this->session->set_flashdata($result);
				redirect("invest/login");
			} else {
				$dt = $var->row();
				$wh=array("email"=>$dt->mailto);
				$npass=$this->input->post("npass");
				$cpass=$this->input->post("cpass");
				if($npass==$cpass){
					$badpass = $npass;
					$goodpass = md5($badpass);//password_hash($badpass, PASSWORD_BCRYPT);
					$dt=array(
						"reset_token"=>"",
						"reset_exp"=>$now,
						"password"=>$goodpass
					);
					//$upd = $this->M_user->updateAkun($dt, $wh);
					$this->m_invest->updatedata("tbl_admin",$dt,$wh);
					//if($upd>0){
						// $result=array("alert"=>"success",'title'=>"Berhasil",'hasil'=>'Berhasil');
						$result['notif'] = '<div class="alert alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Berhasil Reset</div>
							  </div>';
					/* } else {
						$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data Invalid');
					} */
					$this->session->set_flashdata($result);
					redirect("invest/login");
				} else {
					$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data Pass & Konf harus Sama');
					$this->session->set_flashdata($result);
					redirect("invest/resetpass/".$key);
				}
			}
		} else {
			// $result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data not Found');
			$result['notif'] = '<div class="alert alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Data Not Found</div>
							  </div>';
			$this->session->set_flashdata($result);
			redirect("invest/login");
		}
	}
	public function login(){
	    if($this->checkRole()=="investor"){
	        redirect("investor");
	    } else {
    	    $data=array();
    	    $data['content']=$this->load->view("login", null, TRUE);
    		$this->load->view('index',$data);
	    }
	}
	public function logout(){
	    $array_items = array('invest_username', 'invest_email','invest_tipe','invest_pengguna','access_token');
	    $this->session->unset_userdata($array_items);
        redirect("invest");
	}
	public function tarikDana(){
		$pass=$this->input->post("pass");
		$jumlah_tarik=$this->input->post("jumlah_tarik");

		$wh=array(
	        "a.email"=>$this->session->userdata("invest_email")
	        //"a.password"=>md5($pass)
	    );
		$login= $this->session->userdata("invest_login");
		$arr=array("fb","google");
		if(!in_array($login,$arr)){
			$wh['a.password']=md5($pass);
		}
        $data=$this->m_invest->checkUser($wh);
		$date=date("Y-m-d H:i:s");
        if($data->num_rows()>0){
			$data=array(
				"id_dana"=>date('YmdHis'),
				"id_pengguna"=>$this->session->userdata("invest_pengguna"),
				"id_bank"=>$this->session->userdata("invest_bank"),
				"jumlah_dana"=>$jumlah_tarik,
				"type_dana"=>"tarik",
				"status_approve"=>"pending",
				"createddate"=>$date
			);
			$this->m_invest->insertdata("trx_dana",$data);
			$dana = $this->session->userdata("invest_dana")-$jumlah_tarik;
			$this->session->set_userdata("invest_dana",$dana);
			//$res=array("hasil"=>"Sukses","act"=>"Tarik Dana");
			$msg='Penarikan Dana Berhasil, sebesar Rp. '.number_format($jumlah_tarik,0,".",".").' pada tanggal '.$date;
			$res['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									'.$msg.'</div>
							  </div>
							</p>';
			$this->session->set_flashdata($res);
			$dtp=array(
				"id_pengguna"=>$this->session->userdata("invest_pengguna"),
				"pesan"=>$msg,
				"createddate"=>$date
			);
			$this->m_invest->insertdata("tbl_pesan",$dtp);
			echo json_encode(array("result"=>true));
		} else {
			echo json_encode(array("result"=>false));
		}
	}

	public function login_proses(){
	    $wh=array(
	        "a.email"=>$this->input->post("email"),
	        "a.password"=>md5($this->input->post("password")),
			"login_from"=>"web",
			"status"=>"aktif"
	        );
        $data=$this->m_invest->checkUser($wh);
        if($data->num_rows()>0){
            $dt=$data->row();
            if($dt->id_pengguna>0){
                $whd=array("id_pengguna"=>$dt->id_pengguna);
                $dana=$this->m_invest->dataDana($whd);
                $jum_dana=$dana->num_rows()>0?$dana->row()->jumlahdana:0;

                $no_hp = $dt->no_hp;

                if (substr($no_hp, 0, 2) == "08") {
                	$no_hp = substr($no_hp, 2);
                }

                $session=array(
                    "invest_pengguna"=>$dt->id_pengguna,
                    "invest_username"=>$dt->username,
					"invest_realname"=>$dt->nama_pengguna,
                    "invest_email"=>$dt->email,
                    "invest_tipe"=>$dt->tipe,
                    "invest_hp"=>"",
                    "invest_bank"=>$dt->bank,
                    "invest_dana"=>$jum_dana,
					"invest_status"=>$dt->status,
					"invest_login"=>"web"
                    );
                $this->session->set_userdata($session);
                redirect("invest");
            } else {
                redirect("invest/login");
            }
        } else {
            redirect("invest/login");
        }

	}

	public function oauthfbcallback(){
		$user_profile = $this->facebook->request('get', '/me?fields=id,first_name,email');
		if(!isset($_POST["user_reg"])){
			$data=array(
				'password'=>$user_profile['id'],
				'email'=>isset($user_profile['email'])?$user_profile['email']:$user_profile['id']."@facebook.com",
				'username'=>$user_profile['first_name'],
				'login_from'=>'fb',
				"status"=>"aktif",
				//"tipe"=>'investor'
				//'dari'=>'facebook'
			);
			$this->session->set_userdata("profile",json_encode($data));
			$data['user_reg']=$this->session->userdata("email");
        	$data['pass_reg']=$this->session->userdata("password");
			$data['login_from']='fb';
			$data['content']=$this->load->view("role_choice_sosmed", $data, TRUE);
			$this->load->view('index',$data);
		} else if(isset($_POST["user_reg"])){
			$user_profile=json_decode($this->session->userdata("profile"));
			$session_data=array(
						'password'=>$user_profile->password,
						'email'=>$user_profile->email,
						'username'=>$user_profile->username,
						'login_from'=>'fb',
						"status"=>"aktif",
						"tipe"=>$this->input->post('role_reg'),
						"tipeuser"=>"perorangan"
						);

			// print_r($user_profile) ;
			$session_where=array(
						'email'=>$user_profile->email,
						'login_from'=>'fb',
						"tipe"=>$this->input->post('role_reg')
						);

			$a=$this->m_invest->checkUser($session_where);
			$dt=$a->row();
			$data_session=array();
			if($a->num_rows()==0){

				$id_admin = $this->m_invest->insertdata("tbl_admin",$session_data);
				$reff=$this->generateReferral($id_admin);
				$dataPenguna = array("kode_referral"=>$reff,
										"createddate"=>date("Y-m-d H:i:s"),
										"id_admin"=>$id_admin);
				$id_pengguna = $this->m_invest->insertdata("tbl_pengguna",$dataPenguna);
				$dataBank = array("id_pengguna"=>$id_pengguna,
										"createddate"=>date("Y-m-d H:i:s"));
				$this->m_invest->insertdata("tbl_bank_pengguna",$dataBank);
			}
			$a=$this->m_invest->checkUser($session_where);
			$dt=$a->row();

			$whd=array("a.id_pengguna"=>$dt->id_pengguna);
            $dana=$this->m_invest->dataDana($whd);
            $jum_dana=$dana->num_rows()>0?$dana->row()->jumlahdana:0;

			$data_session=array(
                    "invest_pengguna"=>$dt->id_pengguna,
                    "invest_username"=>$user_profile->username,
					"invest_realname"=>$user_profile->username,
                    "invest_email"=>$user_profile->email,
                    "invest_tipe"=>$this->input->post('role_reg'),
                    "invest_dana"=>$jum_dana,
					"invest_status"=>$dt->status,
					"invest_login"=>"fb"
                    );
			$this->session->set_userdata($data_session);

			// $sts=$this->session->userdata('sts');
			// if($sts=='login'){
			// 	$this->session->set_flashdata('success', "Login Berhasil");
			// }else{
			// 	$this->session->set_flashdata('success', "<h4>Berhasil Masuk</p>");
			// }

			$this->session->set_flashdata('success', "Login Berhasil");
			$res['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Login Berhasil</div>
							  </div>
							</p>';
			$this->session->set_flashdata($res);
			redirect("invest");
		} else {
			redirect("invest/login");
		}
	}

	public function oauth2callback(){
		$google_data=$this->google->validate();
		if(!isset($_POST["user_reg"])){
			$data=array(
				'password'=>$this->input->post('id'),
				'email'=>$this->input->post('email'),
				'username'=>$this->input->post('nama'),
				'login_from'=>'google',
				"status"=>"aktif",
				//"tipe"=>'investor'
				//'dari'=>'facebook'
			);
			$this->session->set_userdata("profile",json_encode($data));
			$data['user_reg']=$this->session->userdata("email");
        	$data['pass_reg']=$this->session->userdata("password");
			$data['login_from']='google';
			$data['content']=$this->load->view("role_choice_sosmed", $data, TRUE);
			$this->load->view('index',$data);
		} else if(isset($_POST["user_reg"])){
			$user_profile=json_decode($this->session->userdata("profile"));
	// 		$session_data=array(
	// 				'password'=>$google_data['name'],
	// 				'name' =>$google_data['name'],
	// 				'email'=>$google_data['email']
	// //				'dari'=>'google'
	// 				);
			$password = $user_profile->password;
			$nama = $user_profile->username;
			$email = $user_profile->email;
			$session_data=array(
						'password'=>$password,
						'email'=>$email,
						'username'=>$nama,
						'login_from'=>'google',
						"status"=>"aktif",
						"tipe"=>$this->input->post('role_reg'),
						"tipeuser"=>"perorangan"
						);

			$session_where=array(
					'email'=>$email,
					'login_from'=>'google',
					"tipe"=>$this->input->post('role_reg')
	//				'dari'=>'google'
					);


			$a=$this->m_invest->checkUser($session_where);
			$dt=$a->row();
			$data_session=array();
			if($a->num_rows()==0){

				$id_admin = $this->m_invest->insertdata("tbl_admin",$session_data);
				$reff=$this->generateReferral($id_admin);
				$dataPenguna = array("kode_referral"=>$reff,
										"createddate"=>date("Y-m-d H:i:s"),
										"id_admin"=>$id_admin);
				$id_pengguna = $this->m_invest->insertdata("tbl_pengguna",$dataPenguna);
			}
			$a=$this->m_invest->checkUser($session_where);
			$dt=$a->row();

			$whd=array("a.id_pengguna"=>$dt->id_pengguna);
			$dana=$this->m_invest->dataDana($whd);
			$jum_dana=$dana->num_rows()>0?$dana->row()->jumlahdana:0;

			$data_session=array(
					"invest_pengguna"=>$dt->id_pengguna,
					"invest_username"=>$nama,
					"invest_realname"=>$nama,
					"invest_email"=>$email,
					"invest_tipe"=>$this->input->post('role_reg'),
					"invest_dana"=>$jum_dana,
					"invest_status"=>$dt->status,
					"invest_login"=>"google"
					);
			$this->session->set_userdata($data_session);

			// $this->session->set_flashdata('success', "<h4>Verifikasi Berhasil !</h4><p>Proses verifikasi akun sosial berhasil.</p>");

			$this->session->set_flashdata('success', "Login Berhasil");
			$res['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Login Berhasil</div>
							  </div>
							</p>';
			$this->session->set_flashdata($res);
			redirect("invest");
		} else {
			redirect("invest/login");
		}
	}

	public function portofolio(){
	    if($this->checkRole()=="borrower"){
	        //var_dump($this->session->userdata("invest_pengguna"));
	        $data=array();

    	    //berlangsung
    	    $wh=array(
				"b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
				"a.status_approve"=> "approve"
			);

    	     $data['data_berlangsung']=$this->m_invest->dataProdukBorrower($wh);
    	   // var_dump($data['data_berlangsung']);
    	    //telat
    	    $wh=array(
    	                "b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "approve",
    	                "b.tglakhir < "=>date('Y-m-d')
    	               );
    	    $data['data_telat']=$this->m_invest->dataProdukInvestUser($wh);

    	    //lunas
    	    $wh=array(
    	                "b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "complete"
    	               );
    	    $data['data_lunas']=$this->m_invest->dataProdukInvestUser($wh);

    	    //dana invest total
    	    $wh=array("b.id_pengguna"=>$this->session->userdata("invest_pengguna"));
    	    $data['totalInvest']=$this->m_invest->danaInvestasiBrorrower($wh);

    	    //dana invest berlangsung
    	    $wh=array(
    	                "b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "approve"
    	               );
    	    $data['totalInvestBerlangsung']=$this->m_invest->danaInvestasiBrorrower($wh);

    	    //dana pokok kembali
    	    $wh=array(
    	                "b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "complete"
    	               );
    	    $data['totalInvestPokok']=$this->m_invest->danaInvestasiBrorrower($wh);

    	    //dana bunga kembali
    	    $wh=array(
    	                "b.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "complete"
    	               );
    	    $temp = $this->m_invest->danaInvestasiBunga($wh);
    	    $totalBunga =0;
    	    foreach($temp->result() as $par){
    	        $totalBunga = $totalBunga + ($par->bagi_hasil * $par->jumlah_dana)/100;
    	    }
    	    $data['totalInvestbunga']=$totalBunga;

    	    $data['tipe_user']=$this->checkRole();
    	    $data['content']=$this->load->view("portofolio", $data, TRUE);
        	$this->load->view('index',$data);
	    }

	    if($this->checkRole()=="investor" ){
    	    $data=array();

    	    //berlangsung
    	    $wh=array(
				"a.id_pengguna"=>$this->session->userdata("invest_pengguna")
    	    );
			$whi=array(
				"a.status_approve"=>array("approve","pending")
			);
    	    $data['data_berlangsung']=$this->m_invest->dataProdukInvestUser($wh,$whi);

    	    //telat
    	    $wh=array(
    	                "a.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "approve",
    	                "b.tglakhir < "=>date('Y-m-d')
    	               );
    	    $data['data_telat']=$this->m_invest->dataProdukInvestUser($wh);

    	    //lunas
    	    $wh=array(
    	                "a.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "complete"
    	               );
    	    $data['data_lunas']=$this->m_invest->dataProdukInvestUser($wh);

    	    //dana invest total
    	    $wh=array("id_pengguna"=>$this->session->userdata("invest_pengguna"));
    	    $data['totalInvest']=$this->m_invest->danaInvestasi($wh);

    	    //dana invest berlangsung
    	    $wh=array(
    	                "id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "status_approve"=> "approve"
    	               );
    	    $data['totalInvestBerlangsung']=$this->m_invest->danaInvestasi($wh);

    	    //dana pokok kembali
    	    $wh=array(
    	                "id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "status_approve"=> "complete"
    	               );
    	    $data['totalInvestPokok']=$this->m_invest->danaInvestasi($wh);

    	    //dana bunga kembali
    	    $wh=array(
    	                "a.id_pengguna"=>$this->session->userdata("invest_pengguna"),
    	                "a.status_approve"=> "complete"
    	               );
    	    $temp = $this->m_invest->danaInvestasiBunga($wh);
    	    $totalBunga =0;
    	    foreach($temp->result() as $par){
    	        $totalBunga = $totalBunga + ($par->bagi_hasil * $par->jumlah_dana)/100;
    	    }
    	    $data['totalInvestbunga']=$totalBunga;

    	    $data['tipe_user']=$this->checkRole();
    	    $data['content']=$this->load->view("portofolio", $data, TRUE);
    		$this->load->view('index',$data);
	    }


	}
	public function register(){
	    if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
    	    $data=array();
    	    $data['content']=$this->load->view("register", null, TRUE);
    		$this->load->view('index',$data);
	    }
	}
	public function register_proses(){
	    $result=array();
	    if(
	    	// (!empty($_FILES['ttd']['name']) && $_FILES['ttd']['error']==0) &&
	    	(!empty($_FILES['ktp']['name']) && $_FILES['ktp']['error']==0) &&
	    	(!empty($_FILES['npwp']['name']) && $_FILES['npwp']['error']==0) &&
	    	(!empty($_FILES['buku_tabungan']['name']) && $_FILES['buku_tabungan']['error']==0) &&
	    	(!empty($_FILES['selfie']['name']) && $_FILES['selfie']['error']==0)
	    ){



	        // $filename=$this->_uploadTtd();
	        $email = $this->input->post("user_reg");
    	    $username=explode("@",$email);
    	    $arruser=array(
    	        "username"=>$username[0],
    	        "email"=>$email,
    	        "password"=>$this->input->post("pass_reg"),
    	        "tipe"=>$this->input->post("role_reg"),
    	        "tipeuser"=>$this->input->post("choice_reg"),
    	        "login_from"=>"web",
				"status"=>"tidak aktif",
				"investstatus"=>"tidak aktif"
    	        );
    	    $id_admin=$this->m_invest->insertdata("tbl_admin",$arruser);
			$reff=$this->generateReferral($id_admin);

    	    $arrinvestor=array(
				"kode_referral"=>$reff,
    	        "nama_pengguna"=>$this->input->post("name"),
    	        "jenis_kelamin"=>$this->input->post("jk"),
    	        "tempat_lahir"=>$this->input->post("birthplace"),
    	        "tgl_lahir"=>$this->input->post("birthdate"),
    	        "sts_kawin"=>$this->input->post("marriage"),
    	        "agama"=>$this->input->post("religion"),
    	        "pendidikan_terakhir"=>$this->input->post("lastedu"),
    	        "pekerjaan"=>$this->input->post("job"),
    	        "desc_pekerjaan"=>$this->input->post("desc_pekerjaan"),
				"no_ktp"=>$this->input->post("noktp"),
    	        "alamat_ktp"=>$this->input->post("aktp"),
    	        "negara_ktp"=>$this->input->post("country"),
    	        "prov_ktp"=>$this->input->post("provinsi"),
    	        "kabkota_ktp"=>$this->input->post("kabkota"),
    	        "no_hp"=>$this->input->post("hp"),
    	        "no_alt"=>$this->input->post("noa"),
    	        "alamat_domisili"=>$this->input->post("dom"),
    	        "negara_domisili"=>$this->input->post("country2"),
    	        "prov_domisili"=>$this->input->post("provinsi2"),
    	        "kabkota_domisili"=>$this->input->post("kabkota2"),
    	        "alamat_surat"=>$this->input->post("addr"),
    	        "penghasilan"=>$this->input->post("penghasilan"),
    	        // "pekerjaan"=>$this->input->post("seledu"),
    	        // "ttd"=>$filename,
    	        "createddate"=>date("Y-m-d H:i:s"),
    	        "id_admin"=>$id_admin,
							"verif"=>1,
				//"alasan_verif"=>
    	        );
    	    $idinv=$this->m_invest->insertdata("tbl_pengguna",$arrinvestor);
    	    $arrbank=array(
    	        "id_pengguna"=>$idinv,
    	        "nama_akun"=>$this->input->post("account"),
    	        "no_rek"=>$this->input->post("norek"),
    	        "bank"=>$this->input->post("bank"),
    	        "createddate"=>date("Y-m-d H:i:s")
    	        );
    	    $this->m_invest->insertdata("tbl_bank_pengguna",$arrbank);

			//insert saldo
			$arrbank=array(
    	        "id_pengguna"=>$idinv,
    	        "saldo"=>0
    	        );
    	    $this->m_invest->insertdata("trx_dana_saldo",$arrbank);

					$this->load->library('user_agent');
					if (isset($_SERVER['HTTP_CLIENT_IP']))
			        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			    else if(isset($_SERVER['HTTP_X_FORWARDED']))
			        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			    else if(isset($_SERVER['HTTP_FORWARDED']))
			        $ipaddress = $_SERVER['HTTP_FORWARDED'];
			    else if(isset($_SERVER['REMOTE_ADDR']))
			        $ipaddress = $_SERVER['REMOTE_ADDR'];
			    else
			        $ipaddress = 'UNKNOWN';

			    $macCommandString   =   "arp " . $ipaddress . " | awk 'BEGIN{ i=1; } { i++; if(i==3) print $3 }'";

			    $mac = exec($macCommandString);

					$locByIPinfo = json_decode(file_get_contents("http://ipinfo.io/"));
					$loc = explode(',', $locByIPinfo->loc);


					// insert agreement
					$arraggreement = array(
						'id_pengguna' => $idinv,
						'is_agree' => $this->input->post('toc_agreement'),
						'device' => $this->agent->platform(),
						'ip_address' => $ipaddress,
						'agreement_time' => date('Y-m-d H:i:s'),
						'mac_address' => $mac,
						'latitude' => $loc[0],
						'longitude' => $loc[1]
					);
					$this->m_invest->insertdata('tbl_toc_agreement', $arraggreement);

					unset($arraggreement['agreement_time']);
					unset($arraggreement['is_agree']);
					$arraggreement['record_type'] = 'Agreement';
					$this->m_invest->insertdata('trx_record_log', $arraggreement);


			//foto ttd
			$data = array();
			$dok = array('id_pengguna' => $idinv);
			$wh = array("id_pengguna"=>$idinv);
			// if (isset($_FILES['ttd']['name']) && $_FILES['ttd']['name'] != '') {
			// 	$filename = str_replace(' ', '_', $_FILES['ttd']['name']);
			// 	$filename = str_replace('(', '', $filename);
			// 	$filename = str_replace(')', '', $filename);
			//
			//
			// 	$config['upload_path']          = 'assets/img/ttd/';
			// 	$config['allowed_types']        = 'gif|jpg|png';
			// 	$config['file_name']        = $filename;
			// 	$this->load->library('upload', $config);
			// 	$this->upload->initialize($config);
			// 	//upload execute
			// 	$this->upload->do_upload('ttd');
			// 	$data['ttd']=$filename;
			// 	$this->m_invest->updatedata("tbl_pengguna",$data,$wh);
			//
			// 	$dok['ttd']=$filename;
			// }

			if (isset($_FILES['ktp']['name']) && $_FILES['ktp']['name'] != '') {
				$filename = str_replace(' ', '_', $_FILES['ktp']['name']);
				$filename = str_replace('(', '', $filename);
				$filename = str_replace(')', '', $filename);


				$config['upload_path']          = 'assets/img/dokumen/ktp/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $filename;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				//upload execute
				$this->upload->do_upload('ktp');

				$dok['foto_ktp']=$filename;
			}

			if (isset($_FILES['npwp']['name']) && $_FILES['npwp']['name'] != '') {
				$filename = str_replace(' ', '_', $_FILES['npwp']['name']);
				$filename = str_replace('(', '', $filename);
				$filename = str_replace(')', '', $filename);


				$config['upload_path']          = 'assets/img/dokumen/npwp/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $filename;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				//upload execute
				$this->upload->do_upload('npwp');

				$dok['foto_npwp']=$filename;
			}

			if (isset($_FILES['buku_tabungan']['name']) && $_FILES['buku_tabungan']['name'] != '') {
				$filename = str_replace(' ', '_', $_FILES['buku_tabungan']['name']);
				$filename = str_replace('(', '', $filename);
				$filename = str_replace(')', '', $filename);


				$config['upload_path']          = 'assets/img/dokumen/buku_tabungan/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $filename;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				//upload execute
				$this->upload->do_upload('buku_tabungan');

				$dok['buku_tabungan']=$filename;
			}

			if (isset($_FILES['selfie']['name']) && $_FILES['selfie']['name'] != '') {
				$filename = str_replace(' ', '_', $_FILES['selfie']['name']);
				$filename = str_replace('(', '', $filename);
				$filename = str_replace(')', '', $filename);


				$config['upload_path']          = 'assets/img/dokumen/selfie/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $filename;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				//upload execute
				$this->upload->do_upload('selfie');

				$dok['selfie']=$filename;
			}
			$this->m_invest->insertdata('tbl_dokumen', $dok);

			if(!empty($this->session->userdata("reff_code"))){
				$reff_code = $this->session->userdata("reff_code");
				$wh = array("b.kode_referral" => $reff_code);
				$dtp = $this->m_invest->checkPengguna($wh);

				if($dtp->num_rows() > 0){
					$getid = $dtp->row();
					$reff = array(
						"id_pengguna" => $idinv,
						"kode_referral" => $reff_code
					);

					$this->m_invest->insertdata("tbl_referral", $reff);
				}
			}

	    $result=array("result"=>"success","msg"=>"Sukses");

			$this->kirimEmailnyaDaftar($id_admin, $email);
	    } else {
	        $result=array("result"=>"fail","msg"=>"Gagal");
	    }
	    $this->session->set_flashdata($result);
         redirect("invest/result");
	}
	function generateReferral($idadmin, $strength = 6) {
		$input = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
		return $random_string.str_pad($idadmin, 4, '0', STR_PAD_LEFT);
	}
	public function result(){
		if($this->session->flashdata("result")!=""){
			$data['content']=$this->load->view("result", null, TRUE);
			$this->load->view('index',$data);
		} else {
			redirect("invest/register");
		}
	}
	public function investresult(){
	    //if($this->checkRole()=="investor"){
	        if($this->session->flashdata("hasil")!=""){
				$res=array("hasil"=>$this->session->flashdata("hasil"),"act"=>$this->session->flashdata("act"),"jumlah"=>$this->session->flashdata("jumlah"),"tanggal"=>$this->session->flashdata("tanggal"));
				$this->session->set_flashdata($res);
	            $data['content']=$this->load->view("investresult", null, TRUE);
    		    $this->load->view('index',$data);
	        } else {
	            redirect("investor");
	        }
	    //} else {
	      //  redirect("invest/register");
	    //}
	}
	public function ajukan_pinjaman(){
		if($this->checkRole()=="borrower"){
			$wh=array("p.id_pengguna"=>$this->session->userdata("invest_pengguna"));
			$data['data_produk']=$this->m_invest->dataProduk($wh);
			$data['content']=$this->load->view("ajukan-pinjaman", $data, TRUE);
			$this->load->view('index',$data);
	    } else {
	        redirect("invest/register");
	    }
	}
	private function _uploadTtd(){
        $config['upload_path']          = './assets/img/ttd/';
        $config['allowed_types']        = 'gif|jpeg|jpg|png|pdf';
        //$config['file_name']            = $this->product_id;
        $config['overwrite']			= true;
        //$config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('ttd')) {
            return $this->upload->data("file_name");
        }

        return "";
    }

	public function role_choice(){
	    $email=array("a.email"=>$this->input->post("user_reg"));
	    $datacheck=$this->m_invest->checkUser($email);
        if($datacheck->num_rows()>0){
            $result=array("result"=>"fail","msg"=>"Email ".$email['email']." Sudah Digunakan");
            $this->session->set_flashdata($result);
            redirect("invest/register");
        } else {
    	    $ucookie = get_cookie('user_reg');
    	    //if($this->input->post("user_reg")!=""){
    	        $userreg=array(
    	            "user_reg"=>$this->input->post("user_reg"),
    	            "pass_reg"=>md5($this->input->post("pass_reg")),
    	            "cpass_reg"=>md5($this->input->post("confirm_password")),
    	            "reff_code"=>$this->input->post("referral_code")
    	            );
    	        $this->setallcookie($userreg);
				$this->session->set_userdata($userreg);
    	   // }
    	    $pass=get_cookie('pass_reg');
	        $cpass=get_cookie('cpass_reg');
	        if($pass!=$cpass){
                $result=array("result"=>"fail_password","msg"=>"Password & Confirm Harus Sama");
                $this->session->set_flashdata($result);
                redirect("invest/register");
            } else {
        	    $data=array();
        	    /* if($ucookie!=""){
        	        $data['user_reg']=$ucookie;
        	        $data['pass_reg']=get_cookie("pass_reg");
        	    } else { */
					$data['user_reg']=$this->session->userdata("user_reg");
        	        $data['pass_reg']=$this->session->userdata("pass_reg");
				// }
        	    if($this->checkRole()=="investor"){
        	        redirect("Investor");
        	    } else {
        	        $data['content']=$this->load->view("role_choice", $data, TRUE);
            		$this->load->view('index',$data);
        	    }
            }
        }
	}
	public function login_choice(){
	    $ucookie = get_cookie('user_reg');
		$userreg=array(
	            "user_reg"=>$this->input->post("user_reg"),
	            "pass_reg"=>$this->input->post("pass_reg"),
	            "role_reg"=>$this->input->post("role_reg")
	            );
	    if($this->input->post("user_reg")!=""){

	        $this->setallcookie($userreg);
			$data['user_reg']=$this->input->post("user_reg");
	        $data['pass_reg']=$this->input->post("pass_reg");
	        $data['role_reg']=$this->input->post("role_reg");

	    }
		$this->session->set_userdata($userreg);
	    $data=array();
	    //if($ucookie!=""){
	        $data['user_reg']=$this->session->userdata("user_reg");
	        $data['pass_reg']=$this->session->userdata("pass_reg");
	        $data['role_reg']=$this->session->userdata("role_reg");
	    //}
	    if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
    	    $data['content']=$this->load->view("login_choice", $data, TRUE);
    		$this->load->view('index',$data);
	    }
	}
	public function register_choice(){
	    $ucookie = get_cookie('user_reg');
	    if($this->input->post("user_reg")!=""){
	        $userreg=array(
	            "user_reg"=>$this->input->post("user_reg"),
	            "pass_reg"=>$this->input->post("pass_reg"),
	            "role_reg"=>$this->input->post("role_reg"),
	            "choice_reg"=>$this->input->post("choice_reg")
	            );
	        $this->setallcookie($userreg);
			$this->session->set_userdata($userreg);
	    }
	    $data=array();
	    //if($ucookie!=""){
	        $data['user_reg']=$this->session->userdata("user_reg");
	        $data['pass_reg']=$this->session->userdata("pass_reg");
	        $data['role_reg']=$this->session->userdata("role_reg");
	        $data['choice_reg']=$this->session->userdata("choice_reg");
	    //}
	    if($this->checkRole()=="investor"){
	        redirect("Investor");
	    } else {
			$data['dataAgama']=$this->m_invest->dataAgama();
			$data['dataPendidikan']=$this->m_invest->dataPendidikan();
			$wh=array("country_code"=>"ID");
			$data['dataNegara']=$this->m_invest->dataNegara($wh);
			$prov="JAWA BARAT";
			$data['prov']=$prov;
			$kabkota="KOTA BANDUNG";
			$data['kabkota']=$kabkota;
			$data['dataProvinsi']=$this->m_invest->dataProvinsi();
			$wh=array("b.name"=>$prov);
			$data['dataKabKota']=$this->m_invest->dataKabKota($wh);
			$data['dataBank']=$this->m_invest->dataBanks();
			$data['dataPenghasilan']=$this->m_invest->dataPenghasilan();
			$data['dataPekerjaan']=$this->m_invest->dataPekerjaan();
			$data['toc'] = $this->m_invest->getToc()->toc;
    	    $data['content']=$this->load->view("register_choice", $data, TRUE);
    		$this->load->view('index',$data);
	    }
	}
	public function pilihKabKota(){
		$idprov = $this->input->post("id_prov");
		$wh=array("a.province_id"=>$idprov);
		$dataKabKota=$this->m_invest->dataKabKota($wh);
		$html = "<option selected disabled value=''>-- Pilih Kabupaten --</option>";
        foreach($dataKabKota->result() as $dtl){
            $html .= "<option value='".$dtl->id."'>".$dtl->name."</option>";
        }
        $callback = array('data_kabkota'=>$html);
        echo json_encode($callback);
	}
	public function proses_invest(){
		$date=date("Y-m-d H:i:s");
	    $data=array(
			"id_dana"=>date('YmdHis'),
	        "id_pengguna"=>$this->session->userdata("invest_pengguna"),
	        "id_produk"=>$this->input->post("id"),
	        "jumlah_dana"=>$this->input->post("jumlah_donasi"),
	        "createddate"=>$date
	    );
	    $this->m_invest->insertdata("trx_dana_invest",$data);
	    $dana = $this->session->userdata("invest_dana")-$this->input->post("jumlah_donasi");
        $this->session->set_userdata("invest_dana",$dana);
		$msg="Invest Dana Sukses, sebesar Rp. ".number_format($this->input->post("jumlah_donasi"),0,".",".")." pada tanggal ".$date;
		$dtp=array(
			"id_pengguna"=>$this->session->userdata("invest_pengguna"),
			"pesan"=>$msg,
			"createddate"=>$date
		);
		$this->m_invest->insertdata("tbl_pesan",$dtp);
		$res=array("hasil"=>"Sukses","act"=>"Invest Dana","jumlah"=>$this->input->post("jumlah_donasi"),"tanggal"=>$date);
        $this->session->set_flashdata($res);
        echo base_url()."invest/investresult";
	}
	public function proses_kembali(){
		$date=date("Y-m-d H:i:s");
		$url=$this->session->userdata("url");
		$data=array(
		"id_dana"=>date('YmdHis'),
	        "id_pengguna"=>$this->session->userdata("invest_pengguna"),
	        "id_produk"=>$this->input->post("id_produk"),
	        "jumlah_dana"=>$this->input->post("jumlah_donasi"),
			"angsuran_ke"=>$this->input->post("angsuranke"),
			"type_dana"=>"kembali",
			"status_approve"=>"approve",
	        "createddate"=>$date
	    );
		$this->m_invest->insertdata("trx_dana",$data);
		$wh=array(
			"p.id_produk"=>$this->input->post("id_produk"),
			"p.status_approve"=>"approve",
			"i.status_approve"=>"approve"
		);
		$datainv=$this->m_invest->dataProdukDtl($wh);
		//print_r($datainv);
		$i = 0;
		$data=array();
		foreach($datainv->result() as $dt)
		{
			$jumlahdana=$dt->jumlah_dana;
			$pokok=$jumlahdana/$dt->tenor;
			$sisa=$jumlahdana-($pokok*$this->input->post("angsuranke"));

			$tenor=$dt->tenor;
			$bagihasil=$dt->bagi_hasil;
			$bungaprs=(($bagihasil)/100);
			$bunga = $sisa* $bungaprs;
			$jum=$pokok+$bunga;

			  $data[$i]=array(
				"id_dana"=>date('YmdHis'),
				"id_pengguna"=>$dt->pengguna_invest,
				"id_produk"=>$this->input->post("id_produk"),
				"jumlah_dana"=>$jum,
				"angsuran_ke"=>$this->input->post("angsuranke"),
				"type_dana"=>"tambah",
				"status_approve"=>"approve",
				"createddate"=>$date
			);
			  $i++;
		}
		$this->m_invest->insertbatch("trx_dana",$data);
		if($this->input->post("angsuranke")==$this->input->post("tenor")){
			$data=array("status_approve"=>"complete");
			$wh=array("id_produk"=>$this->input->post("id_produk"));
			$this->m_invest->updatedata("trx_produk",$data,$wh);
		}
		$res['msg'] = '<p class="box-msg">
							  <div class="info-box alert-success">
								  <div class="info-box-icon">
									<i class="fa fa-check-circle"></i>
								  </div>
								  <div class="info-box-content" style="font-size:20px">
									Angsuran Berhasil Ditambahkan</div>
							  </div>
							</p>';
		$this->session->set_flashdata($res);
	}
	public function proses_payment($id=""){
		$wh=array("modul"=>"midtrans");
        $midtrans = $this->m_invest->refferal_setting($wh)->row();
		$val = json_decode($midtrans->value);
		$id_user = $this->input->post('id_user');
		$dataBank=$this->m_invest->dataBank(array("id_pengguna"=>$this->session->userdata("invest_pengguna")))->row();
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$firstname = $this->input->post('firstname');
		$nama_program = $this->input->post('nama_program');
		$ucapan_dukungan = $this->input->post('ucapan_dukungan');
		$phone = $this->input->post('phone');
     		$jumDonasi=str_replace('.','',$this->input->post('jumlah_donasi'));

		// ."|".$this->input->post("action")."|".$this->session->userdata("invest_pengguna")."|".$dataBank->id_bank_pengguna."|".$id
		$transaction_details = array(
	'order_id' 			=> uniqid(),
		'gross_amount' 	=> (int) $jumDonasi
		);


		$items = [
		array(
		'id' 				=> $id,
		'price' 		=> (int) $jumDonasi,
		'quantity' 	=> 1,
		'name' 			=> $nama_program,
		'id_user' 			=> $id_user,
		'ucapan_dukungan'	=> $ucapan_dukungan,
		'firstname'			=>$firstname

		)
		];


		// Populate customer's billing address
		$billing_address = array(
		'first_name' 		=> $email,
		'last_name' 		=> "",
		'address' 			=> "",
		'city' 					=> "",
		'postal_code' 	=> "",
		'phone' 				=> $phone,
		'country_code'	=> 'IDN'
		);

		// Populate customer's shipping address
		$shipping_address = array(
		'first_name' 	=> "John",
		'last_name' 	=> "Watson",
		'address' 		=> "",
		'city' 				=> "",
		'postal_code' => "",
		'phone' 			=> "",
		'country_code'=> 'IDN'
		);

		// Populate customer's Info
		$customer_details = array(
		'first_name' 			=> $firstname,
		'last_name' 			=> "",
	    'email' 					=> $email,
	    'phone' 					=> $phone,
		'billing_address' => $billing_address,
		'shipping_address'=> $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		// Uncomment 'credit_card_3d_secure' => true jika transaksi ingin diproses dengan 3DSecure.
		$transaction_data = array(
		    'action'=>$this->input->post("action"),
		    'id_produk'=>$id,
		'payment_type' 			=> 'vtweb',
		'vtweb' 				=> array(
		//'enabled_payments' 	=> ['credit_card'],
		'credit_card_3d_secure' => true
		),
		'transaction_details'=> $transaction_details,
		'item_details' 			 => $items,
		'customer_details' 	 => $customer_details
		);

		//var_dump($transaction_data);
		$var=json_encode($transaction_data);
		//echo $var;
		$this->session->set_userdata('Transaksi',$var);
		$vtweb_url = $this->veritrans->vtweb_charge($transaction_data);
		echo $vtweb_url;
	}
	public function checkRole(){
	    $role="";
	    if($this->session->userdata("invest_username")!="" && $this->session->userdata("invest_email")!=""){
	        $role=$this->session->userdata("invest_tipe");
	    } else {
    	    $role="user";
	    }
	    return $role;
	}

	public function setallcookie($dt=""){
	    foreach($dt as $key=>$data){
	        delete_cookie($key);
            set_cookie($key, $data, 3600*24*30); // set expired 30 hari kedepan
        }
	}

	function pdf(){
		tcpdf();
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		//$obj_pdf->SetCreator(PDF_CREATOR);
		$title = "PDF Report";
		$obj_pdf->SetTitle($title);
		//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
		//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$obj_pdf->SetDefaultMonospacedFont('helvetica');
		//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$obj_pdf->SetFont('helvetica', '', 9);
		$obj_pdf->setFontSubsetting(false);
		$obj_pdf->AddPage();
		ob_start();
			// we can have any view part here like HTML, PHP etc
			$content = $this->load->view('pdfreport', null,true);
		ob_end_clean();
		$obj_pdf->writeHTML($content, true, false, true, false, '');
		$obj_pdf->Output('output.pdf', 'I');

	}
	function pdfproyeksi(){
		if($this->input->post("periode")!=""){
			tcpdf();
			$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//$obj_pdf->SetCreator(PDF_CREATOR);
			$title = "PDF Report";
			$obj_pdf->SetTitle($title);
			//$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
			//$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			$obj_pdf->SetDefaultMonospacedFont('helvetica');
			//$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
			$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$obj_pdf->SetFont('helvetica', '', 9);
			$obj_pdf->setFontSubsetting(false);
			$obj_pdf->AddPage();
			ob_start();
				// we can have any view part here like HTML, PHP etc
				$content = $this->load->view('pdfproyeksi', null,true);
			ob_end_clean();
			$obj_pdf->writeHTML($content, true, false, true, false, '');
			$obj_pdf->Output('Proyeksi-'.$this->input->post("periode").'.pdf', 'I');
		} else {
			redirect("investor/proyeksi");
		}
	}
	public function page($page=""){
	    $data['page']=$page;
		//$exp=explode("_",$page);
		//if(count($exp)>1){
			$page="invest/page/".$page;
		//}
		$wh = array("link_page"=>$page,"status_delete"=>"0");

		$dtpage = $this->m_invest->getPage($wh);
		if($dtpage->num_rows()>0){
			$data['data_page']=$dtpage->row();
			$data['content']=$this->load->view("page", $data, TRUE);
			$this->load->view('index',$data);
		} else {
			var_dump($dtpage->result());
			redirect("invest");
		}
	}
	public function role_choice_sosmed(){

	    $email=array("a.email"=>$this->input->post("user_reg"));
	    $datacheck=$this->m_invest->checkUser($email);
        if($datacheck->num_rows()>0){
            $result=array("result"=>"fail","msg"=>"Email ".$email['email']." Sudah Digunakan");
            $this->session->set_flashdata($result);
            redirect("invest/register");
        } else {
    	    $ucookie = get_cookie('user_reg');
    	    //if($this->input->post("user_reg")!=""){
    	        $userreg=array(
    	            "user_reg"=>$this->input->post("user_reg"),
    	            "pass_reg"=>md5($this->input->post("pass_reg")),
    	            "cpass_reg"=>md5($this->input->post("confirm_password")),
    	            );
    	        $this->setallcookie($userreg);
				$this->session->set_userdata($userreg);
    	   // }
    	    $pass=get_cookie('pass_reg');
	        $cpass=get_cookie('cpass_reg');
	        if($pass!=$cpass){
                $result=array("result"=>"fail","msg"=>"Password & Confirm Harus Sama");
                $this->session->set_flashdata($result);
                redirect("invest/register");
            } else {
        	    $data=array();
        	    /* if($ucookie!=""){
        	        $data['user_reg']=$ucookie;
        	        $data['pass_reg']=get_cookie("pass_reg");
        	    } else { */
					$data['user_reg']=$this->session->userdata("user_reg");
        	        $data['pass_reg']=$this->session->userdata("pass_reg");
				// }
        	    if($this->checkRole()=="investor"){
        	        redirect("Investor");
        	    } else {
        	        $data['content']=$this->load->view("role_choice", $data, TRUE);
            		$this->load->view('index',$data);
        	    }
            }
        }
	}
}
