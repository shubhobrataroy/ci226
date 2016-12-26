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
          $db_debug = $this->db->db_debug;
          $this->db->db_debug = false;
          $sql1 = "INSERT INTO " . $dname . " " . "VALUES ('" . $cid . "','" . $cname . "'," . $credit . ")";
          $this->load->database();
          $this->db->query($sql1);
          $this->db->db_debug=$db_debug;

  }

    public function addDepartment ($dname)
    {
        $sql1="INSERT INTO "."department". " VALUES ('".$dname."')";
        $this->load->database();
        $this->db->query($sql1);


        if($this->db->_error_message()==NULL | $this->db->_error_message()=="")
        {
            $this->db->query('create database '.$dname);

            $this->db->query("ALTER TABLE ".$dname. " ADD PRIMARY KEY (cid)");
        }

        return $this->db->_error_message();
    }

    public function getDepartments()
    {
        $sql= "select * from department";
        $result = $this->db->query($sql);
        return $result;
    }

    public function getCourseList($dname)
    {
        $html='<table class="table table-hover">
                <tr>
                    <td>Course ID</td>
                    <td>Course Name</td>
                    <td>Course Credit</td>
                </tr>';
        $sql= "select * from ".$dname;
        $result = $this->db->query($sql);
        foreach ($result->result() as $row)
        {
            $html = $html. "<tr><td>".$row->cid."</td><td>".$row->cname."</td><td>".$row->ccredit."</td></tr>";
        }
        $html=$html."</table>";
        return $html;
    }
}