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
class Admin_log_activity_model extends CI_Model{

    public function __construct(){
		parent::__construct();
        //$this->load->database();
    }

    public function get_max_id(){

		$this->db->select('max(admin_log_id) as max_id');
		$this->db->from('_admin_logactivity');
		$query = $this->db->get();
		return $query->result_object(); 

    }

    public function get_status($id){
    
    	$language = $this->lang->language['lang'];
    	$this->db->select('status');
    	$this->db->from('_admin_logactivity');
    	$this->db->where('admin_log_id', $id);
    	$this->db->where('lang', $language);
    	$query = $this->db->get();
    	//echo $this->db->last_query();
    	
    	return $query->result_object();
    }

	public function view_approve($ref_type = 1, $approve_by = 0, &$where2 = array(), $limit = 300){
		
		$language = $this->lang->language['lang'];
		$datenow = date('Y-m-d');
		
		switch($ref_type){
			case 1 : 
					$this->db->select('article_id2 as id, title, "article" AS ref_type, create_date, lastupdate_date, approve_date', FALSE);
					$this->db->from('_article'); 
			break;
			case 2 : 
					$this->db->select('zid2 as id, title, "zodiac" AS ref_type, create_date, lastupdate_date, approve_date', FALSE);
					$this->db->from('_zodiac_list'); 
			break;
			case 3 : 
					$this->db->select('magazine_id2 as id, title, "magazine" AS ref_type, create_date, lastupdate_date, approve_date', FALSE);
					$this->db->from('_magazine'); 
			break;
			case 4 : 
					$this->db->select('instagram_id2 as id, title as title, "instagram" AS ref_type, create_date, lastupdate_date, approve_date', FALSE);
					$this->db->from('_instagram'); 
			break;

		}
		
		if($approve_by > 0) $this->db->where('approve_by', $approve_by);

		$this->db->where('lang', $language);

		if($where2){
				foreach($where2 as $field => $value){
							$this->db->where($field , $value);
				}
		}
		$this->db->order_by('create_date', 'DESC');
		$this->db->limit($limit);

		$query = $this->db->get();

		//Debug($this->db->last_query());
		return $query->result_object();
	}	

    function store($data){
			//Debug($data); Die();
			/*if($admin_log_id > 0){
					$this->db->where('admin_log_id', $admin_log_id);
					$this->db->update('_admin_logactivity', $data);
					$report = array();
					//$report['error'] = $this->db->_error_number();
					//$report['message'] = $this->db->_error_message();
					if($report !== 0){
						//echo $this->db->last_query();
						//die();
						return true;
					}else{
						return false;
					}					
			}else{*/
					$this->db->insert('_admin_logactivity', $data);
					//echo $this->db->last_query();
					$insert = $this->db->insert_id();
					return $insert;
			//}
	}

    function delete($log_id){
			$this->db->delete('_admin_logactivity', array('admin_log_id' => $log_id));
	}

	function status_new($admin_log_id, $enable = 1){

		$data['status'] = $enable;
		$this->db->where('admin_log_id', $admin_log_id);
		$this->db->update('_admin_logactivity', $data);
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

	public function DisplayLogs($id, $type = 1){

			$ListSelect = $this->api_model->user_menu($this->session->userdata('admin_type'));		
			$language = $this->lang->language;

			//if($this->input->server('REQUEST_METHOD') === 'POST'){
					
					/*$data_input = $this->input->get();
					$id = $data_input['id'];
					$type = $data_input['type'];*/

					$datalog = array(
							"ref_type" => $type,
							"ref_id" => $id
					);
					$view_log = $this->view_log(0, $datalog);
					//Debug($view_log);

					if($view_log){

							$alllogs = count($view_log);

							$html = '
							<div class="col-sm-12">
								<div style="min-height: 31px;" class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
															
														<div style="opacity: 1;" class="widget-box widget-color-orange ui-sortable-handle collapsed">
																<div class="widget-header widget-header-small">
																	<h6 class="widget-title">
																		<i class="ace-icon fa fa-sort"></i>
																		'.$language['admin logs activity'].'
																	</h6>

																	<div class="widget-toolbar">
																		<a href="#" data-action="collapse">
																			<i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
																		</a>
																		<a href="#" data-action="close">
																			<i class="ace-icon fa fa-times"></i>
																		</a>
																	</div>
																</div>

																<div style="display: none;" class="widget-body">
																	<div class="widget-main">

								<table id="sample-table-1" class="table table-striped table-bordered table-hover">
																<thead>
																	<tr>
																		<th>ID</th>
																		<th>'.$language['title'].'</th>
																		<th>'.$language['action'].'</th>
																		<th>'.$language['admin'].' '.$language['username'].'</th>
																		<th>'.$language['create_date'].'</th>
																	</tr>
																</thead>
																<tbody>';

									for($i=0;$i<$alllogs;$i++){
												
												$admin_log_id = $view_log[$i]->admin_log_id;

												//$ref_type = $view_log[$i]->ref_type;
												//$ref_id = $view_log[$i]->ref_id;

												$ref_title = $view_log[$i]->ref_title;
												$action = action_view_logs($view_log[$i]->action);
												$admin_username = $view_log[$i]->admin_username;
												$create_date = RenDateTime($view_log[$i]->create_date);

												$html .= "<tr>
															<td>".$admin_log_id."</td>
															<td>".$ref_title."</td>
															<td>".$action."</td>
															<td>".$admin_username."</td>
															<td>".$create_date."</td>
												</tr>";				
									}

									$html .= '</tbody></table>

																	</div>
																</div>
															</div>
														</div>
													</div>';
					}

	}

	public function view_log($kw = '', &$where2 = array(), $status = '', $limit = 9999){
		
		//$where = array();
		$language = $this->lang->language['lang'];

		$this->db->select('al.*, a.admin_username');
		$this->db->from('_admin_logactivity as al');

		$datenow = date('Y-m-d');

		if($kw != ''){
			$this->db->like('ref_title', $kw);
			//$this->db->or_like('al.create_date', $kw, 'right');
		}//else
			//$this->db->like('al.create_date', $datenow, 'right');

		if($status != '') $this->db->where('status', $status);

		//if($id > 0) $this->db->where('admin_log_id', $id);

		//$new_where = array_merge($where2, $where);
		//if($parent != '') $this->db->where('parent', $parent);
		if($where2){
				foreach($where2 as $field => $value){
						$this->db->where($field , $value);
				}
		}
		$this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');

		//if($parent >= 0 && $id == 0) $this->db->where('lang', $language);
		$this->db->order_by('al.admin_log_id', 'DESC');
		//$this->db->order_by('al.create_date', 'DESC');

		//$this->db->limit($limit);

		$query = $this->db->get();

		//Debug($this->db->last_query());
		return $query->result_object();
	}	

	public function CountLogs($userid){
				
				$data_log = array();

				$this->db->select('COUNT(*) as number');
				$this->db->from('_news');
				$this->db->where('lang' , 'th');
				$this->db->where('status' , 1);
				$this->db->where('approve' , 1);
				$this->db->where('create_by' , $userid);
				$query = $this->db->get();
				$result_new = $query->result_object();
				$data_log['news'] = $result_new[0]->number;

				unset($result_new);
				$this->db->select('COUNT(*) as number');
				$this->db->from('_column');
				$this->db->where('lang' , 'th');
				$this->db->where('status' , 1);
				$this->db->where('approve' , 1);
				$this->db->where('create_by' , $userid);
				$query = $this->db->get();
				$result_new = $query->result_object();
				$data_log['column'] = $result_new[0]->number;

				unset($result_new);
				$this->db->select('COUNT(*) as number');
				$this->db->from('_gallery');
				$this->db->where('lang' , 'th');
				$this->db->where('status' , 1);
				$this->db->where('approve' , 1);
				$this->db->where('create_by' , $userid);
				$query = $this->db->get();
				$result_new = $query->result_object();
				$data_log['gallery'] = $result_new[0]->number;

				unset($result_new);
				$this->db->select('COUNT(*) as number');
				$this->db->from('_video');
				$this->db->where('lang' , 'th');
				$this->db->where('status' , 1);
				$this->db->where('approve' , 1);
				$this->db->where('create_by' , $userid);
				$query = $this->db->get();
				$result_new = $query->result_object();
				$data_log['video'] = $result_new[0]->number;

				unset($result_new);
				$this->db->select('COUNT(*) as number');
				$this->db->from('_dara_profile');
				$this->db->where('lang' , 'th');
				$this->db->where('status' , 1);
				$this->db->where('approve' , 1);
				$this->db->where('create_by' , $userid);
				$query = $this->db->get();
				$result_new = $query->result_object();
				$data_log['dara'] = $result_new[0]->number;

				return $data_log;

	}
	////////////////////
	/////////////////////
	/////////////////////
	public function view_log2($id = 0, &$where2 = array(), $status = ''){
		
		//$where = array();
		$admin_type_id='1';
		$language = $this->lang->language['lang'];
		$this->db->start_cache();
		$this->db->select('al.*, a.admin_username');
		$this->db->from('_admin_logactivity as al');
		$this->db->where('admin_type_id >', $admin_type_id);
		if($status != '') $this->db->where('status', $status);
		if($id > 0) $this->db->where('al.admin_log_id', $id);

		//$new_where = array_merge($where2, $where);
		//if($parent != '') $this->db->where('parent', $parent);
		if($where2){
				foreach($where2 as $field => $value){
							$this->db->where($field , $value);
				}
		}
		$this->db->join('_admin as a', 'al.admin_id = a.admin_id', 'left');

		//if($parent >= 0 && $id == 0) $this->db->where('lang', $language);
		

		$this->db->order_by('create_date', 'DESC');
		$this->db->stop_cache();
		$query = $this->db->get();

	 
		  
		return $query->result_object();
	}
	
}