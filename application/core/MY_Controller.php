<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	
	public function doUpload($input,$dir){

		$uploadPath=FCPATH.'/uploads/'.$dir;
		if (!file_exists($uploadPath)) {
		    mkdir($uploadPath, 0777, TRUE);
		}
        $config['upload_path']="./uploads/".$dir;
        $config['allowed_types']='gif|jpg|png|jpeg';
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload($input)){
        $data = $this->upload->data();
        $result=array('status'=>1,'file_name' =>$data['file_name']);
        }else{
        $result=array('status'=>0,'file_name' =>$this->upload->display_errors());
        }
        return $result;
    }

    public function removeFile($file,$dir)
    {   
        $url=FCPATH .'uploads/'.$dir.'/'.$file;
        if(file_exists($url))
        {
            @unlink($url);
        }
    }
}

?>