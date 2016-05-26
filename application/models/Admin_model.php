<?php

class Admin_Model extends CI_Model{

public $_admin_id;
	//public $_admin_id2;
	public $_admin_type_id;
	public $_admin_team_id;
	public $_admin_username;
	public $_admin_password;
	public $_admin_avatar;
	public $_admin_name;
	public $_admin_lastname;
	public $_admin_email;
	public $_phone;
	public $_mobile;
	public $_create_date;
	public $_departmen;
	public $_address;
	public $_create_by;
	public $_lastupdate_date;
	public $_lastupdate_by;
	public $_lastlogin;
	public $_status;

	public function __construct(){
		parent::__construct();
	}

	/*
	* SET's & GET's
	* Set's and get's allow you to retrieve or set a private variable on an object
	*/

	public function getObj(){
		return $this;
	}

	public function getId(){
		return $this->_admin_id2;
		return $this->_admin_id;
	}

	public function getAdmin(){
		return $this->_admin_name;
	}

	public function getEmail(){
		return $this->_admin_email;
	}

    public function getSelectAdminType($default = 0, $getAdminType = null, $name = "admin_type_id"){
    		
    		$language = $this->lang->language;
    		
    		//debug($language);
    		//die();    		
    		$first = "--- ".$language['please_select'].$language['admin_level']." ---";
    		
	    	//if($default == 0) $rows = $this->get_category(null, 1);
	    	//else $rows = $this->get_category($default, 1);

			$rows = $this->adminfactory->getAdminType();
			//Debug($rows);
           $admin_type=$this->session->userdata('admin_type');
	    	$opt = array();
	    	$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($getAdminType);$i++){
	    		$row = @$getAdminType[$i];
                   
               if($admin_type==1){
               if($row->admin_type_id != 0) $opt[]	= makeOption($row->admin_type_id, $row->admin_type_title);  
               }else{
               if($row->admin_type_id != 1) $opt[]	= makeOption($row->admin_type_id, $row->admin_type_title);
               }
	    		
                   
                   
	    	}
	    	return selectList($opt, $name, 'class="form-control"', 'value', 'text', $default);
    }

    public function Get_AdminType(){

    }

	/**
	*	Commit method, this will comment the entire object to the database
	*/
	public function commit($obj = array()){
		//'admin_username' => $this->_admin_username,

		$this->setObj($obj);

		$data = array(
			'admin_name' => $this->_admin_name,
			'admin_lastname' => $this->_admin_lastname,
			'phone' => $this->_phone,
			'mobile' => $this->_mobile,
			'lastupdate_date' => time()
		);
		//'status' => $this->_status

		/*echo "admin_id  = $admin_id <br>";
		echo "<pre>";
		print_r($data);
		echo "</pre>";*/

		//$admin_id = $obj->admin_id;

		//if ($this->_admin_id > 0) {
		/*if ($admin_id > 0) {
			//We have an ID so we need to update this object because it is not new

			if ($this->db->update("_admin", $data, array("admin_id" => $admin_id))) {
				return true;
			}
		} else {
			//We dont have an ID meaning it is new and not yet in the database so we need to do an insert
			if ($this->db->insert("_admin", $data)) {
				//Now we can get the ID and update the newly created object
				$this->_admin_id = $this->db->insert_id();
				return true;
			}
		}
		return false;*/
	}

	public function setObj($v){

		if($v->admin_id) $this->_admin_id = $v->admin_id;
		if($v->admin_type_id) $this->_admin_type_id = $v->admin_type_id;
		if($v->admin_team_id) $this->_admin_team_id = $v->admin_team_id;
		if($v->admin_username) $this->_admin_username = $v->admin_username;
		if($v->admin_password) $this->_admin_password = $v->admin_password;
		if($v->admin_avatar) $this->_admin_avatar = $v->admin_avatar;
		if($v->admin_name) $this->_admin_name = $v->admin_name;
		if($v->admin_lastname) $this->_admin_lastname = $v->admin_lastname;
		if($v->department) $this->_department = $v->department;
		if($v->address) $this->_address = $v->address;
		if($v->admin_email) $this->_admin_email = $v->admin_email;
		if($v->phone) $this->_phone = $v->phone;
		if($v->mobile) $this->_mobile = $v->mobile;
		if($v->lastlogin) $this->_lastlogin = $v->lastlogin;
		if($v->status) $this->_status = $v->status;
	}

    function store($id = 0, $data){

			if($id > 0){
					$this->db->where('admin_id', $id);
					$this->db->update('_admin', $data);
					return $this->db->last_query();
					$report = array();
					$report['error'] = $this->db->_error_number();
					$report['message'] = $this->db->_error_message();
					if($report !== 0){
						echo $this->db->last_query();
						//die();
						return true;
					}else{
						return false;
					}					
			}else{
					//$insert = $this->db->insert('_admin', $data);
					//echo $this->db->last_query();
					//return $insert;
			}
	}
    
	 public function get_member_by_id($id){
		$this->db->select('*');
		$this->db->from('_admin');
		$this->db->where('admin_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }   
	
    function delete_admin($id){
       //echo '$id='.$id; die();
        if($id>=6){
        $this->db->where('admin_id', $id);
		$this->db->delete('_admin'); 
        }else{
            $this->db->set('status', 0);
            $this->db->where('admin_id', $id);
            $this->db->update('_admin'); 
		    //echo $this->db->last_query();
            //echo '$id='.$id;die();
        }
		 
	}
    

}