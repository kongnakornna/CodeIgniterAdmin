<?php
class Emailsetting_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_email_config');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('email_setting_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
     
    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('*');
    	$this->db->from('_email_config');
    	$this->db->where('email_setting_id_map', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(email_setting_id) as max_order');
		$this->db->from('_email_config');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(email_setting_id) as max_id');
		$this->db->from('_email_config');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "email_setting_id_map"){
    		$language = $this->lang->language;
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_emailsetting(null, 1);
	    	//else $rows = $this->get_emailsetting($default, 1);
	    	$rows = $this->get_emailsetting(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['email_setting_id_map'], $row['number']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function get_emailsetting($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_email_config');
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_email_config');
		//$this->db->join('_hardware', 'sd_hardware.hardware_name = sd_email_config.sensor_hwname');
		//$this->db->where('create_date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('email_setting_id_map', 'asc');
		//$this->db->distinct('email_setting_id_map');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 //Debug($this->db->last_query());
		 //die();
		return $query->result_array();
	}

   public function get_emailsetting_by_id($email_setting_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_email_config');
		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    function count_email_config($email_setting_id_map=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_email_config');
		if($email_setting_id_map != null && $email_setting_id_map != 0){
			$this->db->where('email_setting_id_map', $email_setting_id_map);
		}
		if($search_string){
			$this->db->like('number', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_email_config', $data);
			return $insert;
		}
		
    function store($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('email_setting_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_email_config', $data);
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
					$insert = $this->db->insert('_email_config', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_email_config($email_setting_id_map, $data){

		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->update('_email_config', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($email_setting_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->update('_email_config', $data);
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
		$this->db->update('_email_config');
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
		$this->db->update('_email_config');
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
		$this->db->update('_email_config');
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
		$this->db->update('_email_config');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_email_config($email_setting_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->update('_email_config', $data);
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
         	$this->db->from('_email_config');
         	$this->db->where('email_setting_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_email_config2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->update('_email_config', $data);
		
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
     
    function delete_email_config($email_setting_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('email_setting_id_map', $email_setting_id_map);
		$this->db->update('_email_config', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_emailsettinge_edit($email_setting_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_email_config');

		if($email_setting_id_map != null && $email_setting_id_map > 0){
			$this->db->where('email_setting_id_map', $email_setting_id_map);
		}
		$query = $this->db->get();
		//Debug($this->db->last_query()); die();
		return $query->result_array();
    }

     function delete_setingworktime($email_setting_id_map){
		$this->db->where('email_setting_id_map',$email_setting_id_map);
		$this->db->delete('_email_config'); 
	}
     
	function delete_email_config_by_admin($email_setting_id_map){
		$this->db->where('email_setting_id_map',$email_setting_id_map);
		$this->db->delete('_email_config'); 
	}
 
}
?>	
