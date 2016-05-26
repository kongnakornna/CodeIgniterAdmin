<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Locationmonitor extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Admin_team_model');
       // $breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){

		$ListSelect = $this->Api_model_smart->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;
		$breadcrumb[] = $language['locationmonitor'];

			$team_list = $this->Admin_team_model->get_admin_team();
			//Debug($team_list);
			//die();

			$data = array(				
					"admin_team" => $team_list,
					"content_view" => 'tmon/locationmonitor',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
					//"success" => 'Admin Team'
			);

			$this->load->view('template/template',$data);
	}
	
}
