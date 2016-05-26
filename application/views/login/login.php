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
		<meta content="" name="<?php //echo $this->lang->line('description');?>" />
		<meta content="" name="<?php //echo $this->lang->line('author');?>" />
		<!-- end: META -->
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
	<body class="login example1">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo">
            
			<img src="<?php echo base_url(); ?>/images/logo.png" width="150"/>
<br>

<a href="<?=base_url()?>lang/language?lang=english" > <img src="<?=base_url()?>theme/assets/images/lang/en.png" onClick="lanfTrans('en');" height="25" title="<?php  echo $this->lang->line('english');?>"> </a>
|<a href="<?=base_url()?>lang/language?lang=thai" ><img src="<?=base_url()?>theme/assets/images/lang/th.png" onClick="lanfTrans('th');"  height="25" title="<?php  echo $this->lang->line('thai');?>"> </a>

			</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3><?php echo $this->lang->line('signin');?></h3>
				<p>
				  <?php echo $this->lang->line('signin');?>
					 <?php echo $this->lang->line('enterusernameandpassword');?> 
				</p>
<!--
<form class="form-login" action="index.html">
--->
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
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> <?php echo $this->lang->line('somethingwrong');?>
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="user_name" placeholder="<?php echo $this->lang->line('username');?>">
								<i class="fa fa-user"></i> </span>
							<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
							<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="<?php echo $this->lang->line('password');?>">
								<i class="fa fa-lock"></i>
								<!--
								<a class="forgot" href="?box=forgot">
									<?php echo $this->lang->line('password');?>
								</a> 
								-->
								</span>
						</div>
						<div class="form-actions">
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								<?php echo $this->lang->line('remember');?>
							</label>
							<button type="submit" class="btn btn-bricky pull-right">
								<?php echo $this->lang->line('login');?> <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
						 <!--
							<a href="?box=register" class="register">
								<?php echo $this->lang->line('register');?> 
							</a>
						-->
						</div>
					</fieldset>
<?php 
###########################################################################################################################
echo form_close();?>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: FORGOT BOX -->
			<div class="box-forgot">
				<h3><?php echo $this->lang->line('forgot');?>? </h3>
				<p><?php echo $this->lang->line('enteryouremailandtoreceiveinstructions');?>
				</p>
 
<?php 
	$attributes = array('class' => 'form-forgot');
?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line('email');?>">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-actions">
							<a href="?box=login" class="btn btn-light-grey go-back">
								<i class="fa fa-circle-arrow-left"></i> Back
							</a>
							<button type="submit" class="btn btn-bricky pull-right">
								<?php echo $this->lang->line('sendemail');?><i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
<?php 
###########################################################################################################################
echo form_close();?>
			</div>
			<!-- end: FORGOT BOX -->
			<!-- start: REGISTER BOX -->
			<div class="box-register">
				<h3>Sign Up</h3>
				<p>
					Enter your personal details below:
				</p>
				<form class="form-register">
<?php 
###########################################################################################################################
	$attributes = array('class' => 'form-register');
?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
					<fieldset>
						<div class="form-group">
							<input type="text" class="form-control" name="full_name" placeholder="Full Name">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="address" placeholder="Address">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="city" placeholder="City">
						</div>
						<div class="form-group">
							<div>
								<label class="radio-inline">
									<input type="radio" class="grey" value="F" name="gender">
									Female
								</label>
								<label class="radio-inline">
									<input type="radio" class="grey" value="M" name="gender">
									Male
								</label>
							</div>
						</div>
						<p>
							Enter your account details below:
						</p>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" name="email" placeholder="Email">
								<i class="fa fa-envelope"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="password_again" placeholder="Password Again">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<div>
								<label for="agree" class="checkbox-inline">
									<input type="checkbox" class="grey agree" id="agree" name="agree">
									I agree to the Terms of Service and Privacy Policy
								</label>
							</div>
						</div>
						<div class="form-actions">
							<a href="?box=login" class="btn btn-light-grey go-back">
								<i class="fa fa-circle-arrow-left"></i> Back
							</a>
							<button type="submit" class="btn btn-bricky pull-right">
								Submit <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
<?php 
###########################################################################################################################
echo form_close();?>
			</div>
			<!-- end: REGISTER BOX -->
			<!-- start: COPYRIGHT -->
			<div class="copyright">
 <?php  
 $lang=$this->lang->line('lang');
 $yearclient='2014';
 if($lang=='en'|| $lang==''){$year=date('Y'); $yearclient1=$yearclient;}else if($lang=='th'){ $year1=date('Y'); $year=$year1+543; $yearclient1=$yearclient+543;} echo $yearclient1;  echo ' - ';echo $year;?>&copy; <?php echo $this->lang->line('copyright');
 ?>
			</div>
			<!-- end: COPYRIGHT -->
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
		<script src="<?php echo base_url(); ?>theme/assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url(); ?>theme/assets/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>