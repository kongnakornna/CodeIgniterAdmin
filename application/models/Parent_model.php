<?php
class Sensorlog_Model extends Model {
 
	private $tbl_parent= 'sd_sensor_log';
 
	function SensorlogModel(){
		parent::Model();
	}
 
	function count_all(){
		return $this->db->count_all($this->tbl_parent);
	}
 
	function count_all_search($searchparams){		
		$this->db->like($searchparams,'','after');		
		$this->db->from($this->tbl_parent);		
		return $this->db->count_all_results();		
	}
 
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('sensor_log_id','asc');
		return $this->db->get($this->tbl_parent, $limit, $offset);
	}
 
	function get_search_pagedlist($searchparams,$limit = 10, $offset = 0){
 
		$this->db->like($searchparams,'','after');		
 
		return $this->db->get($this->tbl_parent, $limit, $offset);
	}
 
}
?>