<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Json extends MY_Controller {

    public function __construct()    {
        parent::__construct();

        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
				
				 $this->load->model('News_model');

				//$language = $this->lang->language;
				//$admin_id = $this->session->userdata('admin_id');
				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

				$navigation_th = $this->Api_model->navigation('th');
				$navigation_en = $this->Api_model->navigation('en');

				$news_th = $this->Api_model->news('th');
				$news_en = $this->Api_model->news('en');

				//$news_list =  $this->News_model->get_news();
				//debug(json_decode($news_th));
				//die();

				if(!is_dir('json/www')) mkdir('json/www', 0777);
				if(!is_dir('json/www/navigation')) mkdir('json/www/navigation', 0777);

				$data = array(					
					"ListSelect" => $ListSelect,
					"navigation_th" => $navigation_th,
					"navigation_en" => $navigation_en,
					"news_th" => $news_th,
					"news_en" => $news_en,
					"content_view" => 'json/index'
				);
				$this->load->view('template/template',$data);
	}

	public function view(){

				//http://localhost/Tmon_admin/json/view?url=http://localhost/Tmon_admin/json/www/news/news_th.json

				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

				$get_url = urldecode($this->input->get('url'));
				$json_obj = file_get_contents($get_url);

				//$view_content = json_decode($json_obj);
				$view_content = $json_obj;
				//$view_content = $this->Api_model->news('en');

				$data = array(					
					"ListSelect" => $ListSelect,
					"view_content" => $view_content,
					"content_view" => 'json/view'
				);
				$this->load->view('template/template',$data);

	}

	public function GetURL(){

				//http://localhost/Tmon_admin/json/view?url=http://localhost/Tmon_admin/json/www/news/news_th.json

				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));


				//$get_url = "superadmin.json";

				if($this->input->post()){

						$get_url = urldecode($this->input->post('url'));
						$json_obj = file_get_contents($get_url);
						$view_content = $json_obj;

						$data = array(					
							"ListSelect" => $ListSelect,
							"view_content" => $view_content,
							"content_view" => 'json/geturl'
						);
				}else{
						$data = array(					
							"ListSelect" => $ListSelect,
							"view_content" => null,
							"content_view" => 'json/geturl'
						);
				
				}

				$this->load->view('template/template',$data);

	}

	public function nav(){

				 $this->load->model('Homepage_Menu_model');

				//$admin_id = $this->session->userdata('admin_id');
				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
				$language = $this->lang->language;
				//$web_menu = $this->Homepage_Menu_model->viewMenu();

				$navigation_th = $this->Api_model->navigation('th');
				$navigation_en = $this->Api_model->navigation('en');

				if(!is_dir('json/www')) mkdir('json/www', 0777);
				if(!is_dir('json/www/navigation')) mkdir('json/www/navigation', 0777);

				$data = array(					
					"ListSelect" => $ListSelect,
					"navigation_th" => $navigation_th,
					"navigation_en" => $navigation_en,
					"content_view" => 'json/nav'
				);
				$this->load->view('template/template',$data);
	}

	public function gen_highlight(){

				$list_order = $this->input->get('number');
				if($list_order == 0) $list_order = 5;

				$highlight_th = $this->Api_model->Highlight('th', $list_order);
				$highlight_en = $this->Api_model->Highlight('en', $list_order);

				if(!is_dir('json/www')) mkdir('json/www', 0777);
				if(!is_dir('json/www/highlight')) mkdir('json/www/highlight', 0777);
				
				/*echo "Highlight = $list_order<br>";
				Debug(json_decode($highlight_th));
				die();*/

				SaveJSON($highlight_th, 'highlight_th', 0, 'www/highlight/');
				SaveJSON($highlight_en, 'highlight_en', 0, 'www/highlight/');

				//redirect('order/highlight');
				redirect('order/highlight?auto=1');
	}	

	public function gen_nav(){

				$navigation_th = $this->Api_model->navigation('th');
				$navigation_en = $this->Api_model->navigation('en');

				if(!is_dir('json/www')) mkdir('json/www', 0777);
				if(!is_dir('json/www/navigation')) mkdir('json/www/navigation', 0777);

				//Debug($navigation_th);
				//Debug($navigation_en);

				SaveJSON($navigation_th, 'navigation_th', 0, 'www/navigation/');
				SaveJSON($navigation_en, 'navigation_en', 0, 'www/navigation/');

				redirect('json/index');
	}	

	public function gen_dara(){

				$dara_th = $this->Api_model->dara('th');
				//$dara_en = $this->Api_model->dara('en');

				if(!is_dir('json/www/dara')) mkdir('json/www/dara', 0777);

				SaveJSON($dara_th, 'dara', 0, 'www/dara/');
				//SaveJSON($dara_en, 'dara_en', 0, 'www/dara/');

				redirect('json/index');
	}	

	public function gen_category(){

				$category_th = $this->Api_model->category('th');
				$category_en = $this->Api_model->category('en');

				if(!is_dir('json/www/category')) mkdir('json/www/category', 0777);

				SaveJSON($category_th, 'category_th', 0, 'www/category/');
				SaveJSON($category_en, 'category_en', 0, 'www/category/');

				redirect('json/index');
	}	

	public function gen_subcategory(){

				$subcategory_th = $this->Api_model->subcategory('th');
				$subcategory_en = $this->Api_model->subcategory('en');

				if(!is_dir('json/www/category')) mkdir('json/www/category', 0777);

				SaveJSON($subcategory_th, 'subcategory_th', 0, 'www/category/');
				SaveJSON($subcategory_en, 'subcategory_en', 0, 'www/category/');

				redirect('json/index');
	}

	public function gen_news(){

				$news_th = $this->Api_model->news('th');
				$news_en = $this->Api_model->news('en');

				if(!is_dir('json/www/news')) mkdir('json/www/news', 0777);

				SaveJSON($news_th, 'news_th', 0, 'www/news/');
				SaveJSON($news_en, 'news_en', 0, 'www/news/');

				redirect('json/index');
	}	

	public function gen_column(){

				$column_th = $this->Api_model->column('th');
				$column_en = $this->Api_model->column('en');

				if(!is_dir('json/www/column')) mkdir('json/www/column', 0777);

				SaveJSON($column_th, 'column_th', 0, 'www/column/');
				SaveJSON($column_en, 'column_en', 0, 'www/column/');

				redirect('json/index');
	}


	public function gen_gallery(){

				$gallery_th = $this->Api_model->gallery('th');
				$gallery_en = $this->Api_model->gallery('en');

				if(!is_dir('json/www/gallery')) mkdir('json/www/gallery', 0777);

				SaveJSON($gallery_th, 'gallery_th', 0, 'www/gallery/');
				SaveJSON($gallery_en, 'gallery_en', 0, 'www/gallery/');

				redirect('json/index');
	}

}

