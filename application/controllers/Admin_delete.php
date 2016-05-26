<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Admin_delete extends MY_Controller {

    public function __construct()    {
        parent::__construct();
		
		$this->load->model('News_model');
		$this->load->model('Column_model');
		$this->load->model('Gallery_model');
		$this->load->model('Vdo_model');
		$this->load->model('Picture_model');
		//$this->load->model('Admin_team_model');
        //$breadcrumb = array();
        
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
		
		$this->load->library("AdminFactory");

		$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
		$language = $this->lang->language;
		//$breadcrumb[] = '<a href="'.base_url('admin_team').'">'.$language['admin_team'].'</a>';
		$breadcrumb[] = $language['admin'];

		$memberlist = $this->adminfactory->getDelAdmin();
		$newslist = $this->News_model->getdelete_news();
		$columnlist = $this->Column_model->getdelete();
		$gallerylist = $this->Gallery_model->getdelete();
		$vdolist = $this->Vdo_model->getdelete();

		$data = array(
					"memberlist" => $memberlist,
					"newslist" => $newslist,
					"columnlist" => $columnlist,
					"gallerylist" => $gallerylist,
					"vdolist" => $vdolist,
					"content_view" => 'admin/delete',
					"ListSelect" => $ListSelect,
					"breadcrumb" => $breadcrumb,
					//"success" => 'Admin Team'
		);
		$this->load->view('template/template',$data);
	}

	public function delete_team($id){

			echo "Deleting... $id";

			$OBJnews = $this->Admin_team_model->get_status($id);
			$admin_team_title = $OBJnews[0]['admin_team_title'];

			//$this->Admin_team_model->delete_picture_admin($id);

			$this->Admin_team_model->delete_admin_team($id);
			//**************Order New
			//$this->Admin_team_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 0,
								"ref_title" => "Admin team : ".$admin_team_title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('admin_team');
			die();
	}

	public function restore_data($id){
	
			$title = $this->uri->segment(5);
			$type = $this->uri->segment(4);

			switch($type){
					case 1 : 
							$news_list = $this->News_model->status_news($id, 0);
					break;
					case 2 : 
							$news_list = $this->Column_model->status_column($id, 0);
					break;
					case 3 : 
							$news_list = $this->Gallery_model->status_gallery($id, 0);
					break;
					case 4 : 
							$news_list = $this->Vdo_model->status_vdo($id, 0);
					break;					
			}

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => $type,
								"ref_title" => "Restore : ".$title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('admin_delete');
			die();
	}

	public function delete_news($id){

			$pic_id = 0;
			$type = $this->uri->segment(4);
			$title = $this->uri->segment(5);
			//echo "Deleting... $id...type...$type";

			$this->Picture_model->delete_picture_admin($pic_id, $id, $type);
			//$news_list = $this->News_model->getdelete_news($id);
			switch($type){
					case 1 : 
							$this->News_model->delete_relate_news($id);
							$this->News_model->delete_news_admin($id);
					break;
					case 2 : 
							$this->Column_model->delete_relate_column($id);
							$this->Column_model->delete_column_admin($id);
					break;
					case 3 : 
							$this->Gallery_model->delete_by_admin($id);
					break;
					case 4 : 
							$this->Vdo_model->delete_by_admin($id);
					break;					
			}
			
			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => $type,
								"ref_title" => $title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
			redirect('admin_delete');
			die();
	}
}