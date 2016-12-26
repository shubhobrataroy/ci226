<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/26/2016
 * Time: 12:38 AM
 */
class admin_model extends CI_Model
{
  public function addCourse ($dname,$cid,$cname,$credit)
  {
      $sql1="INSERT INTO ".$dname." ('cid', 'cname', 'ccredit') ". "VALUES ('".$cid."','".$cname."',".$credit.")";
      $this->load->database();
      $this->db->query($sql1);

      return $this->db->_error_message();
  }

    public function addDepartment ($dname)
    {
        $sql1="INSERT INTO "."department". " VALUES ('".$dname."')";
        $this->load->database();
        $this->db->query($sql1);


        if($this->db->_error_message()==NULL | $this->db->_error_message()=="")
        {
            $this->db->query('create database '.$dname);
        }

        return $this->db->_error_message();
    }

    public function getDepartments()
    {
        $sql= "select * from department";
        $result = $this->db->query($sql);
        return $result;
    }
}