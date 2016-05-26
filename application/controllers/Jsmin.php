<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Jsmin extends CI_Controller {
	public function index(){

		$this->load->helper('asset');

		$data['header'] = js_asset('jsminifier.js').'
		<title>ลดขนาดไฟล์ Javascript ด้วย JS Minifier</title>
		<meta name="description" content="JS Minifier ลดขนาดไฟล์ javascript สำหรับคนทำเว็บ" />
		<meta name="keywords" content="js minifier,ลดขนาดไฟล์,บีบอัดไฟล์,javascript" />
		<style>#outputtitle,#output,#statstitle,#stats{display:none;}</style>';

		$data['content_view'] = 'jsmin/index';
		$this->load->view('template/template',$data);

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */