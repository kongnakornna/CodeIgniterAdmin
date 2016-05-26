<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Emailalertlog extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Emailalertlog_model');
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$language = $this->lang->language;
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }
    
    public function index(){
			$this->listview();
    }
    
	public function listview($pageIndex=1){
          $this->load->helper('url');
	     $this->load->library('session');
          $this->load->library("pagination");
		$ListSelect = $this->Api_model_na->user_menu($this->session->userdata('admin_type')); 
          $startdate = $this->input->get_post('startdate',TRUE);
          $enddate = $this->input->get_post('enddate',TRUE);
		$language = $this->lang->language;
          $lang = $this->lang->language['lang'];
		$breadcrumb[] = '<a href="'.base_url('emailalertlog').'">'.$language['emailalertlog'].'</a>';
          $totalemailalertlog_rows= $this->Emailalertlog_model->totalemailalertlog($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){
			$limit = 200;
			$totalemailalertlog_rows=(int)$totalemailalertlog_rows;
		}else{
			$limit = $totalemailalertlog_rows;
			if($limit>2000){$limit=2000; $totalemailalertlog_rows=2000;}
			}
		 //Debug($totalemailalertlog_rows);
		//Die();
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination");   
		
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Emailalertlog_model->totalemailalertlog($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorreport/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Emailalertlog_model->totalemailalertlog($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorreport/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$emailsalertlog_list = $this->Emailalertlog_model->getemailalertlog($pageIndex, $limit,$startdate,$enddate);
		}else{
		$emailsalertlog_list = $this->Emailalertlog_model->getemailalertlog($pageIndex, $limit);
		}
		  //Debug($emailsalertlog_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$emailsalertlog_list = $this->Emailalertlog_model->getemailalertlog();
			//Debug($emailsalertlog_list);
			//die();

			$data = array(				
                    "emailsalertlog_list" => $emailsalertlog_list,
				"content_view" => 'tmon/emailsalertlog',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb,
                    "totalemailalertlog_rows" => $totalemailalertlog_rows,
				"startdate" => $startdate,
				"enddate" => $enddate,
				"pagination" => $links
			);

			$this->load->view('template/template',$data);
	}
}