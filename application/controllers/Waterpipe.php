<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Waterpipe extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $lang= $this->lang->language['lang'];
          $this->load->model('waterpipe_model');
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
		$breadcrumb[] = '<a href="'.base_url('waterpipe/add').'">'.$language['add'].$language['waterpipe'].'</a>';
		$breadcrumb[] = $language['waterpipe'];
          $total_rows= $this->waterpipe_model->total($startdate,$enddate);
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
		$pageConfig = doPagination($this->waterpipe_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/waterpipe/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->waterpipe_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/waterpipe/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$waterpipe_list = $this->waterpipe_model->waterpipe_list($pageIndex, $limit,$startdate,$enddate);
		}else{
		$waterpipe_list = $this->waterpipe_model->waterpipe_list($pageIndex, $limit);
		}
		  //Debug($waterpipe_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$waterpipe_list = $this->waterpipe_model->waterpipe_list();
			//Debug($waterpipe_list);
			//die();

			$data = array(				
                    "waterpipe_list" => $waterpipe_list,
				"content_view" => 'tmon/waterpipe',
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
			$breadcrumb[] = '<a href="'.base_url('waterpipe').'">'.$language['waterpipe'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'tmon/waterpipe_add',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}
		
	public function edit($waterpipe_id_map){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	
			$breadcrumb[] = '<a href="'.base_url('waterpipe').'">'.$language['waterpipe'].'</a>';
			$breadcrumb[] = $language['edit'];
			$waterpipe_list = $this->waterpipe_model->get_waterpipe_edit($waterpipe_id_map);
               //Debug($waterpipe_list);Die();
			$data = array(						
				"waterpipe_list" => $waterpipe_list,
				"content_view" => 'tmon/waterpipe_edit',
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
			$obj_status = $this->waterpipe_model->get_status2($id);
			$cur_status = $obj_status[0]['status'];
			$waterpipe_name = $obj_status[0]['waterpipe_name'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			$this->waterpipe_model->status_waterpipe2($id, $cur_status);
			
   
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
               if($cur_status==1){$cur_status1='ON';}else{$cur_status1='OFF';}
               $ref_title=$waterpipe_name." [Status ".$cur_status."]";
               $action=2;
               $date=date('Y-m-d H:i:s');
               $status=1;
          	$log_activity = array(
							"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $_SERVER['REMOTE_ADDR'],
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $date,
                                   "status" => $status,
                                   "lang" => $this->lang->language['lang'],
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

			$breadcrumb[] = $language['waterpipe'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['waterpipe_id_map']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->waterpipe_model->store($data_access['waterpipe_id_map'], $data_to_store);
 

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
                         $ref_title="Admin waterpipe : ".$data_access['waterpipe_name']." Grant Access";;
                         $action=2;
                         $date=date('Y-m-d H:i:s');
                         $status=1;
                    	$log_activity = array(
                    					"admin_id" => $session_id_admin,
                    					"ref_id" => $ref_id,
                    					"from_ip" => $ipaddress,
                    					"ref_type" => $ref_type,
                    					"ref_title" => $ref_title,
                    					"action" => $action,
                                             "create_date" => $date,
                                             "status" => $status,
                                             "lang" => $lang
                    			);			
                    	$this->Admin_log_activity_model->store($log_activity);
                         //Debug($log_activity); Die();
                    //**************Log activity
          
                         
                    redirect('waterpipe');
			 }

			$waterpipe_list = $this->waterpipe_model->get_hardware_type();
			$data = array(				
					"waterpipe" => $waterpipe_list,
					"content_view" => 'tmon/waterpipe_update',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
					"success" => 'Grant access success.'
			);

			$this->load->view('template/template',$data);

	}

	public function save(){
		$lang=$this->lang->language['lang'];
		$language = $this->lang->language;
		$admin_id = $this->session->userdata('admin_id');
		$admin_type = $this->session->userdata('admin_type');
		$ListSelect = $this->Api_model_na->user_menu($admin_type);
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
                    $datainput = $this->input->post();
                //debug($datainput); Die();
                     
                    
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
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('waterpipe_name_th', 'waterpipe_name_th', 'required');
                    $this->form_validation->set_rules('waterpipe_name_en', 'waterpipe_name_en', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');



				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				
				$order_by = $this->waterpipe_model->get_max_order();
				$get_max_id = $this->waterpipe_model->get_max_id();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;
                    $admin_id = $this->session->userdata('admin_id');
				$modified_date = $date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

                     if(!isset($datainput['waterpipe_id_map'])){$datainput['waterpipe_id_map'] = 0;}
				 
				$waterpipe_id_map=$datainput['waterpipe_id_map'];
				//echo '$waterpipe_id_map='.$waterpipe_id_map;
				//debug($datainput); Die();
				if ($this->form_validation->run()){
				//if($waterpipe_name_en!==''){
							
						if($waterpipe_id_map > 0){ //UPDATE SQL
								$waterpipe_name_en=$datainput['waterpipe_name_en'];
								$waterpipe_name_th=$datainput['waterpipe_name_th'];
                                      
                                        $edit = $language['edit'];
                                        $statusna=$datainput['status'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store_en = array(
                                             'waterpipe_id_map' => $waterpipe_id_map,
									'waterpipe_name' => $datainput['waterpipe_name_en'],
									'size' => $datainput['size'],
									'status' => $statusna,
                                             'date'=>$now_date,
                                             //'lang'=>$lang_en
								);

								$data_to_store_th = array(
                                             'waterpipe_id_map' => $waterpipe_id_map,
									'waterpipe_name' => $datainput['waterpipe_name_th'],
									'size' => $datainput['size'],
									'status' => $statusna,
                                             'date'=>$now_date,
                                             //'lang'=>$lang_th
								);
  #debug($data_to_store_en);  debug($data_to_store_th); Die();
								//if the insert has returned true then we show the flash message
								if($this->waterpipe_model->store($waterpipe_id_map,$lang_en, $data_to_store_en)){
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
                                                       $ref_title=$edit." ID ".$waterpipe_id_map." waterpipe : ".$waterpipe_name_en;
                                                       $action=2;
                                                       $date=date('Y-m-d H:i:s');
                                                       $status=1;
                                                  	$log_activity = array(
                                                  					"admin_id" => $session_id_admin,
                                                  					"ref_id" => $ref_id,
                                                  					"from_ip" => $ipaddress,
                                                  					"ref_type" => $ref_type,
                                                  					"ref_title" => $ref_title,
                                                  					"action" => $action,
                                                                           "create_date" => $date,
                                                                           "status" => $status,
                                                                           "lang" => $lang_en
                                                  			);	
                                                  	 #Debug($log_activity); Die();		
                                                  	$this->Admin_log_activity_model->store($log_activity);
                                                      
                                                  //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								//////////////////////
                                        //if the insert has returned true then we show the flash message
								if($this->waterpipe_model->store($waterpipe_id_map,$lang_th, $data_to_store_th)){
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
                                                  $ref_title=$edit." ID ".$waterpipe_id_map." waterpipe : ".$waterpipe_name_th;
                                                  $action=2;
                                                  $date=date('Y-m-d H:i:s');
                                                  $status=1;
                                             	$log_activity = array(
                                             					"admin_id" => $session_id_admin,
                                             					"ref_id" => $ref_id,
                                             					"from_ip" => $ipaddress,
                                             					"ref_type" => $ref_type,
                                             					"ref_title" => $ref_title,
                                             					"action" => $action,
                                                                      "create_date" => $date,
                                                                      "status" => $status,
                                                                      "lang" => $lang_th
                                             			);			
                                             	$this->Admin_log_activity_model->store($log_activity);
                                                  //Debug($log_activity); Die();
                                             //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
                                        
                                        
                                        
						
						}else{  //INSERT SQL
						
						
						
						
								$waterpipe_name_en=$datainput['waterpipe_name_en'];
								$waterpipe_name_th=$datainput['waterpipe_name_th'];
								$statusna=$datainput['status'];
                                        $lang_th='th';
                                        $lang_en='en';
								$data_to_store = array(
                                             'waterpipe_id_map' => $max_id,
									'waterpipe_name' => $datainput['waterpipe_name_en'],
									'size' => $datainput['size'],
									'status' => $statusna,
                                             'date'=>$now_date,
                                             'lang'=>$lang_en
								);

								$data_to_store_th = array(
                                             'waterpipe_id_map' => $max_id,
									'waterpipe_name' => $datainput['waterpipe_name_th'],
									'size' => $datainput['size'],
									'status' => $statusna,
                                             'date'=>$now_date,
                                             'lang'=>$lang_th
								);
							//if the insert has returned true then we show the flash message
								if($this->waterpipe_model->store_product($data_to_store)){
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
                                             $ref_title=$add."ID .$max_id. ".$waterpipe_name_en;
                                             $action=2;
                                             $date=date('Y-m-d H:i:s');
                                             $status=1;
                                        	$log_activity = array(
                                        					"admin_id" => $session_id_admin,
                                        					"ref_id" => $ref_id,
                                        					"from_ip" => $ipaddress,
                                        					"ref_type" => $ref_type,
                                        					"ref_title" => $ref_title,
                                        					"action" => $action,
                                                                 "create_date" => $date,
                                                                 "status" => $status,
                                                                 "lang" => $lang
                                        			);			
                                        	$this->Admin_log_activity_model->store($log_activity);
                                             //Debug($log_activity); Die();
                                        //**************Log activity
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->waterpipe_model->store_product($data_to_store_th)){
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
                                             $ref_title=$add."ID .$max_id. ".$waterpipe_name_th;
                                             $action=2;
                                             $date=date('Y-m-d H:i:s');
                                             $status=1;
                                        	$log_activity = array(
                                        					"admin_id" => $session_id_admin,
                                        					"ref_id" => $ref_id,
                                        					"from_ip" => $ipaddress,
                                        					"ref_type" => $ref_type,
                                        					"ref_title" => $ref_title,
                                        					"action" => $action,
                                                                 "create_date" => $date,
                                                                 "status" => $status,
                                                                 "lang" => $lang
                                        			);			
                                        	$this->Admin_log_activity_model->store($log_activity);
                                             //Debug($log_activity); Die();
                                        //**************Log activity 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}
						 

				}else{
//debug($datainput);  
echo'error';die();
						$waterpipe_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/waterpipe/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'waterpipe/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }


        //load the view
        //$data['main_content'] = 'basic/waterpipe';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('waterpipe');

    }       

	public function delete($id){

			echo "Deleting... $id";
			if($id<=1){
                    redirect('waterpipe');
			     exit();
               }
			$OBJnews = $this->waterpipe_model->get_status($id);
			//Debug($OBJnews);
			//die();
			$waterpipe_name = $OBJnews[0]['waterpipe_name'];
			//$order_by = $OBJnews[0]['order_by'];
               if($id<1){
                  $this->waterpipe_model->delete_waterpipe($id); //Update 
               }elseif($id>1){
                   $this->waterpipe_model->delete_waterpipe_by_admin($id); //Delete database
               }
			
			//**************Order New
			//$this->waterpipe_model->update_orderdel($order_by);

               
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
               $ref_title="Delete ID ".$id." waterpipe : ".$waterpipe_name;
               $action=2;
               $date=date('Y-m-d H:i:s');
               $status=1;
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $_SERVER['REMOTE_ADDR'],
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $date,
                                   "status" => $status,
                                   "lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
               
               
			redirect('waterpipe');
			die();
	}

}