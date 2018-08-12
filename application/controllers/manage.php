<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller{
//filters
 function security(){
   $login =$this->session->userdata('login');
 if(!$login){
  redirect('manage');
}
 }

 function index()
  {
     $login =$this->session->userdata('login');
      if ($login) {
      redirect('manage/main');
      }
        $this->load->view('back/login');
  }
  //cheking login [httpost]
public function log_in()
{
  $email = $this->input->post('Email');
  $password = $this->input->post('Password');
  $kontrol = $this->dtbs->kontrol($email,$password);
//part filter session
if ($kontrol) {
     $this->session->set_userdata('login',true);
  redirect('manage/main');
}else{

  redirect('manage');
}
 }
//main page admin panel
 public function main()
 {
     $this->security();
     $this->load->view('back/main');
 }
 public function logout()
 {
     $this->session->sess_destroy();
     redirect('manage');

 }

}
?>
