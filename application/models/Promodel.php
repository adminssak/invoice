<?php 

class Promodel extends CI_Model
{
	public function login_user($username, $password)
	{
		$query=$this->db->get_where('users',array('username'=>$username,'password'=>$password))->row_array();
        return $query;
	}

	public function addItem($data)
	{
		$this->db->insert('item',$data);
		return true;
	}
	
	function get_items($id='')
{
    // $this->db->order_by("id", "asc");
    $result = $this->db->get_where('tbl_invoice',['id'=>$id])->row();
     return $result;
}
}	
