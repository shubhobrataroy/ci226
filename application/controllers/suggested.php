<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/20/2016
 * Time: 8:18 PM
 */
class suggested extends CI_Controller
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
	        $suggdata=$this->routine_model->getSchedule();
			$data['html']=$suggdata;
			$this->load->view('view_suggested',$data);
			
			
	
   }
   
  
   
   
       
    

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