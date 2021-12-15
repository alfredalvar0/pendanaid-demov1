<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('google_login_model');
  $this->load->model('m_invest');
 }

 function login()
 {
  include_once APPPATH . "../vendor/autoload.php";

  $google_client = new Google_Client();

  $google_client->setClientId('649463208010-urdf8rs5oi37ao6gepb668vm34dbfebi.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  // $google_client->setRedirectUri('https://pendanausaha.sekolahpilotfilipina.com/'); //Define your Redirect Uri
  $google_client->setRedirectUri('http://localhost:82/pendanaid-demov1/google_login/login'); //Define your Redirect Uri

  $google_client->addScope('email');

  $google_client->addScope('profile');

  if(isset($_GET["code"]))
  {
   $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
   if(!isset($token["error"]))
   {
    $google_client->setAccessToken($token['access_token']);

    $this->session->set_userdata('access_token', $token['access_token']);

    $google_service = new Google_Service_Oauth2($google_client);

    $data = $google_service->userinfo->get();

    $current_datetime = date('Y-m-d H:i:s');

    if($this->google_login_model->Is_already_register($data->email))
    {
     //update data
     $user_data = array(
      'password' => $data['id'],
      'username'  => $data['given_name'],
      'tipe'   => 'investor',
      'tipeuser'   => 'perusahaan',
      'status'   => 'aktif',
      'investstatus'   => 'aktif',
      'email'  => $data['email']
     );

     $this->google_login_model->Update_user_data($user_data, $data->email);
    }
    else
    {
     //insert data
    $user_data = array(
      'password' => $data['id'],
      'username'  => $data['given_name'],
      'tipe'   => 'investor',
      'tipeuser'   => 'perusahaan',
      'status'   => 'aktif',
      'investstatus'   => 'aktif',
      'email'  => $data['email']
     );
    
     $this->google_login_model->Insert_user_data($user_data);
    }


    $wh=array(
      "a.email"=>$data->email,
      "a.password"=>$data['id'],
      "login_from"=>"web",
      "status"=>"aktif"
    );
    $datauser=$this->m_invest->checkUser($wh);
    if($datauser->num_rows()>0){
            if($datauser->num_rows()>0){
            $dt=$datauser->row();
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
        }
      }

    // $this->session->set_userdata('user_data', $user_data);
   }
  }
  $login_button = '';
  if(!$this->session->userdata('access_token'))
  {
     $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'assets/google.png" /></a>';
     $data['login_button'] = $login_button;
     $this->load->view('google_login', $data);
  }
  else
  {
      redirect("invest");
  }
 }

 function logout()
 {
  $this->session->unset_userdata('access_token');

  $this->session->unset_userdata('user_data');

  redirect('google_login/login');
 }
 
}
?>