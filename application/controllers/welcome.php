<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('login_model');
    }

	public function index()
	{
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
                $data['html']='';
                $this->session->set_userdata("username",$this->input->post('username'));
                $this->session->set_userdata("privilege",'admin');
                $this->load->view('view_admin',$data);
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