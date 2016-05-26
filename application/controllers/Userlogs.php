<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Userlogs extends CI_Controller {

    public function __construct()    {
        parent::__construct();
        // load helper
		$this->load->helper('url');
	     $this->load->library('session');
          $this->load->model('Userlogsna_activity_model');
          $this->load->library("pagination");
		//$this->load->library(array('pagination','session'));
		$admin_id= $this->session->userdata('admin_id');
          $admin_type=$this->session->userdata('admin_type');
          
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
	
	   // $pagination = $this->session->userdata($segment);
		$language = $this->lang->language;
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type'));
		$breadcrumb[] = $language['activity_logs'];
		$webtitle = $language['activity_logs'].' - '.$language['titleweb'];
		//$searchterm = $this->input->get_post('searchterm',TRUE);
		//Debug($ListSelect);
		//die();	
		
		//$segment=$this->uri->segment(3);
		//$segment2=$this->uri->segment(4);
		//$segment=$this->session->userdata($segment);
		// Pagination  
		$total_rows= $this->Userlogsna_activity_model->totallogactivity($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){$limit = 100;}else{$limit = $total_rows;}
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination"); //Pagination helper  
		
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Userlogsna_activity_model->totallogactivity($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/userlogs/listview"));
		//$pageConfig=$pageConfig;//.$search_key;
		}else{
 		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Userlogsna_activity_model->totallogactivity($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/userlogs/listview/"));
		}
		//Debug($pageConfig);
		//die();
		//his->load->library("pagination");
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$logs_list = $this->Userlogsna_activity_model->view_log($pageIndex, $limit,$startdate,$enddate);
		}else{
		$logs_list = $this->Userlogsna_activity_model->view_log($pageIndex, $limit);
		}
		
		//$logs_list = $this->Userlogsna_activity_model->view_log($limit,$start * $limit);
		   //Debug($logs_list);
		   //die();
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
					"content_view" => 'tmon/userlogsna_activity',
					"breadcrumb" => $breadcrumb,
		);
		$this->load->view('template/template',$data);
		 //Debug($data);
		 
		 
	}

}