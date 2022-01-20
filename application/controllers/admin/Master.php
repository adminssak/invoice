<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['tax']=$this->db->get_where('tbl_tax',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/tax_master_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage($id='')
    {
      
      $data['tax']=array();
      if(!empty($id)){
        $data['tax']=$this->db->get_where('tbl_tax',['id'=>$id])->row();
      }

     echo $this->load->view('admin/master/tax',$data,true);
    }

    public function save()
    {
      $edit_id=trim($this->input->post('edit_id'));
      $tax_name=trim($this->input->post('tax_name'));
      $tax_value=trim($this->input->post('tax_value'));
     
      if(empty($tax_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Name';
        echo json_encode($result);
        die;
      }
      if(empty($tax_value))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Tax Value';
        echo json_encode($result);
        die;
      }
      $data['tax_name']=$tax_name;
      $data['tax_value']=$tax_value;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_tax',$data,['id'=>$edit_id]);
        $result['msg']='Tax update successfully!!';
      }else{
        $this->db->insert('tbl_tax',$data);
        $result['msg']='Tax add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_tax',['id'=>$id]);
      $result['msg']='Tax Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }

    public function invoice()
    {
       $data['invoice']=$this->db->get_where('tbl_master_invoice',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/invoice_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage_invoice($id='')
    {
      
      $data['invoice']=array();
      if(!empty($id)){
        $data['invoice']=$this->db->get_where('tbl_master_invoice',['id'=>$id])->row();
      }
     echo $this->load->view('admin/master/invoice',$data,true);
    }
    public function get_invoice()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_company',['id'=>$id])->row_array();
        $html='';
        // $datas=$this->db->get_where('tbl_master_invoice',['id'=>$data['invoice_number']])->row_array();
        $last_row=$this->db->get_where('tbl_master_invoice',['id'=>$data['invoice_number']])->row_array();
        $last_id=!empty($last_row)?$last_row['next_number']+1:1;
        $datass['new_invoice_no']=(!empty($last_row)?$last_row['prefix_name']:'').str_pad($last_id, NUMBER_DIGIT, '0', STR_PAD_LEFT);
        $inv = $datass['new_invoice_no'];
            // $id=$row->id;
        $html.=''.$inv.'';
        echo json_encode($html);
    }
    
    public function get_gst()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_customer',['firstname'=>$id])->row();
        // print_r($data->state);
        // die();
        $html='';
        $datas=$data->state;
        if($datas == '34'){
         $html.='
                <option value=18%>CGST & SGST (18%)</option>';
        }else{
            $html.='
                <option value=18%>IGST (18%)</option>';
        }
        echo json_encode($html);
    }

    public function save_invoice()
    {

      $edit_id=trim($this->input->post('edit_id'));
      $prefix_name=trim($this->input->post('prefix_name'));
      $next_number=trim($this->input->post('next_number'));
     
      if(empty($prefix_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Invoice Number';
        echo json_encode($result);
        die;
      }
      
      $data['prefix_name']=$prefix_name;
      $data['next_number']=$next_number;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_master_invoice',$data,['id'=>$edit_id]);
        $result['msg']='Invoice update successfully!!';
      }else{
        $this->db->insert('tbl_master_invoice',$data);
        $result['msg']='Invoice add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;

    }


    public function save_invo()
    {

      $edit_id=trim($this->input->post('edit_id'));
      $prefix_name=trim($this->input->post('prefix_name'));
      $next_number=trim($this->input->post('next_number'));
      
      $data['prefix_name']=$prefix_name;
      $data['next_number']=$next_number;
      $this->db->insert('tbl_master_invoice',$data);
      $result['msg']='Invoice add successfully!!';
      redirect(base_url() . 'admin/master/invoice');

    }
   

   public function delete_invoice()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_master_invoice',['id'=>$id]);
      $result['msg']='Invoice Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }


     public function hsn()
    {
       $data['hsn']=$this->db->get_where('tbl_master_hsn',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/hsn_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage_hsn($id='')
    {
      
      $data['hsn']=array();
      if(!empty($id)){
        $data['hsn']=$this->db->get_where('tbl_master_hsn',['id'=>$id])->row();
      }
     echo $this->load->view('admin/master/hsn',$data,true);
    }

    public function save_hsn()
    {

      $edit_id=trim($this->input->post('edit_id'));
      $hsn_code=trim($this->input->post('hsn_code'));
      if(empty($hsn_code))
      {
        $result['status']='failed';
        $result['msg']='Please Enter HSN Code';
        echo json_encode($result);
        die;
      }
      
      $data['hsn_code']=$hsn_code;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_master_hsn',$data,['id'=>$edit_id]);
        $result['msg']='HSN Code update successfully!!';
      }else{
        $this->db->insert('tbl_master_hsn',$data);
        $result['msg']='HSN Code add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;

    }
   

   public function delete_hsn()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_master_hsn',['id'=>$id]);
      $result['msg']='Invoice Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }


     public function sac()
    {
       $data['sac']=$this->db->get_where('tbl_sac',['id > '=>0])->result();
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/master/sac_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage_sac($id='')
    {
      
      $data['sac']=array();
      if(!empty($id)){
        $data['sac']=$this->db->get_where('tbl_sac',['id'=>$id])->row();
      }
     echo $this->load->view('admin/master/sac',$data,true);
    }

    public function save_sac()
    {

      $edit_id=trim($this->input->post('edit_id'));
      $sac_code=trim($this->input->post('sac_code'));
      if(empty($sac_code))
      {
        $result['status']='failed';
        $result['msg']='Please Enter SAC Code';
        echo json_encode($result);
        die;
      }
      
      $data['sac_code']=$sac_code;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_sac',$data,['id'=>$edit_id]);
        $result['msg']='SAC Code update successfully!!';
      }else{
        $this->db->insert('tbl_sac',$data);
        $result['msg']='SAC Code add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;

    }
   

   public function delete_sac()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_sac',['id'=>$id]);
      $result['msg']='SAC Delete successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }
  }
?>