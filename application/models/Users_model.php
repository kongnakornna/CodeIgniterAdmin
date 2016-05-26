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
		
		if($query->num_rows == 1){
			foreach ($query->result() as $row){
				return $row->admin_id;
			}
			//return true;
		}		
	}

	function auth($username, $password, $domain){

			//echo "auth($username, $password, $domain)<br>";
			//LDAP Server 
			if($domain == "inspire.co.th"){

				/*define('LDAP_SERVER', 'LDAP://authen02.siamsport.co.th');
				define('LDAP_PORT', 389);
				define('LDAP_TOP', 'dc=inspire,dc=CO,dc=th');*/

				$adServer = "authen02.siamsport.co.th";
				$string_connection = "dc=inspire,dc=CO,dc=th";
				$dsn = "inspire";

			}else{

				/*define('LDAP_SERVER', 'LDAP://authen01.siamsport.co.th');
				define('LDAP_PORT', 389);
				define('LDAP_TOP', 'dc=siamsport,dc=CO,dc=th');*/

				$adServer = "authen01.siamsport.co.th";
				$string_connection = "dc=siamsport,dc=CO,dc=th";
				$dsn = "siamsports";

			}

			Debug($adServer);
			Debug($string_connection);
			Debug($dsn);

			$ldap = ldap_connect($adServer);
			$ldaprdn = $dsn . "\\" . $username;

			Debug($ldap);
			Debug($ldaprdn);

			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

			echo "ldap_bind($ldap, $ldaprdn, $password);";

			$ldapbind = ldap_bind($ldap, $ldaprdn, $password);
			//Debug($bind);

			/*$ldap = ldap_connect(LDAP_SERVER, LDAP_PORT);
			$un = $username.",".LDAP_TOP;
			//echo stripslashes($un)."<br>";
			$ldapbind = ldap_bind($ldap, stripslashes($un), $password);*/

			if($ldapbind)
				echo "login success";
			else
				echo "login failed";

			/*if ($bind) {
			$filter="(sAMAccountName=$username)";
				$result = ldap_search($ldap, LDAP_TOP, $filter);
				ldap_sort($ldap,$result,"sn");
				$info = ldap_get_entries($ldap, $result);
				$msg = 'Welcome',' ',$username,'@'.$domain ;
				//echo "<pre>";
				//print_r($info[0]['distinguishedname'][0]);
				//echo "</pre>";

				$infoobj = explode(",", $info[0]['distinguishedname'][0]);
				for($i=0; $i<count($infoobj);$i++){

						list($name, $value) = explode("=", $infoobj[$i]);
						$msg .= "$name = $value<br>";

						if($name == "CN") $CN = $value;
						if($name == "OU") $OU = $value;
						if($name == "DC") $DC = $value;

				}

				@ldap_close($ldap);
			 
			} else {
				$msg = "Invalid email address / password";
				//echo $msg;
			}
			echo $msg;*/
			//return $msg;
	}

	function auth_ldap($admin_username, $name, $lastname, $department, $domain){
		$admin = array();

		//$this->db->where('admin_username', $admin_username);
		$this->db->where('admin_email', $admin_username.'@'.$domain);
		//$this->db->where('admin_password', $admin_password);
		//$this->db->where('admin_type_id', 1);
		$this->db->where('status', 1);



		$tbl_membership = $this->db->dbprefix('_admin');
		$query = $this->db->get($tbl_membership);

		//echo "<br>num_rows = ".$query->num_rows ;
		if($query->num_rows == 1){
				foreach ($query->result() as $row){
						$admin['id'] = $row->admin_id;
						$admin['username'] = $row->admin_username;
						$admin['type'] = $row->admin_type_id;
						$admin['name'] = $row->admin_name;
						$admin['lastname'] = $row->admin_lastname;
						$admin['email'] = $row->admin_email;
						$admin['avatar'] = $row->admin_avatar;
						$admin['domain'] = $row->domain;
						$admin['department'] = $row->department;
				}
				$admin['domain'] = $domain;
				//Debug($admin);
				$data = array(
						"admin_email" => $admin_username.'@'.$domain,
						"admin_name" => $name,
						"admin_lastname" => $lastname,
						"department" => $department,
						"domain" => $domain,
				);
				$this->update_member($admin['id'], $data);

				return $admin;
				//return true;
		}else{
				//Add member
				$this->db->where('admin_username', $admin_username);
				//$this->db->where('admin_email', $admin_username.'@'.$domain);
				//$this->db->where('admin_password', $admin_password);
				//$this->db->where('admin_type_id', 1);
				$this->db->where('status', 1);

				$tbl_membership = $this->db->dbprefix('_admin');
				$row_member = $this->db->get($tbl_membership)->result();

				if($row_member){
					//echo "row_member";
					//Debug($row_member);
				}
				//Debug($this->db->last_query());

				//echo "($admin_username, $name, $lastname, $department, $domain)";
				$email = $admin_username.'@'.$domain;

				$this->add_member($admin_username, $name, $lastname, $email, $department, $domain);
				//Debug($this->db->last_query());

				//die();
				//die();
		}
	}

	function update_member($admin_id, $data){

			if($admin_id > 0){

					$this->db->where('admin_id', $admin_id);
					$this->db->update('_admin', $data);

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
			
	}

function add_member($username, $first_name, $last_name, $email, $department, $domain){

		$this->db->where('admin_username', $username);
		$query = $this->db->get('_admin');
        if($query->num_rows > 0){

        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			echo "Username already taken";
			echo '</strong></div>';

		}else{

			$now_date = date('Y-m-d H:i:s');
			$new_member_data = array(
				'admin_name' => $first_name,
				'admin_lastname' => $last_name,
				'admin_email' => $email,			
				'admin_username' => $username,
				'department' => $department,
				'domain' => $domain,
				'create_date' => $now_date,
				'status' => 1,
				'admin_type_id' => 4
			);
			$insert = $this->db->insert('_admin', $new_member_data);
		    return $insert;
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

		///echo $this->db->last_query();
		//die();
		
/////////////////////////////
              foreach ($query->result_array() as $row){
					$admin['admin_id'] = $row['admin_id'];
					$admin['username']=$row['admin_username'];
                         $admin['password']=$row['admin_password'];
					$admin['admin_type'] = $row['admin_type_id'];
					$admin['name'] = $row['admin_name'];
					$admin['lastname'] = $row['admin_lastname'];
					$admin['email'] = $row['admin_email'];
					$admin['avatar'] = $row['admin_avatar'];
                         $admin['status'] = $row['status'];
                         $admin['domain'] = $row['department'];
                         $admin['department'] = $row['status'];
                        // echo $row['admin_id']; echo '<br>';
                        // echo $row['admin_username']; echo '<br>';
                        // echo $row['admin_password'];echo '<br>';
                        // echo $row['admin_type_id'];echo '<br>';
                        // echo $row['admin_name']; echo '<br>';
                    }
                    return $admin;
			        //return true;
////////////////////////////      
        /*
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
			//return $admin;
			return true;
		}
        */		
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
	}//add_member

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
			//$udata = serialize($row->user_data);
		    $udata = serialize($row->user_data);
			//Debug($udata);
		    /* put data in array using username as key */
		    $user['username'] = $udata['username']; 
		    $user['lastlogin'] = $udata['lastlogin']; 
		}
		return $user;
	}//create_member

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
	      
	}
     
    function lastlogin($admin_id){

		$lastlogin=date('Y-m-d H:i:s');
          $data['lastlogin'] = $lastlogin;
		$this->db->where('admin_id', $admin_id);
		$this->db->update('_admin', $data);
		
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

}

