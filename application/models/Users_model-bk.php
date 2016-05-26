<?php

class Users_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_member_by_id($id){
		$this->db->select('*');
		$this->db->from('_admin');
		$this->db->where('admin_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($admin_username, $admin_password){

		$this->db->where('admin_username', $admin_username);
		$this->db->where('admin_password', $admin_password);
		//$this->db->where('admin_type_id', 1);
		$this->db->where('status', 1);

		$tbl_membership = $this->db->dbprefix('_admin');
		$query = $this->db->get($tbl_membership);
		
		if($query->num_rows == 1)
		{
			foreach ($query->result() as $row){
					return $row->admin_id;
			}
			//return true;
		}		
	}

	function chkUser($admin_username, $admin_password){
		
		$admin = array();

		$this->db->where('admin_username', $admin_username);
		$this->db->where('admin_password', $admin_password);
		//$this->db->where('admin_type_id', 1);
		$this->db->where('status', 1);

		$tbl_membership = $this->db->dbprefix('_admin');
		$query = $this->db->get($tbl_membership);

		//echo $this->db->last_query();
		//die();
		
		if($query->num_rows == 1)
		{
			foreach ($query->result() as $row){
					$admin['id'] = $row->admin_id;
					$admin['username'] = $row->admin_username;
					$admin['type'] = $row->admin_type_id;
					$admin['name'] = $row->admin_name;
					$admin['lastname'] = $row->admin_lastname;
					$admin['email'] = $row->admin_email;
					$admin['avatar'] = $row->admin_avatar;
			}
			return $admin;
			//return true;
		}		
	}


	function chkEmail($admin_email){
		
		$admin = array();

		$this->db->where('admin_email', $admin_email);
		$this->db->where('status', 1);

		$tbl_membership = $this->db->dbprefix('_admin');
		$query = $this->db->get($tbl_membership);

		//echo $this->db->last_query();
		//die();
		
		if($query->num_rows == 1){
			foreach ($query->result() as $row){
					$admin['id'] = $row->admin_id;
					$admin['username'] = $row->admin_username;
					$admin['type'] = $row->admin_type_id;
					$admin['name'] = $row->admin_name;
					$admin['lastname'] = $row->admin_lastname;
					$admin['email'] = $row->admin_email;
					$admin['avatar'] = $row->admin_avatar;
			}
			return $admin;
			//return true;
		}		
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data(){

		$user = array(); /* array to store the user data we fetch */

		$tbl_sessions = $this->db->dbprefix('_sessions');
		$query = $this->db->select('user_data')->get($tbl_sessions);

		foreach ($query->result() as $row){

			//Debug($row);

		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['username'] = $udata['username']; 
		    $user['lastlogin'] = $udata['lastlogin']; 
		}
		return $user;

	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member(){

		$this->db->where('admin_username', $this->input->post('username'));
		$query = $this->db->get('_admin');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_data = array(
				'admin_name' => $this->input->post('first_name').' '.$this->input->post('last_name'),
				'admin_email' => $this->input->post('email_address'),			
				'admin_username' => $this->input->post('username'),
				'admin_password' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('_admin', $new_member_data);
		    return $insert;
		}
	      
	}//create_member
}

