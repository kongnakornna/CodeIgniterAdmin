<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Alarmconfig extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Alarmconfig_model');
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$language = $this->lang->language;
		$langlog = $language['lang'];
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
    
    public function index(){
			$this->listview();
    }
    
	public function listview($pageIndex=1){
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type')); 
          $startdate = $this->input->get_post('startdate',TRUE);
          $enddate = $this->input->get_post('enddate',TRUE);
		$language = $this->lang->language;
          $lang = $this->lang->language['lang'];
		$breadcrumb[] = '<a href="'.base_url('alarmconfig/add').'">'.$language['add'].$language['alarmconfig'].'</a>';
		$breadcrumb[] = $language['alarmconfig'];
          $total_rows= $this->Alarmconfig_model->total($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){
			$limit = 100;
			$total_rows=(int)$total_rows;
		}else{
			$limit = $total_rows;
			if($limit>500){$limit=500; $total_rows=500;}
			}
		 //Debug($total_rows);
		//Die();
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination");   
		
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Alarmconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/alarmconfig/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Alarmconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/alarmconfig/listview"));
		}
		#Debug($pageConfig); die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$alarmconfig_list = $this->Alarmconfig_model->get_alarm_config($pageIndex, $limit,$startdate,$enddate);
		}else{
		$alarmconfig_list = $this->Alarmconfig_model->get_alarm_config($pageIndex, $limit);
		}
		  
		#Debug($alarmconfig_list); die();
		  
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$alarmconfig_list = $this->Alarmconfig_model->get_alarm_config();
			//Debug($alarmconfig_list);
			//die();

			$data = array(				
                    "alarmconfig_list" => $alarmconfig_list,
				"content_view" => 'tmon/alarmconfig',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb,
                    "total_rows" => $total_rows,
				"startdate" => $startdate,
				"enddate" => $enddate,
				"pagination" => $links
			);

			$this->load->view('template/template',$data);
	}
	

		
	public function add(){
	    		$this->load->library('session');
			$this->load->model('Hardware_model');
			$this->load->model('Sensortype_model');
			$this->load->model('Sensorconfig_model');
			$ListSelectHardware = $this->Hardware_model->getSelecthw(0, 'hardware_id_map');
			//Debug($ListSelectHardware);Die();
			$ListSelectSensortype=$this->Sensortype_model->getSelect();	
			//Debug($ListSelectSensortype);die();
			$ListSelectSensorconfig=$this->Sensorconfig_model->getSelect();	
			#Debug($ListSelectSensorconfig);die();
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			
			$breadcrumb[] = '<a href="'.base_url('alarmconfig').'">'.$language['alarmconfig'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'tmon/alarmconfig_add',
				"ListSelectHardware" => $ListSelectHardware,
				"ListSelectSensorconfig" => $ListSelectSensorconfig,
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($id=0){
	    		$this->load->library('session');
			$this->load->model('Hardware_model');
			$this->load->model('Sensortype_model');
			$this->load->model('Sensorconfig_model');
			$hardware_id_map_id=$this->Alarmconfig_model->getSelect_hardware_by_id($id);	
			#Debug($hardware_id_map_id);die();
			$hardware_id_map=$hardware_id_map_id[0]['hardware_id_map'];
			$sensor_config_id_map1=$hardware_id_map_id[0]['sensor_config_id_map'];
			$sensor_config_id_map1=$this->Alarmconfig_model->getSelect_sensor_config_id_map($sensor_config_id_map1);	
			#Debug($sensor_config_id_map1);die();
			$sensor_config_id_map1=$sensor_config_id_map1[0]['sensor_config_id_map'];
			$ListSelectHardware = $this->Hardware_model->getSelecthw($hardware_id_map, 'hardware_id_map');
			#Debug($ListSelectHardware);Die();
			$sensor_config_id_map=$this->Alarmconfig_model->getSelect_hardware_by_config_id_map($hardware_id_map,$sensor_config_id_map1);
			#Debug($sensor_config_id_map);die();
			$sensor_config_id_map=$sensor_config_id_map[0]['sensor_config_id_map'];	
			if($sensor_config_id_map> 0){
			$ListSelectSensorconfig=$this->Alarmconfig_model->getSelecthwid($hardware_id_map,$sensor_config_id_map);	
			}else{
			$ListSelectSensorconfig = '<select class="form-control" id="sensor_config_id_map" name="sensor_config_id_map"></select>';					
			}
              #Debug($ListSelectSensorconfig);die();
			############################
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('alarmconfig').'">'.$language['alarmconfig'].'</a>';
			$breadcrumb[] = $language['edit'];
			$alarmconfig_list = $this->Alarmconfig_model->get_alarm_config_edit($id);
			 #Debug($alarmconfig_list);Die();
			$data = array(		
				"ListSelectHardware" => $ListSelectHardware,
				"ListSelectSensorconfig" => $ListSelectSensorconfig,				
				"alarmconfig_list" => $alarmconfig_list,
				"content_view" => 'tmon/alarmconfig_edit',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
               //Debug($data); die();
			$this->load->view('template/template',$data);
	}	
//////////////////status//////////////
	public function status($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status = $this->Alarmconfig_model->get_status2($id);
			 //Debug($obj_status);die();
			$cur_status = $obj_status[0]['status'];
			$alarmname = $obj_status[0]['alarmname'];
			if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
			 #Debug($cur_status);die();
			$this->Alarmconfig_model->status_alarm_config2($id, $cur_status);
			 #Debug($this);die();
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               $disable = $language['disable'];
               $enable = $language['enable'];
               $status = $language['status'];
               //$on =$language['on'];$off =$language['off'];
               if($cur_status==1){$cstatus='Enable : '.$enable;}else{$cstatus='Disable : '.$disable;}
               $ref_title=$alarmname." [$status : ".$cstatus."]";
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status=1;
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
			echo $cur_status;	//Send data to Ajax
	}
//////////////////status_email//////////////
	public function status_email($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status_email = $this->Alarmconfig_model->status_email2($id);
			 //Debug($obj_status_email);die();
			$cur_status_email = $obj_status_email[0]['status_email'];
			$alarmname = $obj_status_email[0]['alarmname'];
			if($cur_status_email == 0){$cur_status_email = 1;}else{ $cur_status_email = 0;}
			#Debug($cur_status_email);die();
			$this->Alarmconfig_model->status_email_sensor_config2($id, $cur_status_email);
			#Debug($this);die();
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               $disable = $language['disable'];
               $enable = $language['enable'];
               $status_email = $language['email'];
               //$on =$language['on'];$off =$language['off'];
               if($cur_status_email==1){$cstatus_email='Enable : '.$enable;}else{$cstatus_email='Disable : '.$disable;}
               $ref_title=$alarmname." [$status_email : ".$cstatus_email."]";
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status_email=1;
               $lang = $language['lang'];
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status_email,
                                   "lang" => $lang,
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
			echo $cur_status_email;	//Send data to Ajax
	}
/////////////////status_sms///////////////
	public function status_sms($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status_sms = $this->Alarmconfig_model->status_sms2($id);
			 //Debug($obj_status_sms);die();
			$cur_status_sms = $obj_status_sms[0]['status_sms'];
			$alarmname = $obj_status_sms[0]['alarmname'];
			if($cur_status_sms == 0){$cur_status_sms = 1;}else{ $cur_status_sms = 0;}
			#Debug($cur_status_sms);die();
			$this->Alarmconfig_model->status_sms_sensor_config2($id, $cur_status_sms);
			#Debug($this);die();
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               $disable = $language['disable'];
               $enable = $language['enable'];
               $status_sms = $language['sms'];
               //$on =$language['on'];$off =$language['off'];
               if($cur_status_sms==1){$cstatus_sms='Enable : '.$enable;}else{$cstatus_sms='Disable : '.$disable;}
               $ref_title=$alarmname." [$status_sms : ".$cstatus_sms."]";
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status_sms=1;
               $lang = $language['lang'];
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status_sms,
                                   "lang" => $lang,
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
			echo $cur_status_sms;	//Send data to Ajax
	}
///////////////status_call/////////////////
	public function status_call($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status_call = $this->Alarmconfig_model->status_call2($id);
			 //Debug($obj_status_call);die();
			$cur_status_call = (int)$obj_status_call[0]['status_call'];
			$alarmname = $obj_status_call[0]['alarmname'];
			if($cur_status_call == 0){$cur_status_call = 1;}else{ $cur_status_call = 0;}
			#Debug($cur_status_call);die();
			$this->Alarmconfig_model->status_call_sensor_config2($id, $cur_status_call);
			#Debug($this);die();
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               $disable = $language['disable'];
               $enable = $language['enable'];
               $status_call = $language['call'];
               //$on =$language['on'];$off =$language['off'];
               if($cur_status_call==1){$cstatus_call='Enable : '.$enable;}else{$cstatus_call='Disable : '.$disable;}
               $ref_title=$alarmname." [$status_call : ".$cstatus_call."]";
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status_call=1;
               $langlog = $language['lang'];
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status_call,
                                   "lang" => $langlog,
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
			echo $cur_status_call;	//Send data to Ajax
	}
////////////////////////////////
	public function update(){
			  $language = $this->lang->language;
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['alarmconfig'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Alarmconfig_model->store($data_access['condition_group_id'], $data_to_store);
 

                    //**************Log activity
                    	$language = $this->lang->language;
          			$edit = $language['edit'];
          			$savedata = $language['savedata'];
                         $session_id_admin=$this->session->userdata('admin_id');
                         $ref_id=$this->session->userdata('admin_type');
                         ########IP#################	
                         $ipaddress=$_SERVER['REMOTE_ADDR'];	
                         $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
                         $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
                         $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
                         $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
                         $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
                         $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                         if($ipaddress1!==''){$ipaddress=$ipaddress1;}
                         elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
                         elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
                         elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
                         elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
                         elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
                         elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
                         ########IP#################
                         $ref_type=1;
                         $ref_title="Admin alarmconfig : ".$data_access['sensor_group']." Grant Access";;
                         $action=2;
                         $create_date=date('Y-m-d H:i:s');
                         $status=1;
                    	$log_activity = array(
                    					"admin_id" => $session_id_admin,
                    					"ref_id" => $ref_id,
                    					"from_ip" => $ipaddress,
                    					"ref_type" => $ref_type,
                    					"ref_title" => $ref_title,
                    					"action" => $action,
                                             "create_date" => $create_date,
                                             "status" => $status
                    			);			
                    	$this->Admin_log_activity_model->store($log_activity);
                         //Debug($log_activity); Die();
                    //**************Log activity
          
                         
                    redirect('alarmconfig');
			 }

			$alarmconfig_list = $this->Alarmconfig_model->get_alarm_config();
			$data = array(				
					"alarmconfig" => $alarmconfig_list,
					"content_view" => 'tmon/alarmconfig_update',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
					"success" => 'Grant access success.'
			);

			$this->load->view('template/template',$data);

	}

	public function save(){
		$language = $this->lang->language;
		$admin_id = $this->session->userdata('admin_id');
		$admin_type = $this->session->userdata('admin_type');
		$ListSelect = $this->Api_model_na->user_menu($admin_type);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
                    $datainput = $this->input->post();
				$upload_status = "";
        			 #Debug($datainput); Die();
		//form validation
					$this->form_validation->set_rules('hardware_id_map', 'hardware_id_map', 'required');
					$this->form_validation->set_rules('sensor_config_id_map', 'sensor_config_id_map', 'required');
					$this->form_validation->set_rules('alarmname_en', 'alarmname_en', 'required');
					$this->form_validation->set_rules('alarmname_th', 'alarmname_th', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
                ################################
				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				$order_by = $this->Alarmconfig_model->get_max_order();
				$get_max_id = $this->Alarmconfig_model->get_max_id();
				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
               	$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				//if the form has passed through the validation
				if(!isset($datainput['alarm_config_id_map'])){$datainput['alarm_config_id_map'] = 0;}
				$alarm_config_id_map=(int)$datainput['alarm_config_id_map'];
				if ($this->form_validation->run()){
				if($alarm_config_id_map> 0){ //UPDATE SQL
				$alarm_config_id_map=$datainput['alarm_config_id_map'];
 #echo 'Update';Debug($datainput); Die();
                                $edit = $language['edit'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'alarm_config_id_map' => $datainput['alarm_config_id_map'],
									'hardware_id_map' => $datainput['hardware_id_map'],
									'sensor_config_id_map' => $datainput['sensor_config_id_map'],
									'alarmname' => $datainput['alarmname_en'],
									'status_email' => $datainput['status_email'],
									'status_sms' => $datainput['status_sms'],
									'status_call' => $datainput['status_call'],
									'status'=>$datainput['status'],	
									'create_date'=>$now_date										
								);
								
								$sensor_group=' '.$datainput['alarmname_en'].' :'.$now_date;
								//if the insert has returned true then we show the flash message
								if($this->Alarmconfig_model->storeupdate($alarm_config_id_map, $data_to_store_en,$lang_en)){
									$data['flash_message'] = TRUE; 
                                                  //**************Log activity
                                                  	$language = $this->lang->language;
                                        			$edit = $language['edit'];
                                        			$savedata = $language['savedata'];
                                                       $session_id_admin=$this->session->userdata('admin_id');
                                                       $ref_id=$this->session->userdata('admin_type');
                                                       ########IP#################	
                                                       $ipaddress=$_SERVER['REMOTE_ADDR'];	
                                                       $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
                                                       $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
                                                       $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
                                                       $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
                                                       $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
                                                       $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                                                       if($ipaddress1!==''){$ipaddress=$ipaddress1;}
                                                       elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
                                                       elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
                                                       elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
                                                       elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
                                                       elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
                                                       elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
                                                       ########IP#################
                                                       $ref_type=1;
                                                       $ref_title=$edit." ID ".$alarm_config_id_map." : ".$sensor_group;
                                                       $action=2;
                                                       $create_date=date('Y-m-d H:i:s');
                                                       $status=1;
													   $log_activity = array(
                                                  					"admin_id" => $session_id_admin,
                                                  					"ref_id" => $ref_id,
                                                  					"from_ip" => $ipaddress,
                                                  					"ref_type" => $ref_type,
                                                  					"ref_title" => $ref_title,
                                                  					"action" => $action,
                                                                           "create_date" => $create_date,
                                                                           "status" => $status,
                                                                           "lang"=>'en',
                                                  			);			
                                                  	$this->Admin_log_activity_model->store($log_activity);
                                                       //Debug($log_activity); Die();
                                                  //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								///////////
								$data_to_store_th = array(
									'alarm_config_id_map' => $datainput['alarm_config_id_map'],
									'hardware_id_map' => $datainput['hardware_id_map'],
									'sensor_config_id_map' => $datainput['sensor_config_id_map'],
									'alarmname' => $datainput['alarmname_th'],
									'status_email' => $datainput['status_email'],
									'status_sms' => $datainput['status_sms'],
									'status_call' => $datainput['status_call'],
									'status'=>$datainput['status'],	
									'create_date'=>$now_date										
								);
								
								$sensor_group=' '.$datainput['alarmname_th'].' :'.$now_date;
								//if the insert has returned true then we show the flash message
								if($this->Alarmconfig_model->storeupdate($alarm_config_id_map, $data_to_store_th,$lang_th)){
									$data['flash_message'] = TRUE; 
                                                  //**************Log activity
                                                  	$language = $this->lang->language;
                                        			$edit = $language['edit'];
                                        			$savedata = $language['savedata'];
                                                       $session_id_admin=$this->session->userdata('admin_id');
                                                       $ref_id=$this->session->userdata('admin_type');
                                                       ########IP#################	
                                                       $ipaddress=$_SERVER['REMOTE_ADDR'];	
                                                       $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
                                                       $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
                                                       $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
                                                       $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
                                                       $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
                                                       $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                                                       if($ipaddress1!==''){$ipaddress=$ipaddress1;}
                                                       elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
                                                       elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
                                                       elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
                                                       elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
                                                       elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
                                                       elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
                                                       ########IP#################
                                                       $ref_type=1;
                                                       $ref_title=$edit." ID ".$alarm_config_id_map." : ".$sensor_group;
                                                       $action=2;
                                                       $create_date=date('Y-m-d H:i:s');
                                                       $status=1;
                                                  	$log_activity = array(
                                                  					"admin_id" => $session_id_admin,
                                                  					"ref_id" => $ref_id,
                                                  					"from_ip" => $ipaddress,
                                                  					"ref_type" => $ref_type,
                                                  					"ref_title" => $ref_title,
                                                  					"action" => $action,
                                                                           "create_date" => $create_date,
                                                                           "status" => $status,
                                                                           "lang"=>'th',
                                                  			);			
                                                  	$this->Admin_log_activity_model->store($log_activity);
                                                       //Debug($log_activity); Die();
                                                  //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								
						
						}else{ //INSERT SQL
  #echo 'ID'.$max_id.'INSERT';Debug($datainput); Die();		
								
                                $add = $language['add'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'alarm_config_id_map' => $max_id,
									'hardware_id_map' => $datainput['hardware_id_map'],
									'sensor_config_id_map' => $datainput['sensor_config_id_map'],
									'alarmname' => $datainput['alarmname_en'],
									'status_email' => $datainput['status_email'],
									'status_sms' => $datainput['status_sms'],
									'status_call' => $datainput['status_call'],
									'status'=>$datainput['status'],	
									'create_date'=>$now_date,
									'lang'=>$lang_en,
								);

							$sensor_group=' '.$datainput['alarmname_en'].' :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Alarmconfig_model->store_product($data_to_store_en)){
									$data['flash_message'] = TRUE;
                                        //**************Log activity
                                        	$language = $this->lang->language;
                              			$add = $language['add'];
                              			$savedata = $language['savedata'];
                                             $session_id_admin=$this->session->userdata('admin_id');
                                             $ref_id=$this->session->userdata('admin_type');
                                             ########IP#################	
                                             $ipaddress=$_SERVER['REMOTE_ADDR'];	
                                             $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
                                             $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
                                             $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
                                             $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
                                             $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
                                             $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                                             if($ipaddress1!==''){$ipaddress=$ipaddress1;}
                                             elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
                                             elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
                                             elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
                                             elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
                                             elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
                                             elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
                                             ########IP#################
                                             $ref_type=1;
                                             $ref_title=$add." ID :$max_id ".$sensor_group;
                                             $action=2;
                                             $create_date=date('Y-m-d H:i:s');
                                             $status=1;
                                        	$log_activity = array(
                                        					"admin_id" => $session_id_admin,
                                        					"ref_id" => $ref_id,
                                        					"from_ip" => $ipaddress,
                                        					"ref_type" => $ref_type,
                                        					"ref_title" => $ref_title,
                                        					"action" => $action,
                                                                 "create_date" => $create_date,
                                                                 "status" => $status,
                                                                 "lang"=>'en',
                                        			);			
                                        	$this->Admin_log_activity_model->store($log_activity);
                                             //Debug($log_activity); Die();
                                        //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								/////////////TH
								$data_to_store_th = array(
									'alarm_config_id_map' => $max_id,
									'hardware_id_map' => $datainput['hardware_id_map'],
									'sensor_config_id_map' => $datainput['sensor_config_id_map'],
									'alarmname' => $datainput['alarmname_th'],
									'status_email' => $datainput['status_email'],
									'status_sms' => $datainput['status_sms'],
									'status_call' => $datainput['status_call'],
									'status'=>$datainput['status'],	
									'create_date'=>$now_date	,
									'lang'=>$lang_th,
								);

							$sensor_group=' '.$datainput['alarmname_th'].' :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Alarmconfig_model->store_product($data_to_store_th)){
									$data['flash_message'] = TRUE;
                                        //**************Log activity
                                        	$language = $this->lang->language;
                              			$add = $language['add'];
                              			$savedata = $language['savedata'];
                                             $session_id_admin=$this->session->userdata('admin_id');
                                             $ref_id=$this->session->userdata('admin_type');
                                             ########IP#################	
                                             $ipaddress=$_SERVER['REMOTE_ADDR'];	
                                             $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
                                             $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
                                             $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
                                             $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
                                             $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
                                             $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                                             if($ipaddress1!==''){$ipaddress=$ipaddress1;}
                                             elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
                                             elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
                                             elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
                                             elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
                                             elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
                                             elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
                                             ########IP#################
                                             $ref_type=1;
                                              $ref_title=$add." ID :$max_id ".$sensor_group;
                                             $action=2;
                                             $create_date=date('Y-m-d H:i:s');
                                             $status=1;
                                        	$log_activity = array(
                                        					"admin_id" => $session_id_admin,
                                        					"ref_id" => $ref_id,
                                        					"from_ip" => $ipaddress,
                                        					"ref_type" => $ref_type,
                                        					"ref_title" => $ref_title,
                                        					"action" => $action,
                                                                 "create_date" => $create_date,
                                                                 "status" => $status,
                                                                 "lang"=>'th',
                                        			);			
                                        	$this->Admin_log_activity_model->store($log_activity);
                                             //Debug($log_activity); Die();
                                        //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								////////////////
								 
						}
						 

				}else{
 echo 'Error : '; redirect('alarmconfig/add'); Die();	
						$alarmname = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/alarmconfig/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'alarmconfig/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/alarmconfig';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('alarmconfig');

    }       

	public function delete($id){

			echo "Deleting... $id"; # die();
			if($id<=3){
                    redirect('alarmconfig');
			     exit();
               }
			$OBJnews = $this->Alarmconfig_model->get_status($id);
			 #Debug($OBJnews); die();
			 if($OBJnews[0]['status_email']==1){
			 	$status_email='Active';
			 }if($OBJnews[0]['status_sms']==1){
			 	$status_sms='Active';
			 }if($OBJnews[0]['status_call']==1){
			 	$status_call='Active';
			 }if($OBJnews[0]['status_email']==0){
			 	$status_email='Inactive';
			 }if($OBJnews[0]['status_sms']==0){
			 	$status_sms='Inactive';
			 }if($OBJnews[0]['status_call']==0){
				$status_call='Inactive';
			 }
			 
			 if($OBJnews[0]['status']==0){
				$status='Inactive';
			 }else{
			 	$status='Active';
			 }
			 
			 
			
$sensor_group=$OBJnews[0]['alarmname'].$OBJnews[1]['alarmname'].' Email :'.$status_email.' SMS :'.$status_sms.' Call :'.$status_call.' Status :'.$status;
	 #Debug($sensor_group); die();		
			//$order_by = $OBJnews[0]['order_by'];
               if($id<=1){
                  $this->Alarmconfig_model->delete_alarm_config($id); //Update 
               }elseif($id>1){
                   $this->Alarmconfig_model->delete_alarm_config_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->Alarmconfig_model->update_orderdel($order_by);

               
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               $ref_title="Delete ID ".$id.": ".$sensor_group;
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status=1;
               $langlog = $language['lang'];
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status,
                                   "lang"=>$langlog,
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
               
               
			redirect('alarmconfig');
			die();
	}

}