<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['items']=$this->db->get_where('tbl_items',['id > '=>0])->result();
       
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/item-list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage($id='')
    {
      $data['category']=$this->db->get_where('tbl_category',['id > '=>0])->result();
    //   $data['hsn']=$this->db->get_where('tbl_master_hsn',['id > '=>0])->result();
      $data['sac']=$this->db->get_where('tbl_sac',['id > '=>0])->result();
      // print_r($data);
      // die();
      $data['items']=array();
      if(!empty($id)){
        $data['items']=$this->db->get_where('tbl_items',['id'=>$id])->row();
      }

    echo $this->load->view('admin/item-manage',$data,true);
    }

    public function save()
    {
        // print_r($_POST);
        // die();
      $edit_id=$this->input->post('edit_id');
      $name=$this->input->post('name');
    //   $sku=$this->input->post('sku');
      $unit=$this->input->post('unit');
      $price=$this->input->post('price');
      $description=$this->input->post('description');
      $category_name=$this->input->post('category_name');
    //   $hsn_code=$this->input->post('hsn_code');
      $sac_code=$this->input->post('sac_code');
      $tax_preference=$this->input->post('tax_preference');
      if(empty($name))
      {
        $result['status']='failed';
        $result['msg']='Please enter name';
        echo json_encode($result);
        die;
      }
      
      if(empty($unit))
      {
        $result['status']='failed';
        $result['msg']='Please enter unit';
        echo json_encode($result);
        die;
      }
      if(empty($price))
      {
        $result['status']='failed';
        $result['msg']='Please enter price';
        echo json_encode($result);
        die;
      }
      $check_where['name']=$name;
    //   $check_where['sku']=$sku;
      if(!empty($edit_id))
      {
        $check_where['id']=$edit_id;
      }
      $check=$this->db->get_where('tbl_items',$check_where)->row();
      if(!empty($check))
      {
        $result['status']='failed';
        $result['msg']='Item already exists!!';
        echo json_encode($result);
        die;
      }
      $data['name']=$name;
    //   $data['sku']=$sku;
      $data['unit']=$unit;
      $data['price']=$price;
      $data['description']=$description;
      $data['category_name']=$category_name;
    //   $data['hsn_code']=$hsn_code;
      $data['sac_code']=$sac_code;
      $data['tax_preference']=$tax_preference;
      if(!empty($edit_id))
      {
        $this->db->update('tbl_items',$data,['id'=>$edit_id]);
        $result['msg']='Item update successfully!!';
        $result['status']='success';
        echo json_encode($result);
        die;
      }else{
        $this->db->insert('tbl_items',$data);
        $result['msg']='Item add successfully!!';
        $result['status']='success';
        echo json_encode($result);
        die;
        
      }
     
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_items',['id'=>$id]);
      $result['msg']='Item add successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }

     public function get_catgegory()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_category',['type'=>$id])->result();
        $html='';
        if(!empty($data)){
            foreach($data as $row)
            {
             $datas=$row->category_name;
            $html.='
                <option value='.$datas.' >'.$datas.'</option>';
            }
        }
        echo json_encode($html);
    }
    
    public function get_items()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_items',['category_name'=>$id])->result();
        $html='';
        if(!empty($data)){
            foreach($data as $row)
            {
             $item_name=$row->name;
             $price=$row->price;
             $html.='<option value='.$item_name.' data-price="'.$price.'">'.$item_name.'</option>';

            }
        }
       
        echo json_encode($html);
    }
    
    
    public function get_unit()
    {
        $id = $this->input->post('id',TRUE);
        $data=$this->db->get_where('tbl_items',['name'=>$id])->result();
        $html='';
        if(!empty($data)){
            foreach($data as $row)
            {
             $item_name=$row->unit;
             $desc=$row->description;
             $html.='<option dataid='.$desc.' value='.$item_name.'>'.$item_name.'</option>';

            }
        }
       
        echo json_encode($html);
    }
  }
?>