<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Dashboard extends MY_Controller {

    public function __construct()    {
        parent::__construct();
		$this->load->library('session');
        $this->load->driver('session');
        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){
			$provinceid = '54';  
		    $geoid='2';  
		    $countries_id='209';
			$this->load->model('Countries_model');
			$this->load->model('Geography_model');
			$this->load->model('Province_model');
			$this->load->model('Village_model');
/////////////////
            $session_id = $this->session->userdata('session_id');
    		$userinput=$this->session->userdata('user_name');
    		$user_id= $this->session->userdata('admin_id');
            $admin_id= $this->session->userdata('admin_id');
    		$user_name=$this->session->userdata('user_name');
    		$admin_type=$this->session->userdata('admin_type');
    		$name=$this->session->userdata('name');
    		$lastname=$this->session->userdata('lastname');
    		$email=$this->session->userdata('email');
    		$domain=$this->session->userdata('domain');
    		$department=$this->session->userdata('department');	
    		$admin_password=$this->session->userdata('admin_password');
/////////////////
/*
        echo '$user_id='.$user_id.'<br>';
        echo '$admin_id='.$admin_id.'<br>';
        echo '$user_name='.$user_name.'<br>';
        echo '$admin_type='.$admin_type.'<br>';
        echo '$admin_password='.$admin_password.'<br>';
        echo '$email='.$email.'<br>';
        echo '$name='.$name.'<br>';
        echo '$lastname='.$lastname.'<br>';
        Die();    
  */   
			$ListSelect = $this->Api_model->user_menu($admin_type);
			$notification_birthday = $this->Api_model->notification_birthday();
            ################
			$language = $this->lang->language;			
			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
            $get_countries = $this->Countries_model->get_countries_by_id($countries_id);
			//Debug($get_countries);
			$object = json_decode(json_encode($get_countries), TRUE);
            $countriesname=$object[0]['countries_name'];
            
            
            $get_geography = $this->Geography_model->get_geography_by_id($geoid);
			//Debug($get_geography);
			$object = json_decode(json_encode($get_geography), TRUE);
            $geoname=$object[0]['geo_name'];
            
            $get_province = $this->Province_model->get_province_by_id($provinceid,$language);
			//Debug($get_province);
			$object = json_decode(json_encode($get_province), TRUE);
            $provincename=$object[0]['province_name'];
            
            $breadcrumb[] = '<a href="'.base_url('countries').'">'.$language['countries'].$countriesname.'</a>';			        $breadcrumb[] = '<a href="'.base_url('geography').'">'.$language['geography'].$geoname.'</a>';
            $breadcrumb[] = '<a href="'.base_url('province').'">'.$language['province'].$provincename.'</a>';  
            ################



		$data = array(
			"admin_menu" => $this->menufactory->getMenu(),
			"ListSelect" => $ListSelect,
			//"notification_birthday" => $notification_birthday,
		);
		$data['content_view'] = 'admin/dashboard';
		$this->load->view('template/template',$data);
	}
	
}