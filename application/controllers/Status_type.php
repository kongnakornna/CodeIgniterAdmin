<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
 */
class Status_type extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Status_type_model');
        $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		
		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;

		//$breadcrumb[] = '<a href="'.base_url('category').'">'.$language['category'].'</a>';
		$breadcrumb[] = $language['status_type'];
				
		$data = array(				
				"status_type" => $this->Status_type_model->get_status_type(),
				"content_view" => 'member/status_type',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb,
		);

			$this->load->view('template/template',$data);
	}
	
	public function add($id = 0){	
		
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			
			$breadcrumb[] = '<a href="'.base_url('status_type').'">'.$language['status_type'].'</a>';
						
			//"admin_menu" => $this->menufactory->getMenu(),
			if($id == 0){
				$breadcrumb[] = $language['add'];
				$data = array(						
						"content_view" => 'member/status_type_add',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
				);
			}else{
				$breadcrumb[] = $language['edit'];
				$data = array(						
						"cat_arr" => $this->Status_type_model->get_status_type($id),
						"content_view" => 'member/status_type_edit',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
				);
			}

			$this->load->view('template/template',$data);

	}
	
	public function status($id = 0){

		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{
			
			//$status_type_list = $this->Status_type_model->get_status_type($id);			
			$obj_status = $this->Status_type_model->get_status($id, 0);
			$cur_status = $obj_status[0]['status'];
			$status_type_name = $obj_status[0]['status_type_name'];
			//Debug($cur_status);
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$data = array(
					"cat_arr" => $this->Status_type_model->status_status_type($id, $cur_status),
					//"content_view" => 'member/category_edit',
					//"ListSelect" => $ListSelect,
					//"error" => array()
			);
             $status_type = $language['status_type'];
			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => $status_type.": ".$status_type_name." [Status]",
								"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			return $cur_status;
		}	
		//$this->load->view('template/template',$data);	
	}
	
	public function save(){

		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;
		
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('status_type_en', 'status_type_en', 'required');
				$this->form_validation->set_rules('status_type_th', 'status_type_th', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

				//$order_by = $this->Status_type_model->get_max_order();
				$get_max_id = $this->Status_type_model->get_max_id();

				//$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('status_type_id') > 0){ //UPDATE SQL

								$status_type_id_map = $this->input->post('status_type_id');
								$status_type_id_en = $this->input->post('status_type_id_en');
								$status_type_id_th = $this->input->post('status_type_id_th');
								$action = 2;
								$data_to_store = array(
									'status_type_name' => $this->input->post('status_type_en'),
									'status' => $this->input->post('status'),
									'lastupdate_by' => $admin_id
								);
								$data_to_store_th = array(
									'status_type_name' => $this->input->post('status_type_th'),
									'status' => $this->input->post('status'),									
									'lastupdate_by' => $admin_id
								);

								/*echo "<pre>";
								print_r($data_to_store);
								echo "</pre>";

								echo "<pre>";
								print_r($data_to_store_th);
								echo "</pre>";
								die();*/

								//if the insert has returned true then we show the flash message
								if($this->Status_type_model->store_update($status_type_id_en, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Status_type_model->store_update($status_type_id_th, $data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						
						}else{ //INSERT SQL
								
								$action = 1;
								$data_to_store = array(
									'status_type_id_map' => $max_id,
									'status_type_name' => $this->input->post('status_type_en'),
									'status' => $this->input->post('status'),
									'lang' => 'en',
									'create_date' => $create_date,
									'create_by' => $admin_id
								);
								$data_to_store_th = array(
									'status_type_id_map' => $max_id,
									'status_type_name' => $this->input->post('status_type_th'),
									'status' => $this->input->post('status'),
									'lang' => 'th',
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								//if the insert has returned true then we show the flash message
								if($this->Status_type_model->store($data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Status_type_model->store($data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}
						$status_type_name = $this->input->post('status_type_th');

				}else{

						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'member/category/add';
						
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'member/status_type_add',
									"ListSelect" => $ListSelect,
									"error" =>  'Please, enter field name'
						);

						$status_type_name = $this->input->post('status_type_th')." [Fail]";

						$this->load->view('template/template',$data);
						//exit;
				}
        }
 
 $status_type_id_map='0';
 $language = $this->lang->language;
 $status_typett = $language['status_type'];
 $add_typett = $language['add'];
 $edie_typett = $language['edit'];
 $savedata = $language['savedata'];
		//**************Log activity  	
		$log_activity = array(
						"admin_id" => $this->session->userdata('admin_id'),
						"ref_id" => $status_type_id_map,
						"ref_type" => 0,
						"ref_title" => $add_typett.'/'.$edie_typett.':'.$status_typett." : ".$status_type_name,
						"action" => $action
		);			
		$this->Admin_log_activity_model->store($log_activity);
		//**************Log activity

        //load the view
        //$data['main_content'] = 'member/category';
        //$this->load->view('template/template',$data);

		if ($this->form_validation->run())  
		if($this->Admin_log_activity_model->store($log_activity)){
				
			//**************Log activity
                echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			    echo "alert('$savedata');
				window.location='" . base_url() . "status_type'";
				echo "</script>";
				exit();
			#redirect('status_type');
			}
		
    }       

	public function delete($id){
			echo "Deleting... $id";
			$language = $this->lang->language;
			$OBJnews = $this->Status_type_model->get_status($id, 0);
			 $deletett = $language['delete'];
			 $status_typett = $language['status_type'];
			 $savedata = $language['savedata'];
			$title = $deletett.$status_typett.': ID  '.$id;
		 
			//$order_by = $OBJnews[0]['order_by'];

			$this->Status_type_model->delete_user($id);

			//**************Order New
			//$this->Status_type_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => $title,
								"action" => $action
			);			
			if($this->Admin_log_activity_model->store($log_activity)){
				
			//**************Log activity
                echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			    echo "alert('$savedata');
				window.location='" . base_url() . "status_type'";
				echo "</script>";
				exit();
			#redirect('status_type');
			}
			die();
	}

}