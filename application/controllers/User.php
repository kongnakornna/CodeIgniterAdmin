<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
        $this->load->driver('session');
	}
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index(){
	    $language = $this->lang->language;  
		if($this->session->userdata('is_logged_in')){
			redirect('admin/dashboard');
        }else{
        	$this->load->view('admin/login');
        	//$this->load->view('admin/login-ace');	
        }
	}

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials(){	
        $this->load->library('session');
		$this->load->model('Users_model');
		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));
		$remember = $this->input->post('remember') ? TRUE : FALSE;
		//$is_valid = $this->Users_model->validate($user_name, $password);
		$admin = $this->Users_model->chkUser($user_name, $password,$remember);

/*
        echo 'admin_id='.$admin_id.'<br>';
        echo 'user_name='.$username.'<br>';
        echo 'admin_type='.$admin_type.'<br>';
        echo 'name='.$name.'<br>';
        echo 'lastname='.$lastname.'<br>';
*/      
/////////////////
		#Debug($admin);
        #die();
/////////////////
		if($admin){
			$data = array(
				'admin_id' => $admin['admin_id'],
				'admin_type' => $admin['admin_type'],
				'avatar' => $admin['avatar'],
				'user_name' => $user_name,
				//'password' => $password,
				'remember' => $remember,
				'name' => $admin['name'],
				'lastname' => $admin['lastname'],
				'email' => $admin['email'],
				'domain' => $admin['domain'],
				'department' => $admin['department'],
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
/////////////////
          $session_id = $this->session->userdata('session_id');
          $remember = $this->session->userdata('remember');
		$userinput=$this->session->userdata('user_name');
	     $user_id= $this->session->userdata('admin_id');
          $admin_id= $this->session->userdata('admin_id');
		$user_name =$userinput;
		$admin_type=$this->session->userdata('admin_type');
		$name=$this->session->userdata('name');
		$lastname=$this->session->userdata('lastname');
		$email=$this->session->userdata('email');
		$domain=$this->session->userdata('domain');
		$department=$this->session->userdata('department');	
		$admin_password=$this->session->userdata('admin_password');
/////////////////
        $admin_id=$admin['admin_id'];
        $username=$admin['username'];
        //$password=$admin['password'];
        $admin_type=$admin['admin_type'];
        $name=$admin['name'];
        $lastname=$admin['lastname'];
        $email=$admin['email'];
        $avatar=$admin['avatar'];
        $status=$admin['status'];
        $domain=$admin['domain'];
        $department=$admin['department'];
/*
        echo '$user_id='.$user_id.'<br>';
        echo '$user_name='.$user_name.'<br>';
        echo '$admin_type='.$admin_type.'<br>';
        echo '$name='.$name.'<br>';
        Die();    
*/       
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
               $ref_title="LOGIN..  ".'[SYSTEM]'."";
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
               $this->Users_model->lastlogin($admin_id);
          //**************Log activity
 
			 redirect('admin/dashboard');
			// redirect('overview');
			// redirect('sensor');
			// redirect('locationmonitor');
			// redirect('workflow');
			//redirect('floorplan');
			// redirect('control');

		}else{ // incorrect username or password
		
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}
	}	

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

	function forgot_password(){

		$this->load->model('Users_model');
		$this->load->library('email');
		$email = $this->input->post('email');
		$admin = $this->Users_model->chkEmail($email);
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'html';
		//$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from('kongnakornna@gnmail.com', 'Webmaster Tmon');
		$this->email->to($email);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		$this->email->subject('Email Tmon');
		$this->email->message('Tmon the email class.');

		$newpwd = $email.rand(100, 999);
		$expire = time()+60*30;

		echo "newpwd = $newpwd<br>";
		echo "expire = $expire<br>";


		//setcookie("ResetPWD", $value, time()+60*30);

		echo $this->email->print_debugger();
		//Debug($this->input->post());
		//Debug($admin);


		//$this->email->send();
		//$this->load->view('admin/signup_form');	

	}
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup(){
		$this->load->view('admin/signup_form');	
	}

	function profile($id = 0){

		$this->load->library("AdminFactory");
		$this->load->model('Admin_team_model');

		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;
		$breadcrumb[] = $language['profile'];
		$admin_id = $this->session->userdata('admin_id');
		$team_list = $this->Admin_team_model->get_admin_team();
		//Debug($this->session->userdata);
       
		$data = array(				
					"content_view" => 'admin/profile',
					"memberlist" => $this->adminfactory->getAdmin($admin_id),
					"team_list" => $team_list,
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb
		);
        $data['headtxt'] = $language['edit_member'];
		$this->load->view('template/template',$data);

	}

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member(){
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/signup_form');
		}else{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member()){
				$this->load->view('user/signup_successful');			
			}else{
				$this->load->view('user/signup_form');			
			}
		}
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout(){
                         //**************Log activity
                              $session_id_admin=$this->session->userdata('admin_id');
                              $ref_id=$this->session->userdata('admin_type');
                              $ipaddress=$_SERVER['REMOTE_ADDR'];
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
                                                  "status" => $status
                         			);			
                         	$this->Admin_log_activity_model->store($log_activity);
                         //**************Log activity
		$this->session->sess_destroy();
		redirect('admin');
	}

}