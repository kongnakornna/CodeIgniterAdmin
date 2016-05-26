<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Callalertlog extends CI_Controller {

    public function __construct()    {
        parent::__construct();
        // load helper
		$this->load->helper('url');
        $this->load->model('callalertlog_model');
        $this->load->library("pagination");
		//$this->load->library(array('pagination','session'));
		//$this->load->library('session');
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
		$breadcrumb[] = $language['callalertlog'];
		$webtitle = $language['callalertlog'].' - '.$language['titleweb'];
		//$searchterm = $this->input->get_post('searchterm',TRUE);
		//Debug($ListSelect);
		//die();	
		
		//$segment=$this->uri->segment(3);
		//$segment2=$this->uri->segment(4);
		//$segment=$this->session->userdata($segment);
		// Pagination  
		$total_rows= $this->callalertlog_model->totalsmsalart($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){$limit = 100;}else{
			$limit = $total_rows;
			if($limit>5000){$limit=5000;}
			}
		$segment = 3;
		$pageSize=$limit;
		$start=1;
	
	
		$this->load->helper("pagination"); //Pagination helper  
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->callalertlog_model->totalsmsalart($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/callalertlog/listview"));
		//$pageConfig=$pageConfig;//.$search_key;
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->callalertlog_model->totalsmsalart($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/callalertlog/listview"));
		}
		//Debug($pageConfig);
		//die();
		//his->load->library("pagination");
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$callalertlog_list = $this->callalertlog_model->getcallalertlog($pageIndex, $limit,$startdate,$enddate);
		}else{
		$callalertlog_list = $this->callalertlog_model->getcallalertlog($pageIndex, $limit);
		}
		
		//$callalertlog_list = $this->callalertlog_model->getcallalertlog($limit,$start * $limit);
		  //Debug($callalertlog_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
 
		 
		 
		$data = array(
					"startdate" => $startdate,
					"enddate" => $enddate,
					"ListSelect" => $ListSelect,
					"callalertlog_list" => $callalertlog_list,
					"webtitle" => $webtitle,
					"pagination" => $links,
					"content_view" => 'tmon/callalertlog',
					"breadcrumb" => $breadcrumb,
		);
		$this->load->view('template/template',$data);
		 //Debug($data);
	}

}