<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_login extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('google_login_model');
 }

 function login()
 {
  include_once APPPATH . "libraries/Google/autoload.php";

  $google_client = new Google_Client();

  $google_client->setClientId('156955562241-uhm2khoe3s1ib0p1kpvm49g94ufr7teb.apps.googleusercontent.com'); //Define your ClientID

  $google_client->setClientSecret('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'); //Define your Client Secret Key

  $google_client->setRedirectUri('https://pendanausaha.sekolahpilotfilipina.com/'); //Define your Redirect Uri

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

    if($this->google_login_model->Is_already_register($data->$email))
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

     $this->google_login_model->Update_user_data($user_data, $data->$email);
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
     $this->session->set_userdata($user_data);
     $this->google_login_model->Insert_user_data($user_data);
    }
    $this->session->set_userdata('user_data', $user_data);
   }
  }
  $login_button = '';
//   if(!$this->session->userdata('access_token'))
//   {
   $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="'.base_url().'assets/google.png" /></a>';
   $data['login_button'] = $login_button;
   $this->load->view('google_login', $data);
//   }
//   else
//   {
//   $this->load->view('google_login', $data);
//   }
 }

 function logout()
 {
  $this->session->unset_userdata('access_token');

  $this->session->unset_userdata('user_data');

  redirect('google_login/login');
 }
 
}
?>