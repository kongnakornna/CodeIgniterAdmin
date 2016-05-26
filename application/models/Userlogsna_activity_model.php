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
class Userlogsna_activity_model extends CI_Model{

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

 	public function totallogactivity($startdate=NULL,$enddate= NULL){
 		$admin_type_id=1;
          $admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
  		$this->db->select('al.*, a.admin_type_id,a.admin_username');
		$this->db->from('_admin_logactivity as al');
		$this->db->where('admin_type_id <>', $admin_type_id);
		$this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');
		$this->db->order_by('al.create_date', 'desc');
		$this->db->order_by('al.admin_log_id', 'asc');
          
          if($admin_type>=3){
           $this->db->where('a.admin_id=', $admin_id);    
          }else if($admin_type>=2){
           $this->db->where('admin_type_id <>', $admin_type_id);    
          }else{
             $this->db->where('a.admin_id!=', 1);    
          }
          
		if($startdate != NULL && $enddate != NULL){
		$this->db->where('al.create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
       return $this->db->count_all_results();
 	}

	public function view_log($pageIndex=1, $limit=NULL,$startdate=NULL,$enddate= NULL) {
		$language = $this->lang->language['lang'];
		$admin_type_id=1;
          $admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
		// Turn caching on for this one query
		$this->db->cache_on();
		$this->db->select('al.*, a.admin_type_id,a.admin_username');
		$this->db->from('_admin_logactivity as al');
		if($startdate != NULL && $enddate != NULL){
		$this->db->where('al.create_date BETWEEN "'. $startdate. '" and "'. $enddate.'"');
		}
          
          if($admin_type>=3){
           $this->db->where('a.admin_id=', $admin_id);    
          }else if($admin_type>=2){
           $this->db->where('admin_type_id <>', $admin_type_id);    
          }else{
             $this->db->where('a.admin_id!=', 1);    
          }
		
		$this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');
		$this->db->order_by('al.create_date', 'desc');
		$this->db->order_by('al.admin_log_id', 'asc');
		 
		$this->db->limit($limit, ($pageIndex - 1) * $limit);
        //Clears all existing cache files
		//$this->db->cache_delete_all();
		$query = $this->db->get();
		$this->Userlogsna_activity_model->totallogactivity($pageIndex,$limit);
		 
		//Debug($query);
		//Debug($this->db->last_query());
		//die();
		return $query->result_array();
	}
}