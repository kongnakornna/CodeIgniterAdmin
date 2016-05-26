<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

    public function __construct()    {
			parent::__construct();
			$language = $this->lang->language;	
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
            $this->load->model('Member_type_model');
            $this->load->model('Status_type_model');
			$this->load->model('Member_model');
			$this->load->helpers('img');
			
			##load healper Config
			$setting = GetConfig1();
			$object = json_decode(json_encode($setting), TRUE);
			#Debug($object);
			$systemname_crna=$object['systemname'];
			$description_crna=$object['description'];
			$address_crna=$object['address'];
			$registerno_crna=$object['registerno'];
			$author_crna=$object['author'];
			$phone_crna=$object['phone'];
			$adminemail_crna=$object['admin_email'];
			$mobile_crna=$object['mobile'];
			$countries_crna=$object['countries'];
			$geography_crna=$object['geography'];
			$province_crna=$object['province'];
			$amphur_crna=$object['amphur'];
			$district_crna=$object['district'];
			$moo_crna=$object['moo'];
			//$facebook_crna=$object['facebook'];
			//$twitter_crna=$object['twitter'];
			//$google_crna=$object['google'];
			//$youtube_crna=$object['youtube'];
			//$instagram_crna=$object['instagram'];
			///////////////////
			
			$breadcrumb = array();
			if(!$this->session->userdata('is_logged_in')){
				redirect('admin/login');
			}
    }

	public function index(){
			$this->listview();  // Load function Listview
    }

	public function listview(){
	 		$language = $this->lang->language;	
            $this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
            $this->load->model('Member_type_model');
            $this->load->model('Status_type_model');
            $this->load->model('Memberstatus_model');
			$this->load->model('Member_model');
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$membercountall = $this->Member_model->get_count();
			$object = json_decode(json_encode($membercountall), TRUE);
			//$membercount_all=$object[0]['countid']; 
			$membercount_all='100';
			//Debug($membercountall);
			///////////////
			$countries_id = $geography_id = 0;
            $geography_id = $province_id = 0;
            $province_id = $amphur_id = 0;
            $amphur_id = $district_id = 0;
            $district_id = $village_id = 0; 
            $member_type = 1;
			//////
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			 ///////////////////////////////////
			$search_form = $this->input->post();
		    if(isset($search_form['countries_id'])){
		    $countries_idna = $search_form['countries_id'];
		    if($countries_idna>0){
			 $get_countries = $this->Countries_model->get_countries_by_id($countries_idna);
			//Debug($get_countries);
			$object = json_decode(json_encode($get_countries), TRUE);
            $countriesname=$object[0]['countries_name'];
            $breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].$countriesname.'</a>';		
			 }
			}
			if(isset($search_form['geography_id'])){  
			$geoidna = $search_form['geography_id'];     
			if($geoidna>0){
			$get_geography = $this->Geography_model->get_geography_by_id($geoidna);
			//Debug($get_geography);
			$object = json_decode(json_encode($get_geography), TRUE);
            $geoname=$object[0]['geo_name'];
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].$geoname.'</a>';
			 }   
            }
            if(isset($search_form['province_id_map'])){
            $provinceidna = $search_form['province_id_map'];
              if($provinceidna>0){
            $get_province = $this->Province_model->get_province_by_id($provinceidna,$language);
			//Debug($get_province);
			$object = json_decode(json_encode($get_province), TRUE);
            $provincename=$object[0]['province_name'];
            $breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].$provincename.'</a>'; 
            	
			  }
            }
            if(isset($search_form['amphur_id_map'])){ 
			$amphuridna = $search_form['amphur_id_map'];
			 if($amphuridna>0){
			$get_amphur = $this->Amphur_model->get_amphur_by_id($amphuridna,$language);
			//Debug($get_amphur);
			$object = json_decode(json_encode($get_amphur), TRUE);
            $amphurname=$object[0]['amphur_name']; 
             $breadcrumb[] = $amphurname; 	
			  }
            }
            if(isset($search_form['district_id_map'])){ 
			$districtidna = $search_form['district_id_map']; 
			 if($districtidna>0){
			$get_district = $this->District_model->get_district_by_id($districtidna,$language);
			//Debug($get_district);
			$object = json_decode(json_encode($get_district), TRUE);
            $districtname=$object[0]['district_name']; 
            $breadcrumb[] = $districtname;	
			  }
            }
           ///////////////////////////////////////////////////////////////////////  
			$breadcrumb[] = $language['member'];
			$search_form = $this->input->post();

			if(isset($search_form)){

				//Debug($search_form);
				//if(isset($search_form["p"])){ $p = $search_form["p"]; }else $p = 0;

				if(isset($search_form['list_page'])) $list_page = trim($search_form['list_page']); else $list_page = $membercount_all; //แสดงผลหน้าละกี่หัวข้อ  ค่าเริ่มต้น
				if(isset($search_form['p'])) $p = trim($search_form['p']); else $p = 0;

				if($p == 0){
						$p=1;
						$startpage = 0;
				}else{
						$startpage=(($p-1)*$list_page);
				}
############# countries_id
					if(isset($search_form['countries_id'])){ 
						$countries_id = $search_form['countries_id'];
						if(isset($search_form['countries_id'])){ 
							$countries_id = $search_form['countries_id']; 
						}else $countries_id = 209;
					}else{
						unset($search_form['countries_id']);
						$countries_id = 0;
					}
#############  geography_id
					if(isset($search_form['countries_id'])){ 
						$countries_id = $search_form['countries_id'];
						if(isset($search_form['geography_id'])){ 
							$geography_id = $search_form['geography_id']; 
						}else $geography_id = 0;
					}else{
						unset($search_form['geography_id']);
						$countries_id = 0;
					}
############# province_id
					if(isset($search_form['geography_id'])){ 
						$geography_id = $search_form['geography_id'];
						if(isset($search_form['province_id_map'])){ 
							$province_id= $search_form['province_id_map']; 
						}else $province_id = 0;
					}else{
						unset($search_form['province_id']);
						$geography_id = 0;
					}
############# amphur_id
					if(isset($search_form['province_id_map'])){ 
						$province_id = $search_form['province_id_map'];
						if(isset($search_form['amphur_id_map'])){ 
							$amphur_id= $search_form['amphur_id_map']; 
						}else $amphur_id = 0;
					}else{
						unset($search_form['amphur_id_map']);
						$province_id = 0;
					}
############# district_id
					if(isset($search_form['amphur_id_map'])){ 
						$amphur_id = $search_form['amphur_id_map'];
						if(isset($search_form['district_id_map'])){ 
							$district_id= $search_form['district_id_map']; 
						}else $district_id = 0;
					}else{
						unset($search_form['district_id_map']);
						$amphur_id = 0;
					}
############# village_id
					if(isset($search_form['district_id_map'])){ 
						$district_id = $search_form['district_id_map'];
						if(isset($search_form['village_id_map'])){ 
							$village_id= $search_form['village_id_map']; 
						}else $village_id = 0;
					}else{
						unset($search_form['village_id_map']);
						$district_id = 0;
					}
//////////////////////////////
				if(isset($search_form['keyword'])) $keyword['keyword'] = trim($search_form['keyword']); else $keyword = null;

				$sortby = (isset($search_form['sortby'])) ? trim($search_form['sortby']) : null;
				$member_type = (isset($search_form['member_type'])) ? trim($search_form['member_type']) : null;
				$member_status = (isset($search_form['member-status'])) ? trim($search_form['member-status']) : null;
				$gender = (isset($search_form['gender'])) ? trim($search_form['gender']) : null;

				if($member_status == 0) $member_status = null;
				elseif($member_status == 3) $member_status = 0;
				 //Debug("(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status)");

				//echo "keyword=$keyword";

				$member_list = $this->Member_model->get_member_profile(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status, $startpage, $list_page);
				//$member_list = $this->Member_model->get_member_profile(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status, 0, 100);
			}else{
				$keyword = "member";
				$member_list = $this->Member_model->get_member_profile(null, null, null, '', 'lastupdate_date', 'asc', null, 0, $membercount_all);
			}
			
//start///$countries_id
					if(isset($search_form['countries_id'])){
							$countries_id = $search_form['countries_id'];
							$countries_list = $this->Countries_model->getSelectCountrie($countries_id, 'countries_id', 'Member');
							//Debug($countries_list);
					}else{
							$countries_list = $this->Countries_model->getSelectCountrie(NULL,NULL,NULL);
             				//Debug($countries_list);
            		}
//end ///$countries_id	
//start///$geography_id
					if(isset($search_form['geography_id'])){
							$geography_id = $search_form['geography_id'];
							$search_form['geography_id'] = $geography_id;
							$geography_list = $this->Geography_model->getSelectGeography($geography_id, 'geography_id', 'Member');
							 
							//Debug($geography_list);
					}else{
             				$geography_list = $this->Geography_model->getSelectGeography();
            				//Debug($geography_list);
            		}
//end ///$geography_id		
//start///$province_id
					if(isset($search_form['province_id_map'])){
							$province_id = $search_form['province_id_map'];
							$province_list = $this->Province_model->getSelectProvince($province_id, 'province_id_map', 'Member');
							 
							//Debug($province_list);
					}else{
							$province_list = $this->Province_model->getSelectProvince();
             				//Debug($province_list);
            		}
//end ///$province_id					
//start///$amphur_id
					if(isset($search_form['amphur_id_map'])){
							$amphur_id = $search_form['amphur_id_map'];
							$amphur_list = $this->Amphur_model->getSelectAmphur($amphur_id, 'amphur_id_map', 'Member');
							 
							//Debug($amphur_list);
					}else{
							$amphur_list = $this->Amphur_model->getSelectAmphur();
             				//Debug($amphur_list);
            		}
//end ///$amphur_id							
//start///$district_id
					if(isset($search_form['district_id_map'])){
							$district_id = $search_form['district_id_map'];
							$district_list = $this->District_model->getSelectdistrict($district_id, 'district_id_map', 'Member');
							 
							//Debug($district_list);
					}else{
							$district_list = $this->District_model->getSelectdistrict();
             				//Debug($district_list);
            		}
//end ///$district_id	
//start///$village_id
					if(isset($search_form['village_id_map'])){
							$village_id = $search_form['village_id_map'];
							$village_list = $this->Village_model->getSelectVillage($village_id, 'village_id_map', 'Member');
							 
							//Debug($village_list);
					}else{
							$village_list = $this->Village_model->getSelectVillage();
            				//Debug($village_list);
            		}
//end ///$village_id	
//start///$memberstatus
					if(isset($search_form['status'])){
							$memberstatus = $search_form['status'];
							$memberstatus = $this->Memberstatus_model->getSelectMemberstatus($status, 'status_type_id_map', 'Member');
							 
							//Debug($memberstatus);
					}else{
							 $memberstatus = $this->Memberstatus_model->getSelectMemberstatus();
          					 // Debug($memberstatus);
            		}
//end ///$memberstatus	
			//Debug($this->db->last_query());
			$member_all = $this->Member_model->get_count();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"countries_list" => $countries_list,
					"countries_id" => $countries_id,
					"geography_list" => $geography_list,
					"geography_id" => $geography_id,
					"province_list" => $province_list,
					"province_id" => $province_id,
					"amphur_list" => $amphur_list,
					"amphur_id" => $amphur_id,	
					"district_list" => $district_list,
					"district_id" => $district_id,
					"village_list" => $village_list,
					"village_id" => $village_id,
					"memberstatus" => $memberstatus,
					"ListSelect" => $ListSelect,
					"member_type" => $this->Member_type_model->get_member_type(),
					"member_list" => $member_list,
					"member_all" => $member_all[0]->countid,
					"search_form" => $search_form,
					"content_view" => 'member/member_listview',
					"breadcrumb" => $breadcrumb
			); 
            //Debug($data);
			$this->load->view('template/template',$data);
	}	

	public function gridview(){
		    $language = $this->lang->language;	
            $this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
            $this->load->model('Member_type_model');
            $this->load->model('Status_type_model');
            $this->load->model('Memberstatus_model');
			$this->load->model('Member_model');

			$membercountall = $this->Member_model->get_count();
			$object = json_decode(json_encode($membercountall), TRUE);
			//$membercount_all=$object[0]['countid']; 
			$membercount_all='100';
			//Debug($membercountall);
			///////////////
			$countries_id = $geography_id = 0;
            $geography_id = $province_id = 0;
            $province_id = $amphur_id = 0;
            $amphur_id = $district_id = 0;
            $district_id = $village_id = 0; 
            $member_type = 1;
			//////
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;
			 ///////////////////////////////////
			$search_form = $this->input->post();
		    if(isset($search_form['countries_id'])){
		    $countries_idna = $search_form['countries_id'];
		    if($countries_idna>0){
			 $get_countries = $this->Countries_model->get_countries_by_id($countries_idna);
			//Debug($get_countries);
			$object = json_decode(json_encode($get_countries), TRUE);
            $countriesname=$object[0]['countries_name'];
            $breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].$countriesname.'</a>';		
			 }
			}
			if(isset($search_form['geography_id'])){  
			$geoidna = $search_form['geography_id'];     
			if($geoidna>0){
			$get_geography = $this->Geography_model->get_geography_by_id($geoidna);
			//Debug($get_geography);
			$object = json_decode(json_encode($get_geography), TRUE);
            $geoname=$object[0]['geo_name'];
            $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].$geoname.'</a>';
			 }   
            }
            if(isset($search_form['province_id_map'])){
            $provinceidna = $search_form['province_id_map'];
              if($provinceidna>0){
            $get_province = $this->Province_model->get_province_by_id($provinceidna,$language);
			//Debug($get_province);
			$object = json_decode(json_encode($get_province), TRUE);
            $provincename=$object[0]['province_name'];
            $breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].$provincename.'</a>'; 
            	
			  }
            }
            if(isset($search_form['amphur_id_map'])){ 
			$amphuridna = $search_form['amphur_id_map'];
			 if($amphuridna>0){
			$get_amphur = $this->Amphur_model->get_amphur_by_id($amphuridna,$language);
			//Debug($get_amphur);
			$object = json_decode(json_encode($get_amphur), TRUE);
            $amphurname=$object[0]['amphur_name']; 
             $breadcrumb[] = $amphurname; 	
			  }
            }
            if(isset($search_form['district_id_map'])){ 
			$districtidna = $search_form['district_id_map']; 
			 if($districtidna>0){
			$get_district = $this->District_model->get_district_by_id($districtidna,$language);
			//Debug($get_district);
			$object = json_decode(json_encode($get_district), TRUE);
            $districtname=$object[0]['district_name']; 
            $breadcrumb[] = $districtname;	
			  }
            }
           ///////////////////////////////////////////////////////////////////////  
			$breadcrumb[] = $language['member'];
			$search_form = $this->input->post();

			if(isset($search_form)){

				//Debug($search_form);
				//if(isset($search_form["p"])){ $p = $search_form["p"]; }else $p = 0;

				if(isset($search_form['list_page'])) $list_page = trim($search_form['list_page']); else $list_page = $membercount_all; //แสดงผลหน้าละกี่หัวข้อ  ค่าเริ่มต้น
				if(isset($search_form['p'])) $p = trim($search_form['p']); else $p = 0;

				if($p == 0){
						$p=1;
						$startpage = 0;
				}else{
						$startpage=(($p-1)*$list_page);
				}
############# countries_id
					if(isset($search_form['countries_id'])){ 
						$countries_id = $search_form['countries_id'];
						if(isset($search_form['countries_id'])){ 
							$countries_id = $search_form['countries_id']; 
						}else $countries_id = 209;
					}else{
						unset($search_form['countries_id']);
						$countries_id = 0;
					}
#############  geography_id
					if(isset($search_form['countries_id'])){ 
						$countries_id = $search_form['countries_id'];
						if(isset($search_form['geography_id'])){ 
							$geography_id = $search_form['geography_id']; 
						}else $geography_id = 0;
					}else{
						//unset($search_form['geography_id']);
						$countries_id = 0;
					}
############# province_id
					if(isset($search_form['geography_id'])){ 
						$geography_id = $search_form['geography_id'];
						if(isset($search_form['province_id_map'])){ 
							$province_id= $search_form['province_id_map']; 
						}else $province_id = 0;
					}else{
						unset($search_form['province_id']);
						$geography_id = 0;
					}
############# amphur_id
					if(isset($search_form['province_id_map'])){ 
						$province_id = $search_form['province_id_map'];
						if(isset($search_form['amphur_id_map'])){ 
							$amphur_id= $search_form['amphur_id_map']; 
						}else $amphur_id = 0;
					}else{
						unset($search_form['amphur_id_map']);
						$province_id = 0;
					}
############# district_id
					if(isset($search_form['amphur_id_map'])){ 
						$amphur_id = $search_form['amphur_id_map'];
						if(isset($search_form['district_id_map'])){ 
							$district_id= $search_form['district_id_map']; 
						}else $district_id = 0;
					}else{
						unset($search_form['district_id_map']);
						$amphur_id = 0;
					}
############# village_id
					if(isset($search_form['district_id_map'])){ 
						$district_id = $search_form['district_id_map'];
						if(isset($search_form['village_id_map'])){ 
							$village_id= $search_form['village_id_map']; 
						}else $village_id = 0;
					}else{
						unset($search_form['village_id_map']);
						$district_id = 0;
					}
//////////////////////////////
				if(isset($search_form['keyword'])) $keyword['keyword'] = trim($search_form['keyword']); else $keyword = null;

				$sortby = (isset($search_form['sortby'])) ? trim($search_form['sortby']) : null;
				$member_type = (isset($search_form['member_type'])) ? trim($search_form['member_type']) : null;
				$member_status = (isset($search_form['member-status'])) ? trim($search_form['member-status']) : null;
				$gender = (isset($search_form['gender'])) ? trim($search_form['gender']) : null;

				if($member_status == 0) $member_status = null;
				elseif($member_status == 3) $member_status = 0;
				 //Debug("(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status)");

				//echo "keyword=$keyword";

				$member_list = $this->Member_model->get_member_profile(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status, $startpage, $list_page);
				//$member_list = $this->Member_model->get_member_profile(null, $keyword, $member_type, $gender, $sortby, 'Asc', $member_status, 0, 100);
			}else{
				$keyword = "member";
				$member_list = $this->Member_model->get_member_profile(null, null, null, '', 'lastupdate_date', 'asc', null, 0, $membercount_all);
			}
			
//start///$countries_id
					if(isset($search_form['countries_id'])){
							$countries_id = $search_form['countries_id'];
							$countries_list = $this->Countries_model->getSelectCountrie($countries_id, 'countries_id', 'Member');
							//Debug($countries_list);
					}else{
							$countries_list = $this->Countries_model->getSelectCountrie();
             				//Debug($countries_list);
            		}
//end ///$countries_id	
//start///$geography_id
					if(isset($search_form['geography_id'])){
							$geography_id = $search_form['geography_id'];
							$search_form['geography_id'] = $geography_id;
							$geography_list = $this->Geography_model->getSelectGeography($geography_id, 'geography_id', 'Member');
							 
							//Debug($geography_list);
					}else{
             				$geography_list = $this->Geography_model->getSelectGeography();
            				//Debug($geography_list);
            		}
//end ///$geography_id		
//start///$province_id
					if(isset($search_form['province_id_map'])){
							$province_id = $search_form['province_id_map'];
							$province_list = $this->Province_model->getSelectProvince($province_id, 'province_id_map', 'Member');
							 
							//Debug($province_list);
					}else{
							$province_list = $this->Province_model->getSelectProvince();
             				//Debug($province_list);
            		}
//end ///$province_id					
//start///$amphur_id
					if(isset($search_form['amphur_id_map'])){
							$amphur_id = $search_form['amphur_id_map'];
							$amphur_list = $this->Amphur_model->getSelectAmphur($amphur_id, 'amphur_id_map', 'Member');
							 
							//Debug($amphur_list);
					}else{
							$amphur_list = $this->Amphur_model->getSelectAmphur();
             				//Debug($amphur_list);
            		}
//end ///$amphur_id							
//start///$district_id
					if(isset($search_form['district_id_map'])){
							$district_id = $search_form['district_id_map'];
							$district_list = $this->District_model->getSelectdistrict($district_id, 'district_id_map', 'Member');
							 
							//Debug($district_list);
					}else{
							$district_list = $this->District_model->getSelectdistrict();
             				//Debug($district_list);
            		}
//end ///$district_id	
//start///$village_id
					if(isset($search_form['village_id_map'])){
							$village_id = $search_form['village_id_map'];
							$village_list = $this->Village_model->getSelectVillage($village_id, 'village_id_map', 'Member');
							 
							//Debug($village_list);
					}else{
							$village_list = $this->Village_model->getSelectVillage();
            				//Debug($village_list);
            		}
//end ///$village_id	
//start///$memberstatus
					if(isset($search_form['status'])){
							$memberstatus = $search_form['status'];
							$memberstatus = $this->Status_type_model->getSelectMemberstatus($status, 'status_type_id_map', 'Member');
							 
							//Debug($memberstatus);
					}else{
							 $memberstatus = $this->Status_type_model->getSelectMemberstatus();
          					 // Debug($memberstatus);
            		}
//end ///$memberstatus	
			//Debug($this->db->last_query());
			$member_all = $this->Member_model->get_count();

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"countries_list" => $countries_list,
					"countries_id" => $countries_id,
					"geography_list" => $geography_list,
					"geography_id" => $geography_id,
					"province_list" => $province_list,
					"province_id" => $province_id,
					"amphur_list" => $amphur_list,
					"amphur_id" => $amphur_id,	
					"district_list" => $district_list,
					"district_id" => $district_id,
					"village_list" => $village_list,
					"village_id" => $village_id,
					"memberstatus" => $memberstatus,
					"ListSelect" => $ListSelect,
					"member_type" => $this->Member_type_model->get_member_type(),
					"member_list" => $member_list,
					"member_all" => $member_all[0]->countid,
					"search_form" => $search_form,
					"content_view" => 'member/member',
					"breadcrumb" => $breadcrumb
			); 
            //Debug($data);
			$this->load->view('template/template',$data);
	}

	public function search(){
			
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			if($this->input->server('REQUEST_METHOD') === 'GET'){

					$search_form = $this->input->get();
					if(isset($search_form['kw'])){
							
						$member_type_id = $member_profile_id = $member_type_name = $first_name = $nick_name = "";

						$keyw = explode(" ", $search_form['kw']);
						$member_list = $this->Member_model->get_member_profile(null, $keyw, null, null, 'lastupdate_date', 'Asc', null, 0, 20);
						//$member_list = $this->Member_model->get_member_profile(null, $keyw);
						//Debug($member_list);
						if($member_list){
								echo '<table id="sample-table-1" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>Pic</th>
													<th>Title</th>
													<th>'.$language['lastupdate'].'</th>
													<th>'.$language['status'].'</th>
													<th width="50%">URL</th>
												</tr>
											</thead>
											<tbody>';

								$maxlist = count($member_list);
								for($i=0;$i<$maxlist;$i++){
										
										$member_type_id = $member_list[$i]['member_type_id'];
										$member_profile_id = $member_list[$i]['member_profile_id'];
										$member_type_name = $member_list[$i]['member_type_name'];
										$first_name = $member_list[$i]['first_name'];
										$nick_name = $member_list[$i]['nick_name'];

										$url = $this->config->config['www'].'/member/'.$member_type_id.'/'.$member_profile_id.'/'.($member_type_name).'/'.($nick_name.'-'.$first_name).'';
										//$url = "http://www.siammember.com/member/".$member_list[$i]['member_profile_id'].".html";

										$img = base_url('uploads/thumb/member').'/'.$member_list[$i]['avatar'];
										//$img = 'uploads/thumb/'.$Member_list[$i]['folder'].'/'.$Member_list[$i]['file_name'];

										if($member_list[$i]['avatar'] != "")
											$tags_img = (file_exists('uploads/thumb/member/'.$member_list[$i]['avatar'])) ? "<img src=".$img." height='50'>" : "";
										else
											$tags_img = "";

										$status = ($member_list[$i]['status'] == 1) ? 'checked' : '';
										$iconstatus = '<div class="col-xs-3">
													<label>
														<input name="switch-field-1" class="ace ace-switch ace-switch-3" type="checkbox" '.$status.' disabled>
														<span class="lbl"></span>
													</label>
												</div>';
										$member_name = $member_list[$i]['nick_name']." ".$member_list[$i]['first_name']." ".$member_list[$i]['last_name'];
										$edit_data = base_url('member/edit/'.$member_profile_id);
										//member/edit/1357

										//echo "<li>".$Member_list[$i]['Member_id2'].". ".$Member_list[$i]['title']." ".$url."</li>";										
										//Debug($Member_list[$i]['title']);

										echo "<tr>
											<td>".$member_list[$i]['member_profile_id']."</td>
											<td>".$tags_img."</td>
											<td><a href='".$edit_data."' target=_blank>".$member_name."</a></td>
											<td>".$member_list[$i]['lastupdate_date']."</td>
											<td>".$iconstatus."</td>
											<td>".$url."</td>
										</tr>";										
								}						
								echo "</tbody></table>";
						}else
								echo "ไม่มีข้อมูล";
					}
					//die();
			}

	}

	public function chkname(){
			
			$language = $this->lang->language;
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));

			if($this->input->server('REQUEST_METHOD') === 'POST'){

					$search_form = $this->input->post();

					if(isset($search_form['first_name'])){
							//echo "is keyword";
							//Debug($search_form);
							$member_list = $this->Member_model->search_member_profile('first_name', $search_form['first_name']);
							//Debug($member_list);
							$name = '';
							
							$maxlist = count($member_list);
							for($i=0;$i<$maxlist;$i++){
									if($i == 0){
										echo "<ul>";
										echo "<li><b>รายชื่อที่มีอยู่แล้ว</b></li>";
									}
									$name = '['.$member_list[$i]->nick_name.'] '.$member_list[$i]->first_name.' '.$member_list[$i]->last_name;
									echo "<li>$name</li>";
							}
							if($name == '')
								echo "<li><b>สามารถเพิ่มรายชื่อนี้ได้ ยังไม่มีข้อมูล</b></li>";
							else 
								echo "</ul>";
					}

					if(isset($search_form['last_name'])){
							//echo "is keyword";
							//Debug($search_form);
							$member_list = $this->Member_model->search_member_profile('last_name', $search_form['last_name']);
							//Debug($member_list);
							$name = '';
							
							$maxlist = count($member_list);
							for($i=0;$i<$maxlist;$i++){
									if($i == 0){
										echo "<ul>";
										echo "<li><b>รายชื่อที่มีอยู่แล้ว</b></li>";
									}
									$name = '['.$member_list[$i]->nick_name.'] '.$member_list[$i]->first_name.' '.$member_list[$i]->last_name;
									echo "<li>$name</li>";
							}
							if($name == '')
								echo "<li><b>สามารถเพิ่มรายชื่อนี้ได้ ยังไม่มีข้อมูล</b></li>";
							else 
								echo "</ul>";
					}

					if(isset($search_form['nick'])){
							//echo "is keyword";
							$member_list = $this->Member_model->search_member_profile('nick_name', $search_form['nick']);
							//Debug($member_list);
							$name = '';
							$maxlist = count($member_list);
							for($i=0;$i<$maxlist;$i++){
									if($i == 0){
										echo "<ul>";
										echo "<li><b>รายชื่อที่มีอยู่แล้ว</b></li>";
									}
									$name = '['.$member_list[$i]->nick_name.'] '.$member_list[$i]->first_name.' '.$member_list[$i]->last_name;
									echo "<li>$name</li>";
							}
							if($name == '') 
								echo "<li><b>สามารถเพิ่มรายชื่อนี้ได้ ยังไม่มีข้อมูล</b></li>";
							else 
								echo "</ul>";
					}

					if(isset($search_form['pen_name'])){
							//echo "is keyword";
							$member_list = $this->Member_model->search_member_profile('pen_name', $search_form['pen_name']);
							//Debug($member_list);
							$name = '';
							$maxlist = count($member_list);
							for($i=0;$i<$maxlist;$i++){
									if($i == 0){
										echo "<ul>";
										echo "<li><b>รายชื่อที่มีอยู่แล้ว</b></li>";
									}
									$name = ''.$member_list[$i]->pen_name;
									echo "<li>$name</li>";
							}
							if($name == '') 
								echo "<li><b>สามารถเพิ่มรายชื่อนี้ได้ ยังไม่มีข้อมูล</b></li>";
							else 
								echo "</ul>";
					}
					//die();
			}

	}


	public function add(){
		    $this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
            $this->load->model('Member_type_model');
			$this->load->model('Belong_to_model');
			$this->load->helper('ckeditor');

////////////////////////////////////////
##load healper Config
			$setting = GetConfig1();
			$object = json_decode(json_encode($setting), TRUE);
			#Debug($object);
			$systemname_crna=$object['systemname'];
			$description_crna=$object['description'];
			$address_crna=$object['address'];
			$registerno_crna=$object['registerno'];
			$author_crna=$object['author'];
			$phone_crna=$object['phone'];
			$adminemail_crna=$object['admin_email'];
			$mobile_crna=$object['mobile'];
			$countries_crna=$object['countries'];
			$geography_crna=$object['geography'];
			$province_crna=$object['province'];
			$amphur_crna=$object['amphur'];
			$district_crna=$object['district'];
			$moo_crna=$object['moo'];
			$facebook_crna=$object['facebook'];
			$twitter_crna=$object['twitter'];
			$google_crna=$object['google'];
			$youtube_crna=$object['youtube'];
			$instagram_crna=$object['instagram'];
$add_form = $this->input->post();
############# countries_id
					if(isset($add_form['countries_id'])){ 
						$countries_id = $add_form['countries_id'];
						if(isset($add_form['countries_id'])){ 
							$countries_id = $add_form['countries_id']; 
						}else $countries_id = $countries_crna;
					}else{
						unset($add_form['countries_id']);
						$countries_id = $countries_crna;
					}
#############  geography_id
					if(isset($add_form['countries_id'])){ 
						$countries_id = $add_form['countries_id'];
						if(isset($add_form['geography_id'])){ 
							$geography_id = $add_form['geography_id']; 
						}else $geography_id = 0;
					}else{
						unset($add_form['geography_id']);
						$countries_id = 0;
					}
############# province_id
					if(isset($add_form['geography_id'])){ 
						$geography_id = $add_form['geography_id'];
						if(isset($add_form['province_id_map'])){ 
							$province_id= $add_form['province_id_map']; 
						}else $province_id = 0;
					}else{
						unset($add_form['province_id']);
						$geography_id = 0;
					}
############# amphur_id
					if(isset($add_form['province_id_map'])){ 
						$province_id = $add_form['province_id_map'];
						if(isset($add_form['amphur_id_map'])){ 
							$amphur_id= $add_form['amphur_id_map']; 
						}else $amphur_id = $amphur_crna;
					}else{
						unset($add_form['amphur_id_map']);
						$province_id = $amphur_crna;
					}
############# district_id
					if(isset($add_form['amphur_id_map'])){ 
						$amphur_id = $add_form['amphur_id_map'];
						if(isset($add_form['district_id_map'])){ 
							$district_id= $add_form['district_id_map']; 
						}else $district_id = $district_crna;
					}else{
						unset($add_form['district_id_map']);
						$amphur_id = $amphur_crna;
					}
############# village_id
					if(isset($add_form['district_id_map'])){ 
						$district_id = $add_form['district_id_map'];
						if(isset($add_form['village_id_map'])){ 
							$village_id= $add_form['village_id_map']; 
						}else $village_id = 0;
					}else{
						unset($add_form['village_id_map']);
						$district_id = $district_crna;
					}
//start///$countries_id
					if(isset($add_form['countries_id'])){
							$countries_id = $add_form['countries_id'];
							$countries_list = $this->Countries_model->getSelectCountrie($countries_id, 'countries_id', 'Member');
							//Debug($countries_list);
					}else{
						     $countries_list = $this->Countries_model->getSelectCountrie();
             				//Debug($countries_list);
            		}
//end ///$countries_id	
//start///$geography_id
					if(isset($add_form['geography_id'])){
							$geography_id = $add_form['geography_id'];
							$add_form['geography_id'] = $geography_id;
							$geography_list = $this->Geography_model->getSelectGeography($geography_id, 'geography_id', 'Member');
							 
							//Debug($geography_list);
					}else{
             				$geography_list = $this->Geography_model->getSelectGeography();
            				//Debug($geography_list);
            		}
//end ///$geography_id		
//start///$province_id
					if(isset($add_form['province_id_map'])){
							$province_id = $add_form['province_id_map'];
							$province_list = $this->Province_model->getSelectProvince($province_id, 'province_id_map', 'Member');
							 
							//Debug($province_list);
					}else{
							$province_list = $this->Province_model->getSelectProvince();
             				//Debug($province_list);
            		}
//end ///$province_id					
//start///$amphur_id
					if(isset($add_form['amphur_id_map'])){
							$amphur_id = $add_form['amphur_id_map'];
							$amphur_list = $this->Amphur_model->getSelectAmphur($amphur_id, 'amphur_id_map', 'Member');
							 
							//Debug($amphur_list);
					}else{
							$amphur_list = $this->Amphur_model->getSelectAmphur();
             				//Debug($amphur_list);
            		}
//end ///$amphur_id							
//start///$district_id
					if(isset($add_form['district_id_map'])){
							$district_id = $add_form['district_id_map'];
							$district_list = $this->District_model->getSelectdistrict($district_id, 'district_id_map', 'Member');
							 
							//Debug($district_list);
					}else{
							$district_list = $this->District_model->getSelectdistrict();
             				//Debug($district_list);
            		}
//end ///$district_id	
//start///$village_id
					if(isset($add_form['village_id_map'])){
							$village_id = $add_form['village_id_map'];
							$village_list = $this->Village_model->getSelectVillage($village_id, 'village_id_map', 'Member');
							 
							//Debug($village_list);
					}else{
							$village_list = $this->Village_model->getSelectVillage();
            				//Debug($village_list);
            		}
//end ///$village_id	
//start///$memberstatus
					if(isset($add_form['status'])){
							$memberstatus = $add_form['status'];
							$memberstatus = $this->Status_type_model->getSelectMemberstatus($status, 'status_type_id_map', 'Member');
							 
							//Debug($memberstatus);
					}else{
							 $memberstatus = $this->Status_type_model->getSelectMemberstatus();
          					 // Debug($memberstatus);
            		}
//end ///$memberstatus	
////////////////////////////////////////

			$Path_CKeditor = './plugins/ckeditor-integrated/ckeditor';
			$Path_CKfinder = './plugins/ckeditor-integrated/ckfinder';
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;
			$breadcrumb[] = '<a href="'.base_url('member').'">'.$language['member'].'</a>';
			$breadcrumb[] = $language['add'];
			 
			
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"countries_list" => $countries_list,
					"countries_id" => $countries_id,
					"geography_list" => $geography_list,
					"geography_id" => $geography_id,
					"province_list" => $province_list,
					"province_id" => $province_id,
					"amphur_list" => $amphur_list,
					"amphur_id" => $amphur_id,	
					"district_list" => $district_list,
					"district_id" => $district_id,
					"village_list" => $village_list,
					"memberstatus" => $memberstatus,
					"content_view" => 'member/member_add',
					"breadcrumb" => $breadcrumb
			);

			//Ckeditor's configuration
			$data['ckeditor'] = array(
				'id'     =>     'hobby',
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
			$data['ckeditor2'] = array(
				'id'     =>     'profile_background',
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
			$data['ckeditor3'] = array(
				'id'     =>     'portfolio',
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
			
			$this->load->view('template/template',$data);
	
	}

	public function edit($id = 0){
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Amphur_model');
			$this->load->model('District_model');
			$this->load->model('Village_model');
            $this->load->model('Member_type_model');
			$this->load->model('Tags_model');
			$this->load->model('Belong_to_model');
			//$this->load->model('default_model');
			$this->load->helper('ckeditor');

			$Path_CKeditor = './plugins/ckeditor-integrated/ckeditor';
			$Path_CKfinder = './plugins/ckeditor-integrated/ckfinder';

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;
			

			$breadcrumb[] = '<a href="'.base_url('member').'">'.$language['member'].'</a>';
			$breadcrumb[] = $language['edit'];

			//$member_type = $this->Member_type_model->get_member_type();
			$member_profile = $this->Member_model->get_member_profile($id);
			
			$sel_tags = $this->Tags_model->get_tag_pair($id, 5);
			//Debug($member_profile);
			$belong_to = explode(',', $member_profile[0]['belong_to_id']);
			//Debug($belong_to);
			//$set_default = array();
			//$set_default = new default_model();
			$set_default = NULL;

			if($belong_to)
				foreach($belong_to as $arr => $val){
							//echo "$arr => $val<br>";
							//if (!isset($set_default[$arr]->value)) 
							@$set_default[$arr]->value = $val;
				}
			//Debug($set_default);

			$sel_belong_to = $this->Belong_to_model->getSelect($set_default);
			//$sel_belong_to = $this->Belong_to_model->get_data();
			
			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"member_type" => $this->Member_type_model->get_member_type(),
					"belong_to_list" => $sel_belong_to,
					"member_list" => $member_profile[0],
					"sel_tags" => $sel_tags,
					"notification_birthday" => $notification_birthday,
					"content_view" => 'member/member_edit',
					"breadcrumb" => $breadcrumb
			);
			//Ckeditor's configuration
			$data['ckeditor'] = array(
				'id'     =>     'hobby',
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
			$data['ckeditor2'] = array(
				'id'     =>     'profile_background',
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
			$data['ckeditor3'] = array(
				'id'     =>     'portfolio',
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
					
			$this->load->view('template/template',$data);
	
	}

	public function remove_img($member_profile_id = 0){
			
			//echo $member_profile_id ;
			$src = $this->input->post('name');
			//echo $member_profile_id .' '. $src ;
			if(file_exists('uploads/member/'.$src)) unlink('uploads/member/'.$src);
			$obj_data['avatar'] = '';
			if($this->Member_model->store($member_profile_id, $obj_data))
				echo 'Yes';
			else
				echo 'No';

	}

	public function picture($id = 0){
						
			$this->load->model('Api_model');
			$this->load->model('Picture_model');

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			/*$ref_id = $this->input->get();
			if($ref_id)
				foreach($ref_id as $key => $val){
						//echo "<br>".$Member_id." : ".$val;
						if($key == "Member_id") $Member_id = $val;
						if($key == "Orientation") $orientation = $val;
				}*/

			$breadcrumb[] = '<a href="'.base_url('member').'">'.$language['member'].'</a>';
			$breadcrumb[] = '<a href="'.base_url('member/edit').'/'.$this->uri->segment(3).'">'.$language['edit'].'</a>';
			$breadcrumb[] = $language['picture'];
			//$picture_list = $this->Api_model->get_picture($Member_id, $id);

			$member_profile = $this->Member_model->get_member_profile($id);

			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"member_id" => $id,
					"member_list" => $member_profile[0],
					"content_view" => 'member/member_edit_picture',
					"breadcrumb" => $breadcrumb
			);
			$this->load->view('template/template',$data);

	}

	public function rotate(){

			$this->load->model('Picture_model');
			//$gallery_id = $this->input->get('gallery_id');
			$rotate = $this->input->get('rotate');
			//$folder = $this->input->get('folder');
			$file = $this->input->get('file');

			$rotate = ($rotate == "l") ? -90 : 90;  //หมุนทวนเข็มนาฬิกา และ ตามเข็มนาฬิกา
			//$sourcefile = './uploads/member/'.$folder.'/'.$file;
			//$sourcefile_tmp = './uploads/tmp/member/'.$folder.'/'.$file;
			$sourcefile = './uploads/member/'.$file;
			$sourcefile_tmp = './uploads/tmp/member/'.$file;

			//Debug($sourcefile);
			//Debug($rotate);
			$this->Picture_model->rotate_img($sourcefile, $sourcefile, $rotate, 1);
			$this->Picture_model->rotate_img($sourcefile_tmp, $sourcefile_tmp, $rotate, 0);
	}

	public function picture_watermark($id = 0){

			$this->load->model('Api_model');
			$this->load->model('Picture_model');
			$this->load->helper('img');

			$inputdata = $this->input->post();
			if($inputdata)
				foreach($inputdata as $key => $val){
						if($key == "id") $id = $val;
						if($key == "Member_id") $Member_id = $val;
						if($key == "folder") $folderdb = $val;
						if($key == "file") $file = $val;
						if($key == "watermark") $watermark = $val;
				}
			//Debug($inputdata);
			//die();
			$folder = 'member';
			$type = 'member';

			switch($watermark){
						case "center" : $picture_list = $this->Picture_model->watermark($file, $folder, $type); break; //Logo ขนาดเล็ก
						case "horizontal" : $picture_list = $this->Picture_model->watermark($file, $folder, $type, 1); break; //แนวนอน
						case "vertical" : $picture_list = $this->Picture_model->watermark($file, $folder, $type, 2); break; //แนวตั้ง
						case "logo" :
						default : $picture_list = $this->Picture_model->watermark($file, $folder, $type, 3); break; //Logo ขนาดใหญ่
			}

			//Debug($inputdata);
			//die();
			redirect('member/edit/'.$id);
			//http://localhost/siammember_admin/Member/picture_edit/121?Member_id=43
			die();	
	}

	public function save(){//บันทึกลงฐานข้อมูล
		
			$this->load->model('Tags_model');
			$this->load->library('image_lib');

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;

			$breadcrumb[] = $language['member'];

			$new_data = $obj = array();
			$insert_newid = $tag_name = '';
			$data_input = $this->input->post();

			if($data_input)
					foreach($data_input as $key => $val){			
							if($key != "editorCurrent" && $key != "tags" && $key != "tags_remove") $new_data[$key] = $val;
							if($key == "tags") $get_tags = explode(",", trim($val));
							//if($key == "tags_remove") $tags_remove = explode(",", $val);
							//if($key == "belong_to_id") $belong_to = explode(",", $val);
					}

			//if(!$new_data['member_profile_id_map']) $new_data['member_profile_id_map'] = $new_data['member_profile_id'];
			if(!isset($new_data['member_profile_id'])){
					$new_data['member_profile_id'] = 0;
					//$new_data['member_profile_id_map'] = 0;
			}

			//Debug($new_data);			
			//echo "get_tags";
			//Debug($get_tags);
			//die();

			//$this->load->library('form_validation');
			// field name, error message, validation rules
			//$this->form_validation->set_rules('first_name', $language['first_name'], 'trim|required');
			//$this->form_validation->set_rules('last_name', $language['last_name'], 'trim|required');
			//$this->form_validation->set_rules('nick_name	', $language['nickname'], 'trim|required');

			//$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			//if($this->form_validation->run() == FALSE){
			if(1 == 2){
					//$error_delimit = $this->form_validation->set_error_delimiters();
					//Debug($error_delimit);

					/*$this->load->model('Belong_to_model');
					//$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
					//$language = $this->lang->language;
					//$breadcrumb[] = '<a href="'.base_url('member').'">'.$language['member'].'</a>';
					$breadcrumb[] = $language['add'];
					$member_type = $this->Member_type_model->get_member_type();
					$belong_to = $this->Belong_to_model->getSelect();
					$data = array(
							"admin_menu" => $this->menufactory->getMenu(),
							"ListSelect" => $ListSelect,
							"member_type" => $member_type,
							"belong_to" => $belong_to,
							"content_view" => 'member/member_add',
							"error" => 'Please, Enter nickname firstname lastname',		
							"breadcrumb" => $breadcrumb
					);			
					$this->load->view('template/template',$data);*/

					echo '<script type="text/javascript">
					alert("Please, Enter nickname firstname and lastname");window.location="'.base_url("member").'";
					</script>';
					//exit;
					die();
			}else{
					

					$now_date = date('Y-m-d H:i:s');

					//if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);
					$this->load->library('upload', $this->set_upload_options());

					$this->upload->initialize($this->set_upload_options());
					if ( ! $this->upload->do_upload('avatar')){
							$error = array('error' => $this->upload->display_errors());
							$data['upload_status'] = $error;
					}else{
							$data = array(
									'admin_menu' => $this->menufactory->getMenu(),
									'upload_data' => $this->upload->data(),
									'upload_status' => 'Success',
							);

							$this->image_lib->clear();
							$this->image_lib->initialize($this->set_uploadto_tmp($this->upload->client_name));
							$this->image_lib->resize();

							//$data['upload_status'] = $data;
					}

					if($this->upload->client_name){
							$new_data['avatar'] = $this->upload->client_name;
					}

					//die();
					
					if($data_input['birth_date'] != '') $new_data['birth_date'] = DateDB($data_input['birth_date']);

					$belong_to_id = '';
					unset($new_data['belong_to_id']);

					//Debug($data_input['belong_to_id']);
					if(isset($data_input['belong_to_id'])){
							foreach($data_input['belong_to_id'] as $field => $val){
									if($belong_to_id == '') $belong_to_id = $val;
									else $belong_to_id .= ','.$val;
							}
							$new_data['belong_to_id'] = $belong_to_id;
					}

					//Debug($new_data);
					//die();

					if($new_data['member_profile_id'] > 0){

								$action = 2;
								$new_data['lastupdate_date'] = $now_date;
								$new_data['lastupdate_by'] = $this->session->userdata('admin_id');
								$this->Member_model->store($new_data['member_profile_id'], $new_data);
								$data = array(
										"admin_menu" => $this->menufactory->getMenu(),
										"ListSelect" => $ListSelect,
										"member_type" => $this->Member_type_model->get_member_type(),
										"member_list" => $this->Member_model->get_member_profile(),
										"search_form" => null,
										"content_view" => 'member/member',
										"breadcrumb" => $breadcrumb,
										"success" => 'Update member Complete.'
								);
								$insert_newid = $new_data['member_profile_id'];						
								
					}else{ //Insert DB

								$action = 1;

								unset($new_data['member_profile_id_map']);

								$new_data['create_date'] = $now_date;
								$new_data['create_by'] = $this->session->userdata('admin_id');
								$insert_newid = $this->Member_model->store(0, $new_data);
								//Debug($insert_newid);
								$data = array(
										"admin_menu" => $this->menufactory->getMenu(),
										"ListSelect" => $ListSelect,
										"member_type" => $this->Member_type_model->get_member_type(),
										"member_list" => $this->Member_model->get_member_profile(),
										"search_form" => null,
										"content_view" => 'member/member',
										"breadcrumb" => $breadcrumb,
										"success" => 'Add member Complete.'
								);				
					}

					//Debug($data_input);
					//echo count($get_tags);
					//echo "action = $action";
					//die();

					//echo "action = $action ".count($get_tags);

					if($action == 1 ||  count($get_tags) <= 1){
					//เพิ่มดาราใหม่ให้ Add Default Tags เป็น [first_name last_name], [nick_name]
							//**************Add tags******************
							$tag_name = trim($new_data['first_name']." ".$new_data['last_name']);
							$curtag = $this->Tags_model->validate_tags($tag_name);
							$maxid_tag = $curtag[0]->tag_id;

							if(!$curtag){
									$get_max_id = $this->Tags_model->get_max_id();
									//Debug($get_max_id);
									
									$maxid_tag = $get_max_id[0]['max_id'];
									$maxid_tag++;
								
									$obj['tag_id'] = $maxid_tag;
									$obj['tag_text'] = $tag_name;
									$obj['create_date'] = $now_date;
									
									//Debug($obj);
									$this->Tags_model->store($obj);
							}
							unset($obj);
							//$get_max_id = $new_data['member_profile_id'];
							$obj[0]['tag_id'] = $maxid_tag;
							$obj[0]['ref_id'] = $insert_newid;
							$obj[0]['ref_type'] = 5;
							$obj[0]['order'] = 1;
							$obj[0]['create_date'] = $now_date;
							$this->Tags_model->store_tag_pair($obj, 0);		
									
							//Add tag nick name
							unset($curtag);
							$tag_name = trim($new_data['nick_name']);
							$curtag = $this->Tags_model->validate_tags($tag_name);
							$maxid_tag = $curtag[0]->tag_id;

							if(!$curtag){
									$get_max_id = $this->Tags_model->get_max_id();
									$maxid_tag = $get_max_id[0]['max_id'];
									$maxid_tag++;					
									//echo "maxid_tag = $maxid_tag";		
									unset($obj);
													
									$obj['tag_id'] = $maxid_tag;
									$obj['tag_text'] = $tag_name;
									$obj['create_date'] = $now_date;						
									$this->Tags_model->store($obj);
									//Debug($new_data);
							}
										
							unset($obj);
							$obj[0]['tag_id'] = $maxid_tag;
							$obj[0]['ref_id'] = $insert_newid;
							$obj[0]['ref_type'] = 5;
							$obj[0]['order'] = 2;
							$obj[0]['create_date'] = $now_date;
							$this->Tags_model->store_tag_pair($obj, 0);

					}else{
							//Compare Tags
							//Debug($get_tags);
							$addtags = array();
							//echo "<hr>";
							//$chktags = count($get_tags);
							if($get_tags)
									foreach($get_tags as $key => $data){
											//echo "<p>$key => $data</p>";
											$chktag = $this->Tags_model->validate_tags(trim($data));

											if($chktag){
												//Debug($chktag);
												$addtags[] = $chktag[0]->tag_id;
											}else{ //Add Tags ใหม่ลง DB

														echo "NO TAGS IN DB<hr>";

														unset($obj);
														$get_max_id = $this->Tags_model->get_max_id();
														$maxid_tag = $get_max_id[0]['max_id'];
														$maxid_tag++;

														$obj['tag_id'] = $maxid_tag;
														$obj['tag_text'] = trim($data);
														$obj['create_date'] = $now_date;
														$addtags[] = $this->Tags_model->store($obj);

											}
									}
					}

					//ตรวจสอบ TAGS ว่ามี Tags ของ ดาราแล้วยัง
					//echo "<hr>";
					//Debug('Addtags');
					//Debug($addtags);
					if(isset($addtags))
							foreach($addtags as $key => $data){
									//echo "<p>[<b>chktag_pair</b>] $key => $data</p>";
									$result = $this->Tags_model->chktag_pair($data, 5); //Type = 5 = ดารา
									//Debug($result);
									if($result){
											
											if($result[0]->ref_type != 5){//Update Type of tag_pair
													//echo "<p>UPDATE TAGS PAIR $data</p>";
													unset($obj);
													//$obj[0]['tag_id'] = $result[0]->tag_id;
													$obj[0]['ref_type'] = 5;

													//echo "ref_type != 5<br>";
													//Debug('store_tag_pair');
													$this->Tags_model->store_tag_pair($obj, 0, $data);		
											}

									}else{ //Add Tags pair ใหม่ลง DB
											
											//Debug('Add Tags pair ใหม่ลง DB');
											
											//echo "<p>Add Tags pair ใหม่ลง DB $data</p>";
											unset($obj);
											$obj[0]['tag_id'] = $data;
											$obj[0]['ref_id'] = $insert_newid;
											$obj[0]['ref_type'] = 5;
											$obj[0]['create_date'] = $now_date;

											//echo "result == 0<br>";
											//Debug($obj);
											$this->Tags_model->store_tag_pair($obj, 0);
									}
							}
					//die();

					//**************Log activity
					$log_activity = array(
										"admin_id" => $this->session->userdata('admin_id'),
										"ref_id" => $insert_newid,
										"ref_type" => 5,
										"ref_title" => trim($new_data['nick_name']).' '.trim($new_data['first_name']." ".$new_data['last_name']),
										"action" => $action
					);			
					$this->Admin_log_activity_model->store($log_activity);
					//**************Log activity

					//$this->load->view('template/template',$data);
					redirect('member');
			}//check validate
	}

	private function set_upload_options(){   

		$config = array();
		$folder = date('Ymd');
			
		$config['upload_path'] = './uploads/member/';
		if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777);

		$upload_path = './uploads/tmp/';
		if(!is_dir($upload_path)) mkdir($upload_path, 0777);

		$upload_path = './uploads/tmp/member/';
		if(!is_dir($upload_path)) mkdir($upload_path, 0777);

		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		//$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		//$config['max_size'] = '300';
		//$config['max_width'] = '1024';
		//$config['max_height'] = '768';
		return $config;
	}

	private function set_uploadto_tmp($client_name, $width = 250, $height = 170){   

		$config = array();
		$folder = date('Ymd');
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = './uploads/member/'.$client_name;
		//$config['new_image'] = './uploads/tmp/'.$client_name;

		$config['create_thumb'] = FALSE;	//สร้าง Thumb โดย CI
		$config['maintain_ratio'] = TRUE;
		//$config['width']     = $width;
		//$config['height']   = $height;

		//****Copy Original File to TMP
		$upload_path = './uploads/tmp/member';
		$tmp = $upload_path.'/'.$client_name;

		$src = fopen($config['source_image'], 'r');
		$dest = fopen($tmp, 'w');

		echo "stream_copy_to_stream(".$config['source_image'].")";
		echo " ==> ".$tmp;

		stream_copy_to_stream($src, $dest);

		return $config;
	}

	public function status($id = 0){

			if($id == 0){
					$data = array(
							"error" => 'id error'
					);
					return false;
			}else{
					$obj_status = $this->Member_model->get_status($id);

					//Debug($obj_status);
					$cur_status = $obj_status[0]['status'];

					if($cur_status == 0) $cur_status = 1;
					else $cur_status = 0;

					$obj_data['status'] = $cur_status;
					if($this->Member_model->store($id, $obj_data)) echo $cur_status;
					//$this->gen_json($id);
			}
	}
	
	public function delete($id){

			echo "Deleting... $id";
			
			$OBJMember = $this->Member_model->get_member_profile($id);
			$title = $OBJMember[0]['nick_name'].' '.$OBJMember[0]['first_name'].' '.$OBJMember[0]['last_name'];
			//$order_by = $OBJMember[0]['order_by'];

			$this->Member_model->delete_member_profile($id);
			//die();

			//$this->Member_model->update_orderdel($order_by);

			//**************Log activity
			$action = 3;
			$log_activity = array(
								"admin_id" => $this->session->userdata('admin_id'),
								"ref_id" => $id,
								"ref_type" => 5,
								"ref_title" => $title,
								"action" => $action
			);			
			$this->Admin_log_activity_model->store($log_activity);
			//**************Log activity

			redirect('member');
			die();
	}

	public function delete_tags($txt){

			$txt = urldecode($txt);
			//echo $txt;
			$result = $this->Member_model->delete_tag($txt, 5);

			/*if($result)
				echo "Delete Success.";
			else
				echo "Can not delete.";*/

	}

	public function clear_picture(){
	
    		$upload_tmppath = '/var/www/memberbackend/uploads/member/';
			//echo __FILE__;

			/*if (!is_dir($upload_tmppath)) {
				mkdir($upload_tmppath);
			}
			rmdir($upload_tmppath);*/

			echo "<br>";
			$dir =  $upload_tmppath;

			// Open a directory, and read its contents
			if (is_dir($dir)){
			  if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
				  echo "filename:" . $file . "<br>";
				}
				closedir($dh);
			  }
			}

			/*if (is_readable($upload_tmppath)) {
			  
				$dir = $upload_tmppath;
			   // open specified directory and remove all files within
			   $dirHandle = opendir($dir);
			   $total_deleted_images = 0;
			   while ($file = readdir($dirHandle)) {
			 
				  //if(!is_dir($file)) {
						//unlink($dir.$file);
						/////remove  >>> // below if needed
						//echo 'Deleted file <b>'.$file.'</b><br />';
						// $total_deleted_images++;
				  //}
				  echo 'Deleted file <b>'.$file.'</b><br />';

			   }
			   closedir($dirHandle);
				if($total_deleted_images=='0'){
					echo '<!-- no if you want to see on page - now hidden -->';
				}
			   
				//remove dir at the end
				//rmdir($dir);
			} else {
			echo "";
			}*/

			//exec("cd ".$upload_tmppath );
			//exec("rm -fr *");

	}

	public function import_picture(){

			$this->load->helper('img');

    		$upload_tmppath = './uploads/member';

			$member_list = $this->Member_model->get_memberall();
			//Debug($member_list);
			//die();
			if(isset($member_list)){
					$start = 0;
					//$all = count($member_list);
					$all = 50;

					for($i=$start;$i<$all;$i++){
								
								$avatar_member = $member_list[$i]['avatar'];
								$url_picture = 'http://cremation.com/'.$avatar_member;
								$new_filename = $upload_tmppath.'/'.$avatar_member;

								$src = fopen($url_picture, 'r');
								$dest1 = fopen($new_filename, 'w');
								stream_copy_to_stream($src, $dest1);
								$number = $i+1;
								//echo $number." success.<br>";
					}
					echo "download picture ".count($member_list)." success.<br>";
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

			$vdo_list = $this->Member_model->load_sstv(1, $number);

			if($display == true) Debug($vdo_list);
			//die();

			if(isset($vdo_list)){
				if($vdo_list['header']['code'] == 200){
					$allvdo = count($vdo_list['body']);
					//echo "ALL = $allvdo <br>";
					
					for($i=0;$i<$allvdo;$i++){

								$IDmember = $vdo_list['body'][$i]['IDmember'];
								$FkIDmemberType = StripTxt($vdo_list['body'][$i]['FkIDmemberType']);
								$Fullname = $vdo_list['body'][$i]['NameD'];
								$nickname = $vdo_list['body'][$i]['NickN'];
								$Sex = $vdo_list['body'][$i]['Sex'];
								$BirthDay = $vdo_list['body'][$i]['BirthDay'];
								$Province = $vdo_list['body'][$i]['Province'];
								$Weight = $vdo_list['body'][$i]['Weight'];
								$Tall = $vdo_list['body'][$i]['Tall'];
								$Education = $vdo_list['body'][$i]['Education'];
								$Hobby = $vdo_list['body'][$i]['Hobby'];
								$Profile = $vdo_list['body'][$i]['Profile'];
								$Performance = $vdo_list['body'][$i]['Performance'];
								$LastPerformance = $vdo_list['body'][$i]['LastPerformance'];
								$Pic0 = $vdo_list['body'][$i]['Pic0'];
								$Pic1 = $vdo_list['body'][$i]['Pic1'];
								$Pic2 = $vdo_list['body'][$i]['Pic2'];
								$Pic3 = $vdo_list['body'][$i]['Pic3'];
								$CountView = $vdo_list['body'][$i]['CountView'];
								$DateCreate = $vdo_list['body'][$i]['DateCreate'];

								$picture = 'http://cremation.com/'.$Pic0;
								$picture1 = 'http://cremation.com/'.$Pic1;
								$picture2 = 'http://cremation.com/'.$Pic2;
								$picture3 = 'http://cremation.com/'.$Pic3;

								switch($FkIDmemberType){	
										case 1 : $FkIDmemberType = 1; break;
										case 2 : $FkIDmemberType = 3; break;
										case 3 : $FkIDmemberType = 5; break;
										case 4 : $FkIDmemberType = 7; break;
										default : $FkIDmemberType = 9; break;
								}
								switch($Sex){	
										case 1 : $Sex = 'm'; break;
										default : $Sex = 'f'; break;
								}

								list($first_name, $last_name) = explode(" ", $Fullname);

								$data[$i]['idmember'] = $IDmember;
								$data[$i]['member_type_id'] = $FkIDmemberType;
								$data[$i]['first_name'] = $first_name;
								$data[$i]['last_name'] = $last_name;
								$data[$i]['nick_name'] = $nickname;
								$data[$i]['gender'] = $Sex;
								//$data[$i]['birth_date'] = $BirthDay;
								$data[$i]['birth_place'] = $Province;
								$data[$i]['weight'] = $Weight;
								$data[$i]['height'] = $Tall;
								//$data[$i]['education'] = $Education;
								$data[$i]['hobby'] = $Hobby;
								$data[$i]['profile_background'] = $Profile;
								$data[$i]['portfolio'] = $Performance;
								$data[$i]['last_portfolio'] = $LastPerformance;

								$data[$i]['avatar'] = $Pic0;

								$data[$i]['lang'] = 'en';
								//$data[$i]['order_by'] = $i+1;

								//Debug($data[$i]);

								//echo '<img src="'.$picture.'" border="0" alt=""><br>';
								//echo '<img src="'.$picture1.'" border="0" alt=""><br>';
								//echo '<img src="'.$picture2.'" border="0" alt=""><br>';
								//echo '<img src="'.$picture3.'" border="0" alt=""><br>';
								//echo "<hr>";
					}
					//Debug($data);

					if($insert == true)
						if($this->Member_model->import_sstv_to_db($data)){
								echo "$i record Import Success.";
						}
				}
			}

	}

	public function sentmail(){
			
			$idsent = $this->input->post('id');
			echo 'Sentmail. '.$idsent ;
	}

	public function auto_tags(){
			
			$this->Member_model->auto_tags();
	}
	
}
