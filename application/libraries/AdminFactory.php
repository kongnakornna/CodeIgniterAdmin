<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AdminFactory {

	private $_ci;
 	function __construct(){
    	//When the class is constructed get an instance of codeigniter so we can access it locally
    	$this->_ci =& get_instance();
    	//Include the user_model so we can use it
		$this->_ci->load->model('Admin_model');
    }


	public function getAdminTypena($id = 0, $admin_type = 0) {

    	if ($id > 0){

			/*$this->_ci->db->from('_admin_access_menu as am');
			$this->_ci->db->from('_admin_type as at');
			//$this->_ci->db->limit(1, 0);
			$this->_ci->db->select('am.*, at.admin_type_title');
			$where = "at.admin_type_id = am.admin_type_id AND at.admin_type_id = $id";
			$this->_ci->db->where($where);*/

			/*$this->_ci->db->select('*');
			$this->_ci->db->from('_admin_type');
			$this->_ci->db->where('admin_type_id', $id);*/

			$sql = 'SELECT at.*, aam.`admin_access_id`, aam.`admin_menu_id` AS access_menu, am.`admin_menu_id2`, am.`title`,am.`parent` 
			FROM `sd_admin_type` AS `at`
			LEFT JOIN `sd_admin_access_menu` aam ON (at.`admin_type_id`=aam.`admin_type_id` AND at.`status`=1)
			LEFT JOIN `sd_admin_menu` am ON (aam.`admin_menu_id`= am.`admin_menu_id2` AND am.`status`=1)
			WHERE at.`admin_type_id` = '.$id;
			 echo $sql;

			$query = $this->_ci->db->query($sql);
			//$query = $this->_ci->db->get();
			 Debug($this->_ci->db->last_query());

    		if ($query->num_rows() > 0) {
    			return $query->row();
    		}
    		return false;
    	} else {
    		//Getting all the users
			$orderby = "admin_type_id";

			if($admin_type == 0)
	    		$query = $this->_ci->db->select("*")->from("_admin_type")->order_by($orderby, 'ASC')->get();
			else
	    		$query = $this->_ci->db->select("*")->from("_admin_type")->where("admin_type_id >=", $admin_type)->order_by($orderby, 'ASC')->get();

			//Debug($this->_ci->db->last_query());
    		if ($query->num_rows() > 0) {
    			$users = array();
    			foreach ($query->result() as $row) {
    				$users[] = $row;
    			}
    			return $users;
    		}
    		return false;
    	}
	}
     
	public function getAdminType($id = 0,$admin_id=0) {
    	if ($id > 0) {

			/*$this->_ci->db->from('_admin_access_menu as am');
			$this->_ci->db->from('_admin_type as at');
			//$this->_ci->db->limit(1, 0);
			$this->_ci->db->select('am.*, at.admin_type_title');
			$where = "at.admin_type_id = am.admin_type_id AND at.admin_type_id = $id";
			$this->_ci->db->where($where);*/

			/*$this->_ci->db->select('*');
			$this->_ci->db->from('_admin_type');
			$this->_ci->db->where('admin_type_id', $id);*/

			$sql = 'SELECT at.*, aam.`admin_access_id`, aam.`admin_menu_id` AS access_menu, am.`admin_menu_id2`, am.`title`,am.`parent` 
			FROM `sd_admin_type` AS `at`
			LEFT JOIN `sd_admin_access_menu` aam ON (at.`admin_type_id`=aam.`admin_type_id` AND at.`status`=1)
			LEFT JOIN `sd_admin_menu` am ON (aam.`admin_menu_id`= am.`admin_menu_id2` AND am.`status`=1)
			WHERE at.`admin_type_id` = '.$id;
			//echo $sql;

			$query = $this->_ci->db->query($sql);
			//$query = $this->_ci->db->get();
			 //echo $this->_ci->db->last_query();Die();
    		if ($query->num_rows() > 0) {
    			return $query->row();
    		}
    		return false;
    	} else {
              
               $admin_type=$this->_ci->session->userdata('admin_type');
              //echo '$admin_type='.$admin_type;Die();
              //echo '$admin_id='.$admin_id;Die();
    		    //Getting all the users
			$orderby = "admin_type_id";
$queryna1 = $this->_ci->db->select("*")->from("_admin_type")->where($orderby.'>', '2')->order_by($orderby, 'ASC')->get();
$queryna2 = $this->_ci->db->select("*")->from("_admin_type")->order_by($orderby, 'ASC')->order_by($orderby, 'ASC')->get();
           
           if($admin_type==1){
               $query = $this->_ci->db->select("*")->from("_admin_type")->order_by($orderby, 'ASC')->get();
           }else if($admin_id>1){
                $query = $queryna1;
           }else{
                $query = $queryna2;
           }
          
          //Debug($query);Die();
    		

    		if ($query->num_rows() > 0) {
    			$users = array();
    			foreach ($query->result() as $row) {
    				$users[] = $row;
    			}
    			return $users;
    		}
    		return false;
    	}
	}
    
	public function get_status($id = 0) {
			$this->_ci->db->select('status');
			$this->_ci->db->from('_admin');
    		$this->_ci->db->where(array("admin_id" => $id));
			$query = $this->_ci->db->get();
			//echo $this->_ci->db->last_query();    	
			return $query->result_array();
	}

	function status_admin($id, $enable = 1){

		$data['status'] = $enable;
		$this->_ci->db->where('admin_id', $id);
		$this->_ci->db->update('_admin', $data);
		//echo $this->_ci->db->last_query();
		$report = array();
		$report['error'] = $this->_ci->db->_error_number();
		$report['message'] = $this->_ci->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	

     public function getAdminna($id = 0, $search_string = null, $admin_type_id = null) {
         	//Are we getting an individual user or are we getting them all
          $admin_typena=$this->_ci->session->userdata('admin_type');
          //echo '$id='.$id; Die();
           //echo '$admin_type_id='.$admin_type_id; Die();
          //echo '$admin_typena='.$admin_typena;die();
         	if ($id > 0) {
     			
         		//Getting an individual user
     			if($admin_typena > 1){
     				if($admin_type_id == '')
     	    			$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id !=" => 1));  
     				else
     	    			$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id !=" => 1, "admin_type_id" => $admin_type_id));
     			}else{
     				if($admin_type_id == '')
     					$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id));
     				else
     					$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id" => $admin_type_id));
     			}

     			/*if(($this->_ci->uri->segment(1) == "user") && ($this->uri->segment(1) == "profile"))
         			$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id));
     			else
     				$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id !=" => 1));*/

     			/*$this->_ci->db->from('_admin');
     			$this->_ci->db->from('_admin_type');
     			$this->_ci->db->limit(1, 0);
     			$this->_ci->db->select('_admin.*, `_admin_type`.admin_type_title');
     			$where = "_admin.admin_type_id = `_admin_type`.admin_type_id AND _admin.admin_id = $id";
     			$this->_ci->db->where($where);
     			$query = $this->_ci->db->get();*/

     			//Debug($this->_ci->db->last_query());

         		//Check if any results were returned
         		if ($query->num_rows() > 0) {
         			//Pass the data to our local function to create an object for us and return this new object
         			return $this->createObjectFromData($query->row());
         		}
         		return false;
         	} else {
         		//Getting all the users
                     //echo '$admin_type_id='.$admin_type_id; Die();
     			$orderby = "admin_id";
     			if($search_string){
     				//$this->_ci->db->like('admin_name', $search_string);
     				//$this->_ci->db->or_like('admin_lastname', $search_string);
     				//$this->_ci->db->or_like('admin_username', $search_string);
     				//$this->_ci->db->or_like('admin_email', $search_string);

     				$query = $this->_ci->db->select("*")->from("_admin")->like('admin_name', $search_string)->or_like('admin_lastname', $search_string)->or_like('admin_username', $search_string)->or_like('admin_email', $search_string)->where("admin_type_id !=", 1)->order_by($orderby, 'ASC')->get();

     			}else{
                       // echo 'admin_type_id='.$admin_type_id; Die();  
$query1 = $this->_ci->db->select("*")->from("_admin")->order_by($orderby, 'ASC')->get();
$query2 = $this->_ci->db->select("*")->from("_admin")->where("admin_type_id", $admin_type_id)->order_by($orderby, 'ASC')->get();                     
$query3 = $this->_ci->db->select("*")->from("_admin")->where("admin_type_id !=", 1)->order_by($orderby, 'ASC')->get();
$query4 = $this->_ci->db->select("*")->from("_admin")->where("admin_type_id !=", 1)->where("admin_type_id", $admin_type_id)->order_by($orderby, 'ASC')->get();
                        if($admin_typena==1){
                           if($admin_type_id == '' || $admin_type_id==0){$query = $query1;}else{$query = $query2;}	  
                        }else{
                         if($admin_type_id == '' || $admin_type_id==0){$query = $query3;}else{$query = $query4;}  
                        }
     				
     					

     				//$query = $this->_ci->db->select("*")->from("_admin as a")->join("_admin_type as t", "a.admin_type_id=t.admin_type_id")->order_by($orderby, 'ASC')->get();			
     			}

     			 // $this->_ci->db->query();
     			 //Debug($this->_ci->db->last_query());

         		//Check if any results were returned
         		if ($query->num_rows() > 0) {
         			//Create an array to store users
         			$users = array();
         			//Loop through each row returned from the query
         			foreach ($query->result() as $row) {
         				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
         				$users[] = $this->createObjectFromData($row);
         			}

     				//Debug($this->_ci->db->last_query());
         			//Return the users array
         			return $users;
         		}

         		return false;
         	}
         }     

    public function createObjectFromData($row){

			$admins = new Admin_Model();
			$admins->setObj($row);
			return $admins;
    }

    public function getAdmin($id = 0, $search_string = null,$admin_type_id= null) {
    	//Are we getting an individual user or are we getting them all
		 // echo '$admin_type_id ='.$admin_type_id ;Die();
           //echo '$id ='.$id;Die();
    	if ($id > 0) { 
          /////
        if($id==1 || $admin_type_id == ''){ 
         //echo '$id ='.$id;Die();
         if($admin_type_id == '')
					$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id));
				else
					$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id" => $admin_type_id));
			 
        
         //echo '$id ='.$id; echo '$query ='.$query; Die();
    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Pass the data to our local function to create an object for us and return this new object
    			return $this->createObjectFromData($query->row());
    		}  
         ///////   
         }else if($id>1 || $admin_type_id <> ''){
    		//Getting an individual user
    		$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id, "admin_type_id !=" => 1));

			/*$this->_ci->db->from('_admin');
			$this->_ci->db->from('_admin_type');
			$this->_ci->db->limit(1, 0);
			$this->_ci->db->select('_admin.*, `_admin_type`.admin_type_title');
			$where = "_admin.admin_type_id = `_admin_type`.admin_type_id AND _admin.admin_id = $id";
			$this->_ci->db->where($where);
			$query = $this->_ci->db->get();*/

    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Pass the data to our local function to create an object for us and return this new object
    			return $this->createObjectFromData($query->row());
    		}
          }
              
              
    		return false;
    	} else {
    		//Getting all the users
			$orderby = "admin_id";

			if($search_string){
				//$this->_ci->db->like('admin_name', $search_string);
				//$this->_ci->db->or_like('admin_lastname', $search_string);
				//$this->_ci->db->or_like('admin_username', $search_string);
				//$this->_ci->db->or_like('admin_email', $search_string);

				$query1 = $this->_ci->db->select("*")->from("_admin")->like('admin_name', $search_string)->or_like('admin_lastname', $search_string)->or_like('admin_username', $search_string)->or_like('admin_email', $search_string)->order_by($orderby, 'ASC')->get();
				$query2 = $this->_ci->db->select("*")->from("_admin")->like('admin_name', $search_string)->or_like('admin_lastname', $search_string)->or_like('admin_username', $search_string)->or_like('admin_email', $search_string)->where("admin_type_id !=", 1)->order_by($orderby, 'ASC')->get();
			    $query3 = $this->_ci->db->select("*")->from("_admin")->like('admin_name', $search_string)->or_like('admin_lastname', $search_string)->or_like('admin_username', $search_string)->or_like('admin_email', $search_string)->where("admin_type_id >=", 3)->order_by($orderby, 'ASC')->get();
				if($admin_type_id==1){$query=$query1;}else if($admin_type_id==2){$query=$query2;}else{$query=$query3;}	
			}else{
			$query1 = $this->_ci->db->select("*")->from("_admin")->order_by($orderby, 'ASC')->get();
			$query2 = $this->_ci->db->select("*")->from("_admin")->where("admin_type_id !=", 1)->order_by($orderby, 'ASC')->get();
			$query3 = $this->_ci->db->select("*")->from("_admin")->where("admin_type_id >=", 3)->order_by($orderby, 'ASC')->get();
			$query4 = $this->_ci->db->select("*")->from("_admin as a")->join("_admin_type as t", "a.admin_type_id=t.admin_type_id")->order_by($orderby, 'ASC')->get();	
			if($admin_type_id==1){$query=$query1;}else if($admin_type_id==2){$query=$query2;}else{$query=$query3;}	
			}

    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users = array();
    			//Loop through each row returned from the query
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users[] = $this->createObjectFromData($row);
    			}
    			//Return the users array
    			return $users;
    		}

    		return false;
    	}
    }

    public function addAdmin($obj){
				$this->_ci->db->where('admin_id',$obj['admin_id']);
				$this->_ci->db->insert('_admin',$obj);
	}

    public function updateAdmin($obj){
				$this->_ci->db->where('admin_id',$obj['admin_id']);
				$this->_ci->db->update('_admin',$obj);
                    //Debug($obj);Die();
                    	
	}

    public function deleteAdmin($obj){
				$this->_ci->db->where('admin_id',$obj['admin_id']);
				$this->_ci->db->update('_admin',$obj);	
	}

    public function getDelAdmin($id = 0, $search_string = null) {
    	//Are we getting an individual user or are we getting them all
    	if ($id > 0) {

    		$query = $this->_ci->db->get_where("_admin", array("admin_id" => $id));
    		if ($query->num_rows() > 0) {
    			return $this->createObjectFromData($query->row());
    		}
    		return false;
    	} else {
			$orderby = "admin_id";

			if($search_string){
				$query = $this->_ci->db->select("*")->from("_admin")->like('admin_name', $search_string)->or_like('admin_lastname', $search_string)->or_like('admin_username', $search_string)->or_like('admin_email', $search_string)->where('status', 2)->order_by('lastupdate_date', 'DESC')->get();
			}else{
				$query = $this->_ci->db->select("*")->from("_admin")->where('status', 2)->order_by('lastupdate_date', 'DESC')->get();
			}
			//Debug($this->_ci->db->last_query()); 

    		if ($query->num_rows() > 0) {
    			$users = array();
    			foreach ($query->result() as $row) {
    				$users[] = $this->createObjectFromData($row);
    			}
    			return $users;
    		}
    		return false;
    	}
    }

	function delete_by_admin($id){
		$this->_ci->db->where('admin_id', $id);
		$this->_ci->db->delete('_admin'); 
	}

    public function getSearch($keyword = "") {

			//$orderby = "did";
			$orderby = "admin_id";

			$this->_ci->db->from('_admin');
			//$this->_ci->db->from('_products');
			//$this->_ci->db->join('_products', 'thc_domains.domain = thc_products.domian ', 'left');

			$this->_ci->db->order_by($orderby, 'ASC');
			//$this->_ci->db->limit(25, 0);
			$this->_ci->db->select('*');

			if ($keyword){

				   $searchkey = "(`admin_name` like '%$keyword%' OR `admin_email` like '%$keyword%' OR `admin_username` like '%$keyword%')";

				   //$this->_ci->db->like('domain', $keyword);
				   //$this->_ci->db->or_like('register_date', $keyword);
				   //$this->_ci->db->or_like('expire_date', $keyword);
				   //$this->_ci->db->or_like('nextdue_date', $keyword);
			 }

			//$where = "_products`.`domian` = `thc_domains`.`domain` $searchkey";
			$where = $searchkey;
			$this->_ci->db->where($where);

			$query = $this->_ci->db->get();  


    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users = array();
    			//Loop through each row returned from the query
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users[] = $this->createObjectFromData($row);
    			}
    			//Return the users array
    			return $users;
    		}
    		return false;	
	}

}