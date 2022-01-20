<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
     
      $this->load->model('Promodel');
      is_admin_login();
    }
    
    public function index()
    {
       $data['category']=$this->db->get_where('tbl_category',['id > '=>0])->result();
       
       $this->load->view('admin/inc/header');
       $this->load->view('admin/inc/topBarNav');
       $this->load->view('admin/inc/navigation');
       $this->load->view('admin/contentheader');
       $this->load->view('admin/category_list',$data); 
       $this->load->view('admin/contentfooter');
       $this->load->view('admin/inc/footer.php');
    }

    public function manage($id='')
    {
      // $data['category']=$this->db->get_where('tbl_category',['id > '=>0])->result();
      $data['category']=array();
      if(!empty($id)){
        $data['category']=$this->db->get_where('tbl_category',['id'=>$id])->row();
      }

    echo $this->load->view('admin/category_manage',$data,true);
    }

    public function save()
    {
      $edit_id=trim($this->input->post('edit_id'));
      $category_name=trim($this->input->post('category_name'));
      $description=trim($this->input->post('description'));
      $type=trim($this->input->post('type'));
      if(empty($category_name))
      {
        $result['status']='failed';
        $result['msg']='Please Enter Category Name';
        echo json_encode($result);
        die;
      }
      if(empty($type))
      {
        $result['status']='failed';
        $result['msg']='Please Select Type';
        echo json_encode($result);
        die;
      }
      $check_where['category_name']=$category_name;
      if(!empty($edit_id))
      {
        $check_where['id']=$edit_id;
      }
      $check=$this->db->get_where('tbl_category',$check_where)->row();
      if(!empty($check))
      {
        $result['status']='failed';
        $result['msg']='Category already exists!!';
        echo json_encode($result);
        die;
      }
      $data['category_name']=$this->input->post('category_name');
      $data['description']=$this->input->post('description');
      $data['type']=$this->input->post('type');
      if(!empty($edit_id))
      {
        $this->db->update('tbl_category',$data,['id'=>$edit_id]);
        $result['msg']='Category update successfully!!';
      }else{
        $this->db->insert('tbl_category',$data);
        $result['msg']='Category add successfully!!';
      }
      $result['status']='success';
      echo json_encode($result);
      die;
    }

    public function delete_data()
    {
      $id=$this->input->post('id');
      $this->db->delete('tbl_category',['id'=>$id]);
      $result['msg']='Category Deleted successfully!!';
      $result['status']='success';
      echo json_encode($result);
      die;
    }

  }
?>