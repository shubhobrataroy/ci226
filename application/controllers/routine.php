<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/20/2016
 * Time: 8:18 PM
 */
class routine extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->library('form_validation');
        $this->load->model('routine_model');

    }

    public function index()
    {
	        $suggdata=$this->routine_model->getPartSchedule();
			$cnt=$this->routine_model->getCount();
			for($i=1;$i<2;$i++)
			{
			$this->form_validation->set_rules('box'.$i, 'Checkbox', 'callback_check');
			}
			 if($this->form_validation->run() == FALSE)
        {
   

            $data['message']=validation_errors();
			 $data['message1']="";
			 $data['html2']="";
			$data['total_row']=$cnt;
			$data['html']=$suggdata;
			$this->load->view('view_routine',$data);
		}
else
{
$allBox=array();
$n=1;
for($i=1;$i<=$cnt;$i++)
			{
		$sz=$this->input->post('box'.$i);
			if( strlen($sz)>1)
			{
			$allBox[$n] = $this->input->post('box'.$i);
				$n++;
			}
			}
   list($c1,$day1,$start1,$end1)=explode(';',$allBox[1]);
   list($c2,$day2,$start2,$end2)=explode(';',$allBox[2]);
   list($c3,$day3,$start3,$end3)=explode(';',$allBox[3]);
		//insert data
		$user = $this->session->userdata('username');
		$val1=$this->routine_model->insertRoutine($c1,$day1,$start1,$end1,$user);
		$val2=$this->routine_model->insertRoutine($c2,$day2,$start2,$end2,$user);
		$val3=$this->routine_model->insertRoutine($c3,$day3,$start3,$end3,$user);
		if($val1 && $val2 && $val3)
		{
$data['message']="";		
$data['message1']='Successfully registered!';
$html2='<H3>Registered Courses</H3>
                <table class="table table-hover">
                <tr>
                    <td>Course ID</td>
					 <td>Course Name</td>
                     <td>Day</td>
                    <td>Start Time</td>
                     <td>End Time</td>
                </tr>';
				$schedule= $this->routine_model->getDone();



        foreach ($schedule->result() as $row)
        {
            $html2=$html2."
                <tr>
                    <td>".$row->cid."</td>
                    <td>".$this->routine_model->getCourseByID($row->cid)."</td>
                    <td>".$row->day."</td>
                    <td>".$row->start_time."</td>
                    <td>".$row->end_time."</td>
                </tr>
            ";
        }
		
			
		
			$data['html']="";
		$data['html2']=$html2;
		$this->load->view('view_routine',$data);
}
else
{
$data['html']="";
		$data['html2']="";
$data['message']="You have already registered!";		
$data['message1']='';
$this->load->view('view_routine',$data);
}

}		
			
	
   }
   
   public function check()
   {
   $allBox=array();
   $cnt=$this->routine_model->getCount();
   $n=1;
   for($i=1;$i<=$cnt;$i++)
			{
			$sz=$this->input->post('box'.$i);
			if( strlen($sz)>1)
			{
			$allBox[$n] = $this->input->post('box'.$i);
				$n++;
			}
		
			}
   if(count($allBox)>3)
   {
   $this->form_validation->set_message('check', 'You should take maximum 9 credits!');
     return false;
   
   }
   else if(count($allBox)<=2)
   {
   $this->form_validation->set_message('check', 'You should take minimum 9 credits!');
     return false;
   }
   else if(count($allBox)==3)
   {
   list($c1,$day1,$start1,$end1)=explode(';',$allBox[1]);
   list($c2,$day2,$start2,$end2)=explode(';',$allBox[2]);
   list($c3,$day3,$start3,$end3)=explode(';',$allBox[3]);
   if($c1==$c2 || $c2==$c3 || $c1==$c3)
   {
   $this->form_validation->set_message('check', 'You have taken same course more than one!');
   return false;
   }
   if($day1==$day2)
   {
   list($s1,$s2)=explode(':',$start1);
   list($e1,$e2)=explode(':',$end1);
      list($s11,$s22)=explode(':',$start2);
   list($e11,$e22)=explode(':',$end2);
   
   if($start1==$start2 || $end1== $end2 || $s1==$s11 || $e1== $e11 )
   {
    $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   if(intval($s1)>intval($s11) && intval($s1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e1)>intval($s11) && intval($e1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($s11)>intval($s1) && intval($s11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e11)>intval($s1) && intval($e11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   }//day1 ends
      if($day2==$day3)
   {
   list($s1,$s2)=explode(':',$start2);
   list($e1,$e2)=explode(':',$end2);
      list($s11,$s22)=explode(':',$start3);
   list($e11,$e22)=explode(':',$end3);
   
   if($start1==$start2 || $end1== $end2 || $s1==$s11 || $e1== $e11 )
   {
    $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   if(intval($s1)>intval($s11) && intval($s1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e1)>intval($s11) && intval($e1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($s11)>intval($s1) && intval($s11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e11)>intval($s1) && intval($e11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   }//day2 ends
      if($day1==$day3)
   {
   list($s1,$s2)=explode(':',$start1);
   list($e1,$e2)=explode(':',$end1);
      list($s11,$s22)=explode(':',$start3);
   list($e11,$e22)=explode(':',$end3);
   
   if($start1==$start2 || $end1== $end2 || $s1==$s11 || $e1== $e11 )
   {
    $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   if(intval($s1)>intval($s11) && intval($s1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e1)>intval($s11) && intval($e1)<intval($e11))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($s11)>intval($s1) && intval($s11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
    if(intval($e11)>intval($s1) && intval($e11)<intval($e1))
   {
   $this->form_validation->set_message('check', 'You have time clash!');
   return false;
   }
   }//day3 ends
   }//else ends
   return true;
   }//check method ends
   
   
       
    

    public function logout ()
    {
        $this->load->library('session');
        $this->session->unset_userdata("username");
        $this->session->unset_userdata("privilege");
        $data['message']="Logout Successful";
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','Name','required');
        $this->form_validation->set_rules('password','Password','required');



        if ($this->form_validation->run() == FALSE) {
            $data['message']="";
            $this->load->view('view_welcome',$data);
        }

        else
        {
            $result=$this->login_model->login($this->input->post('username'),$this->input->post('password'));

            if($result=='admin' && $result!= 1) {

                $this->session->set_userdata("username",$this->input->post('username'));
                $this->session->set_userdata("privilege",'admin');
                $this->load->view('view_admin');
            }

            else if ($result== true )
            {

                $this->session->set_userdata("username",$this->input->post('username'));
                $this->session->set_userdata("privilege",'student');
                $this->load->view('view_success');
            }

            else
            {
                $data['message']="Wrong username or password";
                $this->load->view('view_welcome',$data);

            }
        }

    }

  
}