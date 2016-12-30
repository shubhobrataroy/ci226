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
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = false;
        $sql2="CREATE TABLE ".$dname. "( `cid` VARCHAR(20) NOT NULL , `cname` VARCHAR(40) NOT NULL , `ccredit` INT(40) NOT NULL ) ENGINE = InnoDB;
";
        $sql1="INSERT INTO "."department". " VALUES ('".$dname."')";
        $this->load->database();
        $this->db->query($sql1);


        if($this->db->_error_message()==NULL | $this->db->_error_message()=="")
        {
            $this->db->query($sql2);

            $this->db->query("ALTER TABLE ".$dname. " ADD PRIMARY KEY (cid)");
        }
        $this->db->db_debug=$db_debug;
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

    public function getAllCourses()
    {
        $dept=$this->getDepartments();
        $sql="";
        $i=0;
        foreach ($dept->result() as $row)
        {
            if($i>0){$sql=$sql."union select cname,cid from ".$row->dname." ";}
            else {$sql=$sql."select cname,cid from ".$row->dname." ";}

            $i++;
        }


        $result = $this->db->query($sql);
        return $result;
    }

    public function getCourseByID($cid)
    {
        $dept=$this->getDepartments();
        $sql="";
        $i=0;
        foreach ($dept->result() as $row)
        {
            if($i>0){$sql=$sql."union select cname from ".$row->dname." ";}
            else {$sql=$sql."select cname from ".$row->dname." ";}
            $sql = $sql." where cid='".$cid."' ";
            $i++;
        }


        $result = $this->db->query($sql);
        foreach ($result->result() as $row)
        {
            return $row->cname;
        }
    }

    public function getSchedule()
    {
        $html='<H3>Added Courses</H3>
                <table class="table table-hover">
                <tr>
                    <td>Course ID</td>
                    <td>Course Name</td>
                    <td>Semester</td>
                    <td>Course Section</td>
                    <td>Day</td>
                    <td>Start Time</td>
                     <td>End Time</td>
                </tr>';

        $schedule= $this->db->query("select * from schedule");



        foreach ($schedule->result() as $row)
        {
            $html=$html."
                <tr>
                    <td>".$row->cid."</td>
                    <td>".$this->getCourseByID($row->cid)."</td>
                    <td>".$row->semester."</td>
                    <td>".$row->section."</td>
                    <td>".$row->day."</td>
                    <td>".$row->start_time."</td>
                    <td>".$row->end_time."</td>
                </tr>
            ";
        }
        $html=$html."</table><h3>Add Schedule</h3>";

        $html=$html.'<form method="post"><table class="table table-hover">
                <tr>
                    <td>Course Name</td>
                    <td>Course Section</td>
                    <td>Semester</td>
                    <td>Day</td>
                    <td>Start Time</td>
                     <td>End Time</td>
                </tr>
                <tr>
                <td><select name=\'cid\'>
                ';
        $courses=$this->getAllCourses();
        foreach ($courses->result() as $row)
        {
            $html=$html."<option value='".$row->cid."'>".$row->cname."</option>";
        }


        $html= $html."
                </select></td>
                <td><input type='text' name='section'></td>
                <td><select name='semester'>
                    <option value'Fall'>Fall</option>
                    <option value'Summer'>Summer</option>
                    <option value'Spring'>Spring</option>
                </select></td>
                <td><select name='day'>
                    <option value'Sunday,Tuesday'>Sunday,Tuesday</option>
                    <option value'Monday,Wednesday'>Monday,Wednesday</option>
                    <option value'Saturday,Thursday'>Saturday,Thursday</option>
                    <option value'Thursday'>Thursday</option>
                </select></td>
                <td><input type='time' name='starttime'></td>
                <td><input type='time' name='endtime'></td>
               </tr>
               
               
             </table>
             <input type='submit' value='Add' />
             
             </form>";
        return $html;

    }


    public function addSchedule ($cid,$section,$start_time,$end_time,$semester,$day)
    {
        $sql="INSERT INTO schedule VALUES ('".$cid."','".$section."','".$start_time."','".$end_time."','".$semester."','".$day."')";
        $this->db->query($sql);
    }
}