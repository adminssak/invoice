<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['company']=$this->db->get_where('tbl_company',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/company_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }


    public function manage($id='')
    {
      $data['company']=array();
      $data['invoice']=$this->db->get_where('tbl_master_invoice',['id >'=>0])->result();
    //   print_r($data['invoice']);
    //   die();
      if(!empty($id)){
        $data['company']=$this->db->get_where('tbl_company',['id'=>$id])->row();
      }

       echo $this->load->view('admin/master/company',$data,true);
    }

    public function save()
    {
      $edit_id=trim($this->input->post('edit_id'));
      $invoice_number=trim($this->input->post('invoice_number'));
      $company_name=trim($this->input->post('company_name'));
      $gstin_number=trim($this->input->post('gstin_number'));
      $address=trim($this->input->post('full_address'));
      if(empty($company_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Company Name';
        echo json_encode($result);
        die;
      }
      if(empty($address))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Address';
        echo json_encode($result);
        die;
      }
      $old_image = $this->input->post('old_image');
        $image = $_FILES['image'];
        if (!empty($image['name'])) {
            $row = $this->doUpload('image', 'company');
            if ($row['status']) {
                $data['image'] = $row['file_name'];
                $this->removeFile($old_image, 'company');
            } else {
                $result['status'] = 0;
                $result['message'] = $row['file_name'];
                echo json_encode($result);
                die;
            }
        }
        $data['invoice_number']=$invoice_number;
      $data['company_name']=$company_name;
      $data['gstin_number']=$gstin_number;
      $data['address']=$address;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_company',$data,['id'=>$edit_id]);
        $result['msg']='Company update successfully!!';
      }else{
        $this->db->insert('tbl_company',$data);
        $result['msg']='Company Added successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_company',['id'=>$id]);
      $result['msg']='Company Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }
}