<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Homepage_menu extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Homepage_Menu_model');
		$breadcrumb = array();

        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = $language['homepage_menu'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();

					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									$this->Homepage_Menu_model->update_order($selectid[$i], $order[$i]);
									if($tmp > $order[$i]){
											//Update ID ด้านหน้า
											//$this->Homepage_Menu_model->update_orderid_to_down($order[$i], $tmp);
									}
									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
							}
					}

			}
			
			$web_menu = $this->Homepage_Menu_model->getMenu();

			//Debug($web_menu);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,

					"web_menu" => $web_menu,
					"content_view" => 'basic/homepage_menu',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function add(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('homepage_menu').'">'.$language['homepage_menu'].'</a>';
			$breadcrumb[] = $language['add'];

			$parent = $this->Homepage_Menu_model->getMenu(0, 0);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"parent" => $parent,
					"content_view" => 'basic/homepage_menu_add',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function edit($id){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('homepage_menu').'">'.$language['homepage_menu'].'</a>';
			$breadcrumb[] = $language['edit'];

			$web_menu = $this->Homepage_Menu_model->viewMenu($id);

			$parent = $this->Homepage_Menu_model->getMenu(0, 0);
			//Debug($web_menu);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"parent" => $parent,
					"web_menu" => $web_menu,
					"content_view" => 'basic/homepage_menu_edit',
					"breadcrumb" => $breadcrumb,
			);

			//$data['content_view'] = 'admin/web_menu';
			$this->load->view('template/template',$data);

	}

	public function save(){
			
			$now_date = date('Y-m-d H:i:s');

			$data_input = $this->input->post();

			//Debug($data_input);
			//die();

			$obj_th = $obj_en = array();

			//bj_th['web_menu_id'] = $data_input['web_menu_id_th'];
			//obj_en['web_menu_id'] = $data_input['web_menu_id_en'];

			$obj_th['title'] = $data_input['title_th'];
			$obj_en['title'] = $data_input['title_en'];
			$obj_th['url'] = $data_input['url'];
			$obj_en['url'] = $data_input['url'];
			$obj_th['status'] = $data_input['status'];
			$obj_en['status'] = $data_input['status'];

			$obj_th['parent'] = $data_input['parentid'];
			$obj_en['parent'] = $data_input['parentid'];

			if(isset($data_input['map_catid'])){
				$obj_th['map_catid'] = $data_input['map_catid'];
				$obj_en['map_catid'] = $data_input['map_catid'];
			}
	
			$obj_th['create_date'] = $now_date;
			$obj_en['create_date'] = $now_date;
			$obj_th['create_by'] = $this->session->userdata('admin_id');
			$obj_en['create_by'] = $this->session->userdata('admin_id');

			$maxid = $this->Homepage_Menu_model->get_max_id();
			$max_id = $maxid[0]['max_id'] + 1;

			$parent = 0;
			$maxorder = $this->Homepage_Menu_model->get_max_order($parent);
			$max_order_by = $maxid[0]['max_order_by'] + 1;

			$obj_th['web_menu_id2'] = $max_id;
			$obj_en['web_menu_id2'] = $max_id;
			$obj_th['order_by'] = $max_order_by;
			$obj_en['order_by'] = $max_order_by;

			$obj_th['lang'] = 'th';
			$obj_en['lang'] = 'en';

			//Debug($data_input);
			//Debug($obj_th);
			//Debug($obj_en);
			//die();

			$insertid = $this->Homepage_Menu_model->store(0, $obj_th);
			//$obj_en['web_menu_id2'] = $insertid;
			$this->Homepage_Menu_model->store($data_input['web_menu_id_en'], $obj_en);
			//Debug($this->db->last_query());

			redirect('homepage_menu');

	}

	public function update(){
			
			$now_date = date('Y-m-d H:i:s');
			$data_input = $this->input->post();
			$obj_th = $obj_en = array();

			//Debug($data_input);

			$obj_th['web_menu_id'] = $data_input['web_menu_id_th'];
			$obj_en['web_menu_id'] = $data_input['web_menu_id_en'];

			$obj_th['title'] = $data_input['title_th'];
			$obj_en['title'] = $data_input['title_en'];
			$obj_th['url'] = $data_input['url'];
			$obj_en['url'] = $data_input['url'];
			$obj_th['status'] = $data_input['status'];
			$obj_en['status'] = $data_input['status'];
			$obj_th['parent'] = $data_input['parentid'];
			$obj_en['parent'] = $data_input['parentid'];

			if(isset($data_input['map_catid'])){
				$obj_th['map_catid'] = $data_input['map_catid'];
				$obj_en['map_catid'] = $data_input['map_catid'];
			}

			$obj_th['lastupdate_date'] = $now_date;
			$obj_en['lastupdate_date'] = $now_date;

			$obj_th['lastupdate_by'] = $this->session->userdata('admin_id');
			$obj_en['lastupdate_by'] = $this->session->userdata('admin_id');

			//Debug($obj_th);
			//Debug($obj_en);

			$this->Homepage_Menu_model->store($data_input['web_menu_id_th'], $obj_th);
			$this->Homepage_Menu_model->store($data_input['web_menu_id_en'], $obj_en);
			//Debug($this->db->last_query());

			redirect('homepage_menu');

	}

	public function status($id = 0){
			
		if($id == 0){
			$data = array(
					"error" => 'id error'
			);
			return false;
		}else{
			
			$obj_status = $this->Homepage_Menu_model->get_status($id);
			$cur_status = $obj_status[0]['status'];
			
			if($cur_status == 0) $cur_status = 1;
			else $cur_status = 0;
			
			$this->Homepage_Menu_model->status_new($id, $cur_status);
			echo $cur_status;
			return $cur_status;
		}
	}

	public function view($id){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('homepage_menu').'">'.$language['homepage_menu'].'</a>';
			$breadcrumb[] = $language['view'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();
					if(isset($search_form['selectid'])){
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$maxsel = count($selectid);
							$toup = $tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า + 1
											$this->Homepage_Menu_model->update_orderid_to_down($order[$i], $tmp);
									}

									if((($tmp + 1) <> $order[$i]) && ($toup == 0)){
											//Update ID ด้านหลัง - 1
											$toup = $tmp + 1;
											$this->Homepage_Menu_model->update_orderid_to_up($order[$i], $toup);
									}

									//Update Cur ID
									$this->Homepage_Menu_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>$tmp > ".$order[$i]."<hr>";
							}
					}

			}
			
			$web_menu = $this->Homepage_Menu_model->getMenu(0, $id);
			//Debug($web_menu);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"main_menu" => $this->Homepage_Menu_model->viewMenu( $id),
					"web_menu" => $web_menu,
					"content_view" => 'basic/homepage_menu_view',
					"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function list_menu(){	

	}

}