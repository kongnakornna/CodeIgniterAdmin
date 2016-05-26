<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Lock_screen extends MY_Controller {
    public function __construct()    {
        parent::__construct();
    }
	function index(){
		$this->load->view('login/lock_screen');
        } 
}