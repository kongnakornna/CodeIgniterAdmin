<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Gen extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){

				$this->load->model('Category_model');
				$this->load->model('Subcategory_model');
				
				//$language = $this->lang->language;
				$admin_id = $this->session->userdata('admin_id');

				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

				$access_token = $this->config->config['access_token_www'];
				$api_key = $this->config->config['api_key'];
				$home_web = $this->config->config['www'];
				//$this->config->config['www'] = 'http://www.Tmon.com';
				/********API***********/
				//http://daraapi.Tmon.com/api/web-api.php?method=MegaMenu&key=mMs3dAkM&gen_file=1
				$gen_api = $this->config->config['api'].'/api/web-api.php';
				//$megamenu = base_url('gen/gen_api');

				$method = 'MegaMenu';
				$megamenu = $gen_api.'?key='.$api_key.'&method='.$method.'&gen_file=1';

				$method = 'ChannelTV';
				$ChannelTV = $gen_api.'?key='.$api_key.'&method='.$method.'&gen_file=1';

				$method = 'ListCategories';
				$ListCategories = $gen_api.'?key='.$api_key.'&method='.$method.'&gen_file=1';

				$cattitle = $cat = $subcattitle = $subcat = array();
				$category = $this->Category_model->get_category();
				//Debug($category);
				if($category)
					for($i=0;$i<count($category);$i++){
							if($category[$i]['status'] == 1 && $category[$i]['category_id_map'] != 5 && $category[$i]['category_id_map'] != 19){
									$cat[] = $gen_api.'?key='.$api_key.'&method='.$method.'&cat='.$category[$i]['category_id_map'].'&gen_file=1';
									$cattitle[] =$category[$i]['category_name'];
							}
					}

				/*$subcategory = $this->Subcategory_model->get_subcategory();
				if($subcategory)
					for($i=0;$i<count($subcategory);$i++){
							if($subcategory[$i]['status'] == 1){
									$subcat[] = $gen_api.'?key='.$api_key.'&method='.$method.'&cat='.$subcategory[$i]['subcategory_id_map'].'&gen_file=1';
									$subcattitle[] =$subcategory[$i]['subcategory_name'];
							}
					}*/
				
				//Desktop******************************************************************************************************************
				//$device = ($this->input->get('device')) ? $this->input->get('device') : 'desktop';
				//$name = ($this->input->get('name')) ? $this->input->get('name') : 'home';
				$name = 'home';
				$device = 'desktop';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $home_web.'/?device='.$device.'&preview=1';
				$home = $home_web.'/catching/main/?access_token='.$access_token.'&name='.$name.'&device='.$device.'&url='.$url.'&time='.time();
				//$www = 'http://www.Tmon.com/catching/main/?access_token=lUW4Ju2ei6&name=home&url=http://www.Tmon.com';

				//Mobile
				$device = 'mobile';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $home_web.'/?device='.$device.'&preview=1';
				$home_mobile = $home_web.'/catching/main/?access_token='.$access_token.'&name='.$name.'&device='.$device.'&url='.$url.'&time='.time();
				//http://www.Tmon.com/catching/main/?access_token=lUW4Ju2ei6&name=home&device=mobile&url=http://www.Tmon.com/?device=mobile&preview=1

				//http://www.Tmon.com/news/1/ข่าว.html
				$name = 'news_1';
				$device = 'desktop';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $home_web.'/news/1/?device='.$device.'&preview=1';
				$cat_news1 = $home_web.'/catching/main/?access_token='.$access_token.'&name='.$name.'&device='.$device.'&url='.$url;

				//http://www.Tmon.com/news/3/ซุบซิบ.html
				$name = 'news_3';
				$device = 'desktop';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $home_web.'/news/3/?device='.$device.'&preview=1';
				$cat_news3 = $home_web.'/catching/main/?access_token='.$access_token.'&name='.$name.'&device='.$device.'&url='.$url;

				//http://www.Tmon.com/gallery/19/แกลเลอรี่.html
				$name = 'gallery';
				$device = 'desktop';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $home_web.'/gallery/19/?device='.$device.'&preview=1';
				$cat_gallery = $home_web.'/catching/main/?access_token='.$access_token.'&name='.$name.'&device='.$device.'&url='.$url;
				//www.Tmon.com/catching/main/?access_token=lUW4Ju2ei6&name=gallery&device=desktop&url=http://www.Tmon.com/gallery/19/?device=desktop&preview=1

				$data = array(					
					"ListSelect" => $ListSelect,
					"api_key" => $api_key,
					"gen_api" => $gen_api,
					"megamenu" => $megamenu,
					"ChannelTV" => $ChannelTV,
					"ListCategories" => $ListCategories,
					"cat" => $cat,
					"cattitle" => $cattitle,
					//"subcat" => $subcat,
					//"subcattitle" => $subcattitle,
					"home" => $home,
					"home_mobile" => $home_mobile,
					"cat_news1" => $cat_news1,
					"cat_news3" => $cat_news3,
					"cat_gallery" => $cat_gallery,
					"content_view" => 'generate/home'
				);
				$this->load->view('template/template',$data);
	}

	public function gen_www(){
				
				header('Content-Type: application/json');
				//header("Access-Control-Allow-Origin: *");

				$access_token = $this->config->config['access_token_www'];
				//header
				$device = ($this->input->get('device')) ? $this->input->get('device') : 'desktop';
				$name = ($this->input->get('name')) ? $this->input->get('name') : 'home';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $this->config->config['www'];

				 //&opt=del
				$opt = ($this->input->get('opt')) ? $this->input->get('opt') : '';

				$www = $this->config->config['www'].'/catching/main/?access_token='.$access_token.'&name='.$name.'&url='.$url.'&device='.$device.'&time='.time();
				$get_url = urldecode($www);
				$json_obj = file_get_contents($get_url);
				$view_content = $json_obj;
				//debug($www);
				echo $view_content;
	}

	public function gen_api($method = 'MegaMenu'){
				
				header('Content-Type: application/json');

				$gen_api = $this->config->config['api'].'/api/web-api.php';
				$api_key = $this->config->config['api_key'];

				$megamenu = $gen_api.'?key='.$api_key.'&method='.$method.'&gen_file=1';
				
				$get_url = urldecode($megamenu);
				$json_obj = file_get_contents($get_url);
				$view_content = $json_obj;
				//debug($www);
				echo $view_content;
	}

	public function json(){
				
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
				//if(!is_dir('json/www/navigation')) mkdir('json/www/navigation', 0777);

				$data = array(					
					"ListSelect" => $ListSelect,
					//"navigation_th" => $navigation_th,
					//"navigation_en" => $navigation_en,
					"news_th" => $news_th,
					//"news_en" => $news_en,
					"content_view" => 'generate/index'
				);
				$this->load->view('template/template',$data);
	}

	public function ads(){
				
				$this->load->model('Ads_model');
		        $breadcrumb = array();

				$admin_id = $this->session->userdata('admin_id');
				$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

				$ads_list = $this->Ads_model->get_content_id(1);

				//$access_token = $this->config->config['access_token_www'];
				//$api_key = $this->config->config['api_key'];

				/********API***********/
				//http://daraapi.Tmon.com/api/web-api.php?method=MegaMenu&key=mMs3dAkM&gen_file=1
				//$gen_api = $this->config->config['api'].'/api/web-api.php';
				//$megamenu = base_url('gen/gen_api');

				/*$device = ($this->input->get('device')) ? $this->input->get('device') : 'desktop';
				$name = ($this->input->get('name')) ? $this->input->get('name') : 'ads';
				$url = ($this->input->get('url')) ? $this->input->get('url') : $this->config->config['www'];*/

				$data = array(					
					"ListSelect" => $ListSelect,
					"ads_list" => $ads_list,
					"content_view" => 'generate/ads'
				);
				$this->load->view('template/template',$data);
				
	}

	public function save_ads(){
			
			$this->load->model('Ads_model');
			
			$datainput = $this->input->post();

			if($this->input->server('REQUEST_METHOD') === 'POST'){
			
					//Debug($datainput['use']);
					$data_to_store = array(
						'use18up' => intval($datainput['use']),
					);

					if($this->Ads_model->store(1, $data_to_store)){
						$data['flash_message'] = TRUE; 
					}else{
						$data['flash_message'] = FALSE; 
					}
					//Debug($this->db->last_query());

			}
			redirect('gen/ads');
	
	}


/*
	public function list_mod(){
				
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
				//if(!is_dir('json/www/navigation')) mkdir('json/www/navigation', 0777);

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
				
				//echo "Highlight = $list_order<br>";
				//Debug(json_decode($highlight_th));
				//die();

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
*/
}

