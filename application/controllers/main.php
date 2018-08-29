<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
 public function index()
 {
    $this->load->view('front/main');
 }

 public function security()
 {
    $this->load->view('front/security/main');
 }

 public function seller()
 {
    $this->load->view('front/seller/main');
 }

 public function warranty()
 {
    $this->load->view('front/warranty/main');
 }
 public function question()
 {
    $this->load->view('front/question/main');
 }
public function contact()
{
  $this->load->view('front/contact/main');
}

public function messagesending()
{
  $this->form_validation->set_rules('name','Ad Soyad','trim|required|min_length[5]');
  $this->form_validation->set_rules('email','Email unvani','trim|required|valid_email');
  $this->form_validation->set_rules('topic','Movzu','trim|required|min_length[5]');
  $this->form_validation->set_rules('message','Mesajiniz','trim|required|min_length[5]');

$xetalar =array(
'required'  =>"{field} xanani doldurmalisiniz",
'min_length' =>"{field} minumum 5 xarakter olmalidir",
'valid_email' =>" xahis olunur kecerli mail yazin!"
);
$this->form_validation->set_message('xetalar');
if($this->form_validation->run() == FALSE){
redirect('contact',$this->session->set_flashdata(

  'xeta','<div class="alert alert-danger">
  <i class="fa fa-exclamation-circle"></i>
  '.$xetalar['xeta']=validation_errors().'</div>'
));
}else {
$data =array(
  'name'     =>$name =$this->input->post('name',true),
  'email'    =>$email =$this->input->post('email',true),
  'topic'    =>$topic =$this->input->post('topic',true),
  'message'  =>$message =$this->input->post('message',true),
  'date'     =>$date = date('d-m-Y'),
  'ip'       =>$ip =$this->input->post('ip'),
  'status'   => 0
);
$result = $this->dtbs->addModel('messages',$data);
if ($result) {
  $this->session->set_flashdata('xeta' , '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Mesajınız Göndərildi <br> Ən qısa zamanda e-poçtunuza məktub göndəriləcək
           </div>');
           redirect($_SERVER['HTTP_REFERER']);
}else {
  $this->session->set_flashdata('xeta' , '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-ban"></i> Server Xətası!</h4>
            Mesajınız göndərilməsi alınmadı.<br> yaxın vaxt ərizində bir daha göndərin
           </div>');
 redirect($_SERVER['HTTP_REFERER']);
}


}


}

}
?>
