<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadfile extends MY_Controller {

    public function __construct()    {
        parent::__construct();

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

	public function index(){

					$admin_id = $this->session->userdata('admin_id');
					$admin_type = $this->session->userdata('admin_type');
					$ListSelect = $this->Api_model->user_menu($admin_type);

					$data = array(
							"admin_menu" => $this->menufactory->getMenu(),
							"ListSelect" => $ListSelect,
					);
					$data['content_view'] = 'admin/dashboard';
					$this->load->view('template/template',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */