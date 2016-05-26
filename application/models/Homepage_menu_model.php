<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Homepage_menu_Model extends CI_Model{

    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_max_id(){
		$this->db->select('max(web_menu_id) as max_id');
		$this->db->from('_homepage_menu');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_order($parent = 0){
		
		$this->db->select('max(order_by) as max_order_by');
		$this->db->from('_homepage_menu');
		$this->db->where('parent', $parent);

		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('status');
    	$this->db->from('_homepage_menu');
    	$this->db->where('web_menu_id2', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	
    	return $query->result_array();
    
    }

	public function getMenu($id = 0, $parent = 0, $status = ''){

		$language = $this->lang->language['lang'];

		$this->db->select('*, (SELECT COUNT(web_menu_id) FROM `sd_homepage_menu` as hm2 WHERE hm2.`status`=1 AND hm2.`lang` = "'.$language.'" AND hm2.`parent` = hm.web_menu_id2) AS count_sub');
		$this->db->from('_homepage_menu as hm');

		if($status != '') $this->db->where('status', $status);
		if($id > 0) $this->db->where('web_menu_id2', $id);

		$this->db->where('parent', $parent);

		$this->db->where('lang', $language);

		$this->db->order_by('order_by', 'ASC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		
		return $query->result_array();
	}


	public function viewMenu($id = 0, $parent = '', $status = ''){

		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_homepage_menu');

		if($status != '') $this->db->where('status', $status);
		if($id > 0) $this->db->where('web_menu_id2', $id);

		//if($parent != '') $this->db->where('parent', $parent);
		if($parent >= 0 && $id == 0) $this->db->where('lang', $language);

		$this->db->order_by('order_by', 'ASC');

		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();
		
		return $query->result_array();
	}	

    function store($web_menu_id = 0, $data){

			//echo "(web_menu_id = $web_menu_id)";

			if($web_menu_id > 0){
					$this->db->where('web_menu_id', $web_menu_id);
					$this->db->update('_homepage_menu', $data);
					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//echo $this->db->last_query();
						//die();
						return true;
					}else{
						return false;
					}					
			}else{
					$this->db->insert('_homepage_menu', $data);
					//echo $this->db->last_query();
					$insert = $this->db->insert_id();
					return $insert;
			}
	}

	function status_new($web_menu_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('web_menu_id2', $web_menu_id);
		$this->db->update('_homepage_menu', $data);
		
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

	function update_order($web_menu_id, $order = 1){

		$data['order_by'] = $order;
		$this->db->where('web_menu_id2', $web_menu_id);
		$this->db->update('_homepage_menu', $data);
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
		$this->db->update('_homepage_menu');
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
		$this->db->update('_homepage_menu');
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
		$this->db->update('_homepage_menu');

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
		$this->db->update('_homepage_menu');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}
}