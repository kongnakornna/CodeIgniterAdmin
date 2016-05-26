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
class Adminna_log_activity_model extends CI_Model{

    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_max_id(){

		$this->db->select('max(admin_log_id) as max_id');
		$this->db->from('_admin_logactivity');
		$query = $this->db->get();
		return $query->result_array(); 

    }
    
 	public function cleardataall(){
          $admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
          if( $admin_type==1 && $admin_id==1){
			$this->db->from('_admin_logactivity');  
			$this->db->truncate(); 
		}
       return $this->db->count_all_results();
 	}

 	public function totallogactivity($startdate=NULL,$enddate= NULL){
          $admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
  		$this->db->select('al.*, a.admin_type_id,a.admin_username');
		$this->db->from('_admin_logactivity as al');
		$this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');
          if($admin_id>1){
          $this->db->where('a.admin_id!=', 1); 
          }
          if($startdate != NULL && $enddate != NULL){
		$this->db->where('al.create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
		$this->db->order_by('al.admin_log_id', 'desc');
		#$this->db->order_by('al.create_date', 'desc');
		#$this->db->order_by('al.admin_log_id', 'asc');
          
       return $this->db->count_all_results();
 	}

	public function view_log($pageIndex = 1, $limit = 500,$startdate= null,$enddate= null) {
          $admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
		$language = $this->lang->language['lang'];
		// Turn caching on for this one query
		#$this->db->cache_on();
		$this->db->select('al.*, a.admin_username');
		$this->db->from('_admin_logactivity as al');
          $this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');
          
          if($admin_id>1){
          $this->db->where('a.admin_id!=', 1); 
          }
		if($startdate != null && $enddate != null){
			$this->db->where('al.create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
		$this->db->order_by('al.admin_log_id', 'desc');
		#$this->db->order_by('al.create_date', 'desc');
		#$this->db->order_by('al.admin_log_id', 'asc');
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		#$this->db->cache_delete_all();
		$query = $this->db->get();

		  #Debug($this->db->last_query());
		 //die();
		return $query->result_array();
	}
}