<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ckupload extends MY_Controller {

    public function __construct()    {
        parent::__construct();

       /* if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }*/
    }

	public function index(){

					/*$admin_id = $this->session->userdata('admin_id');
					$admin_type = $this->session->userdata('admin_type');
					$ListSelect = $this->Api_model->user_menu($admin_type);

					$data = array(
							"admin_menu" => $this->menufactory->getMenu(),
							"ListSelect" => $ListSelect,
					);
					$data['content_view'] = 'admin/dashboard';
					$this->load->view('template/template',$data);*/

					$url = 'uploads/files/'.time()."_".$_FILES['upload']['name'];

					//extensive suitability check before doing anything with the file...
					if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) ){
					   $message = "No file uploaded.";
					}else if ($_FILES['upload']["size"] == 0){
					   $message = "The file is of zero length.";
					}else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png") AND ($_FILES['upload']["type"] != "image/gif")){
					   $message = "The image must be in either GIF , JPG or PNG format. Please upload a JPG or PNG instead.";
					}else if (!is_uploaded_file($_FILES['upload']["tmp_name"])){
					   $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
					}else {
					  $message = "";
					
					  $move =  move_uploaded_file($_FILES['upload']['tmp_name'], $url);
					  if(!$move){
						 $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
					  }
					  //$url = "../" . $url;
					}

					if($message != ""){
						$url = "";
					}

					$funcNum = $_GET['CKEditorFuncNum'] ;
					echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";

	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */