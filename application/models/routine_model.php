<?php


class routine_model extends CI_Model
{
    public function getSchedule()
    {
        $html='<H3>Suggested Courses</H3>
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


        $chk=1;
        foreach ($schedule->result() as $row)
        {
            $html=$html."
                <tr>
                    <td>".$row->cid ."</td>
                    <td>".$this->getCourseByID($row->cid)."</td>
                    <td>".$row->semester."</td>
                    <td>".$row->section."</td>
                    <td>".$row->day."</td>
                    <td>".$row->start_time ."</td>
                    <td>".$row->end_time."</td>
					
                </tr>
				
            ";
        }

        return $html;
		}


    public function getPartSchedule()
    {
        $html='
                <table class="table table-hover">
                <tr>
                    <td>Course ID</td>
                    <td>Course Name</td>
                    <td>Semester</td>
                    <td>Course Section</td>
                    <td>Day</td>
                    <td>Start Time</td>
                     <td>End Time</td>
					 <td>Select</td>
                </tr>';

        $schedule= $this->db->query("select * from schedule");


        $chk=1;
        foreach ($schedule->result() as $row)
        {
            $html=$html."
                <tr align=\"center\">
                    <td>".$row->cid ."</td>
                    <td>".$this->getCourseByID($row->cid)."</td>
                    <td>".$row->semester."</td>
                    <td>".$row->section."</td>
                    <td>".$row->day."</td>
                    <td>".$row->start_time ."</td>
                    <td>".$row->end_time."</td>
					<td><input type=\"checkbox\" id=\"box".$chk."\" name=\"box".$chk."\" value=\"".$row->cid . ";".$row->day .";".$row->start_time .";".$row->end_time ."\"></td>
                </tr>
            ";
			$chk++;
        }

        return $html;
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
	  public function getDepartments()
    {
        $sql= "select * from department";
        $result = $this->db->query($sql);
        return $result;
    }
		  public function getDone()
    {
        $sql= "select * from schedule_done";
        $result = $this->db->query($sql);
        return $result;
    }
	public function getCount()
    {
	$table_row_count = $this->db->count_all('schedule');
	return $table_row_count;
	}
	  public function insertRoutine($cid,$day,$start,$end,$user)
	  {
	   $row_count = $this->db->count_all('schedule_done');
	   if($row_count!=3)
	   {
	
	  $data = array(
        'cid' => $cid,
        'start_time' => $start,
		'end_time' => $end,
		's_id' => $user,
		 'day' => $day
);

$this->db->insert('schedule_done', $data);
	  return true;
	  }
	  else
	  {
	  return false;
	  }
}
}
?>