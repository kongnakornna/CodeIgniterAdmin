<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Setingworktime extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Setingworktime_model');
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
		$breadcrumb[] = '<a href="'.base_url('setingworktime/add').'">'.$language['add'].$language['setingworktime'].'</a>';
		$breadcrumb[] = $language['setingworktime'];
          $total_rows= $this->Setingworktime_model->total($startdate,$enddate);
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
		$pageConfig = doPagination($this->Setingworktime_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/setingworktime/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Setingworktime_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/setingworktime/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$setingworktime_list = $this->Setingworktime_model->get_condition_group($pageIndex, $limit,$startdate,$enddate);
		}else{
		$setingworktime_list = $this->Setingworktime_model->get_condition_group($pageIndex, $limit);
		}
		  //Debug($setingworktime_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$setingworktime_list = $this->Setingworktime_model->get_condition_group();
			//Debug($setingworktime_list);
			//die();

			$data = array(				
                    "setingworktime" => $setingworktime_list,
				"content_view" => 'tmon/setingworktime',
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

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			
			$breadcrumb[] = '<a href="'.base_url('setingworktime').'">'.$language['setingworktime'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'tmon/setingworktime_add',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($id = 0){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('setingworktime').'">'.$language['setingworktime'].'</a>';
			$breadcrumb[] = $language['edit'];
			$setingworktime_list = $this->Setingworktime_model->get_condition_groupe_edit($id);
               //Debug($setingworktime_list);Die();
			$data = array(						
				"setingworktime" => $setingworktime_list,
				"content_view" => 'tmon/setingworktime_edit',
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
			$obj_status = $this->Setingworktime_model->get_status2($id);
			$cur_status = $obj_status[0]['status'];
			$setingworktime_name = $obj_status[0]['condition_group_name'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			$this->Setingworktime_model->status_condition_group($id, $cur_status);
			
   
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
               if($cur_status==1){$cur_status='ON';}else{$cur_status='OFF';}
               $ref_title=$setingworktime_name." [Status ".$cur_status."]";
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

			$breadcrumb[] = $language['setingworktime'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Setingworktime_model->store($data_access['condition_group_id'], $data_to_store);
 

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
                         $ref_title="Admin setingworktime : ".$data_access['condition_group_name']." Grant Access";;
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
          
                         
                    redirect('setingworktime');
			 }

			$setingworktime_list = $this->Setingworktime_model->get_condition_group();
			$data = array(				
					"setingworktime" => $setingworktime_list,
					"content_view" => 'tmon/setingworktime_update',
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
                    $condition_group_id2=$datainput['condition_group_id2'];
                   // debug($datainput); Die();
                    
                    $hour_start=(int)$datainput['hour_start'];
                    $minute_start=(int)$datainput['minute_start'];
                    $hour_finish=(int)$datainput['hour_finish'];
                    $minute_finish=(int)$datainput['minute_finish'];
                    $date_start=(int)$datainput['date_start'];
                    $date_finish=(int)$datainput['date_finish'];
                    $month_start=(int)$datainput['month_start'];
                    $month_finish=(int)$datainput['month_finish'];
                    
                   /* 
                    echo '  $hour_start==>'.$hour_start;
                    echo ' :$minute_start==>'.$minute_start;
                    echo ' :$hour_finish==>'.$hour_finish;
                    echo ' :$minute_finish==>'.$minute_finish;
                    echo ' :$date_start==>'.$date_start;
                    echo ' :$date_finish==>'.$date_finish;
                    echo ' :$month_start==>'.$month_start;
                    echo ' :$month_finish==>'.$month_finish;
                     */
                    
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
                    #################****hour****###############
                    if($hour_start>$hour_finish){
					$housenn1=$forbiddenna.$housenn.$startna.'('.$hour_start.')'.$exceeding.''.$housenn.$finishna.' ('.$hour_finish.') '.$pleasecheckthedata;              if($condition_group_id2!=='' || $condition_group_id2!==0){
					echo '<script language="javascript">alert("'.$housenn1.'");top.location="'.base_url('setingworktime/edit/'.$condition_group_id2).'"; window.history.back(-1);</script>';	
					}else if($condition_group_id2=='' || $condition_group_id2==0){
					echo '<script language="javascript">alert("'.$housenn1.'");top.location="'.base_url('setingworktime/add/').'"; window.history.back(-1);</script>';	
					}
					exit();
				}else if($hour_start==$hour_finish){
				 #################****Minute****###############
				if($minute_start>$minute_finish){
				$minutenn1=$forbiddenna.$minutenn.$startna.' ('.$minute_start.') '.$exceeding.'->'.$minutenn.$finishna.' ('.$minute_finish.') '.$pleasecheckthedata;				
					
if($condition_group_id2!=='' || $condition_group_id2!==0){
echo '<script language="javascript">alert("'.$minutenn1.'");top.location="'.base_url('setingworktime/edit/'.$condition_group_id2).'";</script>';	
				 }else if($condition_group_id2=='' || $condition_group_id2==0){
echo '<script language="javascript">alert("'.$minutenn1.'");top.location="'.base_url('setingworktime/add/').'";</script>';	
				 }
				 exit();
				}}#################****Date****###############
				if($date_start>$date_finish){
					$datenn1=$forbiddenna.$datenn.$startna.' ('.$date_start.') '.$exceeding.' '.$datenn.$finishna.' ('.$date_finish.')'.$pleasecheckthedata;
					
					
if($condition_group_id2!=='' || $condition_group_id2!==0){
 ;
echo '<script language="javascript">alert("'.$datenn1.'");top.location="'.base_url('setingworktime/edit/'.$condition_group_id2).'";</script>';
				 }else if($condition_group_id2=='' || $condition_group_id2==0){
echo '<script language="javascript">alert("'.$datenn1.'");top.location="'.base_url('setingworktime/add/').'";</script>';		
				 }
				 exit();
				}#################****Month****###############
				if($month_start>$month_finish){
					$monthnn1=$forbiddenna.$monthnn.$startna.' ('.$month_start.') '.$exceeding.' '.$monthnn.$finishna.' ('.$month_finish.')'.$pleasecheckthedata;
					
					
if($condition_group_id2!=='' || $condition_group_id2!==0){
 ;
echo '<script language="javascript">alert("'.$monthnn1.'");top.location="'.base_url('setingworktime/edit/'.$condition_group_id2).'";</script>';	
				 }else if($condition_group_id2=='' || $condition_group_id2==0){
echo '<script language="javascript">alert("'.$monthnn1.'");top.location="'.base_url('setingworktime/add/').'";</script>';		
				 }
				 exit();
				}################################
                    
 
                    
                 
                    ################################
                    ################################
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('condition_group_name_th', 'condition_group_name_th', 'required');
                    $this->form_validation->set_rules('condition_group_name_en', 'condition_group_name_en', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');



				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				
				$order_by = $this->Setingworktime_model->get_max_order();
				$get_max_id = $this->Setingworktime_model->get_max_id();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
                    $admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');
                    
				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($condition_group_id2 > 0){ //UPDATE SQL
								$condition_group_name_en=$datainput['condition_group_name_en'];
								$condition_group_name_th=$datainput['condition_group_name_th'];
                                       // debug($datainput); Die();
                                        $edit = $language['edit'];
                                        $statusna=$datainput['status'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store_en = array(
                                             'condition_group_id2' => $condition_group_id2,
									'condition_group_name' => $datainput['condition_group_name_en'],
									'hour_start' => $datainput['hour_start'],
									'minute_start' => $datainput['minute_start'],
									'hour_finish' => $datainput['hour_finish'],
									'minute_finish' => $datainput['minute_finish'],
									'day_start' => $datainput['day_start'],
									'day_finish' => $datainput['day_finish'],
									'date_start' => $datainput['date_start'],
									'date_finish' => $datainput['date_finish'],
									'month_start' => $datainput['month_start'],
									'month_finish' => $datainput['month_finish'],
									'Sun' => $datainput['Sun'],
                                             'Mon' => $datainput['Mon'],
                                             'Tue' => $datainput['Tue'],
                                             'Wed' => $datainput['Wed'],
                                             'Thu' => $datainput['Thu'],
                                             'Fri' => $datainput['Fri'],
                                             'Sat' => $datainput['Sat'],
									'status' => $statusna,
                                             'create_date'=>$now_date,
                                             'lang'=>$lang_en
								);

								$data_to_store_th = array(
                                             'condition_group_id2' => $condition_group_id2,
									'condition_group_name' => $datainput['condition_group_name_th'],
									'hour_start' => $datainput['hour_start'],
									'minute_start' => $datainput['minute_start'],
									'hour_finish' => $datainput['hour_finish'],
									'minute_finish' => $datainput['minute_finish'],
									'day_start' => $datainput['day_start'],
									'day_finish' => $datainput['day_finish'],
									'date_start' => $datainput['date_start'],
									'date_finish' => $datainput['date_finish'],
									'month_start' => $datainput['month_start'],
									'month_finish' => $datainput['month_finish'],
                                             'Sun' => $datainput['Sun'],
                                             'Mon' => $datainput['Mon'],
                                             'Tue' => $datainput['Tue'],
                                             'Wed' => $datainput['Wed'],
                                             'Thu' => $datainput['Thu'],
                                             'Fri' => $datainput['Fri'],
                                             'Sat' => $datainput['Sat'],
									'status' => $statusna,
                                             'create_date'=>$now_date,
                                             'lang'=>$lang_th
								);

								//if the insert has returned true then we show the flash message
								if($this->Setingworktime_model->store($condition_group_id2,$lang_en, $data_to_store_en)){
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
                                                       $ref_title=$edit." ID ".$condition_group_id2." Setingworktime : ".$condition_group_name_en;
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
                                        //if the insert has returned true then we show the flash message
								if($this->Setingworktime_model->store($condition_group_id2,$lang_th, $data_to_store_th)){
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
                                                  $ref_title=$edit." ID ".$condition_group_id2." Setingworktime : ".$condition_group_name_th;
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
								$condition_group_name_en=$datainput['condition_group_name_en'];
								$condition_group_name_th=$datainput['condition_group_name_th'];
								$statusna=$datainput['status'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store = array(
                                             'condition_group_id2' => $max_id,
									'condition_group_name' => $datainput['condition_group_name_en'],
									'hour_start' => $datainput['hour_start'],
									'minute_start' => $datainput['minute_start'],
									'hour_finish' => $datainput['hour_finish'],
									'minute_finish' => $datainput['minute_finish'],
									'day_start' => $datainput['day_start'],
									'day_finish' => $datainput['day_finish'],
									'date_start' => $datainput['date_start'],
									'date_finish' => $datainput['date_finish'],
									'month_start' => $datainput['month_start'],
									'month_finish' => $datainput['month_finish'],
                                             'Sun' => $datainput['Sun'],
                                             'Mon' => $datainput['Mon'],
                                             'Tue' => $datainput['Tue'],
                                             'Wed' => $datainput['Wed'],
                                             'Thu' => $datainput['Thu'],
                                             'Fri' => $datainput['Fri'],
                                             'Sat' => $datainput['Sat'],
									'status' => $statusna,
                                             'create_date'=>$now_date,
                                             'lang'=>$lang_en
								);

								$data_to_store_th = array(
                                             'condition_group_id2' => $max_id,
									'condition_group_name' => $datainput['condition_group_name_th'],
									'hour_start' => $datainput['hour_start'],
									'minute_start' => $datainput['minute_start'],
									'hour_finish' => $datainput['hour_finish'],
									'minute_finish' => $datainput['minute_finish'],
									'day_start' => $datainput['day_start'],
									'day_finish' => $datainput['day_finish'],
									'date_start' => $datainput['date_start'],
									'date_finish' => $datainput['date_finish'],
									'month_start' => $datainput['month_start'],
									'month_finish' => $datainput['month_finish'],
                                             'Sun' => $datainput['Sun'],
                                             'Mon' => $datainput['Mon'],
                                             'Tue' => $datainput['Tue'],
                                             'Wed' => $datainput['Wed'],
                                             'Thu' => $datainput['Thu'],
                                             'Fri' => $datainput['Fri'],
                                             'Sat' => $datainput['Sat'],
									'status' => $statusna,
                                             'create_date'=>$now_date,
                                             'lang'=>$lang_th
								);
							//if the insert has returned true then we show the flash message
								if($this->Setingworktime_model->store_product($data_to_store)){
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
                                             $ref_title=$add." Condition:ID .$max_id. ".$condition_group_name_en;
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
								if($this->Setingworktime_model->store_product($data_to_store_th)){
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
                                             $ref_title=$add." Condition:ID .$max_id. ".$condition_group_name_th;
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

						$setingworktime_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/setingworktime/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'setingworktime/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/setingworktime';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('setingworktime');

    }       

	public function delete($id){

			echo "Deleting... $id";
			if($id<=3){
                    redirect('setingworktime');
			     exit();
               }
			$OBJnews = $this->Setingworktime_model->get_status($id);
			//Debug($OBJnews);
			//die();
			$condition_group_name = $OBJnews[0]['condition_group_name'];
			//$order_by = $OBJnews[0]['order_by'];
               if($id<=6){
                  $this->Setingworktime_model->delete_setingworktime($id); //Update 
               }elseif($id>6){
                   $this->Setingworktime_model->delete_setingworktime_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->Setingworktime_model->update_orderdel($order_by);

               
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
               $ref_title="Delete ID ".$id." Setingworktime : ".$condition_group_name;
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
               
               
			redirect('setingworktime');
			die();
	}

}