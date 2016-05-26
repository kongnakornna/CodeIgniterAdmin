<?php
class Setingeventalarm_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_condition_type');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('time_id2', 'asc');
  		return $this->db->count_all_results();
 	}
     
    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('time_condition_name, status');
    	$this->db->from('_condition_type');
    	$this->db->where('time_id2', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(time_id2) as max_order');
		$this->db->from('_condition_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(time_id2) as max_id');
		$this->db->from('_condition_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "time_id2"){
    		$language = $this->lang->language;
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_condition_type(null, 1);
	    	//else $rows = $this->get_condition_type($default, 1);
	    	$rows = $this->get_condition_type(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['time_id2'], $row['time_condition_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_condition_type($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_condition_type');
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_condition_type');
		//$this->db->join('_hardware', 'sd_hardware.hardware_name = sd_condition_type.sensor_hwname');
		//$this->db->where('create_date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('time_id2', 'asc');
		//$this->db->distinct('time_id2');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 //Debug($this->db->last_query());
		 //die();
		return $query->result_array();
	}

   public function get_condition_type_by_id($time_id2){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_condition_type');
		$this->db->where('time_id2', $time_id2);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    function count_condition_type($time_id2=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_condition_type');
		if($time_id2 != null && $time_id2 != 0){
			$this->db->where('time_id2', $time_id2);
		}
		if($search_string){
			$this->db->like('time_condition_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_condition_type', $data);
			return $insert;
		}
		
    function store($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('time_id2', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_condition_type', $data);
					$report = array();
					////$report['error'] = $this->db->_error_number();
					////$report['message'] = $this->db->_error_message();
					if($report !== 0){
						return true;
					}else{
						return false;
					}					
			}else{
                    
                        //Debug($data);die();
					$insert = $this->db->insert('_condition_type', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_condition_type($time_id2, $data){

		$this->db->where('time_id2', $time_id2);
		$this->db->update('_condition_type', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($time_id2, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('time_id2', $time_id2);
		$this->db->update('_condition_type', $data);
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
		$this->db->update('_condition_type');
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
		$this->db->update('_condition_type');
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
		$this->db->update('_condition_type');
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
		$this->db->update('_condition_type');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_condition_type($time_id2, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('time_id2', $time_id2);
		$this->db->update('_condition_type', $data);
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

    public function get_status2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_condition_type');
         	$this->db->where('time_id2', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_condition_type2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('time_id2', $time_id2);
		$this->db->update('_condition_type', $data);
		
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
     
    function delete_condition_type($time_id2){

		$data = array(
				'status' => 2
		);
		$this->db->where('time_id2', $time_id2);
		$this->db->update('_condition_type', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_condition_typee_edit($time_id2=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_condition_type.time_id2');
		//$this->db->select('_condition_type.time_condition_name');
		//$this->db->select('_condition_type.lang');
		//$this->db->select('_condition_type.order_by');
		//$this->db->select('_condition_type.create_date');
		$this->db->select('*');
		$this->db->from('_condition_type');

		if($time_id2 != null && $time_id2 > 0){
			$this->db->where('time_id2', $time_id2);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('time_condition_name', $search_string);
		}*/
		/*
		if($_status){

			$this->db->where('status', $_status);
		}
		*/
		/*if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('order_by', $order_type);
		}*/
		//$this->db->limit($listpage, $limit_start);
		$query = $this->db->get();
		//Debug($this->db->last_query());
		//die();
		return $query->result_array();
    }

     function delete_setingworktime($time_id2){
		$this->db->where('time_id2',$time_id2);
		$this->db->delete('_condition_type'); 
	}
     
	function delete_condition_type_by_admin($time_id2){
		$this->db->where('time_id2',$time_id2);
		$this->db->delete('_condition_type'); 
	}
 
}
?>	
