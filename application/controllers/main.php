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

}
?>
