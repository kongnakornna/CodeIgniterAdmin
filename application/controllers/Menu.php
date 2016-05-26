<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/

class Menu extends MY_Controller {

    public function __construct()    {
        parent::__construct();
        $this->load->model('Menu_model');

        if(!$this->session->userdata('is_logged_in')){
            redirect(base_url());
        }
    }

	public function index(){

			$data['content_view'] = 'admin/dashboard';
			$this->load->view('template/template',$data);

	}

	/*function login(){
			$this->load->view('admin/login');
	}

	function dashboard(){
			$data['content_view'] = 'admin/dashboard';
			$this->load->view('template/template',$data);
	}*/

	public function list_menu(){	

			//$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
			//$this->db->query($sql, array(3, 'live', 'Rick'));

			//$orderby = 'order_by';
			//$query = $this->_ci->db->select("*")->from("_admin_menu")->order_by($orderby, 'ASC')->get();
			

			//$this->load->driver('session');

			//$this->session->userdata('user_name');
			//$this->session->set_userdata($data);
			/*echo "<pre>";
			print_r($this->session->userdata('user_name'));
			echo "</pre>";*/

			/*if (!$this->session->userdata('user_name')) {
				$data["msg"] = "<b>No session!</b>";
			} else {
				$userinput = $this->session->userdata('user_name');
				$data["session"] = $this->session;
				$data["user_name"] = $userinput;
				$data["msg"] = "Member's login : $userinput";
				//$data["msg2"] = "Last login: $is_logged_in";
			}*/

				//$data['content_text'] = '<header><h1>ผลการ Login</h1></header>';
				//$data['headtxt'] = '<h1>ผลการ Login</h1>';
				//$data['query'] = $query;

				/*<p>คุณได้ทำเข้าสู่ระบบเรียบร้อยแล้ว</p>				
				<p>คุณสามารถเข้าสู่ระบบได้ที่เมนู เข้าสู่ระบบ หรือ <a href="'.site_url('users/login').'">คลิกที่นี่</a></p>
				<p>ยินดีต้อนรับเข้าสู่ระบบ ครับ</p>';*/

			//$data['message_error'] = TRUE;
			//$this->load->view('admin/welcome', $data);

			//$data['content_view'] = 'admin/welcome';

			//$this->load->view('template/template',$data);
			return $query;
	}


}