<?php
class Session extends MY_Controller {
    public function __construct()    {
		parent::__construct();
		$this->load->library('session');
        $this->load->driver('session');
    }
	function index(){
			Debug($this->session->all_userdata());
	}
}