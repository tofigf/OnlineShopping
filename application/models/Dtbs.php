<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dtbs extends CI_Model{

function kontrol($email,$password){
     $result =$this->db->select('*')->from('admin')
     ->where('Email',$email)->where('Password',sha1(md5($password)))
     ->get()->row();
     return $result;
}

}
