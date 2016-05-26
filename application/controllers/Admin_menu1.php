<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Admin_menu extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Admin_menu_model');
		$breadcrumb = array();

        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['admin_menu'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();

					if(isset($search_form['selectid'])){

							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							if(isset($search_form['parent'])) $parent = $search_form['parent']; else $parent = 0;
							$maxsel = count($selectid);
							$toup = $tmp = 0;

							/*for($i=0;$i<$maxsel;$i++){
									$this->Admin_menu_model->update_order($selectid[$i], $order[$i]);
									if($tmp > $order[$i]){
									}
									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
							}*/
							for($i=0;$i<$maxsel;$i++){

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า + 1
											$this->Admin_menu_model->update_orderid_to_down($order[$i], $tmp, $parent);
									}

									$chkadd = $tmp + 1;

									if((($chkadd) <> $order[$i]) && ($toup == 0)){
											//Update ID ด้านหลัง - 1
											$toup = $tmp + 1;
											//echo "($toup, $order[$i])";
											$this->Admin_menu_model->update_orderid_to_up($toup, $order[$i], $parent);
											$toup = 0;
									}

									//Update Current ID
									$this->Admin_menu_model->update_order($selectid[$i], $order[$i], $parent);
									if($tmp == 0 || $tmp != $order[$i]) $tmp++;
							}
					}
					//die();
			}

			$web_menu = $this->Admin_menu_model->getMenu();
			//Debug($web_menu);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"web_menu" => $web_menu,
					"content_view" => 'admin/admin_menu',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function add(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('admin_menu').'">'.$language['admin_menu'].'</a>';
			$breadcrumb[] = $language['add'];

			$parent = $this->Admin_menu_model->getMenu(0, 0);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"parent" => $parent,
					"content_view" => 'admin/admin_menu_add',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function edit($id){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('admin_menu').'">'.$language['admin_menu'].'</a>';
			$breadcrumb[] = $language['edit'];

			$web_menu = $this->Admin_menu_model->viewMenu($id);

			$parent = $this->Admin_menu_model->getMenu(0, 0);
			//Debug($web_menu);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"parent" => $parent,
					"web_menu" => $web_menu,
					"content_view" => 'admin/admin_menu_edit',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function save(){
			
			$now_date = date('Y-m-d H:i:s');

			$data_input = $this->input->post();
			$obj_th = $obj_en = array();

			//bj_th['admin_menu_id'] = $data_input['admin_menu_id_th'];
			//obj_en['admin_menu_id'] = $data_input['admin_menu_id_en'];

			$obj_en['title'] = $data_input['title_en'];
			$obj_th['title'] = $data_input['title_th'];
			$obj_en['url'] = $data_input['url'];
			$obj_th['url'] = $data_input['url'];
			$obj_en['status'] = $data_input['status'];
			$obj_th['status'] = $data_input['status'];
			$obj_en['parent'] = $data_input['parentid'];
			$obj_th['parent'] = $data_input['parentid'];
	
			$obj_en['create_date'] = $now_date;
			$obj_th['create_date'] = $now_date;
			$obj_en['create_by'] = $this->session->userdata('admin_id');
			$obj_th['create_by'] = $this->session->userdata('admin_id');

			$maxid = $this->Admin_menu_model->get_max_id();
			$max_id = $maxid[0]['max_id'] + 1;

			//$maxorder = $this->Admin_menu_model->get_max_order($data_input['parentid']);

			$parent = $data_input['parentid'];
			$maxorder = $this->Admin_menu_model->get_max_order($parent);
			$max_order_by = $maxorder[0]['max_order_by'] + 1;

			$obj_en['admin_menu_id2'] = $max_id;
			$obj_th['admin_menu_id2'] = $max_id;
			$obj_en['order_by'] = $max_order_by;
			$obj_th['order_by'] = $max_order_by;
			$obj_en['lang'] = 'en';
			$obj_th['lang'] = 'th';

			//Debug($data_input);
			//Debug($obj_th);
			//Debug($obj_en);
			//die();

			//$insertid = $this->Admin_menu_model->store(0, $obj_th);
			//$obj_en['admin_menu_id2'] = $insertid;
			//$this->Admin_menu_model->store($data_input['admin_menu_id_en'], $obj_en);

			$this->Admin_menu_model->store(0, $obj_en);
			$this->Admin_menu_model->store(0, $obj_th);

			redirect('admin_menu');

	}

	public function update(){
			
			$now_date = date('Y-m-d H:i:s');
			$data_input = $this->input->post();
			$obj_th = $obj_en = array();

			//Debug($data_input);

			$obj_en['admin_menu_id'] = $data_input['admin_menu_id_en'];
			$obj_th['admin_menu_id'] = $data_input['admin_menu_id_th'];

			$obj_en['title'] = $data_input['title_en'];
			$obj_th['title'] = $data_input['title_th'];
			$obj_en['url'] = $data_input['url'];
			$obj_th['url'] = $data_input['url'];
			$obj_en['status'] = $data_input['status'];
			$obj_th['status'] = $data_input['status'];
			$obj_en['parent'] = $data_input['parentid'];
			$obj_th['parent'] = $data_input['parentid'];

			$obj_en['lastupdate_date'] = $now_date;
			$obj_th['lastupdate_date'] = $now_date;

			$obj_en['lastupdate_by'] = $this->session->userdata('admin_id');
			$obj_th['lastupdate_by'] = $this->session->userdata('admin_id');

			//Debug($obj_th);
			//Debug($obj_en);

			//die();

			$this->Admin_menu_model->store($data_input['admin_menu_id_en'], $obj_en);
			$this->Admin_menu_model->store($data_input['admin_menu_id_th'], $obj_th);
//Start**************Log activity
$action = 1;
$status_type_id_map='0';
 $language = $this->lang->language;
 $amin_menu = $language['admin_menu'];
 $add_typett = $language['add'];
 $edie_typett = $language['edit'];
 $savedata = $language['savedata'];
 //**************Log activity  	
		$log_activity = array(
						"admin_id" => $this->session->userdata('admin_id'),
						"ref_id" => $status_type_id_map,
						"ref_type" => 0,
						"ref_title" => $edie_typett." : ".$obj_en['title'].':'.$obj_th['title'],
						"action" => $action
		);			
		$this->Admin_log_activity_model->store($log_activity);
		//**************Log activity
		if($this->Admin_log_activity_model->store($log_activity)){
			 echo "<script language=\"JavaScript\" type=\"text/JavaScript\">";
			    echo "alert('$savedata');
				window.location='" . base_url() . "admin_menu'";
				echo "</script>";
				exit();
			#redirect('admin_menu');
			}
//End**************Log activity
		 
}
	

	public function status($id = 0){
			
		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{
			
			$obj_status = $this->Admin_menu_model->get_status($id);
			$cur_status = $obj_status[0]['status'];
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$this->Admin_menu_model->status_new($id, $cur_status);
			echo $cur_status;
			return $cur_status;
		}
	}

	public function view($id){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('admin_menu').'">'.$language['admin_menu'].'</a>';
			$breadcrumb[] = $language['view'];
			
			$web_menu = $this->Admin_menu_model->getMenu(0, $id, null, $language['lang']);
			//Debug($web_menu);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"main_menu" => $this->Admin_menu_model->viewMenu( $id),
					"web_menu" => $web_menu,
					"content_view" => 'admin/admin_menu_view',
					"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function list_menu(){	

	}

}