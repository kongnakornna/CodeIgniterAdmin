<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Editor extends MY_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->helper(array('form', 'url'));
	}

	function index(){

			$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
			$language = $this->lang->language;

			$breadcrumb[] = '<a href="'.base_url('gallery').'">'.$language['gallery'].'</a>';
			$breadcrumb[] = $language['edit'];


			$data = array(
					"admin_menu" => $this->menufactory->getMenu(),
					"ListSelect" => $ListSelect,
					"content_view" => 'ckeditor-upload',
					"breadcrumb" => $breadcrumb,
			);
			//$this->load->view('template/template',$data);
			$this->load->view('ckeditor-upload');
	}

	function do_upload(){

		Debug($this->upload);

		/*$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}*/

	}
}
?>