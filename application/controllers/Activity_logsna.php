<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Activity_logsna extends CI_Controller {

    public function __construct()    {
        parent::__construct();
        // load helper
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Adminna_log_activity_model');
        $this->load->library("pagination");
		//$this->load->library(array('pagination','session'));
		
		$breadcrumb = array();
		//chack login
		if(!$this->session->userdata('is_logged_in')){
			redirect(base_url());
			}
    }
	public function index(){
			$this->listview();
    }
	
	public function listview($pageIndex=1) {
	$startdate = $this->input->get_post('startdate',TRUE);
	$enddate = $this->input->get_post('enddate',TRUE);
	
	$admin_type=(int)$this->session->userdata('admin_type');
	if($admin_type<>1){
		redirect(base_url());
	}
	   // $pagination = $this->session->userdata($segment);
		$language = $this->lang->language;
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		if($admin_type==1){
		$breadcrumb[] = '<a href="'.base_url('activity_logsna/cleardataall').'">'.$language['reset'].'</a>';
		}
		$breadcrumb[] = $language['activity_logs'];
		$webtitle = $language['activity_logs'].' - '.$language['titleweb'];
		//$searchterm = $this->input->get_post('searchterm',TRUE);
		//Debug($ListSelect);
		//die();	
		
		//$segment=$this->uri->segment(3);
		//$segment2=$this->uri->segment(4);
		//$segment=$this->session->userdata($segment);
		// Pagination  
		
		$total_rows= $this->Adminna_log_activity_model->totallogactivity($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){$limit = 200;}else{$limit = $total_rows;}
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination"); //Pagination helper  
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Adminna_log_activity_model->totallogactivity($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/activity_logsna/listview"));
		//$pageConfig=$pageConfig;//.$search_key;
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Adminna_log_activity_model->totallogactivity($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/activity_logsna/listview"));
		}
		//Debug($pageConfig);
		//die();
		//his->load->library("pagination");
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$logs_list = $this->Adminna_log_activity_model->view_log($pageIndex, $limit,$startdate,$enddate);
		}else{
		$logs_list = $this->Adminna_log_activity_model->view_log($pageIndex, $limit);
		}
		
		//$logs_list = $this->Adminna_log_activity_model->view_log($limit,$start * $limit);
		 #Debug($logs_list); die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
 
		 
		 
		$data = array(
					"startdate" => $startdate,
					"enddate" => $enddate,
					"ListSelect" => $ListSelect,
					"logs_list" => $logs_list,
					"webtitle" => $webtitle,
					"pagination" => $links,
					"content_view" => 'tmon/activity_logsna',
					"breadcrumb" => $breadcrumb,
		);
		$this->load->view('template/template',$data);
		 //Debug($data);
		 
		 
	}
	
		
	public function cleardataall(){
			$admin_type=(int)$this->session->userdata('admin_type');
			if($admin_type<>1){
				redirect(base_url());
			}
			$cleardataalld = $this->Adminna_log_activity_model->cleardataall();		
			$language = $this->lang->language;	
          //**************Log activity
          	$language = $this->lang->language;
			$edit = $language['edit'];
			$savedata = $language['savedata'];
               $session_id_admin=$this->session->userdata('admin_id');
               $ref_id=$this->session->userdata('admin_type');
               ########IP#################	
               $ipaddress=$_SERVER['REMOTE_ADDR'];	
               $ipaddress1=$this->ip_address = array_key_exists('HTTP_CLIENT_IP',$_SERVER) ? $_SERVER['HTTP_CLIENT_IP'] : '127.0.0.1';
               $ipaddress2=$this->ip_address = array_key_exists('HTTP_X_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress3=$this->ip_address = array_key_exists('HTTP_X_FORWARDED',$_SERVER) ? $_SERVER['HTTP_X_FORWARDED'] : '0.0.0.0';
               $ipaddress4=$this->ip_address = array_key_exists('HTTP_FORWARDED_FOR',$_SERVER) ? $_SERVER['HTTP_FORWARDED_FOR'] : '0.0.0.0';
               $ipaddress5=$this->ip_address = array_key_exists('HTTP_FORWARDED',$_SERVER) ? $_SERVER['HTTP_FORWARDED'] : '0.0.0.0';
               $ipaddress6=$this->ip_address = array_key_exists('REMOTE_ADDR',$_SERVER) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
               if($ipaddress1!==''){$ipaddress=$ipaddress1;}
               elseif($ipaddress2!==''){$ipaddress=$ipaddress2;}
               elseif($ipaddress3!==''){$ipaddress=$ipaddress3;}
               elseif($ipaddress4!==''){$ipaddress=$ipaddress4;}
               elseif($ipaddress5!==''){$ipaddress=$ipaddress5;}
               elseif($ipaddress6!==''){$ipaddress=$ipaddress6;}
               elseif($ipaddress = '127.0.0.1'||$ipaddress = '::1'){$ipaddress = '127.0.0.1';}else{$ipaddress='UNKNOWN';}
               ########IP#################
               $ref_type=1;
               if($cur_status==1){$cur_statusname='ON';}else{$cur_statusname='OFF';}
               $ref_title='RESET LOG';
               $action=2;
               $create_date=date('Y-m-d H:i:s');
               $status=1;
               $langlog = $language['lang'];
          	 $log_activity = array(
          					"admin_id" => $session_id_admin,
          					"ref_id" => $ref_id,
          					"from_ip" => $ipaddress,
          					"ref_type" => $ref_type,
          					"ref_title" => $ref_title,
          					"action" => $action,
		                         "create_date" => $create_date,
		                         "status" => $status,
		                         "lang"=>$langlog,
          			);		
          	$this->Admin_log_activity_model->store($log_activity);
               //Debug($log_activity); Die();
          //**************Log activity
          redirect('activity_logsna');

	}
	

}