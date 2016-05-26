<?php
class Hardwaretestrun_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('hardwaretestrun_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
   
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(hardwaretestrun_id) as max_order');
		$this->db->from('_hardware_testrun');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    public function get_max_id(){
		$this->db->select('max(hardwaretestrun_id) as max_id');
		$this->db->from('_hardware_testrun');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function getSelecthw($default = 0,$name = "hardwaretestrun_id"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardware_testrun(null, 1);
	    	else $rows = $this->get_hardware_testrun($default, 1);
	    	$rows = $this->get_hardware_testrun(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaretestrun_id_map'], $row['hardwaretest_name'].':'.$row['hardwaretest_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
   public function get_hardware_testrun($hardwaretestrun_id_map=null, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		$this->db->where('lang', $language);
		//$this->db->where('status', 1);
		$query = $this->db->get();
		//echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
    
    public function getSelect($default = 0,$name = "hardwaretestrun_id"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardware_testrun(null, 1);
	    	else $rows = $this->get_hardware_testrun($default, 1);
	    	$rows = $this->get_hardware_testrun(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaretestrun_id_map'], $row['hardwaretest_name'].':'.$row['hardwaretest_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
    
     public function getSelecthwmap($default = 0,$name = "hardwaretestrun_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardware_testrun(null, 1);
	    	else $rows = $this->get_hardware_testrun($default, 1);
	    	$rows = $this->get_hardware_testrun(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaretestrun_id_map'], $row['hardwaretest_name'].':'.$row['hardwaretest_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
	
    public function getSelectna($default = 0,$name = "hardwaretestrun_id_map"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_hardware_testrun(null, 1);
	    	else $rows = $this->get_hardware_testrun($default, 1);
	    	$rows = $this->get_hardware_testrun(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['hardwaretestrun_id_map'], $row['hardwaretest_name'].':'.$row['hardwaretest_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
     
   public function get_hardware_test_by_id($hardwaretestrun_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->where('lang', $language);
		$this->db->order_by('hardwaretestrun_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

   public function lists(){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		$this->db->where('lang', $language);
		$this->db->order_by('hardwaretestrun_id', 'desc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }




    public function get_hardware_test($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		//$this->db->cache_on();
		// Turn caching off for this one query
		//$this->db->cache_off();
		//$this->db->count_all('_hardware_testrun');
		//$this->db->distinct();
		$this->db->select('sd_hardware_testrun.*,sd_electricity_type.electricity_type_name,sd_waterpipe.waterpipe_name');
		$this->db->from('_hardware_testrun');
		$this->db->join('_electricity_type', 'sd_hardware_testrun.electricity_type_id_map = sd_electricity_type.electricity_type_id_map', 'left');
		$this->db->join('_waterpipe', 'sd_hardware_testrun.waterpipe_id_map = sd_waterpipe.waterpipe_id_map', 'left');
				
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('sd_electricity_type.lang', $language);
          $this->db->where('sd_hardware_test.lang', $language);
          $this->db->where('sd_waterpipe.lang', $language);

		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('hardwaretestrun_id', 'desc');
		//$this->db->distinct('hardwaretestrun_id_map');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		//Debug($this->db->last_query()); die();
		return $query->result_array();
	}
	
	
	 public function get_hardwarena($hardware_id_map=null, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		$this->db->where('lang', $language);
		$this->db->where('status', $status);
		$query = $this->db->get();
		//echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
	
	 public function get_hardwareapi($hardware_id_map, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		$this->db->where('lang', $language);
		$this->db->where('hardware_id_map', $hardware_id_map);
		//$this->db->where('status', $status);
		$this->db->limit(1);
		$query = $this->db->get();
		 #echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
	

    function count_hardware_test($hardwaretestrun_id_map=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_hardware_testrun');
		if($hardwaretestrun_id_map != null && $hardwaretestrun_id_map != 0){
			$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		}
		if($search_string){
			$this->db->like('hardwaretest_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_insertt($data){  
			$insert = $this->db->insert('_hardware_testrun', $data);
			return $insert;
		}
		
    function store_update($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('hardwaretestrun_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_hardware_testrun', $data);
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
					$insert = $this->db->insert('_hardware_testrun', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_hardware_test($hardwaretestrun_id_map, $data){

		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->update('_hardware_testrun', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($hardwaretestrun_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->update('_hardware_testrun', $data);
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
		$this->db->update('_hardware_testrun');
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
		$this->db->update('_hardware_testrun');
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
		$this->db->update('_hardware_testrun');
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
		$this->db->update('_hardware_testrun');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_hardware_testrun($hardwaretestrun_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->update('_hardware_testrun', $data);
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
    	$this->db->select('hardwaretest_name,hardwaretest_decription,status');
    	$this->db->from('_hardware_testrun');
    	$this->db->where('hardwaretestrun_id_map', $id);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
      
    public function get_status2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_hardware_testrun');
         	$this->db->where('hardwaretestrun_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	 #echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_hardware_test2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->update('_hardware_testrun', $data);
		
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
     
    function delete_hardware_testrun($hardwaretestrun_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$this->db->update('_hardware_testrun', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_hardware_test_edit($hardwaretestrun_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_hardware_testrun.hardwaretestrun_id_map');
		//$this->db->select('_hardware_testrun.hardwaretest_name');
		//$this->db->select('_hardware_testrun.lang');
		//$this->db->select('_hardware_testrun.order_by');
		//$this->db->select('_hardware_testrun.create_date');
		$this->db->select('*');
		$this->db->from('_hardware_testrun');

		if($hardwaretestrun_id_map != null && $hardwaretestrun_id_map > 0){
			$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('hardwaretest_name', $search_string);
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

 public function get_hardwaretestrun($hardwaretestrun_id_map) {
		$language = $this->lang->language['lang'];
		$this->db->select('sd_hardware_testrun.*,sd_electricity_type.electricity_type_name,sd_waterpipe.waterpipe_name');
		$this->db->from('_hardware_testrun');
		$this->db->join('_electricity_type', 'sd_hardware_test.electricity_type_id_map = sd_electricity_type.electricity_type_id_map', 'left');
		$this->db->join('_waterpipe', 'sd_hardware_testrun.waterpipe_id_map = sd_waterpipe.waterpipe_id_map', 'left');
		
          $this->db->where('sd_electricity_type.lang', $language);
          $this->db->where('sd_hardware_testrun.lang', $language);
          $this->db->where('sd_waterpipe.lang', $language);
          $this->db->where('sd_hardware_testrun.hardwaretestrun_id_map', $hardwaretestrun_id_map);
		$query = $this->db->get();
		//Debug($this->db->last_query()); die();
		return $query->result_array();
	}
 
	public function getSelect_hardware_testtype_by_id($hardwaretestrun_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardwaretestrun_id_map');
			$this->db->from('_hardware_testrun');
			$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }

 	public function getSelect_hardware_testtype_by_id2($hardwaretestrun_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardware_type_id,location_id,plan_id_map');
			$this->db->from('_hardware_testrun');
			$this->db->where('hardwaretestrun_id_map', $hardwaretestrun_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }
	    
     function delete_setingworktime($hardwaretestrun_id_map){
		$this->db->where('hardwaretestrun_id_map',$hardwaretestrun_id_map);
		$this->db->delete('_hardware_testrun'); 
	}
     
	function delete_hardware_test_by_admin($hardwaretestrun_id_map){
		$this->db->where('hardwaretestrun_id_map',$hardwaretestrun_id_map);
		$this->db->delete('_hardware_testrun'); 
	}
 
}
?>	
