<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zodiac extends CI_Controller {

    public function __construct()    {
        parent::__construct();
		 $this->load->model('Zodiaclist_model');
		 $this->load->model('Article_model');
		 $breadcrumb = array();

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

	public function index(){
			
			//$this->load->model('category_model');
			$this->load->model('Zodiac_model');

			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			$webtitle = $language['zodiac'];

			$datainput = $this->input->get();
			$start_page = 0;
			$p = 1;
			$list_page = 100;
			$listspage = '';

			//Debug($datainput);
			if(isset($datainput['p'])){
				$p = ($datainput['p'] > 0) ? $datainput['p'] : 1;
				if($p > 1){
						$start_page = ($p-1)*$list_page;
				}
			}else{
				$p = 1;
			}

			if($p > 1){
				$page_start = (($p - 1) * $list_page);
			}else
				$page_start = 0;

			$opt[]	= makeOption(10, 10);
			$opt[]	= makeOption(20, 20);
			$opt[]	= makeOption(50, 50);
			$opt[]	= makeOption(100, 100);

			$breadcrumb[] = $language['zodiac'];
			$category_id = 0;
			$subcategory_id = 0;
			$search_status = '';

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();
					if(isset($search_form['category_id'])){ 
						$category_id = $search_form['category_id'];
						$subcategory_id = 0;

						if(isset($search_form['subcategory_id'])){ 
							$subcategory_id = $search_form['subcategory_id']; 
						}
						//Debug($subcategory_id);

					}else{
						unset($search_form['subcategory_id']);
						$category_id = 0;
					}

					if(isset($search_form['list_page'])) $list_page = ($search_form['list_page'] > 0) ? $search_form['list_page'] : 10;

					$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);

					if(isset($search_form['selectid'])){

							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$search_form['category_id'] = $category = $search_form['category'];
							$maxsel = count($selectid);
							$toup = $tmp = 0;

							for($i=0;$i<$maxsel;$i++){

									if($tmp > $order[$i]){
											//Update ID ด้านหน้า + 1
											$this->Zodiaclist_model->update_orderid_to_down($order[$i], $tmp);
									}

									if((($tmp + 1) <> $order[$i]) && ($toup == 0)){
											//Update ID ด้านหลัง - 1
											$toup = $tmp + 1;
											$this->Zodiaclist_model->update_orderid_to_up($order[$i], $toup);
											
									}

									//Update Cur ID
									$this->Zodiaclist_model->update_order($selectid[$i], $order[$i]);
									//Debug($this->db->last_query());

									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
							}
							$category_id = $category;
							if(!isset($subcategory_id)) $subcategory_id = 0;
					}


					if(isset($search_form['keyword'])){
						$keyword = trim($search_form['keyword']);
						$search_news = explode(" " ,$search_form['keyword']);

						$zodiac_list = $this->Zodiaclist_model->get_zodiac_list(null, $search_news);
						//Debug($column_list);
						//die();
						//echo "1<br>";
					}else{

						$keyword = "";
						$search_status = '';
						$search_cat = array();
						$sp = 0;
						//Debug($search_form);

						/*if(intval($search_form['sp']) == 1){ //highlight only
								$sp = 1;
						}else if(intval($search_form['sp']) == 2){ //megamenu only
								$sp = 2;
						}*/
						
						if(intval($search_form['status']) == 3){
							$search_status = 3; 
						}else if(intval($search_form['status']) == 1){
							$search_status = 1;
						}
						//Debug($search_status);

						if(isset($search_form['category_id']))
							if($search_form['category_id'] > 0){

								$search_cat['category_id'] = $search_form['category_id'];
								if(isset($search_form['subcategory_id']) && $search_form['subcategory_id'] > 0) 
									$search_cat['subcategory_id'] = $search_form['subcategory_id'];
							}

						//Debug($search_form);
						if(isset($search_form['zodiac_date'])){
								
								if($search_form['zodiac_date'] != ''){
									//Debug($search_form['zodiac_date']);
									$date_arr = explode('/', $search_form['zodiac_date']);
									$search_cat['zodiac_date'] = $date_arr[2].'-'.$date_arr[0].'-'.$date_arr[1];
								}
						}

						//Debug($search_form);
						//Debug($search_cat);

						//Debug(date('Y-m-d', $search_cat['date']));
						
						$zodiac_list = $this->Zodiaclist_model->get_zodiac_list(null, $search_cat, $search_status);				
							
						//$zodiac_view = $this->Zodiac_model->get_content();
						//echo "2<br>";
					}
			}else{ //if($this->input->server('REQUEST_METHOD') === 'POST')
					
					$keyword = "";
					$get_data = $this->input->get();

					//category_id
					if(isset($get_data['category_id'])){

							$subcategory_id = 0;
							$category_id = $get_data['category_id'];
							$search_form['category_id'] = intval($category_id);

							if(isset($get_data['subcategory_id'])){
								$subcategory_id = $get_data['subcategory_id'];
								$search_form['subcategory_id'] = intval($subcategory_id);
							}

							//$news_list = $this->news_model->get_news(null, null,  $search_form, '_news.create_date', 'DESC', $page_start, $list_page,0 ,0);
							$zodiac_list = $this->Zodiaclist_model->get_zodiac_list(null, $search_form, 0, 0, '_zodiac_list.create_date', 'DESC', $page_start, $list_page);
							//die();
							//$category_list = $this->category_model->getSelectCat($category_id, 'category_id', 'News');
							$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);

					}else if(isset($get_data['approve'])){
							
							if($get_data['approve'] == 4){

										$search_status = array(
											"approve" => 0,
											"status" => 1,
										);
							}
							
							$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);
							$zodiac_list = $this->Zodiaclist_model->get_zodiac_list(null, $search_status, 0, 0, '_zodiac_list.create_date', 'DESC', $page_start, $list_page);
					}else{
							$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);
							$zodiac_list = $this->Zodiaclist_model->get_zodiac_list(null, null, 0, 0, '_zodiac_list.create_date', 'DESC', $page_start, $list_page);
					}
			}
			$zodiac_view = $this->Zodiac_model->get_content();
			//Debug($this->db->last_query());

			/*if($category_id > 0)
				$category_list = $this->category_model->getSelectCat($category_id , 'category_id');
			else
				$category_list = $this->category_model->getSelectCat(0, 'category_id');*/

			$totalnews = $this->Zodiaclist_model->countcolumn();

			if($subcategory_id > 0)
				$curpage = base_url('zodiac?view=list&category_id='.$category_id.'&subcategory_id='.$subcategory_id);
			else if($category_id > 0)
				$curpage = base_url('zodiac?view=list&category_id='.$category_id);
			else
				$curpage = base_url('zodiac?view=list');
			
			$notification_article_list = '';
			$count_approve = 0;
			$notification_article = $this->Api_model->notification_msg('article');
			//debug($notification_article);

			if(isset($notification_article[0]->count_approve)) $count_approve = $notification_article[0]->count_approve;
			if($notification_article[0]->count_approve == 1) $notification_article_list = $this->Api_model->notification_msg('article', 0);

			$data = array(
					"ListSelect" => $ListSelect,
					"GenPage" => GenPage($curpage, $p, $list_page, $totalnews),
					"zodiac_view" => $zodiac_view,
					"zodiac_list" => $zodiac_list,
					//"category_list" => $category_list,
					//"category_id" => $category_id,
					//"subcategory_id" => $subcategory_id,
					"breadcrumb" => $breadcrumb,

					"notification_article" => $count_approve,
					"notification_article_list" => $notification_article_list,

					"totalnews" => $totalnews,
					"listspage" => $listspage,
					"webtitle" => $webtitle,
					"content_view" => 'zodiac/list'
			);

			if(isset($zodiac_list)) $data['zodiac_list'] = $zodiac_list;

			$this->load->view('template',$data);
	}
	
	public function add(){
			
			 //$this->load->model('category_model');
			 //$this->load->model('dara_model');
			 $this->load->model('tags_model');
			 $this->load->model('credit_model');
			 $this->load->model('columnist_model');
			 $this->load->model('Zodiac_model');
			 $this->load->helper('ckeditor');
			$Path_CKfinder = base_url('plugins/ckeditor-integrated/ckfinder');
			$Path_CKeditor = base_url('plugins/ckeditor-integrated/ckeditor');

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('zodiac').'">'.$language['zodiac'].'</a>';
			$breadcrumb[] = $language['add'];

			//$category_list = $this->category_model->getSelectCat(0, 'category_id');
			//$dara_list = $this->dara_model->get_dara_profile();
			$columnist_list = $this->columnist_model->get_data();
			$zodiac_list = $this->Zodiac_model->getSelect();

			$tags_list = $this->tags_model->getSelect();
			//$credit_list = $this->credit_model->get_data();
			$credit_list = $this->credit_model->getSelect();

			/*$notification_news_list = $notification_column_list = $notification_gallery_list = $notification_vdo_list = $notification_dara_list = array();
			$notification_birthday = $this->Api_model->notification_birthday();
			$notification_news = $this->Api_model->notification_msg('news');
			if($notification_news[0]->count_approve == 1) $notification_news_list = $this->Api_model->notification_msg('news', 0);
			$notification_column = $this->Api_model->notification_msg('column');
			if($notification_column[0]->count_approve == 1) $notification_column_list = $this->Api_model->notification_msg('column', 0);
			$notification_gallery = $this->Api_model->notification_msg('gallery');
			if($notification_gallery[0]->count_approve == 1) $notification_gallery_list = $this->Api_model->notification_msg('gallery', 0);
			$notification_vdo = $this->Api_model->notification_msg('vdo');
			if($notification_vdo[0]->count_approve == 1) $notification_vdo_list = $this->Api_model->notification_msg('vdo', 0);
			$notification_dara = $this->Api_model->notification_msg('dara');
			if($notification_dara[0]->count_approve == 1) $notification_dara_list = $this->Api_model->notification_msg('dara', 0);*/

			$webtitle = $language['add'].$language['column'];

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					//"dara_list" => $dara_list,
					//"category_list" => $category_list,
					"tags_list" => $tags_list,
					"credit_list" => $credit_list,
					"columnist_list" => $columnist_list,
					"zodiac_list" => $zodiac_list,

					/*"notification_birthday" => $notification_birthday,
					"notification_news" => $notification_news[0]->count_approve,
					"notification_column" => $notification_column[0]->count_approve,
					"notification_gallery" => $notification_gallery[0]->count_approve,
					"notification_vdo" => $notification_vdo[0]->count_approve,
					"notification_dara" => $notification_dara[0]->count_approve,
					"notification_news_list" => $notification_news_list,
					"notification_column_list" => $notification_column_list,
					"notification_gallery_list" => $notification_gallery_list,
					"notification_vdo_list" => $notification_vdo_list,
					"notification_dara_list" => $notification_dara_list,*/

					"content_view" => 'zodiac/add',
					"webtitle" => $webtitle,
					"breadcrumb" => $breadcrumb,
			);

			//Ckeditor's configuration
			$data['description_en'] = array(
				'id'     =>     'description_en',
				'path'    =>    $Path_CKeditor,
				'config' => array(
					'customConfig'     =>     'config.js',
					'toolbar'     =>     'Basic',
					'removeButtons'     =>     'Save,Flash,Font,Smiley',
					//'width'     =>     "800px",
					//'height'     =>     '200px',
					'filebrowserBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html',
					'filebrowserImageBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Images',
					'filebrowserFlashBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Flash',
					'filebrowserUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Files',
					'filebrowserImageUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Images',
					'filebrowserFlashUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				),
			);

			$data['detail_th'] = $data['detail_en'] = $data['description_th'] = $data['description_en'];

			$data['description_th']['id'] = 'description_th';
			$data['detail_en']['id'] = 'detail_en';
			$data['detail_th']['id'] = 'detail_th';

			$this->load->view('template',$data);
	}

	public function edit($id = 0){

			if($id == 0){
					redirect('zodiac');
					die();
			}
			
			//$this->load->model('category_model');			 
			//$this->load->model('subcategory_model');
			//$this->load->model('dara_model');
			$this->load->model('tags_model');
			//$this->load->model('picture_model');
			$this->load->model('credit_model');
			$this->load->model('columnist_model');
			$this->load->model('Zodiac_model');
			$this->load->model('box_model');
			//$this->load->model('up18_model');
			$this->load->helper('ckeditor');
			$Path_CKfinder = base_url('plugins/ckeditor-integrated/ckfinder');
			$Path_CKeditor = base_url('plugins/ckeditor-integrated/ckeditor');

			$tag_id = $credit_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('zodiac').'">'.$language['zodiac'].'</a>';
			$breadcrumb[] = $language['edit'];

			//$get_up18 = $this->up18_model->get_up18($id, 2);		
			$zodiac_list =  $this->Zodiaclist_model->get_zodiac_list($id);

			if(!$zodiac_list){
					redirect(base_url('zodiac'));
					die();
			}	
			//$category_list = $this->category_model->getSelectCat($column_list[0]['category_id'], 'category_id');
			
			/*if($column_list[0]['subcategory_id'] > 0){
				$subcategory_list = $this->subcategory_model->getSelectSubcat($column_list[0]['category_id'], $column_list[0]['subcategory_id']);
			}else
				$subcategory_list = $this->subcategory_model->getSelectSubcat($column_list[0]['category_id'], 0);*/

			$sel_tags = $this->tags_model->get_tag_pair($id, 2);
			//Debug($sel_tags);
			if($sel_tags)
				for($i=0;$i<count($sel_tags);$i++){
					@$tag_id[$i]->value = $sel_tags[$i]->tag_id;
				}

			$credit_id = json_decode($zodiac_list[0]['credit_id'], true);
			if($credit_id)
				for($i=0;$i<count($credit_id);$i++){
					@$credit_id[$i]->value = $credit_id[$i];
				}

			//$dara_list = $this->dara_model->get_dara_profile();
			//$picture_list = $this->picture_model->get_picture_by_ref_id($id, 2);
			$columnist_list = $this->columnist_model->get_data();

			$tags_list = $this->tags_model->getSelect($tag_id);
			//$credit_list = $this->credit_model->get_data();
			$credit_list = $this->credit_model->getSelect($credit_id);

			//Debug($column_list);
			$zodiac_view = $this->Zodiac_model->getSelect($zodiac_list[0]['zodiac_id']);

			//Debug($column_list);
			/*Debug($relate_list);
			Debug($relate_columnist_list);
			die();*/

			$datalog = array(
					"ref_type" => 2,
					"ref_id" => $id
			);
			$view_log = $this->admin_log_activity_model->view_log(0, $datalog);

			/*$notification_news_list = $notification_column_list = $notification_gallery_list = $notification_vdo_list = $notification_dara_list = array();
			$notification_birthday = $this->Api_model->notification_birthday();
			$notification_news = $this->Api_model->notification_msg('news');
			if($notification_news[0]->count_approve == 1) $notification_news_list = $this->Api_model->notification_msg('news', 0);
			$notification_column = $this->Api_model->notification_msg('column');
			if($notification_column[0]->count_approve == 1) $notification_column_list = $this->Api_model->notification_msg('column', 0);
			$notification_gallery = $this->Api_model->notification_msg('gallery');
			if($notification_gallery[0]->count_approve == 1) $notification_gallery_list = $this->Api_model->notification_msg('gallery', 0);
			$notification_vdo = $this->Api_model->notification_msg('vdo');
			if($notification_vdo[0]->count_approve == 1) $notification_vdo_list = $this->Api_model->notification_msg('vdo', 0);
			$notification_dara = $this->Api_model->notification_msg('dara');
			if($notification_dara[0]->count_approve == 1) $notification_dara_list = $this->Api_model->notification_msg('dara', 0);*/

			if(isset($column_list[1]['title'])) $title = $zodiac_list[1]['title'];
			else $title = $zodiac_list[0]['title'];

			$webtitle = $language['edit'].$language['column'].' '.$title;

			//Debug($column_list);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"zodiac_view" => $zodiac_view,
					"tags_list" => $tags_list,
					"credit_list" => $credit_list,
					"columnist_list" => $columnist_list,
					"zodiac_list" => $zodiac_list,
					"view_log" => $view_log,

					/*"notification_birthday" => $notification_birthday,
					"notification_news" => $notification_news[0]->count_approve,
					"notification_column" => $notification_column[0]->count_approve,
					"notification_gallery" => $notification_gallery[0]->count_approve,
					"notification_vdo" => $notification_vdo[0]->count_approve,
					"notification_dara" => $notification_dara[0]->count_approve,
					"notification_news_list" => $notification_news_list,
					"notification_column_list" => $notification_column_list,
					"notification_gallery_list" => $notification_gallery_list,
					"notification_vdo_list" => $notification_vdo_list,
					"notification_dara_list" => $notification_dara_list,*/
					"content_view" => 'zodiac/edit',
					"webtitle" => $webtitle,
					"breadcrumb" => $breadcrumb,
			);

			//Ckeditor's configuration
			$data['description_en'] = array(
				'id'     =>     'description_en',
				'path'    =>    $Path_CKeditor,
				'config' => array(
					'customConfig'     =>     'config.js',
					'toolbar'     =>     'Basic',
					'removeButtons'     =>     'Save,Flash,Font,Smiley',
					//'width'     =>     "800px",
					//'height'     =>     '200px',
					'filebrowserBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html',
					'filebrowserImageBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Images',
					'filebrowserFlashBrowseUrl'     =>     $Path_CKfinder .'/ckfinder.html?type=Flash',
					'filebrowserUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Files',
					'filebrowserImageUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Images',
					'filebrowserFlashUploadUrl'     =>     $Path_CKfinder .'/core/connector/php/connector.php?command=QuickUpload&type=Flash',
				),
			);

			$data['detail_th'] = $data['detail_en'] = $data['description_th'] = $data['description_en'];
			$data['description_th']['id'] = 'description_th';
			$data['detail_en']['id'] = 'detail_en';
			$data['detail_th']['id'] = 'detail_th';
			$this->load->view('template',$data);
	}

	public function picture($id = 0){
			
			if($id == 0){
				redirect('column');
				die();
			}

			 $this->load->model('Api_model');
			 $this->load->model('picture_model');
			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('column').'">'.$language['column'].'</a>';
			$breadcrumb[] = $language['picture'];

			//$news_list =  $this->Zodiaclist_model->get_news($id);
			$column_list =  $this->Zodiaclist_model->get_zodiac_list($id);
			$picture_list = $this->Api_model->get_picture($id, 0, 2);

			//Debug($column_list );

			if(isset($column_list[1]['title'])) $title = $column_list[1]['title'];
			else $title = $column_list[0]['title'];

			$webtitle = $language['picture'].$language['column'].' '.$title;
			
			//$picture_list = json_decode("http://elvis.siamsport.co.th/services/search?q=autosalon%20AND%20extension:jpg&start=0&num=10&sort=name&metadataToReturn=all&format=json&facet.assetDomain.selection=image");

			//$picture_list = LoadJSON("search?q=autosalon%20AND%20extension:jpg&start=0&num=10&sort=name&metadataToReturn=all&format=json&facet.assetDomain.selection=image", "http://elvis.siamsport.co.th/services");

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"column_list" => $column_list,
					"picture_list" => $picture_list,
					"content_view" => 'column/picture',
					"webtitle" => $webtitle,
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template',$data);
	}

	public function picture_order($id = 0){
			
			$this->load->library('user_agent');

			$this->load->model('Api_model');
			$this->load->model('picture_model');			

			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('column').'">'.$language['column'].'</a>';
			$breadcrumb[] ='<a href="'.base_url('column/picture/'.$this->uri->segment(3)).'">'.$language['picture'].'</a>';
			$breadcrumb[] = $language['order'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					$this->set_order_picture2($this->uri->segment(3), $search_form);

			}

			$picture_list = $this->Api_model->get_picture($id, 0, 2);
			$column_list = $this->Zodiaclist_model->get_zodiac_list_by_id($id);

			$webtitle = $language['order'].$language['picture'].$language['column'].' '.$column_list[1]['title'];

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"column_list" => $column_list,
					"picture_list" => $picture_list,
					"content_view" => 'column/picure_order',
					"webtitle" => $webtitle,
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template',$data);
	}

	function upload_pic(){

			$this->load->model('picture_model');
			$this->load->library('upload');
			$this->load->library('image_lib');

			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			$picture_obj = array();

			$files = $_FILES;
			$now_date = date('Y-m-d H:i:s');
			//$folder = date('Ymd');

			$data_input = $this->input->post();


			if($data_input['create_date'] != ""){

				$create_date = ConvertDate8toFormat($data_input['create_date'], '/');
				//Debug($create_date);
				$folder = $create_date;
				$folder_img = explode("/", ConvertDate8toFormat($folder));
				$tmp_folder = '';
				if(isset($folder_img)){
					foreach($folder_img as $val){
						$tmp_folder .= $val.'/';
						$this->picture_model->chkfolder_exists($tmp_folder, 'column');
					}
				}
				/*$this->picture_model->chkfolder_exists($folder, 'column');
			}else{
				$create_date = ConvertDate8toFormat($now_date, '/');
				$folder = $create_date;
				$this->picture_model->chkfolder_exists($folder, 'gallery');*/
			}else{
				$folder = date('Y/m/d');
			}

			/*$folder_img = explode("/", ConvertDate8toFormat($folder));
			$tmp_folder = '';
			if(isset($folder_img)){
				foreach($folder_img as $val){
					$tmp_folder .= $val.'/';
					$this->picture_model->chkfolder_exists($tmp_folder, 'column');
				}
			}*/

			/*Debug($data_input);
			Debug($create_date);
			echo $folder ;
			die();*/

			$picture_list = $this->Api_model->get_picture($data_input['column_id']);
			//Debug($picture_list);

			$cpt = count($_FILES['picture_column']['name']);
			for($i=0; $i<$cpt; $i++){

				$_FILES['userfile']['name']= $files['picture_column']['name'][$i];
				$_FILES['userfile']['type']= $files['picture_column']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['picture_column']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['picture_column']['error'][$i];
				$_FILES['userfile']['size']= $files['picture_column']['size'][$i];    
				//Debug($_FILES['userfile']);

				if($_FILES['userfile']['error'] == 0){

						//Upload File
						$this->upload->initialize($this->set_upload_options($folder));
						$this->upload->do_upload();

						//Resize Image
						$this->image_lib->clear();
						$this->image_lib->initialize($this->set_resize_options($this->upload->client_name, $folder));
						$this->image_lib->resize();

						//Watermark
						//$this->image_lib->initialize($this->set_watermark_options($this->upload->client_name));
						//$this->image_lib->watermark();

						//$picture_obj['ref_id'] = $this->uri->segment(3);
						$picture_obj['ref_id'] = $data_input['column_id'];
						$picture_obj['ref_type'] = 2;
						$picture_obj['file_name'] = $this->upload->client_name;
						//$picture_obj['title'] = StripTxt($data_input['title']);						
						$picture_obj['caption'] = StripTxt($data_input['caption']);
						$picture_obj['folder'] = $folder;
						$picture_obj['create_date'] = $now_date;
						$picture_obj['create_by'] = $this->session->userdata('admin_id');
						$picture_obj['status'] = 1;

						if(isset($data_input['set_default']) && $data_input['set_default'] == 1 && $i == 0) $picture_obj['default'] = 1;

						$this->picture_model->store(0, $picture_obj);
				}
				//Debug($this->upload);
			}

			$column_list =  $this->Zodiaclist_model->get_zodiac_list_by_id($data_input['column_id']);
			//**************Log activity
			$action = 2;
			$log_activity = array(
									"admin_id" => $this->session->userdata('admin_id'),
									"ref_id" => $data_input['column_id'],
									"ref_type" => 2,
									"ref_title" => "[Upload Picturn $cpt]".$column_list[0]['title'],
									"action" => $action
			);			
			$this->admin_log_activity_model->store($log_activity);
			//**************Log activity
			redirect(base_url('column/picture/'.$data_input['column_id']));
	}

	private function set_upload_options($folder = ''){   

		$config = array();
		if($folder == '') $folder = date('Ymd');
		
		$config['upload_path'] = './uploads/column/';
		if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

		$config['upload_path'] = './uploads/column/'.$folder;
		if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

		$upload_path = './uploads/tmp/';
		if(!is_dir($upload_path)) mkdir($upload_path, 0777);

		$upload_path = './uploads/tmp/'.$folder;
		if(!is_dir($upload_path)) mkdir($upload_path, 0777);

		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}

	private function set_resize_options($client_name, $folder = '', $width = 300, $height = 169){   

		$config = array();
		if($folder == '') $folder = date('Ymd');
		$foldermain = 'column';
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/tmp/'.$folder.'/'.$client_name;
		$config['new_image'] = './uploads/'.$foldermain.'/'.$folder.'/'.$client_name;

		$config['create_thumb'] = FALSE;	//สร้าง Thumb โดย CI
		$config['maintain_ratio'] = TRUE;
		//$config['width']     = $width;
		//$config['height']   = $height;

		//****Copy Original File to TMP
		$upload_path = './uploads/tmp/'.$folder;
		$tmp = $upload_path.'/'.$client_name;

		//echo "$upload_path  ==> $tmp ";

		$src = fopen($config['new_image'], 'r');
		$dest = fopen($tmp, 'w');

		stream_copy_to_stream($src, $dest);

		return $config;
	}

	public function picture_edit($id = 0){
			$this->load->model('Api_model');
			$this->load->model('picture_model');
			$this->load->model('credit_model');

			$typeOfPic = 2 ;
			$orientation = 1;
			$getdata = $this->input->get();
			if($getdata){
				foreach($getdata as $key => $val){
						if($key == "picture_id") $picture_id = $val;
						//if($key == "Orientation") $orientation = $val;
				}
				$columnid = $id;
			}else{
				 $columnid = $this->uri->segment(3);
				 $picture_id = $this->uri->segment(4);
			}
			 //Debug($picid);
			/*if($getdata)
				foreach($getdata as $key => $val){
						//echo "<br>".$news_id." : ".$val;
						if($key == "news_id") $news_id = $val;
						if($key == "Orientation") $orientation = $val;
				}*/

			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('column').'">'.$language['column'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('column/edit/'.$columnid).'">'.$language['edit'].'</a>';
			$breadcrumb[] = $language['picture'];

			$picture_list = $this->Api_model->get_picture($columnid, $picture_id, $typeOfPic);
			$column_item = $this->Zodiaclist_model->get_zodiac_list($columnid);
			$credit_list = $this->credit_model->get_data();

			if(isset($column_item[1]['title'])){
				$title = $column_item[1]['title'];
				$column_list = $column_item[1];
			}else{
				$title = $column_item[0]['title'];
				$column_list = $column_item[0];
			}

			$webtitle = $language['edit'].$language['picture'].$language['column'].' '.$title;
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"columnid" => $columnid,
					"column_item" => $column_list,
					"orientation" => $orientation,
					"picture_list" => $picture_list,
					"credit_list" => $credit_list,
					"content_view" => 'column/picture_edit',
					"webtitle" => $webtitle,
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template',$data);
	}

	public function picture_watermark(){

			$this->load->model('Api_model');
			$this->load->model('picture_model');
			$this->load->helper('img');
			$type='column';

			$getdata = $this->input->post();
			if($getdata)
				foreach($getdata as $key => $val){
						//if($key == "id") $id = $val;
						if($key == "picture_id") $picture_id = $val;
						if($key == "columnid") $column_id = $val;
						if($key == "folder") $folder = $val;
						if($key == "file") $file = $val;
						if($key == "watermark") $watermark = $val;
						if($key == "caption") $caption = StripTxt($val);
						if($key == "credit_id") $credit_id = $val;
						//if($key == "type") $type = $val;
				}

			switch($watermark){
						case "no" : $picture_list = $this->picture_model->watermark($file, $folder, $type); break;	//ไม่มี Logo
						case "center" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 4); break;	//Logo ตรงกลาง
						case "horizontal" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 1); break;
						case "vertical" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 2); break;
						case "logo" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 3); break; //Logo ขนาดใหญ่
						case "topleft" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 5); break;
						case "buttomright" : $picture_list = $this->picture_model->watermark($file, $folder, $type, 6); break;
						default : $picture_list = $this->picture_model->watermark($file, $folder, $type); break; //ไม่มี Logo
			}
			$data = array(
				"caption" => $caption,
				"credit_id" => $credit_id
			);
			$this->picture_model->store($picture_id, $data);
			//die();

			$log_activity = array(
					"admin_id" => $this->session->userdata('admin_id'),
					"ref_id" => $column_id,
					"ref_type" => 2,
					"ref_title" => "Set picture column picture id: ".$id." ".$caption,
					"action" => 2
			);			
			$this->admin_log_activity_model->store($log_activity);

			//$url = 'column/picture_edit/'.$column_id.'/'.$picture_id;
			$url = 'column/picture_edit/'.$column_id.'?picture_id='.$picture_id;
			redirect($url);
			die();	
	}

	/*function upload_pic(){

			$this->load->model('picture_model');
			$this->load->library('upload');
			$this->load->library('image_lib');

			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			$picture_obj = array();

			$files = $_FILES;
			$now_date = date('Y-m-d H:i:s');
			$folder = date('Ymd');

			$data_input = $this->input->post();

			if($data_input['create_date'] != "") $folder = $data_input['create_date'];

			//$config['path_thumb'] = './uploads/column/thumb/';
			//if(!is_dir($config['path_thumb'])) mkdir($config['path_thumb'], 0777);

			$cpt = count($_FILES['picture_column']['name']);
			for($i=0; $i<$cpt; $i++){

				$_FILES['userfile']['name']= $files['picture_column']['name'][$i];
				$_FILES['userfile']['type']= $files['picture_column']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['picture_column']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['picture_column']['error'][$i];
				$_FILES['userfile']['size']= $files['picture_column']['size'][$i];    
				//Debug($_FILES['userfile']);

				if($_FILES['userfile']['error'] == 0){

						//Upload File
						$this->upload->initialize($this->set_upload_options());
						$this->upload->do_upload();

						//Resize Image
						//Resize Image
						$this->image_lib->clear();
						$this->image_lib->initialize($this->set_resize_options($this->upload->client_name, $folder));
						$this->image_lib->resize();

						//Watermark
						//$this->image_lib->initialize($this->set_watermark_options($this->upload->client_name));
						//$this->image_lib->watermark();

						//$picture_obj['ref_id'] = $this->uri->segment(3);
						$picture_obj['ref_id'] = $data_input['column_id'];
						$picture_obj['ref_type'] = 1;
						$picture_obj['file_name'] = $this->upload->client_name;
						//$picture_obj['title'] = StripTxt($data_input['title']);
						
						$picture_obj['caption'] = StripTxt($data_input['caption']);

						$picture_obj['folder'] = $folder;
						$picture_obj['create_date'] = $now_date;
						$picture_obj['create_by'] = $this->session->userdata('admin_id');
						$picture_obj['status'] = 1;
						$this->picture_model->store(0, $picture_obj);
				}
			}

			redirect(base_url('column/picture/'.$data_input['column_id']));

	}*/

	public function remove_pic(){
			//Debug($this->input->post());
			$src = base64_decode($this->input->post('src'));
			if(file_exists($src)){
				unlink($src);
				echo "Yes";
				//echo "Remove Picture success.";
			}else echo "No";
	}

	public function picture_del($pic_id = 0){

			$this->load->model('picture_model');
			$type = 2; //Column

			$ref_id = $this->input->get();
			if($ref_id)
				foreach($ref_id as $column_id => $val){
						//echo $column_id;
				}

			if($ref_id > 0 && $column_id > 0){
					$picture_list = $this->Api_model->get_picture($column_id, $pic_id, $type);

					//$tmp = 'uploads/tmp/'.$picture_list[0]['folder'].'/'.$picture_list[0]['file_name'];
					//if(file_exists($tmp)) unlink($tmp);

					$tmp = 'uploads/column/'.$picture_list[0]['folder'].'/'.$picture_list[0]['file_name'];
					if(file_exists($tmp)) unlink($tmp);

					$tmp = 'uploads/thumb/'.$picture_list[0]['folder'].'/'.$picture_list[0]['file_name'];
					if(file_exists($tmp)) unlink($tmp);

					$this->picture_model->delete_picture_admin($pic_id, 0, $type);
	
			}
			redirect('column/picture/'.$column_id);

	}

	public function remove_img($id = 0){
			
			//$src = $this->input->post('name');
			//echo $id .' '. $src;

			/*unlink('uploads/dara/'.$src);
			$obj_data['picture_column'] = '';
			if($this->Zodiaclist_model->store($id, $obj_data))
				echo 'Yes';
			else
				echo 'No';*/

	}
	
	public function status($id = 0){
				
			if($id == 0){
				$data = array(
						"error" => 'id error'
				);
				return false;
			}else{

					$obj_status = $this->Zodiaclist_model->get_status($id);
					$cur_status = $obj_status[0]['status'];
					$title = $obj_status[0]['title'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;

					$obj_data['status'] = $cur_status;
					$obj_data['lastupdate_date'] = date('Y-m-d H:i:s');
					$obj_data['lastupdate_by'] = $this->session->userdata('admin_id');

					if($this->Zodiaclist_model->store2($id, $obj_data)) echo $cur_status;
						//echo "update succedd.";
			}
			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => "[Status]".$title,
								"action" => 2
			);			
			$this->admin_log_activity_model->store($log_activity);
			//**************Log activity
	}

	public function approve($id = 0){
			
			$now_date = date('Y-m-d H:i:s');
				
			if($id == 0){
				$data = array(
						"error" => 'id error'
				);
				return false;
			}else{

					$obj_status = $this->Zodiaclist_model->get_status($id);
					$cur_status = $obj_status[0]['approve'];
					$title = $obj_status[0]['title'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;

					$obj_data['approve'] = $cur_status;
					$obj_data['approve_date'] = $now_date;
					$obj_data['approve_by'] = $this->session->userdata('admin_id');

					if($this->Zodiaclist_model->store2($id, $obj_data)) echo $cur_status;
						//echo "update succedd.";
			}
			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => "[Approve]".$title,
								"action" => 2
			);			
			$this->admin_log_activity_model->store($log_activity);
			//**************Log activity
	}

	public function save(){

			$this->load->library('upload');
			$this->load->library('image_lib');
			$this->load->model('picture_model');
			$this->load->model('tags_model');
			//$this->load->model('up18_model');

			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			
			//$tags_all = $this->tags_model->getall_tag_pair(5); //tags ของดารา

			//Debug($tags_all);
			//die();
			
			$column_data = $tag_id = $tag_pair = $tag_pair2 = $tag_compair = $picture_obj = array();
			$upload_status = "";
			$zid = 0;
			$now_date = date('Y-m-d H:i:s');

			$data_input = $this->input->post();

			/*$this->load->library('form_validation');
			// field name, error message, validation rules
			$this->form_validation->set_rules('title_en', $language['title'], 'trim|required');
			$this->form_validation->set_rules('title_th	', $language['title'], 'trim|required');
			$this->form_validation->set_rules('detail_en', $language['detail'], 'trim|required');
			$this->form_validation->set_rules('detail_th	', $language['detail'], 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			if($this->form_validation->run() == FALSE){
					echo "<hr>FALSE";
					Debug($this->form_validation->set_error_delimiters());
			}else{
					echo "<hr>Save";
					//Debug($this->input->post());
					//$this->Zodiaclist_model->store($dara_profile_id, $this->input->post());
			}*/

				if(isset($data_input['create_date'])){
					$folder = ($data_input['create_date'] != "") ? $data_input['create_date'] : date('Ymd');
				}else
					$folder = date('Ymd');

				/*$config_upload = $this->set_upload_options($folder);
				$this->load->library('upload', $config_upload);
				$this->upload->initialize($config_upload);
				//$this->upload->do_upload();
				if (!$this->upload->do_upload('picture')){
					$error = array('error' => $this->upload->display_errors());
					$upload_status = $error;
				}else{
					$this->image_lib->clear();
					$this->image_lib->initialize($this->set_resize_options($this->upload->client_name, $folder));
					$this->image_lib->resize();
					$upload_status = "Success";
				}*/

			//Debug($data_input);
			//echo "upload_status = $upload_status";
			//echo "<br>folder = $folder";
			//echo "<br>client_name = ".$this->upload->client_name;
			//die();
			//******************* List data input **********************/
			if($data_input)
					foreach($data_input as $key => $val){

							if($key == "zd_id2"){
									$new_data['zid'] = $data_input['zd_id2'];
							}else if($key == "zd_id"){
									$new_data['zid'] = $data_input['zd_id'];
									//$new_data_th['zd_id'] = $data_input['zd_id'];
									$new_data['zid2'] = $data_input['zd_id'];
									$new_data_th['zid2'] = $data_input['zd_id'];
							}else if($key == "zid_en"){
									$new_data['zid'] = $data_input['zid_en'];
									$new_data['zid2'] = $data_input['zid_en'];
							}else if($key == "zid_th"){
									$new_data_th['zid'] = $data_input['zid_th'];
									$new_data_th['zid2'] = $data_input['zid_en'];

							}else if($key == "zid"){
								//ราศี

									//if($data_input['subcategory_id'] == 39){
										$new_data['zodiac_id'] = $data_input['zid'];
										$new_data_th['zodiac_id'] = $data_input['zid'];
									//}

							}else if($key == "zodiac_date"){

									//if($data_input['subcategory_id'] == 39){
										//Convert into MM/DD/YYYY ==> YYYY-MM-DD
										$new_data['zodiac_date'] = DateDB($data_input['zodiac_date']);
										$new_data_th['zodiac_date'] = $new_data['zodiac_date'];
									//}

							}else if($key != "tag_id" && $key != "relate_list" && $key != "update_keyword" && $key != "auto_tags" && $key != "start_date" && $key != "folder" && $key != "create_date" && $key != "highlight" && $key != "megamenu"){
									
									if($key == "title_en" || $key == "description_en" || $key == "detail_en"){

											if($key == "title_en"){  
												$new_data['title'] = StripTxt($data_input['title_en']); 
												$new_data['lang'] = "en"; 
											}
											if($key == "description_en")  $new_data['description'] = $data_input['description_en'];
											if($key == "detail_en")  $new_data['detail'] = $data_input['detail_en'];

									}else if($key == "title_th" || $key == "description_th" || $key == "detail_th"){

											if($key == "title_th"){
												$new_data_th['title'] = StripTxt($data_input['title_th']);
												$new_data_th['lang'] = "th"; 
											}
											if($key == "description_th")  $new_data_th['description'] = $data_input['description_th'];
											if($key == "detail_th")  $new_data_th['detail'] = $data_input['detail_th'];

									}else{
											$new_data[$key] = $val;
											$new_data_th[$key] = $val;
									}
							}

							if($key == "tag_id"){
									foreach($val as $key2 => $val2){			
											$tag_id[] = $val2;
									}
							}
					}
			//Debug($new_data);
			//die();

			//Set Date Display
			if(isset($data_input['start_date'])){
				//list($date, $time, $time2) = explode(" ", $data_input['start_date']);
				//if($time2 == "PM") $time = $time +12;
				$new_data['start_date'] = DateTimeDB($data_input['start_date']);
				$new_data_th['start_date'] = $new_data['start_date'];
			}

			if(isset($data_input['expire_date'])){
				//list($date, $time, $time2) = explode(" ", $data_input['expire_date']);
				//if($time2 == "PM") $time = $time +12;
				$new_data['expire_date'] = DateTimeDB($data_input['expire_date']);
				$new_data_th['expire_date'] = $new_data['expire_date'];
			}

			//$columnist_id = $data_input['columnist_id'];
			//**************************************** ใส่ Tags ใน Content editor ***************************************
			if(isset($data_input['auto_tags'])) $autotags = 1; else $autotags = 0;

			//echo "<br>column_id2 = ".$new_data['column_id2'];
			//Debug($tags_all);

			$autotags = 0;
			if(($new_data['zid2'] == 0) || ($autotags == 1)){
				if(isset($tags_all))
					if($tags_all){
							$number_tag = count($tags_all);
							$counttag = 0;
							for($i=0;$i<$number_tag;$i++){

								$textnormal = $tags_all[$i]->tag_text;
								/*$dara_type_id = $tags_all[$i]->dara_type_id;
								$dara_profile_id = $tags_all[$i]->dara_profile_id;
								$dara_type_name = $tags_all[$i]->dara_type_name;*/
								//$url = $this->config->config['www'].'/dara/'.$dara_type_id.'/'.$dara_profile_id.'/'.urlencode(RewriteTitle($dara_type_name)).'/'.urlencode(RewriteTitle($textnormal));
								//$url = $this->config->config['www'].'/dara/'.$dara_type_id.'/'.$dara_profile_id.'/'.RewriteTitle($dara_type_name).'/'.RewriteTitle($textnormal);
								$text_replace = '<a href="'.$url.'" target=_blank>'.$textnormal.'</a>';
								//echo "<br>$i). $dara_profile_id text_replace = $text_replace<br>textnormal = $textnormal<br>";

								if($textnormal){

										if(isset($new_data['detail']))
											if(preg_match("/$textnormal/i", $new_data['detail'])){
													$new_data['detail'] = str_replace($textnormal, $text_replace, $new_data['detail']);
													$counttag++;
													//Debug($new_data['detail']);
											}

										if(isset($new_data['description']))
											if(preg_match("/$textnormal/i", $new_data['description'])){
													//echo "<br>str_replace($textnormal, $text_replace, ".$new_data['description'].");<br>";
													$new_data['description'] = str_replace($textnormal, $text_replace, $new_data['description']);
													$counttag++;
													//Debug($new_data['description']);
											}

										if(preg_match("/$textnormal/i", $new_data_th['detail'])){
												$new_data_th['detail'] = str_replace($textnormal, $text_replace, $new_data_th['detail']);
												$counttag++;
												//Debug($new_data_th['detail']);
										}

										if(preg_match("/$textnormal/i", $new_data_th['description'])){
												$new_data_th['description'] = str_replace($textnormal, $text_replace, $new_data_th['description']);
												$counttag++;
												//Debug($new_data_th['description']);
										}
								}
							}
					}
			} //Add tags
			
			//die();
			//*********************************************************

			unset($new_data['orderid']);
			unset($new_data_th['orderid']);
			//Debug($data_input);

			/*if($data_input['column_id_th'] != $data_input['column_id']){
				$newcount = 2;
			}else
				$newcount = 1;*/
			
			/*echo "<hr>data_input";
			Debug($data_input);

			echo "<hr>new_data";
			Debug($new_data);
			echo "<hr>new_data_th";
			Debug($new_data_th);*/

			if(isset($new_data['credit_id']))
				$new_data['credit_id'] = $new_data_th['credit_id'] = json_encode($new_data['credit_id']);
			else
				$new_data['credit_id'] = $new_data_th['credit_id'] = null;

			/*if(isset($data_input['icon_vdo'])){
					$new_data['icon_vdo'] = 1;
					$new_data_th['icon_vdo'] = 1;
			}else{
					$new_data['icon_vdo'] = 0;
					$new_data_th['icon_vdo'] = 0;
			}*/

			//Debug($new_data);
			//Debug($new_data_th);
			//die();

			if($new_data['zid'] > 0){

						$action = 2;
						$chk_tags_pair = 0;
						//echo "<br>newcount == $newcount<br>";

								$new_data['lastupdate_by'] = $this->session->userdata('admin_id');
								$new_data_th['lastupdate_by'] = $this->session->userdata('admin_id');

								$zd_id = $zd_id_en = $new_data['zid'];
								$zd_id_th = $new_data_th['zid'];
								$zmax_id = $zd_id = $new_data['zid2'];

								unset($new_data['zid']);
								unset($new_data_th['zid']);
								unset($new_data['zid2']);
								unset($new_data_th['zid2']);
								unset($new_data_th['lang']);

								$this->Zodiaclist_model->store($zd_id_en, $new_data);
								$this->Zodiaclist_model->store($zd_id_th, $new_data_th);


			}else{

						$action = 1;
						$chk_tags_pair = 1;

						$new_data['create_date'] = $now_date;
						$new_data['create_by'] = $this->session->userdata('admin_id');

						$new_data_th['create_date'] = $now_date;
						$new_data_th['create_by'] = $this->session->userdata('admin_id');

						$max_id = $this->Zodiaclist_model->get_max_id();
						$zmax_id = (intval($max_id[0]['max_id'])>0) ? $max_id[0]['max_id'] + 1 : 1;
						
						$new_data['zid'] = $zmax_id;
						$new_data['zid2'] = $zmax_id;
						$new_data_th['zid2'] = $zmax_id;

						$new_data['order_by'] = 1;
						$new_data_th['order_by'] = 1;

						//echo "new_data";
						//Debug($new_data);

						//echo "new_data_th";
						//Debug($new_data_th);

						$this->Zodiaclist_model->update_orderadd(0);

						$this->Zodiaclist_model->store(0, $new_data);
						$this->Zodiaclist_model->store(0, $new_data_th);

			}
			//Debug($tag_id);
			//die();

			/***************************tags*************************************/
			if(isset($data_input['update_keyword'])) $update_keyword = 1; else $update_keyword = 0;
			//Debug($data_input);
			//$chk_tags_pair = 1;
			$tag_pair = array();

			if($chk_tags_pair == 1 || $update_keyword == 1){

					//if(count($tag_id) < 5){
							if(isset($new_data['dara_id'])) $dara_id = $new_data['dara_id']; else $dara_id = 0;
							//$get_tag_dara = $this->tags_model->get_tag_pair($dara_id, 5);
							//Debug($get_tag_dara);
							$clear = 1;
							/*if($get_tag_dara){
									for($i=0;$i<count($get_tag_dara);$i++){
											$tag_pair[$i]["tag_id"] = $get_tag_dara[$i]->tag_id;
											$tag_pair[$i]["ref_id"] = $zd_id;
											$tag_pair[$i]["ref_type"] = 2;
											$tag_pair[$i]["create_date"] = $now_date;
											//$tag_pair[$i]["create_date"] = NOW(), FALSE;
											$next = $i;
									}
							}*/

							if($tag_id){
									for($i=0;$i<count($tag_id);$i++){
											$tag_pair2[$i]["tag_id"] = $tag_id[$i];
											$tag_pair2[$i]["ref_id"] = $zmax_id;
											$tag_pair2[$i]["ref_type"] = 2;
											$tag_pair2[$i]["create_date"] = $now_date;
											//$tag_pair[$i]["create_date"] = NOW(), FALSE;
									}
									/*echo "<hr>tag_pair";
									Debug($tag_pair);
									echo "<hr>tag_pair2";
									Debug($tag_pair2);*/

									//Debug($tag_pair);
									//$tag_pair = array_merge($tag_pair, $tag_pair2);
									$m=0;
									for($i=0;$i<count($tag_pair);$i++){
											//echo "<hr>tag_id => ".$tag_pair2[$i]["tag_id"];
											$have = 0;
											for($j=0;$j<count($tag_pair2);$j++){
													if($tag_pair[$i]["tag_id"] == $tag_pair2[$j]["tag_id"]) $have = 1;
													//echo "<br>COMPARE ".$tag_pair[$i]["tag_id"].' == '.$tag_pair2[$j]["tag_id"];
											}

											if($have == 0 && isset($tag_pair2[$j-1]["tag_id"])){

													//echo "<br> is add array ".$tag_pair[$i]["tag_id"];
													$tag_compair[$m]["tag_id"] = $tag_pair[$i]["tag_id"];
													$tag_compair[$m]["ref_id"] = $tag_pair[$i]["ref_id"];
													$tag_compair[$m]["ref_type"] = 2;
													$tag_compair[$m]["create_date"] = $now_date;
													$m++;

											}//else echo "<br> not is add array ".$tag_pair2[$j-1]["tag_id"];
									}
									$tag_pair = array_merge($tag_pair2, $tag_compair);

							}
							//echo "<hr><h2>tag_compair</h2>";
							//Debug($tag_compair);

							//echo "<hr><h2>tag_pair</h2>";
							//Debug($tag_pair);
							//die();
							if($tag_pair) $this->tags_model->store_tag_pair($tag_pair, $clear, 0, $zmax_id);
					//}
			}
			//die();
			/********************************************/
			//Debug($new_data);
			//Debug($data_input);

			if($upload_status == "Success"){
						$picture_obj['ref_id'] = $zmax_id;
						$picture_obj['ref_type'] = 2;
						$picture_obj['file_name'] = $this->upload->client_name;

						if($language['lang'] == 'en') 
							$picture_obj['caption'] = StripTxt($data_input['title_en']);
						else
							$picture_obj['caption'] = StripTxt($data_input['title_th']);

						$picture_obj['folder'] = $folder;
						$picture_obj['create_date'] = $now_date;
						$picture_obj['create_by'] = $this->session->userdata('admin_id');
						$picture_obj['default'] = 1;
						$picture_obj['status'] = 1;
						$this->picture_model->store(0, $picture_obj);
			}

			//**************Set Highlight
			if(isset($data_input['highlight'])){

				//Debug($data_input['highlight']);
				$data_highlight = array(
						"news_id" => $column_id,
						"ref_type" => 2,
						"order" => 0
				);							
				//Debug($data_highlight);
				$this->Zodiaclist_model->set_highlight($zmax_id, $data_highlight);
				$this->Zodiaclist_model->update_order_highlight();
				//echo "new_id = $new_id";
				//die();
			}else{
				$this->Zodiaclist_model->remove_highlight($zmax_id);
				//echo "new_id = $new_id";
			}

			//**************Set Megamenu
			if(isset($data_input['megamenu'])){

				//Debug($data_input['highlight']);
				$data_megamenu = array(
						"id" => $column_id,
						"category_id" => $new_data['category_id'],
						"ref_type" => 2,
						"order" => 0
				);							
				$this->Zodiaclist_model->set_megamenu($zmax_id, $data_megamenu);
				//echo "new_id = $new_id";
				//die();
			}else{
				$this->Zodiaclist_model->remove_megamenu($zmax_id);
				//echo "new_id = $new_id";
			}

			//Debug($data_input);
			//**************18+
			/*if(isset($data_input['up18']) && $data_input['up18'] == 1){
				//echo "18+ set_up18($column_id, 2)";
				$this->up18_model->set_up18($column_id, 2);
			}else{
				//echo "no 18+ remove_up18($column_id, 2)";
				$this->up18_model->remove_up18($column_id, 2);
			}*/
			//die();

			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $zmax_id,
								"ref_type" => 2,
								"ref_title" => StripTxt($data_input['title_th']),
								"action" => $action
			);			
			$this->admin_log_activity_model->store($log_activity);
			//Debug($log_activity );
			//**************Log activity

			$success =  'Save complete.';

			//redirect(base_url('zodiac/edit/'.$zmax_id.'?success='.urlencode($success)));
			redirect(base_url('zodiac?success='.urlencode($success)));
	}

	public function search_relate(){
			
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			if($this->input->server('REQUEST_METHOD') === 'GET'){

					$search_form = $this->input->get();
					if(isset($search_form['kw'])){
							
						$columnid = $search_form['columnid'];
						$column_list = $this->Zodiaclist_model->get_zodiac_list(null, $search_form['kw']);
						if($column_list){
								echo '<table id="sample-table-1" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Pic</th>
													<th>Title</th>
													<th>'.$language['create_date'].'</th>
													<th>'.$language['status'].'</th>
													<th>Count view</th>													
													<th width = "10%">Action</th>
												</tr>
											</thead>
											<tbody>';

								$maxlist = count($column_list);
								for($i=0;$i<$maxlist;$i++){
										//$url = "http://www.siamdara.com/news/".urlencode($news_list[$i]['title']).".html";
										//$url = "http://www.siamdara.com/news/".$news_list[$i]['news_id2'].".html";

										$img = base_url('uploads/thumb').'/'.$column_list[$i]['folder'].'/'.$column_list[$i]['file_name'];
										//$img = 'uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];

										if($column_list[$i]['file_name'] != "")
											$tags_img = (file_exists('uploads/thumb/'.$column_list[$i]['folder'].'/'.$column_list[$i]['file_name'])) ? "<img src=".$img." height='50'>" : "";
										else
											$tags_img = "";

										$status = ($column_list[$i]['status'] == 1) ? 'checked' : '';
										$iconstatus = '<div class="col-xs-3">
													<label>
														<input name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox" '.$status.' disabled>
														<span class="lbl"></span>
													</label>
												</div>';
										//$addurl = 'javascript:void(0);';
										$addurl = base_url('column/add_relate_column').'?column_id='.$column_list[$i]['column_id2'].'&ref_id='.$columnid;
										$edit_data = base_url('column/edit/'.$column_list[$i]['column_id2']);

										$iconadd = '<a href="'.$addurl.'" data-value="'.$column_list[$i]['column_id2'].'" class="add_relate"><i class="ace-icon glyphicon glyphicon-plus">Add relate</i></a>';

										echo "<tr>
										<td>".$column_list[$i]['column_id2']."</td>
										<td>".$tags_img."</td>
										<td><a href='".$edit_data."' target=_blank>".$column_list[$i]['title']."</a></td>
										<td>".$column_list[$i]['create_date']."</td>
										<td>".$iconstatus."</td>
										<td>".$column_list[$i]['countview']."</td>
										<td>".$iconadd."</td></tr>";
								}						
								echo "</tbody></table>";
						}else
								echo "ไม่มีข้อมูล";
					}
					//die();
			}

	}

	public function add_relate_column(){
			
			$data_input = $this->input->get();
			$ref_id = $data_input['ref_id'];
			$column_id = $data_input['column_id'];
			//Debug($data_input);
			$this->Zodiaclist_model->add_relate_column($ref_id, $column_id);
			//die();
			echo '<script type="text/javascript">
			<!--
				window.location="'.base_url("column/edit").'/'.$ref_id.'";
			//-->
			</script>';
	}

	public function add_relate_column2(){
			
			$data_input = $this->input->get();
			$ref_id = $data_input['ref_id'];
			$column_id = $data_input['column_id'];
			//Debug($data_input);
			$this->Zodiaclist_model->add_relate_column($ref_id, $column_id, '_column_relate_columnist');
			echo '<script type="text/javascript">
			<!--
				window.location="'.base_url("column/edit").'/'.$ref_id.'";
			//-->
			</script>';
	}

	public function delete($id){
			$OBJnews = $this->Zodiaclist_model->get_zodiac_list($id);
			$title = $OBJnews[0]['title'];
			$order_by = $OBJnews[0]['order_by'];

			$cat = $this->input->get('cat');

			//echo "Deleting... $id $title ";
			//Debug($OBJnews);

			$this->Zodiaclist_model->delete_column($id);

			//**************Order New
			$this->Zodiaclist_model->update_orderdel($cat, $order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => $title,
								"action" => $action
			);			
			$this->admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('column');
			die();
	}

	public function saveorder(){

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					Debug($search_form);
					//die();
					$data['order'] = $search_form['orderid'];
					$column_id = $search_form['column_id'];

					$columnobj = $this->Zodiaclist_model->get_status($column_id);

					if(isset($search_form['relate_id'])){
							if(count($search_form['relate_id']) < 5){

									$relate_id = $search_form['relate_id'];
									$orderid = $search_form['orderid'];
									$i = 1; 

									foreach($relate_id as $arr => $val){
											$this->Zodiaclist_model->update_order_relate($search_form['relate_id'][$arr], $column_id, $search_form['orderid'][$arr]);
											$i++;
									}

									/**************Log activity *********/
									$log_activity = array(
														"admin_id" => $this->session->userdata('admin_id'),
														"ref_id" => $column_id,
														"ref_type" => 2,
														"ref_title" => $columnobj[0]['title']." relate [Order By]",
														"action" => 2
									);			
									$this->admin_log_activity_model->store($log_activity);
									//**************Log activity

									//$success =  'Save Order complete.';
									redirect(base_url('column/edit').'/'.$column_id);
									die();
							}
					}
			}

	}	

	public function saveorder2(){

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					Debug($search_form);
					//die();
					$data['order'] = $search_form['orderid'];
					$column_id = $search_form['column_id'];

					$columnobj = $this->Zodiaclist_model->get_status($column_id);

					if(isset($search_form['relate_id'])){
							if(count($search_form['relate_id']) < 5){

									$relate_id = $search_form['relate_id'];
									$orderid = $search_form['orderid'];
									$i = 1; 

									foreach($relate_id as $arr => $val){
											$this->Zodiaclist_model->update_order_relate($search_form['relate_id'][$arr], $column_id, $search_form['orderid'][$arr], '_column_relate_columnist');
											$i++;
									}

									/**************Log activity *********/
									$log_activity = array(
														"admin_id" => $this->session->userdata('admin_id'),
														"ref_id" => $column_id,
														"ref_type" => 2,
														"ref_title" => $columnobj[0]['title']." relate columnist [Order By]",
														"action" => 2
									);			
									$this->admin_log_activity_model->store($log_activity);
									//**************Log activity

									//$success =  'Save Order complete.';
									redirect(base_url('column/edit').'/'.$column_id);
									die();
							}
					}
			}
	}	

	public function set_default($id = 0){

			$this->load->model('picture_model');

			//$data_input = $this->input->post();
			$data_input = $this->input->get();
			$type = 2;
			echo "Set default... $id";

			//Debug($data_input);
			$id = $data_input['id'];
			$ref_id = $data_input['ref_id'];
			
			$OBJnews = $this->Zodiaclist_model->get_zodiac_list($ref_id);
			//Debug($OBJnews);

			$news_id = $OBJnews[0]['column_id2'];
			$title = "Set default picture ".$OBJnews[0]['title'];
			$order_by = $OBJnews[0]['order_by'];

			//$this->Zodiaclist_model->set_default($id, $ref_id);
			$this->picture_model->set_default($id, $ref_id, $type);

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $ref_id,
								"ref_type" => $type,
								"ref_title" => 'set default picture'.$title,
								"action" => $action
			);
			$this->admin_log_activity_model->store($log_activity);
			//**************Log activity

			//redirect('column/picture/'.$this->uri->segment(3));
			redirect('column/picture/'.$ref_id);
			die();
	}

	function sethighlight($id){

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$title = urldecode($this->input->post('title'));
					$op = $this->input->post('op');

					if($op == 'remove'){
						//**************Remove Highlight
						$this->Zodiaclist_model->remove_highlight($id);
						echo "0";
						/**************Log activity *********/
						$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => $title." [Remove highlight]",
								"action" => 2
						);			
						$this->admin_log_activity_model->store($log_activity);

					}else{
						//**************Set Highlight
						$data_highlight = array(
								"news_id" => $id,
								"ref_type" => 2,
								"order" => 0
						);
						$this->Zodiaclist_model->set_highlight($id, $data_highlight);
						$this->Zodiaclist_model->update_order_highlight();
						echo "1";
						/**************Log activity *********/
						$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 1,
								"ref_title" => $title." [Set highlight]",
								"action" => 2
						);			
						$this->admin_log_activity_model->store($log_activity);
					}

			}

	}

	function setmegamenu($id){

			if($this->input->server('REQUEST_METHOD') === 'POST'){
					$title = urldecode($this->input->post('title'));
					$catid = $this->input->post('catid');
					$catname = $this->input->post('cat');
					$op = $this->input->post('op');

					if($op == 'remove'){
						//**************Remove Highlight
						$this->Zodiaclist_model->remove_megamenu($id);
						echo "0";
						/**************Log activity *********/
						$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => $title." [Remove megamenu]",
								"action" => 2
						);			
						$this->admin_log_activity_model->store($log_activity);
					}else{

						//**************Set Megamenu
						$data_megamenu = array(
							"id" => $id,
							"category_id" => $catid,
							"ref_type" => 2,
							"order" => 0
						);							
						$this->Zodiaclist_model->set_megamenu($id, $data_megamenu);
						echo "1";
						/**************Log activity *********/
						$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 2,
								"ref_title" => $title." [Set megamenu]",
								"action" => 2
						);			
						$this->admin_log_activity_model->store($log_activity);
					}

			}
	}

	function auto_order($cat = 0){
				
				$language = $this->lang->language;
				$cat_view = array();

				//if($cat != 0) $cat_view['category_id'] = $cat;
				$object_list = $this->Zodiaclist_model->get_catcolumn($cat);
				//Debug($object_list);
				if(isset($object_list)){
						for($i=0;$i<count($object_list);$i++){
									$number = $i + 1;
									$id = $object_list[$i]['column_id2'];
									$title = $object_list[$i]['title'];
									$order_by = $object_list[$i]['order_by'];
									$data = array(
										"order_by" => $number
									);
									echo "$id $title  [$order_by ==> $number]<br>";
									$this->Zodiaclist_model->store2($id, $data);
						}
						echo "<hr>UPDATE Order cat = $cat  total = ".count($object_list)." record.";
				}
	}

	private function set_watermark_options($client_name, $text = "Siamdara"){   

		$config = array();
		$folder = date('Ymd');
		
		$config['source_image'] = './uploads/column/'.$folder.'/'.$client_name;
		$config['new_image'] =  './uploads/column/'.$folder.'/sd_'.$client_name;
		$config['wm_text'] = $text ;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './system/fonts/texb.ttf';
		$config['wm_font_size'] = '16';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '20';
		$config['wm_opacity'] = '50';
		$config['wm_shadow_distance'] = '3';

		return $config;
	}

}
