<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/15/2016
 * Time: 6:06 PM
 */
class login_model extends CI_Model
{
  public function login ($username, $password)
  {
      $sql = "select * from users where username='" . $username . "' and password='".$password."'";

      $this->load->database();
      $result=$this->db->query($sql);
      $i=0;

      foreach ($result->result() as $row )
      {
          $i++;
          if($row->Privilege=='admin') return $row->Privilege;
      }


      if ($i>0) return true;

      return false;
  }

}