<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class District extends MY_Controller {

    public function __construct()    {
			parent::__construct();
			$this->load->model('District_model');
			$breadcrumb = array();			
			
			if(!$this->session->userdata('is_logged_in')){
				redirect(base_url());
			}
    }

	public function index(){
		
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
            $breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].'</a>';
            $breadcrumb[] = '<a href="'.base_url('amphur').'">'.$language['amphur'].'</a>';
            $breadcrumb[] = '<a href="'.base_url('district').'">'.$language['district'].'</a>';
			
			
			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();

					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									//$this->Admin_menu_model->update_order($selectid[$i], $order[$i]);

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Admin_menu_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";

							}
					}
					//die();
			}

			//"admin_menu" => $this->menufactory->getMenu(),
			$data = array(		
			        "district" => $this->District_model->district(),		
					#"district" => $this->District_model->get_amphur(),
					"content_view" => 'address/district',
					"ListSelect" => $ListSelect,
			);
			$this->load->view('template/template',$data);
	}

	public function pid($id = 0){  
            
			if($id < 1){
				redirect(base_url('geography'));
			}
			  
			$amphurid = $this->uri->segment(3);  
			$provinceid = $this->uri->segment(4);  
		    $geoid = $this->uri->segment(5);  
		    $countries_id= $this->uri->segment(6);
			$amphur_id	= $amphurid; # ส่งค่าไป
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
			$language = $this->lang->language;			
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
            $language = $this->lang->language;
			
			$get_amphur = $this->Amphur_model->get_amphur_by_id($amphurid,$language);
			//Debug($get_amphur);
			$object = json_decode(json_encode($get_amphur), TRUE);
            $amphurname=$object[0]['amphur_name'];    
            
            
            
            
			$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			                  $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
            $breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].'</a>'; 
            $breadcrumb[] = '<a href="'.base_url('amphur'.'/pid/'.$provinceid.'/'.$geoid.'/'.$countries_id.'').'">'.$language['amphur'].'</a>'; 			
             $breadcrumb[] =$amphurname;
             $breadcrumb[] = $language['district'];
			
		 

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();

					 

					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									$this->District_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->District_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";
							}
					}
					//die();
			}

			if($amphur_id == 0) $amphur_id= $id; else $amphur_id =$amphur_id ;
           
			$data = array(
					"amphur" => $this->Amphur_model->get_amphur_by_id($amphur_id,$language),
					"district" => $this->District_model->get_district($amphur_id),
					"content_view" => 'address/district',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$this->load->view('template/template',$data);
	}

	public function add($pid = 0){
			
			$this->load->model('District_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));			
			$language = $this->lang->language;
 
			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = $language['amphur'];
			$breadcrumb[] = $language['district'];
			$breadcrumb[] = $language['add'];

			$data = array(
						"district_name" => $this->District_model->get_district_by_id($pid),
						"content_view" => 'address/district_add',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function edit($id = 0){
			
			$pid = 0;
			$this->load->model('District_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('district').'">'.$language['district'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('district/pid/'.$pid).'">'.$language['district'].'</a>';
			$breadcrumb[] = $language['edit'];			
			//Debug($this->input->get('district_id'));
			$pid = $this->input->get('district_id');

			$district_name = $this->District_model->get_district_by_id($pid);
			//Debug($this->db->lastquery());
			$pid_arr = $this->District_model->get_district_by_id($id);
			//Debug($this->db->lastquery());
			$data = array(
						"district_name" => $district_name,
						"pid_arr" => $pid_arr,
						"content_view" => 'address/district_edit',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);

	}

	public function list_dd($id = 0, $subpidid = 0){
			
			$this->load->model('District_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;
			
			$first = "--- ".$language['please_select']." ---";
			$subpid = $this->District_model->get_dd_list($id);
			//Debug($subpid);
			$allsubpid = count($subpid);

			echo '<option value="0">'.$first.'</option>';
			if($subpid)
				for($i=0;$i<$allsubpid;$i++){
						//echo "<li>".$subpid[$i]->district_id_map." ".$subpid[$i]->district_name."</li>";

						$sel = ($subpidid == $subpid[$i]->district_id_map) ? 'selected' : '';
						echo '<option value="'.$subpid[$i]->district_id_map.'" '.$sel.'>'.$subpid[$i]->district_name.'</option>';
						//echo '<option value="'.$subpid[$i]["district_id_map"].'">'.$subpid[$i]["district_name"].'</option>';
				}
			//Debug($subpid);
			//echo "subpidid = $subpidid";
			exit;

	}	
	
	public function status($id = 0){

		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{
			
			$obj_status = $this->District_model->get_status($id);

			$district_name = $obj_status[0]['district_name'];
			$order_by = $obj_status[0]['order_by'];
			$cur_status = $obj_status[0]['status'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$data = array(
					"pid_arr" => $this->District_model->status_district($id, $cur_status),
			);

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Sub district : ".$district_name." [Status]",
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			return $cur_status;
		}
	}
	
	public function save(){

		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		$amphur_id = 0;
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				$amphur_id = $this->input->post('district_id_map');
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('district_en', 'district_en', 'required');
				$this->form_validation->set_rules('district_th', 'district_th', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

				//Debug($this->input->post());


				$order_by = $this->District_model->get_max_order($amphur_id);
				$get_max_id = $this->District_model->get_max_id();

				//Debug($order_by);
				//die();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('district_id') > 0){ //UPDATE SQL
								$action = 2;
								$district_id = $this->input->post('district_id');
								$district_id_en = $this->input->post('district_id_en');
								$district_id_th = $this->input->post('district_id_th');

								$data_to_store = array(
									'district_name' => $this->input->post('district_en'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $modified_date,
									'lastupdate_by' => $admin_id
								);
								$data_to_store_th = array(
									'district_name' => $this->input->post('district_th'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $modified_date,
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
								if($this->District_model->update_district($district_id_en, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->District_model->update_district($district_id_th, $data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						
						}else{ //INSERT SQL
								$action = 1;

								$district_id_en = $max_id;
								$data_to_store = array(
									'district_id_map' => $max_id,
									'district_name' => $this->input->post('district_en'),
									'district_id' => $this->input->post('district_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'en',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								$data_to_store_th = array(
									'district_id_map' => $max_id,
									'district_name' => $this->input->post('district_th'),
									'district_id' => $this->input->post('district_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'th',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								//if the insert has returned true then we show the flash message
								if($this->District_model->store_product($data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}

								if($this->District_model->store_product($data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}

						$district_name = $data_to_store['district_name'];

				}else{
						
						$district_name = "Update [Fail]";

						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'address/district/add';						
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(
							"content_view" => 'address/district_add',
							"ListSelect" => $ListSelect,
							"error" =>  'Please, enter field name'
						);
						$this->load->view('template/template',$data);
						//exit;
				}
        }
        //load the view

			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $district_id_en,
								"ref_type" => 0,
								"ref_title" => "Sub district : ".$district_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			if($this->form_validation->run()) redirect('district/pid/'.$amphur_id);

    }       

	public function delete($id){
			echo "Deleting... $id";
			
			$OBJnews = $this->District_model->get_status($id);


			$district_name = $OBJnews[0]['district_name'];
			$order_by = $OBJnews[0]['order_by'];

			$this->District_model->delete_district($id);

			//**************Order New
			$this->District_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "district  : ".$district_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('district');
			die();
	}

}