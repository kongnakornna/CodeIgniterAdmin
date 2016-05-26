<?php
class Amphur_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('*');
    	$this->db->from('_na_amphur');
    	$this->db->where('amphur_id_map', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order($amphur_id = 0){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_na_amphur');

		if($amphur_id > 0) $this->db->where('amphur_id', $amphur_id);

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(amphur_id) as max_id');
		$this->db->from('_na_amphur');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function getSelectProvince($amphur_id = 0, $default = 0,$name = "amphur_id"){
    
    	$language = $this->lang->language;
    	//debug($language);
    	$first = "--- ".$language['please_select']." ---";

    	$rows = $this->get_amphur($amphur_id, null, 1);
    	$opt = array();
    	$opt[]	= makeOption(0,$first);
    	for($i=0;$i<count($rows);$i++){
    		$row = @$rows[$i];
    		$opt[]	= makeOption($row['amphur_id_map'], $row['province_name']);
    	}
    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }

    public function get_amphur($amphur_id_map,$amphur_id=0, $amphur_id=null, $status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 2000000000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_amphur');
        $this->db->where('amphur_id_map', $amphur_id_map);
		if($amphur_id != null && $amphur_id > 0){
			$this->db->where('amphur_id', $amphur_id);
		}

		if($amphur_id != null && $amphur_id > 0){
			$this->db->where('amphur_id', $amphur_id);
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

    public function get_dd_list($amphur_id, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_amphur');

		$this->db->where('amphur_id', $amphur_id);
		$this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
###################

    public function get_amphur_by_id($amphur_id_map, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_amphur');

		$this->db->where('amphur_id_map', $amphur_id_map);
		//$this->db->where('amphur_id', $amphur_id);

		if($lang != '') $this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
###################

 public function amphur($limit_start = 0, $listpage = 10000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_amphur');
        $this->db->where('lang', $language);
 
		$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		//echo $this->db->last_query();
		//die();		
		return $query->result_array();
    }

 function get_amphur_count_id($amphur_id_map){

		$this->db->select('*');
		$this->db->from('_na_amphur');
		if($amphur_id_map != null && $amphur_id_map != 0){
			$this->db->where('amphur_id_map', $amphur_id_map);
		}
		 
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('order_by', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }
    
    
    function count_products($amphur_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_amphur');
		if($amphur_id != null && $amphur_id != 0){
			$this->db->where('amphur_id', $amphur_id);
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

    function update_amphur($amphur_id, $data){

		$this->db->where('amphur_id', $amphur_id);
		$this->db->update('_na_amphur', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($amphur_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('amphur_id_map', $amphur_id);
		$this->db->update('_na_amphur', $data);
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
		$this->db->update('_na_amphur');
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
		$this->db->update('_na_amphur');
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
		$this->db->update('_na_amphur');

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
		$this->db->update('_na_amphur');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_amphur($amphur_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('amphur_id_map', $amphur_id);
		$this->db->update('_na_amphur', $data);
		
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
	
    function delete_province($amphur_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('amphur_id_map', $amphur_id);
		$this->db->update('_na_amphur', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_amphur_by_admin($amphur_id){
		$this->db->where('amphur_id', $amphur_id);
		$this->db->delete('_na_amphur'); 
	}
 
}
?>	
