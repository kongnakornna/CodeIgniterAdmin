<?php
/**
 * Includes the User_Model class as well as the required sub-classes
 * @package codeigniter.application.models
 */

/**
 * User_Model extends codeigniters base CI_Model to inherit all codeigniter magic!
 * @author Leon Revill
 * @package codeigniter.application.models
 */
class Menu_Model extends CI_Model
{
	/*
	* A private variable to represent each column in the database
	*/
	public $_admin_menu_id;
	public $_admin_menu_id2;
	public $_title;
	public $_url;
	public $_parent;
	public $_admin_menu_alt;
	public $_option;
	public $_create_date;
	public $_create_by;
	public $_lastupdate_date;
	public $_lastupdate_by;
	public $_order_by;
	public $_icon;
	public $_params;
	public $_lang;
	public $_status;

	//public $_admin_type_title;

	function __construct(){
		parent::__construct();
	}

	/*
	* SET's & GET's
	* Set's and get's allow you to retrieve or set a private variable on an object
	*/
	public function setObj($value){
		$this->_admin_menu_id = $value->admin_menu_id;
		$this->_admin_menu_id2 = $value->admin_menu_id2;
		$this->_title = $value->title;
		$this->_url = $value->url;
		$this->_parent = $value->parent;
		$this->_admin_menu_alt = $value->admin_menu_alt;
		$this->_option = $value->option;
		$this->_create_date = $value->create_date;
		$this->_create_by = $value->create_by;
		$this->_lastupdate_date = $value->lastupdate_date;
		$this->_lastupdate_by = $value->lastupdate_by;
		$this->_order_by = $value->order_by;
		$this->_icon = $value->icon;
		$this->_params = $value->params;
		$this->_lang = $value->lang;
		$this->_status = $value->status;

		//$this->_admin_type_title = $value->admin_type_title;
	}

	public function getObj(){
		return $this;
	}
	public function getMenu(){
		return $this->_admin_menu_id;
	}

	/**
	*	Commit method, this will comment the entire object to the database
	*/
	public function commit()
	{
		$data = array(
			'title' => $this->_title,
			'url' => $this->_url,
			'parent' => $this->_parent,
			'admin_menu_alt' => $this->_admin_menu_alt,
			'option' => $this->option,
			'lastupdate_date' => $this->_lastupdate_date,
			'lastupdate_by' => $this->_lastupdate_by,
			'order_by' => $this->_order_by,
			'status' => $this->_status
		);

		if ($this->admin_menu_id > 0) {
			//We have an ID so we need to update this object because it is not new
			if ($this->db->update("_admin_menu", $data, array("admin_menu_id" => $this->_admin_menu_id))) {
				return true;
			}
		} else {
			//We dont have an ID meaning it is new and not yet in the database so we need to do an insert
			if ($this->db->insert("_admin_menu", $data)) {
				//Now we can get the ID and update the newly created object
				$this->_admin_menu_id = $this->db->insert_id();
				return true;
			}
		}
		return false;
	}
	
}