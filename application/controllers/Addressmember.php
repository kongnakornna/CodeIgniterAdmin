<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Addressmember extends CI_Controller {

    public function __construct()    {
        parent::__construct();
			$this->load->model('News_model');
			$breadcrumb = array();
			//$Path_CKeditor = 'theme/assets/ckeditor-integrated/ckeditor';
			//$Path_CKfinder = 'theme/assets/ckeditor-integrated/ckfinder';

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }

	public function index(){
			
			#$this->load->model('Category_model');
			#$this->load->model('Subcategory_model');
			
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$category_id = $subcategory_id = 0;
			$start_page = 0;
			$p = 1;
			$list_page = 10;
			$listspage = '';
			$datainput = $this->input->get();
			//Debug($datainput);
			if(isset($datainput['p'])){
				$p = ($datainput['p'] > 0) ? $datainput['p'] : 1;
				if($p > 1){
						$start_page = ($p-1)*$list_page;
				}
			}else{
				$p = 1;
			}
			$breadcrumb[] = $language['news'];
			$opt[]	= makeOption(10, 10);
			$opt[]	= makeOption(20, 20);
			$opt[]	= makeOption(50, 50);
			$opt[]	= makeOption(100, 100);
			$opt[]	= makeOption(500, 500);

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();
					if(isset($search_form['category_id'])){ 
						$category_id = $search_form['category_id'];

						if(isset($search_form['subcategory_id'])){ 
							$subcategory_id = $search_form['subcategory_id']; 
						}else $subcategory_id = 0;

					}else{
						unset($search_form['subcategory_id']);
						$category_id = 0;
					}

					if(isset($search_form['list_page'])) $list_page = ($search_form['list_page'] > 0) ? $search_form['list_page'] : 10;

					$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);

					if(isset($search_form['selectid'])){
							//Debug($search_form);
							$selectid = $search_form['selectid'];
							$order = $search_form['order'];
							$search_form['category_id'] = $category = $search_form['category'];
							$maxsel = count($selectid);
							$toup = $tmp = 0;

							for($i=0;$i<$maxsel;$i++){


									if($tmp > $order[$i]){

											//echo "(".$tmp." > ".$order[$i].")<br>";
											//Update ID ด้านหน้า + 1
											$this->News_model->update_orderid_to_down($category, $order[$i], $tmp);
											//Debug($this->db->last_query());
									}

									//echo "<hr>";

									if($order[$i]%10 == 1){
											
											//echo "(".$order[$i]."%10 == 1)";

									}else if((($tmp + 1) <> $order[$i]) && ($toup == 0)){
											
											//echo "((($tmp + 1) <> ".$order[$i].") && ($toup == 0))<br>";

											//Update ID ด้านหลัง - 1
											$toup = $tmp + 1;
											$this->News_model->update_orderid_to_up($category, $order[$i], $toup);
											//Debug($this->db->last_query());
									}

									//Update Cur ID
									$this->News_model->update_order($category, $selectid[$i], $order[$i]);
									//Debug($this->db->last_query());
									if($tmp == 0 || $tmp != $order[$i]) $tmp = $order[$i];
									//echo "<hr>";
							}
							$category_id = $category;
							$subcategory_id = 0;
							//die();
					}

					//$keyword = trim($search_form['keyword']);
					if(isset($search_form['keyword'])){
						//$search_news = $search_form['keyword'];
						//$search_news['keyword'] = $search_form['keyword'];
						$search_news = explode(" " ,$search_form['keyword']);

						$news_list = $this->News_model->get_news(null, $search_news, $language['lang']);
						$category_list = $this->Category_model->getSelectCat(0, 'category_id', 'News');

					}else if(isset($search_form['selectid'])){

						$keyword = "Tmon";
						$news_list = $this->News_model->get_news(null, null, $language['lang']);

						if(isset($search_form['category_id'])){
								
							$cat_view['category_id'] = $search_form['category_id'];
							//Debug($cat_view);

							$news_list = $this->News_model->get_news(null, null, $language['lang'], $cat_view);
							//Debug($this->db->last_query());
							$category_list = $this->Category_model->getSelectCat($cat_view['category_id'], 'category_id', 'News');
							//Debug($this->db->last_query());

						}else
							$category_list = $this->Category_model->getSelectCat(0, 'category_id', 'News');

					}else{	
						//echo "no keyword";
						//$keyword = "Tmon";
						//Debug($search_form);
						
						unset($search_form['list_page']);
						//Debug($search_form);

						//$news_list = $this->News_model->get_news(null, null, $language['lang'], $search_form, 'order_by', 'Asc', $start_page, $list_page);
						$news_list = $this->News_model->get_news(null, null, $language['lang'], $search_form);
						$category_list = $this->Category_model->getSelectCat($search_form['category_id'], 'category_id', 'News');
						//Debug($search_form);
						//die();
					}
					//die();
			}else{

					$keyword = "Tmon";

					$get_data = $this->input->get();

					//category_id
					if(isset($get_data['category_id'])){
							$category_id = $get_data['category_id'];
							$search_form['category_id'] = $category_id;
							$news_list = $this->News_model->get_news(null, null, $language['lang'], $search_form);
							$category_list = $this->Category_model->getSelectCat($category_id, 'category_id', 'News');
							$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);
							$subcategory_id = 0;
					}else{

							//echo "get_news( 'order_by', 'Asc', $start_page, $list_page)";
							//$news_list = $this->News_model->get_news(null, null, $language['lang'], null, 'order_by', 'Asc', $start_page, $list_page);
							$news_list = $this->News_model->get_news(null, null, $language['lang'], null);

							$listspage = selectList( $opt, 'list_page', 'class="form-control"', 'value', 'text', $list_page);
							$category_list = $this->Category_model->getSelectCat(0, 'category_id', 'News');

					}
			}

			//$selcat = $this->input->post();
			//Debug($selcat);
			//if(isset($selcat['category_id'])) $category_id = 0;
			//if(isset($selcat['subcategory_id'])) $subcategory_id = 0;

			$totalnews = $this->News_model->countnews($category_id, $subcategory_id);
			$curpage = base_url('news?view=list');

			//$slip_page = ceil($maxnews/$list_page);
			//Debug($news_list);
			//die();

			$notification_birthday = $this->Api_model->notification_birthday();

			$data = array(
					"ListSelect" => $ListSelect,
					"news_list" => $news_list,
					//"GenPage" => GenPage($curpage, $p, $list_page, $totalnews),
					"category_list" => $category_list,
					"category_id" => $category_id,
					"subcategory_id" => $subcategory_id,
					"listspage" => $listspage,
					"totalnews" => $totalnews,
					"notification_birthday" => $notification_birthday,
					"breadcrumb" => $breadcrumb,
					"content_view" => 'news/news'
			);
			$msg = $this->input->get();
			if(isset($msg['success'])) $data['success'] = urldecode($msg['success']);

			$this->load->view('template/template',$data);
	}

	public function search(){
			
			//$this->load->model('Category_model');
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			//$breadcrumb[] = $language['news'];
			if($this->input->server('REQUEST_METHOD') === 'GET'){

					$search_form = $this->input->get();
					if(isset($search_form['kw'])){
						//echo "is keyword";
						$keyw = explode(" ", $search_form['kw']);
						//Debug($keyw);

						$news_list = $this->News_model->get_news(null, $keyw, $language['lang'], null, 'lastupdate_date', 'DESC', 0, 20);
						//Debug($news_list);
						if($news_list){

								echo '<table id="sample-table-1" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%">ID</th>
													<th width="5%">Pic</th>
													<th width="35%">Title</th>
													<th width="5%">'.$language['create_date'].'</th>
													<th width="5%">'.$language['status'].'</th>
													<th width="5%">Count view</th>
													<th width="40%">URL</th>
												</tr>
											</thead>
											<tbody>';

								$maxlist = count($news_list);
								for($i=0;$i<$maxlist;$i++){
										//$url = "http://www.Tmon.com/news/".urlencode($news_list[$i]['title']).".html";

										$news_id = $news_list[$i]['news_id2'];
										$category_id = $news_list[$i]['category_id'];
										$subcategory_id = $news_list[$i]['subcategory_id'];
										$category_name = RewriteTitle($news_list[$i]['category_name']);
										$subcategory_name = RewriteTitle($news_list[$i]['subcategory_name']);
										//RewriteTitle($news_list[$i]['title']

										$url = $this->config->config['www']."/news/".$category_id."/".$subcategory_id."/".$news_id."/".$category_name."/".$subcategory_name."/".RewriteTitle($news_list[$i]['title']);

										$img = base_url('uploads/thumb').'/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];
										//$img = 'uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];

										if($news_list[$i]['file_name'] != "" && isset($news_list[$i]['file_name']))
											$tags_img = (file_exists('uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'])) ? "<img src=".$img." height='50'>" : "";
										else
											$tags_img = "";

										$status = ($news_list[$i]['status'] == 1) ? 'checked' : '';
										$edit_data = base_url('news/edit/'.$news_list[$i]['news_id2']);

										$iconstatus = '<div class="col-xs-3">
													<label>
														<input name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox" '.$status.' disabled>
														<span class="lbl"></span>
													</label>
												</div>';

										echo "<tr>
										<td>".$news_id."</td>
										<td>".$tags_img."</td>
										<td><a href='".$edit_data."' target=_blank>".$news_list[$i]['title']."</a></td>
										<td>".$news_list[$i]['create_date']."</td>
										<td>".$iconstatus."</td>
										<td>".$news_list[$i]['countview']."</td>
										<td>".$url."</td></tr>";

								}						
								echo "</tbody></table>";
						}else
								echo "ไม่มีข้อมูล";
					}
					//die();
			}

	}

	public function search_relate(){
			
			//$this->load->model('Category_model');
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			if($this->input->server('REQUEST_METHOD') === 'GET'){

					$search_form = $this->input->get();
					if(isset($search_form['kw'])){

						$newsid = $search_form['newsid'];
						$keyw = explode(" ", $search_form['kw']);
						//Debug($keyw);

						$news_list = $this->News_model->get_news(null, $keyw, $language['lang'], null, 'lastupdate_date', 'DESC', 0, 20);
						//$news_list = $this->News_model->get_news(null, $search_form['kw'], $language['lang']);

						if($news_list){
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

								$maxlist = count($news_list);
								for($i=0;$i<$maxlist;$i++){
										//$url = "http://www.Tmon.com/news/".urlencode($news_list[$i]['title']).".html";
										//$url = "http://www.Tmon.com/news/".$news_list[$i]['news_id2'].".html";

										$img = base_url('uploads/thumb').'/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];
										//$img = 'uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];

										if($news_list[$i]['file_name'] != "" && isset($news_list[$i]['file_name']))
											$tags_img = (file_exists('uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'])) ? "<img src=".$img." height='50'>" : "";
										else
											$tags_img = "";

										$status = ($news_list[$i]['status'] == 1) ? 'checked' : '';
										$iconstatus = '<div class="col-xs-3">
													<label>
														<input name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox" '.$status.' disabled>
														<span class="lbl"></span>
													</label>
												</div>';
										//$addurl = 'javascript:void(0);';
										$addurl = base_url('news/add_relate_news').'?news_id='.$news_list[$i]['news_id2'].'&ref_id='.$newsid;
										$edit_data = base_url('news/edit/'.$news_list[$i]['news_id2']);
										$iconadd = '<a href="'.$addurl.'" data-value="'.$news_list[$i]['news_id2'].'" class="add_relate"><i class="ace-icon glyphicon glyphicon-plus">Add relate</i></a>';

										echo "<tr>
										<td>".$news_list[$i]['news_id2']."</td>
										<td>".$tags_img."</td>
										<td><a href='".$edit_data."' target=_blank>".$news_list[$i]['title']."</a></td>
										<td>".$news_list[$i]['create_date']."</td>
										<td>".$iconstatus."</td>
										<td>".$news_list[$i]['countview']."</td>
										<td>".$iconadd."</td></tr>";
								}						
								echo "</tbody></table>";
						}else
								echo "ไม่มีข้อมูล";
					}
					//die();
			}

	}

	public function add_relate_news(){
			
			$data_input = $this->input->get();
			$ref_id = $data_input['ref_id'];
			$news_id = $data_input['news_id'];
			//Debug($data_input);
			$this->News_model->add_relate_news($ref_id, $news_id);
			echo '<script type="text/javascript">
			<!--
				window.location="'.base_url("news/edit").'/'.$ref_id.'";
			//-->
			</script>';
	}

	public function add(){
			
			$this->load->model('Category_model');
			$this->load->model('Dara_model');
			$this->load->model('Tags_model');
			$this->load->model('Credit_model');

			$this->load->helper('ckeditor');

			$Path_CKfinder = base_url('plugins/ckeditor-integrated/ckfinder');
			$Path_CKeditor = 'plugins/ckeditor-integrated/ckeditor';

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] = $language['add'];

			//$category = $this->Category_model->get_category();
			$dara_list = $this->Dara_model->get_dara_profile();
			$category_list = $this->Category_model->getSelectCat(0, 'category_id', 'News');
			$tags_list = $this->Tags_model->getSelect();
			$credit_list = $this->Credit_model->get_data();
			
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					//"category" => $category,
					"dara_list" => $dara_list,
					"category_list" => $category_list,
					"tags_list" => $tags_list,
					"credit_list" => $credit_list,
					"content_view" => 'news/news_add',
					"breadcrumb" => $breadcrumb
			);

			//Ckeditor's configuration
			$data['ckeditor'] = array(
				'id'     =>     'description_en',
				'path'    =>    $Path_CKeditor,
				'config' => array(
					'toolbar'     =>     "Full",
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

			$data['detail_th'] = $data['detail_en'] = $data['description_th'] = $data['ckeditor'];
			$data['description_th']['id'] = 'description_th';
			$data['detail_en']['id'] = 'detail_en';
			$data['detail_th']['id'] = 'detail_th';

			$this->load->view('template/template',$data);

	}

	public function edit($id = 0){
			 
			 $this->load->library('user_agent');

			 $this->load->model('Category_model');			 
			 $this->load->model('Subcategory_model');
			 $this->load->model('Dara_model');
			 $this->load->model('Tags_model');
			  $this->load->model('Credit_model');
			 //$this->load->model('Picture_model');
			 $this->load->helper('ckeditor');

			$Path_CKfinder = base_url('plugins/ckeditor-integrated/ckfinder');
			$Path_CKeditor = base_url('plugins/ckeditor-integrated/ckeditor');

			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] = $language['edit'];
			
			//$category = $this->Category_model->get_category();
			$news_list =  $this->News_model->get_news($id);
			//debug($news_list);
			//die();
			
			$category_list = $this->Category_model->getSelectCat($news_list[0]['category_id'], 'category_id', 'News');
			
			if($news_list[0]['subcategory_id'] > 0){
				$subcategory_list = $this->Subcategory_model->getSelectSubcat($news_list[0]['category_id'], $news_list[0]['subcategory_id']);
			}else
				$subcategory_list = '<select class="form-control" id="subcategory_id" name="subcategory_id"></select>';
			
			$sel_tags = $this->Tags_model->get_tag_pair($id);
			//Debug($sel_tags);
			if($sel_tags)
				for($i=0;$i<count($sel_tags);$i++){
					@$tag_id[$i]->value = $sel_tags[$i]->tag_id;
				}

			//Debug($tag_id);
			//die();

			$tags_list = $this->Tags_model->getSelect($tag_id);
			$dara_list = $this->Dara_model->get_dara_profile();
			//$picture_list = $this->Picture_model->get_picture_by_ref_id($id);
			$relate_list = $this->News_model->get_relate($id);
			$credit_list = $this->Credit_model->get_data();
			
			$datalog = array(
					"ref_type" => 1,
					"ref_id" => $id
			);

			$view_log = $this->Admin_log_activity_model->view_log(0, $datalog);

			$displaylogs = $this->Admin_log_activity_model->DisplayLogs($id);
			//Debug($view_log);
			//die();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"news_list" => $this->News_model->get_news($id),
					"category_list" => $category_list,
					"highlight" => $this->News_model->get_highlight($id),
					//"megamenu" => $this->News_model->get_megamenu($id),
					"subcategory_list" => $subcategory_list,
					"dara_list" => $dara_list,
					"tags_list" => $tags_list,
					"credit_list" => $credit_list,
					//"picture_list" => $picture_list,
					"relate_list" => $relate_list,
					"view_log" => $view_log,
					"displaylogs" => $displaylogs,
					"content_view" => 'news/news_edit',
					"breadcrumb" => $breadcrumb
			);

			//Ckeditor's configuration
			$data['ckeditor'] = array(
				'id'     =>     'editorFull',
				'path'    =>    $Path_CKeditor,
				'config' => array(
					'toolbar'     =>     "Full",
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

			$data['ckeditor2'] = $data['ckeditor3'] = $data['ckeditor4'] = $data['ckeditor'];
			$data['ckeditor2']['id'] = 'description_th';
			$data['ckeditor3']['id'] = 'detail_en';
			$data['ckeditor4']['id'] = 'detail_th';

			if ($this->agent->is_mobile())
					$data['mobile'] = $this->agent->mobile();

			$this->load->view('template/template',$data);
	
	}

	public function picture($id = 0){
			
			if($id == 0){
				redirect('news');
				die();
			}

			 $this->load->model('Api_model');
			 $this->load->model('Picture_model');

			$tag_id = $load_bk = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] = $language['picture'];

			$picture_list = $this->Api_model->get_picture($id);
			$news_list = array();

			if(count($picture_list) == 0){
				$load_bk = $this->Api_model->load_pic_bk($id);
				$news_list =  $this->News_model->get_status($id);
			}

			//Debug($news_list);
			
			//$picture_list = json_decode("http://elvis.siamsport.co.th/services/search?q=autosalon%20AND%20extension:jpg&start=0&num=10&sort=name&metadataToReturn=all&format=json&facet.assetDomain.selection=image");

			//$picture_list = LoadJSON("search?q=autosalon%20AND%20extension:jpg&start=0&num=10&sort=name&metadataToReturn=all&format=json&facet.assetDomain.selection=image", "http://elvis.siamsport.co.th/services");

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"news_list" => $news_list,
					"picture_list" => $picture_list,
					"load_bk" => $load_bk,
					"content_view" => 'news/news_pic',
					"breadcrumb" => $breadcrumb,
			);
			$this->load->view('template/template',$data);
	}

	public function picture_order($id = 0){
			
			$this->load->library('user_agent');
						
			 $this->load->model('Api_model');
			 $this->load->model('Picture_model');

			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] ='<a href="'.base_url('news/picture/'.$this->uri->segment(3)).'">'.$language['picture'].'</a>';
			$breadcrumb[] = $language['order'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					$this->set_order_picture2($this->uri->segment(3), $search_form);

			}

			$picture_list = $this->Api_model->get_picture($id);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"news_list" => $this->News_model->get_news_by_id($id),
					//"category_list" => $category_list,
					//"subcategory_list" => $subcategory_list,

					"picture_list" => $picture_list,
					"content_view" => 'news/news_pic_order',
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}

	public function set_order_picture2($newsid, $obj){
					
					//$lang = $this->lang->language;
					$update_data = array();
					//Debug($this->input->post());
					//echo "newsid = $newsid<br>";
					//echo "count = ".count($obj['picture_id'])."<br>";
					//Debug($obj);
					$updateorder = $tmp = $do = 0;
					$num = 1;
					if($obj)
						for($i = 0; $i< count($obj['picture_id']);$i++){

								unset($update_data);
								$orderid = $obj['orderid'][$i];
								$picture_id = $obj['picture_id'][$i];
								$update_data['order'] = $orderid;

								if($tmp == 0){
										if(($do == 0) && (($tmp+1) != $orderid)){
											$this->News_model->set_order_picture_to_up($newsid, $picture_id, $orderid, $tmp+1); //--
											$updateorder = $orderid;
											$this->News_model->set_order_picture($newsid, $picture_id, $update_data);
											$do++;

										}else{
											$this->News_model->set_order_picture($newsid, $picture_id, $update_data);
											//$tmp = $orderid;
										}
										//echo "<br>case 0 $picture_id == $orderid<br>";
								}else if(($tmp != $orderid) && (($tmp+1) == $orderid)){
										if($updateorder != $orderid) $this->News_model->set_order_picture($newsid, $picture_id, $update_data);
										//$tmp = $orderid;
										//echo "<br>case 1 $picture_id == $orderid<br>";
								}else{

										//echo "<br>case 2 tmp =$tmp > $orderid<br>";
										//echo "($tmp < $orderid)<br>";

										if($tmp > $orderid){
												$between = $orderid - $tmp;
												//echo "(between : $between)<br>";
												/*echo "(newsid =$newsid, orderid =$orderid)<br>";
												echo "(newsid =$newsid, picture_id = $picture_id, update_data = ".print_r($update_data).")<br>";*/
												if($do == 0){
													$this->News_model->set_order_picture_to_down($newsid, $picture_id, $orderid, $tmp);
													$updateorder = $orderid;
													$this->News_model->set_order_picture($newsid, $picture_id, $update_data);
													$do++;
												}else{
													if($updateorder != $orderid) $this->News_model->set_order_picture($newsid, $picture_id, $update_data);
												}
										}else{
												//echo "($newsid, $orderid, $tmp)<br>";
												if($do == 0){
													$this->News_model->set_order_picture_to_up($newsid, $picture_id, $orderid, $tmp+1);
													$updateorder = $orderid;
													$this->News_model->set_order_picture($newsid, $picture_id, $update_data);
													$do++;
												}else{
													if($updateorder != $orderid) $this->News_model->set_order_picture($newsid, $picture_id, $update_data);
												}
										}
								}
								$tmp++;
								$num++;
						}

				$news = $this->News_model->get_news_by_id($newsid);

				//**************Log activity
				$action = 2;
				$log_activity = array(
									"admin_id" => $this->session->userdata('admin_id'),
									"ref_id" => $newsid,
									"ref_type" => 1,
									"ref_title" => "จัดเรียง ".$news[0]['title'],
									"action" => $action
				);
				$this->Admin_log_activity_model->store($log_activity);
				//**************Log activity
	}

	public function picture_edit($id = 0, $idtype = 0){
			
			$this->picture_edit_thumb($id, $idtype);

			 /*$this->load->model('Api_model');
			 $this->load->model('Picture_model');

			 $orientation = 1;
			 $ref_id = $this->input->get();
			if($ref_id)
				foreach($ref_id as $key => $val){
						//echo "<br>".$news_id." : ".$val;
						if($key == "news_id") $news_id = $val;
						if($key == "Orientation") $orientation = $val;
				}
			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('news/picture').'/'.$ref_id['news_id'].'">'.$language['picture'].'</a>';
			$breadcrumb[] = $language['edit'];

			$picture_list = $this->Api_model->get_picture($news_id, $id);
			$news_item = $this->News_model->get_news($news_id);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"news_id" => $news_id,
					"news_item" => $news_item[0],
					"orientation" => $orientation,
					"picture_list" => $picture_list,
					"content_view" => 'news/news_pic_edit',
					"breadcrumb" => $breadcrumb,
					"error" => array()
			);
			$this->load->view('template/template',$data);*/
	}

	public function picture_edit_thumb($id = 0, $idtype = 0){
						
			 $this->load->model('Api_model');
			 $this->load->model('Picture_model');

			 $orientation = 1;
			 $ref_id = $this->input->get();
			if($ref_id)
				foreach($ref_id as $key => $val){
						//echo "<br>".$news_id." : ".$val;
						if($key == "news_id") $news_id = $val;
						if($key == "Orientation") $orientation = $val;
				}
			$tag_id = array();
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('news').'">'.$language['news'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('news/picture').'/'.$ref_id['news_id'].'">'.$language['picture'].'</a>';
			$breadcrumb[] = $language['edit'];

			$picture_list = $this->Api_model->get_picture($news_id, $id);
			$news_item = $this->News_model->get_news($news_id);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"news_id" => $news_id,
					"news_item" => $news_item[0],
					"orientation" => $orientation,
					"picture_list" => $picture_list,
					"content_view" => 'news/news_pic_edit_thumb',
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);
	}

	public function rotate(){

			$this->load->model('Picture_model');
			//$gallery_id = $this->input->get('gallery_id');
			$rotate = $this->input->get('rotate');
			$folder = $this->input->get('folder');
			$file = $this->input->get('file');

			$rotate = ($rotate == "l") ? -90 : 90;  //หมุนทวนเข็มนาฬิกา และ ตามเข็มนาฬิกา
			$sourcefile = './uploads/news/'.$folder.'/'.$file;
			$sourcefile_tmp = './uploads/tmp/'.$folder.'/'.$file;

			//Debug($sourcefile);
			//Debug($rotate);
			$this->Picture_model->rotate_img($sourcefile, $sourcefile, $rotate, 1);
			$this->Picture_model->rotate_img($sourcefile_tmp, $sourcefile_tmp, $rotate, 0);
	}

	public function picture_watermark($id = 0){

			$this->load->model('Api_model');
			$this->load->model('Picture_model');
			$this->load->helper('img');

			$ref_id = $this->input->post();
			if($ref_id)
				foreach($ref_id as $key => $val){
						if($key == "id") $id = $val;
						if($key == "news_id") $news_id = $val;
						if($key == "folder") $folder = $val;
						if($key == "file") $file = $val;
						if($key == "watermark") $watermark = $val;
						if($key == "caption") $caption = StripTxt($val);
				}
			//Debug($ref_id);
			//die();
			switch($watermark){
						case "center" : $picture_list = $this->Picture_model->watermark($file, $folder); break;
						case "horizontal" : $picture_list = $this->Picture_model->watermark($file, $folder, 'news', 1); break;
						case "vertical" : $picture_list = $this->Picture_model->watermark($file, $folder, 'news', 2); break;
						default : $picture_list = $this->Picture_model->watermark($file, $folder, 'news', 3); break; //Logo ขนาดใหญ่
			}

			$data = array(
				"caption" => $caption
			);
			$this->Picture_model->store($id, $data);

			$log_activity = array(
					"admin_id" => $this->session->userdata('admin_id'),
					"ref_id" => $news_id,
					"ref_type" => 1,
					"ref_title" => "Set picture news picture id: ".$id." ".$caption,
					"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);

			 //Debug($picture_list);
			 //die();
			redirect('news/picture_edit_thumb/'.$id.'?news_id='.$news_id);
			//http://localhost/Tmon_admin/news/picture_edit_thumb/121?news_id=43
			die();	
	}

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

			$this->load->model('Picture_model');

			$ref_id = $this->input->get('ref_id');

			if($ref_id > 0 && $pic_id > 0){

					$picture_list = $this->Api_model->get_picture($ref_id, $pic_id);
					$this->Picture_model->delete_picture_admin($pic_id);
	
			}

			$news_list =  $this->News_model->get_news_by_id($ref_id);
			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $ref_id,
								"ref_type" => 1,
								"ref_title" => "[picturn $pic_id]".$news_list[0]['title'],
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('news/picture/'.$ref_id);

	}

	function upload_pic(){

			$this->load->model('Picture_model');
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
				//$folder = $data_input['create_date'];
				$create_date = ConvertDate8toFormat($data_input['create_date'], '/');
				//Debug($create_date);
				$folder = $create_date;
			}
			//Debug($folder);
			//die();
			$picture_list = $this->Api_model->get_picture($data_input['news_id']);

			//$config['path_thumb'] = './uploads/news/thumb/';
			//if(!is_dir($config['path_thumb'])) mkdir($config['path_thumb'], 0777);

			$cpt = count($_FILES['picture_news']['name']);
			for($i=0; $i<$cpt; $i++){

				$_FILES['userfile']['name']= $files['picture_news']['name'][$i];
				$_FILES['userfile']['type']= $files['picture_news']['type'][$i];
				$_FILES['userfile']['tmp_name']= $files['picture_news']['tmp_name'][$i];
				$_FILES['userfile']['error']= $files['picture_news']['error'][$i];
				$_FILES['userfile']['size']= $files['picture_news']['size'][$i];    
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
						$picture_obj['ref_id'] = $data_input['news_id'];
						$picture_obj['ref_type'] = 1;
						$picture_obj['file_name'] = $this->upload->client_name;
						//$picture_obj['title'] = StripTxt($data_input['title']);						
						$picture_obj['caption'] = StripTxt($data_input['caption']);
						$picture_obj['folder'] = $folder;
						$picture_obj['create_date'] = $now_date;
						$picture_obj['create_by'] = $this->session->userdata('admin_id');
						$picture_obj['status'] = 1;

						if((count($picture_list) == 0) && ($i == 0)) $picture_obj['default'] = 1;

						$this->Picture_model->store(0, $picture_obj);
				}
				//Debug($this->upload);

			}

			$news_list =  $this->News_model->get_news_by_id($data_input['news_id']);
			//**************Log activity
			$action = 2;
			$log_activity = array(
									"admin_id" => $this->session->userdata('admin_id'),
									"ref_id" => $data_input['news_id'],
									"ref_type" => 1,
									"ref_title" => "[Upload Picturn $cpt]".$news_list[0]['title'],
									"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect(base_url('news/picture/'.$data_input['news_id']));
	}

	private function set_upload_options($folder = ''){  

		$config = array();
		$addfolder = "";
		$chkfolder = explode("/", $folder);
		//if($folder == '') $folder = date('Ymd');
		if(count($chkfolder) > 1){
				$addfolder = "";
				for($i=0;$i<count($chkfolder);$i++){

						if($i == 0)
							$addfolder = $chkfolder[$i];
						else
							$addfolder .= "/".$chkfolder[$i];

						$config['upload_path'] = './uploads/news/';
						if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

						$config['upload_path'] = './uploads/news/'.$addfolder;
						if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

						$upload_path = './uploads/tmp/';
						if(!is_dir($upload_path)) mkdir($upload_path, 0777);

						$upload_path = './uploads/tmp/'.$addfolder;
						if(!is_dir($upload_path)) mkdir($upload_path, 0777);
						//Debug($upload_path);
				}
				$folder = $addfolder;
		}else{

				$config['upload_path'] = './uploads/news/';
				if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

				$config['upload_path'] = './uploads/news/'.$folder;
				if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

				$upload_path = './uploads/tmp/';
				if(!is_dir($upload_path)) mkdir($upload_path, 0777);

				$upload_path = './uploads/tmp/'.$folder;
				if(!is_dir($upload_path)) mkdir($upload_path, 0777);

		}
		
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;

		return $config;
	}

	private function set_resize_options($client_name, $folder = '', $width = 300, $height = 169){   

		$config = array();
		if($folder == '') $folder = date('Ymd');
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/tmp/'.$folder.'/'.$client_name;
		$config['new_image'] = './uploads/news/'.$folder.'/'.$client_name;

		$config['create_thumb'] = FALSE;	//สร้าง Thumb โดย CI
		$config['maintain_ratio'] = TRUE;
		//$config['width']     = $width;
		//$config['height']   = $height;

		//****Copy Original File to TMP
		$upload_path = './uploads/tmp/'.$folder;
		$tmp = $upload_path.'/'.$client_name;

		$src = fopen($config['new_image'], 'r');
		$dest = fopen($tmp, 'w');

		stream_copy_to_stream($src, $dest);

		return $config;
	}
	
	public function remove_img($id = 0){
			
			$src = $this->input->post('name');

			if(file_exists('uploads/dara/'.$src)) unlink('uploads/dara/'.$src);
			$obj_data['picture_news'] = '';
			if($this->News_model->store($dara_profile_id, $obj_data))
				echo 'Yes';
			else
				echo 'No';

			/*$src = $this->input->post('name');
			 if ($this->input->server('REQUEST_METHOD') === 'POST'){
					if(file_exists('uploads/news/'.$src)) unlink('uploads/news/'.$src);
					if(file_exists('uploads/thumb/'.$src)) unlink('uploads/thumb/'.$src);
					$obj_data['picture_news'] = '';
					if($this->News_model->store($id, $obj_data))
						echo 'Yes';
					else
						echo 'No';
			 }*/
	}

	public function order($id1, $id2){
			/*if($id == 0){
				$data = array(
						"error" => 'id error'
				);
				return false;
			}else{

					$obj_status = $this->News_model->get_status($id);
					$cur_status = $obj_status[0]['status'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;
					$obj_data['status'] = $cur_status;
					if($this->News_model->store2($id, $obj_data)) echo $cur_status;
						//echo "update succedd.";
					$this->gen_json($id);
			}*/
	}

	public function status($id = 0){
			if($id == 0){
					$data = array(
							"error" => 'id error'
					);
					return false;
			}else{

					$obj_status = $this->News_model->get_status($id);
					$cur_status = $obj_status[0]['status'];
					$title = $obj_status[0]['title'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;

					$obj_data['status'] = $cur_status;
					if($this->News_model->store2($id, $obj_data)) echo $cur_status;
					//$this->gen_json($id);
			}

			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 1,
								"ref_title" => "[Status]".$title,
								"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
	}


	public function approve($id = 0){
			if($id == 0){
					$data = array(
							"error" => 'id error'
					);
					return false;
			}else{

					$obj_status = $this->News_model->get_status($id);
					$cur_status = $obj_status[0]['approve'];
					$title = $obj_status[0]['title'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;

					$obj_data['approve'] = $cur_status;
					$obj_data['approve_date'] = date('Y-m-d H:i:s');
					$obj_data['approve_by'] = $this->session->userdata('admin_id');

					if($this->News_model->store2($id, $obj_data)) echo $cur_status;
					//echo "update succedd.";
					//$this->gen_json($id);
			}
			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 1,
								"ref_title" => "[Approve]".$title,
								"action" => 2
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
	}

	public function save(){

			$this->load->model('Tags_model');
			$this->load->model('Picture_model');
			$this->load->model('Category_model');
			
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			
			$tags_all = $this->Tags_model->getall_tag_pair(5); //tags ของดารา
			//$breadcrumb[] = $language['dara'];

			$new_data = $tag_id = $tag_pair = $picture_obj = $tag_dara = $log_activity = array();
			$data_input = $this->input->post();
			$upload_status = "";
			$new_id = 0;

			$now_date = date('Y-m-d H:i:s');
			$folder = date('Ymd');

			/*$this->load->library('form_validation');
			// field name, error message, validation rules
			$this->form_validation->set_rules('title', $language['title'], 'trim|required');
			$this->form_validation->set_rules('category_id	', $language['category_id'], 'trim|required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			if($this->form_validation->run() == FALSE){
					Debug($this->form_validation->set_error_delimiters());
			}else{
					echo "<hr>Save";
					//Debug($this->input->post());
					$this->News_model->store($dara_profile_id, $this->input->post());
			}*/

			$this->load->library('upload', $this->set_upload_options());
			$this->upload->initialize($this->set_upload_options());

			if ( ! $this->upload->do_upload('picture_news')){
					$error = array('error' => $this->upload->display_errors());
					$upload_status = $error;
			}else{
					/*$data = array(
							'admin_menu' => $this->menufactory->getMenu(),
							'upload_data' => $this->upload->data(),
							'upload_status' => 'Success',
							'error' => array()
					);*/
					$upload_status = "Success";
			}

				//Debug($data_input);
				//die();
			
				if(isset($data_input['relate_id'])){
						if(count($data_input['relate_id']) < 5){

								$relate_id = $data_input['relate_id'];
								$orderid = $data_input['orderid'];
								$i = 1; 

								foreach($relate_id as $arr => $val){
										$this->News_model->update_order_relate($val, $data_input['news_id'], $orderid[$arr]);
										$i++;
								}

								/**************Log activity
								$log_activity = array(
													"admin_id" => $this->session->userdata('admin_id'),
													"ref_id" => $data_input['news_id'],
													"ref_type" => 1,
													"ref_title" => $data_input['title_th']." [Order By]",
													"action" => 2
								);			
								$this->Admin_log_activity_model->store($log_activity);*/
								//**************Log activity

								//$success =  'Save Order complete.';
								//redirect(base_url('news/edit').'/'.$data_input['news_id']);
								//die();
						}
				}

			//Debug($relate_id);
			//Debug($orderid);

			//Debug($data_input);
			//die();

			//******************* List data input **********************/
			if($data_input)
					foreach($data_input as $key => $val){
							if($key == "news_id_en"){
									
									$new_data['news_id'] = $data_input['news_id_en'];

							}else if($key == "news_id_th"){
									
									$new_data_th['news_id'] = $data_input['news_id_th'];

							}else if($key == "news_id"){
									
									$new_data['news_id2'] = $data_input['news_id'];
									$new_data_th['news_id2'] = $data_input['news_id'];

							}else if($key != "editorCurrent" && $key != "tag_id" && $key != "editorCurrent2" && $key != "editorh3" && $key != "editorh4" && $key != "highlight" && $key != "megamenu" && $key != "orderid" && $key != "'relate_id"){
									
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
			//Debug($data_input);
			//Debug($new_data);
			//die();
			/*$data_highlight = array(
					"news_id" => $data_input['news_id'],
					"ref_id" => 1,
					"order" => 0
			);*/

			//if(isset($data_input['highlight'])) Debug($data_input['highlight']);
			//$this->News_model->set_highlight($data_input['news_id'], $data_highlight);
			//die();

			if(!isset($new_data['dara_id'])){
				$new_data['dara_id'] = 0;				
			}
			
			//if($this->upload->client_name){
					//$new_data['picture_news'] = $this->upload->client_name;
			//}
			
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

			if(isset($data_input['pin_start_date'])){
				//list($date, $time, $time2) = explode(" ", $data_input['pin_start_date']);
				//if($time2 == "PM") $time = $time +12;
				$new_data['pin_start_date'] = DateTimeDB($data_input['pin_start_date']);
				$new_data_th['pin_start_date'] = $new_data['pin_start_date'];
			}

			if(isset($data_input['pin_expire_date'])){
				//list($date, $time, $time2) = explode(" ", $data_input['pin_expire_date']);
				//if($time2 == "PM") $time = $time +12;
				$new_data['pin_expire_date'] = DateTimeDB($data_input['pin_expire_date']);
				$new_data_th['pin_expire_date'] = $new_data['pin_expire_date'];
			}

			//$newcount = count($data_input);

			if(isset($data_input['news_id_en'])){
				$newcount = 2;
			}else
				$newcount = 1;
			//echo "newcount = $newcount<br>";
			//Debug($data_input);
			if(isset($data_input['icon_vdo'])){
					$new_data['icon_vdo'] = 1;
					$new_data_th['icon_vdo'] = 1;
			}else{
					$new_data['icon_vdo'] = 0;
					$new_data_th['icon_vdo'] = 0;
			}
			//Debug($new_data);
			//die();

			if(!isset($new_data['news_id'])){
					$new_data['news_id'] = $new_data['news_id2'];
			}

			//**************************************** Relate News ***************************************
			if($new_data['news_id2'] > 0){

					$number_of_relate = 4;
					$tag_relate = $this->News_model->get_relate($data_input['news_id']);
					//Debug($tag_relate);

					//if(count($tag_relate)<$number_of_relate){
					if(count($tag_relate) == 0){

							if($new_data['dara_id'] > 0) 
								$tag_relate = $this->News_model->gen_relate($new_data['dara_id'], $new_data['tag_id'], $new_data['news_id']);
							else 
								$tag_relate = $this->News_model->gen_relate(null, $new_data['tag_id'], $new_data['news_id']);

							//Debug($tag_relate);
							$where_newsid = array();
							if($tag_relate){

								$max5 = (count($tag_relate) > $number_of_relate) ? $number_of_relate : count($tag_relate);
								for($t=0;$t<$max5;$t++){

										$number = $t+1;
										$tag_relate[$t]->news_id;
										//echo "<hr>".$number." ".$tag_relate[$t]->news_id."<hr>";
										if($tag_relate[$t]->news_id != $new_data['news_id']){
											$where_newsid[$t]['news_id'] = $tag_relate[$t]->news_id;
											$where_newsid[$t]['ref_id'] = $new_data['news_id'];
											$where_newsid[$t]['order'] = $number;
										}

								}
							}
							if(count($where_newsid) > 0) $this->News_model->save_relate($new_data['news_id'], $where_newsid);
					}
					unset($new_data['relate_id']);
					unset($new_data_th['relate_id']);

					unset($new_data['orderid']);
					unset($new_data_th['orderid']);
			}
			//Debug($where_newsid);
			//die();
			/*Debug($data_input);
			Debug($new_data);
			Debug($new_data_th);*/

			$autotags = false;
			//**************************************** ใส่ Tags ใน Content editor ***************************************
			if(($new_data['news_id2'] == 0) || ($autotags == true)){
				if($tags_all){
					$number_tag = count($tags_all);
					$counttag = 0;
					for($i=0;$i<$number_tag;$i++){

							$textnormal = $tags_all[$i]->tag_text;
							$dara_type_id = $tags_all[$i]->dara_type_id;
							$dara_profile_id = $tags_all[$i]->dara_profile_id;
							$dara_type_name = $tags_all[$i]->dara_type_name;
									
							$url = $this->config->config['www'].'/dara/'.$dara_type_id.'/'.$dara_profile_id.'/'.RewriteTitle($dara_type_name).'/'.RewriteTitle($textnormal);

							$text_replace = '<a href="'.$url.'" target=_blank>'.$textnormal.'</a>';

							//echo "<hr>$textnormal<br>";
							//echo "preg_match($textnormal, new_data_th['detail']) == ".preg_match("/$textnormal/i", $new_data_th['detail'])."<br>";
							//Eng
							if(preg_match("/$textnormal/i", $new_data['detail'])){
											/*$tags_arr[$counttag]['text'] = $textnormal;
											$tags_arr[$counttag]['dara_type_id'] = $dara_type_id;
											$tags_arr[$counttag]['dara_profile_id'] = $dara_profile_id;
											$tags_arr[$counttag]['dara_type_name'] = $dara_type_name;
											$tags_arr[$counttag]['url'] = $url;*/
									$new_data['detail'] = str_replace($textnormal, $text_replace, $new_data['detail']);
									$counttag++;
							}

							if(preg_match("/$textnormal/i", $new_data['description'])){
									$new_data['description'] = str_replace($textnormal, $text_replace, $new_data['description']);
									$counttag++;
							}

							//Thai
							if(preg_match("/$textnormal/i", $new_data_th['detail'])){
									$new_data_th['detail'] = str_replace($textnormal, $text_replace, $new_data_th['detail']);
									$counttag++;
							}
							if(preg_match("/$textnormal/i", $new_data_th['description'])){
									$new_data_th['description'] = str_replace($textnormal, $text_replace, $new_data_th['description']);
									$counttag++;
							}
					}
				}
			} //Add tags

			//echo "<hr>counttag = $counttag";
			//Debug($tags_arr);
			//Debug($tags_arr2);
			//die();
			//*********************************************************

			unset($new_data['tag_id']);
			unset($new_data_th['tag_id']);
			//die();

			//Debug($new_data['news_id']);

			if((isset($new_data['news_id'])) && ($new_data['news_id'] > 0)){
						
						$new_data['lastupdate_by'] = $this->session->userdata('admin_id');
						$new_data_th['lastupdate_by'] = $this->session->userdata('admin_id');

						$new_data['lastupdate_date'] = $now_date;
						$new_data_th['lastupdate_date'] = $now_date;
						
						$new_id = $new_data['news_id2'];
						$action = 2;

						//Debug($new_data);

						if($newcount > 1) $this->News_model->store($new_data['news_id'], $new_data);

						$this->News_model->store($new_data_th['news_id'], $new_data_th);

						/*$data = array(
								"admin_menu" => $this->menufactory->getMenu(),
								"ListSelect" => $ListSelect,
								"news_list" => $this->News_model->get_news(null, null, $language['lang']),
								"content_view" => 'news/news',
								"breadcrumb" => $breadcrumb,
								"success" =>  'Save News complete.'
						);*/

			}else{ //Insert

						//Debug($new_data);
						//Debug($new_data_th);

						$new_data['create_date'] = $now_date;
						$new_data['create_by'] = $this->session->userdata('admin_id');
						$new_data['order_by'] = 1;

						$new_data_th['create_date'] = $now_date;
						$new_data_th['create_by'] = $this->session->userdata('admin_id');
						$new_data_th['order_by'] = 1;
						$action = 1;

						//Debug($data_input['tag_id']);
						//Debug($new_data);
						//die();

						$max_id = $this->News_model->get_max_id();
						//Debug($max_id);
						$new_id = $max_id[0]['max_id'] + 1;

						//echo "new_id = $new_id";
						//die();
						
						$new_data['news_id'] = $new_id;
						$new_data['news_id2'] = $new_id;
						$new_data_th['news_id2'] = $new_id;

						//Debug($new_data);
						//Debug($new_data_th);
						//die();

						//Add 1 all record
						$this->News_model->update_orderadd($new_data['category_id']);

						$this->News_model->store(0, $new_data);
						$this->News_model->store(0, $new_data_th);

						/*$data = array(
								"admin_menu" => $this->menufactory->getMenu(),
								"ListSelect" => $ListSelect,
								"news_list" => $this->News_model->get_news(null, null, $language['lang']),
								"content_view" => 'news/news',
								"breadcrumb" => $breadcrumb,
								"success" =>  'Save News complete.'
						);*/
			}
			/***************************tags*************************************/
			if(count($tag_id) < 3){
					$get_tag_dara = $this->Tags_model->get_tag_pair($new_data['dara_id'], 5);
					//Debug($get_tag_dara);
					$clear = 1;

					if($get_tag_dara){
							for($i=0;$i<count($get_tag_dara);$i++){
										$tag_pair[$i]["tag_id"] = $get_tag_dara[$i]->tag_id;
										$tag_pair[$i]["ref_id"] = $new_id;
										$tag_pair[$i]["ref_type"] = 1;
										$tag_pair[$i]["create_date"] = $now_date;
										$next = $i;
							}
					}			
					//Insert tags
					//Debug($tag_id);
					if($tag_id){
							if(!isset($next)) $next = 0;
							$begin = $next + 1;
							$endtag = count($tag_id) + $begin;
							$t = 0;
							for($i=$begin;$i<$endtag;$i++){
										
										$tag_pair[$i]["tag_id"] = $tag_id[$t];
										$tag_pair[$i]["ref_id"] = $new_id;
										$tag_pair[$i]["ref_type"] = 1;
										$tag_pair[$i]["create_date"] = $now_date;
										$t++;
							}
							//Debug($tag_pair);					
							$this->Tags_model->store_tag_pair($tag_pair, $clear);
					}
			}
			//die();

			//**************Set Highlight
			if(isset($data_input['highlight'])){

				//Debug($data_input['highlight']);
				$data_highlight = array(
						"news_id" => $new_id,
						"ref_type" => 1,
						"order" => 0
				);							
				$this->News_model->set_highlight($new_id, $data_highlight);
				$this->News_model->update_order_highlight();
				//echo "new_id = $new_id";
				//die();
			}else{
				$this->News_model->remove_highlight($new_id);
				//echo "new_id = $new_id";
			}

			//**************Set Megamenu
			if(isset($data_input['megamenu'])){

				//Debug($data_input['highlight']);
				$data_megamenu = array(
						"id" => $new_id,
						"category_id" => $new_data['category_id'],
						"ref_type" => 1,
						"order" => 0
				);							
				$this->News_model->set_megamenu($new_id, $data_megamenu);
				//echo "new_id = $new_id";
				//die();
			}else{
				$this->News_model->remove_megamenu($new_id);
				//echo "new_id = $new_id";
			}

			//**************Log activity
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $new_id,
								"ref_type" => 1,
								"ref_title" => $new_data_th['title'],
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			if($upload_status == "Success"){

						$picture_obj['ref_id'] = $new_id;
						$picture_obj['ref_type'] = 1;
						$picture_obj['file_name'] = $this->upload->client_name;
						//$picture_obj['title'] = StripTxt($data_input['title']);

						if($language['lang'] == 'en')
							$picture_obj['caption'] = StripTxt($data_input['title_en']);
						else
							$picture_obj['caption'] = StripTxt($data_input['title_th']);

						$picture_obj['folder'] = $folder;
						$picture_obj['create_date'] = $now_date;
						$picture_obj['create_by'] = $this->session->userdata('admin_id');
						$picture_obj['status'] = 1;
						$this->Picture_model->store(0, $picture_obj);

			}

			//$data['category_list'] = $this->Category_model->getSelectCat();
			//$totalnews = $this->News_model->countnews(0, 0);
			//$curpage = base_url('news?view=list');

			$data = array(
								"admin_menu" => $this->menufactory->getMenu(),
								"ListSelect" => $ListSelect,
								//"GenPage" => GenPage($curpage, 1, $list_page, $totalnews),
								//"news_list" => $this->News_model->get_news(null, null, $language['lang']),
								//"category_list" => $this->Category_model->getSelectCat(),
								"content_view" => 'news/news',
								"breadcrumb" => $breadcrumb,
								"success" =>  'Save News complete.'
			);

			$success =  'Save complete.';
			//die();
			//$this->load->view('template/template',$data);
			unset($data_input);
			unset($new_data);
			unset($new_data_th);

			//redirect(base_url('news?category_id='.$new_data['category_id'].'&success='.urlencode($success)));
			redirect(base_url('news/edit/'.$new_id.'?success='.urlencode($success)));
	}

	public function set_order_relate(){
					
					$lang = $this->lang->language;
					
					$newsid = $this->input->post('newsid');
					$json = $this->input->post('json');

					$obj = json_decode($json);
					$update_data = array();

					//echo "newsid = $newsid<br>";
					//Debug($obj);
					$num = 1;
					if($obj)
						for($i = 0; $i< count($obj);$i++){
								//echo $num.'.) '.$obj[$i]->id.' : '.$newsid.' ==> '.$num.'<br>';
								unset($update_data);
								$update_data['order'] = $num;
								$this->News_model->set_order_relate($newsid, $obj[$i]->id, $update_data);
								$num++;
						}
					echo $lang['update'].' '.$lang['success'].'.';
	}

	public function set_order_picture(){
					
					$lang = $this->lang->language;
					
					$newsid = $this->input->post('newsid');
					$json = $this->input->post('json');

					$obj = json_decode($json);
					$update_data = array();

					//Debug($this->input->post());
					//echo "newsid = $newsid<br>";
					//Debug($obj);
					//die();

					$num = 1;
					if($obj)
						for($i = 0; $i< count($obj);$i++){
								//echo $num.'.) '.$obj[$i]->id.' : '.$newsid.' ==> '.$num.'<br>';
								unset($update_data);
								$update_data['order'] = $num;
								$this->News_model->set_order_picture($newsid, $obj[$i]->id, $update_data);
								$num++;
						}
					echo $lang['update'].' '.$lang['success'].'.';
	}

	public function gen_json($id){

				//http://daraapi.siamsport.co.th/api/rest.php?method=DetailNews&key=5AckEziE&lang=th&news_id=39&gen_file=1

				$newsid_th = $this->Api_model->news('th', $id);
				$newsid_en = $this->Api_model->news('en', $id);

				//$newsid_th = JsonContent($newsid_th);
				//$newsid_en = JsonContent($newsid_en);

				//Debug($newsid_th);
				//Debug($newsid_en);

				if(!is_dir('json/www/news')) mkdir('json/www/news', 0777);

				SaveJSON($newsid_th, $id.'_th', 0, 'www/news/');
				SaveJSON($newsid_en, $id.'_en', 0, 'www/news/');
				//echo "Finish";
				//redirect('json/index');
	}

	public function set_default($id = 0){
			echo "Set default... $id";

			//$data_input = $this->input->post();
			$data_input = $this->input->get();

			//Debug($data_input);

			$id = $data_input['id'];
			$ref_id = $data_input['ref_id'];
			//die();
			
			$OBJnews = $this->News_model->get_news($ref_id);
			//Debug($OBJnews);

			$news_id = $OBJnews[0]['news_id2'];
			$title = "Set default picture ".$OBJnews[0]['title'];
			$order_by = $OBJnews[0]['order_by'];

			$this->News_model->set_default($id, $ref_id);

			//**************Log activity
			$action = 2;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $ref_id,
								"ref_type" => 1,
								"ref_title" => $title,
								"action" => $action
			);
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			//redirect('news/picture/'.$this->uri->segment(3));
			redirect('news/picture/'.$ref_id);
			die();
	}	

	public function delete($id, $cat){
			echo "Deleting... $id";
			
			$OBJnews = $this->News_model->get_news($id);
			$title = $OBJnews[0]['title'];
			$order_by = $OBJnews[0]['order_by'];

			$this->News_model->delete_news($id);

			//**************Order New
			$this->News_model->update_orderdel($cat, $order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 1,
								"ref_title" => $title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('news');
			die();
	}

	public function delrelate($id){
			
			//$this->load->model('Tags_model');
			echo "Deleting... $id";
			
			$OBJnews = $this->News_model->get_news($id);
			$title = $OBJnews[0]['title'];
			$this->News_model->delete_relate_news($id);
			//$this->Tags_model->delete_tag_pair($id, 1);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 1,
								"ref_title" => "Delete relate news ".$title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity
			$stop = $this->input->get('stop');
			if($stop == 1) die();
			redirect('news/edit/'.$id);
			die();
	}

	public function DelRelateID(){

			$data_input = $this->input->post();
			$newid = $data_input['newid'];
			$id = $data_input['id'];
			$title = $data_input['name'];
			//echo "Deleting... $id";
			$this->News_model->delete_relate_news(0, $id);

			$action = 3;
			$log_activity = array(
					"admin_id" => $this->session->userdata('admin_id'),
					"ref_id" => $newid,
					"ref_type" => 1,
					"ref_title" => "Delete relate news id: ".$id." ".$title,
					"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);

			die();
	}

	public function saveorder(){
			
			$language = $this->lang->language['lang'];

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();
					//Debug($search_form);
					//die();
					$data['order'] = $search_form['orderid'];
					$newsid = $search_form['news_id'];

					$getobj = $this->News_model->get_status($newsid, $language);
					//Debug($getobj);

					if(isset($search_form['relate_id'])){
							//if(count($search_form['relate_id']) < 5){

									$relate_id = $search_form['relate_id'];
									$orderid = $search_form['orderid'];
									$i = 1; 

									//Debug($relate_id);

									foreach($relate_id as $arr => $val){
											$this->News_model->update_order_relate($search_form['relate_id'][$arr], $newsid, $search_form['orderid'][$arr]);
											$i++;
									}

									/**************Log activity *********/
									$log_activity = array(
														"admin_id" => $this->session->userdata('admin_id'),
														"ref_id" => $newsid,
														"ref_type" => 1,
														"ref_title" => $getobj[0]['title']." [Order By]",
														"action" => 2
									);			
									$this->Admin_log_activity_model->store($log_activity);
									/**************Log activity**********/

									//$success =  'Save Order complete.';
									redirect(base_url('news/edit').'/'.$newsid);
									die();
							//}
					}
			}

	}	

	function hotnews_save(){

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$data_form = $this->input->post();
					Debug($data_form);
					die();

			}
	}
	
	function auto_order($cat = 0){
				
				$language = $this->lang->language;
				$cat_view = array();

				if($cat != 0) $cat_view['category_id'] = $cat;
				$news_list = $this->News_model->get_news(null, null, $language['lang'], $cat_view);
				//Debug($news_list);
				if(isset($news_list)){
						for($i=0;$i<count($news_list);$i++){
									$number = $i + 1;
									$idnews = $news_list[$i]['news_id2'];
									$title = $news_list[$i]['title'];
									$order_by = $news_list[$i]['order_by'];
									$data = array(
											"order_by" => $number
									);
									echo "$idnews $title  [$order_by ==> $number]<br>";
									$this->News_model->store2($idnews, $data);
						}
						echo "<hr>UPDATE Order cat = $cat  total = ".count($news_list)." record.";
				}
	}
	
	public function import(){
			
			$data = array();
			$insert = false;
			$display = false;

			if($this->input->get('number'))
				$number = $this->input->get('number');
			else
				$number = 20;

			if($this->input->get('insert')) $insert = $this->input->get('insert');
			if($this->input->get('display')) $display = $this->input->get('display');

			//Debug($this->input->get());

			$news_list = $this->News_model->import(1, $number);

			if($display == true) Debug($news_list);
			//die();
			$Zone1 = $Zone2 = $Zone3 = $Zone4 = $Zone5 = $Zone6 = $Zone7 = $Zone8 = $Zone9 = $Zone10 = 0;

			if(isset($news_list)){
				if($news_list['header']['code'] == 200){
					$all = count($news_list['body']);
					//echo "ALL = $allvdo <br>";
					
					for($i=0;$i<$all;$i++){

								$IDNews = $news_list['body'][$i]['IDNews'];
								$FileName = StripTxt($news_list['body'][$i]['FileName']);
								$FkIDZone = $news_list['body'][$i]['FkIDZone'];
								$FkIDColum = $news_list['body'][$i]['FkIDColum'];
								$FkIDDara = $news_list['body'][$i]['FkIDDara'];
								$Topic = $news_list['body'][$i]['Topic'];
								$Topicshort = $news_list['body'][$i]['Topicshort'];
								$Detail = $news_list['body'][$i]['Detail'];
								$Pic0 = $news_list['body'][$i]['Pic0'];
								$DetailPic1 = $news_list['body'][$i]['DetailPic1'];
								$DateCreate = $news_list['body'][$i]['DateCreate'];
								$TimeCreate = $news_list['body'][$i]['TimeCreate'];
								$FkIDUser = $news_list['body'][$i]['FkIDUser'];
								$CountClick = $news_list['body'][$i]['CountClick'];
								$Sex = $news_list['body'][$i]['sex'];
								$IDNewsRelate = $news_list['body'][$i]['IDNewsRelate'];

								$picture = 'http://www.Tmon.com/Picture_Dara/'.$Pic0;
								//$picture1 = 'http://www.Tmon.com/Picture_Dara/'.$Pic1;
								//$picture2 = 'http://www.Tmon.com/Picture_Dara/'.$Pic2;
								//$picture3 = 'http://www.Tmon.com/Picture_Dara/'.$Pic3;

								if($FkIDZone == "001")	$Zone1++;
								if($FkIDZone == "002")	$Zone2++;
								if($FkIDZone == "003")	$Zone3++;
								if($FkIDZone == "004")	$Zone4++;
								if($FkIDZone == "005")	$Zone5++;
								if($FkIDZone == "006")	$Zone6++;
								if($FkIDZone == "007")	$Zone7++;
								if($FkIDZone == "008")	$Zone8++;
								if($FkIDZone == "009")	$Zone9++;
								if($FkIDZone == "010")	$Zone10++;

								/*switch($FkIDZone){	
										case 1 : $FkIDDaraType = 1; break;
										case 2 : $FkIDDaraType = 3; break;
										case 3 : $FkIDDaraType = 5; break;
										case 4 : $FkIDDaraType = 7; break;
										default : $FkIDDaraType = 9; break;
								}*/

								switch($Sex){	
										case 1 : $Sex = 'm'; break;
										default : $Sex = 'f'; break;
								}

								//list($first_name, $last_name) = explode(" ", $Fullname);

								/*$data[$i]['iddara'] = $IDDara;
								$data[$i]['dara_type_id'] = $FkIDDaraType;
								$data[$i]['first_name'] = $first_name;
								$data[$i]['last_name'] = $last_name;


								$data[$i]['avatar'] = $Pic0;

								$data[$i]['lang'] = 'en';*/
								//$data[$i]['order_by'] = $i+1;

								//Debug($data[$i]);

								//echo '<img src="'.$picture.'" border="0" alt=""><br>';
								//echo "<hr>";
					}
					//Debug($data);

					echo "ALL = $all<hr>";
					echo "Zone1 = $Zone1<br>";
					echo "Zone2 = $Zone2<br>";
					echo "Zone3 = $Zone3<br>";
					echo "Zone4 = $Zone4<br>";
					echo "Zone5 = $Zone5<br>";
					echo "Zone6 = $Zone6<br>";
					echo "Zone7 = $Zone7<br>";
					echo "Zone8 = $Zone8<br>";
					echo "Zone9 = $Zone9<br>";
					echo "Zone10 = $Zone10<br>";

					if($insert == true)
						if($this->Dara_model->import_news_to_db($data)){
								echo "$i record Import Success.";
						}
				}
			}

	}

	public function json_zoonnews(){
			
			$data = array();
			$insert = false;
			$display = false;

			if($this->input->get('number'))
				$number = $this->input->get('number');
			else
				$number = 20;

			if($this->input->get('insert')) $insert = $this->input->get('insert');
			if($this->input->get('display')) $display = $this->input->get('display');

			//Debug($this->input->get());

			$news_list = $this->News_model->json_zoonnews(1, $number);

			if($display == true) Debug($news_list);
			//die();

			if(isset($news_list)){
				if($news_list['header']['code'] == 200){
					$all = count($news_list['body']);
					//echo "ALL = $allvdo <br>";				
					for($i=0;$i<$all;$i++){

								$IDZone = $news_list['body'][$i]['IDZone'];
								$ZoneX = StripTxt($news_list['body'][$i]['ZoneX']);
								$FolderX = $news_list['body'][$i]['FolderX'];
								$Keywords = $news_list['body'][$i]['Keywords'];

								echo "$IDZone , $ZoneX <br>";

								//list($first_name, $last_name) = explode(" ", $Fullname);

								/*$data[$i]['iddara'] = $IDDara;
								$data[$i]['dara_type_id'] = $FkIDDaraType;
								$data[$i]['first_name'] = $first_name;
								$data[$i]['last_name'] = $last_name;
								$data[$i]['lang'] = 'en';*/
								//$data[$i]['order_by'] = $i+1;

								//Debug($data[$i]);

								//echo '<img src="'.$picture.'" border="0" alt=""><br>';
								//echo "<hr>";
					}
					//Debug($data);


					if($insert == true)
						if($this->Dara_model->import_zoonnews_to_db($data)){
								echo "$i record Import Success.";
						}
				}
			}

	}

	private function set_watermark_options($client_name, $text = "Siamdara"){   

		$config = array();
		$folder = date('Ymd');
		
		$config['source_image'] = './uploads/news/'.$folder.'/'.$client_name;
		$config['new_image'] =  './uploads/news/'.$folder.'/sd_'.$client_name;
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
