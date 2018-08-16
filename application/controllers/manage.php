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
   $result =$this->dtbs->listsModel('sitesettings');
   $data['info'] =$result;
    $this->load->view('back/settings/main',$data);
 }

 // datatable da edit isleri
 //Get
 public function rowEdit($id)
 {
   $result =$this->dtbs->checkModel($id,'sitesettings');
   $data['info'] =$result;
     $this->load->view('back/settings/edit/main',$data);
 }
//deyislik etmek button post
//Post
 public function edit()
 {
    $data =array(
   'Id' => $id = $this->input->post('Id'),
   'siteTitle' => $title = $this->input->post('siteTitle'),
   'siteUrl' => $url = $this->input->post('siteUrl'),
   'sitePhone' => $phone = $this->input->post('sitePhone'),
   'siteAdress' => $adress = $this->input->post('siteAdress'),
   'siteDesc' =>$desc = $this->input->post('siteDesc'),
    'siteKeyw' =>$keyw = $this->input->post('siteKeyw'),
     'siteInfo' =>$info = $this->input->post('siteInfo'),
     'siteMail' =>$info = $this->input->post('siteMail')
 );
 $result = $this->dtbs->editModel($data,$id,'Id','sitesettings');

 if ($result) {
   $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
              Deyisdirildi
            </div>');
            redirect('manage/generalsettings');
 }else {
   $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Deyisilik alinmadi
            </div>');
  redirect('manage');
 }
 }
// Setting End
// Cargo Start
public function cargoLists()
{
  $result =$this->dtbs->listsModel('cargo');
  $data['info'] = $result;
  $this->load->view('back/cargo/main',$data);
}
//Get
public function cargoAdd()
{
    $this->load->view('back/cargo/add/main');
}
//post
public function cargoAdding(){
                $config['upload_path']  = FCPATH.'assets/front/image/cargo';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['encrypt_name'] =TRUE;

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img'))
                           {
                                $img =$this->upload->data();
                                $imgPath =$img['file_name'];
                                $imgSave ='assets/front/image/cargo/'.$imgPath.'';
                                $imgtmb ='assets/front/image/cargo/tmb/'.$imgPath.'';
                                $imgmini ='assets/front/image/cargo/mini/'.$imgPath.'';

                                //////////////////////////////////////////////////////
                                $config['image_library'] = 'gd2';
                                $config['source_image'] = 'assets/front/image/cargo/'.$imgPath.'';
                                $config['new_image'] = 'assets/front/image/cargo/tmb/'.$imgPath.'';
                                $config['create_thumb'] = false;
                                $config['maintain_ratio'] = false;
                                $config['quality'] = '60%';
                                $config['width'] ='310';
                                  $config['height'] ='170';

                                  $this->load->library('image_lib',$config);
                                   $this->image_lib->initialize($config);
                                    $this->image_lib->resize();
                                      $this->image_lib->clear();

                                      ///////////////////
                                      $config1['image_library'] = 'gd2';
                                      $config1['source_image'] = 'assets/front/image/cargo/'.$imgPath.'';
                                      $config1['new_image'] = 'assets/front/image/cargo/mini/'.$imgPath.'';
                                      $config1['create_thumb'] =false;
                                      $config1['maintain_ratio'] =false;
                                      $config1['quality'] = '60%';
                                      $config1['width'] ='110';
                                      $config1['height'] ='75';

                                        $this->load->library('image_lib',$config1);
                                        $this->image_lib->initialize($config1);
                                          $this->image_lib->resize();
                                            $this->image_lib->clear();

                                            $data =array(
                                              'title' =>  $title = $this->input->post('title'),
                                              'sef'  => seflink($title),
                                              'status' => 1,
                                              'img' => $imgSave,
                                              'tmb' => $imgtmb,
                                              'mini' => $imgmini
                                            );
                                            $result =$this->dtbs->addModel('cargo',$data);
                                            if ($result) {
                                              $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                         <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                                                         Əlavə Etdiniz.
                                                       </div>');
                                                       redirect('manage/cargoLists');
                                            }else {
                                              $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                         <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                                                    Əlavə Olunmadı.
                                                       </div>');
                                             redirect('manage/cargoLists');
                                            }

                           }
                           else
                           {
                             $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                                   Əlavə etmek mumkun olmadi
                                      </div>');
                            redirect('manage/cargoLists');
                           }
}

}
?>
