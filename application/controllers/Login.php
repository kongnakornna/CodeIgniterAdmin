<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Login extends MY_Controller {
    public function __construct()    {
        parent::__construct();

        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
	function index(){		
		$language = $this->lang->language;
		$admin_id = $this->session->userdata('admin_id');
		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
		$notification_birthday = $this->Api_model->notification_birthday();		
		if($this->session->userdata('is_logged_in')){
				$breadcrumb[] = $language['member_list'];
				$this->load->library("AdminFactory");
				$data = array(
						"error" => 0,
						"success" => null,
						"admin_menu" => $this->menufactory->getMenu(),
						"memberlist" => $this->adminfactory->getAdmin(),
						"ListSelect" => $ListSelect,
						"headtxt" => 'Member List',
						"notification_birthday" => $notification_birthday,
						"breadcrumb" => $breadcrumb,
						"content_view" => 'admin/memberlist',
				);

				$this->load->view('template/template',$data);
        }else{
        	//$this->load->view('login/login');	
			$this->load->view('login/login-ace');
        }
	}

	function login(){
			$this->load->view('admin/login-ace');
	}

	function debug(){
			$this->load->view('admin/debug');
	}

	function error404(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$data = array(
					"ListSelect" => $ListSelect,
			);

			$data['content_view'] = 'admin/error404';
			$this->load->view('template/template',$data);
	
	}

	function error500(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$data = array(
					"ListSelect" => $ListSelect,
			);

			$data['content_view'] = 'admin/error500';
			$this->load->view('template/template',$data);
	
	}

	function logout(){

		$this->session->sess_destroy();
		redirect('admin');

	}

}