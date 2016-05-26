<?php
class Member_type_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
    }

    public function get_status($id, $lang = 1){
    
    	if($lang == 1) $language = $this->lang->language['lang'];
    	$this->db->select('member_type_name, status');
    	$this->db->from('_member_type');
    	$this->db->where('member_type_id_map', $id);
    	if($lang == 1) $this->db->where('lang', $language);

    	$query = $this->db->get();
    	//Debug($this->db->last_query());
    	return $query->result_array();
    }
        
    public function get_max_order(){

		$language = $this->lang->language['lang'];

		$this->db->select('max(order_by) as max_order');
		$this->db->from('_member_type');

		$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(member_type_id) as max_id');
		$this->db->from('_member_type');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_member_type_by_id($id_map){

		//$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_member_type');
		$this->db->where('member_type_id_map', $id_map);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

    public function get_member_type($member_type_id_map=null, $search_string=null, $order = 'create_date', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
	    
		$this->db->select('_member_type.member_type_id');
		$this->db->select('_member_type.member_type_id_map');
		$this->db->select('_member_type.member_type_name');
		$this->db->select('_member_type.lang');
		//$this->db->select('_member_type.order_by');
		$this->db->select('_member_type.create_date');
		$this->db->select('_member_type.status');
		$this->db->from('_member_type');

		if($member_type_id_map != null && $member_type_id_map > 0){
			$this->db->where('member_type_id_map', $member_type_id_map);
		}

		if($member_type_id_map <= 0) $this->db->where('lang', $language);
		$this->db->where('status !=', 2);

		if($search_string){
			$this->db->like('member_type_name', $search_string);
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

    function count_member_type($id_map=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_member_type');
		if($id_map != null && $id_map != 0){
			$this->db->where('member_type_id_map', $id_map);
		}
		if($search_string){
			$this->db->like('member_type_name', $search_string);
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
		$insert = $this->db->insert('_member_type', $data);
	    return $insert;
	}

    function store_update($member_type_id, $data){

		$this->db->where('member_type_id', $member_type_id);
		$this->db->update('_member_type', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function status_member_type($id_map, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('member_type_id_map', $id_map);
		$this->db->update('_member_type', $data);
		
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
		$this->db->where('member_type_id_map', $id_map);
		$this->db->update('_member_type', $data);
		
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
		$this->db->where('member_type_id_map', $id_map);
		$this->db->delete('_member_type'); 
	}
 
}
?>	
