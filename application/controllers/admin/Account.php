<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['account']=$this->db->get_where('tbl_account',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/account_list',$data); 
       $this->load->view('admin/contentfooter');
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
      $edit_id=trim($this->input->post('edit_id'));
      $name_in_account=trim($this->input->post('name_in_account'));
      $company_name=trim($this->input->post('company_name'));
      $account_number=trim($this->input->post('account_number'));
      $ifsc_code=trim($this->input->post('ifsc_code'));
      $bank_name=trim($this->input->post('bank_name'));
      $branch_name=trim($this->input->post('branch_name'));
     
      if(empty($name_in_account))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Name';
        echo json_encode($result);
        die;
      }
      if(empty($account_number))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Account Number';
        echo json_encode($result);
        die;
      }
      $data['name_in_account']=$name_in_account;
      $data['company_name']=$company_name;
      $data['account_number']=$account_number;
      $data['ifsc_code']=$ifsc_code;
      $data['bank_name']=$bank_name;
      $data['branch_name']=$branch_name;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_account',$data,['id'=>$edit_id]);
        $result['msg']='Account update successfully!!';
        $result['status']=1;
      }else{
        $this->db->insert('tbl_account',$data);
        $result['msg']='Account Added successfully!!';
        $result['status']=1;
      }
      
      echo json_encode($result);
      die;
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