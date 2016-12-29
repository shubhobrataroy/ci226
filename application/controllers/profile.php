<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/20/2016
 * Time: 8:18 PM
 */
class profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
		$this->load->library('form_validation');
        $this->load->model('profile_model');

    }

    public function index()
    {
	 $this->form_validation->set_rules('username', 'Username', 'required|min_length[10]');
   $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
   $this->form_validation->set_rules('password', 'Password', 'required');
   $this->form_validation->set_rules('dist', 'District', 'required');
	  if($this->form_validation->run() == FALSE)
   {
   

            $data['message']=validation_errors();
			$data['message1']="";
			$data['message2']="";
			$user = $this->session->userdata('username');
			$prodata=$this->profile_model->get_profile($user);
			$pass=$this->profile_model->get_password($user);
			foreach($pass as $row)
			{
			$data['pass']=$row->password;
			}
			
			foreach($prodata as $row)
			{
			$data['username']=$row->username;
			$data['email']=$row->email;
			$data['district']=$row->district;
			$data['address']=$row->address;
			}
			
            

  
   
  
			
        $this->load->view('view_profile',$data);
  
     
     
   }
   else
   {
   $email = $this->input->post('email');
   $username = $this->input->post('username');
   $pass= $this->input->post('password');
   $dist = $this->input->post('dist');
   $add = $this->input->post('address');
   
    $val=$this->profile_model->update($username,$email, $pass,$add,$dist);
	if($val)
	{
	$data['message1']="Sucessfully updated!";
	$data['message']="";
			
			$data['message2']="";
			$user = $this->session->userdata('username');
			$prodata=$this->profile_model->get_profile($user);
			$pass=$this->profile_model->get_password($user);
			foreach($pass as $row)
			{
			$data['pass']=$row->password;
			}
			
			foreach($prodata as $row)
			{
			$data['username']=$row->username;
			$data['email']=$row->email;
			$data['district']=$row->district;
			$data['address']=$row->address;
			}
			
	$this->load->view('view_profile',$data);
	}
	else
	{
	$data['message2']="Update failed!";
	$data['message']=validation_errors();
			$data['message1']="";
			
			$user = $this->session->userdata('username');
			$prodata=$this->profile_model->get_profile($user);
			$pass=$this->profile_model->get_password($user);
			foreach($pass as $row)
			{
			$data['pass']=$row->password;
			}
			
			foreach($prodata as $row)
			{
			$data['username']=$row->username;
			$data['email']=$row->email;
			$data['district']=$row->district;
			$data['address']=$row->address;
			}
			
	$this->load->view('view_profile',$data);
	}
   }
   
  
   
   
       
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