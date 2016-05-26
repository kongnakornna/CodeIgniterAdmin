<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Api_model_na extends CI_Model {
    function __construct(){
        parent::__construct();
    }    

	function urlna($urlcerentrl,$lang){
		$admin = array();
		$this->db->where('url', '/'.$urlcerentrl);
        $this->db->where('lang',$lang);
		$tbl_admin_menu = $this->db->dbprefix('_admin_menu');
		$query = $this->db->get($tbl_admin_menu);
         $num_rows=$query->num_rows();
		 //echo $this->db->last_query();die();
         if($num_rows>0){
              foreach ($query->result_array() as $row){
					$admin['admin_menu_id'] = $row['admin_menu_id'];
					$admin['admin_menu_id2']=$row['admin_menu_id2'];
                    $admin['title']=$row['title'];
                    $admin['url']=$row['url'];
                    $admin['parent']=$row['parent'];
                    $admin['admin_menu_alt']=$row['admin_menu_alt'];
                    $admin['option']=$row['option'];
                    $admin['icon']=$row['icon'];
                    $admin['params']=$row['params'];
                    $admin['num_rows']=$num_rows;
                    }
                }else{
                     $admin['num_rows']=$num_rows;
                }
                return $admin;
	} 
    
    public function user_menu($type){	
    		$lang = $this->lang->language['lang'];
    		//debug( $lang);
    		//$admin_id = $this->session->userdata('admin_id');
			//$admin_type = $this->session->userdata('admin_type');
			$loadfile = "admintype".$type.".json";
			$list_data = $title = '';
			//if($type == 1) $loadfile = "superadmin.json";
			$admin_menu = LoadJSON($loadfile);
			$subadmin_menu = $admin_menu;			
			  //Debug($subadmin_menu);
			if($admin_menu){
				foreach($admin_menu as $arr => $list_mainmenu){
						$sub_mainparent = '';
						$havesub = 0;	
                       $admin_menu_id=$list_mainmenu['admin_menu_id'];				
						if($list_mainmenu){
							foreach($list_mainmenu as $field => $title){
									//echo "$field => $title<br>";
									if($field == "admin_type_id") $admin_type_id = $title;
									if($field == "admin_menu_id") $admin_menu_id2 = $title;
									if($field == "title_en") $title_en = $title;
									if($field == "title_th") $title_th = $title;
									if($field == "url") $url = $title;
									if($field == "icon") $icon = $title;
									if($field == "sub") $sub = $title;
									if($field == "parent") $mainparent = $title;					
									if($field == "option") $havesub = $title;						
							}
//Debug($admin_menu);
//die();	
$icon = ($icon !== '') ? $icon : ''.$icon ; 
if($mainparent == 0){
$title = ($lang == 'th') ? $title_th : $title_en;
       /*************Sub menu Active****************/
                            $urlcerentrl=$this->uri->segment(1);
                            $language= $this->lang->language;
                            $lang = $language['lang'];
                            $urlna=$this->uri->segment(1);
                            $urlna = $this->Api_model_na->urlna($urlna,$lang); 
                            $num_rowsna=(int)$urlna['num_rows'];
                            //Debug($urlna); Die();
        if($num_rowsna>0){
        $admin_menu_id2na=$urlna['admin_menu_id2'];
        $paramsna=$urlna['parent'];
        if(($admin_menu_id2 == $paramsna) && ((strtolower($this->uri->segment(1)) == $urlcerentrl)	)){ 
                                        $curactive = 'class="active open"';
                                        $submenu= 'class="class="sub-menu"';
									}else{
										$curactive = '';
										$submenu = '';
									}
            ////////// 
        }else{
            //////////////
            if(($admin_menu_id2 == 1) && ((strtolower($this->uri->segment(1)) == $urlcerentrl))){
                                        $curactive = 'class="active open"';
                                        $submenu= 'class="class="sub-menu"';
									}else{
										$curactive = '';
										$submenu = '';
									}
            //////////
        }
       /*************Sub menu Active****************/
									$chkurl = ltrim($url,"/");
									$classactive = '';
									if(strtolower($this->uri->segment(1)) == strtolower($chkurl)){
										$classactive = 'class="active"';
									}else $classactive = '';
									if($sub == 1)
											$list_data .= '<li '.$curactive.'>
												<a href="javascript:void(0)">
												 <i class="menu-icon fa '.$icon.'">
												 </i><span class="title">'.$title.'</span>
												 <i class="icon-arrow"></i><span class="selected"></span>
												</a>
												<b class="arrow"></b>
												<ul class="sub-menu"'.$submenu.'>';
									else
											$list_data .= '<li '.$classactive.'>
											<a href="'.base_url($url).'">
 											<i class="menu-icon fa '.$icon.'"></i>
 											<span class="title">'.$title.'</span><span class="selected"></span>
 											</a>
											<b class="arrow"></b>
											';

									//$list_data .= '<b class="arrow"></b>';
									//Debug($list_mainmenu);
									
							if($subadmin_menu){
								foreach($subadmin_menu as $subarr => $list_mainmenu2){
									//Debug($list_mainmenu2);
										foreach($list_mainmenu2 as $subfield => $subtitle){
											//echo "$subfield => $subtitle<br>";	
											if($subfield == "admin_type_id") $sub_admin_type_id = $subtitle;
											if($subfield == "admin_menu_id") $sub_admin_menu_id = $subtitle;
											if($subfield == "title_en") $sub_title_en = $subtitle;
											if($subfield == "title_th") $sub_title_th = $subtitle;
											if($subfield == "url") $sub_url = $subtitle;
											if($subfield == "icon") $sub_icon = $subtitle;
											if($subfield == "parent") $sub_mainparent = $subtitle;														//echo "($sub_mainparent == $admin_type_id)<br>";																												
								            }
													
													if($sub_mainparent == $admin_menu_id2){
													//if($sub_url == strtolower($this->uri->segment(1))){
													$havesub++;
													$active = '';
													$subtitle = ($lang == 'th') ? $sub_title_th : $sub_title_en;
													$chksub_url = str_replace("/", "", $sub_url);

														//Check Current
														//$classactive = (strtolower($this->uri->segment(1)) == strtolower($sub_title_en)) ? 'class="active"' : '';

														if(sizeof($this->uri->segments) > 1){
															$segment = strtolower($this->uri->segment(1)).'/'.strtolower($this->uri->segment(2));
															//$classactive = ($segment == $chksub_url) ? 'class="active"' : '';
															if(($segment == $chksub_url) || (strtolower($this->uri->segment(1)) == $chksub_url))
																	$classactive = 'class="active"';
															else
																	$classactive = '';
														}else
															$classactive = (strtolower($this->uri->segment(1)) == $chksub_url) ? 'class="active"' : '';

														//('.$segment.' == '.$chksub_url.')														
														$list_data .= '<li '.$classactive.'>
																		<a href="'.base_url($sub_url).'">
																			<i class="menu-icon fa fa-caret-right"></i>'.$subtitle.'  </a>
																			<b class="arrow"></b>
																	</li>';
													}
											}
											
										}//if($subadmin_menu)
											
									/*************Sub menu Active****************/
									if($sub == 1) $list_data .= '</ul>';
									/*************Sub menu Active****************/
									$list_data .= '</li>';
							}	
							//echo "<hr>";						
						}											
				}
				//echo $list;
			}			
			
           // Debug($admin_menu);
    		return $list_data;
    }



    public function notification_birthday(){

			//$language = $this->lang->language['lang'];

			$datenow = date('-m-d');
			//$thismonth = '-'.date('m').'-';

			$this->db->select('dp.*');
			$this->db->from('_dara_profile as dp');

			if(isset($thismonth)) $this->db->like('birth_date', $thismonth, 'both');
			if(isset($datenow)) $this->db->like('birth_date', $datenow, 'before');

			//$this->db->where('birth_date >=', $datenow);

	    	$query = $this->db->get();
	    	//Debug($this->db->last_query());
	    	return $query->result_object();    	
    }

    public function notification_msg($mod = 'news', $count = 1){

			//$language = $this->lang->language['lang'];
			$language = 'th';

			if($count == 1) 
				$this->db->select('count(*) as count_approve');
			else
				$this->db->select('*');

			if($mod == 'news'){
					$this->db->from('_news');
			}else if($mod == 'column'){
					$this->db->from('_column');
			}else if($mod == 'gallery'){
					$this->db->from('_gallery');
			}else if($mod == 'vdo'){
					$this->db->from('_video');
			}else if($mod == 'dara'){
					$this->db->from('_dara_profile');
			}
			$this->db->where('status', 1);
			$this->db->where('approve', 0);

			if($mod != 'dara'){
				$this->db->where('lang', $language);
				$this->db->where('create_date >', '2015-01-01');
			}

	    	$query = $this->db->get();
	    	//if($mod == 'vdo') Debug($this->db->last_query());
	    	return $query->result_object();    	
    }
	
    public function get_picture($ref_id, $picid = 0, $ref_type = 1 ){

	    	$language = $this->lang->language['lang'];
			
			if($ref_type == 1){
				$this->db->select('p.*, n.title, n.create_date');
				//$this->db->select('no.picture, no.folder_img');
			}else
				$this->db->select('p.*');

	    	$this->db->from('_picture p');

			if($ref_type == 1){
				$this->db->join('_news n', 'n.news_id2 = p.ref_id and n.lang = "'.$language.'"', 'left');
				//$this->db->join('_news_old no', 'no.news_id2 = p.ref_id', 'left');

				/*$this->db->select('*');
				$this->db->from('_news_old');
				$this->db->where('idzone =', $idzone);
				$this->db->order_by('news_id', 'ASC');*/
			}

	    	$this->db->where('ref_id', $ref_id);
	    	$this->db->where('ref_type', $ref_type);
	    	//$this->db->where('status', $pic_status);
	    	
	    	if($picid != 0) $this->db->where('picture_id', $picid);

			//if($lang != '') $this->db->where('_news.lang', $language);

	    	$this->db->order_by('p.order', 'ASC');
	    	$this->db->order_by('p.create_date', 'DESC');
	    	
	    	$query = $this->db->get();
	    	//Debug($this->db->last_query());
	    	return $query->result_array();    	
    }

    public function load_pic_bk($ref_id){

				$this->db->select('*');
				$this->db->from('_news_old');
				$this->db->where('news_id', $ref_id);
				$query = $this->db->get();
				//Debug($this->db->last_query());
				return $query->result_array();    	
    }

    function del_order_highlight($order){
			$this->db->set('order', '`order`  - 1', FALSE); 
			$this->db->where('order >', $order);
			$this->db->update('_news_highlight');
	}

    function setorder_highlight($id = 0, $ref_type=1, $data, $showdebug = 0){

			if($id > 0){
					$this->db->where('news_id', $id);
					$this->db->where('ref_type', $ref_type);
					$this->db->update('_news_highlight', $data);
					if($showdebug == 1) Debug($this->db->last_query());
					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//Debug($this->db->last_query());
						return true;
					}else{
						return false;
					}
			}

	}

    public function Highlight($language, $list_number = 5, $displayfolder = 'headnews'){

        $response = array();
        $header = array();
        $result = array();
        $item = array();	
		/*$prefix = 'sd';*/

		/*$highlight_list1 = $this->get_highlight(1);
		$highlight_list2 = $this->get_highlight(2);
		$highlight_list3 = $this->get_highlight(3);
		$highlight_list4 = $this->get_highlight(4);

		$highlight_list = array_merge($highlight_list1, $highlight_list2, $highlight_list3, $highlight_list4);
		$new_highlight = array();

			if(isset($highlight_list)){
					$maxorder = count($highlight_list);
					for($i=0;$i<$maxorder;$i++){
							$number = $i+1;
							$order = ($highlight_list[$i]->order) - 1;
							$new_highlight[$order] = $highlight_list[$i];									
					}
			}*/


		$allhighlight_list = $this->get_news_highlight();

		//Debug($allhighlight_list);
		//echo "<br><br><br>";
		$new_highlight = array();

		if(isset($allhighlight_list)){
				$maxorder = count($allhighlight_list);
				for($i=0;$i<$maxorder;$i++){
						$number = $i+1;
						$get_highlight = $this->get_highlight($allhighlight_list[$i]->ref_type, $allhighlight_list[$i]->news_id);
						if(isset($get_highlight[0])) $new_highlight[$i] = $get_highlight[0];
				}
		}
		//echo "<hr>";
		//Debug($new_highlight);
		//die();

		$total_all = count($new_highlight);
		//Debug($new_highlight);        
        if($total_all > 0){
			    $i = $j = 0;

				for($i=0;$i<$total_all;$i++){
				//foreach($highlight_list as $i => $obj){

						if($j < $list_number){ 

								$number = $i + 1;
								$type = "";

								$highlight_id = $new_highlight[$i]->news_highlight_id;
								$news_id = $new_highlight[$i]->news_id;
								$ref_type = $new_highlight[$i]->ref_type;
								$order = $new_highlight[$i]->order;
								$title = StripTxt($new_highlight[$i]->title);

								$category_id = (isset($new_highlight[$i]->category_id)) ? $new_highlight[$i]->category_id : 0;
								$category_name = (isset($new_highlight[$i]->category_name)) ? $new_highlight[$i]->category_name : 0;
								$subcategory_id = (isset($new_highlight[$i]->subcategory_id)) ? $new_highlight[$i]->subcategory_id : 0;
								$subcategory_name = (isset($new_highlight[$i]->subcategory_name)) ? $new_highlight[$i]->subcategory_name : 0;

								$lastupdate_date = $new_highlight[$i]->lastupdate_date;
								$create_date = $new_highlight[$i]->create_date;
								$countview = $new_highlight[$i]->countview;
								$file_name = $new_highlight[$i]->file_name;
								$folder = $new_highlight[$i]->folder;

								$type = (isset($new_highlight[$i]->type)) ? $new_highlight[$i]->type : "Gallery";
								//if($type == "") $new_highlight[$i]->type = "Gallery";

								if(!isset($category_id)) $category_id  = 0;
								if(!isset($category_name)) $category_name  = "";

								/*switch($new_highlight[$i]->type){
											case "News" : $pathpic = base_url("uploads/news/".$folder."/".$file_name); break;
											case "Column" : $pathpic = base_url("uploads/column/".$folder."/".$file_name); break;
											case "Gallery" : $pathpic = base_url("uploads/gallery/".$folder."/".$file_name); break;
											case "Clip" : $pathpic = base_url("uploads/vdo/".$folder."/".$file_name); break;
								}*/
								
								//$pathpic = base_url("uploads/highlight/".$folder."/".$file_name); 
								$pathpic = $this->config->config['static'].'/'.$displayfolder.'/'.$folder.'/'.$file_name;

								$new_highlight[$i]->picture = $pathpic;

								if($category_id == 0){
									if($ref_type == 3) $category_id = 19;
									if($ref_type == 4) $category_id = 5;
								}
								if($category_name == ""){
									if($ref_type == 3) $category_name = 'แกเลอรี่';
									if($ref_type == 4) $category_name = 'คลิปวิดีโอ';
								}

								$item[$j]['highlight_id'] = intval($highlight_id);
								$item[$j]['id'] = intval($news_id);
								$item[$j]['ref_type'] = intval($ref_type);
								$item[$j]['category_id'] = intval($category_id);
								$item[$j]['category_name'] = $category_name;
								$item[$j]['subcategory_id'] = intval($subcategory_id);
								$item[$j]['subcategory_name'] = $subcategory_name;
								$item[$j]['title'] = $title;
								//$item[$j]['description'] = $row->description;
								$item[$j]['lastupdate_date'] = $lastupdate_date;
								$item[$j]['file_name'] = $file_name;
								$item[$j]['folder'] = $folder;
								$item[$j]['order'] = intval($order);
								$item[$j]['type'] = strtolower($type);
								$item[$j]['picture'] = $pathpic;
								$j++;

								//echo "<hr>($list_number == $j)<hr>";
								if($list_number == $j){ 
									unset($obj); 
									unset($new_highlight); 
								}
						}

			}
        
            $header['resultcode'] = 200;
            $header['message'] = "success";
            $header['total_rows'] = $j;

            
        } else {
            $header['resultcode'] = 204;
            $header['message'] = "success";
        }
		//Debug($response);
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;

        return json_encode($response);
	}

    function get_news_highlight($listpage = 15, $debug = 0){

				$this->db->select('*');
				$this->db->from('_news_highlight');
				$this->db->order_by('order', 'Asc');
				$this->db->limit($listpage, 0);
				$query = $this->db->get();
				if($debug == 1) Debug($this->db->last_query());
				return $query->result_object();    	
    }

    function get_highlight($ref_type = 0, $id = 0,  $debug = 0){

			$language = $this->lang->language['lang'];
			$prefix = 'sd';
			$listpage = 10;
			$limit_start = 0;

			$this->db->select('_news_highlight.order, _news_highlight.news_highlight_id, 
			_news_highlight.news_id, _news_highlight.ref_type, _picture.file_name, _picture.folder,
			dd.create_date as folder_news ,dd.create_date, dd.lastupdate_date, dd.status, dd.approve');

			switch(intval($ref_type)){
					case 1: 
						$this->db->select('dd.title, dd.countview, dd.category_id, _category.category_name, _category.type');
						$this->db->select('dd.subcategory_id, sub.subcategory_name');
						//$this->db->select('_news.title, _news.create_date as folder_news ,_news.create_date, _news.lastupdate_date, _news.countview');
					break;
					case 2:
						$this->db->select('dd.title, dd.countview, dd.category_id, _category.category_name, _category.type');
						$this->db->select('dd.subcategory_id, sub.subcategory_name');
						//$this->db->select('_column.title, _column.create_date as folder_news ,_column.create_date, _column.lastupdate_date, _column.countview');
					break;
					case 3:
						$this->db->select('dd.title, dd.countview, dd.gallery_type_id as subcategory_id, _gallery_type.gallery_type_name as subcategory_name');
						//$this->db->select('_gallery.title, _gallery.create_date as folder_news ,_gallery.create_date, _gallery.lastupdate_date, _gallery.countview');
					break;
					case 4:
						$this->db->select('dd.title_name as title, dd.countclick as countview, dd.category_id, _category.category_name, _category.type');
						$this->db->select('dd.subcategory_id, sub.subcategory_name');
						//$this->db->select('_video.title_name, _video.create_date as folder_news ,_video.create_date, _video.lastupdate_date, _video.countview');
					break;

			}

			$this->db->from('_news_highlight');

			switch(intval($ref_type)){
					case 1: 
						if($id > 0)
							$this->db->join('_news dd', '_news_highlight.news_id = dd.news_id2 and '.$prefix.'_news_highlight.ref_type = 1 and dd.news_id2 = '.$id); 
						else
							$this->db->join('_news dd', '_news_highlight.news_id = dd.news_id2 and '.$prefix.'_news_highlight.ref_type = 1'); 

						$this->db->join('_category', 'dd.category_id = _category.category_id_map and '.$prefix.'_category.lang = "'.$language.'"', 'left');
						$this->db->join('_subcategory sub', 'dd.subcategory_id = sub.subcategory_id_map and sub.lang = "'.$language.'"', 'left');
					break;
					case 2: 
						if($id > 0)
							$this->db->join('_column dd', '_news_highlight.news_id = dd.column_id2 and '.$prefix.'_news_highlight.ref_type = 2 and dd.column_id2 = '.$id); 
						else
							$this->db->join('_column dd', '_news_highlight.news_id = dd.column_id2 and '.$prefix.'_news_highlight.ref_type = 2'); 

						$this->db->join('_category', 'dd.category_id = _category.category_id_map and '.$prefix.'_category.lang = "'.$language.'"', 'left');
						$this->db->join('_subcategory sub', 'dd.subcategory_id = sub.subcategory_id_map and sub.lang = "'.$language.'"', 'left');
					break;
					case 3: 
						if($id > 0)
							$this->db->join('_gallery dd', '_news_highlight.news_id = dd.gallery_id2 and '.$prefix.'_news_highlight.ref_type = 3 and dd.gallery_id2 = '.$id); 
						else
							$this->db->join('_gallery dd', '_news_highlight.news_id = dd.gallery_id2 and '.$prefix.'_news_highlight.ref_type = 3'); 

						$this->db->join('_gallery_type', 'dd.gallery_type_id = _gallery_type.gallery_type_id2 and '.$prefix.'_gallery_type.lang = "'.$language.'"', 'left');
					break;
					case 4: 
						if($id > 0)
							$this->db->join('_video dd', '_news_highlight.news_id = dd.video_id2 and '.$prefix.'_news_highlight.ref_type = 4 and dd.video_id2 = '.$id); 
						else
							$this->db->join('_video dd', '_news_highlight.news_id = dd.video_id2 and '.$prefix.'_news_highlight.ref_type = 4'); 

						$this->db->join('_category', 'dd.category_id = _category.category_id_map and '.$prefix.'_category.lang = "'.$language.'"', 'left');
						$this->db->join('_subcategory sub', 'dd.subcategory_id = sub.subcategory_id_map and sub.lang = "'.$language.'"', 'left');
					break;
			}

			$this->db->join('_picture', '_news_highlight.news_id = _picture.ref_id and '.$prefix.'_picture.ref_type = '.$prefix.'_news_highlight.ref_type AND '.$prefix.'_picture.`default`=1 ', 'left');

			//if($id > 0) $this->db->where('_news.news_id', $id);
			//if($ref_type != 0) $this->db->where('_news_highlight.ref_type', $ref_type);

			//$this->db->where('dd.lang', $language);
			$this->db->where('dd.lang', 'th');
			$this->db->where('dd.status', 1);
			$this->db->where('dd.approve', 1);

			$this->db->order_by('_news_highlight.order', 'Asc');
			$this->db->limit($listpage, $limit_start);

			$query = $this->db->get();
			if($debug == 1) Debug($this->db->last_query());
			return $query->result_object();
	}

    public function navigation($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();	

        $sql = "web_menu_id2 as nav_id, title, url, parent, order_by";
        
        $this->db->select($sql);
        $this->db->from('_homepage_menu');
        $this->db->where('status',1);
        $this->db->where('lang',$language);
        $this->db->order_by('parent',"asc");
        $this->db->order_by('order_by',"asc");
        $rs = $this->db->get()->result();
		//Debug($this->db->last_query());

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            $i=0;
            foreach($rs as $key => $row){
                $item[$i]['nav_id'] = $row->nav_id;
                $item[$i]['title'] = $row->title;
                $item[$i]['url'] = $row->url;
                $item[$i]['parent'] = $row->parent;
                $item[$i]['sort'] = $row->order_by;
                $i++;
            }
        
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
        
        return json_encode($response);

	}

    public function dara($language = 'th'){
		
		$this->load->model('tags_model');

        $response = array();
        $header = array();
        $result = array();
        $item = array();	

		$prefix = 'sd';

        //$sql = "_dara_profile.*, _dara_type.dara_type_id_map, _dara_type.dara_type_name";
        $sql = "dp.*, dt.dara_type_name, bt.belong_to";
       
        $this->db->select($sql);
		$this->db->from('_dara_profile as dp');
		//$this->db->join('_dara_type', '_dara_profile.dara_type_id = _dara_type.dara_type_id_map AND `'.$prefix.'_dara_type`.lang = "'.$language.'" ', 'left');
		$this->db->join('_dara_type as dt', '(dp.dara_type_id = dt.dara_type_id_map AND dt.lang="'.$language.'"',  'left');
		$this->db->join('_belong_to as bt', '(dp.belong_to_id=bt.belong_to_id', 'left');

        $this->db->where('dp.status',1);
        //$this->db->where('lang',$language);

        $this->db->order_by('nick_name',"asc");

        $rs = $this->db->get()->result();
		//Debug($this->db->last_query());
		//Debug($rs);

		//echo "get_tag_pair(".$rs[0]->dara_profile_id.", 5)";

		
		//Debug($sel_tags);

		//die();

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            $i=0;
            foreach($rs as $key => $row){
                $item[$i]['dara_profile_id'] = $row->dara_profile_id;
                $item[$i]['dara_type_id'] = $row->dara_type_id;
                $item[$i]['belong_to_id'] = $row->belong_to_id;
                $item[$i]['nick_name'] = $row->nick_name;
                $item[$i]['first_name'] = $row->first_name;
                $item[$i]['middle_name'] = $row->middle_name;
                $item[$i]['last_name'] = $row->last_name;
                $item[$i]['pen_name'] = $row->pen_name;
                $item[$i]['avatar'] = $row->avatar;
                $item[$i]['gender'] = $row->gender;
                $item[$i]['birth_date'] = $row->birth_date;
                $item[$i]['dara_type_name'] = $row->dara_type_name;
                $item[$i]['belong_to'] = $row->belong_to;

				$sel_tags = $this->tags_model->get_tag_pair($rs[$i]->dara_profile_id, 5);
                $item[$i]['tags'] = $sel_tags;
                $i++;
            }

			/*for($i=0;$i<count($rs);$i++){
					$item[$i] = $rs[$i];
			}*/
			
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }

        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
        
        return json_encode($response);

	}

    public function category($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();	

        $sql = "category_id_map as category_id, category_name, order_by, status";
        
        $this->db->select($sql);
        $this->db->from('_category');
        $this->db->where('status',1);
        $this->db->where('lang',$language);
        $this->db->order_by('order_by',"asc");
        $rs = $this->db->get()->result();
		//Debug($this->db->last_query());

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            /*$i=0;
            foreach($rs as $key => $row){
                $item[$i]['category_id'] = $row->category_id;
                $item[$i]['category_id'] = $row->category_id;
                $item[$i]['title'] = $row->title;
                $item[$i]['url'] = $row->url;
                $item[$i]['parent'] = $row->parent;
                $item[$i]['sort'] = $row->order_by;
                $i++;
            }*/

			for($i=0;$i<count($rs);$i++){
					$item[$i] = $rs[$i];
			}
		
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
		//Debug($response);
		//die();
        
        return json_encode($response);
	}

    public function subcategory($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();	

        $sql = "subcategory_id_map as subcategory_id, subcategory_name, category_id, order_by, status";
        
        $this->db->select($sql);
        $this->db->from('_subcategory');
        $this->db->where('status',1);
        $this->db->where('lang',$language);
        $this->db->order_by('order_by',"asc");
        $rs = $this->db->get()->result();
		//Debug($this->db->last_query());

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            /*$i=0;
            foreach($rs as $key => $row){
                $item[$i]['category_id'] = $row->category_id;
                $item[$i]['category_id'] = $row->category_id;
                $item[$i]['title'] = $row->title;
                $item[$i]['url'] = $row->url;
                $item[$i]['parent'] = $row->parent;
                $item[$i]['sort'] = $row->order_by;
                $i++;
            }*/

			for($i=0;$i<count($rs);$i++){
					$item[$i] = $rs[$i];
			}
		
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
		//Debug($response);
		//die();
        
        return json_encode($response);
	}

    public function news($language, $id = null){

		$this->load->model('news_model');

        $response = array();
        $header = array();
        $result = array();
        $item = array();
        $tags = $tags_arr = $pic_arr = array();

		$prefix = 'sd';

		if($id > 0){
		        $sql = "_news.news_id2 as news_id, _news.title, _news.description, _news.start_date, _news.expire_date, _category.category_name, _subcategory.subcategory_name";
		}else{
		        $sql = "_news.news_id2 as news_id, _news.title, _news.description, _news.start_date, _news.expire_date, _category.category_name, _subcategory.subcategory_name, _dara_profile.first_name, _dara_profile.last_name, _dara_profile.nick_name, _dara_profile.avatar";
		}
        
        $this->db->select($sql);
        $this->db->from('_news');

		$this->db->join('_category', '_news.category_id = _category.category_id_map AND `'.$prefix.'_category`.lang = "'.$language.'" ', 'left');
		$this->db->join('_subcategory', '_news.subcategory_id = _subcategory.subcategory_id_map AND `'.$prefix.'_subcategory`.lang = "'.$language.'" ', 'left');

		if(!$id) $this->db->join('_dara_profile', '_news.dara_id = _dara_profile.dara_profile_id', 'left');

        $this->db->where('_news.status',1);
        $this->db->where('_news.lang',$language);

		if($id){
			$this->db->where('_news.news_id2', $id);		
		}

        $this->db->order_by('_news.create_date',"DESC");
        $rs = $this->db->get()->result();

		//Debug($this->db->last_query());
		//die();
		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
			for($i=0;$i<count($rs);$i++){

					$item[$i] = $rs[$i];

					//--------------- Picture--------------------
					unset($this->db);
					$this->db->select('*');
					$this->db->from('_picture');
					$this->db->where('ref_id', $rs[$i]->news_id);
					$this->db->where('ref_type', 1);
					$this->db->where('status', 1);
					$rs_pic = $this->db->get()->result();
					$item[$i]->picture = $rs_pic;

					//--------------- Tags--------------------
					$this->db->select('_tag.tag_id, tag_text');
					$this->db->from('_tag');
					$this->db->join('_tag_pair', '_tag.tag_id = _tag_pair.tag_id AND `'.$prefix.'_tag`.status = 1 ', 'left');
					$this->db->where('_tag_pair.ref_id', $rs[$i]->news_id);
					$this->db->where('_tag_pair.ref_type', 1);
					$rs_tag = $this->db->get()->result();
					$item[$i]->tags = $rs_tag;

					//--------------- Relate--------------------
					$rs_relate = $this->news_model->get_relate($rs[$i]->news_id);				
					$item[$i]->relates = $rs_relate;
					//--------------- End--------------------
			}
			//Debug($item);
			//die();

            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
        
        return json_encode($response);

	}

    public function column($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();
        $tags = $tags_arr = $pic_arr = array();

		$prefix = 'sd';

        $sql = "_column.*, _category.category_name, _subcategory.subcategory_name, _dara_profile.first_name, _dara_profile.last_name, _dara_profile.nick_name, _dara_profile.avatar";
        
        $this->db->select($sql);
        $this->db->from('_column');

		$this->db->join('_category', '_column.category_id = _category.category_id_map AND `'.$prefix.'_category`.lang = "'.$language.'" ', 'left');
		$this->db->join('_subcategory', '_column.subcategory_id = _subcategory.subcategory_id_map AND `'.$prefix.'_subcategory`.lang = "'.$language.'" ', 'left');
		$this->db->join('_dara_profile', '_column.dara_id = _dara_profile.dara_profile_id', 'left');

        $this->db->where('_column.status',1);
        $this->db->where('_column.lang',$language);

        $this->db->order_by('_column.create_date',"DESC");
        $rs = $this->db->get()->result();

		//echo "<br>".$this->db->last_query();
		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
			for($i=0;$i<count($rs);$i++){

					$item[$i] = $rs[$i];

					//--------------- Picture--------------------
					unset($this->db);
					$this->db->select('*');
					$this->db->from('_picture');
					$this->db->where('ref_id', $rs[$i]->column_id2);
					$this->db->where('ref_type', 2);
					$this->db->where('status', 1);

					$rs_pic = $this->db->get()->result();

					$item[$i]->picture = $rs_pic;

					//--------------- Tags--------------------
					$this->db->select('_tag.tag_id, tag_text');
					$this->db->from('_tag');
					$this->db->join('_tag_pair', '_tag.tag_id = _tag_pair.tag_id AND `'.$prefix.'_tag`.status = 1 ', 'left');

					$this->db->where('_tag_pair.ref_id', $rs[$i]->column_id2);
					$this->db->where('_tag_pair.ref_type', 2);
					$rs_tag = $this->db->get()->result();

					$item[$i]->tags = $rs_tag;

					//--------------- End--------------------
			}
        
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
        
        return json_encode($response);

	}

    public function gallery($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();
        $tags = $tags_arr = $pic_arr = array();

		$prefix = 'sd';

        //$sql = "_gallery.*, _category.category_name, _subcategory.subcategory_name, _dara_profile.first_name, _dara_profile.last_name, _dara_profile.nick_name, _dara_profile.avatar";
        $sql = "_gallery.*, _gallery_type.gallery_type_name , _dara_profile.first_name, _dara_profile.last_name, _dara_profile.nick_name, _dara_profile.avatar";
        
        $this->db->select($sql);
        $this->db->from('_gallery');

		$this->db->join('_gallery_type', '_gallery.gallery_type_id = _gallery_type.gallery_type_id2 AND `'.$prefix.'_gallery_type`.lang = "'.$language.'" ', 'left');
		$this->db->join('_dara_profile', '_gallery.dara_id = _dara_profile.dara_profile_id', 'left');

        $this->db->where('_gallery.status',1);
        $this->db->where('_gallery.lang',$language);

        $this->db->order_by('_gallery.create_date',"DESC");
        $rs = $this->db->get()->result();

		//echo "<br>".$this->db->last_query();
		//die();
		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
			for($i=0;$i<count($rs);$i++){

					$item[$i] = $rs[$i];

					//--------------- Picture--------------------
					unset($this->db);
					$this->db->select('*');
					$this->db->from('_picture');
					$this->db->where('ref_id', $rs[$i]->gallery_id2);
					$this->db->where('ref_type', 3);
					$this->db->where('status', 1);

					$rs_pic = $this->db->get()->result();

					$item[$i]->picture = $rs_pic;

					//--------------- Tags--------------------
					$this->db->select('_tag.tag_id, tag_text');
					$this->db->from('_tag');
					$this->db->join('_tag_pair', '_tag.tag_id = _tag_pair.tag_id AND `'.$prefix.'_tag`.status = 1 ', 'left');

					$this->db->where('_tag_pair.ref_id', $rs[$i]->gallery_id2);
					$this->db->where('_tag_pair.ref_type', 3);
					$rs_tag = $this->db->get()->result();

					$item[$i]->tags = $rs_tag;

					//--------------- End--------------------

			}
        
            $header['resultcode'] = "200";
            $header['message'] = "success";
            $header['total_rows'] = $i;
            
        } else {
            $header['resultcode'] = "204";
            $header['message'] = "success";
        }
        
        $result['item'] = $item;        
        $response['header'] = $header;
        $response['body'] = $result;
        //debug($response);
		//die();
        return json_encode($response);

	}

}