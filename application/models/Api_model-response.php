<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    function __construct(){
        parent::__construct();
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
							$icon = ($admin_menu_id2 == 28) ? $icon : 'fa '.$icon ;
							
							if($mainparent == 0){

									//$icon_menu = ($row->_icon != '') ? $row->_icon : 'fa-file-text';
									$title = ($lang == 'th') ? $title_th : $title_en;
									
									/*************Sub menu Active****************/
									if(($admin_menu_id2 == 2) && ((strtolower($this->uri->segment(1)) == 'uploadfile')
										|| (strtolower($this->uri->segment(1)) == 'dara_type') || (strtolower($this->uri->segment(1)) == 'dara')	
										|| (strtolower($this->uri->segment(1)) == 'category') || (strtolower($this->uri->segment(1)) == 'subcategory')
										|| (strtolower($this->uri->segment(1)) == 'emergency') || (strtolower($this->uri->segment(1)) == 'tags')
										|| (strtolower($this->uri->segment(1)) == 'columnist') || (strtolower($this->uri->segment(1)) == 'credit') 
										|| (strtolower($this->uri->segment(1)) == 'channel') || (strtolower($this->uri->segment(1)) == 'belong_to') )){
											$curactive = 'class="hsub open"';
											$submenu = 'style="display:block;"';

									}else if(($admin_menu_id2 == 27) && ((strtolower($this->uri->segment(1)) == 'admin_menu'))){

										$curactive = 'class="hsub open"';
										$submenu = 'style="display:block;"';

									}else if(($admin_menu_id2 == 28) && ((strtolower($this->uri->segment(1)) == 'json'))){

										$curactive = 'class="hsub open"';
										$submenu = 'style="display:block;"';

									}else if(($admin_menu_id2 == 41) && ((strtolower($this->uri->segment(1)) == 'homepage_menu') || (strtolower($this->uri->segment(1)) == 'programtv')
									|| (strtolower($this->uri->segment(1)) == 'order')	)){

									/*if($sub == 1 && strtolower($this->uri->segment(1)) == $url){*/

										$curactive = 'class="hsub open"';
										$submenu = 'style="display:block;"';

									}else{
										$curactive = '';
										$submenu = '';
									}
									/*************Sub menu Active****************/

									$chkurl = ltrim($url,"/");
									$classactive = '';

									if(strtolower($this->uri->segment(1)) == strtolower($chkurl)){
											$classactive = 'class="active"';
									}else $classactive = '';

									if($sub == 1)
											$list_data .= '<li '.$curactive.'>
												<a href="#" class="dropdown-toggle">
														<i class="menu-icon '.$icon.'"></i><span class="menu-text">'.$title.'</span>
														<b class="arrow fa fa-angle-down"></b>
												</a>
												<b class="arrow"></b>
												<ul class="submenu" '.$submenu.'>';
									else
											$list_data .= '<li '.$classactive.'>
													<a href="'.base_url($url).'">
													<i class="menu-icon '.$icon.'"></i><span class="menu-text">'.$title.'</span></a>
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
															if($subfield == "parent") $sub_mainparent = $subtitle;														
															//echo "($sub_mainparent == $admin_type_id)<br>";																												
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
									if($admin_menu_id2 == 2 || $admin_menu_id2 == 27 || $admin_menu_id2 == 28 || $admin_menu_id2 == 41) $list_data .= '</ul>';
									/*************Sub menu Active****************/
									$list_data .= '</li>';
							}	
							//echo "<hr>";						
						}											
				}
				//echo $list;
			}			
			//Debug($admin_menu);
    		return $list_data;
    }

    public function notification_birthday(){

			$language = $this->lang->language['lang'];
			//$all = $this->lang->language['all'];

			$thismonth = date('m');

			$this->db->select('dp.*');
			$this->db->from('_dara_profile as dp');
			//$this->db->like('birth_date', $thismonth, 'before');
			$this->db->like('birth_date', $thismonth, 'both');
	    	$query = $this->db->get();
	    	//Debug($this->db->last_query());
	    	return $query->result_object();    	
    }
    
    public function get_picture($ref_id, $picid = 0, $ref_type = 1 ){

	    	$this->db->select('*');
	    	$this->db->from('_picture');
	    	$this->db->where('ref_id', $ref_id);
	    	$this->db->where('ref_type', $ref_type);
	    	//$this->db->where('status', $pic_status);
	    	
	    	if($picid != 0) $this->db->where('picture_id', $picid);

	    	$this->db->order_by('order', 'ASC');
	    	$this->db->order_by('create_date', 'DESC');
	    	
	    	$query = $this->db->get();
	    	//Debug($this->db->last_query());
	    	return $query->result_array();    	
    }

    public function Highlight($language){

        $response = array();
        $header = array();
        $result = array();
        $item = array();	
		$prefix = 'sd';

        $sql = "_news_highlight.news_highlight_id, _news_highlight.order, _news.news_id2, _news.title, _news.description, _category.category_name, _news.create_date as folder_news ,_news.create_date, _news.lastupdate_date, _news.countview, _picture.file_name, _picture.folder";
        
        $this->db->select($sql);
        $this->db->from('_news_highlight');
		$this->db->join('_news', '_news_highlight.news_id = _news.news_id2');
		$this->db->join('_category', '_news.category_id = _category.category_id_map and '.$prefix.'_category.lang = "'.$language.'"', 'left');
		$this->db->join('_picture', '_news_highlight.news_id = _picture.ref_id and '.$prefix.'_picture.ref_type = 1 AND '.$prefix.'_picture.`default`=1 ', 'left');

        $this->db->where('_news_highlight.ref_id',1);
        $this->db->where('_news.status',1);
        $this->db->where('_news.approve',1);
        $this->db->where('_news.lang',$language);
        $this->db->order_by('_news_highlight.order', 'Asc');

        $rs = $this->db->get()->result();
		//Debug($this->db->last_query());

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            $i=0;
            foreach($rs as $key => $row){
                $item[$i]['news_highlight_id'] = $row->news_highlight_id;
                $item[$i]['news_id'] = $row->news_id2;
                $item[$i]['category_name'] = $row->category_name;
                $item[$i]['title'] = $row->title;
                $item[$i]['description'] = $row->description;
                $item[$i]['lastupdate_date'] = $row->lastupdate_date;
                $item[$i]['file_name'] = $row->file_name;
                $item[$i]['folder'] = $row->folder;
                $item[$i]['sort'] = $row->order;
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        
        return json_encode($response);
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        
        return json_encode($response);

	}

    public function dara($language = 'th'){

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

		$total_all = $this->db->count_all_results();
        
        if($total_all > 0){
            $i=0;
            foreach($rs as $key => $row){
                $item[$i]['dara_profile_id'] = $row->dara_profile_id;
                $item[$i]['dara_type_id'] = $row->dara_type_id;
                $item[$i]['nick_name'] = $row->nick_name;
                $item[$i]['first_name'] = $row->first_name;
                $item[$i]['last_name'] = $row->last_name;
                $item[$i]['avatar'] = $row->avatar;
                $item[$i]['gender'] = $row->gender;
                $item[$i]['birth_date'] = $row->birth_date;
                $item[$i]['dara_type_name'] = $row->dara_type_name;
                $item[$i]['belong_to'] = $row->belong_to;
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        
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
        $response['response']['header'] = $header;
        $response['response']['result'] = $result;
        //debug($response);
		//die();
        return json_encode($response);

	}

}