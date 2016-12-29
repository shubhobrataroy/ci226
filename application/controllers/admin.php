<?php

/**
 * Created by PhpStorm.
 * User: shubh
 * Date: 12/20/2016
 * Time: 8:18 PM
 */
class admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('admin_model');

    }

    public function index()
    {

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

    public function add_course()
    {


        if(empty($_REQUEST)) {
            $result=$this->admin_model->getDepartments();
            $this->load->helper('url');
            $html1 = " <form action='".base_url()."admin/perform_add_course' method='post'>
             <table width='50%' border='1' class=\"table table-hover\">
                <tr>
                  <td>Department</td>
                  <td>Course Id</td>
                  <td>Course Name</td>
                  <td>Course Credit</td>
                </tr>
                <tr><td><select name='department'>
                ";

            foreach ($result->result() as $row)
            {
                $html1 = $html1."<option value='".$row->dname."'>".$row->dname."</option>";
            }


            $html1= $html1."
                </select></td>
                <td><input type='text' name='id'></td>
                <td><input type='text' name='name'></td>
                <td><input type='text' name='credit'></td>
               </tr>
               
               
             </table>
             <input type='submit' value='Add' />
             
             </form>
        ";

            $data['html'] =$html1;
                ;
        }

        else
        {
            $data['html']='';
        }
        $this->session->set_userdata("username",'admin');
        $this->session->set_userdata("privilege",'admin');
            $this->load->view('view_admin', $data);

    }


    public function perform_add_course()
    {

        $this->admin_model->addCourse($this->input->post('department'),$this->input->post('id'),$this->input->post('name'),$this->input->post('credit'));
        $data['html']="<h3>Updated Course List</h3> ".$this->admin_model->getCourseList($this->input->post('department'));
        $this->load->view('view_admin', $data);
    }
    public function add_department ()
    {
        if(empty($_REQUEST)) {
            $result=$this->admin_model->getDepartments();
            $this->load->helper('url');
            $html1 = " <form action='".base_url()."admin/perform_add_department' method='post'>
             <table width='50%' border='1' class=\"table table-hover\">
                <tr>
                  <td>Department Name</td>
                  
                </tr>
               
                ";
            foreach($result->result() as $row)
            {
                $html1 = $html1." <tr><td>".$row->dname."</td></tr>";
            }

            $html1= $html1."
                </tr>
                <td><input type='text' name='dname'></td>
               </tr>
             </table>
             <input type='submit' value='Add' />
             
             </form>
        ";

            $data['html'] =$html1;
            ;
        }

        else
        {
            $data['html']='';
        }
        $this->session->set_userdata("username",'admin');
        $this->session->set_userdata("privilege",'admin');
        $this->load->view('view_admin', $data);
    }


    public function perform_add_department()
    {
        $this->admin_model->addDepartment($this->input->post('dname'));
        $this->add_department();
    }
}