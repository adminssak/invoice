<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {    if(empty($this->session->userdata('is_login'))){
        }
        $sess=$this->session->userdata('is_login');
        
        if(!empty($sess)){
        $data['setting']=$this->db->get_where('tbl_setting',['sess_id'=>$sess])->row_array();
        // print_r($data);
        // die();
      }
       
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/user/profile',$data); 
    //   $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }


    public function manage($id='')
    {
      $data['account']=array();
      $data['company']=$this->db->get_where('tbl_company',['id >'=>0])->result();
      if(!empty($id)){
        $data['account']=$this->db->get_where('tbl_account',['id'=>$id])->row();
      }

       echo $this->load->view('admin/master/account',$data,true);
    }

    public function save()
    {  
        if(empty($this->session->userdata('is_login'))){
        }
      $sess=$this->session->userdata('is_login');
      $edit_id=trim($this->input->post('edit_id'));
      $firstname=trim($this->input->post('firstname'));
      $lastname=trim($this->input->post('lastname'));
    
    //   $bank_name=trim($this->input->post('bank_name'));
    //   $branch_name=trim($this->input->post('branch_name'));
     
      if(empty($firstname))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Name';
        echo json_encode($result);
        die;
      }
      
      $old_image = $this->input->post('old_image');
        $image = $_FILES['image'];
        if (!empty($image['name'])) {
            $row = $this->doUpload('image', 'company');
            if ($row['status']) {
                $data['image'] = $row['file_name'];
                $this->removeFile($old_image, 'admin');
            } else {
                $result['status'] = 0;
                $result['message'] = $row['file_name'];
                echo json_encode($result);
                die;
            }
        }
        $data['sess_id']=$sess;
      $data['firstname']=$firstname;
      $data['lastname']=$lastname;
      
    //   $data['bank_name']=$bank_name;
    //   $data['branch_name']=$branch_name;
      if(!empty($sess))
      {
        $this->db->update('tbl_setting',$data,['sess_id'=>$sess]);
        $result['msg']='Account update successfully!!';
         $result['status']='1';
         echo json_encode($result);
        die;
      }else{
        $this->db->insert('tbl_setting',$data);
        $result['msg']='Account Added successfully!!';
        $result['status']='1';
      echo json_encode($result);
      die;
      }
      
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_account',['id'=>$id]);
      $result['msg']='Tax Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }
}