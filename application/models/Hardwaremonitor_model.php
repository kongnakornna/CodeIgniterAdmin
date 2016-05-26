<?php
class Hardwaremonitor_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_hardwaremonitor');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('hardwaremonitor_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
  
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(hardwaremonitor_id) as max_order');
		$this->db->from('_hardwaremonitor');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){
		$this->db->select('max(hardwaremonitor_id) as max_id');
		$this->db->from('_hardwaremonitor');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function getSelecthw($default = 0,$name = "hardwaremonitor_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardwaremonitorna(null, 1);
	    	else $rows = $this->get_hardwaremonitorna($default, 1);
	    	$rows = $this->get_hardwaremonitorna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaremonitor_id_map'], $row['hardwaremonitor_name'].':'.$row['hardwaremonitor_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
   public function get_hardwaremonitorna($hardwaremonitor_id_map=null, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwaremonitor');
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
    
    public function getSelect($default = 0,$name = "hardwaremonitor_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardwaremonitorna(null, 1);
	    	else $rows = $this->get_hardwaremonitorna($default, 1);
	    	$rows = $this->get_hardwaremonitorna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaremonitor_id_map'], $row['hardwaremonitor_name'].':'.$row['hardwaremonitor_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
	
    public function getSelectna($default = 0,$name = "hardwaremonitor_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardwaremonitorna(null, 1);
	    	else $rows = $this->get_hardwaremonitorna($default, 1);
	    	$rows = $this->get_hardwaremonitorna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaremonitor_id_map'], $row['hardwaremonitor_name'].':'.$row['hardwaremonitor_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
   public function get_hardwaremonitor_by_id($hardwaremonitor_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwaremonitor');
		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->where('lang', $language);
		$this->db->order_by('hardwaremonitor_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }
    
       public function getSelect_monitortype_by_id($hardwaremonitor_type_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwaremonitor');
		$this->db->where('hardwaremonitor_type_id_map', $hardwaremonitor_type_id_map);
		$this->db->where('lang', $language);
		$this->db->order_by('hardwaremonitor_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }
    
    
    public function total_sensor_config($id){
          $language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sensor_config');
          $this->db->where('hardware_id', $id);
          $this->db->where('lang', $language);
		$this->db->order_by('sensor_config_id', 'asc');
  		return $this->db->count_all_results();
 	}
    public function get_sensor_configvv($id) {
		$language = $this->lang->language['lang'];
		$this->db->select('sd_sensor_config.*,sd_sensor_type.sensor_type_name,sd_sensor_type.sensor_type_id_map');
		$this->db->from('_sensor_config');
		$this->db->join('_sensor_type', 'sd_sensor_type.sensor_type_id_map = sd_sensor_config.sensor_type_id');
		$this->db->where('sd_sensor_config.hardware_id', $id);
          $this->db->where('sd_sensor_config.lang', $language);
		$this->db->where('sd_sensor_type.lang', $language);
		$this->db->order_by('sensor_config_id_map', 'asc');
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}

    public function get_hardwaremonitor($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_hardwaremonitor');
		$this->db->distinct();
		$this->db->select('sd_hardwaremonitor.*,sd_hardwaremonitor_type.hardwaremonitor_type_name,sd_hardware.hardware_name,sd_hardware.hardware_type_id');
		$this->db->from('_hardwaremonitor');
		$this->db->join('_hardwaremonitor_type', 'sd_hardwaremonitor.hardwaremonitor_type_id_map = sd_hardwaremonitor_type.hardwaremonitor_type_id_map');
		$this->db->join('_hardware', 'sd_hardwaremonitor.hardware_id_map = sd_hardware.hardware_id_map');
		//$this->db->where('create_date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('sd_hardwaremonitor_type.lang', $language);
          $this->db->where('sd_hardwaremonitor.lang', $language);
		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('hardwaremonitor_id_map', 'asc');
		//$this->db->distinct('hardwaremonitor_id_map');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
 		#Debug($this->db->last_query()); die();
		return $query->result_array();
	}

    function count_hardwaremonitor($hardwaremonitor_id_map=null, $search_string=null, $order=null){
		$this->db->select('sd_hardwaremonitor.*,sd_hardware_type.hardware_type_id_map');
		$this->db->from('_hardwaremonitor');
		if($hardwaremonitor_id_map != null && $hardwaremonitor_id_map != 0){
			$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		}
		if($search_string){
			$this->db->like('hardwaremonitor_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_insertt($data){
			$insert = $this->db->insert('_hardwaremonitor', $data);
			return $insert;
		}
		
    function store_update($id = 0,$lang, $data){  #Debug($data); die();
			if($id > 0){
					$this->db->where('hardwaremonitor_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_hardwaremonitor', $data);
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
					$insert = $this->db->insert('_hardwaremonitor', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_hardwaremonitor($hardwaremonitor_id_map, $data){

		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->update('_hardwaremonitor', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($hardwaremonitor_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->update('_hardwaremonitor', $data);
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
		$this->db->update('_hardwaremonitor');
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
		$this->db->update('_hardwaremonitor');
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
		$this->db->update('_hardwaremonitor');
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
		$this->db->update('_hardwaremonitor');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_hardwaremonitor($hardwaremonitor_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->update('_hardwaremonitor', $data);
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
     
    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('hardwaremonitor_name,hardwaremonitor_decription,status');
    	$this->db->from('_hardwaremonitor');
    	$this->db->where('hardwaremonitor_id_map', $id);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
      
    public function get_status2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_hardwaremonitor');
         	$this->db->where('hardwaremonitor_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	 #echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_hardwaremonitor2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->update('_hardwaremonitor', $data);
		
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
     




    function get_hardwaremonitore_edit($hardwaremonitor_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_hardwaremonitor.hardwaremonitor_id_map');
		//$this->db->select('_hardwaremonitor.hardwaremonitor_name');
		//$this->db->select('_hardwaremonitor.lang');
		//$this->db->select('_hardwaremonitor.order_by');
		//$this->db->select('_hardwaremonitor.create_date');
		$this->db->select('*');
		$this->db->from('_hardwaremonitor');

		if($hardwaremonitor_id_map != null && $hardwaremonitor_id_map > 0){
			$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('hardwaremonitor_name', $search_string);
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
	public function getSelect_hardware_by_id($hardware_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardware_id_map');
			$this->db->from('_hardwaremonitor');
			$this->db->where('hardware_id_map', $hardware_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }
 
	public function getSelect_hardwaremonitortype_by_id($hardwaremonitor_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardwaremonitor_id_map');
			$this->db->from('_hardwaremonitor');
			$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }

 	public function getSelect_hardwaremonitortype_by_id2($hardwaremonitor_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardwaremonitor_type_id_map,location_id,plan_id_map');
			$this->db->from('_hardwaremonitor');
			$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }
	  
    function delete_hardwaremonitor($hardwaremonitor_id_map){

		$data = array(
				'status' => 0
		);
		$this->db->where('hardwaremonitor_id_map', $hardwaremonitor_id_map);
		$this->db->update('_hardwaremonitor', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	} 
     function delete_hardwaremonitor22($hardwaremonitor_id_map){
		$this->db->where('hardwaremonitor_id_map',$hardwaremonitor_id_map);
		$this->db->delete('_hardwaremonitor'); 
	}
     
	function delete_hardwaremonitor_by_admin($hardwaremonitor_id_map){
		$this->db->where('hardwaremonitor_id_map',$hardwaremonitor_id_map);
		$this->db->delete('_hardwaremonitor'); 
	}
 
}
?>	
