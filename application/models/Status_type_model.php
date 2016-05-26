<?php
class Status_type_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
    }

    public function get_status($id, $lang = 1){
    
    	if($lang == 1) $language = $this->lang->language['lang'];
    	$this->db->select('status_type_name, status');
    	$this->db->from('_status_type');
    	$this->db->where('status_type_id_map', $id);
    	if($lang == 1) $this->db->where('lang', $language);

    	$query = $this->db->get();
    	//Debug($this->db->last_query());
    	return $query->result_array();
    }
        
    public function get_max_order(){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_status_type');

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(status_type_id) as max_id');
		$this->db->from('_status_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_status_type_by_id($id_map){

		//$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_status_type');
		$this->db->where('status_type_id_map', $id_map);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

    public function get_status_type($status_type_id_map=null, $search_string=null, $order = 'create_date', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		$this->db->select('_status_type.status_type_id');
		$this->db->select('_status_type.status_type_id_map');
		$this->db->select('_status_type.status_type_name');
		$this->db->select('_status_type.lang');
		//$this->db->select('_status_type.order_by');
		$this->db->select('_status_type.create_date');
		$this->db->select('_status_type.status');
		$this->db->from('_status_type');

		if($status_type_id_map != null && $status_type_id_map > 0){
			$this->db->where('status_type_id_map', $status_type_id_map);
		}

		if($status_type_id_map <= 0) $this->db->where('lang', $language);
		$this->db->where('status !=', 2);

		if($search_string){
			$this->db->like('status_type_name', $search_string);
		}

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('order_by', $order_type);
		}

		$this->db->limit($listpage, $limit_start);
		$query = $this->db->get();		
		//echo $this->db->last_query();
		
		return $query->result_array();
    }

    function count_status_type($id_map=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_status_type');
		if($id_map != null && $id_map != 0){
			$this->db->where('status_type_id_map', $id_map);
		}
		if($search_string){
			$this->db->like('status_type_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('order_by', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store($data){
		$insert = $this->db->insert('_status_type', $data);
	    return $insert;
	}

    function store_update($status_type_id, $data){

		$this->db->where('status_type_id', $status_type_id);
		$this->db->update('_status_type', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_status_type($id_map, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('status_type_id_map', $id_map);
		$this->db->update('_status_type', $data);
		
		return $this->db->last_query();
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	
	
    function delete_user($id_map){

		$data = array(
				'status' => 2
		);
		$this->db->where('status_type_id_map', $id_map);
		$this->db->update('_status_type', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_category_by_admin($id_map){
		$this->db->where('status_type_id_map', $id_map);
		$this->db->delete('_status_type'); 
	}
 
}
?>	
