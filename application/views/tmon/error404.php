<?php
$language=$this->lang->language;
$lang=$this->lang->line('lang');
$langs=$this->lang->line('langs');
$dashboard=$this->lang->line('dashboard');
$welcome=$this->lang->line('welcome');
$settings=$this->lang->line('settings');
$preview=$this->lang->line('preview');
$website=$this->lang->line('website');
$profile=$this->lang->line('profile');
$logout=$this->lang->line('logout');
$titleweb=$this->lang->line('titleweb');
$apps=$this->lang->line('apps');
$company=$this->lang->line('company');
$login=$this->lang->line('login');
$username=$this->lang->line('username');
$password=$this->lang->line('password');
$remember=$this->lang->line('remember');
$forgot=$this->lang->line('forgot');
$email=$this->lang->line('email');
$sendemail=$this->lang->line('sendemail');
$register=$this->lang->line('register');
$reset=$this->lang->line('reset');
$petrieveassword=$this->lang->line('petrieveassword');
$enteryouremailandtoreceiveinstructions=$this->lang->line('enteryouremailandtoreceiveinstructions');
$backtologin=$this->lang->line('backtologin');
$newuserregistration=$this->lang->line('newuserregistration');
$enteryourdetailstobegin=$this->lang->line('enteryourdetailstobegin');
$useragreement=$this->lang->line('useragreement');
$iaccept=$this->lang->line('iaccept');
$dark=$this->lang->line('dark');
$blur=$this->lang->line('blur');
$light=$this->lang->line('light');
$allrightsreserved=$this->lang->line('allrightsreserved');
$home=$this->lang->line('home');
$admin=$this->lang->line('admin');
$togglesidebar=$this->lang->line('togglesidebar');
$web_title=$titleweb;
	if(!$this->session->userdata('user_name')) {					
		redirect('login/login');
		die();
	}else{
		$userinput=$this->session->userdata('user_name');
		$user_id= $this->session->userdata('admin_id');
		$user_name =$userinput;
		$admin_type=$this->session->userdata('admin_type');
		$name=$this->session->userdata('name');
		$lastname=$this->session->userdata('lastname');
		$email=$this->session->userdata('email');
		$domain=$this->session->userdata('domain');
		$department=$this->session->userdata('department');	
		$admin_password=$this->session->userdata('admin_password');
	}
	$total_execution_time_start=$this->benchmark->marker['total_execution_time_start'];
	$attr=array();

$web_title=$titleweb;
######################
if($lang=='th'){
	$langs_th='ภาษาไทย';
	$langs_en='ภาษาอังกถษ';
}else if($lang=='en'){
	$langs_th='Thai';
	$langs_en='English';
}
$segment1=$this->uri->segment(1);
$segment2=$this->uri->segment(2);
$segment3=$this->uri->segment(3);
$segment4=$this->uri->segment(4);
$segment5=$this->uri->segment(5);
$segment6=$this->uri->segment(6);
$segment7=$this->uri->segment(7);
$segment8=$this->uri->segment(8);
$segment9=$this->uri->segment(9);
$segment10=$this->uri->segment(10);
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo $lang;?>" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo $this->lang->line('titleweb');?></title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="<?php  echo $this->lang->line('descriptiontmon');?>" />
		<meta content="" name="<?php  echo $this->lang->line('author');?>" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="<?php echo base_url('theme');?>/assets/favicon.ico" />
	</head>
	
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="error-full-page">
		<div id="sound" style="z-index: -1;"></div>
		<img id="background" src="" />
		<div id="cholder">
			<canvas id="canvas"></canvas>
		</div>
		<!-- start: PAGE -->
		<div class="container">
			<div class="row">
				<!-- start: 404 -->
				<div class="col-sm-12 page-error">
					<div class="error-number teal">
						404
					</div>
					<div class="error-details col-sm-6 col-sm-offset-3">
						<h3><?php echo $this->lang->line('error');?>404</h3>
						<p>
							<?php echo $this->lang->line('informationinvalid');?>
							<br>
							<?php echo $this->lang->line('remark');?>.
							<br>
							<?php echo $this->lang->line('undersystem');?>.
							<br>
							<?php echo $this->lang->line('or');?> <?php echo $this->lang->line('notvalidated');?>
							<br>
							<a href="javascript:history.back()" class="btn btn-teal btn-return">
								<?php echo $this->lang->line('back');?>
							</a>
							<br>
								<?php echo $this->lang->line('back');?><?php echo $this->lang->line('dashboard');?>
							<br>
							<a href="<?php echo base_url(); ?>" class="btn btn-primary">
												<i class="ace-icon fa fa-tachometer"></i>
												<?php echo $this->lang->line('dashboard');?>
												</a>
						</p>
						 
							 
						 
					</div>
				</div>
				<!-- end: 404 -->
			</div>
		</div>
		<!-- end: PAGE -->
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url('theme');?>/assets/plugins/respond.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo base_url('theme');?>/assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url('theme');?>/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url('theme');?>/assets/plugins/rainyday/rainyday.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/utility-error404.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Error404.init();				
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>