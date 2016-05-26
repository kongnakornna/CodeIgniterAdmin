<?php

class Upload extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index(){
		$this->load->view('plan', array('error' => ' ' ));
	}

	function do_upload(){
		$path= './images/plan/';
		chmod($path, 0777);
		$config["upload_path"] = $path;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '10240';
		$config['max_width']  = '10240';
		$config['max_height']  = '7680';
		$config['file_name'] = $filename;
  		$this->load->library('upload', $config);

        //echo 'Uploads Process';
		if ( ! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('plan', $error);
		}else{
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);
		}
	}
}
?>