<?php
class Alarmconfig_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startcreate_date=NULL,$endcreate_date= NULL){
       $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_alarm_config');
		if($startcreate_date != null && $endcreate_date != null){
			$this->db->where('create_date BETWEEN "'. $startcreate_date. '" and "'. $endcreate_date.'"');
		}
       $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('alarm_config_id', 'asc');
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
    	$this->db->from('_alarm_config');
    	$this->db->where('alarm_config_id_map', $id);
    	//$this->db->where('lang', $lang);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(alarm_config_id) as max_order');
		$this->db->from('_alarm_config');
		//$this->db->where('lang', $lang);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(alarm_config_id) as max_id');
		$this->db->from('_alarm_config');
		$this->db->order_by('alarm_config_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "alarm_config_id_map"){
    		$language = $this->lang->language;
			 
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_alarm_config(null, 1);
	    	else $rows = $this->get_alarm_config($default, 1);
	    	$rows = $this->get_alarm_config(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['alarm_config_id_map'], $row['sensor_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_alarm_config($pageIndex = 1, $limit = 1000,$startcreate_date= null,$endcreate_date= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_alarm_config');
		//$this->db->distinct(); 
		$this->db->select('sd_alarm_config.*,sd_hardware.hardware_name,sd_hardware.hardgroup_name,sd_hardware.hardware_decription,sd_hardware.hardware_id_map,sd_sensor_config.sensor_name,sd_sensor_config.sensor_warning,sd_sensor_config.sensor_high,sd_sensor_config.alert,sd_sensor_config.sensor_type_id,sd_sensor_type.sensor_type_name');
		$this->db->from('_alarm_config');
		$this->db->join('_hardware', 'sd_hardware.hardware_id_map = sd_alarm_config.hardware_id_map');
		$this->db->join('_sensor_config', 'sd_sensor_config.sensor_config_id_map = sd_alarm_config.sensor_config_id_map');
		$this->db->join('_sensor_type', 'sd_sensor_config.sensor_type_id = sd_sensor_type.sensor_type_id_map');
		//$this->db->where('create_date', $create_date); 
		if($startcreate_date != null && $endcreate_date != null){
			$this->db->where('create_date BETWEEN "'. $startcreate_date. '" and "'. $endcreate_date.'"');
		}
        	$this->db->where('sd_alarm_config.lang', $language);
		$this->db->where('sd_hardware.lang', $language);
		$this->db->where('sd_sensor_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		
		#$this->db->order_by('create_date', 'desc');
		#$this->db->order_by('alarm_config_id_map', 'desc');
 		$this->db->order_by('alarm_config_id_map', 'asc');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	 
   public function getSelect_sensor_type_id($alarm_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sensor_type_id');
		$this->db->from('_alarm_config');
		$this->db->where('alarm_config_id_map', $alarm_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function getSelect_hardware_by_id($hardware_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('hardware_id_map,sensor_config_id_map');
		$this->db->from('_alarm_config');
		$this->db->where('alarm_config_id_map', $hardware_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		#echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function getSelect_sensor_config_id_map($sensor_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sensor_config_id_map');
		$this->db->from('_alarm_config');
		$this->db->where('sensor_config_id_map', $sensor_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		#echo $this->db->last_query();die();
		return $query->result_array(); 
    }
    
    
///HW///

   public function getSelect_hardware_by_config_id_map($hardware_id_map,$sensor_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sensor_config_id_map');
		$this->db->from('_sensor_config');
		$this->db->where('hardware_id', $hardware_id_map);
		$this->db->where('sensor_config_id_map', $sensor_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		#echo $this->db->last_query();die();
		return $query->result_array(); 
    }
    
    public function getSelecthwid($hardware_id_map,$default = 0,$name = "sensor_config_id_map"){
    		$language = $this->lang->language;
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_sensor_confighwid($hardware_id_map,null, 1);
	    	else $rows = $this->get_sensor_confighwid($hardware_id_map,$default, 1);
	    	$rows = $this->get_sensor_confighwid($hardware_id_map,null, 1);
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['sensor_config_id_map'], $row['sensor_name'].':'.$row['sensor_type_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
	
////HW//	 

  	public function get_sensor_confighwid($hardware_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sd_sensor_config.*,sd_sensor_type.sensor_type_name');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_config.sensor_type_id=sd_sensor_type.sensor_type_id_map');
		$this->db->where('sd_sensor_config.hardware_id', $hardware_id_map);
		$this->db->where('sd_sensor_config.status', 1);
		$this->db->where('sd_sensor_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}

   public function get_alarm_config_by_id($alarm_config_id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_alarm_config');
		$this->db->where('alarm_config_id', $alarm_config_id);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    public function all_alarm_config($sensor_type_id,$hwid) {
    	if($sensor_type_id==''){
		$sensor_type_id='1';
	}if($hwid==''){
		$hwid='1';
	}
		$language = $this->lang->language['lang'];
		$this->db->select('sd_alarm_config.*,sd_sensor_type.sensor_type_name,sd_sensor_type.sensor_type_id_map');
		$this->db->from('_alarm_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id_map = sd_alarm_config.sensor_type_id');
       	//$this->db->where('sd_alarm_config.sensor_type_id', $sensor_type_id);
       	$this->db->where('sd_alarm_config.status', '1');
       	$this->db->where('sd_alarm_config.hardware_id', $hwid);
       	$this->db->where('sd_alarm_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		$this->db->order_by('alarm_config_id_map', 'asc');
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}



    function count_alarm_config($alarm_config_id=null, $search_string=null, $order=null){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_alarm_config');
		if($alarm_config_id != null && $alarm_config_id != 0){
			$this->db->where('alarm_config_id', $alarm_config_id);
		}
		if($search_string){
			$this->db->like('sensor_name', $search_string);
		}
		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_alarm_config', $data);
			return $insert;
		}
    function storeupdate($id=0,$data,$lang){   # echo '$id='.$id;  Debug($data);die();
    #debug($data);Die();
			if($id > 0){
					$this->db->where('alarm_config_id_map', $id);
                    	$this->db->where('lang', $lang);
					$this->db->update('_alarm_config', $data);
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
					$insert = $this->db->insert('_alarm_config', $data);
					//echo $this->db->last_query();
			}
	}	
    function store($id=0,$data,$lang){   # echo '$id='.$id;  Debug($data);die();
			if($id > 0){
					$this->db->where('alarm_config_id_map', $id);
                    $this->db->where('lang', $lang);
					$this->db->update('_alarm_config', $data);
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
					$insert = $this->db->insert('_alarm_config', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function upcreate_date_alarm_config($alarm_config_id, $data){
		$this->db->where('alarm_config_id', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function upcreate_date_order($alarm_config_id, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('alarm_config_id', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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

	function upcreate_date_orderid_to_down($order, $max){
		$this->db->set('order_by', 'order_by + 1', FALSE); 
		$this->db->where('order_by >=', $order); 
		$this->db->where('order_by <=', $max); 
		$this->db->update('_alarm_config');
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

	function upcreate_date_orderid_to_up($order, $min){

		$this->db->set('order_by', 'order_by - 1', FALSE); 
		$this->db->where('order_by >', $min); 
		$this->db->where('order_by <=', $order); 
		$this->db->update('_alarm_config');
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

	function upcreate_date_orderadd(){

		$this->db->set('order_by', 'order_by + 1', FALSE); 
		$this->db->update('_alarm_config');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function upcreate_date_orderdel($order){
		$this->db->set('order_by', 'order_by - 1', FALSE); 
		$this->db->where('order_by >', $order); 
		$this->db->update('_alarm_config');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_alarm_config($alarm_config_id, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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
         	$this->db->from('_alarm_config');
         	$this->db->where('alarm_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 

    public function status_email2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_alarm_config');
         	$this->db->where('alarm_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    public function status_sms2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_alarm_config');
         	$this->db->where('alarm_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    public function status_call2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_alarm_config');
         	$this->db->where('alarm_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    
	function status_alarm_config2($alarm_config_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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
	function status_email_sensor_config2($alarm_config_id, $enable = 1){

		$data['status_email'] = $enable;
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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
	function status_sms_sensor_config2($alarm_config_id, $enable = 1){

		$data['status_sms'] = $enable;
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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
	function status_call_sensor_config2($alarm_config_id, $enable = 1){

		$data['status_call'] = $enable;
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
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
 
    function get_alarm_config_edit($alarm_config_id){
		
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_alarm_config');
		if($alarm_config_id != null && $alarm_config_id > 0){
			$this->db->where('alarm_config_id_map', $alarm_config_id);
		}
		#$this->db->where('lang', $language);
		$query = $this->db->get();
		#Debug($this->db->last_query()); die();
		#Debug($this->db->last_query()); die();
		return $query->result_array();
    }

    function delete_alarm_config($alarm_config_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('alarm_config_id_map', $alarm_config_id);
		$this->db->update('_alarm_config', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_alarm_config_by_admin($alarm_config_id){
		$this->db->where('alarm_config_id_map',$alarm_config_id);
		$this->db->delete('_alarm_config'); 
	}
 
}
?>	
