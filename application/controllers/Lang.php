<?php

class lang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index() 
	{
        $language = $this->lang->language;        
		$data['titleweb'] = $language['titleweb'];
		$data['main_content'] = 'lang/lang';
		$this->load->view('template2/template', $data);
	}

	public function language() 
	{
		$lang = $this->input->get('lang');
		$uri = $this->input->get('uri');
		if($lang == 'english' || $lang == 'thai'){
			$this->session->set_userdata('language', $lang);
			redirect($uri);
		} else {
			redirect('/');
		}
	}

}