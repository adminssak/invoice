<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
     
    public function __construct()
    {
     	parent ::__construct();
       $this->load->model('Promodel');
       $this->load->library('email');
    }
    
    public function mail_send($id='')
    {
        $data=$this->db->get_where('tbl_invoice',['id'=>$id])->row_array();
        $today=date("Y-m-d");
        $first_data = $data['invoice_date'];
        $due_type = $data['due_type'];
        // print_r($due_type);
        // die();
        if($due_type == '1'){
        $next_date = date($first_data,strtotime("+30 days"));
        }else if($due_type == '2'){
        $next_date = date($first_data,strtotime("+90 days"));
        }else if($due_type == '3'){
        $next_date = date($first_data,strtotime("+180 days"));
        }else if($due_type == '4'){
        $next_date = date($first_data,strtotime("+365 days"));
        }else{
            echo 'hello';
        }
        // print_r($next_date);
        // die();
        if($today >= $first_data && $today == $next_date){
        $emailContent='<div class="row">
                        <div class="col-sm-10">
                            <p>Dear '.$data['customer_name'].'</p>
                            <p>Here is an attachment of invoice for the services you are having from CA Associates. Kindly submit the invoice amount having invoice no (<strong> '.$data['invoice_number'].' </strong>) with amount Rs.'.$data['grant_total'].' </p><br><br>
                            <p>Regards</p><br>
                            <p>CA Associates</p><br>
                            <p>Head Office: Ground Floor S-III/159/B, Sector-B, Kanpur Road, Lucknow-12 (U.P.)</p><br>
                            <p>info@caassociate.com</p>
                         </div>
                        </div>';
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'caassociate.com';
        $config['smtp_port']    = 587;
        //$config['smtp_timeout'] = '60';
        $config['smtp_user']    = 'info@caassociate.com';
        $config['smtp_pass']    = 'teB.Su5*k4K7';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $config['validation'] = TRUE;
        $this->load->library('email', $config);
        echo $atch=$this->print_item($id);//base_url().'admin/Mypdf/print_item/'.$id;
        $this->email->attach($atch);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $this->email->set_mailtype("html");
        $this->email->from('info@caassociate.com','CA Associates');
        // $this->email->to($data['email']);
        // $this->email->to('heeramishra22@gmail.com');
        $this->email->to('khannasir111786@gmail.com');
        $this->email->cc('singhm628@gmail.com');
        $this->email->subject('This mail is regarding invoice.');
        $this->email->message($emailContent);
        $this->email->send();
        echo $this->email->print_debugger();
        $this->session->set_flashdata('success', 'Mail Send Successfully');
         redirect(base_url().'admin/invoice/');
        }
        else
        {
            $this->session->set_flashdata('error', 'Mail Could not send');
        }
    }
    
    public  function print_item($id='')
    {
        $data['invoicelist']=$this->db->get_where('tbl_due_invoice',['user_id'=>$id])->result();
        $data['invoice'] = $this->db->get_where('tbl_invoice',['id'=>$id])->row();
        $html=$this->load->view('admin/mypdf',$data,true);
        $mpdf = new \Mpdf\Mpdf();
        // echo $html;
        $mpdf->WriteHTML($html);
        $path=FCPATH.'uploads/'.$data['invoice']->customer_name.'-'.date('ymdhis').'_invoice.pdf';
        $mpdf->Output($path); 
        return $path;
        //exit();
    }
    
}