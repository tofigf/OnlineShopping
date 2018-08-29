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
 public function deleteWork()
 {
    $session = $this->session->userdata('delete');
    if ($session) {
    $this->session->unset_userdata('delete');
    redirect($_SERVER['HTTP_REFERER']);
  }else{
    $this->session->set_userdata('delete',true);
      redirect($_SERVER['HTTP_REFERER']);
  }

 }
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
// Cargo List Start
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

public function cargoSet()
{
    $id = $this->input->post('Id');
    $status =($this->input->post('status') == "true") ? 1 :0;
    $this->db->where('Id',$id)->update('cargo',array('status'=>$status));

}
//Get Cargoedit
public function cargoEdit($id)
{
  $result =$this->dtbs->checkModel($id,'cargo');
  $data['info'] =$result;
    $this->load->view('back/cargo/edit/main',$data);
}
//Post CargoEdit
public function cargoEditing()
{
  if (strlen($_FILES['img']['name'])> 0) {
    $config['upload_path']  = FCPATH.'assets/front/image/cargo';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['encrypt_name'] =TRUE;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('img'))
               {
                    $img =$this->upload->data();
                    $imgPath =$img['file_name'];
                    $imgSave ='assets/front/image/cargo/'.$imgPath.'' ;
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
                                  'Id' =>  $id = $this->input->post('Id'),
                                 'status' =>  $status = $this->input->post('status'),
                                  'sef'  => seflink($title),
                                  'img' => $imgSave,
                                  'tmb' => $imgtmb,
                                  'mini' => $imgmini
                                );
                $yol = cargoImg($id);
                $yol2 =cargoTmb($id);
                $yol3 =cargoMini($id);
                unlink($yol);
                unlink($yol1);
                unlink($yol2);
                $result =$this->dtbs->editModel($data,$id,'Id','cargo');
                if ($result) {
                  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                            Dəyişilik Etdiniz.
                           </div>');
                           redirect('manage/cargoLists');

              }else {
                  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                        Dəyişilik Olunmadı.
                           </div>');
                 redirect('manage/cargoLists');
                }
              }
         else {
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Şəkili Dəyişdirmək alınmadı.
             </div>');
   redirect('manage/cargoLists');
 }
}
 else{
   $data =array(
     'Id' =>  $id = $this->input->post('Id'),
    'status' =>  $status = $this->input->post('status'),
    'title' =>  $title = $this->input->post('title'),
    'sef'  =>seflink($title)

   );
 $result =$this->dtbs->editModel($data,$id,'Id','cargo');

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


}

//silmek funksiyasi evvelce sekili silir
 public function cargoDelete($id,$where,$from)
{
  $run =$this->session->userdata('delete');
  if ($run) {
    $yol = cargoImg($id);
    $yol2 =cargoTmb($id);
    $yol3 =cargoMini($id);
    unlink($yol);
    unlink($yol1);
    unlink($yol2);
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/cargoLists');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/cargoLists');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/cargoLists');

  }
}
//Cargo List  End
//Cargo Desi Start
//view ya melumatlari gondermek
public function cargoDesi()
{
  $result =$this->dtbs->listsModel('cargodesi');
  $data['info']=$result;
  $this->load->view('back/cargodesi/main',$data);

}
//Get
 public function cargodesiAdd()
 {
     $this->load->view('back/cargodesi/add/main');
 }
 //Post
public function cargoDesiAdding()
{
    $data= array(
      'cargoId' =>$cargoId = $this->input->post('cargoId'),
      'tutar' =>$tutar = $this->input->post('tutar')
    );
    $result = $this->dtbs->addModel('cargodesi',$data);
    if ($result) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Elave Etdiniz
               </div>');
               redirect('manage/cargodesi');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
              Elave ede bilmediniz
               </div>');
     redirect('manage/cargodesi');
    }
}
//Get Edit
public function cargoDesiEdit($id)
{
  $result =$this->dtbs->checkModel($id, 'cargodesi');
  $data['info'] =$result;
  $this->load->view('back/cargodesi/edit/main',$data);
}

//Post Edit
public function cargoDesiEditing()
{
    $data =array(
    'Id'      =>$id =$this->input->post('Id'),
    'cargoId' =>$cargoId= $this->input->post('cargoId'),
    'tutar'   =>$tutar =$this->input->post('tutar')
    );
    $result =$this->dtbs->editModel($data,$id,'Id','cargodesi');
    if ($result) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                Deyisilik Etdiniz
               </div>');
               redirect('manage/cargodesi');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Deyisilik ede bilmediniz
               </div>');
     redirect('manage/cargodesi');
    }
}

//delete
public function cargoDesiDelete($id,$where,$from)
{
 $run =$this->session->userdata('delete');
 if ($run) {
   $delete =$this->dtbs->deleteModel($id,$where,$from);
   if ($delete) {
     $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                Sildiniz
              </div>');
              redirect('manage/cargodesi');
   }else {
     $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
           Sile Bilmediniiz
              </div>');
    redirect('manage/cargodesi');
   }
 }else{
   $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
         Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
            </div>');
  redirect('manage/cargodesi');

 }
}

//cargoDesi end
//Bank Start
// Bank view melumatlari gondermek
public function bankLists()
{
    $result =$this->dtbs->listsModel('bank');
    $data['info'] =$result;
 $this->load->view('back/bank/main',$data);
}
//Bank Get add
public function bankAdd()
{
    $this->load->view('back/bank/add/main');
}
//Bank Post add
public function bankAdding()
{
  $config['upload_path']  = FCPATH.'assets/front/image/bank';
  $config['allowed_types'] = 'gif|jpg|jpeg|png';
  $config['encrypt_name'] =TRUE;

  $this->load->library('upload', $config);
  if ($this->upload->do_upload('img'))
             {
                  $img =$this->upload->data();
                  $imgPath =$img['file_name'];
                  $imgSave ='assets/front/image/bank/'.$imgPath.'';
                  $imgtmb ='assets/front/image/bank/tmb/'.$imgPath.'';
                  $imgmini ='assets/front/image/bank/mini/'.$imgPath.'';

                  //////////////////////////////////////////////////////
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = 'assets/front/image/bank/'.$imgPath.'';
                  $config['new_image'] = 'assets/front/image/bank/tmb/'.$imgPath.'';
                  $config['create_thumb'] = false;
                  $config['maintain_ratio'] = false;
                  $config['quality'] = '60%';
                  $config['width'] ='310';
                    $config['height'] ='165';

                    $this->load->library('image_lib',$config);
                     $this->image_lib->initialize($config);
                      $this->image_lib->resize();
                        $this->image_lib->clear();

                        ///////////////////
                        $config1['image_library'] = 'gd2';
                        $config1['source_image'] = 'assets/front/image/bank/'.$imgPath.'';
                        $config1['new_image'] = 'assets/front/image/bank/mini/'.$imgPath.'';
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
                               'title' => $title= $this->input->post('title'),
                               'sef'   =>seflink($title),
                               'flial'  =>$flial = $this->input->post('flial'),
                               'iban'   =>$iban =$this->input->post('iban'),
                               'hesabno' =>$hesabno =$this->input->post('hesabno'),
                               'status'  =>1,
                               'img' =>$imgSave,
                               'tmb' =>$imgtmb,
                               'mini' =>$imgmini
                              );
                              $result =$this->dtbs->addModel('bank',$data);
                              if ($result) {
                                $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                           <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                                           Əlavə Etdiniz
                                         </div>');
                                         redirect('manage/banklists');
                              }else {
                                $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                           <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                                    Əlavə edə bilmədiniz
                                         </div>');
                               redirect('manage/banklists');
                              }

        }else{
          # sekil yuklenemez xeta /bildirimi
          $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                     <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Şəkil yükləmək alınmadı
                   </div>');
         redirect('manage/banklists');

        }
   }
   public function bankSet()
   {
      $id =$this->input->post('Id');
      $status =($this->input->post('status')== "true") ? 1 : 0;
      $this->db->where('Id',$id)->update('bank',array('status'=>$status));
   }
   //Get
public function bankEdit($id)
{
  $result=$this->dtbs->checkModel($id,'bank');
  $data['info'] = $result;
  $this->load->view('back/bank/edit/main',$data);

}
//Post
public function bankEditing()
{
  if (strlen($_FILES['img']['name'])> 0) {
    $config['upload_path']  = FCPATH.'assets/front/image/bank';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['encrypt_name'] =TRUE;
    $this->load->library('upload', $config);
    if ($this->upload->do_upload('img'))
               {
                    $img =$this->upload->data();
                    $imgPath =$img['file_name'];
                    $imgSave ='assets/front/image/bank/'.$imgPath.'';
                    $imgtmb ='assets/front/image/bank/tmb/'.$imgPath.'';
                    $imgmini ='assets/front/image/bank/mini/'.$imgPath.'';

                    //////////////////////////////////////////////////////
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = 'assets/front/image/bank/'.$imgPath.'';
                    $config['new_image'] = 'assets/front/image/bank/tmb/'.$imgPath.'';
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
                          $config1['source_image'] = 'assets/front/image/bank/'.$imgPath.'';
                          $config1['new_image'] = 'assets/front/image/bank/mini/'.$imgPath.'';
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
                                  'Id' =>  $id = $this->input->post('Id'),
                                 'status' =>  $status = $this->input->post('status'),
                                  'sef'  => seflink($title),
                                  'flial' =>$flial =$this->input->post('flial'),
                                  'iban' =>$iban =$this->input->post('iban'),
                                  'hesabno' =>$hesabno =$this->input->post('hebank'),
                                  'img' => $imgSave,
                                  'tmb' => $imgtmb,
                                  'mini' => $imgmini
                                );
                $yol = bankImg($id);
                $yol2 =bankTmb($id);
                $yol3 =bankMini($id);
                unlink($yol);
                unlink($yol1);
                unlink($yol2);
                $result =$this->dtbs->editModel($data,$id,'Id','bank');
                if ($result) {
                  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                            Dəyişilik Etdiniz.
                           </div>');
                           redirect('manage/bankLists');

              }else {
                  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                        Dəyişilik Olunmadı.
                           </div>');
                 redirect('manage/bankLists');
                }
              }
         else {
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Şəkili Dəyişdirmək alınmadı.
             </div>');
   redirect('manage/bankLists');
 }
}
 else{
   $data =array(
     'Id' =>  $id = $this->input->post('Id'),
    'status' =>  $status = $this->input->post('status'),
    'title' =>  $title = $this->input->post('title'),
    'sef'  =>seflink($title),
    'flial' =>$flial =$this->input->post('flial'),
    'iban' =>$iban =$this->input->post('iban'),
    'hesabno' =>$hesabno =$this->input->post('hesabno')
   );
 $result =$this->dtbs->editModel($data,$id,'Id','bank');

 if ($result) {
   $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
              Əlavə Etdiniz.
            </div>');
            redirect('manage/bankLists');
 }else {
   $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
         Əlavə Olunmadı.
            </div>');
  redirect('manage/bankLists');
  }
 }
}

public function bankDelete($id,$where,$from)
{
  $run =$this->session->userdata('delete');
  if ($run) {
    $yol = bankImg($id);
    $yol2 =bankTmb($id);
    $yol3 =bankMini($id);
    unlink($yol);
    unlink($yol1);
    unlink($yol2);
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/bankLists');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/bankLists');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/bankLists');

  }
}

//Bank end
//PrivACY sTART  view melumatlari gondermek
public function secretContract()
{
  $result = $this->dtbs->listsModel('privacy');
  $data['info'] = $result;
  $this->load->view('back/privacy/main',$data);
}

//Gizlilik Edit Get:
public function privacyEdit($id)
{
  $result=$this->dtbs->checkModel($id,'privacy');
  $data['info'] = $result;
  $this->load->view('back/privacy/edit/main',$data);
}
#Gizlilik Edit Post:
public function privacyEditing()
{
  $data =array(
    'Id' =>$id =$this->input->post('Id'),
    'title' =>$title=$this->input->post('title'),
    'sef' =>seflink($title),
    'description' =>$description =$this->input->post('description')
  );
$result =$this->dtbs->editModel($data,$id,'Id','privacy');
if ($result) {
  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Deyisdirildi
           </div>');
           redirect('manage/secretContract');
}else {
  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Deyisilik alinmadi
           </div>');
 redirect('manage/secretContract');
}
}
#Gizlilik End
#Sale Start
//send view info
public function salesContract()
{
    $result =$this->dtbs->listsModel('sales');
    $data['info'] =$result;
    $this->load->view('back/sale/main',$data);
}
//Sale Edit Get:
public function salesedit($id)
{
    $result =$this->dtbs->checkModel($id,'sales');
    $data['info'] = $result;
    $this->load->view('back/sale/edit/main',$data);

}
//Sale Post:
public function salesEditing()
{
  $data =array(
    'Id' =>$id =$this->input->post('Id'),
    'title' =>$title=$this->input->post('title'),
    'sef' =>seflink($title),
    'description' =>$description =$this->input->post('description')
  );
$result =$this->dtbs->editModel($data,$id,'Id','sales');
if ($result) {
  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Deyisdirildi
           </div>');
           redirect('manage/salesContract');
}else {
  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Deyisilik alinmadi
           </div>');
 redirect('manage/salesContract');
}

}
///Sales end
//question sTART
public function frequentlyAskedQuestions()
{
    $result =$this->dtbs->listsModel('question');
    $data['info'] =$result;
    $this->load->view('back/question/main', $data);
}

//Get:
public function questionAdd()
{
    $this->load->view('back/question/add/main');
}

//post
public function questionAdding()
{
    $data =array(
  'title' =>$title=$this->input->post('title'),
  'sef'   =>seflink($title),
'description' =>$description = $this->input->post('description'),
'status' => 1
    );
    $result =$this->dtbs->addModel('question',$data);
    if ($result) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
              Əlavə Etdiniz
               </div>');
               redirect('manage/frequentlyAskedQuestions');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
        Əlavə etmək alinmadi
               </div>');
     redirect('manage/frequentlyAskedQuestions');
    }
}
//Get:
public function questionEdit($id)
{
  $result =$this->dtbs->checkModel($id,'question');
  $data['info'] = $result;
  $this->load->view('back/question/edit/main',$data);
}

//Post
public function questionEditing()
{
  $data =array(
    'Id' =>$id =$this->input->post('Id'),
    'title' =>$title=$this->input->post('title'),
    'sef' =>seflink($title),
    'description' =>$description =$this->input->post('description')
  );
 $result =$this->dtbs->editModel($data,$id,'Id','question');
if ($result) {
  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Deyisdirildi
           </div>');
           redirect('manage/frequentlyAskedQuestions');
}else {
  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Deyisilik alinmadi
           </div>');
 redirect('manage/frequentlyAskedQuestions');
}
}
//delete
public function questionDelete($id,$where,$from)
{
    $run =$this->session->userdata('delete');
  if ($run) {
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/frequentlyAskedQuestions');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/frequentlyAskedQuestions');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/frequentlyAskedQuestions');

  }
}
//Status true false
public function questionSet()
{
     $id =$this->input->post('Id');
     $status =($this->input->post('status')== "true") ? 1 : 0;
     $this->db->where('Id',$id)->update('question',array('status'=>$status));
}

//question end
#Warranty Strart
public function warrantyReturn()
{
  $result =$this->dtbs->listsModel('warranty');
  $data['info'] = $result;
   $this->load->view('back/warranty/main',$data);
}

//Get:
public function warrantyAdd()
{
     $this->load->view('back/warranty/add/main');
}

//Post:
public function warrantyAdding()
{
  $data =array(
'title' =>$title=$this->input->post('title'),
'sef'   =>seflink($title),
'description' =>$description = $this->input->post('description')

  );
  $result =$this->dtbs->addModel('warranty',$data);
  if ($result) {
    $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
            Əlavə Etdiniz
             </div>');
             redirect('manage/warrantyReturn');
  }else {
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Əlavə etmək alinmadi
             </div>');
   redirect('manage/warrantyReturn');
  }
}
//eDIT pOST:
public function warrantyEdit($id)
{
  $result =$this->dtbs->checkModel($id,'warranty');
  $data['info'] = $result;
  $this->load->view('back/warranty/edit/main',$data);
}
//Post:
public function warrantyEditing()
{
  $data =array(
    'Id' =>$id =$this->input->post('Id'),
    'title' =>$title=$this->input->post('title'),
    'sef' =>seflink($title),
    'description' =>$description =$this->input->post('description')
  );
 $result =$this->dtbs->editModel($data,$id,'Id','warranty');
if ($result) {
  $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Deyisdirildi
           </div>');
           redirect('manage/warrantyReturn');
}else {
  $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Deyisilik alinmadi
           </div>');
 redirect('manage/warrantyReturn');
}
}
//Warranty End:
//SosialMedia sTART
public function sMedia()
{
   $result =$this->dtbs->listsModel('smedia');
   $data['info'] =$result;
   $this->load->view('back/smedia/main',$data);
}

//Get:
public function smediaAdd()
{
    $this->load->view('back/smedia/add/main');
}

//Post:
public function smediaAdding()
{
    $data =array(
      'title' =>$title = $this->input->post('title'),
      'url' =>$url = $this->input->post('url'),
      'sef' =>seflink($title),
      'status' => 1
    );
    $result =$this->dtbs->addModel('smedia',$data);
    if ($result) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
            Əlavə edildi
               </div>');
               redirect('manage/smedia');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Əlavə etmək  alinmadi
               </div>');
     redirect('manage/smedia');
    }
}
//Edit Get:
public function smediaEdit($id)
{
  $result =$this->dtbs->checkModel($id,'smedia');
  $data['info'] = $result;
  $this->load->view('back/smedia/edit/main',$data);
}
#Edit Post:
public function smediaEditing()
{
  $data =array(
     'Id' =>$id =$this->input->post('Id'),
     'status' =>$status = $this->input->post('status'),
     'title' =>$title = $this->input->post('title'),
     'url' =>$url = $this->input->post('url'),
     'sef' =>seflink($title)
  );
  $result =$this->dtbs->editModel($data,$id,'id','smedia');
  if ($result) {
    $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
          Düzəliş edildi
             </div>');
             redirect('manage/smedia');
  }else {
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
      Düzəliş etmək  alinmadi
             </div>');
   redirect('manage/smedia');
  }
}
//Delete:
public function smediaDelete($id,$where,$from)
{
    $run =$this->session->userdata('delete');
  if ($run) {
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/smedia');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/smedia');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/smedia');

  }
}
public function smediaSet()
{
  $id =$this->input->post('Id');
  $status =($this->input->post('status')== "true") ? 1 : 0;
  $this->db->where('Id',$id)->update('smedia',array('status'=>$status));
}

//Smedia end:
//Products Start:
public function products()
{
    $result =$this->dtbs->listsModel('products');
    $data['info'] =$result;
    $this->load->view('back/products/main',$data);
}
public function productAdd()
{
    $this->load->view('back/products/add/main');
}

public function productAdding()
{
  $config['upload_path']  = FCPATH.'assets/front/image/products';
  $config['allowed_types'] = 'gif|jpg|jpeg|png';
  $config['encrypt_name'] =TRUE;
  $this->load->library('upload', $config);
  $this->upload->do_upload('img');
        $img =$this->upload->data();
        $imgPath =$img['file_name'];
        $imgSave ='assets/front/image/products/'.$imgPath.'';
        $imgtmb ='assets/front/image/products/tmb1/'.$imgPath.'';
        $imgmini ='assets/front/image/products/mini1/'.$imgPath.'';
        $config['image_library'] = 'gd2';
        $config['source_image'] = 'assets/front/image/products/'.$imgPath.'';
        $config['new_image'] = 'assets/front/image/products/tmb1/'.$imgPath.'';
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = false;
        $config['quality'] ='60%';
        $config['width'] ='420';
        $config['height'] ='213';
        $this->load->library('image_lib',$config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
                      ////////////////////////////
        $config1['upload_path']  = FCPATH.'assets/front/image/products';
        $config1['allowed_types'] = 'gif|jpg|jpeg|png';
        $config1['encrypt_name'] =TRUE;
              $config1['image_library'] = 'gd2';
              $config1['source_image'] = 'assets/front/image/products/'.$imgPath.'';
              $config1['new_image'] = 'assets/front/image/products/mini1/'.$imgPath.'';
              $config1['create_thumb'] = false;
              $config1['maintain_ratio'] = false;
              $config1['quality'] ='60%';
              $config1['width'] ='76';
              $config1['height'] ='55';

              $this->load->library('image_lib',$config1);
              $this->image_lib->initialize($config1);
              $this->image_lib->resize();
              $this->image_lib->clear();
              //Img end
///////////////////////////
////////////////////////////
$config2['upload_path']  = FCPATH.'assets/front/image/products';
$config2['allowed_types'] = 'gif|jpg|jpeg|png';
$config2['encrypt_name'] =TRUE;
$this->load->library('upload', $config2);
$this->upload->do_upload('img2');
      $img2 =$this->upload->data();
      $imgPath2=$img2['file_name'];
      $imgSave2 ='assets/front/image/products/'.$imgPath2.'';
      $imgtmb2 ='assets/front/image/products/tmb2/'.$imgPath2.'';
      $imgmini2 ='assets/front/image/products/mini2/'.$imgPath2.'';
      $config2['image_library'] = 'gd2';
      $config2['source_image'] = 'assets/front/image/products/'.$imgPath2.'';
      $config2['new_image'] = 'assets/front/image/products/tmb2/'.$imgPath2.'';
      $config2['create_thumb'] = false;
      $config2['maintain_ratio'] = false;
      $config2['quality'] ='60%';
      $config2['width'] ='420';
      $config2['height'] ='213';
      $this->load->library('image_lib',$config2);
      $this->image_lib->initialize($config2);
      $this->image_lib->resize();
      $this->image_lib->clear();
                       ///////////////////
        $config3['upload_path']  = FCPATH.'assets/front/image/products';
        $config3['allowed_types'] = 'gif|jpg|jpeg|png';
        $config3['encrypt_name'] =TRUE;
              $config3['image_library'] = 'gd2';
              $config3['source_image'] = 'assets/front/image/products/'.$imgPath2.'';
              $config3['new_image'] = 'assets/front/image/products/mini2/'.$imgPath2.'';
              $config3['create_thumb'] = false;
              $config3['maintain_ratio'] = false;
              $config3['quality'] ='60%';
              $config3['width'] ='76';
              $config3['height'] ='55';
              $this->load->library('image_lib',$config3);
              $this->image_lib->initialize($config3);
              $this->image_lib->resize();
              $this->image_lib->clear();
///img2 End:
////////////////
///////////////
$config4['upload_path']  = FCPATH.'assets/front/image/products';
$config4['allowed_types'] = 'gif|jpg|jpeg|png';
$config4['encrypt_name'] =TRUE;
$this->load->library('upload', $config4);
$this->upload->do_upload('img3');
      $img3 =$this->upload->data();
      $imgPath3=$img3['file_name'];
      $imgSave3 ='assets/front/image/products/'.$imgPath3.'';
      $imgtmb3 ='assets/front/image/products/tmb3/'.$imgPath3.'';
      $imgmini3 ='assets/front/image/products/mini3/'.$imgPath3.'';
      $config4['image_library'] = 'gd2';
      $config4['source_image'] = 'assets/front/image/products/'.$imgPath3.'';
      $config4['new_image'] = 'assets/front/image/products/tmb3/'.$imgPath3.'';
      $config4['create_thumb'] = false;
      $config4['maintain_ratio'] = false;
      $config4['quality'] ='60%';
      $config4['width'] ='420';
      $config4['height'] ='213';
      $this->load->library('image_lib',$config4);
      $this->image_lib->initialize($config4);
      $this->image_lib->resize();
      $this->image_lib->clear();
                //////////////
                $config5['upload_path']  = FCPATH.'assets/front/image/products';
                $config5['allowed_types'] = 'gif|jpg|jpeg|png';
                $config5['encrypt_name'] =TRUE;
                      $config5['image_library'] = 'gd2';
                      $config5['source_image'] = 'assets/front/image/products/'.$imgPath3.'';
                      $config5['new_image'] = 'assets/front/image/products/mini3/'.$imgPath3.'';
                      $config5['create_thumb'] = false;
                      $config5['maintain_ratio'] = false;
                      $config5['quality'] ='60%';
                      $config5['width'] ='76';
                      $config5['height'] ='55';
                      $this->load->library('image_lib',$config5);
                      $this->image_lib->initialize($config5);
                      $this->image_lib->resize();
                      $this->image_lib->clear();
///////////// img 3 End:
////////////////////////
///////////////////////
$config6['upload_path']  = FCPATH.'assets/front/image/products';
$config6['allowed_types'] = 'gif|jpg|jpeg|png';
$config6['encrypt_name'] =TRUE;
$this->load->library('upload', $config6);
$this->upload->do_upload('img4');
      $img4 =$this->upload->data();
      $imgPath4 = $img4['file_name'];
      $imgSave4 ='assets/front/image/products/'.$imgPath4.'';
      $imgtmb4 ='assets/front/image/products/tmb4/'.$imgPath4.'';
      $imgmini4 ='assets/front/image/products/mini4/'.$imgPath4.'';
      $config6['image_library'] = 'gd2';
      $config6['source_image'] = 'assets/front/image/products/'.$imgPath4.'';
      $config6['new_image'] = 'assets/front/image/products/tmb4/'.$imgPath4.'';
      $config6['create_thumb'] = false;
      $config6['maintain_ratio'] = false;
      $config6['quality'] ='60%';
      $config6['width'] ='420';
      $config6['height'] ='213';
      $this->load->library('image_lib',$config6);
      $this->image_lib->initialize($config6);
      $this->image_lib->resize();
      $this->image_lib->clear();
//////////////////
$config7['upload_path']  = FCPATH.'assets/front/image/products';
$config7['allowed_types'] = 'gif|jpg|jpeg|png';
$config7['encrypt_name'] =TRUE;
      $config7['image_library'] = 'gd2';
      $config7['source_image'] = 'assets/front/image/products/'.$imgPath4.'';
      $config7['new_image'] = 'assets/front/image/products/mini4/'.$imgPath4.'';
      $config7['create_thumb'] = false;
      $config7['maintain_ratio'] = false;
      $config7['quality'] ='60%';
      $config7['width'] ='76';
      $config7['height'] ='55';
      $this->load->library('image_lib',$config7);
      $this->image_lib->initialize($config7);
      $this->image_lib->resize();
      $this->image_lib->clear();
      ///Img 4 End:
      ////////////////
      ///////////////////

      $data =array(
        'title' =>$title = $this->input->post('title'),
        'sef'   =>seflink($title),
        'catId' =>$catId =$this->input->post('catId'),
        'price' =>$price =$this->input->post('price'),
        'date' =>$date =$this->input->post('date'),
        'status' =>$status =$this->input->post('status'),
        'description' =>$description =$this->input->post('description'),
        'status' =>1,
        'info' =>$info = $this->input->post('info'),
        'img'  => $imgSave,
        'tmb'  =>$imgtmb,
        'mini'  =>$imgmini,
        'img2'  => $imgSave2,
        'tmb2'  =>$imgtmb2,
        'mini2'  =>$imgmini2,
        'img3'  => $imgSave3,
        'tmb3'  =>$imgtmb3,
        'mini3'  =>$imgmini3,
        'img4'  => $imgSave4,
        'tmb4'  =>$imgtmb4,
        'mini4'  =>$imgmini4,
      );
      $result =$this->dtbs->addModel('products',$data);
      if ($result) {
        $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                   Əlavə Etdiniz.
                 </div>');
                 redirect('manage/products');
      }else {
        $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
              Əlavə Olunmadı.
                 </div>');
       redirect('manage/products');
      }

}

 public function productEdit($id)
 {
     $result = $this->dtbs->checkModel($id,'products');
     $data['info'] =$result;
     $this->load->view('back/products/edit/main',$data);

 }
public function productEditing()
{
    if (strlen($_FILES['img']['name']) > 0) {
      $config['upload_path']  = FCPATH.'assets/front/image/products';
      $config['allowed_types'] = 'gif|jpg|jpeg|png';
      $config['encrypt_name'] =TRUE;
      $this->load->library('upload', $config);
      $this->upload->do_upload('img');
            $img =$this->upload->data();
            $imgPath =$img['file_name'];
            $imgSave ='assets/front/image/products/'.$imgPath.'';
            $imgtmb ='assets/front/image/products/tmb1/'.$imgPath.'';
            $imgmini ='assets/front/image/products/mini1/'.$imgPath.'';
            $config['image_library'] = 'gd2';
            $config['source_image'] = 'assets/front/image/products/'.$imgPath.'';
            $config['new_image'] = 'assets/front/image/products/tmb1/'.$imgPath.'';
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = false;
            $config['quality'] ='60%';
            $config['width'] ='420';
            $config['height'] ='213';
            $this->load->library('image_lib',$config);
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
                          ////////////////////////////
            $config1['upload_path']  = FCPATH.'assets/front/image/products';
            $config1['allowed_types'] = 'gif|jpg|jpeg|png';
            $config1['encrypt_name'] =TRUE;
                  $config1['image_library'] = 'gd2';
                  $config1['source_image'] = 'assets/front/image/products/'.$imgPath.'';
                  $config1['new_image'] = 'assets/front/image/products/mini1/'.$imgPath.'';
                  $config1['create_thumb'] = false;
                  $config1['maintain_ratio'] = false;
                  $config1['quality'] ='60%';
                  $config1['width'] ='76';
                  $config1['height'] ='55';

                  $this->load->library('image_lib',$config1);
                  $this->image_lib->initialize($config1);
                  $this->image_lib->resize();
                  $this->image_lib->clear();
                  $data =array(
                    'Id' => $id = $this->input->post('Id'),
                    'status' => $status = $this->input->post('status'),
                    'title' =>$title = $this->input->post('title'),
                    'sef'   =>seflink($title),
                    'catId' =>$catId =$this->input->post('catId'),
                    'price' =>$price =$this->input->post('price'),
                    'date' =>$date =$this->input->post('date'),
                    'status' =>$status =$this->input->post('status'),
                    'description' =>$description =$this->input->post('description'),
                    'status' =>1,
                    'info' =>$info = $this->input->post('info'),
                    'img'  => $imgSave,
                    'tmb'  =>$imgtmb,
                    'mini'  =>$imgmini
                  );
                  $way =productImg($id);
                  $way2 =productTmb($id);
                  $way3 =productMini($id);
                  unlink($way);
                  unlink($way2);
                  unlink($way3);
                  $result =$this->dtbs->editModel($data,$id,'Id','products');
                  if ($result) {
                    $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                              Dəyişilik Etdiniz.
                             </div>');
                             redirect('manage/products');
                  }else {
                    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                          Dəyişilik Olunmadı.
                             </div>');
                   redirect('manage/products');
                  }
    }else if(strlen($_FILES['img2']['name']) >0) {
      $config2['upload_path']  = FCPATH.'assets/front/image/products';
      $config2['allowed_types'] = 'gif|jpg|jpeg|png';
      $config2['encrypt_name'] =TRUE;
      $this->load->library('upload', $config2);
      $this->upload->do_upload('img2');
            $img2 =$this->upload->data();
            $imgPath2=$img2['file_name'];
            $imgSave2 ='assets/front/image/products/'.$imgPath2.'';
            $imgtmb2 ='assets/front/image/products/tmb2/'.$imgPath2.'';
            $imgmini2 ='assets/front/image/products/mini2/'.$imgPath2.'';
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = 'assets/front/image/products/'.$imgPath2.'';
            $config2['new_image'] = 'assets/front/image/products/tmb2/'.$imgPath2.'';
            $config2['create_thumb'] = false;
            $config2['maintain_ratio'] = false;
            $config2['quality'] ='60%';
            $config2['width'] ='420';
            $config2['height'] ='213';
            $this->load->library('image_lib',$config2);
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            $this->image_lib->clear();
                             ///////////////////
              $config3['upload_path']  = FCPATH.'assets/front/image/products';
              $config3['allowed_types'] = 'gif|jpg|jpeg|png';
              $config3['encrypt_name'] =TRUE;
                    $config3['image_library'] = 'gd2';
                    $config3['source_image'] = 'assets/front/image/products/'.$imgPath2.'';
                    $config3['new_image'] = 'assets/front/image/products/mini2/'.$imgPath2.'';
                    $config3['create_thumb'] = false;
                    $config3['maintain_ratio'] = false;
                    $config3['quality'] ='60%';
                    $config3['width'] ='76';
                    $config3['height'] ='55';
                    $this->load->library('image_lib',$config3);
                    $this->image_lib->initialize($config3);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    $data =array(
                      'Id' => $id = $this->input->post('Id'),
                      'status' => $status = $this->input->post('status'),
                      'title' =>$title = $this->input->post('title'),
                      'sef'   =>seflink($title),
                      'catId' =>$catId =$this->input->post('catId'),
                      'price' =>$price =$this->input->post('price'),
                      'date' =>$date =$this->input->post('date'),
                      'status' =>$status =$this->input->post('status'),
                      'description' =>$description =$this->input->post('description'),
                      'status' =>1,
                      'info' =>$info = $this->input->post('info'),
                      'img2'  => $imgSave2,
                      'tmb2'  =>$imgtmb2,
                      'mini2'  =>$imgmini2
                    );
                    $way4 =productImg2($id);
                    $way5 =productTmb2($id);
                    $way6 =productMini2($id);
                    unlink($way4);
                    unlink($way5);
                    unlink($way6);
                    $result =$this->dtbs->editModel($data,$id,'Id','products');
                    if ($result) {
                      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                                Dəyişilik Etdiniz.
                               </div>');
                               redirect('manage/products');
                    }else {
                      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                            Dəyişilik Olunmadı.
                               </div>');
                     redirect('manage/products');
                    }
    }else if(strlen($_FILES['img3']['name']) >0){
      $config4['upload_path']  = FCPATH.'assets/front/image/products';
      $config4['allowed_types'] = 'gif|jpg|jpeg|png';
      $config4['encrypt_name'] =TRUE;
      $this->load->library('upload', $config4);
      $this->upload->do_upload('img3');
            $img3 =$this->upload->data();
            $imgPath3=$img3['file_name'];
            $imgSave3 ='assets/front/image/products/'.$imgPath3.'';
            $imgtmb3 ='assets/front/image/products/tmb3/'.$imgPath3.'';
            $imgmini3 ='assets/front/image/products/mini3/'.$imgPath3.'';
            $config4['image_library'] = 'gd2';
            $config4['source_image'] = 'assets/front/image/products/'.$imgPath3.'';
            $config4['new_image'] = 'assets/front/image/products/tmb3/'.$imgPath3.'';
            $config4['create_thumb'] = false;
            $config4['maintain_ratio'] = false;
            $config4['quality'] ='60%';
            $config4['width'] ='420';
            $config4['height'] ='213';
            $this->load->library('image_lib',$config4);
            $this->image_lib->initialize($config4);
            $this->image_lib->resize();
            $this->image_lib->clear();
                      //////////////
                      $config5['upload_path']  = FCPATH.'assets/front/image/products';
                      $config5['allowed_types'] = 'gif|jpg|jpeg|png';
                      $config5['encrypt_name'] =TRUE;
                            $config5['image_library'] = 'gd2';
                            $config5['source_image'] = 'assets/front/image/products/'.$imgPath3.'';
                            $config5['new_image'] = 'assets/front/image/products/mini3/'.$imgPath3.'';
                            $config5['create_thumb'] = false;
                            $config5['maintain_ratio'] = false;
                            $config5['quality'] ='60%';
                            $config5['width'] ='76';
                            $config5['height'] ='55';
                            $this->load->library('image_lib',$config5);
                            $this->image_lib->initialize($config5);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            $data =array(
                              'Id' => $id = $this->input->post('Id'),
                              'status' => $status = $this->input->post('status'),
                              'title' =>$title = $this->input->post('title'),
                              'sef'   =>seflink($title),
                              'catId' =>$catId =$this->input->post('catId'),
                              'price' =>$price =$this->input->post('price'),
                              'date' =>$date =$this->input->post('date'),
                              'status' =>$status =$this->input->post('status'),
                              'description' =>$description =$this->input->post('description'),
                              'status' =>1,
                              'info' =>$info = $this->input->post('info'),
                              'img3'  => $imgSave3,
                              'tmb3'  =>$imgtmb3,
                              'mini3'  =>$imgmini3
                            );
                            $way7 =productImg3($id);
                            $way8 =productTmb3($id);
                            $way9 =productMini3($id);
                            unlink($way7);
                            unlink($way8);
                            unlink($way9);
                            $result =$this->dtbs->editModel($data,$id,'Id','products');
                            if ($result) {
                              $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                                        Dəyişilik Etdiniz.
                                       </div>');
                                       redirect('manage/products');
                            }else {
                              $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                         <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                                    Dəyişilik Olunmadı.
                                       </div>');
                             redirect('manage/products');
                            }
    }else if(strlen($_FILES['img4']['name']) >0){
      $config6['upload_path']  = FCPATH.'assets/front/image/products';
      $config6['allowed_types'] = 'gif|jpg|jpeg|png';
      $config6['encrypt_name'] =TRUE;
      $this->load->library('upload', $config6);
      $this->upload->do_upload('img4');
            $img4 =$this->upload->data();
            $imgPath4 = $img4['file_name'];
            $imgSave4 ='assets/front/image/products/'.$imgPath4.'';
            $imgtmb4 ='assets/front/image/products/tmb4/'.$imgPath4.'';
            $imgmini4 ='assets/front/image/products/mini4/'.$imgPath4.'';
            $config6['image_library'] = 'gd2';
            $config6['source_image'] = 'assets/front/image/products/'.$imgPath4.'';
            $config6['new_image'] = 'assets/front/image/products/tmb4/'.$imgPath4.'';
            $config6['create_thumb'] = false;
            $config6['maintain_ratio'] = false;
            $config6['quality'] ='60%';
            $config6['width'] ='420';
            $config6['height'] ='213';
            $this->load->library('image_lib',$config6);
            $this->image_lib->initialize($config6);
            $this->image_lib->resize();
            $this->image_lib->clear();
      //////////////////
      $config7['upload_path']  = FCPATH.'assets/front/image/products';
      $config7['allowed_types'] = 'gif|jpg|jpeg|png';
      $config7['encrypt_name'] =TRUE;
            $config7['image_library'] = 'gd2';
            $config7['source_image'] = 'assets/front/image/products/'.$imgPath4.'';
            $config7['new_image'] = 'assets/front/image/products/mini4/'.$imgPath4.'';
            $config7['create_thumb'] = false;
            $config7['maintain_ratio'] = false;
            $config7['quality'] ='60%';
            $config7['width'] ='76';
            $config7['height'] ='55';
            $this->load->library('image_lib',$config7);
            $this->image_lib->initialize($config7);
            $this->image_lib->resize();
            $this->image_lib->clear();
            $data =array(
              'Id' => $id = $this->input->post('Id'),
              'status' => $status = $this->input->post('status'),
              'title' =>$title = $this->input->post('title'),
              'sef'   =>seflink($title),
              'catId' =>$catId =$this->input->post('catId'),
              'price' =>$price =$this->input->post('price'),
              'date' =>$date =$this->input->post('date'),
              'status' =>$status =$this->input->post('status'),
              'description' =>$description =$this->input->post('description'),
              'status' =>1,
              'info' =>$info = $this->input->post('info'),
              'img4'  => $imgSave4,
              'tmb4'  =>$imgtmb4,
              'mini4'  =>$imgmini4
            );
            $way10 =productImg4($id);
            $way11 =productTmb4($id);
            $way12 =productMini4($id);
            unlink($way10);
            unlink($way11);
            unlink($way12);
            $result =$this->dtbs->editModel($data,$id,'Id','products');
            if ($result) {
              $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                        Dəyişilik Etdiniz.
                       </div>');
                       redirect('manage/products');
            }else {
              $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                         <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
                    Dəyişilik Olunmadı.
                       </div>');
             redirect('manage/products');
}
    }else {
      $data =array(
        'Id' => $id = $this->input->post('Id'),
        'status' => $status = $this->input->post('status'),
        'title' =>$title = $this->input->post('title'),
        'sef'   =>seflink($title),
        'catId' =>$catId =$this->input->post('catId'),
        'price' =>$price =$this->input->post('price'),
        'date' =>$date =$this->input->post('date'),
        'status' =>$status =$this->input->post('status'),
        'description' =>$description =$this->input->post('description'),
        'status' =>1,
        'info' =>$info = $this->input->post('info')
      );
      $result =$this->dtbs->editModel($data,$id,'Id','products');
      if ($result) {
        $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                  Dəyişilik Etdiniz.
                 </div>');
                 redirect('manage/products');
      }else {
        $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
              Dəyişilik Olunmadı.
                 </div>');
       redirect('manage/products');
}
    }
}
//Sett:
public function productSet()
{
  $id =$this->input->post('Id');
  $status =($this->input->post('status')== "true") ? 1 : 0;
  $this->db->where('Id',$id)->update('products',array('status'=>$status));
}
#delete:
public function productDelete($id,$where,$from)
{
    $run =$this->session->userdata('delete');
  if ($run) {
    $way =productImg($id);
    $way2 =productTmb($id);
    $way3 =productMini($id);
    $way4 =productImg2($id);
    $way5 =productTmb2($id);
    $way6 =productMini2($id);
    $way7 =productImg3($id);
    $way8 =productTmb3($id);
    $way9 =productMini3($id);
    $way10 =productImg4($id);
    $way11 =productTmb4($id);
    $way12 =productMini4($id);
    unlink($way);
    unlink($way2);
    unlink($way3);
    unlink($way4);
    unlink($way5);
    unlink($way6);
    unlink($way7);
    unlink($way8);
    unlink($way9);
    unlink($way10);
    unlink($way11);
    unlink($way12);
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/products');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/products');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/products');

  }
}

//Mesajlar
public function messages()
{
    $result =$this->dtbs->listsModel('messages');
    $data['info'] =$result;
    $this->load->view('back/messages/main',$data);
}
public function messageEdit($id)
{
    $result = $this->dtbs->checkModel($id,'messages');
    if ($result) {
      $data['info'] =$result;
      $this->load->view('back/messages/edit/main',$data);
      $data = array('status'=>1);
      $this->dtbs->messajUpdate($result['Id'],$data);
    }

}
public function messageDel($id,$where,$from)
{
  $run =$this->session->userdata('delete');
  if ($run) {
    $delete =$this->dtbs->deleteModel($id,$where,$from);
    if ($delete) {
      $this->session->set_flashdata('condition' , '<div class="alert alert-success alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                 Sildiniz
               </div>');
               redirect('manage/messages');
    }else {
      $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
            Sile Bilmediniiz
               </div>');
     redirect('manage/messages');
    }
  }else{
    $this->session->set_flashdata('condition' , '<div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <h4><i class="icon fa fa-ban"></i> Xəta!</h4>
          Silmək işlərini etmək üçün <br>Silmə funksiyasi açmalısınız...!!!
             </div>');
   redirect('manage/messages');

  }

}
}
?>
