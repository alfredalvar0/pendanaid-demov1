<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Loginadmin extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_admin');
        $this->load->model('m_invest');
        $lib=array("session","form_validation");
        $this->load->library($lib);
	}

	public function do_login()
	{

		$data = array('email' => $this->input->post('email'),
					'password' => md5($this->input->post('password'))
					);

		$var = $this->M_admin->select($data);

		if ($var->num_rows() > 0 && ($var->row()->tipe == 'admin' && $var->row()->status == 'aktif')) {
			$data_session = array(
				'emails' => $this->input->post('email'),
				'passwords' => md5($this->input->post('password')),
				'tipe' => $var->row()->tipe,
				'status' => $var->row()->status,
				'id_admins' => $var->row()->id_admin
			);
			$this->session->set_userdata($data_session);
			redirect('Admin/home');
		}else{
			// redirect('admin_menstruasi');
			redirect('Admin');
		}
	}

	public function resetPass()
	{
		$result=array();
		$format="";
		$nik="";
		$resetkey = $this->generate_string(25);
        $mailTo=$_POST['email'];
		$mailformat = $this->MailFormatView($format,$mailTo,$resetkey);
        $msg="";
		$wh=array(
			"a.email"=>$mailTo,
			"a.status"=>"aktif",
			"a.tipe"=>"admin"
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
								  <i class="fa fa-check-circle"></i>Email terkirim
							  </div>';
				} else {
					$alert = '<div class="alert alert-danger">
								  <i class="fa fa-check-circle"></i>Email gagal terkirim
							  </div>';
				}
			/* } else {
				$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Anda sudah melakukan reset password, check email, max melakukan reset 1 kali per 24 jam');
			} */
		} else {
			$alert = '<div class="alert alert-danger">
						  <i class="fa fa-check-circle"></i>
						 Email Belum Terdaftar
					  </div>';
		}
		$this->session->set_flashdata(array('notif' => $alert));
		// $this->session->set_flashdata($result);
        //echo $mail;
		//echo $mailformat;
        redirect("admin/reset_pass");
    }

	function prosesResetPass(){
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
				// $result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Token Expire');
				$result['notif'] = '
							  <div class="alert alert-danger">
									<i class="fa fa-times-circle"></i> Token Expire
							  </div>';
				$this->session->set_flashdata($result);
				redirect("admin");
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
									<i class="fa fa-check-circle"></i> Berhasil Reset
							  </div>';
					/* } else {
						$result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data Invalid');
					} */
					$this->session->set_flashdata($result);
					redirect("admin");
				} else {
					// $result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data Pass & Konf harus Sama');
					$result['notif'] = '<div class="alert alert-danger">
								<i class="fa fa-times-circle"></i> Password tidak sama
							</div>';
					$this->session->set_flashdata($result);
					redirect("admin/resetpass/".$key);
				}
			}
		} else {
			// $result=array("alert"=>"danger",'title'=>"Gagal",'hasil'=>'Data not Found');
			$result['notif'] = '<div class="alert alert-danger">
						<i class="fa fa-times-circle"></i> Data Not Found
					</div>';
			$this->session->set_flashdata($result);
			redirect("admin");
		}
	}

	function logout(){
		unset($_SESSION['id_admins'],$_SESSION['emails'],$_SESSION['passwords'],$_SESSION['tipe']);

		// redirect('admin_menstruasi');
		redirect('Admin');
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

	public function MailFormatView($format="",$nik="",$resetkey=""){
        //if($this->session->userdata('user_type')==3 && $this->session->userdata('username')!='' &&$this->session->userdata('status')=='login'){
			//$data['menuId']=array(52,62);
            $wh=array("mail_company"=>"PT. Pendana Usaha");
            $data['mailserver'] = $this->m_invest->mailserver($wh)->row();
            $title="Reset Password";
            //$whnik=array("c.nik"=>$nik);
            //$data['datakar'] = $this->My_model->getUserKaryawan($whnik)->row();
            //$data['datajadwal'] = $this->My_model->dataJadwalLokerPelamar($data['datakar']->idlokerdl);
            $data['mailtitle'] = $title;
			$data['email'] = $nik;
			$data['foradmin'] = true;
            $data['resetkey'] = $resetkey;
            $data['mailformat'] = $this->input->post("format");
			return $this->load->view('template/v-mail-format',$data,TRUE);
		/* }else{
			redirect("home/login");
		} */
    }
}
