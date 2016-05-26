<?php
class Geography_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('geo_name, order_by, status');
    	$this->db->from('_na_geography');
    	$this->db->where('geo_id_map', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order(){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_na_geography');

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(geo_id) as max_id');
		$this->db->from('_na_geography');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }
  function get_geo_by_id($geo_id){
    $language = $this->lang->language['lang'];
    $this->db->select('*');
    $this->db->from('_na_geography');
    $this->db->where('geo_id_map', $geo_id);
    $this->db->where('lang', $language);
    $query = $this->db->get();
	//Debug($this->db->last_query());
		return $query->num_rows(); 
  }

    public function getSelectGeography($default = 0,$name = "geo_id", $type = ''){
    		
    		$language = $this->lang->language;
    		
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_geography(null, 1);
	    	//else $rows = $this->get_geography($default, 1);

			if($type == '') 
				$rows = $this->get_geography(null, 1);
			else
				$rows = $this->get_geography(null, 1, $type);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['geo_id_map'], $row['geo_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_geography($geo_id=null, $geo_status=null, $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];

		$this->db->select('_na_geography.geo_id');
		$this->db->select('_na_geography.countries_id');
		$this->db->select('_na_geography.geo_id_map');
		$this->db->select('_na_geography.geo_name');
		$this->db->select('_na_geography.lang');
		
		$this->db->select('_na_geography.status');
		$this->db->from('_na_geography');

		if($geo_id != null && $geo_id > 0){
			$this->db->where('geo_id', $geo_id);
		}
		$this->db->where('lang', $language);
		$this->db->where('status !=', 2);

		/*if($search_string){
			$this->db->like('geo_name', $search_string);
		}*/

		 
		
		if($geo_status){
			$this->db->where('status', $geo_status);
		}
		

		$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		//$this->db->lastquery();
		//die();
		
		return $query->result_array();
    }

   public function get_geography_by_id($geo_id_map){

		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_na_geography');
		$this->db->where('geo_id_map', $geo_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//Debug($this->db->last_query());
		return $query->result_array(); 

    }

    function count_products($geo_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_geography');
		if($geo_id != null && $geo_id != 0){
			$this->db->where('geo_id', $geo_id);
		}
		if($search_string){
			$this->db->like('geo_name', $search_string);
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
		$insert = $this->db->insert('_na_geography', $data);
	    return $insert;
	}

    function update_geography($geo_id, $data){

		$this->db->where('geo_id', $geo_id);
		$this->db->update('_na_geography', $data);
		$report = array();
		$data['order_by'] = $order;
		$this->db->where('geo_id_map', $geo_id);
		$this->db->update('_na_geography', $data);
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
		$this->db->update('_na_geography');
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
		$this->db->update('_na_geography');
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
		$this->db->update('_na_geography');

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
		$this->db->update('_na_geography');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_geography($geo_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('geo_id_map', $geo_id);
		$this->db->update('_na_geography', $data);
		
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


    function delete_geography($geo_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('geo_id_map', $geo_id);
		$this->db->update('_na_geography', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_geography_by_admin($geo_id){
		$this->db->where('geo_id_map', $geo_id);
		$this->db->delete('_na_geography'); 
	}
 
}
?>	
