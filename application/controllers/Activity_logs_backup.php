<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Activity_logs extends MY_Controller {
  public function __construct()    {
        parent::__construct();
        $this->load->model('Admin_team_model');
       // $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
	function index(){	
			$team_list = $this->Admin_team_model->get_admin_team();
			//Debug($team_list);
			//die();
			$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			$logs_list = $this->Admin_log_activity_model->view_log();
			$breadcrumb[] = $language['activity_logs'];
			$data = array(
					"admin_team" => $team_list,
					"ListSelect" => $ListSelect,
					"logs_list" => $logs_list,
					"breadcrumb" => $breadcrumb,
					"content_view" => 'admin/activity_logs'
			);
			$this->load->view('template/template',$data);
	}
	
 
	
	
}