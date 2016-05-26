<?php
class District_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('*');
    	$this->db->from('_na_district');
    	$this->db->where('district_id_map', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order($district_id = 0){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_na_district');

		if($district_id > 0) $this->db->where('district_id', $district_id);

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(district_id) as max_id');
		$this->db->from('_na_district');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function district_count_id($amphur_id){
    $language = $this->lang->language['lang'];
    $this->db->select('amphur_id');
    $this->db->from('_na_district');
    $this->db->where('amphur_id', $amphur_id);
    $this->db->where('lang', $language);
    $query = $this->db->get();
	//Debug($this->db->last_query());
		return $query->num_rows(); 
}

    public function getSelectDistrict($district_id = 0, $default = 0,$name = "district_id"){
    
    	$language = $this->lang->language;
    	//debug($language);
    	$first = "--- ".$language['please_select']." ---";

    	$rows = $this->get_district($district_id, null, 1);
    	$opt = array();
    	$opt[]	= makeOption(0,$first);
    	for($i=0;$i<count($rows);$i++){
    		$row = @$rows[$i];
    		$opt[]	= makeOption($row['district_id_map'], $row['province_name']);
    	}
    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }

    public function get_district($districe_id_map,$district_id=0, $district_id=null, $status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 2000000000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_district');
        $this->db->where('amphur_id', $districe_id_map);
		if($district_id != null && $district_id > 0){
			$this->db->where('district_id', $district_id);
		}

		if($district_id != null && $district_id > 0){
			$this->db->where('district_id', $district_id);
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
		//echo $this->db->last_query();
		//die();		
		return $query->result_array();
    }

    public function get_dd_list($district_id, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_district');

		$this->db->where('district_id', $district_id);
		$this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
//////////////////

    public function get_district_by_id($district_id_map, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_district');

		$this->db->where('district_id_map', $district_id_map);
		//$this->db->where('district_id', $district_id);

		if($lang != '') $this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
/////////////////

public function district($order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 10000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_district');
        $this->db->where('lang', $language);

		$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		//echo $this->db->last_query();
		//die();		
		return $query->result_array();
    }

 function get_district_count_id($districe_id_map){

		$this->db->select('*');
		$this->db->from('_na_district');
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
    
    
    function count_products($district_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_district');
		if($district_id != null && $district_id != 0){
			$this->db->where('district_id', $district_id);
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
		$insert = $this->db->insert('_province', $data);
	    return $insert;
	}

    function update_district($district_id, $data){

		$this->db->where('district_id', $district_id);
		$this->db->update('_na_district', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($district_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('district_id_map', $district_id);
		$this->db->update('_na_district', $data);
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
		$this->db->update('_na_district');
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
		$this->db->update('_na_district');
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
		$this->db->update('_na_district');

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
		$this->db->update('_na_district');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_district($district_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('district_id_map', $district_id);
		$this->db->update('_na_district', $data);
		
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
	
    function delete_province($district_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('district_id_map', $district_id);
		$this->db->update('_na_district', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_district_by_admin($district_id){
		$this->db->where('district_id', $district_id);
		$this->db->delete('_na_district'); 
	}
 
}
?>	
