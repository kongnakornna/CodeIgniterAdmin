<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Hardwarecontrolconfig extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Hardwarecontrolconfig_model');
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$language = $this->lang->language;
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
          $breadcrumb[] = '<a href="'.base_url('hardware').'">'.$language['hardware'].'</a>';
          $breadcrumb[] = '<a href="'.base_url('hardwaremonitorsetting').'">'.$language['hardwaremonitorsetting'].'</a>';
		$breadcrumb[] = '<a href="'.base_url('hardwarecontrolconfig/add').'">'.$language['add'].$language['hardwarecontrolconfig'].'</a>';
		//$breadcrumb[] = $language['hardwarecontrolconfig'];
          $total_rows= $this->Hardwarecontrolconfig_model->total($startdate,$enddate);
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
		$pageConfig = doPagination($this->Hardwarecontrolconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwarecontrolconfig/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Hardwarecontrolconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwarecontrolconfig/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config($pageIndex, $limit,$startdate,$enddate);
		}else{
		$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config($pageIndex, $limit);
		}
		  
		#Debug($hardwarecontrolconfig_list); die();
		  
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config();
			//Debug($hardwarecontrolconfig_list);
			//die();

			$data = array(				
                    "hardwarecontrolconfig_list" => $hardwarecontrolconfig_list,
				"content_view" => 'tmon/hardwarecontrolconfig',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb,
                    "total_rows" => $total_rows,
				"startdate" => $startdate,
				"enddate" => $enddate,
				"pagination" => $links
			);

			$this->load->view('template/template',$data);
	}
	
	
	public function controls($pageIndex=1){
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type')); 
          $startdate = $this->input->get_post('startdate',TRUE);
          $enddate = $this->input->get_post('enddate',TRUE);
		$language = $this->lang->language;
          $lang = $this->lang->language['lang'];
		$breadcrumb[] = '<a href="'.base_url('hardwarecontrolconfig').'">'.$language['hardwarecontrolconfig'].'</a>';
		$breadcrumb[] = $language['control'];
          $total_rows= $this->Hardwarecontrolconfig_model->total($startdate,$enddate);
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
		$pageConfig = doPagination($this->Hardwarecontrolconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwarecontrolconfig/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Hardwarecontrolconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwarecontrolconfig/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config($pageIndex, $limit,$startdate,$enddate);
		}else{
		$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config($pageIndex, $limit);
		}
		  
		#Debug($hardwarecontrolconfig_list); die();
		  
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config();
			//Debug($hardwarecontrolconfig_list);
			//die();

			$data = array(				
                    "hardwarecontrolconfig_list" => $hardwarecontrolconfig_list,
				"content_view" => 'tmon/hardwarecontrolconfig_controls',
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
			$this->load->model('Hardware_model');
			$this->load->model('Sensortype_model');
			$ListSelectHardware = $this->Hardware_model->getSelect();	
			$ListSelectSensortype=$this->Sensortype_model->getSelect();	
			//Debug($ListSelectSensortype);die();
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			
			$breadcrumb[] = '<a href="'.base_url('hardwarecontrolconfig').'">'.$language['hardwarecontrolconfig'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'tmon/hardwarecontrolconfig_add',
				"ListSelectHardware" => $ListSelectHardware,
				"ListSelectSensortype" => $ListSelectSensortype,
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($id){
			$this->load->model('Hardware_model');
			$this->load->model('Sensortype_model');
			$hardware_id_map_id=$this->Hardwarecontrolconfig_model->getSelect_hardware_by_id($id);	
			#Debug($hardware_id_map_id);die();
			$hardware_id_map=$hardware_id_map_id[0]['hardware_id_map'];
			$ListSelectHardware = $this->Hardware_model->getSelect($hardware_id_map);	
			#Debug($ListSelectHardware);die();

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('hardwarecontrolconfig').'">'.$language['hardwarecontrolconfig'].'</a>';
			$breadcrumb[] = $language['edit'];
			$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config_edit($id);
# Debug($hardwarecontrolconfig_list);Die();
			$data = array(						
				"hardwarecontrolconfig_list" => $hardwarecontrolconfig_list,
				"ListSelectHardware" => $ListSelectHardware,
				"content_view" => 'tmon/hardwarecontrolconfig_edit',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
               //Debug($data); die();
			$this->load->view('template/template',$data);
	}	


	public function list_dd($id = 0){
			$this->load->model('Hardwarecontrolconfig_model');
		     $this->load->library('session');
	          $this->load->library("pagination");
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type')); 
			$language = $this->lang->language;
			//Debug($ListSelect);Die();
			$hardwarecontrol_config_id_map_map = $this->uri->segment(3);
			$first = "---".$language['please_select']."---";
			$sensor_config = $this->Hardwarecontrolconfig_model->get_dd_list($id);
			//Debug($sensor_config);
			$allsensor_config = count($sensor_config);
			echo '<option value="0">'.$first.'</option>';
			if($sensor_config)
				for($i=0;$i<$allsensor_config;$i++){				
$sel = ($hardwarecontrol_config_id_map_map == $sensor_config[$i]->hardwarecontrol_config_id_map_map) ? 'selected' : '';
echo '<option value="'.$sensor_config[$i]->hardwarecontrol_config_id_map_map.'" '.$sel.'>'.$sensor_config[$i]->control_name.' '.$sensor_config[$i]->control_name.' '.$sensor_config[$i]->sensor_type_name.'</option>'; 
				}
			 #Debug($sensor_config);
			 #echo "sensor_config = $sensor_config";
			exit;		
	}


	public function status($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status = $this->Hardwarecontrolconfig_model->get_status_control($id);
			 //Debug($obj_status);die();
			$cur_status = $obj_status[0]['status'];
			$hardwarecontrolconfig_name = $obj_status[0]['control_name'];
			$control_name = $obj_status[0]['control_name'];
			if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
			 #Debug($cur_status);die();
			$this->Hardwarecontrolconfig_model->status_control($id, $cur_status);
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
               if($cur_status==1){$cstatus='Enable : '.$enable;}else if($cur_status==0){$cstatus='Disable : '.$disable;}
               $ref_title=$hardwarecontrolconfig_name.$control_name." [$status : ".$cstatus."]";
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


	public function auto($id){
			  $language = $this->lang->language;
			//$admin_id = $this->session->userdata('admin_id');
			//$admin_type = $this->session->userdata('admin_type');
			//$ListSelect = $this->Api_model_na->user_menu($admin_type);
			//$id = 0;		
			//$id = $this->input->post("id");

				 //echo $id;die();
				$obj_status = $this->Hardwarecontrolconfig_model->get_status_control($id);
				 //Debug($obj_status);die();
				$cur_status = $obj_status[0]['auto'];
				$hardwarecontrolconfig_name = $obj_status[0]['control_name'];
				$control_name = $obj_status[0]['control_name'];
				if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
				 #Debug($cur_status);die();
				$this->Hardwarecontrolconfig_model->auto($id, $cur_status);
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
	               if($cur_status==1){$cstatus='Enable : '.$enable;}else if($cur_status==0){$cstatus='Disable : '.$disable;}
	               $ref_title=$hardwarecontrolconfig_name.' Auto Status'.$control_name." [$status : ".$cstatus."]";
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

	public function access($id){
			  $language = $this->lang->language;
			//$admin_id = $this->session->userdata('admin_id');
			//$admin_type = $this->session->userdata('admin_type');
			//$ListSelect = $this->Api_model_na->user_menu($admin_type);
			//$id = 0;		
			//$id = $this->input->post("id");

				 //echo $id;die();
				$obj_status = $this->Hardwarecontrolconfig_model->get_status_control($id);
				 //Debug($obj_status);die();
				$cur_status = $obj_status[0]['access'];
				$hardwarecontrolconfig_name = $obj_status[0]['control_name'];
				$control_name = $obj_status[0]['control_name'];
				if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
				 #Debug($cur_status);die();
				$this->Hardwarecontrolconfig_model->access($id, $cur_status);
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
	               if($cur_status==1){$cstatus='Enable : '.$enable;}else if($cur_status==0){$cstatus='Disable : '.$disable;}
	               $ref_title=$hardwarecontrolconfig_name.' Access Control '.$control_name." [$status : ".$cstatus."]";
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
		
	public function update(){
			  $language = $this->lang->language;
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['hardwarecontrolconfig'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Hardwarecontrolconfig_model->store($data_access['condition_group_id'], $data_to_store);
 

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
                         $ref_title="Admin hardwarecontrolconfig : ".$data_access['control_name']." Grant Access";;
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
          
                         
                    redirect('hardwarecontrolconfig');
			 }

			$hardwarecontrolconfig_list = $this->Hardwarecontrolconfig_model->get_hardwarecontrol_config();
			$data = array(				
					"hardwarecontrolconfig" => $hardwarecontrolconfig_list,
					"content_view" => 'tmon/hardwarecontrolconfig_update',
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

					$this->form_validation->set_rules('control_name_en', 'control_name_en', 'required');
					$this->form_validation->set_rules('control_name_th', 'control_name_th', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
					$hardwarecontrol_config_id_map=(int)$datainput['hardwarecontrol_config_id_map'];
					$admin_id = $this->session->userdata('admin_id');
					$now_date = date('Y-m-d h:i:s');
					$exceeding=$language['exceeding'];
					$pleasecheckthedata=$language['pleasecheckthedata'];
					$forbidden=$language['forbidden'];
					$housenn=$language['hour'];
					$minutenn=$language['minute'];
					$datenn=$language['date'];
					$monthnn=$language['day'];
					$startna=$language['start'];
					$finishna=$language['finish'];
					$forbiddenna=$language['forbidden'];
                #echo' After validation'; Debug($datainput); Die();
                ################################
				$admin_id = $this->session->userdata('admin_id');
		 
				$order_by = $this->Hardwarecontrolconfig_model->get_max_order();
				$get_max_id = $this->Hardwarecontrolconfig_model->get_max_id();
				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
               	$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				//if the form has passed through the validation
				if(!isset($datainput['hardwarecontrol_config_id_map'])){$datainput['hardwarecontrol_config_id_map'] = 0;}
				if ($this->form_validation->run()){
				if($datainput['hardwarecontrol_config_id_map'] > 0){ //UPDATE SQL
				$hardwarecontrol_config_id_map=$datainput['hardwarecontrol_config_id_map'];
 //echo 'Update';Debug($datainput); Die();
                                $edit = $language['edit'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'hardwarecontrol_config_id_map' => $datainput['hardwarecontrol_config_id_map'],
									'hardware_id_map' => $datainput['hardware_id'],
									'control_name' => $datainput['control_name_en'],
									'on' => $datainput['on'],
									'off' => $datainput['off'],
									'auto' => $datainput['auto'],
									'access' => $datainput['access'],
									'date'=>$now_date,
									'status'=>$datainput['status'],	
									//'lang'=>'en',										
								);
								
								$control_name=$datainput['control_name_en'];
								//if the insert has returned true then we show the flash message
								if($this->Hardwarecontrolconfig_model->store($hardwarecontrol_config_id_map, $data_to_store_en,'en')){
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
                                                       $create_date=date('Y-m-d H:i:s');
                                                       $ref_title=$edit." ID ".$hardwarecontrol_config_id_map." Hardwarecontro Config   : ".$control_name.' Date '.$create_date;
                                                       $action=2;
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
								}else{
									$data['flash_message'] = FALSE; 
								}
								///////////
								$data_to_store_th = array(
									'hardwarecontrol_config_id_map' => $datainput['hardwarecontrol_config_id_map'],
									'hardware_id_map' => $datainput['hardware_id'],
									'control_name' => $datainput['control_name_th'],
									'on' => $datainput['on'],
									'off' => $datainput['off'],
									'auto' => $datainput['auto'],
									'access' => $datainput['access'],
									'date'=>$now_date,
									'status'=>$datainput['status'],
									//'lang'=>'th'	
								);
								//echo' Update ...';  Debug($data_to_store_en);Debug($data_to_store_th);Die();
								$control_name=$datainput['control_name_th'];
								//if the insert has returned true then we show the flash message
								if($this->Hardwarecontrolconfig_model->store($hardwarecontrol_config_id_map, $data_to_store_th,'th')){
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
                                                       $create_date=date('Y-m-d H:i:s');
                                                       $ref_title=$edit." ID ".$hardwarecontrol_config_id_map." Hardwarecontro Config   : ".$control_name.' Date '.$create_date;
                                                       $action=2;
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
								}else{
									$data['flash_message'] = FALSE; 
								}
								
						
						}else{ //INSERT SQL
   #echo 'ID'.$max_id.'INSERT';Debug($datainput); Die();		
								
                                $add = $language['add'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'hardwarecontrol_config_id_map' => $max_id,
									'hardware_id_map' => $datainput['hardware_id'],
									'control_name' => $datainput['control_name_en'],
									'on' => $datainput['on'],
									'off' => $datainput['off'],
									'auto' => $datainput['auto'],
									'access' => $datainput['access'],
									'status'=>$datainput['status'],
									'date'=>$now_date,
									'lang'=>'en'
								);

$control_name=$datainput['control_name_en'].'Date :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Hardwarecontrolconfig_model->store_product($data_to_store_en)){
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
                                             $ref_title=$add." Hardwarecontro Config : ".$control_name;
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
								}else{
									$data['flash_message'] = FALSE; 
								}
								/////////////TH
								$data_to_store_th = array(
									'hardwarecontrol_config_id_map' => $max_id,
									'hardware_id_map' => $datainput['hardware_id'],
									'control_name' => $datainput['control_name_th'],
									'on' => $datainput['on'],
									'off' => $datainput['off'],
									'auto' => $datainput['auto'],
									'access' => $datainput['access'],
									'status'=>$datainput['status'],
									'date'=>$now_date,
									'lang'=>'th'
								);

$control_name=$datainput['control_name_th'].'Date :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Hardwarecontrolconfig_model->store_product($data_to_store_th)){
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
                                             $ref_title=$add." Hardwarecontro Config : ".$control_name;
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
								}else{
									$data['flash_message'] = FALSE; 
								}
								////////////////
								 
						}
						 

				}else{

						$hardwarecontrolconfig_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/hardwarecontrolconfig/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'hardwarecontrolconfig/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/hardwarecontrolconfig';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('hardwarecontrolconfig');

    }       

	public function delete($id){

			echo "Deleting... $id"; # die();
			if($id<=3){
                    redirect('hardwarecontrolconfig');
			     exit();
               }
			$OBJnews = $this->Hardwarecontrolconfig_model->get_status($id);
			 #Debug($OBJnews); die();
			 
			
$control_name=$OBJnews[0]['control_name'];
	#Debug($control_name); die();		
			//$order_by = $OBJnews[0]['order_by'];
               if($id<=7){
                  $this->Hardwarecontrolconfig_model->delete_hardware($id); //Update 
               }elseif($id>7){
                   $this->Hardwarecontrolconfig_model->delete_hardware_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->Hardwarecontrolconfig_model->update_orderdel($order_by);

               
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
               $ref_title="Delete ID ".$id." hardwarecontrolconfig : ".$control_name;
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
               
               
			redirect('hardwarecontrolconfig');
			die();
	}
	
/// control////
	public function hardwarecontrol($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		

			 //echo $id;die();
			$obj_status = $this->Hardwarecontrolconfig_model->get_status_control($id);
			 //Debug($obj_status);die();
			$cur_status = $obj_status[0]['status'];
			$hardwarecontrolconfig_name = $obj_status[0]['control_name'];
			$control_name = $obj_status[0]['control_name'];
			if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
			#Debug($cur_status);die();
			$this->Hardwarecontrolconfig_model->hardwarecontrol($id, $cur_status);
			#echo 'Access : ';Debug($cur_status);die();
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
               $ref_title= 'Hardware Controls '." [$status : ".$cstatus."]";
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
/// control////
	
	

}