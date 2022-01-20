<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
     
     public function __construct()
     {
     	parent ::__construct();
     	$this->load->database();
     	$this->load->helper(array('form', 'url'));
      $this->load->library('form_validation');
      $this->load->model('Promodel');
      $this->load->library('session');
      is_admin_login();
    }
    public function index()
    {
       $this->load->view('admin/inc/header');
       // $this->load->view('admin/inc/topBarNav');
       // $this->load->view('admin/inc/navigation');       
       $this->load->view('admin/login');
       //$this->load->view('admin/inc/footer.php');
    }
    public function login()
    {
      $username=$this->input->post('username');
      $password=$this->input->post('password');

      $response=$this->Promodel->login_user($username, $password);
      if($response)
      {
        $response['is_login']=true;
        $this->session->set_userdata($response);
        redirect('Admin/dashboard');
      }
      else{
        $this->session->set_flashdata('message_name', '<span style="color:yellow;">Email and Password not match</span>');
        redirect('Admin');
            
      }

    }
    public function dashboard()
    {
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/dashboard');
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }
    public function userRegister()
    {
      $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation'); 
       $this->load->view('admin/user/index');
       $this->load->view('admin/inc/footer.php');
    }
    public function editItem()
    {
      $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/additem'); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }
    public function addItem()
    {
      $edit_id=$this->input->post('edit_id');
        $data['firstname']=$this->input->post('name');
        $data['lastname']=$this->input->post('name');
        $data['username']=$this->input->post('name');
        $data['email']=$this->input->post('email');
        $data['password']=$this->input->post('password');
        $data['phone']=$this->input->post('phone');
    }

public function manage()
    {
      $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/manage'); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }


    public function logout()
    {
      $this->session->sess_destroy();
        redirect('Admin');
    }
}     