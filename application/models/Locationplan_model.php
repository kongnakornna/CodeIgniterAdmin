<?php
class Locationplan_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_location_plan');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('location_plan_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
  
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(location_plan_id) as max_order');
		$this->db->from('_location_plan');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){
		$this->db->select('max(location_plan_id) as max_id');
		$this->db->from('_location_plan');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function getSelectlocationplan($default = 0,$name = "location_plan_id"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_location_planna(null, 1);
	    	else $rows = $this->get_location_plan($default, 1);
	    	$rows = $this->get_location_planna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['location_plan_id_map'], $row['location_plan_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
   public function get_location_planna($location_plan_id_map=null, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_location_plan');
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
    
    public function get_location_plan($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_location_plan');
		//$this->db->distinct();
		$this->db->select('sd_location_plan.*,sd_plan.plan_name,sd_plan.file');
		//$this->db->select('*');
		$this->db->from('_location_plan');
		$this->db->join('_plan', 'sd_location_plan.plan_id_map = sd_plan.plan_id_map');
		//$this->db->where('create_date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('sd_plan.lang', $language);
          $this->db->where('sd_location_plan.lang', $language);
		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('location_plan_id_map', 'desc');
		//$this->db->distinct('location_plan_id_map');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
	     #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	
    public function getSelect($default = 0,$name = "location_plan_id"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_location_planna(null, 1);
	    	else $rows = $this->get_location_planna($default, 1);
	    	$rows = $this->get_location_planna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['location_plan_id_map'], $row['location_plan_name'].':'.$row['locationplan_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
    public function getSelectna($default = 0,$name = "location_plan_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_location_planna(null, 1);
	    	else $rows = $this->get_location_planna($default, 1);
	    	$rows = $this->get_location_planna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['location_plan_id_map'], $row['location_plan_name'].':'.$row['locationplan_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }

   public function get_location_plan_by_id($location_plan_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_location_plan');
		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->where('lang', $language);
		$this->db->order_by('location_plan_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    function count_location_plan($location_plan_id_map=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_location_plan');
		if($location_plan_id_map != null && $location_plan_id_map != 0){
			$this->db->where('location_plan_id_map', $location_plan_id_map);
		}
		if($search_string){
			$this->db->like('location_plan_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_insertt($data){
			$insert = $this->db->insert('_location_plan', $data);
			return $insert;
		}
		
    function store_update($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('location_plan_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_location_plan', $data);
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
					$insert = $this->db->insert('_location_plan', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_location_plan($location_plan_id_map, $data){

		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->update('_location_plan', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($location_plan_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->update('_location_plan', $data);
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
		$this->db->update('_location_plan');
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
		$this->db->update('_location_plan');
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
		$this->db->update('_location_plan');
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
		$this->db->update('_location_plan');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_location_plan($location_plan_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->update('_location_plan', $data);
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
    	$this->db->select('*');
    	$this->db->from('_location_plan');
    	$this->db->where('location_plan_id_map', $id);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
      
    public function get_status2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_location_plan');
         	$this->db->where('location_plan_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	 #echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_location_plan2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->update('_location_plan', $data);
		
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
     
    function delete_location_plan($location_plan_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('location_plan_id_map', $location_plan_id_map);
		$this->db->update('_location_plan', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_location_plane_edit($location_plan_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_location_plan.location_plan_id_map');
		//$this->db->select('_location_plan.location_plan_name');
		//$this->db->select('_location_plan.lang');
		//$this->db->select('_location_plan.order_by');
		//$this->db->select('_location_plan.create_date');
		$this->db->select('*');
		$this->db->from('_location_plan');

		if($location_plan_id_map != null && $location_plan_id_map > 0){
			$this->db->where('location_plan_id_map', $location_plan_id_map);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('location_plan_name', $search_string);
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

 
	public function getSelect_location_by_id($location_plan_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('location_plan_id_map');
			$this->db->from('_location_plan');
			$this->db->where('location_plan_id_map', $location_plan_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }

 	public function getSelect_location_by_id2($location_plan_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('location_plan_id_map,plan_id_map');
			$this->db->from('_location_plan');
			$this->db->where('location_plan_id_map', $location_plan_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }
	    
     function delete_locationplan($location_plan_id_map){
		$this->db->where('location_plan_id_map',$location_plan_id_map);
		$this->db->delete('_location_plan'); 
	}
     
	function delete_locationplan_by_admin($location_plan_id_map){
		$this->db->where('location_plan_id_map',$location_plan_id_map);
		$this->db->delete('_location_plan'); 
	}
 
}
?>	
