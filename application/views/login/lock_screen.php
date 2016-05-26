<?php 
		$this->load->library('session');
 		$avatar=$this->session->userdata('avatar');
		$userinput=$this->session->userdata('user_name');
		$user_id= $this->session->userdata('admin_id');
		$admin_type=$this->session->userdata('admin_type');
		$name=$this->session->userdata('name');
		$lastname=$this->session->userdata('lastname');
		$email=$this->session->userdata('email');
		$password=$this->session->userdata('admin_password');
		$language = $this->lang->language;
		//$this->session->sess_destroy($user_id);	
		//$this->session->sess_destroy($password);
		if($userinput==''){
		?>
		<meta http-equiv="refresh" content="0.1;URL=<?php echo base_url(); ?>">
		<?php } ?>
<?php 
//Debug($this->session->userdata); 
if($avatar!= ''){
	 $avatar=base_url('uploads/admin/'.$avatar);
	 //if(!file_exists($avatar)) $avatar=base_url('uploads/admin/'.$this->session->userdata['avatar']);
	 //if(!file_exists($avatar)) $avatar=base_url('theme/assets/avatars/user.jpg');
 }else{
  $avatar=base_url().'theme/assets/images/avatar-1-xl.jpg';	
 }
 ?>

<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo $this->lang->line('lang');?>" class="no-js">
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
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		
	<!-- start: MAIN CSS -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/fonts/style.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/css/main.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo base_url(); ?>theme/assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>/images/favicon.ico">
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="lock-screen">
<div class="main-ls"> 
			<div class="logo"><center>
				<img src="<?php echo base_url(); ?>/images/logobloe.png" width="50%"/>
<br>
<a href="<?=base_url()?>lang/language?lang=english"><img src="<?=base_url()?>theme/assets/images/lang/en.png" onClick="lanfTrans('en');" height="25" title="<?php  echo $this->lang->line('english');?>"></a>
::
<a href="<?=base_url()?>lang/language?lang=thai" ><img src="<?=base_url()?>theme/assets/images/lang/th.png" onClick="lanfTrans('th');"  height="25" title="<?php  echo $this->lang->line('thai');?>"></a>
</center>
			</div>
			<br>
			<div class="box-ls">
				<img src="<?php echo $avatar; ?>" height="100"/>
				<div class="user-info">
					<h1><i class="fa fa-lock"></i> <?php echo $userinput; //echo $name; //echo '  ';  //echo $lastname;?></h1>
					<span> <?php echo $email;?></span>
					<span><em><?php   echo $this->lang->line('inputpassword');  ?>.</em></span>
<?php 
###########################################################################################################################
    //$attributes = array('class' => 'form-login');
	$attributes = array('class' => 'form-signin');
?>
<?php echo form_open('user/validate_credentials', $attributes); ?>
												<fieldset>
<?php if(isset($message_error) && $message_error){ ?>	   
											      <div class="alert alert-danger">
														<strong>
															<i class="ace-icon fa fa-times"></i>
															 <?php  echo $this->lang->line('error'); ?> !!!!
														</strong> 
														<br>
														 <?php   echo $this->lang->line('enterusernameandpassword');  ?> 
														 <br>
														 <?php   echo $this->lang->line('somethingwrong');  ?>
														 <br>
														 <?php   echo $this->lang->line('member');  ?>
														<br></div> 
<?php } ?>
					  <div class="input-group">
						    <input name="user_name" type="hidden" class="form-control" value="<?php echo $userinput;?>" placeholder="<?php echo $this->lang->line('username');?>">
							<input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('password');?>">
							<span class="input-group-btn">
								<button class="btn btn-blue" type="submit">
									<i class="fa fa-chevron-right"><?php echo $this->lang->line('login');?></i>
								</button> </span>
					</div>
						<div class="relogin">
							<a href="<?php echo base_url(); ?>">
								 <?php  echo $this->lang->line('login'); ?></a>
						</div>
<?php 
###########################################################################################################################
echo form_close();
?>
				</div>
			</div>
<!--<div><?php //echo $this->lang->line('descriptiontmon');?></div>	-->		
<div class="copyright">
 <?php  
 $lang=$this->lang->line('lang');
 $yearclient='2014';
 if($lang=='en'|| $lang==''){$year=date('Y'); $yearclient1=$yearclient;}else if($lang=='th'){ $year1=date('Y'); $year=$year1+543; $yearclient1=$yearclient+543;} echo $yearclient1;  echo ' - ';echo $year;?>&copy; <?php echo $this->lang->line('copyright');
 ?>
</div>
</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/respond.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>theme/assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo base_url(); ?>theme/assets/plugins/jQuery-lib/2.0.3/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url(); ?>theme/assets/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
			});
		</script>
		

		
	</body>
	<!-- end: BODY -->
</html>