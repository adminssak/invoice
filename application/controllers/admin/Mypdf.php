<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Mypdf extends CI_Controller {
    
    public function __construct()
    {
     	parent ::__construct();
        $this->load->model('Promodel');
    }
    
    public  function print_item($id='')
    {
        $data['invoicelist']=$this->db->get_where('tbl_due_invoice',['user_id'=>$id])->result();
        $data['invoice'] = $this->db->get_where('tbl_invoice',['id'=>$id])->row();
        $html=$this->load->view('admin/mypdf',$data,true);
        $mpdf = new \Mpdf\Mpdf();
        // echo $html;
        $mpdf->WriteHTML($html);
        $mpdf->Output('invoice.pdf','D'); 
        exit();
    }
}