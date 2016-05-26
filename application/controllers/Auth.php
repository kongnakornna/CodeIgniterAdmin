<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Develop by kongnakorn  jantakun email kongnakornna@gmail.com Mobile +66857365371  Thailand */
/**
 * @copyright kongnakorn  jantakun 2015
*/
class Auth extends MY_Controller {

    public function __construct()    {
		parent::__construct();
		$this->load->library('session');
        $this->load->driver('session');
    }

	function index(){
		
			$this->load->model('Users_model', 'users');
			$language = $this->lang->language;

			$filter = '';

			/*$inputdata = $this->input->post();
			//Debug($inputdata);

			$username = $inputdata['user_name'];
			//$password = $this->__encrip_password($inputdata['password']);
			$password = $inputdata['password'];
			$domain = $inputdata['domain'];
			$backto = $inputdata['backto'];*/

			$username = $this->input->post('user_name');
			$password = $this->input->post('password');
			$domain = $this->input->post('domain');
			$backto = $this->input->post('backto');

			//Debug($this->input->post());

			//Debug($admin);
			//echo "auth($username, $password, $domain)<br>";

			//LDAP Server 
			if($domain == "tmon.in.th"){
				$adServer = "authen02.tmon.in.th";
				$string_connection = "dc=tmon,dc=CO,dc=th";
				$dsn = "tmon";
			}else{
				$adServer = "authen01.tmon.in.th";
				$string_connection = "dc=siamsport,dc=CO,dc=th";
				$dsn = "tmonadmin";
			}

			//$ldapport = 389;
			//$ldap = ldap_connect($adServer, $ldapport);
			$ldap = ldap_connect($adServer);
			$ldaprdn = $dsn . "\\" . $username;

			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			$ldapbind = @ldap_bind($ldap, $ldaprdn, $password);

			//echo "($adServer  ,$string_connection, $dsn)<br>";

			//Debug($ldapbind);
			if ($ldapbind) {

					$respone = array();
					$filter="(sAMAccountName=$username)";
					//echo "($ldap,$string_connection,$filter)";
					$result = ldap_search($ldap,$string_connection,$filter);
					ldap_sort($ldap,$result,"sn");
					$info = ldap_get_entries($ldap, $result);
					$respone['username'] = $username;
					$respone['domain'] = $domain;

					/*echo "<pre>";
					print_r($info[0]['distinguishedname'][0]);
					echo "</pre>";*/

					$infoobj = explode(",", $info[0]['distinguishedname'][0]);
					for($i=0; $i<count($infoobj);$i++){
							list($name, $value) = explode("=", $infoobj[$i]);
							if($name == "CN"){
								$respone[$name] = $value;
								$CN = $value;
							}
							if($name == "OU"){
								$respone[$name] = $value;
								$OU = $value;
							}
							if($name == "DC") $DC = $value;
					}
					$respone = json_encode($respone);

					//Debug($respone);
					
					$login = true;
					$msg = "login success";

					$respone = json_decode($respone);
					//Debug($respone);
					$fullname = explode(" ", $respone->CN);
					if(sizeof($fullname) == 3)
						list($prename, $name, $lastname) = explode(" ", $respone->CN);
					else if(sizeof($fullname) == 2)
						list($name, $lastname) = explode(" ", $respone->CN);
					else
						$name = $respone->CN;

					//echo "<br>auth_ldap($username, $name, $lastname, $respone->OU, $domain);";

					$admin = $this->users->auth_ldap($username, $name, $lastname, $respone->OU, $domain);
					@ldap_close($ldap);
					//Debug($admin);
					//die();

					if($admin){
							$user_active = array(
									'admin_id' => $admin['id'],
									'admin_type' => $admin['type'],
									'user_name' => $admin['email'],
									//'firstname' => $admin['name'],
									//'lastname' => $admin['lastname'],
									'domain' => $admin['domain'],
									//'department' => $admin['department'],
									'avatar' => $admin['avatar'],
									'is_logged_in' => true
							);

							$showdata = array(
									'admin_id' => $admin['id'],
									'admin_type' => $admin['type'],
									'user_name' => $admin['email'],
									'firstname' => $admin['name'],
									'lastname' => $admin['lastname'],
									'domain' => $admin['domain'],
									'department' => $admin['department'],
									'avatar' => $admin['avatar'],
									'is_logged_in' => true
							);
							//Debug($user_active);

							$this->session->set_userdata($user_active);

								/*$cookie = array(
									'name'   => 'session',
									'value'  => 'true',
									'expire' => '7200',
									'domain' => '.Tmon.com',
									'path'   => '/',
									'prefix' => 'sd_',
									'secure' => TRUE,
									'is_logged_in' => true
								);
								$this->input->set_cookie($cookie);
								Debug($this->input->cookie());*/

								//Debug($this->session->all_userdata());
								//die();

								if($this->session->userdata('is_logged_in')){
										$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
										//Debug($this->session->all_userdata());
								}

								$admin_menu = $this->menufactory->getMenu();
								$datashow = array(
									"admin" => $showdata,
									"admin_menu" => $admin_menu,
									"ListSelect" => $ListSelect,
									'content_view' => 'admin/dashboard'
								);
					}
					//Debug($datashow);
					$this->load->view('template/template', $datashow);

			}else{

				@ldap_close($ldap);
				$msg =  "<br>Login failed.";
				//$data['message_error'] = TRUE;
				$data['message_error'] = $msg;
				$this->load->view('admin/login', $data);	

			}

	}
	
	function check(){
		$this->load->model('users_model');

		/*$datasession = array(
						'xxxx' => 'aaaa'						
					);

		$this->session->set_userdata($datasession);*/
		
		Debug($this->session->all_userdata());

		Debug($this->input->cookie());

	}

	function validate_activeuser(){

			$this->load->model('Users_model', 'users');
			$language = $this->lang->language;
			$inputdata = $this->input->post();
			//Debug($inputdata);

			$username = $inputdata['user_name'];
			//$password = $this->__encrip_password($inputdata['password']);
			$password = $inputdata['password'];
			$domain = $inputdata['domain'];
			$backto = $inputdata['backto'];

			/*echo '<form method="post" action="http://172.16.33.61/auth-ldap/auth.php" name="authform">
			<input type="hidden" name="username" value="'.$username.'">
			<input type="hidden" name="password" value="'.$password.'">
			<input type="hidden" name="domain" value="'.$domain.'">
			<input type="hidden" name="backto" value="'.$backto.'">				
			</form>
			<script type="text/javascript">
				window.document.authform.submit();
			</script>';
			die();*/

			//Debug($admin);
			//echo "auth($username, $password, $domain)<br>";

			//LDAP Server 
			if($domain == "tmon.in.th"){
				$adServer = "authen02.tmon.in.th";
				$string_connection = "dc=tmon,dc=CO,dc=th";
				$dsn = "tmon";
			}else{
				$adServer = "authen01.tmon.in.th";
				$string_connection = "dc=siamsport,dc=CO,dc=th";
				$dsn = "tmonadmin";
			}

			$ldap = ldap_connect($adServer);
			$ldaprdn = $dsn . "\\" . $username;

			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			$ldapbind = @ldap_bind($ldap, $ldaprdn, $password);

			if ($ldapbind) {

					$respone = array();
					$filter="(sAMAccountName=$username)";
					$result = ldap_search($ldap,$string_connection,$filter);
					ldap_sort($ldap,$result,"sn");
					$info = ldap_get_entries($ldap, $result);
					$respone['username'] = $username;
					$respone['domain'] = $domain;
					/*echo "<pre>";
					print_r($info[0]['distinguishedname'][0]);
					echo "</pre>";*/
					$infoobj = explode(",", $info[0]['distinguishedname'][0]);
					for($i=0; $i<count($infoobj);$i++){
							list($name, $value) = explode("=", $infoobj[$i]);
							$respone[$name] = $value;

							if($name == "CN") $CN = $value;
							if($name == "OU") $OU = $value;
							if($name == "DC") $DC = $value;
					}
					$respone = json_encode($respone);
					
					//CLOSE LDAP

					$login = true;
					$msg = "login success";

					$respone = json_decode($respone);
					//Debug($respone);
					$fullname = explode(" ", $respone->CN);
					if(sizeof($fullname) == 3)
						list($prename, $name, $lastname) = explode(" ", $respone->CN);
					else if(sizeof($fullname) == 2)
						list($name, $lastname) = explode(" ", $respone->CN);
					else
						$name = $respone->CN;

					//echo "<br>auth_ldap($username, $name, $lastname, $respone->OU, $domain);";
					$admin = $this->users->auth_ldap($username, $name, $lastname, $respone->OU, $domain);
					//Debug($admin);
					//die();

					if($admin){
								$user_active = array(
									'admin_id' => $admin['id'],
									'admin_type' => $admin['type'],
									'user_name' => $admin['email'],
									'firstname' => $admin['name'],
									'lastname' => $admin['lastname'],
									'domain' => $admin['domain'],
									'department' => $admin['department'],
									'avatar' => $admin['avatar'],
									'is_logged_in' => true
								);

								$this->session->set_userdata($user_active);
								if($this->session->userdata('is_logged_in')){
										$ListSelect = $this->Api_model->user_menu($this->session->userdata('admin_type'));
										//Debug($this->session->all_userdata());							
								}

								$admin_menu = $this->menufactory->getMenu();
								$datashow = array(
									"admin" => $user_active,
									"admin_menu" => $admin_menu,
									"ListSelect" => $ListSelect,
									'content_view' => 'admin/dashboard'
								);
					}
					//Debug($data);
					$this->load->view('template/template', $datashow);
			}else{
				$msg =  "<br>Login failed.";
				//$data['message_error'] = TRUE;
				$data['message_error'] = $msg;
				$this->load->view('admin/login', $data);	
			}

			@ldap_close($ldap);

	}

    function __encrip_password($password) {
        return md5($password);
    }		

	function logout(){
		$this->session->sess_destroy();
		redirect('admin');
	}

}