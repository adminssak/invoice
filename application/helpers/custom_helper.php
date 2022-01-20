<?php 

if(!function_exists('is_admin_login'))
{
    function is_admin_login()
    {
       $CI=get_instance(); 
        $rest = $CI->session->userdata('is_login');
        if(empty($rest)) {
            redirect(base_url().'admin/Login/index');
        }
    }
}

?>