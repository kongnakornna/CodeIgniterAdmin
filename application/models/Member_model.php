<?php
class Member_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    
    	$this->db->select('*');
    	$this->db->from('_member_profile');

    	$this->db->where('member_profile_id', $id);
    	//$this->db->where('member_profile_id_map', $id);
    	//$this->db->where('lang', $language);

    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    }

    public function get_max_id(){

		//$language = $this->lang->language['lang'];
		$this->db->select('max(member_profile_id) as max_id');
		$this->db->from('_member_profile');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_count(){

		//$language = $this->lang->language['lang'];
		$this->db->select('count(member_profile_id) as countid');
		$this->db->from('_member_profile');
		//$this->db->where('lang', $language);
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->result_object(); 
    }

    public function get_member_profile_by_id($id_map){

		//$language = $this->lang->language['lang'];
		$this->db->select('*');
		$this->db->from('_member_profile');
		$this->db->where('member_profile_id_map', $id_map);
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

    public function get_member_profile($member_profile_id_map=null, $search_string=null, $member_type = null, $gender = '', $order = 'lastupdate_date', $order_type='DESC', $member_status = null, $limit_start = 0, $listpage = 3000){
		
		$language = $this->lang->language['lang'];
		$all = $this->lang->language['all'];

		$this->db->select('dp.*, dt.member_type_name, bt.belong_to');
		$this->db->from('_member_profile as dp');
		$this->db->join('_member_type as dt', '(dp.member_type_id=dt.member_type_id_map AND dt.lang="'.$language.'"');
		$this->db->join('_belong_to as bt', '(dp.belong_to_id=bt.belong_to_id', 'left');

		//$this->db->select('*');
		//$this->db->from('_member_profile');

		if($member_profile_id_map != null && $member_profile_id_map > 0){
			//$this->db->where('member_profile_id_map', $member_profile_id_map);
			$this->db->where('member_profile_id', $member_profile_id_map);
		}

		//if($member_profile_id_map <= 0) $this->db->where('lang', $language);
		if($member_type) $this->db->where('dp.member_type_id', $member_type);

		if($member_status !== null) $this->db->where('dp.status', $member_status);

		if($gender != '' && $gender != $all) $this->db->where('dp.gender', $gender);

		//$this->db->where('dp.avatar !=', '');
		//$this->db->where('dp.avatar !=', '-');
		if(is_array($search_string)){
			foreach($search_string as $key => $val){
					if(trim($val) != ''){
							$array_kw['dp.first_name'] = $val;
							$array_kw['dp.last_name'] = $val;
							$array_kw['dp.nick_name'] = $val;
					}
					$this->db->or_like($array_kw);
			}

		}else{
			if($search_string != ''){
				$this->db->like('dp.first_name', $search_string);
				$this->db->or_like('dp.last_name', $search_string);
				$this->db->or_like('dp.nick_name', $search_string);
				$this->db->or_like('dp.pen_name', $search_string);
			}
		}

		$this->db->where('dp.status !=', 2);

		if($order){
			if($order == "lastupdate_date") $order_type = "DESC";
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('lastupdate_date', "DESC");
		}

		if($listpage != 0) $this->db->limit($listpage, $limit_start);

		$query = $this->db->get();		
		//Debug($this->db->last_query());
		
		return $query->result_array();
    }


    public function get_memberall(){
		
		$language = $this->lang->language['lang'];
		$all = $this->lang->language['all'];

		$this->db->select('dp.*');
		$this->db->from('_member_profile as dp');
		//$this->db->join('_member_type as dt', '(dp.member_type_id=dt.member_type_id_map AND dt.lang="'.$language.'"');
		//$this->db->join('_belong_to as bt', '(dp.belong_to_id=bt.belong_to_id', 'left');

		$this->db->where('dp.status !=', 2);

		//if($member_type) $this->db->where('dp.member_type_id', $member_type);
		//if($member_status !== null) $this->db->where('dp.status', $member_status);
		//if($gender != '' && $gender != $all) $this->db->where('dp.gender', $gender);
		//$this->db->where('dp.avatar !=', '');
		//$this->db->where('dp.avatar !=', '-');

		$this->db->order_by('idcard', "ASC");
		$this->db->limit(1000, 0);
		$query = $this->db->get();		
		
		return $query->result_array();
    }

    public function search_member_profile($field = 'all', $search_string=null, $listpage = 20){
		
		$language = $this->lang->language['lang'];
		//$all = $this->lang->language['all'];

		$this->db->select('dp.nick_name, dp.pen_name, dp.first_name, dp.last_name');
		//$this->db->select('dp.nick_name, dp.first_name, dp.last_name, dt.member_type_name, bt.belong_to');
		$this->db->from('_member_profile as dp');
		//$this->db->join('_member_type as dt', '(dp.member_type_id=dt.member_type_id_map AND dt.lang="'.$language.'"');
		//$this->db->join('_belong_to as bt', '(dp.belong_to_id=bt.belong_to_id', 'left');

		if($field == 'all'){
			$this->db->like('first_name', $search_string);
			$this->db->or_like('last_name', $search_string);
			$this->db->or_like('nick_name', $search_string);
			$this->db->or_like('pen_name', $search_string);
		}else{
			$this->db->like($field, $search_string);
		}

		$this->db->where('dp.status !=', 2);
		$this->db->order_by('first_name', "ASC");

		if($listpage == 0)  $listpage = 20;
		if($listpage != 0) $this->db->limit($listpage, 0);

		$query = $this->db->get();
		//Debug($this->db->last_query());
		return $query->result_object();
    }

    function count_member_profile($id_map=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_member_profile');
		if($id_map != null && $id_map != 0){
			$this->db->where('member_profile_id_map', $id_map);
		}
		if($search_string){
			$this->db->like('first_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('create_date', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store($member_profile_id = 0, $data, $showdebug = 0){
			//echo "(member_profile_id = $member_profile_id)";

			if($member_profile_id > 0){
					$this->db->where('member_profile_id', $member_profile_id);
					$this->db->update('_member_profile', $data);

					if($showdebug > 0) Debug($this->db->last_query());

					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//if($showdebug > 0) Debug($this->db->last_query());
						//die();
						return true;
					}else{
						return false;
					}					
			}else{
					$this->db->insert('_member_profile', $data);
					if($showdebug > 0) Debug($this->db->last_query());
					$insert = $this->db->insert_id();
					return $insert;
			}
	}

    /*function store($data){
		$insert = $this->db->insert('_member_profile', $data);
	    return $insert;
	}

    function store_update($member_profile_id, $data){

		$this->db->where('member_profile_id', $member_profile_id);
		$this->db->update('_member_profile', $data);
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}*/

	function status_member_profile($id_map, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('member_profile_id_map', $id_map);
		$this->db->update('_member_profile', $data);
		
		return $this->db->last_query();
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	
	
    function delete_member_profile($id_map){

		$data = array(
				'status' => 2
		);
		//$this->db->where('member_profile_id_map', $id_map);
		$this->db->where('member_profile_id', $id_map);
		$this->db->update('_member_profile', $data);
		//Debug($this->db->last_query());
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_member_admin($id_map){
		$this->db->where('member_profile_id_map', $id_map);
		$this->db->delete('_member_profile'); 
	}

	function delete_tag($member, $ref_type = 5){
			
			$this->db->select('tp.*, t.tag_text');
			$this->db->from('_tag_pair tp');
			$this->db->join('_tag t', 'tp.tag_id=t.tag_id and t.status = 1');
			$this->db->where('t.tag_text', $member);
			$this->db->where('tp.ref_type', $ref_type);

			$query = $this->db->get();				
			$result =  $query->result_object();
			
			if($result){

					$pair_id = $result[0]->pair_id;
					//Debug($pair_id);

					$this->db->where('pair_id', $pair_id);
					$this->db->delete('_tag_pair');
					//Debug($this->db->last_query());
			}
	} 

    public function load_sstv($page = 1, $page_size = 10, $lang ='th'){

				$get_url = "http://www.siammember.com/apisiammember/select_profile_member.php?page_size=".$page_size;
				$jsonData = file_get_contents($get_url);
				$jsonobj = json_decode($jsonData, true);

				return $jsonobj;
	}

	public function import_sstv_to_db(&$data = array()){

					$insert = $this->db->insert_batch('_member_profile', $data);
					return $insert;
	}

	public function auto_tags(){

			$this->load->model('tags_model');

			//SELECT dp.`member_profile_id`, dp.idcard,  dp.`first_name`, dp.`last_name` , dp.`nick_name`, tp.`pair_id` FROM `sd_member_profile` dp LEFT JOIN `sd_tag_pair` tp ON dp.`member_profile_id`= tp.`ref_id` AND tp.`ref_type` = '5'  ORDER BY dp.idcard

			$this->db->select('dp.`member_profile_id`, dp.idcard,  dp.`first_name`, dp.`last_name` , dp.`nick_name`, tp.`pair_id`');
			$this->db->from('_member_profile dp');
			$this->db->join('_tag_pair tp', 'dp.member_profile_id= tp.`ref_id` AND tp.`ref_type` = 5', 'left');
			//$this->db->where('t.tag_text', $member);
			//$this->db->where('tp.ref_type', $ref_type);
			$this->db->order_by('dp.idcard', "ASC");

			$query = $this->db->get();				
			$result =  $query->result_object();
			//Debug($result);
			//die();
			$obj = array();
			$now_date = date('Y-m-d H:i:s');

			if($result){
					$allmember = count($result);

					for($i=0;$i<$allmember;$i++){
							
							if($result[$i]->pair_id > 0 || $result[$i]->member_profile_id == 631){
									//echo "<br>pair_id = ".$result[$i]->pair_id;
							}else{
									//Debug($result);
									//echo "<br>no pair_id";

									$ref_id = $result[$i]->member_profile_id;

									//**************Add tags first_name last_name******************
									$tag_name = trim($result[$i]->first_name." ".$result[$i]->last_name);
									$curtag = $this->tags_model->validate_tags($tag_name);
									if(isset($curtag[0]->tag_id)) $tag_id = $curtag[0]->tag_id;

									if(!$curtag){
											$get_max_id = $this->tags_model->get_max_id();
											$tag_id = $get_max_id[0]['max_id'];
											$tag_id++;
											unset($obj);
											$obj['tag_id'] = $tag_id;
											$obj['tag_text'] = $tag_name;
											$obj['create_date'] = $now_date;
											//Debug($obj);
											$this->tags_model->store($obj);
									}
									unset($obj);

									$obj[0]['tag_id'] = intval($tag_id);
									$obj[0]['ref_id'] = $ref_id;
									$obj[0]['ref_type'] = 5;
									$obj[0]['order'] = 1;
									$obj[0]['create_date'] = $now_date;

									$this->tags_model->store_tag_pair($obj, 0);

									//**************Add tags nickname******************
									$tag_name = trim($result[$i]->nick_name);
									$curtag = $this->tags_model->validate_tags($tag_name);
									if(isset($curtag[0]->tag_id)) $tag_id = $curtag[0]->tag_id;

									if(!$curtag){
											$get_max_id = $this->tags_model->get_max_id();
											$tag_id = $get_max_id[0]['max_id'];
											$tag_id++;

											unset($obj);
											$obj['tag_id'] = $tag_id;
											$obj['tag_text'] = $tag_name;
											$obj['create_date'] = $now_date;
											//Debug($obj);
											$this->tags_model->store($obj);
									}
									unset($obj);

									$obj[0]['tag_id'] = $tag_id;
									$obj[0]['ref_id'] = $ref_id;
									$obj[0]['ref_type'] = 5;
									$obj[0]['order'] = 1;
									$obj[0]['create_date'] = $now_date;

									$this->tags_model->store_tag_pair($obj, 0);
							}

					
					}
					echo "add tags $allmember complete.";

					//$pair_id = $result[0]->pair_id;
					//Debug($result);
					//Debug($this->db->last_query());
			}	
	}
}
?>	
