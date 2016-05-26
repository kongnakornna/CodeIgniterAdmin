<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Team extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Admin_team_model');
       // $breadcrumb = array();
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

		//$breadcrumb[] = '<a href="'.base_url('admin_team').'">'.$language['admin_team'].'</a>';
		$breadcrumb[] = $language['admin_team'];

			/*if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();
					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									$this->Admin_team_model->update_order($selectid[$i], $order[$i]);
									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Admin_team_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";

							}
							$data['success'] = "Save success.";
					}
			}*/




$total_rows= $this->Admin_team_model->totalteam($startdate,$enddate);
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
		$pageConfig = doPagination($this->Admin_team_model->totalteam($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/team/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Admin_team_model->totalteam($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/team/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$team_list = $this->Admin_team_model->get_admin_team($pageIndex, $limit,$startdate,$enddate);
		}else{
		$team_list = $this->Admin_team_model->get_admin_team($pageIndex, $limit);
		}
		  //Debug($team_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();


			//////////$team_list = $this->Admin_team_model->get_admin_team();
			//Debug($team_list);
			//die();

			$data = array(				
                    "admin_team" => $team_list,
					"content_view" => 'admin/admin_team',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
                    "total_rows" => $total_rows,
					"startdate" => $startdate,
					"enddate" => $enddate,
					"pagination" => $links
			);

			$this->load->view('template/template',$data);
	}
		
	public function add($id = 0){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			

			$breadcrumb[] = '<a href="'.base_url('team').'">'.$language['admin_team'].'</a>';
			//"admin_menu" => $this->menufactory->getMenu(),
			$breadcrumb[] = $language['add'];
			$data = array(						
				"content_view" => 'admin/admin_team_add',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);

			$this->load->view('template/template',$data);
	}
		
	public function edit($id = 0){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;	

			$breadcrumb[] = '<a href="'.base_url('team').'">'.$language['admin_team'].'</a>';
			$breadcrumb[] = $language['edit'];

			$team_list = $this->Admin_team_model->get_admin_teame_edit($id);

			$data = array(						
				"admin_team" => $team_list,
				"content_view" => 'admin/admin_team_edit',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
            //Debug($data);
		    //die();
			$this->load->view('template/template',$data);
	}	

	public function status($id){
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			//echo $id;die();
			$obj_status = $this->Admin_team_model->get_status($id);
			$cur_status = $obj_status[0]['status'];
			$admin_team_name = $obj_status[0]['admin_team_title'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			$this->Admin_team_model->status_admin_team($id, $cur_status);
			
			//**************Log activity
			$ipaddress=$_SERVER['REMOTE_ADDR'];
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"from_ip" => $ipaddress,
								"ref_type" => 0,
								"ref_title" => "Admin team : ".$admin_team_name." [Status ".$cur_status."]",
								"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
			echo $cur_status;	
	}

	public function access($id){
			
			$this->load->model('Category_model');

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;			

			$breadcrumb[] = '<a href="'.base_url('team').'">'.$language['admin_team'].'</a>';
			$breadcrumb[] = $language['edit'];

			$team_list = $this->Admin_team_model->get_admin_teame_edit($id);

			$data = array(						
				"admin_team" => $team_list,
				"content_view" => 'admin/admin_team_access',
				"category" => $this->Category_model->get_category(),
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}

	public function update(){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['admin_team'];
			
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
			
					$data_access = $this->input->post();
					//Debug($data_access);
					$json_access = json_encode($data_access['category_id']);
					//Debug($json);
					$data_to_store = array(
							'access' => $json_access,
					);
					$this->Admin_team_model->store($data_access['admin_team_id'], $data_to_store);

					//**************Log activity
					$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $data_access['admin_team_id'],
								"ref_type" => 0,
								"ref_title" => "Admin team : ".$data_access['admin_team_title']." Grant Access",
								"action" => 2
					);
					$this->Admin_log_activity_model->store($log_activity);
                    redirect('team');
					//**************Log activity
			 }

			$team_list = $this->Admin_team_model->get_admin_team();
			$data = array(				
					"admin_team" => $team_list,
					"content_view" => 'admin/admin_team_update',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
					"success" => 'Grant access success.'
			);

			$this->load->view('template/template',$data);

	}

	public function save(){

		$admin_id = $this->session->userdata('admin_id');
		$admin_type = $this->session->userdata('admin_type');
		$ListSelect = $this->Api_model_na->user_menu($admin_type);
		
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('admin_team_title', 'admin_team_title', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$now_date = date('Y-m-d h:i:s');
				
				//$order_by = $this->Admin_team_model->get_max_order();
				$get_max_id = $this->Admin_team_model->get_max_id();

				//$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('admin_team_id') > 0){ //UPDATE SQL

								$admin_team_id = $this->input->post('admin_team_id');

								$data_to_store = array(
									'admin_team_title' => $this->input->post('admin_team_title'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $now_date,
									'lastupdate_by' => $admin_id
								);

								/*echo "<pre>";
								print_r($data_to_store);
								echo "</pre>";
								die();*/

								//if the insert has returned true then we show the flash message
								if($this->Admin_team_model->store($admin_team_id, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								$action = 2;
						
						}else{ //INSERT SQL

								$data_to_store = array(
									'admin_team_id' => $max_id,
									'admin_team_title' => $this->input->post('admin_team_title'),
									'status' => $this->input->post('status'),
									'create_date' => $now_date,
									'create_by' => $admin_id
								);
								$action = 1;
								$admin_team_id = $max_id;

								//if the insert has returned true then we show the flash message
								if($this->Admin_team_model->store(0, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}
						$admin_team_name = $data_to_store['admin_team_title'];

				}else{

						$admin_team_name = "Update [Fail]";
						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'basic/admin_team/add';
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'team/add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$this->load->view('template/template',$data);
						//exit;
				}
        }

		//**************Log activity
		$log_activity = array(
					"admin_id" => $this->session->userdata('admin_id'),
					"ref_id" => $admin_team_id,
					"ref_type" => 0,
					"ref_title" => "Admin team : ".$admin_team_name."",
					"action" => $action
		);
		$this->Admin_log_activity_model->store($log_activity);
		//**************Log activity
        //load the view
        //$data['main_content'] = 'basic/admin_team';
        //$this->load->view('template/template',$data);
		if ($this->form_validation->run()) 
			 redirect('team');

    }       

	public function delete($id){

			echo "Deleting... $id";
			
			//$OBJnews = $this->Admin_team_model->get_status($id);
			//Debug($OBJnews);
			//die();
			//$admin_team_title = $OBJnews[0]['admin_team_title'];
			//$order_by = $OBJnews[0]['order_by'];
if($id<=6){
   $this->Admin_team_model->delete_admin_team($id); //Update 
}elseif($id>6){
    $this->Admin_team_model->delete_admin_team_by_admin($id); //Delete database
}
			
            
            

			//**************Order New
			//$this->Admin_team_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Admin team : ".$admin_team_title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
			redirect('team');
			die();
	}

}