<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Sensorconfig_Model extends CI_Model{

    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_max_id(){

		$this->db->select('max(sensor_config_id) as max_id');
		$this->db->from('_sensor_config');
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_max_order($id){
		
		$this->db->select('max(order_by) as max_order_by');
		$this->db->from('_sensor_config');
		$this->db->where('sensor_config_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    	$this->db->select('status');
    	$this->db->from('_sensor_config');
    	$this->db->where('sensor_config_id', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }

	public function getSensorreport($id = 0,$oderby=1000){

		$language = $this->lang->language['lang'];
		$this->db->cache_on();
		//$this->db->count_all('_sensor_config');
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id = sd_sensor_config.sensor_type_id');
		//$this->db->where('datetime_log', $date); 
		$this->db->order_by('sensor_config_id', 'asc');
		//$this->db->distinct('sensor_config_id');
		$this->db->limit($oderby);
		$this->db->cache_delete_all();
		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_array();
	}

	
	public function getSensorreportwhere($id=0,$oderby=1000){

		$language = $this->lang->language['lang'];
		$this->db->cache_on();
		//$this->db->count_all('_sensor_config');
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id = sd_sensor_config.sensor_type_id');
		$this->db->where('sensor_config_id', $id); 
		$this->db->order_by('sensor_config_id', 'asc');
		$this->db->limit($oderby);
		$this->db->cache_delete_all();
		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_array();
	}
	

	public function viewMenu($id = 0, $parent = '', $status = ''){

		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_config');

		if($id > 0) $this->db->where('sensor_config_id', $id);
		$this->db->order_by('order_by', 'ASC');
		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();
		return $query->result_array();
	}	

    function store($sensor_config_id = 0, $data){

			//echo "(sensor_config_id = $sensor_config_id)";

			if($sensor_config_id > 0){
					$this->db->where('sensor_config_id', $sensor_config_id);
					$this->db->update('_sensor_config', $data);
					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//echo $this->db->last_query();
						//die();
						return true;
					}else{
						return false;
					}					
			}else{
					$this->db->insert('_sensor_config', $data);
					//echo $this->db->last_query();
					$insert = $this->db->insert_id();
					return $insert;
			}
	}

	function status_new($sensor_config_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('sensor_config_id', $sensor_config_id);
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

	function update_order($sensor_config_id, $order = 1, $parent = 0){

		$data['order_by'] = $order;
		$this->db->where('sensor_config_id', intval($sensor_config_id));
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


	function update_orderid_to_down($order, $max, $parent = 0){

		$this->db->set('order_by', '`order_by` + 1', FALSE); 
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

	function update_orderid_to_up($min, $orderto, $parent = 0){

		$this->db->set('order_by', '`order_by` - 1', FALSE); 
		$this->db->where('order_by >', intval($min)); 
		$this->db->where('order_by <=', intval($orderto)); 
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

	function update_orderadd($order = 0, $parent = 0){

		$this->db->set('order_by', '`order_by` + 1', FALSE); 
		if($order != 0) $this->db->where('order_by <', $order); 

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


 public function get_sensorconfig($sensor_config_id=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_config');

		if($sensor_config_id != null && $sensor_config_id > 0){
			$this->db->where('sensor_config_id', $sensor_config_id);
	
		$query = $this->db->get();
		 //Debug($this->db->last_query());
		 //die();
		
		return $query->result_array();
    }
 }

	function update_orderdel($order, $parent = 0){

		$this->db->set('order_by', '`order_by` - 1', FALSE); 
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

}