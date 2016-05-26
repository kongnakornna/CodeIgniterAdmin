<?php
class Countries_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('countries_name, order_by, status');
    	$this->db->from('_na_countries');
    	$this->db->where('countries_id', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }
        
    public function get_max_order(){

		$language = $this->lang->language['lang'];
        
		$this->db->select('max(order_by) as max_order');
		$this->db->from('_na_countries');
       // $this->db->where('countries_id', $countries_id);
		#$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(countries_id) as max_id');
		$this->db->from('_na_countries');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_countries_by_id($id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_na_countries');
		$this->db->where('countries_id', $id);
		//if($lang != '') $this->db->where('lang', $language);
		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object(); 
    }


    public function getSelectCountrie($default = 0,$name = "countries_id", $type = ''){
    		
    		$language = $this->lang->language;
    		
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_na_countries(null, 1);
	    	//else $rows = $this->get_na_countries($default, 1);

			if($type == '') 
				$rows = $this->get_na_countries(null, 1);
			else
				$rows = $this->get_na_countries(null, 1, $type);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['countries_id'], $row['countries_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_na_countries($countries_id=null, $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];

		$this->db->select('_na_countries.countries_id');
		$this->db->select('_na_countries.countries_name');
		$this->db->select('_na_countries.countries_iso_code_2');
		$this->db->select('_na_countries.countries_iso_code_3');
		#$this->db->select('_na_countries.order_by');
		$this->db->select('_na_countries.countries_id');
		$this->db->from('_na_countries');

		if($countries_id != null && $countries_id > 0){
			$this->db->where('countries_id', $countries_id);
		}
		/*
		if($search_string){
			$this->db->like('countries_name', $search_string);
		}
        */
        
			$this->db->where('status', 1);
		 
		#$this->db->order_by('order_by', 'Asc');
		#$this->db->limit($listpage, $limit_start);

		$query = $this->db->get();
		//$this->db->lastquery();
		//die();
		
		return $query->result_array();
    }

   public function get_na_countries_by_id($countries_id){

		//$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_na_countries');
		$this->db->where('countries_id', $countries_id);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//Debug($this->db->last_query());
		return $query->result_array(); 

    }

    function count_countries($countries_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_na_countries');
		if($countries_id != null && $countries_id != 0){
			$this->db->where('countries_id', $countries_id);
		}
		if($search_string){
			$this->db->like('countries_name', $search_string);
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
		$insert = $this->db->insert('_na_countries', $data);
	    return $insert;
	}

    function update_na_countries($countries_id, $data){

		$this->db->where('countries_id', $countries_id);
		$this->db->update('_na_countries', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($countries_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('countries_id', $countries_id);
		$this->db->update('_na_countries', $data);
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
		$this->db->update('_na_countries');
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
		$this->db->update('_na_countries');
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
		$this->db->update('_na_countries');

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
		$this->db->update('_na_countries');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_na_countries($countries_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('countries_id', $countries_id);
		$this->db->update('_na_countries', $data);
		
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


    function delete_na_countries($countries_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('countries_id', $countries_id);
		$this->db->update('_na_countries', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_na_countries_by_admin($countries_id){
		$this->db->where('countries_id', $countries_id);
		$this->db->delete('_na_countries'); 
	}
 
}
?>	
