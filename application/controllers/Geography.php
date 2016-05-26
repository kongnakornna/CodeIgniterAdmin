<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Geography extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Geography_model');
        $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		$this->load->model('Province_model');
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;

		//$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
		$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			              
        #$breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
		$breadcrumb[] = $language['zone'];
          
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

									$this->Geography_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());
									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Geography_model->update_orderid_to_down($order[$i]);
									}

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";

							}
							$data['success'] = "Save success.";
					}
					//die();
			}

			//"admin_menu" => $this->menufactory->getMenu(),
			$data = array(				
					"geography" => $this->Geography_model->get_geography(),
					"content_view" => 'address/geography',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb
			);

			$this->load->view('template/template',$data);
	}
	
	public function view_cat($id){
	
		$lang = $this->lang->language['lang'];
		
		$geography = $this->Geography_model->get_geography_by_id($id);
		//debug($geography);
		
		if($geography)
			for($i=0;$i<count($geography);$i++){
	
					if(($lang == 'th') && ($geography[$i]['lang'] == 'th'))
							$geo_name =  $geography[$i]['geo_name'];
					else if(($lang == 'en') && ($geography[$i]['lang'] == 'en'))
							$geo_name =  $geography[$i]['geo_name'];
							
			}
		return $geo_name;	
	}
	
	public function add($id = 0){	
		
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			$breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].'</a>';			              
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].'</a>';
						
			//"admin_menu" => $this->menufactory->getMenu(),
			if($id == 0){
				$breadcrumb[] = $language['add'];
				$data = array(						
						"content_view" => 'address/geography_add',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb
				);
			}else{
				$breadcrumb[] = $language['edit'];
				$data = array(						
						"cat_arr" => $this->Geography_model->get_geography_by_id($id),
						"content_view" => 'address/geography_edit',
						"ListSelect" => $ListSelect,
						"breadcrumb" => $breadcrumb
				);				
			}

			$this->load->view('template/template',$data);

	}
	
	public function status(){
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		$id = 0;
		
		$id = $this->input->post("id");

			//echo $id;die();
			
			$obj_status = $this->Geography_model->get_status($id);
			$cur_status = $obj_status[0]['status'];
			$geo_name = $obj_status[0]['geo_name'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;

			$this->Geography_model->status_geography($id, $cur_status);
			
			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "geography : ".$geo_name." [Status]",
								"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

		echo $cur_status;	
	}
	
	public function save(){
		$admin_id = $this->session->userdata('admin_id');
		$admin_type = $this->session->userdata('admin_type');
		$ListSelect = $this->Api_model_na->user_menu($admin_type);
		
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
				//$this->input->user_agent
				//form validation
				$this->form_validation->set_rules('geography_en', 'geography_en', 'required');
				$this->form_validation->set_rules('geography_th', 'geography_th', 'required');
				$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

				$admin_id = $this->session->userdata('admin_id');
				$modified_date = $create_date = date('Y-m-d h:i:s');
				
				$lang_en = array( "lang" => 'en');
				$lang_th = array( "lang" => 'th');

				$order_by = $this->Geography_model->get_max_order();
				$get_max_id = $this->Geography_model->get_max_id();

				$order = $order_by[0]['max_order'] +1;
				$max_id = $get_max_id[0]['max_id'] +1;

				//if the form has passed through the validation
				if ($this->form_validation->run()){

						if($this->input->post('geo_id') > 0){ //UPDATE SQL

								$geo_id = $this->input->post('geo_id');
								$geo_id_en = $this->input->post('geo_id_en');
								$geo_id_th = $this->input->post('geo_id_th');

								$data_to_store = array(
									'geo_name' => $this->input->post('geography_en'),
									'status' => $this->input->post('status'),
									'lastupdate_date' => $modified_date,
									'lastupdate_by' => $admin_id
								);
								$data_to_store_th = array(
									'geo_name' => $this->input->post('geography_th'),
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
								if($this->Geography_model->update_geography($geo_id_en, $data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Geography_model->update_geography($geo_id_th, $data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}

								$action = 2;
						
						}else{ //INSERT SQL
$geo_id_en=$max_id;
								$data_to_store = array(
									'geo_id_map' => $max_id,
									'geo_name' => $this->input->post('geography_en'),
									'status' => $this->input->post('status'),
									'lang' => 'en',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);
								$data_to_store_th = array(
									'geo_id_map' => $max_id,
									'geo_name' => $this->input->post('geography_th'),
									'status' => $this->input->post('status'),
									'lang' => 'th',
									'order_by' => $order,
									'create_date' => $create_date,
									'create_by' => $admin_id
								);
								$action = 1;

								//if the insert has returned true then we show the flash message
								if($this->Geography_model->store_product($data_to_store)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
								if($this->Geography_model->store_product($data_to_store_th)){
									$data['flash_message'] = TRUE; 
								}else{
									$data['flash_message'] = FALSE; 
								}
						}

						$geo_name = $data_to_store['geo_name'];

				}else{

						$geo_name = "Update [Fail]";

						//$data['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>\', \'</strong></div>';
						//$data['main_content'] = 'address/geography/add';
						
						//"admin_menu" => $this->menufactory->getMenu(),
						$data = array(									
									"content_view" => 'address/geography_add',
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
								"ref_id" => $geo_id_en,
								"ref_type" => 0,
								"ref_title" => "geography : ".$geo_name."",
								"action" => $action
			);
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

        //load the view
        //$data['main_content'] = 'address/geography';
        //$this->load->view('template/template',$data);

		if ($this->form_validation->run()) redirect('geography');
    }       

	public function delete($id){
			echo "Deleting... $id";
			
			$OBJnews = $this->Geography_model->get_status($id);

			//Debug($OBJnews);
			//die();
			$geo_name = $OBJnews[0]['geo_name'];
			$order_by = $OBJnews[0]['order_by'];

			$this->Geography_model->delete_geography($id);

			//**************Order New
			$this->Geography_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "geography : ".$geo_name,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('geography');
			die();
	}

}