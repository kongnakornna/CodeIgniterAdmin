<?php
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Sensorlogs extends MY_Controller {

    public function __construct()    {
        parent::__construct();
          $this->load->model('Sensorreport_model');
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
		$breadcrumb[] = '<a href="'.base_url('sensorreport').'">'.$language['sensorreport'].'</a>';
          $total_rows= $this->Sensorreport_model->total($startdate,$enddate);
		if($startdate=='' && $enddate=='' ){
			$limit = 200;
			$total_rows=(int)$total_rows;
		}else{
			$limit = $total_rows;
			if($limit>2000){$limit=2000; $total_rows=2000;}
			}
		 //Debug($total_rows);
		//Die();
		$segment = 3;
		$pageSize=$limit;
		$start=1;
		$this->load->helper("pagination");   
		
		if($startdate!==''){
		$search_key='/'.$startdate.'/'.$enddate.'/';
		$pageConfig = doPagination($this->Sensorreport_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorreport/listview"));
		}else{
		$yesterday=strtotime("yesterday");
	     $yesterday =date("Y-m-d", $yesterday); 
	     $timena=date(' H:i:s');
	     $startdate=$yesterday.$timena;
	     $enddate=date('Y-m-d H:i:s');
		$pageConfig = doPagination($this->Sensorreport_model->total($startdate,$enddate), $limit, $segment,$startdate,$enddate, site_url("/sensorreport/listview"));
		}
		//Debug($pageConfig);
		//die();
		$this->pagination->initialize($pageConfig, $pageIndex);
	
		// Get data from my_model  
		if($startdate!==''){
		$sensorreport_list = $this->Sensorreport_model->get_sensor_log($pageIndex, $limit,$startdate,$enddate);
		}else{
		$sensorreport_list = $this->Sensorreport_model->get_sensor_log($pageIndex, $limit);
		}
		  //Debug($sensorreport_list);
		  //die();
		 $links=$this->pagination->create_links();
		 //$links=$this->pagination->create_links($limit, $start);
		 //Debug($links);
		 //die();
			//////////$sensorreport_list = $this->Sensorreport_model->get_sensor_log();
			//Debug($sensorreport_list);
			//die();

			$data = array(				
                    "sensorreport_list" => $sensorreport_list,
				"content_view" => 'tmon/sensorreport',
				"ListSelect" => $ListSelect,
				"breadcrumb" => $breadcrumb,
                    "total_rows" => $total_rows,
				"startdate" => $startdate,
				"enddate" => $enddate,
				"pagination" => $links
			);

			$this->load->view('template/template',$data);
	}
}