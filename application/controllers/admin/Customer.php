<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['customer']=$this->db->get_where('tbl_customer',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/customer-list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage($id='')
    {
      $data['state']=$this->db->get_where('tbl_state',['id > '=>0])->result();
      $data['customer']=array();
      if(!empty($id)){
        $data['customer']=$this->db->get_where('tbl_customer',['id'=>$id])->row();
      }

     echo $this->load->view('admin/manage_customer',$data,true);
    }

    public function save()
    {
      $edit_id=trim($this->input->post('edit_id'));
      $customer_type=trim($this->input->post('customer_type'));
      $firstname=trim($this->input->post('firstname'));
      $lastname=trim($this->input->post('lastname'));
      $company_name=trim($this->input->post('company_name'));
      $customer_display_name=trim($this->input->post('customer_display_name'));
      $customer_email=trim($this->input->post('customer_email'));
      $gst_number=trim($this->input->post('gst_number'));
      $country_region=trim($this->input->post('country_region'));
      $address=trim($this->input->post('address'));
      $city=trim($this->input->post('city'));
      $state=trim($this->input->post('state'));
      $zip_code=trim($this->input->post('zip_code'));
      $phone=trim($this->input->post('phone'));
      $same_as=trim($this->input->post('same_as'));
      $shipping_country_region=trim($this->input->post('shipping_country_region'));
      $shipping_address=trim($this->input->post('shipping_address'));
      $shipping_city=trim($this->input->post('shipping_city'));
      $shipping_state=trim($this->input->post('shipping_state'));
      $shipping_zip_code=trim($this->input->post('shipping_zip_code'));
      $shipping_number=trim($this->input->post('shipping_number'));
      $salutation=trim($this->input->post('salutation'));
      $contact_first_name=trim($this->input->post('contact_first_name'));
      $contact_last_name=trim($this->input->post('contact_last_name'));
      $contact_email=trim($this->input->post('contact_email'));
      $contact_address=trim($this->input->post('contact_address'));
      $work_phone=trim($this->input->post('work_phone'));
      $mobile_number=trim($this->input->post('mobile_number'));
      if(empty($firstname))
      {
        $result['status']='failed';
        $result['msg']='Please Enter First Name';
        echo json_encode($result);
        die;
      }
      if(empty($company_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Company Name';
        echo json_encode($result);
        die;
      }
      if(empty($customer_display_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Customer Display Number';
        echo json_encode($result);
        die;
      }
      if(empty($customer_email))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Customer Email';
        echo json_encode($result);
        die;
      }
      // $check_where['name']=$name;
      // $check_where['sku']=$sku;
      // if(!empty($edit_id))
      // {
      //   $check_where['id']=$edit_id;
      // }
      // $check=$this->db->get_where('tbl_items',$check_where)->row();
      // if(!empty($check))
      // {
      //   $result['status']='failed';
      //   $result['msg']='Customer already exists!!';
      //   echo json_encode($result);
      //   die;
      // }
      $data['customer_type']=$customer_type;
      $data['firstname']=$firstname;
      $data['lastname']=$lastname;
      $data['company_name']=$company_name;
      $data['customer_display_name']=$customer_display_name;
      $data['customer_email']=$customer_email;
      $data['gst_number']=$gst_number;
      $data['country_region']=$country_region;
      $data['address']=$address;
      $data['city']=$city;
      $data['state']=$state;
      $data['zip_code']=$zip_code;
      $data['phone']=$phone;
      if(!empty($same_as)){
      $data['same_as']=$same_as;
      $data['shipping_country_region']=$country_region;
      $data['shipping_address']=$address;
      $data['shipping_city']=$city;
      $data['shipping_state']=$state;
      $data['shipping_zip_code']=$zip_code;
      $data['shipping_number']=$phone;
    }else{
      $data['shipping_country_region']=$shipping_country_region;
      $data['shipping_address']=$shipping_address;
      $data['shipping_city']=$shipping_city;
      $data['shipping_state']=$shipping_state;
      $data['shipping_zip_code']=$shipping_zip_code;
      $data['shipping_number']=$shipping_number;
    }
      $data['salutation']=$salutation;
      $data['contact_first_name']=$contact_first_name;
      $data['contact_last_name']=$contact_last_name;
      $data['contact_email']=$contact_email;
      $data['contact_address']=$contact_address;
      $data['work_phone']=$work_phone;
      $data['mobile_number']=$mobile_number;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_customer',$data,['id'=>$edit_id]);
        $result['msg']='Customer update successfully!!';
      }else{
        $this->db->insert('tbl_customer',$data);
        $result['msg']='Customer add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_customer',['id'=>$id]);
      $result['msg']='Customer Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }

  }
?>