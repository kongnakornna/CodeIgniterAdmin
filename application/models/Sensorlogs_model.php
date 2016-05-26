<?php
class Sensorlogs_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		//$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sensor_log');
		if($startdate != null && $enddate != null){
			$this->db->where('datetime_log BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
         // $this->db->where('lang', $language);
		$this->db->order_by('sensor_log_id', 'desc');
  		return $this->db->count_all_results();
 	}
     
    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('sd_sensor_log_name, status');
    	$this->db->from('_sensor_log');
    	$this->db->where('sensor_log_id', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_log_id) as max_order');
		$this->db->from('_sensor_log');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_log_id) as max_id');
		$this->db->from('_sensor_log');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "sensor_log_id"){
    		$language = $this->lang->language;
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_sensor_log(null, 1);
	    	//else $rows = $this->get_sensor_log($default, 1);
	    	$rows = $this->get_sensor_log(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['sensor_log_id'], $row['sd_sensor_log_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_sensor_log($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_sensor_log');
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sensor_log');
		//$this->db->join('_hardware', 'sd_hardware.hardware_name = sd_sensor_log.sensor_hwname');
		if($startdate != null && $enddate != null){
			$this->db->where('datetime_log BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
         // $this->db->where('lang', $language);
		//$this->db->order_by('datetime_log', 'desc');
		$this->db->order_by('sensor_log_id', 'desc');
		//$this->db->distinct('sensor_log_id');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 //Debug($this->db->last_query());
		 //die();
		return $query->result_array();
	}

   public function get_sensor_log_by_id($sensor_log_id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_log');
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    function count_sensor_log($sensor_log_id=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_sensor_log');
		if($sensor_log_id != null && $sensor_log_id != 0){
			$this->db->where('sensor_log_id', $sensor_log_id);
		}
		if($search_string){
			$this->db->like('sd_sensor_log_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_sensor_log', $data);
			return $insert;
		}
		
    function store($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('sensor_log_id', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_sensor_log', $data);
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
					$insert = $this->db->insert('_sensor_log', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_sensor_log($sensor_log_id, $data){

		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('_sensor_log', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($sensor_log_id, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('_sensor_log', $data);
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
		$this->db->update('_sensor_log');
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
		$this->db->update('_sensor_log');
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
		$this->db->update('_sensor_log');
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
		$this->db->update('_sensor_log');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_sensor_log($sensor_log_id, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('_sensor_log', $data);
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
         	$this->db->from('_sensor_log');
         	$this->db->where('sensor_log_id', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_sensor_log2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('_sensor_log', $data);
		
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
     
    function delete_sensor_log($sensor_log_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('_sensor_log', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_sensor_loge_edit($sensor_log_id=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_sensor_log.sensor_log_id');
		//$this->db->select('_sensor_log.sd_sensor_log_name');
		//$this->db->select('_sensor_log.lang');
		//$this->db->select('_sensor_log.order_by');
		//$this->db->select('_sensor_log.datetime_log');
		$this->db->select('*');
		$this->db->from('_sensor_log');

		if($sensor_log_id != null && $sensor_log_id > 0){
			$this->db->where('sensor_log_id', $sensor_log_id);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('sd_sensor_log_name', $search_string);
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

     function delete_setingworktime($sensor_log_id){
		$this->db->where('sensor_log_id',$sensor_log_id);
		$this->db->delete('_sensor_log'); 
	}
     
	function delete_sensor_log_by_admin($sensor_log_id){
		$this->db->where('sensor_log_id',$sensor_log_id);
		$this->db->delete('_sensor_log'); 
	}
 
}
?>	
