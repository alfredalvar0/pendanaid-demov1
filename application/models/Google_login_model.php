<?php
class Google_login_model extends CI_Model
{
  public function __construct(){
        parent::__construct();
        // Your own constructor code
        $this->load->database();
              $lib=array("phpmailer_library","session");
       $this->load->library($lib);
    }
 function Is_already_register($email)
 {
  $this->db->where('email', $email);
  $query = $this->db->get('tbl_admin');
  if($query->num_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }

 function get_user_data($email)
 {
  $this->db->select('id_admin');
  $this->db->where('email', $email);
  return $this->db->get('tbl_admin')->row();
 }


 function get_user_id($id)
 {
  $this->db->select('id_pengguna');
  $this->db->where('id_admin', $id);
  return $this->db->get('tbl_pengguna')->row();
 }

 function add_user_amount($amount,$admin_id)
 {
  $this->db->set('saldo', 'saldo + ' .  $amount, FALSE)
         ->where('id_pengguna', $admin_id )
         ->update('trx_dana_saldo');
 }

 function Update_user_data($data, $email)
 {
  $this->db->where('email', $email);
  $this->db->update('tbl_admin', $data);
 }

 function Insert_user_data($data)
 {
  $this->db->insert('tbl_admin', $data);
 }
}
?>