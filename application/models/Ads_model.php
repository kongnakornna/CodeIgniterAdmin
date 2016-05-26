<?php
class Ads_model extends CI_Model {
 
    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_status($id){
    	//$language = $this->lang->language['lang'];
    	$this->db->select('status');
    	$this->db->from('_ads');
    	$this->db->where('ads_id', $id);
    	//$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	return $query->result_array();
    }
        
    public function get_max_order(){
		//$language = $this->lang->language['lang'];
		$this->db->select('max(order_by) as max_order');
		$this->db->from('_ads');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_max_id(){
		//$language = $this->lang->language['lang'];
		$this->db->select('max(ads_id) as max_id');
		$this->db->from('_ads');
		//$this->db->where('lang', $language);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function validate_adss($keyword){
    
		$this->db->select('*');
		$this->db->from('_ads');
		$this->db->where('tag_text', trim($keyword));
		$query = $this->db->get();		
		//echo $this->db->last_query();
		return $query->result_object(); 
		
    }
    
    public function getSelect($default = 0,$name = "ads_id"){
    		
    		//$language = $this->lang->language;    		
			//$first = "--- ".$language['please_select']." ---";
    		
	    	$rows = $this->get_content_all();
	    	
	    	$opt = array();
	    	//$opt[]	= makeOption(0,$first);
	    	for($i=0;$i<count($rows);$i++){
	    		$row = @$rows[$i];
	    		$opt[]	= makeOption($row['ads_id'], $row['tag_text']);
	    	}
	    	//return selectList( $opt, $name, 'class="chosen-select"', 'value', 'text',$default);
	    	return MultiSelectList( $opt, $name, 'class="chosen-select"', 'value', 'text',$default);
    }
     
   public function get_content_all(){

		//$language = $this->lang->language['lang'];
		$this->db->select('_ads.*, _category.category_name, _subcategory.subcategory_name');
		$this->db->from('_ads');
		$this->db->join('_category', '_ads.category_id = _category.category_id', 'left');
		$this->db->join('_subcategory', '_ads.subcategory_id = _subcategory.subcategory_id', 'left');

		//$this->db->where('ads_id', $ads_id);

		//$this->db->where('lang', $language);
		$query = $this->db->get();		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

   public function get_content_id($ads_id){

		$prefix = 'sd';
		$this->db->select('a.*, _category.category_name, _subcategory.subcategory_name');

		if($ads_id){
				$this->db->select('(SELECT `'.$prefix.'_admin`.`admin_username` FROM `'.$prefix.'_admin` WHERE `'.$prefix.'_admin`.`admin_id`=a.`create_by`) AS create_by_name', false);
				$this->db->select('(SELECT `'.$prefix.'_admin`.`admin_username` FROM `'.$prefix.'_admin` WHERE `'.$prefix.'_admin`.`admin_id`=a.`lastupdate_by`) AS lastupdate_by_name', false);
		}

		$this->db->from('_ads a');
		$this->db->join('_category', 'a.category_id = _category.category_id', 'left');
		$this->db->join('_subcategory', 'a.subcategory_id = _subcategory.subcategory_id', 'left');
		$this->db->where('ads_id', $ads_id);

		$query = $this->db->get();		
		//echo $this->db->last_query();
		return $query->result_array(); 

    }

    public function get_content($tag_status=null, $order_by='ads_id', $order_type='Asc', $limit_start = 0, $listpage = 20){
		
		//$language = $this->lang->language['lang'];
		$this->db->select('_ads.ads_id');
		$this->db->select('_ads.tag_text');
		$this->db->select('_ads.create_date');
		$this->db->select('_ads.status');
		$this->db->from('_ads');

		/*if($ads_id != null && $ads_id > 0){
			$this->db->where('ads_id', $ads_id);
		}*/

		/*if($search_string){
			$this->db->like('tag_text', $search_string);
		}*/
		//if($ads_id){
			//$this->db->where('status', $cat_status);
		//}

		//$this->db->where('lang', $language);
		$this->db->order_by($order_by, $order_type);
		$this->db->limit($listpage, $limit_start);
		//$this->db->query('SELECT * FROM `sd_ads`');

		$query = $this->db->get();
		//$this->db->last_query();
		//Debug($this->db->get());
		return $query->result_array();
    }

    function count_ads($ads_id=null, $search_string=null, $order=null){

		$this->db->select('*');
		$this->db->from('_ads');
		if($ads_id != null && $ads_id != 0){
			$this->db->where('ads_id', $ads_id);
		}
		if($search_string){
			$this->db->like('tag_text', $search_string);
		}

		if($order){
			$this->db->order_by($order, 'Asc');
		}

		$query = $this->db->get();
		return $query->num_rows();        
    }

    function store($id = 0, $data){

			if($id > 0){
					$this->db->where('ads_id', $id);
					$this->db->update('_ads', $data);
					
					//Debug($this->db->last_query());

					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//echo $this->db->last_query();
						return true;
					}else{
						return false;
					}					
			}else{
					$insert = $this->db->insert('_ads', $data);
					//echo $this->db->last_query();
					return $insert;
			}
	}

	function status_adss($ads_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('ads_id', $ads_id);
		$this->db->update('_ads', $data);
				
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	

	function status_ads($ads_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('ads_id', $ads_id);
		$this->db->update('_ads', $data);
		//echo $this->db->last_query();
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}	
	
    function delete_ads($ads_id){

		$data = array(
				'status' => 2
		);
		$this->db->where('ads_id', $ads_id);
		$this->db->update('_ads', $data);
		
		$report = array();
		//$report['error'] = $this->db->_error_number();
		//$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

	function delete_ads_by_admin($ads_id){
		$this->db->where('ads_id', $ads_id);
		$this->db->delete('_ads'); 
	}
 
}
?>	
