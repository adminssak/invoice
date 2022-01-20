<?php
class Adminuser extends CI_model
{    

	function __construct() {
        parent::__construct();
        $this->load->database();
    }

   public function get_count() 
	{
        return $this->db->count_all("tbl_product");
    }

    public function get_product($limit, $start) 
	{
        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_product");
        return $query->result();
    }

    public function get_counts() 
	{
        return $this->db->count_all("tbl_product");
    }

    public function get_products($limit, $start) 
	{
        $this->db->limit($limit, $start);
        $this->db->where('product_type','Top-Featured');
        $query = $this->db->get("tbl_product");
        return $query->result();
    }

     
       


    public function get_category_product($limit, $start) 
	{

        $this->db->limit($limit, $start);
        $query = $this->db->get("tbl_product");
        return $query->result();
    }

	 public function select_Record($table){
	    $this->db->select('*');
		$this->db->from($table);
	    $query= $this->db->get();
		return $query->result();
	 }

	 public function select_order_Record($table){
	    $this->db->select('*');
	    $this->db->order_by("id","desc");
		$this->db->from($table);
	    $query= $this->db->get();
		return $query->result();
	 }

	 public function select_join($table, $joinTable){
	 	return $this->db->select("$table.image as p_image,$table.category,$table.sub_category,$table.product_name,$table.sell_price,$table.offer_price,$table.product_size,$table.product_color,$table.product_description,$table.product_quantity,$table.product_type,$table.product_status,$table.stock_status, $joinTable.product_category_name", "tbl_product_sub_category_name.product_sub_category_name")->from("$table")->join("$joinTable", "$table.category = $joinTable.id", "right")->get()->result();
	 }
	 public function selectRecord($table, $con){
	 	$this->db->order_by("id", "desc");
	    return $this->db->get_where($table, $con)->result_array();
	 }
	  public function selectRecords($table, $con){
	 	$this->db->order_by("id", "desc");
	 	$this->db->limit(8);
	    return $this->db->get_where($table, $con)->result_array();
	 }


	 public function select_desc_Record($table){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->limit($end_limit,$start_limit);
		$this->db->order_by("id", "desc");
	    $query= $this->db->get();
		return $query->result();
	 }

	  public function select_desc_limit_Records($table,$con){
	   	$this->db->order_by("id","desc");
		return $this->db->get_where($table, $con)->result_array();
	 }


	
 
	public function select_profile_Record($table){
	return $this->db->get_where($table, array('email' =>'deepak@gmail.com'))->row_array();
	    }



	public function select_desc_limit_Record($table, $start_limit='0',$end_limit='4'){
	    $this->db->select('*');
		$this->db->from($table);
		$this->db->order_by("id", "desc");
		$this->db->limit($end_limit,$start_limit);
	    $query= $this->db->get();
		return $query->result();
	 }







       public  function insert_Record($table,$formArray){
		return $this->db->insert($table,$formArray);
	    }

	   public function update_Record($id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update('banner',$updateArray);
	      }
       public function delete_Record($table,$id)
        {
         $this->db->where('id', $id);
         $this->db->delete($table); 
        }

       

        public function update_global_Record($table,$id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update($table,$updateArray);
	      }




	   public function update_helping_section_Record($id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update('helping_section',$updateArray);
	      }
      
       public function update_socialmedial_link_Record($id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update('socialmedia_link',$updateArray);
	      }

	   public function update_news_Record($id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update('news',$updateArray);
	      }

	    public function update_blog_Record($table,$id,$updateArray)
	      {
		$this->db->where('id',$id);
		$this->db->update($table,$updateArray);
	      }


        public function find_row($table,$id)
         {
            return $this->db->get_where($table, array('id' => $id))->row_array();
         }
      
        function get_category(){
           $query = $this->db->get('tbl_product_category_name');
            return $query;  
         }
 
       function get_time($id){
           
           
         
         $query = $this->db->query("SELECT * FROM `tbl_create_slot` WHERE find_in_set($id,`create_slot_date`)")->row();
       
         print_r($query);
         die();
         $this->db->select('*')->from('tbl_create_slot');
         $this->db->where("find_in_set(2021-09-23,create_slot_date)");
         $result = $this->db->get()->result_array();
         $hello=$this->db->last_query();
         echo $hello;
         die();
          return $query;
       }
      
      
      function get_footer(){
           $query = $this->db->get('tbl_footer_setting');
            return $query;  
         }

       public function get($id)
			{
				return $this->db->select('*')->from('products_translations')->where(['for_id'=>$id])->row();
				 ;  
			}
       

	
}
?>