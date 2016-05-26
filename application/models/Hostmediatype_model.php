<?php
class Hostmediatype_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_host_media_type');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('host_media_type_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
     
    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('host_media_type_name, status');
    	$this->db->from('_host_media_type');
    	$this->db->where('host_media_type_id_map', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(host_media_id) as max_order');
		$this->db->from('_host_media_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(host_media_id) as max_id');
		$this->db->from('_host_media_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "host_media_type_id_map"){
    		$language = $this->lang->language;
    		//debug($language); /die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	//if($default == 0) $rows = $this->get_dd_list(null, 1);
	    	//else $rows = $this->get_dd_list($default, 1);
	    	$rows = $this->get_dd_list(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['host_media_type_id_map'], $row['host_media_type_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
    public function get_dd_list($host_media_type_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_host_media_type');
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		#Debug($this->db->last_query());
		return $query->result_object(); 
    }
     
   public function get_host_media_type_by_id($host_media_type_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_host_media_type');
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    public function get_host_media_type($pageIndex = 1, $limit=100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_sensor_config');
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_host_media_type');

		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
         $this->db->where('lang', $language);
		//$this->db->order_by('date', 'desc');
		$this->db->order_by('host_media_type_id_map', 'desc');
 
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}


    function count_host_media_type($host_media_type_id_map=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_host_media_type');
		if($host_media_type_id_map != null && $host_media_type_id_map != 0){
			$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		}
		if($search_string){
			$this->db->like('host_media_type_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
			$insert = $this->db->insert('_host_media_type', $data);
			return $insert;
		}
		
    function store($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('host_media_type_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_host_media_type', $data);
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
					$insert = $this->db->insert('_host_media_type', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_host_media_type($host_media_type_id_map, $data){

		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->update('_host_media_type', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($host_media_type_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->update('_host_media_type', $data);
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
		$this->db->update('_host_media_type');
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
		$this->db->update('_host_media_type');
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
		$this->db->update('_host_media_type');
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
		$this->db->update('_host_media_type');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_host_media_type($host_media_type_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->update('_host_media_type', $data);
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
         	$this->db->from('_host_media_type');
         	$this->db->where('host_media_type_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('host_media_type_id_map', $id);
		$this->db->update('_host_media_type', $data);
		
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
     
    function delete_host_media_type($host_media_type_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->update('_host_media_type', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_host_media_typee_edit($host_media_type_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_host_media_type.host_media_type_id_map');
		//$this->db->select('_host_media_type.host_media_type_name');
		//$this->db->select('_host_media_type.lang');
		//$this->db->select('_host_media_type.order_by');
		//$this->db->select('_host_media_type.create_date');
		$this->db->select('*');
		$this->db->from('_host_media_type');

		if($host_media_type_id_map != null && $host_media_type_id_map > 0){
			$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('host_media_type_name', $search_string);
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

     function delete_hardwaretype($host_media_type_id_map){
		
		$language = $this->lang->language['lang'];
	    	$data['status'] = $enable;
		$this->db->where('host_media_type_id_map', $host_media_type_id_map);
		$this->db->update('_host_media_type', $data);
		
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
     
	function delete_hardwaretype_by_admin($host_media_type_id_map){
		$this->db->where('host_media_type_id_map',$host_media_type_id_map);
		$this->db->delete('_host_media_type'); 
	}
 
    
    public function getSelectHardwaretype($default = 0,$name = "host_media_type_id_map"){
    		$language = $this->lang->language;

    		//debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_Hardwaretype(null, 1);
	    	else $rows = $this->get_Hardwaretype($default, 1);
	    	$rows = $this->get_Hardwaretype(null, 1);
	    	
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['host_media_type_id_map'], $row['host_media_type_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
    
    
     public function get_Hardwaretype() {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_host_media_type');
		$this->db->where('lang', $language);
		$this->db->order_by('host_media_type_id_map', 'desc');
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	
	
//////////////
 public function  selecthardwaretype($default = 0,$name = "plan_id_map"){
    		$language = $this->lang->language;
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->hardwaretype_select(null, 1);
	    	else $rows = $this->hardwaretype_select($default, 1);
	    	$rows = $this->hardwaretype_select(null, 1);
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['host_media_type_id_map'], $row['host_media_type_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
    
    
  public function  hardwaretype_select(){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_host_media_type');
        	$this->db->where('lang', $language);
		$this->db->order_by('host_media_type_id_map', 'asc'); // desc
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	
	
//////////////	
	
}
?>	
