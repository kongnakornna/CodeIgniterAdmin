<?php
class Calibration_model extends CI_Model{
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

 	public function total($startdate=NULL,$enddate= NULL){
          $language = $this->lang->language['lang'];
  		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_calibration');
		if($startdate != null && $enddate != null){
			$this->db->where('create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('lang', $language);
		$this->db->order_by('create_date', 'desc');
		$this->db->order_by('calibration_id_map', 'asc');
  		return $this->db->count_all_results();
 	}
  
    public function get_max_order(){
		$language = $this->lang->language['lang'];
		$this->db->select('max(calibration_id) as max_order');
		$this->db->from('_calibration');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){
		$this->db->select('max(calibration_id) as max_id');
		$this->db->from('_calibration');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function getSelect($default = 0,$name = "calibration_id"){
    		$language = $this->lang->language;
    		 //debug($language); die();    		
    		$first = "--- ".$language['please_select']." ---";
    		
	    	if($default == 0) $rows = $this->get_calibrationna(null, 1);
	    	else $rows = $this->get_calibrationna($default, 1);
	    	$rows = $this->get_calibrationna(null, 1);
	    	  
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['calibration_id_map'], $row['hardware_name'].':'.$row['hardware_decription']);
	    	}
	    	return selectList( $opt, $name, 'class="form-control"', 'value', 'text',$default);
    }
	
   public function get_calibrationna($calibration_id_map=null, $status=1) {
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_calibration');
		$this->db->where('lang', $language);
		$query = $this->db->get();
		//echo $this->db->last_query(); Die();
		return $query->result_array(); 
	}
     
   public function get_calibration_by_id($calibration_id_map){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_calibration');
		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->where('lang', $language);
		$this->db->order_by('calibration_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->result_array(); 
    }

    public function get_calibration($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		$this->db->select('sd_calibration.*,sd_hardware.hardware_id_map,sd_hardware.hardware_name,sd_hardware.hardware_decription,sd_hardware.hardgroup_name,sd_hardware.hardware_ip');
		$this->db->from('_calibration');
		$this->db->join('_hardware', 'sd_calibration.hardware_id_map=sd_hardware.hardware_id_map');
		//$this->db->where('create_date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('sd_calibration.create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          $this->db->where('sd_hardware.lang', $language);
          $this->db->where('sd_calibration.lang', $language);
		//$this->db->order_by('create_date', 'desc');
		$this->db->order_by('sd_calibration.calibration_id', 'desc');
		//$this->db->distinct('calibration_id_map');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);

		$query = $this->db->get();
		 //Debug($this->db->last_query());
		 //die();
		return $query->result_array();
	}

    function count_calibration($calibration_id_map=null, $search_string=null, $order=null){
		$this->db->select('*');
		$this->db->from('_calibration');
		if($calibration_id_map != null && $calibration_id_map != 0){
			$this->db->where('calibration_id_map', $calibration_id_map);
		}
		if($search_string){
			$this->db->like('hardware_name', $search_string);
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }
	
	function store_insertt($data){
			$insert = $this->db->insert('_calibration', $data);
			return $insert;
		}
		
    function store_update($id = 0,$lang, $data){
			if($id > 0){
					$this->db->where('calibration_id_map', $id);
                         $this->db->where('lang', $lang);
					$this->db->update('_calibration', $data);
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
					$insert = $this->db->insert('_calibration', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

    function update_calibration($calibration_id_map, $data){

		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->update('_calibration', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_order($calibration_id_map, $order = 1){
		$data['order_by'] = $order;
		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->update('_calibration', $data);
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
		$this->db->update('_calibration');
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
		$this->db->update('_calibration');
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
		$this->db->update('_calibration');
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
		$this->db->update('_calibration');
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_calibration($calibration_id_map, $enable = 1){
		$data['status'] = $enable;
		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->update('_calibration', $data);
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
    	$this->db->from('_calibration');
    	$this->db->where('calibration_id_map', $id);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    
    }
      
    public function get_status2($id){
         	$language = $this->lang->language['lang'];
          //echo $id;die();
         	$this->db->select('*');
         	$this->db->from('_calibration');
         	$this->db->where('calibration_id_map', $id);
         	$this->db->where('lang', $language);
         	$query = $this->db->get();
         	 #echo $this->db->last_query();
         	return $query->result_array();
    }
    
	function status_calibration2($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->update('_calibration', $data);
		
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
     
    function delete_calibration($calibration_id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('calibration_id_map', $calibration_id_map);
		$this->db->update('_calibration', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}



    function get_calibratione_edit($calibration_id_map=null, $_status=null, $order='order_by', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		//$this->db->select('_calibration.calibration_id_map');
		//$this->db->select('_calibration.hardware_name');
		//$this->db->select('_calibration.lang');
		//$this->db->select('_calibration.order_by');
		//$this->db->select('_calibration.create_date');
		$this->db->select('*');
		$this->db->from('_calibration');

		if($calibration_id_map != null && $calibration_id_map > 0){
			$this->db->where('calibration_id_map', $calibration_id_map);
		}

		//$this->db->where('lang', $language);
		//$this->db->where('status =', 1);

		/*if($search_string){
			$this->db->like('hardware_name', $search_string);
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

 
	public function getSelect_calibrationtype_by_id($calibration_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('calibration_id_map');
			$this->db->from('_calibration');
			$this->db->where('calibration_id_map', $calibration_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }

 	public function getSelect_calibrationtype_by_id2($calibration_id_map){
			$language = $this->lang->language['lang'];
			$this->db->select('hardware_id_map');
			$this->db->from('_calibration');
			$this->db->where('calibration_id_map', $calibration_id_map);
			$this->db->where('lang', $language);
			$query = $this->db->get();
			//echo $this->db->last_query();die();
			return $query->result_array(); 
	    }
	    
     function delete_setingworktime($calibration_id_map){
		$this->db->where('calibration_id_map',$calibration_id_map);
		$this->db->delete('_calibration'); 
	}
     
	function delete_calibration_by_admin($calibration_id_map){
		$this->db->where('calibration_id_map',$calibration_id_map);
		$this->db->delete('_calibration'); 
	}
 
}
?>	
