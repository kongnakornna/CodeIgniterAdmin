<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
        
        $this->load->library('session');
        //session_start();
		//date_default_timezone_set('Asia/Bangkok');
		// mb_internal_encoding("UTF-8");

		/*==========  Validate user login access page  ==========*/
		$arr_redirect = array('register','login','forgot_password');
		if (in_array($this->router->method, $arr_redirect) && isset($_SESSION['username']))
		{
			redirect(index_page(),'refresh');
			die;
		}


		/*==========  Current Session Language Site  ==========*/
		/*if( ! isset($_SESSION['lang']) OR isset($_SESSION['lang']) && $_SESSION['lang'] == 'th')
		{
			$_SESSION['lang'] = "th";
		}
		else
		{
			$_SESSION['lang'] = "en";
		}*/


		/*==========  Facebook Member ==========*/
		/*require_once(APPPATH.'libraries/facebook.php');

		$this->app_facebook_id     = '553045288113652';
		$this->app_facebook_secret = 'a1d6f0483ab9f3795959e699438e5764';

		$this->facebook = new Facebook(array(
			'appId'  => $this->app_facebook_id,
			'secret' => $this->app_facebook_secret,
		));

		$this->user = $this->facebook->getUser();

		$args = array(
			'scope'        => 'email',
			'redirect_uri' => base_url('member/check_login')
		);

		$this->facebook_login      = '<a class="btn-fb-login" href="' . $this->facebook->getLoginUrl($args) . '"><img src="'.base_url('assets/img/facebook-signin.png').'" alt="" /></a>';*/

		// $this->facebook_login      = '<fb:login-button show-faces="false" onlogin="member_actions()" size="large" width="200" max-rows="1"></fb:login-button>';
		// alert($_SESSION);
	}

	public function template_splash($content,$data){

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			//Ajax request
			$this->load->view($content,$data);
			$this->load->view('aja_title_desc');
		}
		else {
			//Non-ajax request
			$this->load->view('template/master_header', $data);
			$this->load->view($content);
			$this->load->view('template/master_footer');
		}
	}

	public function template_public($content,$data){
		/* Note server support for HTTP_X_REQUESTED_WITH may vary, also it may be worth sending your own custom header in the case that the JavaScript doesn't send the header you expected */
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			//Ajax request
			$this->load->view($content,$data);
			$this->load->view('aja_title_desc');
		}else {
			//Non-ajax request
			/*$this->load->view('template/master_header_public', $data);
			$this->load->view('template/form_sidebar_left', $data);
			$this->load->view($content);
			$this->load->view('template/master_footer');*/
			$this->load->view('template',$data);
		}
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
