<?php
class Memberstatus_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
    }

    public function getSelectMemberstatus($default = 0,$name = "memberstatus_id"){
    		
    		$language = $this->lang->language;    		
			//$first = "--- ".$language['please_select']." ---";
	    	$rows = $this->get_data();

			//Debug($default);
			//Debug($rows);
	    	$opt = array();
	    	//$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row->memberstatus_id, $row->memberstatus);
	    	}
	    	//return selectList( $opt, $name, 'class="chosen-select"', 'value', 'text',$default);
	    	return MultiSelectList( $opt, $name, 'class="chosen-select"', 'value', 'text', $default);
			//die();
    }

    public function get_data($memberstatus_id=null, $search_string=null, $order = 'create_date', $order_status='Asc', $limit_start = 0, $listpage = 20){
		
		$language = $this->lang->language['lang'];
		$prefix = 'sd';

		$this->db->select('*');
		$this->db->select('(SELECT admin_username FROM `'.$prefix.'_admin` WHERE `'.$prefix.'_admin`.`admin_id`='.$prefix.'_memberstatus.`create_by`) AS admin');
		$this->db->from('_memberstatus ');
		//$this->db->join('_dara_status as dt', '(dp.dara_status_id=dt.dara_status_id_map AND dt.lang="'.$language.'"');

		if($memberstatus_id != null && $memberstatus_id > 0){
			//$this->db->where('dara_profile_id_map', $dara_profile_id_map);
			$this->db->where('memberstatus_id', $memberstatus_id);
		}

		//if($dara_profile_id_map <= 0) $this->db->where('lang', $language);

		if($search_string){
			$this->db->like('memberstatus', $search_string);
		}

		if($order){
			$this->db->order_by($order, $order_status);
		}else{
		    $this->db->order_by('create_date', $order_status);
		}
		//$this->db->limit($listpage, $limit_start);
		$query = $this->db->get();		
		//Debug($this->db->last_query());
		return $query->result_object();
    }
        
    public function get_status($id){
        
    	$this->db->select('status');
    	$this->db->from('_memberstatus');
    	$this->db->where('memberstatus_id', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(memberstatus_id) as max_id');
		$this->db->from('_memberstatus');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_data_by_id($id_map){

		//$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_memberstatus');
		$this->db->where('memberstatus_id', $id_map);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

    function count_all($memberstatus_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_memberstatus');
		if($id_map != null && $id_map != 0){
			$this->db->where('memberstatus_id', $memberstatus_id);
		}
		if($search_string){
			$this->db->like('memberstatus', $search_string);
		}
		/*if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('create_date', 'Asc');
		}*/
		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store($memberstatus_id = 0, $data){

			if($memberstatus_id > 0){
					$this->db->where('memberstatus_id', $memberstatus_id);
					$this->db->update('_memberstatus', $data);
					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//echo $this->db->last_query();
						return true;
					}else{
						return false;
					}					
			}else{
					$this->db->insert('_memberstatus', $data);
					//echo $this->db->last_query();
					$insert = $this->db->insert_id();
					return $insert;
			}
	}

	function status_memberstatus($id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('memberstatus_id', $id);
		$this->db->update('_memberstatus', $data);
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
	
    function delete_data($memberstatus_id){
		$data = array(
				'status' => 2
		);
		$this->db->where('memberstatus_id', $memberstatus_id);
		$this->db->update('_memberstatus', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_by_admin($memberstatus_id){
		$this->db->where('memberstatus_id', $memberstatus_id);
		$this->db->delete('_memberstatus'); 
	}
 
}
?>	
