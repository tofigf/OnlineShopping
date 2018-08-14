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
     $this->session->set_userdata('info',$kontrol);
     $data = array('LastLog'=>date('d-m-Y H:i:s'));
     $this->dtbs->timeupdate($kontrol->Id,$data);
  redirect('manage/main');
}else{
     $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                E-poçt və ya şifrə səhvdir.
              </div>');
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

 //Login end
 //Settings Start
 public function generalSettings()
 {
   $result =$this->dtbs->lists('sitesettings');
   $data['info'] =$result;
    $this->load->view('back/settings/main',$data);
 }
}
?>
