<?php
class Province_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('province_name, order_by, status');
    	$this->db->from('_na_province');
    	$this->db->where('province_id_map', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order($province_id = 0){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_na_province');

		if($province_id > 0) $this->db->where('province_id', $province_id);

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(province_id) as max_id');
		$this->db->from('_na_province');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function getSelectProvince($province_id = 0, $default = 0,$name = "province_id"){
    
    	$language = $this->lang->language;
    	//debug($language);
    	$first = "--- ".$language['please_select']." ---";

    	$rows = $this->get_province($province_id, null, 1);
    	$opt = array();
    	$opt[]	= makeOption(0,$first);
    	for($i=0;$i<count($rows);$i++){
    		$row = @$rows[$i];
    		$opt[]	= makeOption($row['province_id_map'], $row['province_name']);
    	}
    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }

    public function get_province($geo_id,$province_id=0, $province_id=null, $status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 2000000000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_province');
		if($geo_id ==''){
        $this->db->where('lang', $language);
        }
		
		
		if($geo_id != null && $geo_id > 0){
        $this->db->where('geo_id', $geo_id);
        }
		if($province_id != null && $province_id > 0){
			$this->db->where('province_id', $province_id);
		}

		if($province_id != null && $province_id > 0){
			$this->db->where('province_id', $province_id);
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

    public function get_dd_list($province_id, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_province');

		$this->db->where('province_id', $province_id);
		$this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
/////////////////

    public function get_province_by_id($province_id_map, $lang = ''){

		$language = $this->lang->language['lang'];
		
		$this->db->select('*');
		$this->db->from('_na_province');

		$this->db->where('province_id_map', $province_id_map);
		//$this->db->where('province_id', $province_id);

		if($lang != '') $this->db->where('lang', $language);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }
////////////////

public function province($province_id=0, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 2000000000){
		
		$language = $this->lang->language['lang'];
	     
		$this->db->select('*');
		$this->db->from('_na_province');
        $this->db->where('lang', $language);		
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

 function get_province_count_id($geo_id){

		$this->db->select('*');
		$this->db->from('_na_province');
		if($geo_id != null && $geo_id != 0){
			$this->db->where('geo_id', $geo_id);
		}
		$this->db->where('lang', $language);
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('order_by', 'Asc');
		}
		$query = $this->db->get();
		 
		return $query->num_rows();        
    }
    
    

function province_count_id($geo_id){
    $language = $this->lang->language['lang'];
    $this->db->select('province_id');
    $this->db->from('_na_province');
    $this->db->where('geo_id', $geo_id);
    $this->db->where('lang', $language);
    $query = $this->db->get();
	//Debug($this->db->last_query());
		return $query->num_rows(); 
}


    function count_products($province_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_province');
		if($province_id != null && $province_id != 0){
			$this->db->where('province_id', $province_id);
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

    function update_province($province_id, $data){

		$this->db->where('province_id', $province_id);
		$this->db->update('_na_province', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($province_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('province_id_map', $province_id);
		$this->db->update('_na_province', $data);
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
		$this->db->update('_na_province');
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
		$this->db->update('_na_province');
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
		$this->db->update('_province');

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
		$this->db->update('_province');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_province($province_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('province_id_map', $province_id);
		$this->db->update('_na_province', $data);
		
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
	
    function delete_province($province_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('province_id_map', $province_id);
		$this->db->update('_na_province', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_province_by_admin($province_id){
		$this->db->where('province_id', $province_id);
		$this->db->delete('_na_province'); 
	}
 
}
?>	
