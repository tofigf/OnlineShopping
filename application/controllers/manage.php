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
}
?>
