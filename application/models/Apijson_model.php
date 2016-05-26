<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Apijson_model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		}
	function get_admin_type() {
		static $query;
		$this->db->select('*');
		$query = $this->db->get('sd_admin_type');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_alertconfig() {
		static $query;
		$this->db->select('*');
		$query = $this->db->get('sd_alert_config');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}	
	function get_condition($conditionid=null) {
		if($conditionid==null){ $status='y'; }else{ $status=$conditionid;}
		static $query;  
		$query = $this->db->query("SELECT * FROM sd_condition Inner Join sd_condition_groupprerial ON sd_condition_groupprerial.condition_group_id = sd_condition.condition_group_id where sd_condition.status='$status'");
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_condition_group() {
          $language = $this->lang->language;
		static $query;
		$query = $this->db->query("SELECT * FROM sd_condition_group where status='1' and lang='en'");
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_condition_type() {
		$query = $this->db->query("SELECT * FROM sd_condition_type where lang='en'");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_email_alert_log() {
		$query = $this->db->query("SELECT * FROM sd_email_alert_log");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_email_config() {
		$query = $this->db->query("SELECT * FROM sd_email_config");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_email_lists() {
		$query = $this->db->query("SELECT * FROM sd_email_lists");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}	
	function get_general_setting() {
		$query = $this->db->query("SELECT * FROM sd_general_setting");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware() {
		$query = $this->db->query("SELECT * FROM sd_hardware Inner Join sd_hardware_type ON sd_hardware.hardware_type_id = sd_hardware_type.hardware_type_id and '' = '' Inner Join sd_location ON sd_location.location_id = sd_hardware.location_id where sd_hardware.location_id<>'' order by sd_hardware.hardware_id asc");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_access() {
		$query = $this->db->query("SELECT * FROM sd_hardware_access");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_access_log() {
		$query = $this->db->query("SELECT * FROM sd_hardware_access_log");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_alert_log() {
		$query = $this->db->query("SELECT * FROM sd_hardware_alert_log");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_control() {
		$query = $this->db->query("SELECT * FROM sd_hardware_control");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_port() {
		$query = $this->db->query("SELECT * FROM sd_hardware_port");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_hardware_type($conditionid=null) {
		$query = $this->db->query("SELECT * FROM sd_hardware_type");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_sensor_alert_log($startdate=null,$enddate=null,$limitstart=null,$limitend=null,$orderby=null) {
		if($startdate==null){$startdate='2015-01-01 H:i:s';}
		if($enddate==null){$enddate=date('Y-m-d H:i:s');}
		if($limitstart==null){$limitstart='0';}
		if($limitend==null){$limitend='100';}
		if($orderby==null){$orderby='desc';}
		$query = $this->db->query("SELECT * FROM sd_sensor_alert_log WHERE  datetime_alert BETWEEN  '$startdate' and '$enddate' ORDER BY sensor_alert_log_id $orderby limit $limitstart,$limitend");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_sensor_config() {
		$query = $this->db->query("SELECT * FROM sd_sensor_config");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_sensor_log($startdate=null,$enddate=null,$orderby=null,$limitstart=null,$limitend=null) {
		if($startdate==null){$startdate='2015-04-26 21:08:20';}
		if($enddate==null){$enddate=date('Y-m-d H:i:s');}
		if($orderby==null){$orderby='desc';}
		if($limitstart==null){$limitstart='0';}
		if($limitend==null){$limitend='100';}
	
		$query = $this->db->query("SELECT * FROM sd_sensor_log Inner Join sd_hardware ON sd_hardware.hardware_name = sd_sensor_log.sensor_hwname WHERE  sd_sensor_log.datetime_log BETWEEN  '$startdate' and '$enddate' ORDER BY sd_sensor_log.sensor_log_id $orderby limit $limitstart,$limitend");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_sensor_log_all($hwname=null,$sensor_name=null,$startdate=null,$enddate=null,$orderby=null,$limitstart=null,$limitend=null) {
		if($hwname==null){$startdate='HW1';}
		if($sensor_name==null){$sensor_name='sensor1';}
		if($startdate==null){$startdate='2015-04-26 21:08:20';}
		if($enddate==null){$enddate=date('Y-m-d H:i:s');}
		if($orderby==null){$orderby='desc';}
		if($limitstart==null){$limitstart='0';}
		if($limitend==null){$limitend='100';}
	
		$query = $this->db->query("SELECT * FROM sd_sensor_log Inner Join sd_hardware ON sd_hardware.hardware_name = sd_sensor_log.sensor_hwname Inner Join sd_hardware_type ON sd_hardware.hardware_type_id = sd_hardware_type.hardware_type_id WHERE sd_sensor_log.sensor_hwname='$hwname' and sd_sensor_log.sensor_name='$sensor_name' and sd_sensor_log.datetime_log BETWEEN  '$startdate' and '$enddate' ORDER BY sd_sensor_log.sensor_log_id $orderby limit $limitstart,$limitend");
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
	function get_sensor_type() {
		static $query;
		$this->db->select('*');
		$query = $this->db->get('sd_sensor_type');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_sms_lists() {
		static $query;
		$this->db->select('*');
		$query = $this->db->get('sd_sms_lists');
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_waterleak_log_all() {
		$limitend='100'; 
		$query = $this->db->query("SELECT * FROM sd_waterleak_log  ORDER BY wtl_id desc limit $limitend ");
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_waterleak_log($startdate=null,$enddate=null,$orderby=null,$limitstart=null,$limitend=null) {
		if($startdate==null){$startdate='2015-04-26 21:08:20';}
		if($enddate==null){$enddate=date('Y-m-d H:i:s');}
		if($orderby==null){$orderby='desc';}
		if($limitstart==null){$limitstart='0';}
		if($limitend==null){$limitend='100';}
		$query = $this->db->query("SELECT * FROM sd_waterleak_log WHERE wtl_datetimelog BETWEEN  '$startdate' and '$enddate' ORDER BY wtl_id $orderby limit $limitstart,$limitend");
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_settings_company() {
		$limitend='100'; 
		$query = $this->db->query("SELECT * FROM sd_settings_company");
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
		}
	function get_sensor_chart($hwname=null,$sensorname=null,$group=null,$startdate=null,$enddate=null,$limit=null) {
		$startdate=date('Y-m-d H:i:s',$startdate);
		$startdatena=$startdate;
		$enddate=date('Y-m-d H:i:s',$enddate);
		$timenow=date(' H:i:s');
		$datenow=date('Y-m-d');
	    $date1=strtotime($startdate);
		$date2=strtotime($datenow.$timenow);
		if($date1==$date2){
		$startdate1=date("Y-m-d H:i:s", strtotime("-1 days"));
		$startdate=$startdate1;
		}else{$startdate=$startdatena;}
		$getall=$hwname.'/'.$sensorname.'/'.$group.'/'.$startdate.'/'.$enddate.'/'.$limit;
		//echo 'getall='.$getall;
		//exit();
		if($hwname==null){$hwname='HW1';}
		if($sensorname==null){$sensorname='sensor1';}
		if($group==null){
		//$group='year';
		//$group='month';
		//$group='day';
		$group='hour';
		//$group='minute';
		//$group='second';
		}if($startdate==null){
		$countdate='1';
		$startdate=date("Y-m-d H:i:s", strtotime("-$countdate days"));
		}if($enddate==null){
		$enddate=date('Y-m-d H:i:s');
		}if($limit==null){
		$limit='48';
		}
		$query = $this->db->query("select distinct * ,DATE(datetime_log) as date,TIME(datetime_log) as time from sd_sensor_log where sensor_hwname='$hwname'and sensor_name='$sensorname' and datetime_log between '$startdate' and '$enddate' GROUP BY $group(datetime_log) order by date asc,time asc,sensor_log_id desc  limit $limit");
		//Debug($this->db->last_query());
		
		if($query->num_rows() > 0) return $query->result();
		else if($query->num_rows() < 0)return FALSE;
		}
		
#####################Tmon insert log #########################
	///insert sensor_log///
	function sensor_log_insert($data){
				$insert = $this->db->insert('_sensor_log', $data);
				return $insert;
		}	
	///insert sensor_alert_log///
	function sensor_alert_log_insert($data){
				$insert = $this->db->insert('_sensor_alert_log', $data);
				return $insert;
		}
	///insert sendmail_alert_log///
	function sendmail_alert_log_insert($data){
				$insert = $this->db->insert('_sendmail_alert_log', $data);
				return $insert;
		}	
	///insert call_alert_log///
	function call_alert_log_insert($data){
				$insert = $this->db->insert('_call_alert_log', $data);
				return $insert;
		}
	///insert waterleak_log///
	function waterleak_log_insert($data){
				$insert = $this->db->insert('_waterleak_log', $data);
				return $insert;
		}
#####################Tmon#########################	
				
	}
?>