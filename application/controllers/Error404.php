<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error404 extends MY_Controller {

    public function __construct()    {
        parent::__construct();
		$this->load->library('session');
        $this->load->driver('session');
        $this->load->model('Admin_team_model');
        $admin_id=$this->session->userdata('admin_id');
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		$ListSelect = $this->Api_model_smart->user_menu($this->session->userdata('admin_type'));	    $this->load->view('tmon/error404');
			//Debug($ListSelect);
			//die();
/*
//**************Log activity
$action='1';
########IP#################		
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
elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}
else{$ipaddress='UNKNOWN';}
//"from_ip" => $ipaddress,
		$admin_id=$this->session->userdata('admin_id');
		$log_activity = array(
					"admin_id" => $admin_id,
					"ref_id" => 1,
					"ref_type" => 0,
					"from_ip" => $ipaddress,
					"ref_title" => "[SYSTEM Error 404]",
					"action" => $action
		);
		$this->Admin_log_activity_model->store($log_activity);
		//Debug($log_activity);
		// Die();
		//**************Log activity
*/	
		
	}
 
}

/*
window.setInterval(function(){
  /// call your function here
}, 5000); // for every 5 sec
*/