<?php
class Sensor extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Admin_menu_model');
		$breadcrumb = array();
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		$language = $this->lang->language;
		$admin_id = $this->session->userdata('admin_id');
		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
		$this->load->library("AdminFactory");
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		$breadcrumb[] = '<a href="'.base_url('overview').'">'.$language['overview'].'</a>';
		$breadcrumb[] = $language['sensormonitor'];
		$data = array(
						"admin_menu" => $this->menufactory->getMenu(),
						"memberlist" => $this->adminfactory->getAdmin(),
						"ListSelect" => $ListSelect,
						"headtxt" => 'Member List',
						"breadcrumb" => $breadcrumb,
						"content_view" => 'tmon/sensor',
			);
			//$data['content_view'] = 'admin/sensor';
			$this->load->view('template/template',$data);
	}
}