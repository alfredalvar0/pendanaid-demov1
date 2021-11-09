<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Produk extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_produk');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/produk';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}
	
	public function history($id=""){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {

			$tipe = array(
				'tipe'=>$this->session->userdata('tipe')
			);

			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['idproduk']=$id;
			$data['content'] = 'admin/danainvest';

			$this->load->view('admin/indexadmin',$data);

		}else{

			$this->load->view('login');

		}
	}

	public function tampil($id)
	{
		if($id==""){$id=$_GET['id'];}
		$where = array('a.id_bisnis'=>$id );
		$data['dataProduk'] = $this->M_produk->select_all($where );
		$this->load->view('admin/produk/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/produk/form';
		$this->load->view('admin/indexadmin',$data);
	}

	public function upload(){
		ob_get_level();

        //Image Save Option
		//저장 옵션
        $getpath = $this->input->get('path');
        $path = 'assets/admin/img/page/'.$getpath;

        $config['upload_path'] = $path; //YOUR PATH
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '0';
        $config['file_name'] = 'upload';
        $config['remove_spaces'] = TRUE;

        //Form Upload, Drag & Drop
        $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
        if(empty($CKEditorFuncNum))
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Drag & Drop
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            header('Content-Type: application/json');

            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload("upload"))
            {
                $jsondata = array('uploaded'=> 0, 'fileName'=> 'null1', 'url'=> 'null','eror'=>$this->upload->display_errors());

                echo json_encode($jsondata);
            }
            else
            {
                $data = $this->upload->data();

                // JPG compression
                if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }

                $filename = $data['file_name'];
                $url = base_url().$path.'/'.$filename;

                $jsondata = array('uploaded'=> 1, 'fileName'=> $filename, 'url'=> $url);
                echo json_encode($jsondata);
            }
        }
        else
        {
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Form Upload
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            $this->load->library('upload', $config);
            if ( !$this->upload->do_upload("upload"))
            {
                echo "<script>alert('Send Fail".$this->upload->display_errors('','')."')</script>";
            }
            else
            {
                $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
                $data = $this->upload->data();

                // JPG compression
                if($this->upload->data('file_ext') === '.jpg') {
                    $filename = $this->upload->data('full_path');
                    $img = imagecreatefromjpeg($filename);
                    imagejpeg($img, $filename, 80);
                }

                $filename = $data['file_name'];

                $url = base_url().$path.'/'.$filename;
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', 'Send OK')</script>";
            }
        }

        ob_end_flush();
    	
	}

	public function prosesTambah($id) {
		$out = array();
		// $data = array();
		
		$dataProduk = array(
				'id_bisnis'=>$id,
	            'siteurl'=>str_replace(' ', '-', $this->input->post('siteurl')),
	            'judul'=>$this->input->post('judul'),
	            'nilai_bisnis'=>$this->input->post('nilai_bisnis'),
	            'lembar_saham'=>$this->input->post('lembar_saham'),
	            'harga_perlembar'=>$this->input->post('harga_perlembar'),
	            'saham_dibagi'=>$this->input->post('saham_dibagi'),
	            'finansial_dividen'=>$this->input->post('finansial_dividen'),
	            'finansial_dividen_waktu'=>$this->input->post('finansial_dividen_waktu'),
	            'finansial_rata'=>$this->input->post('finansial_rata'),
	            'finansial_balik_modal'=>$this->input->post('finansial_balik_modal'),
	            'tentang_bisnis'=>$this->input->post('tentang_bisnis'),
	            'lokasi'=>$this->input->post('lokasi'),
	            'pemilik'=>$this->input->post('pemilik'),
				'tglawal'=>$this->input->post('tglawal'),
				'tglakhir'=>$this->input->post('tglakhir'),
				'video'=>$this->input->post('video'),  
	            'userid'=>$this->session->userdata('id_admins'),
				'datecreated'=>date('Y-m-d H:i:s'),
	            'status_approve'=>'approve'

	        );

		if ( $_FILES['foto']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$dataProduk['foto'] = $filename;
			} else{
				$dataProduk['foto'] ="";
			}
			
		} else {
			$dataProduk['foto'] ="";
		}
		
		if ( $_FILES['foto2']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto2']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto2')) {
				$dataProduk['foto2'] = $filename;
			} else{
				$dataProduk['foto2'] ="";
			}
			
		} else {
			$dataProduk['foto2'] ="";
		}
		
		if ( $_FILES['foto3']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto3']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto3')) {
				$dataProduk['foto3'] = $filename;
			} else{
				$dataProduk['foto3'] ="";
			}
			
		} else {
			$dataProduk['foto3'] ="";
		}
		
		if ( $_FILES['proposal']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['proposal']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/proposal/';
			$config['allowed_types']        = 'docx|doc|pdf|png|jpg|jpeg|xls|xlsx';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('proposal')) {
				$dataProduk['proposal'] = $filename;
			} else{
				$dataProduk['proposal'] ="";
			}
			
		} else {
			$dataProduk['proposal'] ="";
		}
		
		$result = $this->M_produk->insert($dataProduk);
		if ($result > 0) {
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
		} else {
			$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
				  <div class="info-box alert-error">
					  <div class="info-box-icon">
						<i class="fa fa-warning"></i>
					  </div>
					  <div class="info-box-content" style="font-size:20px">
						Data Produk Gagal Ditambahkan</div>
				  </div>
				</p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Produk?id='.$id);
	}

	public function update($id) {
			
		
		$where = array('a.id_produk'=>$id);
		$data['dataProduk'] 	= $this->M_produk->select_all($where)->row();
		$data['content'] = 'admin/produk/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate($id){
		$out = array();
		// $data = array();
		$idproduk = $this->input->post('id_produk'); 
		// $data 	= $this->input->post();
		$dataProduk = array( 
	            'siteurl'=>str_replace(' ', '-', $this->input->post('siteurl')),
	            'judul'=>$this->input->post('judul'),
	            'nilai_bisnis'=>$this->input->post('nilai_bisnis'),
	            'lembar_saham'=>$this->input->post('lembar_saham'),
	            'harga_perlembar'=>$this->input->post('harga_perlembar'),
	            'saham_dibagi'=>$this->input->post('saham_dibagi'),
	            'finansial_dividen'=>$this->input->post('finansial_dividen'),
	            'finansial_dividen_waktu'=>$this->input->post('finansial_dividen_waktu'),
	            'finansial_rata'=>$this->input->post('finansial_rata'),
	            'finansial_balik_modal'=>$this->input->post('finansial_balik_modal'),
	            'tentang_bisnis'=>$this->input->post('tentang_bisnis'),
	            'lokasi'=>$this->input->post('lokasi'),
	            'pemilik'=>$this->input->post('pemilik'),
				'tglawal'=>$this->input->post('tglawal'),
				'tglakhir'=>$this->input->post('tglakhir'),
				'video'=>$this->input->post('video'),  
	            'userid'=>$this->session->userdata('id_admins'),
				
	            'status_approve'=>$this->input->post('status_approve')
	        );
		
		 
		 
		if ( $_FILES['foto']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$dataProduk['foto'] = $filename;
			}  
			
		}  
		
		if ( $_FILES['foto2']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto2']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto2')) {
				$dataProduk['foto2'] = $filename;
			}  
			
		}  
		
		if ( $_FILES['foto3']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto3']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename); 
			$config['upload_path']          = 'assets/img/produk/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $filename; 
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto3')) {
				$dataProduk['foto3'] = $filename;
			}  
			
		}  
		
		if ( $_FILES['proposal']['name'] != '') {
			$namaFile = $_FILES['proposal']['name'];
			$namaSementara = $_FILES['proposal']['tmp_name'];

			// tentukan lokasi file akan dipindahkan
			$dirUpload = "assets/img/produk/proposal/";

			// pindahkan file
			$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

			if ($terupload) {
				$dataProduk['proposal'] = $namaFile;
			} else{
				print_r($terupload);
			}
			
		}  
		 
		$result = $this->M_produk->update($dataProduk,$idproduk);
		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
					  <div class="info-box alert-success">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">
							Data Produk Berhasil Diupdate</div>
					  </div>
					</p>';
		} else{
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
					  <div class="info-box alert-error">
						  <div class="info-box-icon">
							<i class="fa fa-check-circle"></i>
						  </div>
						  <div class="info-box-content" style="font-size:20px">
							Data Produk Gagal Diupdate</div>
					  </div>
					</p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Produk?id='.$id);
	}

	public function delete() {
		
		$id = array('id_produk'=>$this->input->post('id'));
		$result = $this->M_produk->del_data("trx_produk",$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Produk Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Produk Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

