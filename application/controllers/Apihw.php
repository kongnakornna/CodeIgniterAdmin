<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/*
 * @copyright kongnakorn  jantakun 2015
*/
  /*
          header('Access-Control-Allow-Origin: *');
          header('Content-Type: application/json  charset=utf-8'); 
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('application/json', 'UTF-8'); 
		  $this->output->set_content_type('application/html', 'UTF-8'); 
		  $this->output->set_content_type('application/xml', 'UTF-8'); 
          //header("content-type:text/javascript;charset=utf-8");         
          // header("Content-type:application/json; charset=UTF-8");          
          //header("Cache-Control: no-store, no-cache, must-revalidate");         
          //header("Cache-Control: post-check=0, pre-check=0", false);  
*/
class Apihw extends MY_Controller {	
	public function __construct(){
		parent::__construct();
               $this->load->model('Apijson_model');
               $this->load->helper('file');
               $this->load->database();
		     $language = $this->lang->language;
	}
/****************************************************/
	public function index(){
		if(!$this->session->userdata('is_logged_in')){
			redirect(base_url());
		}
			$language = $this->lang->language;
			$breadcrumb[] = $language['api'];
			$admin_id = $this->session->userdata('admin_id');
			$admin_type = $this->session->userdata('admin_type');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$notification_news_list = $notification_column_list = $notification_gallery_list = $notification_vdo_list = $notification_dara_list = array();
			$loadfile = "admintype".$admin_type.".json";
			$admin_menu = LoadJSON($loadfile);
               if(!is_dir('api/')) mkdir('api/', 0777);
			if(!is_dir('api/jsonfile/')) mkdir('api/jsonfile/', 0777);
			$data = array(
					"ListSelect" => $ListSelect,
					"admin_menu" => $admin_menu,
					"content_view" => 'api/api',
					"breadcrumb" => $breadcrumb,
			);	
	$this->load->view('template/template',$data);
	}
/****************************************************/
	public function admintype($id){
          $this->load->helper('file');
		$this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_admin_type();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
		$this->output->set_content_type('Cache-Control: no-store, no-cache, must-revalidate'); 
		$this->output->set_content_type('Cache-Control: post-check=0, pre-check=0", false'); 
          $jsonencode = json_encode($data);
			 $json=$jsonencode;
			 $json = str_replace('\"','"', $jsonencode);
			 $json = str_replace("\'","'", $jsonencode);
			 $json = str_replace('"[','[', $jsonencode);
			 $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_admin_type_', true, 'jsonfile/');
		  $filejsongen='sd_admin_type_'.$id.'.json';
		  $loadapi =  array();
		  $loadapi = Loadjsonapi($filejsongen); // form json_helper
		  //Debug($loadapi);Die();
		  //echo $json; // debug(json_decode($json));
          
	}
/****************************************************/
	public function alertconfig(){
          $this->load->helper('file');
		$this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_alertconfig();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
         // Saveapijson($data, 'sd_alert_config', true, 'jsonfile/');
	     echo $json; // debug(json_decode($json));			
	}
/****************************************************/
	public function condition($status='y'){
		$conditionid = $this->uri->segment(3);# ส่งค่าไป
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_condition($conditionid);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
		//Debug($data);Die();
           $jsonencode = json_encode($data);
		 $json=$jsonencode;
           $json = str_replace('\"','"', $jsonencode);
	      $json = str_replace("\'","'", $jsonencode);
           $json = str_replace('"[','[', $jsonencode);
	      $json = str_replace(']"',']', $jsonencode);
          // Debug($json);Die();
          //Make File Json
          Saveapijson($data, 'sd_condition', true, 'jsonfile/');
		  $filejsongen='sd_condition.json';
		  $loadapi =  array();
		  $loadapi = Loadjsonapi($filejsongen); // form json_helper
		  //Debug($loadapi);Die();
		  //echo $json; // debug(json_decode($json));			
	}
/****************************************************/
	public function conditiongroup(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_condition_group();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_conditiongroup', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function conditiontype(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_condition_type();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_condition_type', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));			
	}
/****************************************************/
	public function email_alert_log(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_email_alert_log();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_email_alert_log', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function email_config(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_email_config();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_email_config', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function email_lists(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_email_lists();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_email_lists', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function general_setting(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_general_setting();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_general_setting', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function hardware(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function hardware_access(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_access();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_access', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}	
/****************************************************/
	public function hardware_access_log(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_access_log();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_access_log', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function hardware_alert_log(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_alert_log();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_alert_log', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}	
/****************************************************/
	public function hardware_control(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_control();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_control', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function hardware_port(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_port();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_port', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));	
	}
/****************************************************/
	public function hardware_type(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_hardware_type();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_hardware_type', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));			
	}
/****************************************************/
	public function sensor_alert_log($startdate=null,$enddate=null,$limitstart=null,$limitend=null,$orderby=null){
		$startdate = $this->uri->segment(3);# ส่งค่าไป
		$enddate = $this->uri->segment(4);# ส่งค่าไป
		$limitstart = $this->uri->segment(5);# ส่งค่าไป
		$limitend = $this->uri->segment(6);# ส่งค่าไป
		$orderby = $this->uri->segment(7);# ส่งค่าไป
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_alert_log($startdate,$enddate,$limitstart,$limitend,$orderby);
          $jsonencode = json_encode($data);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_sensor_alert_log', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));	
	}
/****************************************************/
		public function sensor_config(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_config();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_sensor_config', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function sensor_log($startdate=null,$enddate=null,$limitstart=null,$limitend=null,$orderby=null){
		$startdate = $this->uri->segment(3);# ส่งค่าไป
		$enddate = $this->uri->segment(4);# ส่งค่าไป
		$limitstart = $this->uri->segment(5);# ส่งค่าไป
		$limitend = $this->uri->segment(6);# ส่งค่าไป
		$orderby = $this->uri->segment(7);# ส่งค่าไป
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_log($startdate,$enddate,$limitstart,$limitend,$orderby);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
           Saveapijson($data, 'sd_sensor_log', true, 'jsonfile/');
		 //echo $json; // debug(json_decode($json));		
	}	
/****************************************************/
	public function sensor_log_all($hwname=null,$sensor_name=null,$startdate=null,$enddate=null,$limitstart=null,$limitend=null,$orderby=null){
		$hwname = $this->uri->segment(3);# ส่งค่าไป
		$sensor_name = $this->uri->segment(4);# ส่งค่าไป
		$startdate = $this->uri->segment(5);# ส่งค่าไป
		$enddate = $this->uri->segment(6);# ส่งค่าไป
		$limitstart = $this->uri->segment(7);# ส่งค่าไป
		$limitend = $this->uri->segment(8);# ส่งค่าไป
		$orderby = $this->uri->segment(9);# ส่งค่าไป
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_log_all($hwname,$sensor_name,$startdate,$enddate,$limitstart,$limitend,$orderby);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
		  $filesave=$hwname.'_'.$sensor_name.'_hour';
          Saveapijson($data,$filesave, true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));	
	}
/****************************************************/
	public function sensor_type(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_type();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_sensor_type', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function sms_lists(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sms_lists();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_sms_lists', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function waterleak_log_all(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');;
          $data=$this->Apijson_model->get_waterleak_log_all();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_waterleak_log_all', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));		
	}
/****************************************************/
	public function waterleak_log($startdate=null,$enddate=null,$limitstart=null,$limitend=null,$orderby=null){
		$startdate = $this->uri->segment(3);# ส่งค่าไป
		$enddate = $this->uri->segment(4);# ส่งค่าไป
		$limitstart = $this->uri->segment(5);# ส่งค่าไป
		$limitend = $this->uri->segment(6);# ส่งค่าไป
		$orderby = $this->uri->segment(7);# ส่งค่าไป
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_waterleak_log($startdate,$enddate,$limitstart,$limitend,$orderby);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'sd_waterleak_log', true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));	
	}	
/****************************************************/
	public function hw($ipaddress=null){
		$url = $this->uri->segment(3);# ส่งค่าไป
		$ch = curl_init();  	
             if($url==$ipaddress){
		     //if($url=='192.168.10.223'){
	         echo 'Error';
	         exit();
		     }
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($ch,CURLOPT_HEADER, false); 
		$output=curl_exec($ch);
		curl_close($ch);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
		$jsonencode=$output;
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
          Saveapijson($data, 'hw_'.$ipaddress, true, 'jsonfile/');
		//echo $json; // debug(json_decode($json));
	}
/****************************************************/
	public function hw2($ipaddress=null){
		$url = $this->uri->segment(3);# ส่งค่าไป
		$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		//curl_setopt($ch,CURLOPT_HEADER, false); 
		$output=curl_exec($ch);
		curl_close($ch);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
		$jsonencode=$output;
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
            Saveapijson($data, 'hw2_'.$ipaddress, true, 'jsonfile/');
		  //echo $json; // debug(json_decode($json));	
	}
/****************************************************/
	public function settings_company(){
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_settings_company();
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		$json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	     $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	     $json = str_replace(']"',']', $jsonencode);
          //Make File Json
           Saveapijson($data, 'sd_settings_company', true, 'jsonfile/');
		 //echo $json; // debug(json_decode($json));	
	}
/****************************************************/
	public function sensor_chart($hwname=null,$sensorname=null,$group=null,$startdate=null,$enddate=null,$limit=null){
		$hwname = $this->uri->segment(3);# ส่งค่าไป
		$sensorname = $this->uri->segment(4);# ส่งค่าไป
		$group = $this->uri->segment(5);# ส่งค่าไป
		$startdate = $this->uri->segment(6);# ส่งค่าไป
		$enddate = $this->uri->segment(7);# ส่งค่าไป
		$limit = $this->uri->segment(8);# ส่งค่าไป
		$timenow=date(' H:i:s');
		$startdate=strtotime($startdate.$timenow);
		$enddate=strtotime($enddate.$timenow);
		$this->load->helper('file');
          $this->load->model('Apijson_model');
          $data=$this->Apijson_model->get_sensor_chart($hwname,$sensorname,$group,$startdate,$enddate,$limit);
          $this->output->set_header('Content-Type: application/json', 'UTF-8');
          $this->output->set_content_type('Access-Control-Allow-Origin: *'); 
          $this->output->set_content_type('Content-Type: application/json', 'UTF-8');
          $jsonencode = json_encode($data);
		  $json=$jsonencode;
          $json = str_replace('\"','"', $jsonencode);
	      $json = str_replace("\'","'", $jsonencode);
          $json = str_replace('"[','[', $jsonencode);
	      $json = str_replace(']"',']', $jsonencode);
          //Make File Json
            Saveapijson($data,$hwname.'_'.$sensorname.'_'.$group, true, 'jsonfile/');
			//echo $json; // debug(json_decode($json));	
            		
	}
/****************************************************/
		public function dcodesensor_charthw1(){
            $url=base_url();
			$json_string=$url.'api/jsonfile/HW1_sensor1_hour.json';
			$jsondata=file_get_contents($json_string);
			$data_ret=json_decode($jsondata,true);
			$count=count($data_ret);
			$arr =$data_ret;
               //echo '$json_string='.$json_string;
               //Debug($arr);Die();
			if($count > 0){
				for($i=1; $i<$count; $i++){
					$sensor_log_id[$i]=$arr[$i]['sensor_log_id'];
					$sensor_hwname[$i]=$arr[$i]['sensor_hwname'];
					$sensor_name[$i]=$arr[$i]['sensor_name'];
					$sensor_type[$i]=$arr[$i]['sensor_type'];
					$sensor_value[$i]=$arr[$i]['sensor_value'];
					$datetime_log[$i]=$arr[$i]['datetime_log'];
					$count2=$count-1;
				}
			}else{echo 'Error 200';}	
               for($i=0; $i<$count; $i++){
               echo'<hr>'; 
               echo'sensor_log_id='.$sensor_log_id[$i]; echo'<br>';
               echo'sensor_hwname='.$sensor_hwname[$i]; echo'<br>';
               echo'sensor_name='.$sensor_name[$i]; echo'<br>';
               echo'sensor_type='.$sensor_type[$i]; echo'<br>';
               echo'sensor_value='.$sensor_value[$i]; echo'<br>';
               echo'datetime_log='.$datetime_log[$i]; echo'<br>';
              // echo'<hr>';
               }
		}
/****************************************************/
		public function dcodesensor_admintype($id=NULL){
            $url=base_url();
			$json_string=$url.'api/jsonfile/sd_admin_type_'.$id.'.json';
			$jsondata=file_get_contents($json_string);
			$data_ret=json_decode($jsondata,true);
			$count=count($data_ret);
			$arr =$data_ret;
               //echo '$json_string='.$json_string;
               //Debug($arr);Die();
			if($count > 0){
				for($i=0; $i<$count; $i++){
				    $admin_type_id[$i]=$arr[$i]['admin_type_id'];
                        $admin_type_title[$i]=$arr[$i]['admin_type_title'];
                        $create_date[$i]=$arr[$i]['create_date'];
                        $create_by[$i]=$arr[$i]['create_by'];
                        $lastupdate_date[$i]=$arr[$i]['lastupdate_date'];
                        $status[$i]=$arr[$i]['status'];
				    $count2=$count-1;
				}
			}else{echo 'Error 200';}	
               
               for($i=0; $i<$count; $i++){
               echo'<hr>'; 
               echo'admin_type_id='.$admin_type_id[$i]; echo'<br>';
               echo'admin_type_title='.$admin_type_title[$i]; echo'<br>';
               echo'create_date='.$create_date[$i]; echo'<br>';
               echo'create_by='.$create_by[$i]; echo'<br>';
               echo'lastupdate_date='.$lastupdate_date[$i]; echo'<br>';
               echo'status='.$status[$i]; echo'<br>';
              // echo'<hr>';
               }
               
		}
/****************************************************/
		public function dcodesensor_chart(){
            $url=base_url();
			$json_string=$url.'api/jsonfile/HW2_sensor1_hour.json';
			$jsondata=file_get_contents($json_string);
			$data_ret=json_decode($jsondata,true);
			$count=count($data_ret);
			$arr =$data_ret;
               //echo '$json_string='.$json_string;
               //Debug($arr);Die();
			if($count > 0){
				for($i=1; $i<$count; $i++){
					$sensor_log_id[$i]=$arr[$i]['sensor_log_id'];
					$sensor_hwname[$i]=$arr[$i]['sensor_hwname'];
					$sensor_name[$i]=$arr[$i]['sensor_name'];
					$sensor_type[$i]=$arr[$i]['sensor_type'];
					$sensor_value[$i]=$arr[$i]['sensor_value'];
					$datetime_log[$i]=$arr[$i]['datetime_log'];
					$count2=$count-1;
				}
				//echo ']';
			}else{echo 'Error 200';}	
                for($i=0; $i<$count; $i++){
               echo'<hr>'; 
               echo'sensor_log_id='.$sensor_log_id[$i]; echo'<br>';
               echo'sensor_hwname='.$sensor_hwname[$i]; echo'<br>';
               echo'sensor_name='.$sensor_name[$i]; echo'<br>';
               echo'sensor_type='.$sensor_type[$i]; echo'<br>';
               echo'sensor_value='.$sensor_value[$i]; echo'<br>';
               echo'datetime_log='.$datetime_log[$i]; echo'<br>';
              // echo'<hr>';
               }
		}


/****************************************************/

	public function sensorlog($hwname,$sensor_name,$startdate,$enddate,$limitstart,$limitend,$orderby,$sensor_type){
		if($hwname==''){
		$hwname = $this->uri->segment(3);# ส่งค่าไป
		}if($sensor_name==''){
		$sensor_name = $this->uri->segment(4);# ส่งค่าไป
		}if($startdate==''){
		$startdate = $this->uri->segment(5);# ส่งค่าไป
		}if($enddate==''){
		$enddate = $this->uri->segment(6);# ส่งค่าไป
		}if($limitstart==''){
		$limitstart = $this->uri->segment(7);# ส่งค่าไป
		}if($limitend==''){
		$limitend = $this->uri->segment(8);# ส่งค่าไป
		}if($orderby==''){
		$orderby = $this->uri->segment(9);# ส่งค่าไป
		}if($sensor_type==''){
		$sensor_type = $this->uri->segment(10);# ส่งค่าไป
		}
		###################
//http://localhost/tmon/api/sd_sensor_log.php?hwname=HW1&sensor_name=sensor1&sensortypename=Humi&startdate=2015-05-05&enddate=2015-05-07&limitstart=0&limitend=60&orderby=desc
		$urlsend=base_url().'/api/sd_sensor_log.php?sd_sensor_log.php?hwname='.$hwname.'&sensor_name='.$sensor_name.'&startdate='.$startdate.'&enddate='.$enddate.'&limitstart='.$limitstart.'&limitend='.$limitend.'&orderby='.$orderby;
		//echo '$urlsend='.$urlsend;
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $urlsend,
			CURLOPT_USERAGENT => 'cURL Request Data'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		###################
	}
/****************************************************/
									
 


}
?>