<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Calibrationsensor extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Sensorconfig_model');
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
		$breadcrumb[] = '<a href="'.base_url('sensorconfig/add').'">'.$language['add'].$language['sensorconfig'].'</a>';
		$breadcrumb[] = $language['sensorconfig'];
          $total_rows= $this->Sensorconfig_model->total($startdate,$enddate);
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
		$pageConfig = doPagination($this->Sensorconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorconfig/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Sensorconfig_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorconfig/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$sensorconfig_list = $this->Sensorconfig_model->get_sensor_config($pageIndex, $limit,$startdate,$enddate);
		}else{
		$sensorconfig_list = $this->Sensorconfig_model->get_sensor_config($pageIndex, $limit);
		}
		  
		#Debug($sensorconfig_list); die();
		  
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$sensorconfig_list = $this->Sensorconfig_model->get_sensor_config();
			//Debug($sensorconfig_list);
			//die();

			$data = array(				
                    "sensorconfig_list" => $sensorconfig_list,
				"content_view" => 'tmon/sensorconfig',
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
			$breadcrumb[] = '<a href="'.base_url('sensorconfig').'">'.$language['sensorconfig'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'tmon/sensorconfig_add',
				"ListSelectHardware" => $ListSelectHardware,
				"ListSelectSensortype" => $ListSelectSensortype,
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($id=0){
			$this->load->model('Hardware_model');
			$this->load->model('Sensortype_model');
			$hardware_id_map_id=$this->Sensorconfig_model->getSelect_hardware_by_id($id);	
			#Debug($hardware_id_map_id);die();
			$hardware_id_map=$hardware_id_map_id[0]['hardware_id'];
			$ListSelectHardware = $this->Hardware_model->getSelect($hardware_id_map);	
			#Debug($ListSelectHardware);die();
			$Sensortype_id=$this->Sensorconfig_model->getSelect_sensor_type_id($id);	
			$sensor_type_id=$Sensortype_id[0]['sensor_type_id'];
			#Debug($Sensortype_id);die();
			$ListSelectSensortype=$this->Sensortype_model->getSelect($sensor_type_id);	
			#Debug($ListSelectSensortype);die();
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('sensorconfig').'">'.$language['sensorconfig'].'</a>';
			$breadcrumb[] = $language['edit'];
			$sensorconfig_list = $this->Sensorconfig_model->get_sensor_config_edit($id);
#Debug($sensorconfig_list);Die();
			$data = array(						
				"sensorconfig_list" => $sensorconfig_list,
				"ListSelectHardware" => $ListSelectHardware,
				"ListSelectSensortype" => $ListSelectSensortype,
				"content_view" => 'tmon/sensorconfig_edit',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
               //Debug($data); die();
			$this->load->view('template/template',$data);
	}	

	public function status($id){
		  $language = $this->lang->language;
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			 //echo $id;die();
			$obj_status = $this->Sensorconfig_model->get_status2($id);
			 //Debug($obj_status);die();
			$cur_status = $obj_status[0]['status'];
			$sensorconfig_name = $obj_status[0]['sensor_group'];
			$sensor_name = $obj_status[0]['sensor_name'];
			if($cur_status == 0){$cur_status = 1;}else{ $cur_status = 0;}
			#Debug($cur_status);die();
			$this->Sensorconfig_model->status_sensor_config2($id, $cur_status);
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
               $ref_title=$sensorconfig_name.$sensor_name." [$status : ".$cstatus."]";
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

			$breadcrumb[] = $language['sensorconfig'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Sensorconfig_model->store($data_access['condition_group_id'], $data_to_store);
 

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
                         $ref_title="Admin sensorconfig : ".$data_access['sensor_group']." Grant Access";;
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
          
                         
                    redirect('sensorconfig');
			 }

			$sensorconfig_list = $this->Sensorconfig_model->get_sensor_config();
			$data = array(				
					"sensorconfig" => $sensorconfig_list,
					"content_view" => 'tmon/sensorconfig_update',
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
					$this->form_validation->set_rules('hardware_id', 'hardware_id', 'required');
					$this->form_validation->set_rules('sensor_group_en', 'sensor_group_en', 'required');
					$this->form_validation->set_rules('sensor_name_en', 'sensor_name_en', 'required');
					$this->form_validation->set_rules('sensor_group_th', 'sensor_group_th', 'required');
					$this->form_validation->set_rules('sensor_name_th', 'sensor_name_th', 'required');
					$this->form_validation->set_rules('sensor_type_id', 'sensor_type_id', 'required');
					$this->form_validation->set_rules('sensor_high', 'sensor_high', 'required');
					$this->form_validation->set_rules('sensor_warning', 'sensor_warning', 'required');
					$this->form_validation->set_rules('sn', 'sn', 'required');
					$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
					$hardware_id=(int)$datainput['hardware_id'];
                    	$sensor_group_en=$datainput['sensor_group_en'];
					$sensor_group_th=$datainput['sensor_group_th'];
					$sensor_name_en=$datainput['sensor_name_en'];
					$sensor_name_th=$datainput['sensor_name_th'];
	                    $sensor_type_id=$datainput['sensor_type_id'];
	                    $sensor_high=$datainput['sensor_high'];
	                    $sensor_warning=$datainput['sensor_warning'];
	                    $sn=$datainput['sn'];
	                    $model=$datainput['model'];
	                    $date=$datainput['date'];
	                    $vendor=$datainput['vendor'];
	                    $status=$datainput['status'];
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
                    
                ################################
				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				$order_by = $this->Sensorconfig_model->get_max_order();
				$get_max_id = $this->Sensorconfig_model->get_max_id();
				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
               	$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				//if the form has passed through the validation
				if(!isset($datainput['sensor_config_id'])){$datainput['sensor_config_id'] = 0;}
				if ($this->form_validation->run()){
				if($datainput['sensor_config_id'] > 0){ //UPDATE SQL
				$sensor_config_id=$datainput['sensor_config_id'];
#echo 'Update';Debug($datainput); Die();
                                $edit = $language['edit'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'sensor_config_id_map' => $datainput['sensor_config_id'],
									'hardware_id' => $datainput['hardware_id'],
									'sensor_group' => $datainput['sensor_group_en'],
									'sensor_name' => $datainput['sensor_name_en'],
									'sensor_type_id' => $datainput['sensor_type_id'],
									'sensor_high' => $datainput['sensor_high'],
									'sensor_warning' => $datainput['sensor_warning'],
									'alert' => $datainput['alert'],
									'sn' => $datainput['sn'],
									'model' => $datainput['model'],
									'date'=>$datainput['date'],
									'vendor' => $datainput['vendor'],
									'status'=>$datainput['status'],	
									'lang'=>'en',										
								);
								
								$sensor_group=$datainput['sensor_group_en'].$datainput['sensor_name_en'].' Hight :'.$datainput['sensor_high'].'Warning :'.$datainput['sensor_warning'].' Alert :'.$datainput['alert'].'SN :'.$datainput['sn'].'Model :'.$datainput['model'].'Vendor :'.$datainput['vendor'].'Date :'.$now_date;
								//if the insert has returned true then we show the flash message
								if($this->Sensorconfig_model->store($sensor_config_id, $data_to_store_en,$lang_en)){
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
                                                       $ref_title=$edit." ID ".$sensor_config_id." Sensor  : ".$sensor_group;
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
								///////////
								$data_to_store_th = array(
									'sensor_config_id_map' => $datainput['sensor_config_id'],
									'hardware_id' => $datainput['hardware_id'],
									'sensor_group' => $datainput['sensor_group_th'],
									'sensor_name' => $datainput['sensor_name_th'],
									'sensor_type_id' => $datainput['sensor_type_id'],
									'sensor_high' => $datainput['sensor_high'],
									'sensor_warning' => $datainput['sensor_warning'],
									'alert' => $datainput['alert'],
									'sn' => $datainput['sn'],
									'model' => $datainput['model'],
									'date'=>$datainput['date'],
									'vendor' => $datainput['vendor'],
									'status'=>$datainput['status'],	
									'lang'=>'th'	
								);
								#Debug($data_to_store_en);Debug($data_to_store_th);Die();
								$sensor_group=$datainput['sensor_group_th'].$datainput['sensor_name_th'].' Hight :'.$datainput['sensor_high'].'Warning :'.$datainput['sensor_warning'].' Alert :'.$datainput['alert'].'SN :'.$datainput['sn'].'Model :'.$datainput['model'].'Vendor :'.$datainput['vendor'].'Date :'.$now_date;
								//if the insert has returned true then we show the flash message
								if($this->Sensorconfig_model->store($sensor_config_id, $data_to_store_th,$lang_th)){
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
                                                       $ref_title=$edit." ID ".$sensor_config_id." Sensor  : ".$sensor_group;
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
								
						
						}else{ //INSERT SQL
  #echo 'ID'.$max_id.'INSERT';Debug($datainput); Die();		
								
                                $add = $language['add'];      
                                $lang_th='th';
                                $lang_en='en';
								$data_to_store_en = array(
									'sensor_config_id_map' => $max_id,
									'hardware_id' => $datainput['hardware_id'],
									'sensor_group' => $datainput['sensor_group_en'],
									'sensor_name' => $datainput['sensor_name_en'],
									'sensor_type_id' => $datainput['sensor_type_id'],
									'sensor_high' => $datainput['sensor_high'],
									'sensor_warning' => $datainput['sensor_warning'],
									'sn' => $datainput['sn'],
									'alert' => $datainput['alert'],
									'model' => $datainput['model'],
									'date'=>$now_date,
									'vendor' => $datainput['vendor'],
									'status'=>$datainput['status'],
									'lang'=>$lang_en,
								);

$sensor_group=$datainput['sensor_group_en'].$datainput['sensor_name_en'].' Hight :'.$datainput['sensor_high'].'Warning :'.$datainput['sensor_warning'].' Alert :'.$datainput['alert'].'SN :'.$datainput['sn'].'Model :'.$datainput['model'].'Vendor :'.$datainput['vendor'].'Date :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Sensorconfig_model->store_product($data_to_store_en)){
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
                                             $ref_title=$add." Senser: ".$sensor_group;
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
									'sensor_config_id_map' => $max_id,
									'hardware_id' => $datainput['hardware_id'],
									'sensor_group' => $datainput['sensor_group_th'],
									'sensor_name' => $datainput['sensor_name_th'],
									'sensor_type_id' => $datainput['sensor_type_id'],
									'sensor_high' => $datainput['sensor_high'],
									'sensor_warning' => $datainput['sensor_warning'],
									'alert' => $datainput['alert'],
									'sn' => $datainput['sn'],
									'model' => $datainput['model'],
									'date'=>$now_date,
									'vendor' => $datainput['vendor'],
									'status'=>$datainput['status'],
									'lang'=>$lang_th,
								);

$sensor_group=$datainput['sensor_group_th'].$datainput['sensor_name_th'].' Hight :'.$datainput['sensor_high'].'Warning :'.$datainput['sensor_warning'].' Alert :'.$datainput['alert'].'SN :'.$datainput['sn'].'Model :'.$datainput['model'].'Vendor :'.$datainput['vendor'].'Date :'.$now_date;
							//if the insert has returned true then we show the flash message
								if($this->Sensorconfig_model->store_product($data_to_store_th)){
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
                                             $ref_title=$add." Senser: ".$sensor_group;
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

						$sensorconfig_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/sensorconfig/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'sensorconfig/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/sensorconfig';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('sensorconfig');

    }       

	public function delete($id){

			echo "Deleting... $id"; # die();
			if($id<=3){
                    redirect('sensorconfig');
			     exit();
               }
			$OBJnews = $this->Sensorconfig_model->get_status($id);
			 #Debug($OBJnews); die();
			 
			
$sensor_group=$OBJnews[0]['sensor_group'].$OBJnews[0]['sensor_name'].' Hight :'.$OBJnews[0]['sensor_high'].'Warning :'.$OBJnews[0]['sensor_warning'].'SN :'.$OBJnews[0]['sn'].'Model :'.$OBJnews[0]['model'].'Vendor :'.$OBJnews[0]['vendor'];
	#Debug($sensor_group); die();		
			//$order_by = $OBJnews[0]['order_by'];
               if($id<=16){
                  $this->Sensorconfig_model->delete_sensor_config($id); //Update 
               }elseif($id>16){
                   $this->Sensorconfig_model->delete_sensor_config_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->Sensorconfig_model->update_orderdel($order_by);

               
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
               $ref_title="Delete ID ".$id." sensorconfig : ".$sensor_group;
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
               
               
			redirect('sensorconfig');
			die();
	}

}