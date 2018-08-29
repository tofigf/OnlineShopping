<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dtbs extends CI_Model{
 //login ucundur
function kontrol($email,$password){
     $result =$this->db->select('*')->from('admin')
     ->where('Email',$email)->where('Password',sha1(md5($password)))
     ->get()->row();
     return $result;
}
//giris vaxtini bilmek ucundur.
function timeupdate($Id,$data=array()){
  $result =$this->db->where('Id',$Id)->update('admin',$data);
  return $result;
}

 function listsModel($from)
{
    $result =$this->db->select('*')->from($from)
    ->order_by('Id','desc')->get()->result_array();
    return $result;
}
//editde lazim olur xanalari doldurmaq
 function checkModel($id,$from)
{
    $result =$this->db->select('*')->from($from)
    ->where('Id',$id)->get()->row_array();
    return $result;
}

 function editModel($data =array(),$id,$where,$from)
{
  $result = $this->db->where($where,$id)->update($from,$data);
  return $result;
}

 function addModel($from,$data =array())
{
  $result =$this->db->insert($from,$data);
  return $result;
}
 function deleteModel($id,$where,$from)
{
    $result = $this->db->delete($from,array($where=>$id));
    return $result;
}
function messajUpdate($id,$data=array()){
  $result = $this->db->where('Id',$id)->update('messages',$data);
  return $result;
}
}
