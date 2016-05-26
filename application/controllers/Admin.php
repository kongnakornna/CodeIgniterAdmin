<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Admin extends MY_Controller {
    public function __construct()    {
        parent::__construct();
			$this->load->model('Admin_team_model');
			$this->load->library("AdminFactory");
			$this->load->library("MenuFactory");
			$this->load->library('session');
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
	function index(){		
		$this->load->library("AdminFactory");
			if($this->session->userdata['admin_type'] > 3){
				redirect(base_url());
				die();
			}
			$admin_type1 = $this->session->userdata('admin_type');
			$language = $this->lang->language;
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$breadcrumb[] = $language['member_list'];

			//$orderby = 'order_by';
			//$query = $this->_ci->db->select("*")->from("_admin_menu")->order_by($orderby, 'ASC')->get();
			//$data["query"] = $query;
			/*$tbl_admin = $this->db->dbprefix('_admin');
			$sql = "SELECT * FROM `".$tbl_admin."` WHERE admin_id = ? AND status = ? AND admin_type_id = ?";
			$data['sql'] = $sql;
			$data['all_member'] = $this->db->query($sql, array(1, 1, 1)); */
			

			$admin_type_id = ($this->input->post('admin_type_id')) ? $this->input->post('admin_type_id') : 0;
			$search_form = $this->input->post();
               
               if(isset($search_form['admin_type_id'])){
			 //Debug($search_form); Die();
                    $admin_type_id = trim($search_form['admin_type_id']);
                    // echo $admin_type_id; Die();
				$memberlist = $this->adminfactory->getAdminna(0,Null, $admin_type_id);
                }else if(isset($search_form['keyword'])){
				$keyword = trim($search_form['keyword']);
				$memberlist = $this->adminfactory->getAdminna(0, $keyword);
			}else{
				$memberlist = $this->adminfactory->getAdminna(0, null, $admin_type_id);
			}
               
                // Debug($search_form); Die();
			 // Debug($this->db->last_query());
			 // Debug($memberlist); Die();
	 
	 

			//$ym = date('Y-m-',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
                

               $getAdminType = $this->adminfactory->getAdminTypena();
			$admin_type_list = $this->Admin_model->getSelectAdminType($admin_type_id, $getAdminType);
               //Debug($getAdminType);
			//Debug($admin_type_list);
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
				     "getAdminType" => $getAdminType,
					"memberlist1" => $this->adminfactory->getAdmin(),
					"memberlist" => $memberlist,
                         "admin_type_list" => $admin_type_list,
					"membertype" => $this->adminfactory->getAdminType(),
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$data['headtxt'] = "Member List";
			$data['msg'] = 'ok';

			$data['content_view'] = 'admin/memberlist';
			$this->load->view('template/template',$data);
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
               $ref_title="[Member View :".''." ]";
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
		                         "status" => $status,
		                         "lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
	}

	function login(){
			$this->load->view('admin/login');
			//$this->load->view('admin/login-ace');	
	}

	function debug(){
			$this->load->view('admin/debug');
	}

	function error404(){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$data = array(
					"ListSelect" => $ListSelect,
			);

			$data['content_view'] = 'admin/error404';
			$this->load->view('template/template',$data);
	
	}

	function error500(){

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$data = array(
					"ListSelect" => $ListSelect,
			);

			$data['content_view'] = 'admin/error500';
			$this->load->view('template/template',$data);
	
	}

	function dashboard(){
			$language = $this->lang->language;
			$breadcrumb[] = $language['dashboard'];
			$admin_id = $this->session->userdata('admin_id');
			$admin_type = $this->session->userdata('admin_type');
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			//$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$notification_news_list = $notification_column_list = $notification_gallery_list = $notification_vdo_list = $notification_dara_list = array();
 

			$loadfile = "admintype".$admin_type.".json";
			$admin_menu = LoadJSON($loadfile);

			$data = array(
					"ListSelect" => $ListSelect,
					//"breadcrumb"=>$breadcrumb,
					"admin_menu" => $admin_menu,
 
			);

		$data['content_view'] = 'admin/dashboard';
		$this->load->view('template/template',$data);
	
	}

function welcome(){	
		
			$admin_id = $this->session->userdata('admin_id');
			$admin_type = $this->session->userdata('admin_type');

			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$notification_news_list = $notification_column_list = $notification_gallery_list = $notification_vdo_list = $notification_dara_list = array();
 

			$loadfile = "admintype".$admin_type.".json";
			$admin_menu = LoadJSON($loadfile);

			$data = array(
					"ListSelect" => $ListSelect,
					"admin_menu" => $admin_menu,
 
			);

		$data['content_view'] = 'admin/dashboard';
		$this->load->view('template/template',$data);
	}


	public function remove_img($id = 0){

			$this->load->library("AdminFactory");

			$img = $this->input->post('img');
			@unlink($img);

			$obj_data['admin_avatar'] = '';
			$obj_data['admin_id'] = $id;

			//$result = $this->adminfactory->updateAdmin($obj_data);
			//echo $result;
			Debug($obj_data);

			if($this->adminfactory->updateAdmin($obj_data))
				echo 'Yes';
			else
				echo 'No';

	}

	function memberlist(){
			$this->load->library("AdminFactory");
			if($this->session->userdata['admin_type'] > 3){
				redirect(base_url());
				die();
			}
			$admin_type1 = $this->session->userdata('admin_type');
			$language = $this->lang->language;
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
			$breadcrumb[] = $language['member_list'];

			//$orderby = 'order_by';
			//$query = $this->_ci->db->select("*")->from("_admin_menu")->order_by($orderby, 'ASC')->get();
			//$data["query"] = $query;
			/*$tbl_admin = $this->db->dbprefix('_admin');
			$sql = "SELECT * FROM `".$tbl_admin."` WHERE admin_id = ? AND status = ? AND admin_type_id = ?";
			$data['sql'] = $sql;
			$data['all_member'] = $this->db->query($sql, array(1, 1, 1)); */
			

			$admin_type_id = ($this->input->post('admin_type_id')) ? $this->input->post('admin_type_id') : 0;
			$search_form = $this->input->post();
               
               if(isset($search_form['admin_type_id'])){
			 //Debug($search_form); Die();
                    $admin_type_id = trim($search_form['admin_type_id']);
                    // echo $admin_type_id; Die();
				$memberlist = $this->adminfactory->getAdminna(0,Null, $admin_type_id);
                }else if(isset($search_form['keyword'])){
				$keyword = trim($search_form['keyword']);
				$memberlist = $this->adminfactory->getAdminna(0, $keyword);
			}else{
				$memberlist = $this->adminfactory->getAdminna(0, null, $admin_type_id);
			}
               
                // Debug($search_form); Die();
			 // Debug($this->db->last_query());
			 // Debug($memberlist); Die();
	 
	 

			//$ym = date('Y-m-',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
                

               $getAdminType = $this->adminfactory->getAdminTypena();
			$admin_type_list = $this->Admin_model->getSelectAdminType($admin_type_id, $getAdminType);
               //Debug($getAdminType);
			//Debug($admin_type_list);
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
				     "getAdminType" => $getAdminType,
					"memberlist1" => $this->adminfactory->getAdmin(),
					"memberlist" => $memberlist,
                         "admin_type_list" => $admin_type_list,
					"membertype" => $this->adminfactory->getAdminType(),
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$data['headtxt'] = "Member List";
			$data['msg'] = 'ok';

			$data['content_view'] = 'admin/memberlist';
			$this->load->view('template/template',$data);
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
               $ref_title="[Member View :".''." ]";
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
		                         "status" => $status,
		                         "lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
	}

	function memberadd(){

			$this->load->model('Admin_team_model');

			$language = $this->lang->language;
			$admin_id = $this->session->userdata('admin_id');
			$admin_type = $this->session->userdata('admin_type');
			$ListSelect = $this->Api_model_na->user_menu($admin_type);
			$team_list = $this->Admin_team_model->get_admin_team();

			$breadcrumb[] = '<a href="'.base_url('admin/memberlist').'">'.$language['member_list'].'</a>';
			$breadcrumb[] = $language['add'];
			
			//$this->load->library("MenuFactory");
			//$keyword = date('Y-m-',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"memberlist" => 0,
					"team_list" => $team_list,
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$data['headtxt'] = $language['add_member'];
			$data['content_view'] = 'admin/memberadd';
			$this->load->view('template/template',$data);
	}
 
	function memberedit($id){
               if($id==''){ $id=$this->uri->segment(3); }
			$this->load->library("AdminFactory");
			$this->load->library("MenuFactory");
			$this->load->model('Admin_team_model');

			$language = $this->lang->language;
			$admin_id = $this->session->userdata('admin_id');
			$admin_type = $this->session->userdata('admin_type');
			$ListSelect = $this->Api_model_na->user_menu($admin_type);
			$team_list = $this->Admin_team_model->get_admin_team();

			$breadcrumb[] = '<a href="'.base_url('admin/memberlist').'">'.$language['member_list'].'</a>';
			$breadcrumb[] = $language['edit'];
						
			//$keyword = date('Y-m-',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"memberlist" => $this->adminfactory->getAdmin($id),
					"team_list" => $team_list,
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
			);

			$data['headtxt'] = $language['edit_member'];
			$data['content_view'] = 'admin/memberedit';

			if($id > 0)
				$this->load->view('template/template',$data);
			else
				redirect('admin/memberlist');
	}

	
    
    function profile($id){

    			$this->load->library("AdminFactory");
    			$this->load->model('Admin_team_model');

    			$language = $this->lang->language;
    			$admin_id = $this->session->userdata('admin_id');
    			$admin_type = $this->session->userdata('admin_type');
    			$ListSelect = $this->Api_model_na->user_menu($admin_type);
    			$team_list = $this->Admin_team_model->get_admin_team();

    			$breadcrumb[] = '<a href="'.base_url('overview').'">'.$language['overview'].'</a>';
    			$breadcrumb[] = $language['profile'];
    						
    			//$keyword = date('Y-m-',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
    			$data = array(
    					"admin_menu" => $this->menufactory->getMenu(),
    					"memberlist" => $this->adminfactory->getAdmin($id),
    					"team_list" => $team_list,
    					"ListSelect" => $ListSelect,
    					"breadcrumb" => $breadcrumb,
    			);

    			$data['headtxt'] = $language['edit_member'];
    			$data['content_view'] = 'admin/profile';

    			if($id > 0)
    				$this->load->view('template/template',$data);
    			else
    				redirect('profile');
    	}
    
    

	function upload_avata($id = 0){

				//Exam uploads
                    $path= './uploads/admin/';
                    chmod($path, 0777);
                    $config["upload_path"] = $path;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';

				$this->load->library('upload', $config);
				// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
				$this->upload->initialize($config);
				/*echo "<pre>";
				print_r($this->upload->data());
				echo "</pre>";*/

				if ( ! $this->upload->do_upload('admin_avatar')){
					$error = array('error' => $this->upload->display_errors());
					//$this->load->view('upload_form', $error);
					$data['upload_status'] = $error;
				}else{
					$data = array(
							'admin_menu' => $this->menufactory->getMenu(),
							'upload_data' => $this->upload->data()
					);
					//$data = array('upload_data' => $this->upload->data());
					//$this->load->view('upload_success', $data);
					$data['upload_status'] = $data;
				}

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
               $ref_title="Uploads Photo Member ID : ".$id;
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
                                   "status" => $status,
                         		"lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
				//die();

				$data['content_view'] = 'upload_status';
				$this->load->view('template/template',$data);
	}

	function member_save($id = 0){

		$this->load->library('Form_validation');
			
		/*echo "<pre>";
		print_r($this);
		echo "</pre>";*/
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('admin_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('admin_lastname', 'Lastname', 'trim|required');
		//$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		//$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');

		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|matches[password1]');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		/*if($this->form_validation->run() == FALSE){
				echo "FALSE";
		}else
				echo "TRUE";

		echo "<pre>";
		print_r($this->form_validation);
		echo "</pre>";
		die();*/

		if($this->form_validation->run() == FALSE){

				if($id == 0) redirect('admin/memberedit');
				else redirect('admin/memberedit/'.$id);
				echo "FALSE";

		}else{

				//Exam uploads
				$config['upload_path'] = './uploads/admin/';
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';

				$this->load->library('upload', $config);

				// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('admin_avatar')){
					$error = array('error' => $this->upload->display_errors());
					$data['upload_status'] = $error;
				}else{
					$data = array(
							'admin_menu' => $this->menufactory->getMenu(),
							'upload_data' => $this->upload->data(),
							'upload_status' => $data,
							'error' => array()
					);
					//$data['upload_status'] = $data;
				}

				/*echo $this->upload->client_name;
				echo "<pre>";
				print_r($data);
				echo "</pre>";
				die();*/

				//$this->load->model("Admin_model");
				$this->load->library("AdminFactory");
				$now_date = date('Y-m-d h:i:s',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
				/*arr_log = array(
						'domain'		=>  $this->input->post('domain'),
						'from_ip'		=> $this->input->ip_address,
						'send_date'		=> $now_date,
						'status'	=> 'Add'
				);
				$this->db->insert('_log',$arr_log);*/

				$ip_address = $this->input->ip_address;
				$user_agent = $this->input->user_agent;

				/*echo "ip_address:$ip_address<br>";
				echo "user_agent:$user_agent<br>";
				echo "postdata:<br>";*/

				/*echo "post->admin_name:".$this->input->post('admin_name')."<br>";
				echo "post->admin_lastname:".$this->input->post('admin_lastname')."<br>";
				echo "post->admin_id:".$this->input->post('admin_id')."<br>";
				echo "post->admin_avatar:".$this->input->post('admin_avatar')."<br>";*/

				/*echo "<pre>";
				print_r($this->form_validation);
				echo "</pre>";*/

				//$this->load->library('encrypt');

				$admin_id = $this->input->post('admin_id');

				if($admin_id > 0){

							if($this->upload->client_name){
									if(($this->input->post('password1') != '') && ($this->input->post('password1') == $this->input->post('password2')))
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'status'	=> strtolower($this->input->post('status')),
													'admin_password'	=> md5($this->input->post('password1'))
											);
									else
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'status'	=> strtolower($this->input->post('status'))
											);
							}else{
									if(($this->input->post('password1') != '') && ($this->input->post('password1') == $this->input->post('password2')))
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'status'	=> strtolower($this->input->post('status')),
													'admin_password'	=> md5($this->input->post('password1'))
											);
									else
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'department'		=> $this->input->post('department'),
										            'address'		=> $this->input->post('address'),
													'status'	=> strtolower($this->input->post('status'))
											);
							}

							/*
									'password'	=> $this->encrypt->encode($this->input->post('password1')),
							*/

							//$this->Admin_model->commit($post_arr);

							/*echo "file_name=".$this->upload->file_name;
							echo "<pre>";
							print_r($this->upload);
							echo "</pre>";*/

							if($post_arr)
								$data = array(
										"admin_update" => $this->adminfactory->updateAdmin($post_arr)
								);
							$action = 2;
							/*echo "<pre>";
							print_r($post_arr);
							echo "</pre>";*/
							//die();
				}else{
				//Insert New Member

							if($this->upload->client_name){

									if(($this->input->post('password1') == $this->input->post('password2'))){
											$post_arr = array(
													'admin_username' => $this->input->post('admin_username'),
													'admin_password'	=> md5($this->input->post('password1')),
													'admin_email' => $this->input->post('admin_email'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'department'		=> $this->input->post('department'),
												    'address'		=> $this->input->post('address'),
													'create_date'		=> $now_date,
													'status'	=> strtolower($this->input->post('status'))
											);
									}

							}else{
									if(($this->input->post('password1') == $this->input->post('password2'))){
											$post_arr = array(
													'admin_username'		=> $this->input->post('admin_username'),
													'admin_password'	=> md5($this->input->post('password1')),
													'admin_email'		=> $this->input->post('admin_email'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'department'		=> $this->input->post('department'),
												    'address'		=> $this->input->post('address'),
													'create_date'		=> $now_date,
													'status'	=> strtolower($this->input->post('status'))
											);
									}							
							}
						
						if($post_arr)
							$data = array(
									"admin_update" => $this->adminfactory->addAdmin($post_arr)
							);
						$action = 1;
				}

				if(!$post_arr) $error = "Data Not Complete.";

				/*echo "<pre>";
				print_r($data);
				echo "</pre>";

				echo "<pre>";
				print_r($post_arr);
				echo "</pre>";
				die();*/


				//'note'	=> strtolower($this->input->post('note')),

				/*echo "<pre>";
				print_r($arr);
				echo "</pre>";*/
				//$this->db->set('regis_date','now()',false);
				//$this->db->insert('_admin',$arr);

				/*$data['header'] = '<title>ผลการ Add Member </title>';
				$data['content_text'] = '<header>
				<h1>ผลการทำงาน</h1><hr><p>คุณได้ทำการ Add Member เรียบร้อยแล้ว</p>
				</header>
				<META HTTP-EQUIV="Refresh" CONTENT="5;URL='.site_url('admin/memberedit/2').'">';*/

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
               $ref_title=$edit." Admin ID : ".$admin_id;
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
                                   "status" => $status,
                         		"lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity

				$data['error'] = ($error) ? $error : '';						
				//$data['error_update'] = ($error_update != '') ? $error_update : '';						

				if($admin_id == 0){
						$data['content_view'] = 'admin/memberlist';
				}else{
						$data['content_view'] = 'admin/memberedit/'.$admin_id;
				}

			//$data['content_view'] = 'admin/memberedit';
			//$this->load->view('template/template',$data);
			redirect($data['content_view']);

		}
	}


    public function delete(){

				$this->load->library("AdminFactory");
				$now_date = date('Y-m-d h:i:s',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));

				/*arr_log = array(
						'domain'		=>  $this->input->post('domain'),
						'from_ip'		=> $this->input->ip_address,
						'send_date'		=> $now_date,
						'status'	=> 'Add'
				);
				$this->db->insert('_log',$arr_log);*/

				$id = $this->uri->segment(3);
				//$ip_address = $this->input->ip_address;
				//$user_agent = $this->input->user_agent;
				$del_arr = array(
							'admin_id'	=> $id,
							'status'	=> 2,
				);

				$data = array(
						"admin_delete" => $this->adminfactory->deleteAdmin($del_arr),
						"success" => 'success'
				);



          //**************Log activity
          	$language = $this->lang->language;
			$del = $language['delete'];
			$member = $this->adminfactory->getAdmin($id);
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
               $ref_title=$del." Username : ".$member->_admin_username." [".$member->_admin_email."]";
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status=1;
          	$log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress, //$_SERVER['REMOTE_ADDR']
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
                                   "create_date" => $create_date,
                                   "status" => $status,
                         		"lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
			
				//$this->adminfactory->delete_product($id);
				redirect('admin/memberlist');

    }
#####
function profile_save($id = 0){

		$this->load->library('form_validation');
			
		/*echo "<pre>";
		print_r($this);
		echo "</pre>";*/
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('admin_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('admin_lastname', 'Lastname', 'trim|required');
		//$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		//$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');

		$this->form_validation->set_rules('password1', 'Password', 'trim|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|matches[password1]');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

		/*if($this->form_validation->run() == FALSE){
				echo "FALSE";
		}else
				echo "TRUE";

		echo "<pre>";
		print_r($this->form_validation);
		echo "</pre>";
		die();*/

		if($this->form_validation->run() == FALSE){

				if($id == 0) redirect('admin/profile');
				else redirect('admin/profile/'.$id);
				echo "FALSE";

		}else{

				//Exam uploads
                    $path= './uploads/admin/';
                    chmod($path, 0777);
                    $config["upload_path"] = $path;
				$config['allowed_types'] = 'gif|jpg|jpeg|png';
				$config['max_size'] = '100';
				$config['max_width'] = '1024';
				$config['max_height'] = '768';

				$this->load->library('upload', $config);

				// Alternately you can set preferences by calling the initialize function. Useful if you auto-load the class:
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('admin_avatar')){
					$error = array('error' => $this->upload->display_errors());
					$data['upload_status'] = $error;
				}else{
					$data = array(
							'admin_menu' => $this->menufactory->getMenu(),
							'upload_data' => $this->upload->data(),
							'upload_status' => $data,
							'error' => array()
					);
					//$data['upload_status'] = $data;
				}

				/*echo $this->upload->client_name;
				echo "<pre>";
				print_r($data);
				echo "</pre>";
				die();*/

				//$this->load->model("Admin_model");
				$this->load->library("AdminFactory");
				$now_date = date('Y-m-d h:i:s',  mktime(date("h"), date("i"), date("s"), date("m")  , date("d"), date("Y")));
				/*arr_log = array(
						'domain'		=>  $this->input->post('domain'),
						'from_ip'		=> $this->input->ip_address,
						'send_date'		=> $now_date,
						'status'	=> 'Add'
				);
				$this->db->insert('_log',$arr_log);*/

				$ip_address = $this->input->ip_address;
				$user_agent = $this->input->user_agent;

				/*echo "ip_address:$ip_address<br>";
				echo "user_agent:$user_agent<br>";
				echo "postdata:<br>";*/

				/*echo "post->admin_name:".$this->input->post('admin_name')."<br>";
				echo "post->admin_lastname:".$this->input->post('admin_lastname')."<br>";
				echo "post->admin_id:".$this->input->post('admin_id')."<br>";
				echo "post->admin_avatar:".$this->input->post('admin_avatar')."<br>";*/

				/*echo "<pre>";
				print_r($this->form_validation);
				echo "</pre>";*/

				//$this->load->library('encrypt');

				$admin_id = $this->input->post('admin_id');

				if($admin_id > 0){

							if($this->upload->client_name){
									if(($this->input->post('password1') != '') && ($this->input->post('password1') == $this->input->post('password2')))
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													//'admin_type_id'		=> $this->input->post('admin_type_id'),
													//'admin_team_id'		=> $this->input->post('admin_team_id'),
													'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													//'status'	=> strtolower($this->input->post('status')),
													'admin_password'	=> md5($this->input->post('password1'))
											);
									else
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													//'admin_type_id'		=> $this->input->post('admin_type_id'),
													//'admin_team_id'		=> $this->input->post('admin_team_id'),
													'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													//'status'	=> strtolower($this->input->post('status'))
											);
							}else{
									if(($this->input->post('password1') != '') && ($this->input->post('password1') == $this->input->post('password2')))
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													//'admin_type_id'		=> $this->input->post('admin_type_id'),
													//'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													//'status'	=> strtolower($this->input->post('status')),
													'admin_password'	=> md5($this->input->post('password1'))
											);
									else
											$post_arr = array(
													'admin_id'		=> $this->input->post('admin_id'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													//'admin_type_id'		=> $this->input->post('admin_type_id'),
													//'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													//'department'		=> $this->input->post('department'),
										            'address'		=> $this->input->post('address'),
													//'status'	=> strtolower($this->input->post('status'))
											);
							}

							/*
									'password'	=> $this->encrypt->encode($this->input->post('password1')),
							*/

							//$this->Admin_model->commit($post_arr);

							/*echo "file_name=".$this->upload->file_name;
							echo "<pre>";
							print_r($this->upload);
							echo "</pre>";*/

							if($post_arr)
								$data = array(
										"admin_update" => $this->adminfactory->updateAdmin($post_arr)
								);
							$action = 2;
							/*echo "<pre>";
							print_r($post_arr);
							echo "</pre>";*/
							//die();
				}else{
				//Insert New Member

							if($this->upload->client_name){

									if(($this->input->post('password1') == $this->input->post('password2'))){
											$post_arr = array(
													'admin_username' => $this->input->post('admin_username'),
													'admin_password'	=> md5($this->input->post('password1')),
													'admin_email' => $this->input->post('admin_email'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													'admin_team_id'		=> $this->input->post('admin_team_id'),
													//'admin_avatar'		=> $this->upload->client_name,
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'department'		=> $this->input->post('department'),
												    'address'		=> $this->input->post('address'),
													'create_date'		=> $now_date,
													'status'	=> strtolower($this->input->post('status'))
											);
									}

							}else{
									if(($this->input->post('password1') == $this->input->post('password2'))){
											$post_arr = array(
													'admin_username'		=> $this->input->post('admin_username'),
													'admin_password'	=> md5($this->input->post('password1')),
													'admin_email'		=> $this->input->post('admin_email'),
													'admin_lastname'		=> $this->input->post('admin_lastname'),
													'admin_name'		=> $this->input->post('admin_name'),
													'admin_type_id'		=> $this->input->post('admin_type_id'),
													//'admin_team_id'		=> $this->input->post('admin_team_id'),
													'phone'		=> $this->input->post('phone'),
													'mobile'		=> $this->input->post('mobile'),
													'department'		=> $this->input->post('department'),
												    'address'		=> $this->input->post('address'),
													'create_date'		=> $now_date,
													'status'	=> strtolower($this->input->post('status'))
											);
									}							
							}
						
						if($post_arr)
							$data = array(
									"admin_update" => $this->adminfactory->addAdmin($post_arr)
							);
						$action = 1;
				}

				if(!$post_arr) $error = "Data Not Complete.";

				/*echo "<pre>";
				print_r($data);
				echo "</pre>";

				echo "<pre>";
				print_r($post_arr);
				echo "</pre>";
				die();*/


				//'note'	=> strtolower($this->input->post('note')),

				/*echo "<pre>";
				print_r($arr);
				echo "</pre>";*/
				//$this->db->set('regis_date','now()',false);
				//$this->db->insert('_admin',$arr);

				/*$data['header'] = '<title>ผลการ Add Member </title>';
				$data['content_text'] = '<header>
				<h1>ผลการทำงาน</h1><hr><p>คุณได้ทำการ Add Member เรียบร้อยแล้ว</p>
				</header>
				<META HTTP-EQUIV="Refresh" CONTENT="5;URL='.site_url('admin/profile/2').'">';*/

			//**************Log activity
			$language = $this->lang->language;
			$edit = $language['edit'];
			 $savedata = $language['savedata'];
			$action = 3;
			$username = $this->input->post('admin_username');
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $admin_id,
								"from_ip" => $_SERVER['REMOTE_ADDR'],
								"ref_type" => 0,
								"ref_title" => $edit." Admin ID : ".$admin_id,
								"action" => $action,
	                                   "create_date" => $create_date,
	                                   "status" => $status,
	                         		"lang" => $this->lang->language['lang'],
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity


				$data['error'] = ($error) ? $error : '';						
				//$data['error_update'] = ($error_update != '') ? $error_update : '';						

				if($admin_id == 0){
						$data['content_view'] = 'admin/memberlist';
				}else{
						$data['content_view'] = 'admin/profile/'.$admin_id;
				}

			//$data['content_view'] = 'admin/profile';
			//$this->load->view('template/template',$data);
			redirect($data['content_view']);

		}
	}
#####
	public function status(){
			$this->load->library("AdminFactory");
			$id = 0;
			$id = $this->input->post("id");

			/*if($id == 0){
				$data = array(
						"error" => 'id error'
				);
				return false;
			}else{*/

			$obj_status = $this->adminfactory->get_status($id);
			$cur_status = $obj_status[0]['status'];
			//Debug($cur_status);
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$data = array(
					"cat_arr" => $this->adminfactory->status_admin($id, $cur_status),
					//"content_view" => 'basic/category_edit',
					//"ListSelect" => $ListSelect,
					//"error" => array()
			);
			echo $cur_status;

          //**************Log activity
               $language = $this->lang->language;
			$edit = $language['edit'];
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
               $ref_title=$edit." Admin Username : ".$member->_admin_username." [Status .$cur_status.] Update";
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
                                   "status" => $status,
	                         	"lang" => $this->lang->language['lang'],                                   
                                   
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity

			//return $cur_status;
		//}
		//$this->load->view('template/template',$data);
	}

	function logout(){
          //**************Log activity
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
               $ref_title="LOGOUT..  ".'[SYSTEM]'."";
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
                                   "status" => $status,
	                         	"lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
		$this->session->sess_destroy();
		redirect('admin');

	}
	function overview(){
		redirect('overview');

	}
    
    
  public function deleteadmin($id = 0){
		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{  
        //Delete Data
        if($id>6){
		$obj_delimage = $this->Admin_model->get_member_by_id($id);
		$admin_avatar = $obj_delimage[0]['admin_avatar'];
			#$admin_avatar=base_url('uploads/admin/'.$admin_avatar);
		$admin_avatar ='uploads/admin/'.$admin_avatar;
		$file =$admin_avatar;
		if (!unlink($file)){ echo ("Error deleting $file");Die(); }else{echo ("Deleted $file");}
		//echo '$admin_avatar='.$admin_avatar; Die();
		//Debug($obj_delimage);Die();
        $this->db->where('admin_id', $id);
		$this->db->delete('_admin'); 
        }else{
            /*
            $this->db->set('status', 0);
            $this->db->where('admin_id', $id);
            $this->db->update('_admin'); 
            */
		    //echo $this->db->last_query();
        }
        //Delete Data
		}
		redirect('admin/memberlist');
	}
    
 
		public function status2($id){
		//$admin_id = $this->session->userdata('admin_id');
		//$admin_type = $this->session->userdata('admin_type');
		//$ListSelect = $this->Api_model_na->user_menu($admin_type);
		//$id = 0;		
		//$id = $this->input->post("id");

			//echo $id;die();
			$obj_status = $this->Admin_team_model->get_status2($id);
			$cur_status = $obj_status[0]['status'];
			//$admin_team_name = $obj_status[0]['admin_team_title'];
			//Debug($cur_status);die();
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			$this->Admin_team_model->status_admin_team2($id, $cur_status);
               
          //**************Log activity
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
               $ref_title="Member ID : ".$id." [Status ".$cur_status."]";
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
                                   "status" => $status,
	                         	"lang" => $this->lang->language['lang'],
          			);			
          	$this->Admin_log_activity_model->store($log_activity);
          //**************Log activity
               
			echo $cur_status;	
	}

}