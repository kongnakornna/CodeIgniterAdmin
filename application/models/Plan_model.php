<?php
class Plan_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
       $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_plan');
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
       $this->db->where('lang', $language);
		$this->db->order_by('date', 'desc');
		$this->db->order_by('plan_id_map', 'asc');
  		return $this->db->count_all_results();
 	}

    public function maxdata($sensor_type_id){
		$language = $this->lang->language['lang'];
		$this->db->select('max(sensor_value) as maxdata');
		$this->db->from('_plan');
		$this->db->where('sensor_type_id', $sensor_type_id);
		$this->db->order_by('sensor_log_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('*');
    	$this->db->from('_plan');
    	$this->db->where('plan_id_map', $id);
    	//$this->db->where('lang', $lang);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
        
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(plan_id) as max_order');
		$this->db->from('_plan');
		//$this->db->where('lang', $lang);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){

		$language = $this->lang->language['lang'];
		$this->db->select('max(plan_id) as max_id');
		$this->db->from('_plan');
		$this->db->order_by('plan_id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function getSelect($default = 0,$name = "plan_id_map"){
    		$language = $this->lang->language;
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_plan_select(null, 1);
	    	else $rows = $this->get_plan_select($default, 1);
	    	$rows = $this->get_plan_select(null, 1);
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['plan_id_map'], $row['plan_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
  public function get_plan_select(){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_plan');
        	$this->db->where('sd_plan.lang', $language);
		$this->db->order_by('plan_id_map', 'asc'); // desc
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}
    
  public function getSelectplan($default = 0,$name = "plan_id_map"){
    		$language = $this->lang->language;
    		//debug($language);die();    		
    		$first = "--- ".$language['please_select']." ---";
	    	if($default == 0) $rows = $this->get_plan_select(null, 1);
	    	else $rows = $this->get_plan_select($default, 1);
	    	$rows = $this->get_plan_select(null, 1);
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['plan_id_map'], $row['plan_name']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
	
   public function getSelect_plan_id_map($plan_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('sensor_type_id');
		$this->db->from('_plan');
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function getSelect_plan_by_id($plan_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('plan_id_map');
		$this->db->from('_plan');
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		return $query->result_array(); 
    }
	 
   public function get_plan_by_id($plan_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_plan');
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

	
    public function get_plan($pageIndex = 1, $limit = 1000,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_plan');
		//$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_plan');
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
		$this->db->where('lang', $language);
		$this->db->order_by('plan_id_map', 'desc');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
	}


    function count_plan($plan_id_map=null, $search_string=null, $order=null){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_plan');
		if($plan_id_map != null && $plan_id_map != 0){
			$this->db->where('plan_id_map', $plan_id_map);
		}
		if($search_string){
			$this->db->like('plan_name', $search_string);
		}
		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_product($data){
		     //debug($data);Die();
			$insert = $this->db->insert('_plan', $data);
			return $insert;
		}
		
    function store($id=0,$data,$lang){   # echo '$id='.$id;  Debug($data);die();
			if($id > 0){
				    //debug($data); echo ' $id='.$id; echo ' $lang='.$lang; Die();
				     $this->db->where('lang', $lang);
					$this->db->where('plan_id_map', $id);
					$this->db->update('_plan', $data);
					
					$report = array();
					////$report['error'] = $this->db->_error_number();
					////$report['message'] = $this->db->_error_message();
					//echo $this->db->last_query();Die();
					if($report !== 0){
						return true;
					}else{
						return false;
					}					
			}else{
                    
                        //Debug($data);die();
					$insert = $this->db->insert('_plan', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_plan($plan_id_map, $data){
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->update('_plan', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($plan_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->update('_plan', $data);
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
		$this->db->update('_plan');
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
		$this->db->update('_plan');
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
		$this->db->update('_plan');
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
		$this->db->update('_plan');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_plan($plan_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->update('_plan', $data);
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
         	$this->db->from('_plan');
         	$this->db->where('plan_id_map', $id);
         	$query = $this->db->get();
         	//echo $this->db->last_query();
         	return $query->result_array();
    } 
    
	function status_plan2($plan_id_map, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->update('_plan', $data);
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
     
 
    function get_plan_edit($plan_id_map){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_plan.plan_id_map');
		//$this->db->select('_plan.plan_name');
		//$this->db->select('_plan.lang');
		//$this->db->select('_plan.order_by');
		//$this->db->select('_plan.date');
		$this->db->select('*');
		$this->db->from('_plan');
		if($plan_id_map != null && $plan_id_map > 0){
			$this->db->where('plan_id_map', $plan_id_map);
		}
		//$this->db->limit($listpage, $limit_start);
		$query = $this->db->get();
		 #Debug($this->db->last_query()); die();
		return $query->result_array();
    }

    function delete_plan($plan_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('plan_id_map', $plan_id_map);
		$this->db->update('_plan', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
	function delete_plan_by_admin($plan_id_map){
		$this->db->where('plan_id_map',$plan_id_map);
		$this->db->delete('_plan'); 
	}
	 
}
?>	
