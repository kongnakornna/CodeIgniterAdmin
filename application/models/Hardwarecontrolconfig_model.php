<?php
class Hardwarecontrolconfig_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
       $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_hardwarecontrol_config');
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
       $this->db->where('lang', $language);
		//$this->db->order_by('date', 'desc');
		$this->db->order_by('hardwarecontrol_config_id', 'asc');
  		return $this->db->count_all_results();
 	}

    public function maxdata($hardwarecontrol_config_id){
		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_value) as maxdata');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('hardwarecontrol_config_id', $hardwarecontrol_config_id);
		$this->db->order_by('hardwarecontrol_config_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('*');
    	$this->db->from('_hardwarecontrol_config');
    	$this->db->where('hardwarecontrol_config_id_map', $id);
    	//$this->db->where('lang', $lang);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(hardwarecontrol_config_id) as max_order');
		$this->db->from('_hardwarecontrol_config');
		//$this->db->where('lang', $lang);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(hardwarecontrol_config_id) as max_id');
		$this->db->from('_hardwarecontrol_config');
		$this->db->order_by('hardwarecontrol_config_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "hardwarecontrol_config_id_map"){
    		$language = $this->lang->language;
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_hardware1(null, 1);
	    	else $rows = $this->get_hardware1($default, 1);
	    	$rows = $this->get_hardware1(null, 1);
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwarecontrol_config_id_map'], $row['control_name'].':'.$row['hardware_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
  public function get_hardware1(){
		$language = $this->lang->language['lang'];
		$this->db->select('sd_hardwarecontrol_config.*,sd_hardware.hardware_name');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('sd_hardwarecontrol_config.lang', $language);
        	$this->db->where('sd_hardware.lang', $language);
		$this->db->order_by('hardwarecontrol_config_id_map', 'desc');
		$query = $this->db->get();
		#Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	
	
//////////////
    public function getSelecthw1($hardwarecontrol_config_id_map = 0, $default = 0,$name = "hardwarecontrol_config_id_map"){
    
    	$language = $this->lang->language;
    	//debug($language);
    	$first = "--- ".$language['please_select'].$language['sensorconfig']." ---";

    	$rows = $this->get_getSelecthw1($hardwarecontrol_config_id_map, null, 1);
    	$opt = array();
    	$opt[]	= makeOption(0,$first);
    	for($i=0;$i<count($rows);$i++){
    		$row = @$rows[$i];
			if($row['status'] == 1) $opt[]	= makeOption($row['subcategory_id_map'], $row['subcategory_name']);
    	}
    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }


    public function get_getSelecthw1($hardwarecontrol_config_id_map=0, $subcategory_id=null, $subcat_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		$this->db->select('*');
		$this->db->from('_hardwarecontrol_config');

		if($hardwarecontrol_config_id_map != null && $hardwarecontrol_config_id_map > 0){
			$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id_map);
		}

		if($hardwarecontrol_config_id_map != null && $hardwarecontrol_config_id_map > 0){
			$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id_map);
		}
	}


    public function get_dd_list($hardwarecontrol_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sd_hardwarecontrol_config.*,sd_hardware.hardware_name');
		$this->db->from('_hardware');
		$this->db->join('_hardwarecontrol_config', 'sd_hardwarecontrol_config.hardwarecontrol_config_id=sd_hardware.hardware_id_map');
		$this->db->where('sd_hardwarecontrol_config.hardwarecontrol_config_id_map', $hardwarecontrol_config_id_map);
		$this->db->where('sd_hardwarecontrol_config.status', 1);
		$this->db->where('sd_hardwarecontrol_config.lang', $language);
		$this->db->where('sd_hardware.lang', $language);
		$query = $this->db->get();
		#Debug($this->db->last_query());
		return $query->result_object(); 
    }
////////////////
	
   public function getSelect_hardwarecontrol_config_id($hardwarecontrol_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('hardwarecontrol_config_id');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function getSelect_hardware_by_id($hardwarecontrol_config_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('hardware_id_map');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function get_hardwarecontrol_config_by_id($hardwarecontrol_config_id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('hardwarecontrol_config_id', $hardwarecontrol_config_id);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }
   public function get_hardwarecontrol_config_edit($hardwarecontrol_config_id){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwarecontrol_config');
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }
	
    public function get_hardwarecontrol_config($pageIndex = 1, $limit = 1000,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_hardware'); 
		//$this->db->distinct();
		$this->db->select('sd_hardwarecontrol_config.*,sd_hardware.hardware_name,sd_hardware.hardware_ip,sd_hardware.port,sd_hardware.hardware_id_map');
		$this->db->from('_hardwarecontrol_config');
		$this->db->join('_hardware', 'sd_hardwarecontrol_config.hardware_id_map=sd_hardware.hardware_id_map');
	
		if($startdate != null && $enddate != null){
			$this->db->where('sd_hardwarecontrol_config.date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
        	$this->db->where('sd_hardwarecontrol_config.lang', $language);
		$this->db->where('sd_hardware.lang', $language);
		//$this->db->order_by('date', 'desc');
		$this->db->order_by('sd_hardwarecontrol_config.hardwarecontrol_config_id', 'asc');
 
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		#Debug($this->db->last_query()); die();
		return $query->result_array();
	}


    public function all_hardware($hardwarecontrol_config_id,$hwid) {
    	if($hardwarecontrol_config_id==''){
		$hardwarecontrol_config_id='1';
	}if($hwid==''){
		$hwid='1';
	}
		$language = $this->lang->language['lang'];
		$this->db->select('sd_hardwarecontrol_config.*,sd_hardware.hardware_name,sd_hardware.hardware_id_map');
		$this->db->from('_hardwarecontrol_config');
		$this->db->join('_hardware', 'sd_hardware.hardware_id_map = sd_hardwarecontrol_config.hardwarecontrol_config_id');
       	//$this->db->where('sd_hardwarecontrol_config.hardwarecontrol_config_id', $hardwarecontrol_config_id);
       	$this->db->where('sd_hardwarecontrol_config.status', '1');
       	$this->db->where('sd_hardwarecontrol_config.hardware_id_map', $hwid);
       	$this->db->where('sd_hardwarecontrol_config.lang', $language);
		$this->db->where('sd_hardware.lang', $language);
		$this->db->order_by('hardwarecontrol_config_id_map', 'asc');
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}



    function count_hardware($hardwarecontrol_config_id=null, $search_string=null, $order=null){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardwarecontrol_config');
		if($hardwarecontrol_config_id != null && $hardwarecontrol_config_id != 0){
			$this->db->where('hardwarecontrol_config_id', $hardwarecontrol_config_id);
		}
		if($search_string){
			$this->db->like('control_name', $search_string);
		}
		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
		     #Debug($data);die();
			$insert = $this->db->insert('_hardwarecontrol_config', $data);
			return $insert;
		}
		
    function store($id=0,$data,$lang){    //echo '$id='.$id;  echo '$lang='.$lang;  Debug($data);die();
			if($id > 0){
					$this->db->where('lang', $lang);
					$this->db->where('hardwarecontrol_config_id_map', $id);
					$this->db->update('_hardwarecontrol_config', $data);
					
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
					$insert = $this->db->insert('_hardware', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_hardware($hardwarecontrol_config_id, $data){
		$this->db->where('hardwarecontrol_config_id', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($hardwarecontrol_config_id, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('hardwarecontrol_config_id', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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
		$this->db->update('_hardwarecontrol_config');
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
		$this->db->update('_hardwarecontrol_config');
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
		$this->db->update('_hardwarecontrol_config');
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
		$this->db->update('_hardwarecontrol_config');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_hardware($hardwarecontrol_config_id, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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
         	$this->db->from('_hardwarecontrol_config');
         	$this->db->where('hardwarecontrol_config_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    
	function status_hardwarecontrol2($hardwarecontrol_config_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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
	
/// control status////
	public function get_status_control($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_hardwarecontrol_config');
         	$this->db->where('hardwarecontrol_config_id_map', $id);
         	$query = $this->db->get();
          //echo $this->db->last_query();
         	return $query->result_array();
    } 
 	function status_control($hardwarecontrol_config_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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
/// auto////
 	function auto($hardwarecontrol_config_id, $enable = 1){

		$data['auto'] = $enable;
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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
/// control////
 	function access($hardwarecontrol_config_id, $enable = 1){

		$data['access'] = $enable;
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
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

    function get_hardware_edit($hardwarecontrol_config_id){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_hardware.hardwarecontrol_config_id');
		//$this->db->select('_hardware.control_name');
		//$this->db->select('_hardware.lang');
		//$this->db->select('_hardware.order_by');
		//$this->db->select('_hardware.date');
		$this->db->select('sd_hardwarecontrol_config.*,sd_hardware.hardware_id_map,sd_hardware.hardware_name');
		$this->db->from('_hardwarecontrol_config');
		$this->db->join('_hardware', 'sd_hardware.hardware_id_map = sd_hardwarecontrol_config.hardwarecontrol_config_id');
		if($hardwarecontrol_config_id != null && $hardwarecontrol_config_id > 0){
			$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		}
		#$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('control_name', $search_string);
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

    function delete_hardware($hardwarecontrol_config_id){

		$data = array(
				'status' => 0
		);
		$this->db->where('hardwarecontrol_config_id_map', $hardwarecontrol_config_id);
		$this->db->update('_hardwarecontrol_config', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_hardware_by_admin($hardwarecontrol_config_id){
		$this->db->where('hardwarecontrol_config_id_map',$hardwarecontrol_config_id);
		$this->db->delete('_hardwarecontrol_config'); 
	}
 
}
?>	
