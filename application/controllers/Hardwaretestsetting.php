<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Hardwaretestsetting extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Hardwaretestsetting_model');
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$language = $this->lang->language;
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
    
    public function index(){	
     if($this->session->userdata('admin_type')>'2'){ redirect(base_url()); }    
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
          
          $breadcrumb[] = '<a href="'.base_url('electricitytype').'">'.$language['electricitytype'].'</a>';		$breadcrumb[] = '<a href="'.base_url('waterpipe').'">'.$language['waterpipe'].'</a>';
          
		$breadcrumb[] = '<a href="'.base_url('hardwaretestsetting/add').'">'.$language['add'].$language['hardwaretestsetting'].'</a>';
		$breadcrumb[] = $language['hardwaretestsetting'];
          $total_rows= $this->Hardwaretestsetting_model->total($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){
			$limit = 100;
			$total_rows=(int)$total_rows;
		}else{
			$limit = $total_rows;
			if($limit>500){$limit=500; $total_rows=500;}
			}
		 #Debug($total_rows); Die();
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination");   
		
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Hardwaretestsetting_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwaretestsetting/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Hardwaretestsetting_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/hardwaretestsetting/listview"));
		}
		#Debug($pageConfig); die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		#Get data from my_model  
		if($startdate!==''){
		$hardware_list = $this->Hardwaretestsetting_model->get_hardware_test($pageIndex, $limit,$startdate,$enddate);
		}else{
		$hardware_list = $this->Hardwaretestsetting_model->get_hardware_test($pageIndex, $limit);
		}
		  //Debug($hardware_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
		 //$hardware_list = $this->Hardwaretestsetting_model->get_hardware_test();
		 
		  //Debug($hardware_list);die();
		 
			$data = array(				
               	"hardware_list" => $hardware_list,
				"content_view" => 'tmon/hardwaretestsetting',
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
		    if($this->session->userdata('admin_type')>'2'){ redirect(base_url()); }
		     $ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			
			$breadcrumb[] = '<a href="'.base_url('hardwaretestsetting').'">'.$language['hardwaretestsetting'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			
			$this->load->model('Electricitytype_model');
			$this->load->model('Waterpipe_model');
			$this->load->model('Hardware2test_model');
			$ListSelectElectricitytype= $this->Electricitytype_model->getSelect();	
			$ListSelectwaterpipe = $this->Waterpipe_model->getSelect();	
			$ListSelecthw_pump_id = $this->Hardware2test_model->getSelecthw_pump_id();	
			//Debug($ListSelecthw_pump_id); Die();
			$ListSelectflow_id = $this->Hardware2test_model->getSelectflow_id();	
			//Debug($ListSelectflow_id); Die();
			$ListSelectcurrent_id = $this->Hardware2test_model->getSelectcurrent_id();	
			//Debug($ListSelectcurrent_id); Die();
			$ListSelectvoltage_id = $this->Hardware2test_model->getSelectvoltage_id();	
			//Debug($ListSelectvoltage_id); Die();
			$ListSelectpower_id = $this->Hardware2test_model->getSelectpower_id();	
			//Debug($ListSelectpower_id);Die();
			$ListSelectcontrol_id = $this->Hardware2test_model->getSelectcontrol_id();	
			//Debug($ListSelectcontrol_id);Die();


			$data = array(						
				 "content_view" => 'tmon/hardwaretestsetting_add',
				 "ListSelectwaterpipe"=>$ListSelectwaterpipe,
				 "ListSelectElectricitytype"=>$ListSelectElectricitytype,
				 "ListSelecthw_pump_id"=>$ListSelecthw_pump_id,
				 "ListSelectflow_id"=>$ListSelectflow_id,
				 "ListSelectcurrent_id"=>$ListSelectcurrent_id,
				 "ListSelectvoltage_id"=>$ListSelectvoltage_id,
				 "ListSelectpower_id"=>$ListSelectpower_id,
				 "ListSelectcontrol_id"=>$ListSelectcontrol_id,
				 "ListSelect" => $ListSelect,
				 "breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($id = 0){
			if($this->session->userdata('admin_type')>'2'){ redirect(base_url()); }
		     $ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			
			$breadcrumb[] = '<a href="'.base_url('hardwaretestsetting').'">'.$language['hardwaretestsetting'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['edit'];
			
			$this->load->model('Hardwaretestsetting_model');
			$hardware_list = $this->Hardwaretestsetting_model->edit($id);
			//Debug($hardware_list);Die();
			$electricity_type_id_map=$hardware_list[0]['electricity_type_id_map'];				
			$waterpipe_id_map=$hardware_list[0]['waterpipe_id_map'];	
			$hw_pump_id=$hardware_list[0]['hw_pump_id'];				
			$flow_id=$hardware_list[0]['flow_id'];
			$current_id=$hardware_list[0]['current_id'];
			$voltage_id=$hardware_list[0]['voltage_id'];
			$power_id=$hardware_list[0]['power_id'];	
			$control_id=$hardware_list[0]['control_id'];	
			$this->load->model('Electricitytype_model');
			$this->load->model('Waterpipe_model');
			$this->load->model('Hardware2test_model');
			$ListSelectElectricitytype= $this->Electricitytype_model->getSelect($electricity_type_id_map);	
			$ListSelectwaterpipe = $this->Waterpipe_model->getSelect($waterpipe_id_map);	
			$ListSelecthw_pump_id = $this->Hardware2test_model->getSelecthw_pump_id($hw_pump_id);	
			//Debug($ListSelecthw_pump_id); Die();
			$ListSelectflow_id = $this->Hardware2test_model->getSelectflow_id($flow_id);	
			//Debug($ListSelectflow_id); Die();
			$ListSelectcurrent_id = $this->Hardware2test_model->getSelectcurrent_id($current_id);	
			//Debug($ListSelectcurrent_id); Die();
			$ListSelectvoltage_id = $this->Hardware2test_model->getSelectvoltage_id($voltage_id);	
			//Debug($ListSelectvoltage_id); Die();
			$ListSelectpower_id = $this->Hardware2test_model->getSelectpower_id($power_id);	
			//Debug($ListSelectpower_id);Die();
			$ListSelectcontrol_id = $this->Hardware2test_model->getSelectcontrol_id($control_id );	
			 #Debug($ListSelectcontrol_id);Die();

			$data = array(						
				 "hardware_list"=>$hardware_list,
				 "ListSelectwaterpipe"=>$ListSelectwaterpipe,
				 "ListSelectElectricitytype"=>$ListSelectElectricitytype,
				 "ListSelecthw_pump_id"=>$ListSelecthw_pump_id,
				 "ListSelectflow_id"=>$ListSelectflow_id,
				 "ListSelectcurrent_id"=>$ListSelectcurrent_id,
				 "ListSelectvoltage_id"=>$ListSelectvoltage_id,
				 "ListSelectpower_id"=>$ListSelectpower_id,
				 "ListSelectcontrol_id"=>$ListSelectcontrol_id,
				 "ListSelect" => $ListSelect,
				 "content_view" => 'tmon/hardwaretestsetting_edit',
				 "breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}	
	
	public function hardwaretest_run($id = 0){
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('hardwaretest').'">'.$language['hardwaretest'].'</a>';
			$breadcrumb[] = $language['test'];
			 
			$hardware_list=$this->Hardwaretestsetting_model->get_hardware_testrun($id);	
			#Debug($hardware_list);die();
			 
			$data = array(						
				"hardware_list" => $hardware_list,
				"content_view" => 'tmon/hardwaretestsetting_run',
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
			if($id==1){echo '1';exit();}
			//echo $id;die();
			$obj_status = $this->Hardwaretestsetting_model->get_status2($id);
			$cur_status = $obj_status[0]['status'];
			$hardwaretest_name = $obj_status[0]['hardwaretest_name'];
			$hardwaretest_decription  = $obj_status[0]['hardwaretest_decription'];
			$hardwaretest_name=$hardwaretest_name.' :'.$hardwaretest_decription;
			 //Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			$this->Hardwaretestsetting_model->status_update($id, $cur_status);
			
   
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
               $on = 'ON :'.$language['on'];$off = 'OFF :'.$language['off'];
               if($cur_status==1){$cur_statusname=$on;}else{$cur_statusname=$off;}
               $ref_title=$hardwaretest_name." [Status ".$cur_statusname."]";
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
			echo $cur_status;	
	}

 

	public function update(){
			  $language = $this->lang->language;
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['hardware'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Hardwaretestsetting_model->store($data_access['condition_group_id'], $data_to_store);
 

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
                         $ref_title="Admin hardware : ".$data_access['hardwaretest_name']." Grant Access";;
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
          
                         
                    redirect('hardwaretestsetting');
			 }

			$hardware_list = $this->Hardwaretestsetting_model->get_hardware_test();
			$data = array(				
					"hardware" => $hardware_list,
					"content_view" => 'tmon/hardwaretestsetting_update',
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
                    ################################
                   // debug($datainput); Die();
                    
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('hardwaretest_name_th', 'hardwaretest_name_th', 'required');
                    $this->form_validation->set_rules('hardwaretest_name_en', 'hardwaretest_name_en', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');



				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				
				$order_by = $this->Hardwaretestsetting_model->get_max_order();
				$get_max_id = $this->Hardwaretestsetting_model->get_max_id();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
                    $admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');
                    if(!isset($datainput['hardwaretest_id_map'])){$datainput['hardwaretest_id_map'] = 0;}
                    $hardwaretest_id_map=(int)$datainput['hardwaretest_id_map'];
                    //echo 'hardwaretest_id_map='.$hardwaretest_id_map;
  #debug($datainput); Die();
				//if the form has passed through the validation
				if ($this->form_validation->run()){
						
						if($hardwaretest_id_map > 0){ //UPDATE SQL
								$hardwaretest_name_en=$datainput['hardwaretest_name_en'];
								$hardwaretest_name_th=$datainput['hardwaretest_name_th'];
								$hardwaretest_id_map=$datainput['hardwaretest_id_map'];
                                       #debug($datainput); Die();
                                        $edit = $language['edit'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store_en = array(
                                             'electricity_type_id_map' => $datainput['electricity_type_id_map'],
                                             'waterpipe_id_map' => $datainput['waterpipe_id_map'],
									'hardwaretest_name' => $datainput['hardwaretest_name_en'],
									'hardwaretest_decription' => $datainput['hardwaretest_decription_en'],
									'hw_pump_id' => $datainput['hw_pump_id'],
									'flow_id' => $datainput['flow_id'],
									'current_id' => $datainput['current_id'],
									'voltage_id' => $datainput['voltage_id'],
									'power_id' => $datainput['power_id'],
									'power_id' => $datainput['power_id'],
									'control_id' => $datainput['control_id'],
									'create_date'=>$now_date,
									'status' => 1,
                                             'lang'=>$lang_en,
								);

								$data_to_store_th = array(
                                             'electricity_type_id_map' => $datainput['electricity_type_id_map'],
                                             'waterpipe_id_map' => $datainput['waterpipe_id_map'],
                                             'hardwaretest_name' => $datainput['hardwaretest_name_th'],
											'hardwaretest_decription' => $datainput['hardwaretest_decription_th'],
											'hw_pump_id' => $datainput['hw_pump_id'],
											'flow_id' => $datainput['flow_id'],
											'current_id' => $datainput['current_id'],
											'voltage_id' => $datainput['voltage_id'],
											'power_id' => $datainput['power_id'],
											'control_id' => $datainput['control_id'],
											'create_date'=>$now_date,
											'status' => 1,
                                             'lang'=>$lang_th,
								);
#echo 'Update :'; Debug($data_to_store_en); Debug($data_to_store_th);  Die();
								//if the insert has returned true then we show the flash message
								if($this->Hardwaretestsetting_model->store_update($hardwaretest_id_map,$lang_en, $data_to_store_en)){
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
                                                       $ref_title=$edit." ID ".$hardwaretest_id_map." Hardwaretest : ".$hardwaretest_name_en.$datainput['hardwaretest_decription_en'];
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
								//////////////////////
                                        //if the Update has returned true then we show the flash message
								if($this->Hardwaretestsetting_model->store_update($hardwaretest_id_map,$lang_th, $data_to_store_th)){
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
                                                  $ref_title=$edit." ID ".$hardwaretest_id_map." Hardwaretest : ".$hardwaretest_name_th.$datainput['hardwaretest_decription_th'];
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

						}else if($hardwaretest_id_map=='' || $hardwaretest_id_map==0){ //INSERT SQL
						
 //echo 'Insert :'; Debug($datainput);  Die();
								$hardwaretest_name_en=$datainput['hardwaretest_name_en'];
								$hardwaretest_name_th=$datainput['hardwaretest_name_th'];
								//$statusna=$datainput['status'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store = array(
								    'hardwaretest_id_map' =>  $max_id,
									'electricity_type_id_map' => $datainput['electricity_type_id_map'],
                                    'waterpipe_id_map' => $datainput['waterpipe_id_map'],
									'hardwaretest_name' => $datainput['hardwaretest_name_en'],
									'hardwaretest_decription' => $datainput['hardwaretest_decription_en'],
									'hw_pump_id' => $datainput['hw_pump_id'],
									'flow_id' => $datainput['flow_id'],
									'current_id' => $datainput['current_id'],
									'voltage_id' => $datainput['voltage_id'],
									'power_id' => $datainput['power_id'],
									'control_id' => $datainput['control_id'],
									'create_date'=>$now_date,
									'status' => 1,
                                             'lang'=>$lang_en,
								);

								$data_to_store_th = array(
                                    'hardwaretest_id_map' =>  $max_id,
									'electricity_type_id_map' => $datainput['electricity_type_id_map'],
                                    'waterpipe_id_map' => $datainput['waterpipe_id_map'],
									'hardwaretest_name' => $datainput['hardwaretest_name_th'],
									'hardwaretest_decription' => $datainput['hardwaretest_decription_th'],
									'hw_pump_id' => $datainput['hw_pump_id'],
									'flow_id' => $datainput['flow_id'],
									'current_id' => $datainput['current_id'],
									'voltage_id' => $datainput['voltage_id'],
									'power_id' => $datainput['power_id'],
									'control_id' => $datainput['control_id'],
									'create_date'=>$now_date,
									'status' => 1,
                                             'lang'=>$lang_th,
								);
								
							 // echo 'Insert :'; Debug($data_to_store); Debug($data_to_store_th);  Die();
								
							//if the insert has returned true then we show the flash message
								if($this->Hardwaretestsetting_model->store_insertt($data_to_store)){
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
                                             $ref_title=$add.' ID: '.$max_id.$hardwaretest_name_en.$datainput['hardwaretest_decription_en'];
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
								if($this->Hardwaretestsetting_model->store_insertt($data_to_store_th)){
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
                                             $ref_title=$add.' ID: '.$max_id.$hardwaretest_name_th.$datainput['hardwaretest_decription_th'];
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
						}
						 

				}else{

						$hardwaretest_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/hardwaretestsetting/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'hardwaretestsetting/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/hardware';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('hardwaretestsetting');

    }       

	public function delete($id){

			echo "Deleting... $id";
			if($id<=1){
                    redirect('hardwaretestsetting');
			     exit();
               }
			$OBJnews = $this->Hardwaretestsetting_model->get_status($id);
			#Debug($OBJnews);die();
			$hardwaretest_name = $OBJnews[0]['hardwaretest_name'];
			$hardwaretest_decription = $OBJnews[0]['hardwaretest_decription'];
			//$order_by = $OBJnews[0]['order_by'];
               if($id<=1){
                  $this->Hardwaretestsetting_model->delete($id); //Update 
               }elseif($id>1){
                   $this->Hardwaretestsetting_model->delete_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->Hardwaretestsetting_model->update_orderdel($order_by);

               
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
               $ref_title="Delete ID ".$id." Hardware : ".$hardwaretest_name.' : '.$hardwaretest_decription;
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
               
               
			redirect('hardwaretestsetting');
			die();
	}

}