<?php 
# แปลภาษา
# File THAI --> application\language\thai\app_lang.php
# File English --> application\language\english\app_lang.php	
$lang=$this->lang->line('lang');
$langs=$this->lang->line('langs');
$dashboard=$this->lang->line('dashboard');
$welcome=$this->lang->line('welcome');
$settings=$this->lang->line('settings');
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

$web_title=$titleweb;
######################
if($lang=='th'){
$langs_th='ภาษาไทย';
$langs_en='ภาษาอังกถษ';
}else if($lang=='en'){
$langs_th='Thai';
$langs_en='English';
}
#######################
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $titleweb; ?></title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
<?php 
		echo css_asset('bootstrap.min.css'); 
		echo css_asset('font-awesome.min.css');
?>

		<!-- text fonts -->
<?php echo css_asset('ace-fonts.css'); ?>
		<!-- ace styles -->
<?php echo css_asset('ace.min.css'); ?>

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-part2.min.css" />
		<![endif]-->
<?php echo css_asset('ace-rtl.min.css'); ?>

		<!--[if lte IE 9]>
<?php echo css_asset('ace-ie.min.css'); ?>
		<![endif]-->
<?php echo css_asset('ace.onpage-help.css'); ?>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<?php echo js_asset('html5shiv.js'); ?>
		<?php echo js_asset('respond.min.js'); ?>
		<![endif]-->
<link rel="shortcut icon" href="<?php echo base_url(); ?>/images/favicon.ico">
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h2>
									<!-- <img src="<?=base_url()?>/images/logo-small.png" /> -->
									<!-- <li class="fa fa-fire green"></li> -->
									<!-- <span class="red"><?php echo $titleweb; ?></span> -->
									<img src="<?=base_url()?>/images/logo.png"  />
									<!-- <span class="white" id="id-text2"><?php if($lang=='en' || $lang=='th'){ echo $apps; }?></span> -->
								</h2>
								<h4 class="blue" id="id-company-text"><?php 
								$yearclient='2014';
								if($lang=='en'|| $lang==''){$year=date('Y'); $yearclient1=$yearclient;}else if($lang=='th'){ $year1=date('Y'); $year=$year1+543; $yearclient1=$yearclient+543;} echo $yearclient1;  echo ' - ';echo $year;?>&copy; <?php echo $this->lang->line('copyright'); #echo $company;?></h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">

													<h5 class="header blue lighter bigger">
													<i class="ace-icon fa fa-users  green"></i><?php echo $login; ?>								
													<p>

<a href="<?=base_url()?>lang/language?lang=english" > <img src="<?=base_url()?>theme/assets/images/lang/en.png" onClick="lanfTrans('en');" height="25" title="<?php  echo $this->lang->line('english');?>"> </a>
|<a href="<?=base_url()?>lang/language?lang=thai" ><img src="<?=base_url()?>theme/assets/images/lang/th.png" onClick="lanfTrans('th');"  height="25" title="<?php  echo $this->lang->line('thai');?>"> </a>
													
													<!--
													&nbsp;<a id="btn-login-dark" href="#"><?php echo $dark;?></a>
													&nbsp;<span class="blue">|</span>
													&nbsp;<a id="btn-login-blur" href="#"><?php echo $blur;?></a>
													&nbsp;<span class="blue">|</span>
													&nbsp;<a id="btn-login-light" href="#"><?php echo $light;?></a>
													-->
													<?php echo'<br>'; echo $this->lang->line('titleweb');?>	
													</p>
													</h5>
										
											<div class="space-6">
											</div>

<?php 
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

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="user_name" class="form-control" placeholder="<?php echo $username;?>" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password"  class="form-control" placeholder="<?php echo $password;?>" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<!-- <label class="inline">
															<input type="checkbox" class="ace" name="remember" value=1 />
															<span class="lbl"> <?php echo $remember;?></span>
														</label> -->

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110"><?php echo $login;?></span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											<?php echo form_close();?>

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<!--
											<div>
											
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													 <?php echo $forgot;?>
												</a>
											
											</div>
											-->

											<div style="display:none;">
												<a href="#" data-target="#signup-box" class="user-signup-link">
													 <?php echo $register;?>
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												
												<?php echo $petrieveassword;?>
											</h4>

											<div class="space-6"></div>
											<p>
											<?php echo $enteryouremailandtoreceiveinstructions;?>
												
											</p>

											<?php echo form_open('user/forgot_password', $attributes); ?>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input name="email" type="email" class="form-control" placeholder="<?php echo $email;?>" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110"> <?php echo $sendemail;?></span>
														</button>
													</div>
												</fieldset>
											<?php echo form_close();?>


</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<?php echo $backtologin;?>
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												
												<?php echo $uewuserrgistration;?>
											</h4>

											<div class="space-6"></div>
											<p><?php echo $enteryourdetailstobegin;?></p>

											<form>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="<?php echo $email;?>" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="<?php echo $username;?>" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="<?php echo $password;?>" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="<?php echo $repeatpassword;?>" />
															<i class="ace-icon fa fa-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" />
														<span class="lbl">
															<?php echo $iaccept;?>
															<a href="#"><?php echo $useragreement;?></a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110"><?php echo $reset;?></span>
														</button>

														<button type="button" class="width-65 pull-right btn btn-sm btn-success">
															<span class="bigger-110"><?php echo $register;?></span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
													<?php echo $backtologin;?>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
<!---
<div class="navbar-fixed-top align-right"><br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
</div>
-->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>theme/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url(); ?>theme/assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>theme/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });

				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();			 
			});
		</script>
  </body>
</html>    
    