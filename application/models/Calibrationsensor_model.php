<?php
class Calibrationsensor_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
       $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sensor_config');
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
       $this->db->where('lang', $language);
		$this->db->order_by('date', 'desc');
		$this->db->order_by('sensor_config_id', 'asc');
  		return $this->db->count_all_results();
 	}

    public function maxdata($sensor_type_id){
		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_value) as maxdata');
		$this->db->from('_sensor_log');
		$this->db->where('sensor_type_id', $sensor_type_id);
		$this->db->order_by('sensor_log_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('*');
    	$this->db->from('_sensor_config');
    	$this->db->where('sensor_config_id_map', $id);
    	//$this->db->where('lang', $lang);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_config_id) as max_order');
		$this->db->from('_sensor_config');
		//$this->db->where('lang', $lang);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_config_id) as max_id');
		$this->db->from('_sensor_config');
		$this->db->order_by('sensor_config_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "sensor_config_id"){
    		$language = $this->lang->language;
			 
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_sensor_config(null, 1);
	    	else $rows = $this->get_sensor_config($default, 1);
	    	$rows = $this->get_sensor_config(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['sensor_config_id'], $row['sensor_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_sensor_config($pageIndex = 1, $limit = 1000,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_sensor_config');
		//$this->db->distinct();
		$this->db->select('sd_sensor_config.*,sd_sensor_type.sensor_type_name,sd_sensor_type.sensor_type_id_map');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id_map = sd_sensor_config.sensor_type_id');
		//$this->db->join('_hardware', 'sd_hardware.hardware_name = sd_sensor_config.sensor_hwname');
		//$this->db->where('date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('sd_sensor_config.date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
        $this->db->where('sd_sensor_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		//$this->db->order_by('date', 'desc');
		$this->db->order_by('sensor_config_id_map', 'desc');
 
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	 
   public function getSelect_sensor_type_id($sensor_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sensor_type_id');
		$this->db->from('_sensor_config');
		$this->db->where('sensor_config_id_map', $sensor_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function getSelect_hardware_by_id($hardware_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('hardware_id');
		$this->db->from('_sensor_config');
		$this->db->where('sensor_config_id_map', $hardware_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }

   public function get_sensor_config_by_id($sensor_config_id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_config');
		$this->db->where('sensor_config_id', $sensor_config_id);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    public function all_sensor_config($sensor_type_id,$hwid) {
    	if($sensor_type_id==''){
		$sensor_type_id='1';
	}if($hwid==''){
		$hwid='1';
	}
		$language = $this->lang->language['lang'];
		$this->db->select('sd_sensor_config.*,sd_sensor_type.sensor_type_name,sd_sensor_type.sensor_type_id_map');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id_map = sd_sensor_config.sensor_type_id');
       	//$this->db->where('sd_sensor_config.sensor_type_id', $sensor_type_id);
       	$this->db->where('sd_sensor_config.status', '1');
       	$this->db->where('sd_sensor_config.hardware_id', $hwid);
       	$this->db->where('sd_sensor_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		$this->db->order_by('sensor_config_id_map', 'asc');
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}



    function count_sensor_config($sensor_config_id=null, $search_string=null, $order=null){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_config');
		if($sensor_config_id != null && $sensor_config_id != 0){
			$this->db->where('sensor_config_id', $sensor_config_id);
		}
		if($search_string){
			$this->db->like('sensor_name', $search_string);
		}
		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_sensor_config', $data);
			return $insert;
		}
		
    function store($id=0,$data,$lang){   # echo '$id='.$id;  Debug($data);die();
			if($id > 0){
					$this->db->where('sensor_config_id_map', $id);
                    $this->db->where('lang', $lang);
					$this->db->update('_sensor_config', $data);
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
					$insert = $this->db->insert('_sensor_config', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_sensor_config($sensor_config_id, $data){
		$this->db->where('sensor_config_id', $sensor_config_id);
		$this->db->update('_sensor_config', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($sensor_config_id, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('sensor_config_id', $sensor_config_id);
		$this->db->update('_sensor_config', $data);
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
		$this->db->update('_sensor_config');
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
		$this->db->update('_sensor_config');
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
		$this->db->update('_sensor_config');
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
		$this->db->update('_sensor_config');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_sensor_config($sensor_config_id, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('sensor_config_id_map', $sensor_config_id);
		$this->db->update('_sensor_config', $data);
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
         	$this->db->from('_sensor_config');
         	$this->db->where('sensor_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    
	function status_sensor_config2($sensor_config_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('sensor_config_id_map', $sensor_config_id);
		$this->db->update('_sensor_config', $data);
		#echo $this->db->last_query();
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
     
 
    function get_sensor_config_edit($sensor_config_id){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_sensor_config.sensor_config_id');
		//$this->db->select('_sensor_config.sensor_name');
		//$this->db->select('_sensor_config.lang');
		//$this->db->select('_sensor_config.order_by');
		//$this->db->select('_sensor_config.date');
		$this->db->select('sd_sensor_config.*,sd_sensor_type.sensor_type_id_map,sd_sensor_type.sensor_type_name');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id_map = sd_sensor_config.sensor_type_id');
		if($sensor_config_id != null && $sensor_config_id > 0){
			$this->db->where('sensor_config_id_map', $sensor_config_id);
		}
		#$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('sensor_name', $search_string);
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
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
    }

    function delete_sensor_config($sensor_config_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('sensor_config_id_map', $sensor_config_id);
		$this->db->update('_sensor_config', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_sensor_config_by_admin($sensor_config_id){
		$this->db->where('sensor_config_id_map',$sensor_config_id);
		$this->db->delete('_sensor_config'); 
	}
	
 
}
?>	
