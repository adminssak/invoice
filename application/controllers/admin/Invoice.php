<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {
     
    public function __construct()
    {
      	parent ::__construct();
      $this->load->model('Promodel');
      $this->load->model('Adminuser');
      is_admin_login();
    }
    
    public function index()
    {
       $data['invoices']=$this->db->get_where('tbl_invoice',['id > '=>0])->result();
       $data['invoice']=$this->db->get_where('invoices_items',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/invoice_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function print_view($id='')
    {
      $data['invoice']=$this->db->get_where('tbl_invoice',['id'=>$id])->row();
      $data['invoicelist']=$this->db->get_where('tbl_due_invoice',['user_id'=>$id])->result();
    //   print_r($data['invoicelist']);
    //   die();
      $this->load->view('admin/testing',$data);

    }

    public function manage($id='')
    {
     
      $data['invoice']=array();
      if(!empty($id)){
        $data['invoice']=$this->db->get_where('tbl_invoice',['id'=>$id])->row();
      }
      $data['customer_notes']=$this->db->get_where('tbl_customer_notes',['id > '=>0])->result();
      $data['term']=$this->db->get_where('tbl_term_condition',['id > '=>0])->result();
    //   $data['items']=$this->db->get_where('tbl_items',['id > '=>0])->result();
      $data['company']=$this->db->get_where('tbl_company',['id > '=>0])->result();
      $data['customer']=$this->db->get_where('tbl_customer',['id > '=>0])->result();
      $data['state']=$this->db->get_where('tbl_state',['id > '=>0])->result();
      $data['account']=$this->db->get_where('tbl_account',['id > '=>0])->result();
    //   $last_row=$this->db->query("SELECT * FROM tbl_master_invoice ORDER BY id DESC LIMIT 1")->row_array();
    //   $last_id=!empty($last_row)?$last_row['next_number']+1:1;
    //   $data['new_invoice_no']=(!empty($last_row)?$last_row['prefix_name']:'').str_pad($last_id, NUMBER_DIGIT, '0', STR_PAD_LEFT);
      $data['orders']=rand();
      $this->load->view('admin/inc/header');
      $this->load->view('admin/inc/topBarNav');
      $this->load->view('admin/inc/navigation');
      $this->load->view('admin/contentheader');
      $this->load->view('admin/manage_invoice',$data); 
      $this->load->view('admin/inc/footer.php');
   }

    public function save()
    {
      $edit_id=trim($this->input->post('edit_id'));
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


    public function change_Status() {
        $id = $this->input->post('id');
        $updateArray['status'] = $this->input->post('status');
        $row = $this->Adminuser->update_global_Record('tbl_invoice', $id, $updateArray);
        $result['status']=$this->input->post('id');
        echo json_encode($result);
        die();
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

    // function generateRandomString($length = 10) {
    // $characters = 'INC0123456789';
    // $charactersLength = strlen($characters);
    // $randomString = '';
    // for ($i = 0; $i < $length; $i++) {
    //     $randomString .= $characters[rand(0, $charactersLength - 1)];
    // }
    //  echo json_encode($randomString);
    //   die;
    // }


    public function get_items($length = 10)
    {
         $characters = '0123456789';
         $charactersLength = strlen($characters);
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
         $randomString .= $characters[rand(0, $charactersLength - 1)];
         }
        echo json_encode($html);
    }

    public function get_account()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_account',['company_name'=>$id])->result();
        $html='';
        if(!empty($data)){
            foreach($data as $row)
            {
            $datas=$row->name_in_account;
            $id=$row->id;
            $html.='
                <option value='.$id.' >'.$datas.'</option>';
            }
        }
        echo json_encode($html);
    }

     public function get_price()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_items',['name'=>$id])->result();
        $html='';
        if(!empty($data)){
            foreach($data as $row)
            {
            $datas=$row->price;
            $html.=$datas;
            }
        }
        echo json_encode($html);
    }

    public function get_data()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_customer',['firstname'=>$id])->row_array();
        $html=$data;
        echo json_encode($html);
    }
    
    public function sav_invoice(){

      $edit_id = $this->input->post('edit_id');
      $formArray['customer_name']=$this->input->post('customer_name');
      $formArray['gstin']=$this->input->post('gstin');
      $formArray['place_of_supply']=$this->input->post('place_of_supply');
      $formArray['invoice_number']=$this->input->post('invoice_number');
      $formArray['order_number']=$this->input->post('order_number');
      $formArray['invoice_date']=$this->input->post('invoice_date');
      $formArray['due_date']=$this->input->post('due_date');
      $formArray['due_type']=$this->input->post('due_type');
      $formArray['customer_notes']=$this->input->post('customer_notes');
      $formArray['terms_condition']=$this->input->post('terms_condition');
      $formArray['email']=$this->input->post('email');
      $formArray['sub_total']=$this->input->post('sub_totals');
      $formArray['tax_rate']=$this->input->post('tax_rate');
      $formArray['grant_total']=$this->input->post('total_amount');
      $formArray['remarks']=$this->input->post('remarks');
      $formArray['account']=$this->input->post('account_full');
      $item= array(
                'qty'=>$_POST['qty'],
                'unit'=>$_POST['unit'],
                'item_category'=>$_POST['item_category'],
                'item_name' => $_POST['item_name'],
                'item_description'=>$_POST['item_description'],
                'price'=>$_POST['price'],
                'total'=>$_POST['total']
      );
      $formArray['items'] = json_encode($item);
      if(!empty($edit_id))
      {
        $this->db->update('tbl_invoice',$formArray,['id'=>$edit_id]);
        $result['msg']='Invoice update successfully!!';
      }else{
        $this->db->insert('tbl_invoice',$formArray);
        $result['msg']='Invoice add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;
    }
    
    public function delete_inv()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_invoice',['id'=>$id]);
      $result['msg']='Item add successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }


    public function next($id='')
    {
      // print_r($id);
      // die();
      // $data['invoice']=$this->db->get_where('tbl_invoice',['id'=>$id])->row();
      if(!empty($id)){
        $data['invoice']=$this->db->get_where('tbl_invoice',['id'=>$id])->row();
      }
     echo $this->load->view('admin/partial-form',$data,true);
    }
  
  public function due_invoice(){
      // print_r($_POST);
      // die();
      $flag=1;
      $edit_id = $this->input->post('edit_id');
      $ammount_paid=$this->input->post('ammount_paid');
      $grant_total=$this->input->post('grant_total');
      $due=$this->input->post('due');
      $due_date=$this->input->post('due_date');
      if(empty($ammount_paid))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Ammount';
        echo json_encode($ammount_paid);
        die;
      }
      
      $formArray['user_id']=$edit_id;
      $formArray['ammount_paid']=$ammount_paid;
      $formArray['grant_total']=$grant_total;
      $formArray['due']=$due;
      $formArray['paid_date']=date('y-m-d');
      $formArray['due_dates']=$due_date;
      $form=$this->db->insert('tbl_due_invoice', $formArray);
      if(!$form){
          $flag=0;
      }
      if($flag){
           $formArray=$this->input->post('edit_id');;
           $Array['grant_total']=$due;
           $Array['due_date']=$due_date;
           $forms=$this->db->update('tbl_invoice',$Array,['id'=>$formArray]);
      }
      $result['msg']='Due Invoice Created successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die();
      
    }

  }
?>