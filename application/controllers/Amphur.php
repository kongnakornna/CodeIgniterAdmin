<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Amphur extends MY_Controller {

    public function __construct()    {
			parent::__construct();
			$this->load->model('Amphur_model');
			$breadcrumb = array();			
			
			if(!$this->session->userdata('is_logged_in')){
				redirect(base_url());
			}
    }

	public function index(){
		
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = $language['province'];
			$breadcrumb[] = $language['amphur'];
			
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
			        "amphur" => $this->Amphur_model->amphur(),				
					#"amphur" => $this->Amphur_model->get_province(),
					"content_view" => 'address/amphur',
					"ListSelect" => $ListSelect,
			);
			$this->load->view('template/template',$data);
	} 

	public function pid($id = 0){  
	       
            $provinceid = $this->uri->segment(3);  
		    $geoid = $this->uri->segment(4);  
		    $countries_id= $this->uri->segment(5); 
			if($id < 1){
				redirect(base_url('province'));
			}
			$province_id	= $id; # ส่งค่าไป
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$language = $this->lang->language;			
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
            $language = $this->lang->language;
			$get_province = $this->Province_model->get_province_by_id($provinceid,$language);
			//Debug($get_province);
		    $object = json_decode(json_encode($get_province), TRUE);
		    $province_name=$object[0]['province_name']; 	              
			$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			      
			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('province').'/pid/'.$geoid.'/'.$countries_id.'">'.$language['province'].'</a>';
			$breadcrumb[] =$province_name;
			$breadcrumb[] =$language['amphur'];
		
		

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

									$this->Amphur_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Amphur_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";
							}
					}
					//die();
			}

			if($province_id == 0) $province_id= $id; else $province_id =$province_id ;
           
			$data = array(
					"province" => $this->Province_model->get_province_by_id($province_id,$language),
					"amphur" => $this->Amphur_model->get_amphur($province_id),
					"content_view" => 'address/amphur',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$this->load->view('template/template',$data);
	}

	public function add($pid = 0){
			
			$this->load->model('Amphur_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));			
			$language = $this->lang->language;
 
			$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
			$breadcrumb[] = $language['province'];
			$breadcrumb[] = $language['amphur'];
			$breadcrumb[] = $language['add'];

			$data = array(
						"amphur_name" => $this->Amphur_model->get_amphur_by_id($pid),
						"content_view" => 'address/amphur_add',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function edit($id = 0){
			
			$pid = 0;
			$this->load->model('Amphur_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('amphur').'">'.$language['amphur'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('amphur/pid/'.$pid).'">'.$language['amphur'].'</a>';
			$breadcrumb[] = $language['edit'];			
			//Debug($this->input->get('amphur_id'));
			$pid = $this->input->get('amphur_id');

			$amphur_name = $this->Amphur_model->get_amphur_by_id($pid);
			//Debug($this->db->lastquery());
			$pid_arr = $this->Amphur_model->get_amphur_by_id($id);
			//Debug($this->db->lastquery());
			$data = array(
						"amphur_name" => $amphur_name,
						"pid_arr" => $pid_arr,
						"content_view" => 'address/amphur_edit',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);

	}

	public function list_dd($id = 0, $subpidid = 0){
			
			$this->load->model('Amphur_model');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;
			
			$first = "--- ".$language['please_select']." ---";
			$subpid = $this->Amphur_model->get_dd_list($id);
			//Debug($subpid);
			$allsubpid = count($subpid);

			echo '<option value="0">'.$first.'</option>';
			if($subpid)
				for($i=0;$i<$allsubpid;$i++){
						//echo "<li>".$subpid[$i]->amphur_id_map." ".$subpid[$i]->amphur_name."</li>";

						$sel = ($subpidid == $subpid[$i]->amphur_id_map) ? 'selected' : '';
						echo '<option value="'.$subpid[$i]->amphur_id_map.'" '.$sel.'>'.$subpid[$i]->amphur_name.'</option>';
						//echo '<option value="'.$subpid[$i]["amphur_id_map"].'">'.$subpid[$i]["amphur_name"].'</option>';
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
			
			$obj_status = $this->Amphur_model->get_status($id);

			$amphur_name = $obj_status[0]['amphur_name'];
			$order_by = $obj_status[0]['order_by'];
			$cur_status = $obj_status[0]['status'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$data = array(
					"pid_arr" => $this->Amphur_model->status_amphur($id, $cur_status),
			);

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Sub amphur : ".$amphur_name." [Status]",
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			return $cur_status;
		}
	}
	
	public function save(){

		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		$province_id = 0;
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				$province_id = $this->input->post('amphur_id_map');
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('amphur_en', 'amphur_en', 'required');
				$this->form_validation->set_rules('amphur_th', 'amphur_th', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

				//Debug($this->input->post());


				$order_by = $this->Amphur_model->get_max_order($province_id);
				$get_max_id = $this->Amphur_model->get_max_id();

				//Debug($order_by);
				//die();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('amphur_id') > 0){ //UPDATE SQL
								$action = 2;
								$amphur_id = $this->input->post('amphur_id');
								$amphur_id_en = $this->input->post('amphur_id_en');
								$amphur_id_th = $this->input->post('amphur_id_th');

								$data_to_store = array(
									'amphur_name' => $this->input->post('amphur_en'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $modified_date,
									'lastupdate_by' => $admin_id
								);
								$data_to_store_th = array(
									'amphur_name' => $this->input->post('amphur_th'),
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
								if($this->Amphur_model->update_amphur($amphur_id_en, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Amphur_model->update_amphur($amphur_id_th, $data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						
						}else{ //INSERT SQL
								$action = 1;

								$amphur_id_en = $max_id;
								$data_to_store = array(
									'amphur_id_map' => $max_id,
									'amphur_name' => $this->input->post('amphur_en'),
									'amphur_id' => $this->input->post('amphur_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'en',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								$data_to_store_th = array(
									'amphur_id_map' => $max_id,
									'amphur_name' => $this->input->post('amphur_th'),
									'amphur_id' => $this->input->post('amphur_id_map'),
									'status' => $this->input->post('status'),
									'lang' => 'th',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);

								//if the insert has returned true then we show the flash message
								if($this->Amphur_model->store_product($data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}

								if($this->Amphur_model->store_product($data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}

						$amphur_name = $data_to_store['amphur_name'];

				}else{
						
						$amphur_name = "Update [Fail]";

						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'address/amphur/add';						
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(
							"content_view" => 'address/amphur_add',
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
								"ref_id" => $amphur_id_en,
								"ref_type" => 0,
								"ref_title" => "Sub amphur : ".$amphur_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			if($this->form_validation->run()) redirect('amphur/pid/'.$province_id);

    }       

	public function delete($id){
			echo "Deleting... $id";
			
			$OBJnews = $this->Amphur_model->get_status($id);


			$amphur_name = $OBJnews[0]['amphur_name'];
			$order_by = $OBJnews[0]['order_by'];

			$this->Amphur_model->delete_amphur($id);

			//**************Order New
			$this->Amphur_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "amphur  : ".$amphur_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('amphur');
			die();
	}

}