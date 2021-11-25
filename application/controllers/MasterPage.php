<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MasterPage extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_page');
        $this->load->model('M_admin');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function index(){
		if ($this->session->userdata('emails') != '' && $this->session->userdata('passwords') != '') {
			$tipe = array('tipe'=>$this->session->userdata('tipe'));
			$data['dataAdmin'] = $this->M_admin->data_admin($tipe)->row();
			$data['content'] = 'admin/mstpage';
			$this->load->view('admin/indexadmin',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function tampil()
	{
		$data['dataMasterPage'] = $this->M_page->select_all();
		$this->load->view('admin/mstpage/list_data', $data);
	}

	public function tambah(){
		$data['content'] = 'admin/mstpage/form';
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
	
	public function prosesCek(){
		$link = $this->input->post('link_page');

		$url = $this->M_page->select_url($link);
		
		if ($url->num_rows() > 0) {
			echo "Link sudah ada yang menggunakan";
		}else{
			echo "Link Belum ada ";
		}
	}

	public function prosesTambah() {
		$out = array();
// 		$data = array();
		
		$this->form_validation->set_rules('nama_page', 'nama_page', 'trim|required');
		$this->form_validation->set_rules('link_page', 'link_page', 'trim|required');

// 		$data 	= $this->input->post();
        $dataPage = array('judul'=>$this->input->post('nama_page'),
                            'content'=>$this->input->post('content'),
                            'meta_keyword'=>$this->input->post('meta_keyword'),
                            'meta_tags'=>$this->input->post('meta_tags'),
                            'meta_description'=>$this->input->post('meta_description'),
                            'link_page'=>$this->input->post('link_page'),
                            'kategori'=>$this->input->post('kategori'),
							'sort_number'=>$this->input->post('sort_number'),
                            'icon'=>$this->input->post('icon'),
							'status_delete'=>$this->input->post('sts')
        );
		$result = $this->M_page->insert($dataPage);
		
		if ($result > 0) {
        	$out['status'] = '';
			$out['msg'] = '<p class="box-msg">
			      <div class="info-box alert-success">
				      <div class="info-box-icon">
				      	<i class="fa fa-check-circle"></i>
				      </div>
				      <div class="info-box-content" style="font-size:20px">
			        	Data Page Berhasil Ditambahkan</div>
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
		        	Data Page Gagal Ditambahkan</div>
			  </div>
		    </p>';
		}

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('MasterPage');
	}

	public function update($id) {
			
		$id 				= $id;
		$data['dataMstPage'] 	= $this->M_page->select_by_id($id);
		$data['content'] = 'admin/mstpage/form_update';
		$this->load->view('admin/indexadmin',$data);
		
	}

	public function prosesUpdate(){
		$out = array();
// 		$data = array();
        
        $idpage = $this->input->post('id_page');
        
		$dataPage = array('judul'=>$this->input->post('nama_page'),
                            'content'=>$this->input->post('content'),
                            'meta_keyword'=>$this->input->post('meta_keyword'),
                            'meta_tags'=>$this->input->post('meta_tags'),
                            'meta_description'=>$this->input->post('meta_description'),
                            'link_page'=>$this->input->post('link_page'),
                            'kategori'=>$this->input->post('kategori'),
							'sort_number'=>$this->input->post('sort_number'),
                            'status_delete'=>$this->input->post('sts'),
							'icon'=>$this->input->post('icon')
        );
		
		$result = $this->M_page->update($dataPage,$idpage);
		
		if ($result > 0) {
			$out['status'] = '';
				$out['msg'] = '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Page Berhasil Diupdate</div>
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
				        	Data Page Gagal Diupdate</div>
					  </div>
				    </p>';
		}
		

		$this->session->set_flashdata('msg', $out['msg']);
		redirect('MasterPage');
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_page->delete($id);
		
		if ($result > 0) {
			echo '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Page Berhasil Dihapus</div>
					  </div>
				    </p>';
		} else {
			echo '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:20px">
				        	Data Page Gagal Dihapus</div>
					  </div>
				    </p>';
		}
	}

}

