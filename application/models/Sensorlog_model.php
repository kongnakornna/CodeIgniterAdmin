<?php
class Sensorlog_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return vosensor_log_id
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get sensorlog by his is
    * @param int $sensorlog_sensor_log_id 
    * @return array
    */
    public function get_sensorlog_by_sensor_log_id($sensor_log_id)
    {
		$this->db->select('*');
		$this->db->from('sd_sensor_log');
		//$this->db->where('sensor_log_id', $sensor_log_id);
		//$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch sensorlogs data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_sensor_log_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_sensorlogs($sensor_log_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('*');
		$this->db->from('sd_sensor_log');
		if($search_string){
			$this->db->like('sensor_hwname', $sensor_hwname);
		}
		  $this->db->join('sd_sensor_type', 'sd_sensor_type.sensor_type = sd_sensor_log.sensor_type');
		  $this->db->join('sd_hardware', 'sd_hardware.hardware_name = sd_sensor_log.sensor_hwname', 'left');

		$this->db->group_by('sd_sensor_type.sensor_type');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('sensor_log_id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');
		//$this->db->limit('1', '100');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $manufacture_sensor_log_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_sensorlog($id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('sd_sensor_log');
		if($search_string){
			$this->db->like('sensor_name', $sensor_name);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('sensor_log_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_sensorlog($data)
    {
		$insert = $this->db->insert('sensorlogs', $data);
	    return $insert;
	}

    /**
    * Update sensorlog
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_sensorlog($sensor_log_id, $data)
    {
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->update('sd_sensor_log', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete sensorlog
    * @param int $sensor_log_id - sensorlog sensor_log_id
    * @return boolean
    */
	function delete_sensorlog($sensor_log_id){
		$this->db->where('sensor_log_id', $sensor_log_id);
		$this->db->delete('sd_sensor_log'); 
	}
 
}
?>	
