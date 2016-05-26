<?php

class Province extends MY_Controller {

    public function __construct()    {
			parent::__construct();
			$this->load->model('Province_model');
			$breadcrumb = array();			
			
			if(!$this->session->userdata('is_logged_in')){
				redirect(base_url());
			}
    }

	public function index(){
		
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].'</a>'; 
			
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
					"province" => $this->Province_model->province(),
					"content_view" => 'address/province',
					"ListSelect" => $ListSelect,
			);
			$this->load->view('template/template',$data);
	}

	public function pid($id = 0){
            $geoid = $this->uri->segment(3);  
		    $countries_id= $this->uri->segment(4); 
            
			if($id < 1){
				redirect(base_url('geography'));
			}
			$geo_id	= $geoid; # ส่งค่าไป
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$language = $this->lang->language;			
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));

			$get_geography = $this->Geography_model->get_geography_by_id($geoid);
			//Debug($get_geography);
			$object = json_decode(json_encode($get_geography), TRUE);
            $geoname=$object[0]['geo_name'];
            $breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			      
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
            $breadcrumb[]=$geoname;
			 

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

									$this->Province_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Province_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";
							}
					}
					//die();
			}

			if($geo_id == 0) $geo_id= $id; else $geo_id =$geo_id ;

			$data = array(
					"geo" => $this->Geography_model->get_geography_by_id($geo_id),
					"province" => $this->Province_model->get_province($geo_id),
					"content_view" => 'address/province',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$this->load->view('template/template',$data);
	}

	public function add($pid = 0){
			
			$this->load->model('Geography_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));			
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('province/cat/'.$pid).'">'.$language['province'].'</a>';
			$breadcrumb[] = $language['add'];

			$data = array(
						"geography_name" => $this->Geography_model->get_geography_by_id($pid),
						"content_view" => 'address/province_add',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function edit($id = 0){
			
			$pid = 0;
			$this->load->model('Geography_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('province/cat/'.$pid).'">'.$language['province'].'</a>';
			$breadcrumb[] = $language['edit'];			
			//Debug($this->input->get('geography_id'));
			$pid = $this->input->get('geography_id');

			$geography_name = $this->Geography_model->get_geography_by_id($pid);
			//Debug($this->db->lastquery());
			$cat_arr = $this->Province_model->get_province_by_id($id);
			//Debug($this->db->lastquery());
			$data = array(
						"geography_name" => $geography_name,
						"cat_arr" => $cat_arr,
						"content_view" => 'address/province_edit',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);

	}

	public function list_dd($id = 0, $subcatid = 0){
			
			$this->load->model('Geography_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;
			
			$first = "--- ".$language['please_select']." ---";
			$subcat = $this->Province_model->get_dd_list($id);
			//Debug($subcat);
			$allsubcat = count($subcat);

			echo '<option value="0">'.$first.'</option>';
			if($subcat)
				for($i=0;$i<$allsubcat;$i++){
						//echo "<li>".$subcat[$i]->province_id_map." ".$subcat[$i]->province_name."</li>";

						$sel = ($subcatid == $subcat[$i]->province_id_map) ? 'selected' : '';
						echo '<option value="'.$subcat[$i]->province_id_map.'" '.$sel.'>'.$subcat[$i]->province_name.'</option>';
						//echo '<option value="'.$subcat[$i]["geography_id_map"].'">'.$subcat[$i]["geography_name"].'</option>';
				}
			//Debug($subcat);
			//echo "subcatid = $subcatid";
			exit;

	}	
	
	public function status($id = 0){

		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{
			
			$obj_status = $this->Province_model->get_status($id);

			$province_name = $obj_status[0]['province_name'];
			$order_by = $obj_status[0]['order_by'];
			$cur_status = $obj_status[0]['status'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$data = array(
					"cat_arr" => $this->Province_model->status_province($id, $cur_status),
			);

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Sub geography : ".$province_name." [Status]",
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			return $cur_status;
		}
	}
	
	public function save(){

		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		$geo_id = 0;
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				$geo_id = $this->input->post('geography_id_map');
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('province_en', 'province_en', 'required');
				$this->form_validation->set_rules('province_th', 'province_th', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

				//Debug($this->input->post());


				$order_by = $this->Province_model->get_max_order($geo_id);
				$get_max_id = $this->Province_model->get_max_id();

				//Debug($order_by);
				//die();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('province_id') > 0){ //UPDATE SQL
								$action = 2;
								$province_id = $this->input->post('province_id');
								$province_id_en = $this->input->post('province_id_en');
								$province_id_th = $this->input->post('province_id_th');

								$data_to_store = array(
									'province_name' => $this->input->post('province_en'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $modified_date,
									'lastupdate_by' => $admin_id
								);
								$data_to_store_th = array(
									'province_name' => $this->input->post('province_th'),
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
								if($this->Province_model->update_province($province_id_en, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Province_model->update_province($province_id_th, $data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						
						}else{ //INSERT SQL
								$action = 1;

								$province_id_en = $max_id;
								$data_to_store = array(
									'province_id_map' => $max_id,
									'province_name' => $this->input->post('province_en'),
									'geography_id' => $this->input->post('geography_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'en',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								$data_to_store_th = array(
									'province_id_map' => $max_id,
									'province_name' => $this->input->post('province_th'),
									'geography_id' => $this->input->post('geography_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'th',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								//if the insert has returned true then we show the flash message
								if($this->Province_model->store_product($data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}

								if($this->Province_model->store_product($data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}

						$province_name = $data_to_store['province_name'];

				}else{
						
						$province_name = "Update [Fail]";

						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'address/province/add';						
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(
							"content_view" => 'address/province_add',
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
								"ref_id" => $province_id_en,
								"ref_type" => 0,
								"ref_title" => "Sub geography : ".$province_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			if($this->form_validation->run()) redirect('province/cat/'.$geo_id);

    }       

	public function delete($id){
			echo "Deleting... $id";
			
			$OBJnews = $this->Province_model->get_status($id);


			$province_name = $OBJnews[0]['province_name'];
			$order_by = $OBJnews[0]['order_by'];

			$this->Province_model->delete_province($id);

			//**************Order New
			$this->Province_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Sub geography  : ".$province_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('geography');
			die();
	}

}