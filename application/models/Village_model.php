<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Village_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('*');
    	$this->db->from('_na_village');
    	$this->db->where('village_id_map', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order($village_id){

		$language = $this->lang->language['lang'];

		$this->db->select('max(village_id_map) as max_order');
		$this->db->from('_na_village');

		if($village_id > 0) $this->db->where('village_id', $village_id);

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(village_id_map) as max_id');
		$this->db->from('_na_village');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function village_count_id($district_id ,$language=''){
    $language = $this->lang->language['lang'];
    $this->db->select('*');
    $this->db->from('_na_village');
    $this->db->where('district_id', $district_id);
    $this->db->where('lang', $language);
    $query = $this->db->get();
	#Debug($this->db->last_query());
		return $query->num_rows(); 
}


  public function zipcode_count_id($district_id){
    $language = $this->lang->language['lang'];
    $this->db->select('*');
    $this->db->from('_na_zipcode');
    $this->db->where('district_id', $district_id);
    $query = $this->db->get();
	 //Debug($this->db->last_query());
	return $query->result_object(); 
 }

   public function get_village_id_map($lang){

		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_na_village');
		$this->db->where('lang', $language);
		$this->db->order_by('village_id desc');
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }
    
    public function getSelectVillage($village_id = 0, $default = 0,$name = "village_id"){
    
    	$language = $this->lang->language;
    	//debug($language);
    	$first = "--- ".$language['please_select']." ---";

    	$rows = $this->get_village($village_id, null, 1);
    	$opt = array();
    	$opt[]	= makeOption(0,$first);
    	for($i=0;$i<count($rows);$i++){
    		$row = @$rows[$i];
    		$opt[]	= makeOption($row['village_id_map'], $row['province_name']);
    	}
    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }

    public function get_village($districe_id_map,$village_id=0, $village_id=null, $status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 2000000000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_village');
        $this->db->where('district_id', $districe_id_map);
		if($village_id != null && $village_id > 0){
			$this->db->where('village_id', $village_id);
		}

		if($village_id != null && $village_id > 0){
			$this->db->where('village_id', $village_id);
		}

		$this->db->where('lang', $language);
	    
		if($status){
			$this->db->where('status', $status);
		}		
/*
		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('order_by', $order_type);
		}
*/
		$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		 // echo $this->db->last_query();
		 // die();		
		return $query->result_array();
    }

    public function get_dd_list($village_id, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_village');

		$this->db->where('village_id', $village_id);
		$this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
//////////////////

    public function get_village_by_id($village_id_map, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_village');

		$this->db->where('village_id_map', $village_id_map);
		//$this->db->where('village_id', $village_id);

		if($lang != '') $this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
/////////////////

public function village($order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 10000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_village');
        $this->db->where('lang', $language);

		$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		//echo $this->db->last_query();
		//die();		
		return $query->result_array();
    }
    
 function get_village_count_id($districe_id_map){

		$this->db->select('*');
		$this->db->from('_na_village');
		if($districe_id_map != null && $districe_id_map != 0){
			$this->db->where('province_id', $districe_id_map);
		}
		 
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('order_by', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    
    function count_products($village_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_village');
		if($village_id != null && $village_id != 0){
			$this->db->where('village_id', $village_id);
		}
		if($search_string){
			$this->db->like('province_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('order_by', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store_product($data){
		$insert = $this->db->insert('_na_village', $data);
	    return $insert;
	}

    function update_village($village_id, $data){
         //Debug($data);Die();
		$this->db->where('village_id', $village_id);
		$this->db->update('_na_village', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	 



	function update_order($village_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('village_id_map', $village_id);
		$this->db->update('_na_village', $data);
		//Debug($this->db->last_query());

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_orderid_to_down($order, $max){

		$this->db->set('order_by', 'order_by + 1', FALSE); 
		$this->db->where('order_by >=', $order); 
		$this->db->where('order_by <=', $max); 
		$this->db->update('_na_village');
		//Debug($this->db->last_query());

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	

	function update_orderid_to_up($order, $min){

		$this->db->set('order_by', 'order_by - 1', FALSE); 
		$this->db->where('order_by >', $min); 
		$this->db->where('order_by <=', $order); 
		$this->db->update('_na_village');
		//Debug($this->db->last_query());

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_orderadd(){

		$this->db->set('order_by', 'order_by + 1', FALSE); 
		$this->db->update('_na_village');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_orderdel($order){

		$this->db->set('order_by', 'order_by - 1', FALSE); 
		$this->db->where('order_by >', $order); 
		$this->db->update('_na_village');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_village($village_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('village_id_map', $village_id);
		$this->db->update('_na_village', $data);
		
		//echo $this->db->last_query();
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	
	
    function delete_province($village_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('village_id_map', $village_id);
		$this->db->update('_na_village', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_village($village_id){
		$this->db->where('village_id_map', $village_id);
		$this->db->delete('_na_village'); 
	}
	function delete_village_by_admin($village_id){
		//echo '$village_id=',$village_id;die();
		$this->db->where('village_id_map', $village_id);
		$this->db->delete('_na_village'); 
	}
 
}
?>	
