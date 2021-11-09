<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Bisnis extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_bisnis'); 
        $this->load->model('m_invest');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataBisnis'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/bisnis';
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
			$data['idbisnis']=$id;
			$data['content'] = 'admin/danainvest';

			$this->load->view('admin/indexadmin',$data);

		}else{

			$this->load->view('login');

		}
	}
 
	public function register(){
	    
    	    $data=array();
			//$wh=array("p.status_approve"=>"approve");
			//$whi=array("p.status_approve"=>array("approve","complete","invest","running"));
    	    $data['databisnis']=$this->m_invest->dataBisnis();

    	    $data['content']=$this->load->view("daftar-bisnis", $data, TRUE);
    	    
    		$this->load->view('index',$data);
	     
	}
	
	public function tampil()
	{
		$data['dataBisnis'] = $this->M_bisnis->select_all();
		$this->load->view('admin/bisnis/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/bisnis/form';
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

	public function prosesTambah() {
		$out = array();
		// $data = array();
		
			$dataBisnis = array(
				'nama_binsis'=>$this->input->post('nama_binsis'),
	            'finansial_rata'=>$this->input->post('finansial_rata'),
	            'finansial_dividen'=>$this->input->post('finansial_dividen'),
	            'finansial_dividen_waktu'=>$this->input->post('finansial_dividen_waktu'),
	            'finansial_balik_modal'=>$this->input->post('finansial_balik_modal'),
	            'tentang_bisnis'=>$this->input->post('tentang_bisnis'),
	            'id_kategori'=>$this->input->post('id_kategori'),
	            'pemilik'=>$this->input->post('pemilik'),
	            'tahun_berdiri'=>$this->input->post('tahun_berdiri'),
	            'lokasi'=>$this->input->post('lokasi'), 
	            'datecreated'=>date('Y-m-d H:i:s'),
	            'userid'=>$this->session->userdata('id_admins')

	        );

		if ( $_FILES['foto']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);
			$dataBisnis['foto'] = $filename;
			$result = $this->M_bisnis->insert($dataBisnis);

			if ($result > 0) {
				$config['upload_path']          = 'assets/img/bisnis/';
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
					        	Data Bisnis Berhasil Ditambahkan</div>
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
				        	Data Bisnis Gagal Upload</div>
					  </div>
				    </p>';
	            }
			} else {
				$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bisnis Gagal Ditambahkan</div>
					  </div>
				    </p>';
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bisnis Gagal Ditambahkan Luar
				        	</div>
					  </div>
				    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Bisnis');
	}

	public function update($id) {
			
		
		$where = array('a.id_bisnis'=>$id);
		$data['dataBisnis'] 	= $this->M_bisnis->select_all($where)->row();
		$data['content'] = 'admin/bisnis/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
		// $data = array();
		$idbisnis = $this->input->post('id_bisnis');
		$idpengguna = $this->input->post('id_pengguna');
		// $data 	= $this->input->post();
		$dataBisnis = array(
				'nama_binsis'=>$this->input->post('nama_binsis'),
	            'finansial_rata'=>$this->input->post('finansial_rata'),
	            'finansial_dividen'=>$this->input->post('finansial_dividen'),
	            'finansial_dividen_waktu'=>$this->input->post('finansial_dividen_waktu'),
	            'finansial_balik_modal'=>$this->input->post('finansial_balik_modal'),
	            'tentang_bisnis'=>$this->input->post('tentang_bisnis'),
	            'id_kategori'=>$this->input->post('id_kategori'),
	            'pemilik'=>$this->input->post('pemilik'),
	            'tahun_berdiri'=>$this->input->post('tahun_berdiri'),
	            'lokasi'=>$this->input->post('lokasi'), 
	            'datecreated'=>date('Y-m-d H:i:s'),
	            'userid'=>$this->session->userdata('id_admins')
	        );
			
		$pesan = $this->input->post('pesan');
		if ($pesan == "") {
			
		}else{
			$dataPesan = array('pesan'=>$pesan,
							'id_pengguna'=>$idpengguna,
							'createddate'=>date('Y-m-d H:i:s')
						);
			$result = $this->M_bisnis->insertpesan($dataPesan);
		}
		// $dataBisnis['foto'] = '';
		$filename = '';

		if ( $_FILES['foto']['name'] != '') {
			$filename = str_replace(' ', '_', $_FILES['foto']['name']);
			$filename = str_replace('(', '', $filename);
			$filename = str_replace(')', '', $filename);
			$dataBisnis['foto'] = $filename;
		}

			
			if ($_FILES['foto']['name'] != '' ) {
						
				$config['upload_path']          = 'assets/img/bisnis/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
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
						        	Data Bisnis Berhasil Diupdate</div>
							  </div>
						    </p>';
				}else{
					$out['status'] = '';
						$out['msg'] = '<p class="box-msg">
						      <div class="info-box alert-error">
							      <div class="info-box-icon">
							      	<i class="fa fa-check-circle"></i>
							      </div>
							      <div class="info-box-content" style="font-size:20px">
						        	Data Bisnis Gagal Diupdate</div>
							  </div>
						    </p>';
				}
			}
			$result = $this->M_bisnis->update($dataBisnis,$idbisnis);
				if ($result > 0) {
					$out['status'] = '';
						$out['msg'] = '<p class="box-msg">
						      <div class="info-box alert-success">
							      <div class="info-box-icon">
							      	<i class="fa fa-check-circle"></i>
							      </div>
							      <div class="info-box-content" style="font-size:20px">
						        	Data Bisnis Berhasil Diupdate</div>
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
						        	Data Bisnis Gagal Diupdate</div>
							  </div>
						    </p>';
				}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('Bisnis');
	}

	public function delete() {
		
		$id = array('id_bisnis'=>$this->input->post('id'));
		$result = $this->M_bisnis->del_data("tbl_bisnis",$id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bisnis Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Bisnis Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

