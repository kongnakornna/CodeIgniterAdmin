<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MenuFactory {

	private $_ci;
 	function __construct(){
    	//When the class is constructed get an instance of codeigniter so we can access it locally
    	$this->_ci =& get_instance();
    	//Include the user_model so we can use it
		$this->_ci->load->model('menu_model');
    }

    public function getMenu($parent = 0 ,$id = 0, $admin_type = 0) {
    	//Are we getting an individual user or are we getting them all
//echo ' $parent='.$parent.' $id='.$id.' $admin_type='.$admin_type; Die();
		$lang = $this->_ci->lang->language['lang'];
		$status = 1;
		$row = array();
		
    	if ($admin_type > 1) {
/*
    		//Getting an individual user
    		//$query = $this->_ci->db->get_where("_admin_menu", array("admin_menu_id" => $id, "parent" => $parent, "status" => $status, "lang" => $lang));
    		
    		$sql = 'SELECT
			sd_admin_menu.admin_menu_id,	 sd_admin_menu.admin_menu_id2,
			sd_admin_menu.title, sd_admin_menu.url,	sd_admin_menu.parent,	sd_admin_menu.order_by,
			sd_admin_menu.status,	sd_admin_menu.lang,	sd_admin_access_menu.admin_access_id,
			sd_admin_access_menu.admin_type_id
			FROM sd_admin_menu Inner Join sd_admin_access_menu ON (sd_admin_access_menu.admin_menu_id = sd_admin_menu.admin_menu_id2 AND sd_admin_menu.status = 1)
			WHERE admin_type_id='.$admin_type;
    		
    		$query = $this->_ci->db->query($sql);
			//Debug($this->_ci->db->last_query());
			
    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Pass the data to our local function to create an object for us and return this new object
    			foreach ($query->result() as $data) {
    				if($lang == $data->lang) $row[] = $data;
    			}
    			
    			//Debug($query->row());
    			//Debug($row);
    			//die();
    			return $row;
    			//return $this->createObjectFromData($query->row());
    		}
    		return false;
*/

/////////////////////////////////////////////////
           
    		//Getting all the users
		$orderby = "order_by";
    		$query = $this->_ci->db->select("*")->from("_admin_menu")->where('admin_menu_id2<>','27')->where(array("parent" => $parent, "status" => $status, "lang" => $lang))->order_by($orderby, 'ASC')->get();
			 //echo $this->_ci->db->last_query();

    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users = array();
    			//Loop through each row returned from the query
    			
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users[] = $this->createObjectFromData($row);
    			}
    			
    			/*foreach ($query->result() as $data) {
    				if($lang == $data->lang) $row[] = $data;
    			}*/
    			    			
    			//Return the users array
    			//Debug($users);
    			//die();
    			return $users;
    		}
    		return false;
/////////////////////////////////////////////////
    	}else{
    		
    		//Getting all the users
			$orderby = "order_by";
    		$query = $this->_ci->db->select("*")->from("_admin_menu")->where(array("parent" => $parent, "status" => $status, "lang" => $lang))->order_by($orderby, 'ASC')->get();
			//echo $this->_ci->db->last_query();

    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users = array();
    			//Loop through each row returned from the query
    			
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users[] = $this->createObjectFromData($row);
    			}
    			
    			/*foreach ($query->result() as $data) {
    				if($lang == $data->lang) $row[] = $data;
    			}*/
    			    			
    			//Return the users array
    			//Debug($users);
    			//die();
    			return $users;
    		}
    		return false;
    	}
    }
    
    public function createObjectFromData($row){

			$menus = new Menu_Model();
			$menus->setObj($row);
			return $menus;
    }
    
    public function getMenuParem($id = 0) {
    		$lang = $this->_ci->lang->language['lang'];
    		$status = 1;
    		$query = $this->_ci->db->select("*")->from("_admin_menu")->where(array("admin_menu_id2" => $id))->get();
    		return $query->result();
    }

    public function getAccessMenu($id = 0) {
    		//SELECT * FROM `Siamdara`.`sd_admin_access_menu` WHERE `admin_type_id` = '2' LIMIT 0, 100;
    		$lang = $this->_ci->lang->language['lang'];
    		$status = 1;

    		$orderby = "admin_menu_id";
    		$query = $this->_ci->db->select("*")->from("_admin_access_menu")->where(array("admin_type_id" => $id))->order_by($orderby, 'ASC')->get();
    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users_access = array();
    			//Loop through each row returned from the query
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users_access[] = $row;
    			}
    			//Return the users array
    			return $users_access;
    		}
    		return false;    	 
    }

    public function updateMenu($obj = array()){

				/*echo "<pre>";
				print_r($obj);
				echo "</pre>";*/
				//echo "did = ".$obj['did'];

				/*$this->_ci->db
					->set('cover', 'CASE WHEN `image_id` = $is_cover THEN 1 ELSE 0 END', FALSE)
					->where('album_id', $album_id)
					->update('images');*/

				//$data=array('last_login'=>current_login,'current_login'=>date('Y-m-d H:i:s'));

				$this->_ci->db->where('admin_menu_id2',$obj['admin_menu_id2']);
				$this->_ci->db->update('_admin_menu',$obj);

    		//return false;	
	
	}
	
	public function accessMenu($obj){
	
		$i=0;
		$this->_ci->db->where('admin_type_id', $obj[0]['admin_type_id']);
		$this->_ci->db->delete('_admin_access_menu');
		$this->_ci->db->insert_batch("_admin_access_menu",$obj);		
	}

    public function getSearch($keyword = "") {

			//$orderby = "did";
			$orderby = "admin_menu_id2";

			$this->_ci->db->from('_admin_menu');
			//$this->_ci->db->from('_products');
			//$this->_ci->db->join('_products', 'thc_domains.domain = thc_products.domian ', 'left');

			$this->_ci->db->order_by($orderby, 'ASC');
			//$this->_ci->db->limit(25, 0);
			$this->_ci->db->select('*');

			if ($keyword){

				   $searchkey = "(`title` like '%$keyword%')";

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
    			$uses = array();
    			//Loop through each row returned from the query
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$uses[] = $this->createObjectFromData($row);
    			}
    			//Return the users array
    			return $uses;
    		}
    		return false;	
	}

	public function getMenu2($parent = 0 ,$id = 0, $admin_type = 0) {
    	//Are we getting an individual user or are we getting them all
     echo'parent='.$parent;;echo'id='.$id;echo'admin_type='.$admin_type;
	 Die();
		$lang = $this->_ci->lang->language['lang'];
		$status = 1;
		$row = array();
		
    	if ($admin_type > 1) {

    		//Getting an individual user
    		//$query = $this->_ci->db->get_where("_admin_menu", array("admin_menu_id" => $id, "parent" => $parent, "status" => $status, "lang" => $lang));
    		
    		$sql = 'SELECT
			sd_admin_menu.admin_menu_id,	 sd_admin_menu.admin_menu_id2,
			sd_admin_menu.title, sd_admin_menu.url,	sd_admin_menu.parent,	sd_admin_menu.order_by,
			sd_admin_menu.status,	sd_admin_menu.lang,	sd_admin_access_menu.admin_access_id,
			sd_admin_access_menu.admin_type_id
			FROM sd_admin_menu Inner Join sd_admin_access_menu ON (sd_admin_access_menu.admin_menu_id = sd_admin_menu.admin_menu_id2 AND sd_admin_menu.status = 1)
			WHERE admin_type_id='.$admin_type;
    		
    		$query = $this->_ci->db->query($sql);
			//Debug($this->_ci->db->last_query());
			
    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Pass the data to our local function to create an object for us and return this new object
    			foreach ($query->result() as $data) {
    				if($lang == $data->lang) $row[] = $data;
    			}
    			
    			//Debug($query->row());
    			//Debug($row);
    			//die();
    			return $row;
    			//return $this->createObjectFromData($query->row());
    		}
    		return false;
    	} else {
    		
    		//Getting all the users
			$orderby = "order_by";
    		$query = $this->_ci->db->select("*")->from("_admin_menu")->where(array("parent" => $parent, "status" => $status, "lang" => $lang))->order_by($orderby, 'ASC')->get();
			//echo $this->_ci->db->last_query();

    		//Check if any results were returned
    		if ($query->num_rows() > 0) {
    			//Create an array to store users
    			$users = array();
    			//Loop through each row returned from the query
    			
    			foreach ($query->result() as $row) {
    				//Pass the row data to our local function which creates a new user object with the data provided and add it to the users array
    				$users[] = $this->createObjectFromData($row);
    			}
    			
    			/*foreach ($query->result() as $data) {
    				if($lang == $data->lang) $row[] = $data;
    			}*/
    			    			
    			//Return the users array
    			//Debug($users);
    			//die();
    			return $users;
    		}
    		return false;
    	}
    }
    
}