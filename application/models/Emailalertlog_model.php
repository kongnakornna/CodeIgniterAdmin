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
class Emailalertlog_Model extends CI_Model{

    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_max_id(){

		$this->db->select('max(mail_id) as max_id');
		$this->db->from('_sendmail_alert_log');
		$query = $this->db->get();
		return $query->result_array(); 

    }

 	public function totalemailalertlog($startdate=NULL,$enddate= NULL){
 		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sendmail_alert_log');
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
		$this->db->order_by('mail_id', 'desc');
		$this->db->distinct('mail_id');
  		return $this->db->count_all_results();
 	}

    public function get_max_order($id){
		
		$this->db->select('max(order_by) as max_order_by');
		$this->db->from('_sendmail_alert_log');
		$this->db->where('mail_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 

    }

    public function get_status($id){
    	$language = $this->lang->language['lang'];
    	$this->db->select('status');
    	$this->db->from('_sendmail_alert_log');
    	$this->db->where('mail_id', $id);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    }

	public function getemailalertlog($pageIndex = 1, $limit = 100,$startdate= null,$enddate= null) {
		$language = $this->lang->language['lang'];
		$this->db->cache_on();
		//$this->db->count_all('_sendmail_alert_log');
		$this->db->distinct();
		$this->db->select('*');
		$this->db->from('_sendmail_alert_log');
		//$this->db->join('_hardware', 'sd_hardware.hardware_name = sd_sendmail_alert_log.sensor_hwname');
		//$this->db->where('date', $date); 
		if($startdate != null && $enddate != null){
			$this->db->where('date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
		$this->db->order_by('mail_id', 'desc');
		$this->db->distinct('mail_id');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
		$this->db->cache_delete_all();
		$query = $this->db->get();

		  //Debug($this->db->last_query());
		  //die();
		return $query->result_array();
	}


	public function viewMenu($id = 0, $parent = '', $status = ''){
		$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_sendmail_alert_log');
		if($id > 0) $this->db->where('mail_id', $id);
		$this->db->order_by('order_by', 'ASC');
		$query = $this->db->get();
		//echo "<br>".$this->db->last_query();
		return $query->result_array();
	}	

    function store($mail_id = 0, $data){

			//echo "(mail_id = $mail_id)";

			if($mail_id > 0){
					$this->db->where('mail_id', $mail_id);
					$this->db->update('_sendmail_alert_log', $data);
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
					$this->db->insert('_sendmail_alert_log', $data);
					//echo $this->db->last_query();
					$insert = $this->db->insert_id();
					return $insert;
			}
	}

	function status_new($mail_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('mail_id', $mail_id);
		$this->db->update('_sendmail_alert_log', $data);
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

	function update_order($mail_id, $order = 1, $parent = 0){

		$data['order_by'] = $order;
		$this->db->where('mail_id', intval($mail_id));
		$this->db->update('_sendmail_alert_log', $data);
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


	function update_orderid_to_down($order, $max, $parent = 0){

		$this->db->set('order_by', '`order_by` + 1', FALSE); 
		$this->db->where('order_by >=', $order); 
		$this->db->where('order_by <=', $max); 
		$this->db->update('_sendmail_alert_log');
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

	function update_orderid_to_up($min, $orderto, $parent = 0){

		$this->db->set('order_by', '`order_by` - 1', FALSE); 
		$this->db->where('order_by >', intval($min)); 
		$this->db->where('order_by <=', intval($orderto)); 
		$this->db->update('_sendmail_alert_log');
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

	function update_orderadd($order = 0, $parent = 0){

		$this->db->set('order_by', '`order_by` + 1', FALSE); 
		if($order != 0) $this->db->where('order_by <', $order); 

		$this->db->update('_sendmail_alert_log');

		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function update_orderdel($order, $parent = 0){

		$this->db->set('order_by', '`order_by` - 1', FALSE); 
		$this->db->where('order_by >', $order); 
		$this->db->update('_sendmail_alert_log');

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