<?php  
$setting = GetConfig1();
$object = json_decode(json_encode($setting), TRUE);
$systemname_crna=$object['systemname'];
$description_crna=$object['description'];
$address_crna=$object['address'];
$registerno_crna=$object['registerno'];
$author_crna=$object['author'];
$phone_crna=$object['phone'];
$ip_crna=$object['ip'];
$macaddress_crna=$object['mac_address'];
$licencekey_crna=$object['licence_key'];
$version_crna=$object['version'];
$adminemail_crna=$object['admin_email'];
$mobile_crna=$object['mobile'];
$countries_crna=$object['countries'];
$geography_crna=$object['geography'];
$province_crna=$object['province'];
$amphur_crna=$object['amphur'];
$district_crna=$object['district'];
$moo_crna=$object['moo'];
$facebook_crna=$object['facebook'];
$twitter_crna=$object['twitter'];
$google_crna=$object['google'];
$admin_id = 0;# 0=>เห็นทุกเมนู
$language = $this->lang->language;
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
$allrightsreserved=$this->lang->line('allrightsreserved');
$home=$this->lang->line('home');
$admin=$this->lang->line('admin');
$togglesidebar=$this->lang->line('togglesidebar');
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

$strDate=date('Y-m-d H:i:s');
function DateThai($strDate){
		$strYear=date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}
		$strMonth1= date("n",strtotime($strDate));
		$strMonthCut1=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai1=$strMonthCut1[$strMonth1];
	    $strYear2=date("Y",strtotime($strDate))+543;
		$strHour3= date("H",strtotime($strDate));
		$strMinute3= date("i",strtotime($strDate));
		$strSeconds3= date("s",strtotime($strDate));
        $timena=$strHour3.':'.$strMinute3.':'.$strSeconds3;
		$strYear4=date("Y",strtotime($strDate))+543;
		$strMonth4= date("n",strtotime($strDate));
		$strDay4= date("j",strtotime($strDate));
		$strMonthCut=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai3=$strMonthCut[$strMonth4];
		$datena=$strDay4.' '.$strMonthThai3.' '.$strYear4;
	####################
	if(!$this->session->userdata('user_name')) {					
		redirect('login/login');
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
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="<?php echo $lang;?>" class="no-js">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
		<title><?php echo $this->lang->line('titleweb');?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta content="tmon,monitoring"  name="<?php  echo $this->lang->line('descriptiontmon');?>" />
		<meta content="tmon,monitoring"  name="<?php  echo $this->lang->line('author');?>" />
		<meta name="keyword" content="tmon,monitoring,hardware,control,acms,sensor,adruno" />
		<!-- Use the correct meta names below for your web application  -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/font-awesome.min.css">
		<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/smartadmin-production.css">
		<!-- <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/smartadmin-production.min.css">--> 
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/smartadmin-skins.min.css">
		
		
		<!-- SmartAdmin RTL Support is under construction-->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/smartadmin-rtl.min.css">
		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/tmon_style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/your_style.css">
		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('theme');?>/assets/css/demo.min.css">
		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo base_url('theme');?>/assets/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url('theme');?>/assets/favicon.ico" type="image/x-icon">
		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/css/cssgoogle.css">
		
<!-- Specifying a Webpage Icon for Web Clip
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="<?php echo base_url('theme');?>/assets/img/splash/sptouch-icon-iphone.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('theme');?>/assets/img/splash/touch-icon-ipad.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('theme');?>/assets/img/splash/touch-icon-iphone-retina.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('theme');?>/assets/img/splash/touch-icon-ipad-retina.png">

		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="<?php echo base_url('theme');?>/assets/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url('theme');?>/assets/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="<?php echo base_url('theme');?>/assets/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

		
 <script src="<?php echo base_url('theme');?>/assets/js/jquery-1.11.1.min.js"></script>
 
 	<script src="<?php echo base_url('theme');?>/assets/js/jquery.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo base_url('theme');?>/assets/js/jquery-2.1.1.js"><\/script>');
			}
		</script> 

		<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-ui.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>
 
 
 
<link href="<?php echo base_url('theme');?>/assets/css/footable.core.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('theme');?>/assets/datetimepicker/jquery.datetimepicker.css"/>
<link href="<?php echo base_url('theme');?>/assets/css/timeTo.css" type="text/css" rel="stylesheet"/>


<?php if(preg_match('~\b(floorplan)\b~i', strtolower($this->uri->segment(1)))){?>
<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/pointimage/css/style.css"> <!-- Resource style -->
<script src="<?php echo base_url('theme');?>/assets/pointimage/js/modernizr.js"></script> <!-- Modernizr -->
<?php } ?>



<?php if(preg_match('~\b(locationmonitor)\b~i', strtolower($this->uri->segment(1)))){?>
<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/pointimage/css/style.css"> <!-- Resource style -->
<script src="<?php echo base_url('theme');?>/assets/pointimage/js/modernizr.js"></script> <!-- Modernizr -->
<?php } ?>
</head>
<!--
<body class="fixed-navigation fixed-header fixed-ribbon">
<body class="smart-style-6">
<body class="menu-on-top">
<body class="fixed-ribbon">
<body class="fixed-header">
<body class="hidden-menu">
<body class="minified">
-->
<body class="minified">
<!-- possible classes: minified, fixed-ribbon, fixed-header, fixed-width-->
 <!-- HEADER -->
 <header id="header">

 
 
<div id="logo-group">

	 <!-- PLACE YOUR LOGO HERE -->
	<span id="logo"> 
		<a href="<?php echo base_url('admin/dashboard'); ?>">									
			<img src="<?php echo base_url();?>/images/logotmon.png" alt="<?php echo $this->lang->line('titleweb');?>" border="0">
		</a>
	</span>
						<!-- END LOGO PLACEHOLDER -->

						<!-- Note: The activity badge color changes when clicked and resets the number to 0
						Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
						 
						<?php 
$alinkprofile=base_url('admin/profile'); 
//Debug($this->session->userdata); 
if($this->session->userdata['avatar'] != ''){
	 $avatar=base_url('uploads/admin/'.$this->session->userdata['avatar']);
	 //if(!file_exists($avatar)) $avatar=base_url('uploads/admin/'.$this->session->userdata['avatar']);
	 //if(!file_exists($avatar)) $avatar=base_url('theme/assets/avatars/user.jpg');
}else if($this->session->userdata['avatar'] == ''){
						$avatar=base_url().'theme/system/systmon.png';	
						}else{
						    $avatar=base_url().'theme/system/systmon.png';	
						}
 ?>  
	<!-- Note: The activity badge color changes when clicked and resets the number to 0
	Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
<br>
<!--###########-->		 
<img src="<?php  echo $avatar; ?>" class="circle-img" alt="<?php echo $userinput?>" height="30">
			 

						<!-- END AJAX-DROPDOWN -->
					</div>
 
 
 
 

			<!-- projects dropdown -->
			<div id="project-context">

				<span class="label"><?php echo $userinput?>:</span>
				<span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Menu <i class="fa fa-angle-down"></i></span>

				<!-- Suggestion: populate this list with fetch and push technique -->
				<ul class="dropdown-menu">
				
<?php if($admin_type=='1'){?>
								<li>
									<a href="<?php echo base_url('overview'); ?>"><i class="fa fa-bar-chart-o"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('overview'); ?></a>
								</li>
								<li>
									<a href="<?php echo base_url('setting'); ?>"><i class="fa fa-code-fork "></i><?php echo'&nbsp;';?><?php echo $this->lang->line('settings'); ?></a>
								</li>
								<li>
									<a href="<?php echo base_url('userlogs'); ?>">
										<i class="fa fa-comments-o"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('userlogs'); ?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('admin/memberlist'); ?>">
										<i class="fa fa-group"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('member'); ?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('accessmenu'); ?>">
										<i class="fa fa-sitemap"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('admin_menu'); ?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('user_guide'); ?>">
										<i class="fa fa-book"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('help');?>
									</a>
								</li>

								<li class="divider"></li>
								<li>
									
										<a href="<?php echo base_url('hwdata'); ?>">
										<i class="fa fa-tint"></i>
										</i><?php echo'&nbsp;';?><?php echo $this->lang->line('hwdata');?> 
									</a>
								</li>
                                        <li>
                                        <a href="<?php echo base_url('lock_screen'); ?>">
                                        <i class="fa fa-retweet"></i><?php echo'&nbsp;';?>
                                        <?php echo $this->lang->line('lock_screen'); ?></a>
								</li>
<?php }else if($admin_type=='2'){?>
								<li>
									<a href="<?php echo $alinkprofile; echo'/'.$user_id; ?>">
										<i class="fa fa-user"></i><?php echo'&nbsp;';?><?php //echo $profile;?> <?php echo $userinput?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('userlogs'); ?>">
										<i class="fa fa-comments-o"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('userlogs'); ?>
									</a>
								</li>
                                        <li>
									<a href="<?php echo base_url('accessmenu'); ?>">
										<i class="fa fa-keyboard-o"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('access_menu'); ?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('admin/memberlist'); ?>">
										<i class="fa fa-group"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('member'); ?>
									</a>
								</li>
								<li>
                                        <a href="<?php echo base_url('lock_screen'); ?>">
                                        <i class="fa fa-retweet"></i><?php echo'&nbsp;';?>
                                        <?php echo $this->lang->line('lock_screen'); ?></a>
								</li>
								
<?php }else if($admin_type<>'1' || $admin_type<>'2'){?>
								<li>
									<a href="<?php echo $alinkprofile; echo'/'.$user_id; ?>">
										<i class="fa fa-user"></i><?php echo'&nbsp;';?><?php //echo $profile;?> <?php echo $userinput?>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url('userlogs'); ?>">
										<i class="fa fa-comments-o"></i><?php echo'&nbsp;';?><?php echo $this->lang->line('userlogs'); ?>
									</a>
								</li>
								<li>
                                        <a href="<?php echo base_url('lock_screen'); ?>">
                                        <i class="fa fa-retweet"></i><?php echo'&nbsp;';?>
                                        <?php echo $this->lang->line('lock_screen'); ?></a>
								</li>
								
<?php }?>
<li class="divider"></li>
<li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-power-off"></i> <?php echo $logout; ?></a>
</li>
	</ul>
	<!-- end dropdown-menu-->
</div>
			<!-- end projects dropdown -->

			<!-- pulled right: nav area -->
			<div class="pull-right"> 

						<!-- collapse menu button -->
						<div id="hide-menu" class="btn-header pull-right">
							<span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
						</div>
						<!-- end collapse menu -->
				
				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo base_url();?>/admin/logout" title="<?php echo $this->lang->line('logout');?>"><i class="fa fa-sign-out"></i></a> </span>
				</div>
				<!-- end logout button -->
				
				
				<!-- search mobile button (this is hidden till mobile view port) -->
					<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
					</div>
				<!-- end search mobile button -->				
				
				
<!-- input: search field -->
<?php 
		$keyword='';
		$search_form=$this->input->post();		
		if($search_form){
			//$keyword=$this->input->post($keyword);			
			$keyword=@$search_form['keyword'];
		}
		//Debug($_SERVER);
		
		if($this->uri->segment(1) == "sensor")
			$action_form=@$_SERVER['PATH_INFO'];
		else
			$action_form=$this->uri->segment(1);
		$method =$this->uri->segment(1);
		switch($method){
				case "overview" : $method=$language['overview']; break;
				case "sensorreport" : $method=$language['sensorreport']; break;
				case "smsalertlog" : $method=$language['smsalertlog']; break;
				case "alarmlogreport" : $method=$language['alarmlogreport']; break;
				case "sensorlog" : $method=$language['sensorlog']; break;
				case "memberlist" : $method=$language['memberlist']; break;
				case "member" : $method='member'; break;
				default : $method=''; break;		
		}
		if($action_form){
?>	 

<!-- input: search field -->
<form action="<?php echo base_url($action_form);?>" class="header-search pull-right"> 
	<input type="text"  value="<?php echo $keyword?>"  name="keyword" placeholder="<?php echo  $language['search'].$method ?>..." id="search-fld" autocomplete="on" >
		<button type="submit">
		<i class="fa fa-search"></i>
		</button>
		<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>

<?php
		if($this->uri->segment(2) != ''){
				$mod=($this->uri->segment(2) != '') ? $this->uri->segment(2) : 'alarmlogreport';
				echo '<input type="hidden" name="mod" value="'.trim($mod).'">';
		}	
?>
 	
</form>
<!-- end input: search field -->
<?php } ?>					
						
						
						<!-- fullscreen button -->
						<div id="fullscreen" class="btn-header transparent pull-right">
							<span> <a href="javascript:void(0);" onClick="launchFullscreen(document.documentElement);" title="<?php  echo $this->lang->line('fullscreen');?>"><i class="fa fa-arrows-alt"></i></a> </span>
						</div>
						<!-- end fullscreen button -->
						<!-- #Voice Command: Start Speech -->
						<div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
							<div> 
								<a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a> 
								<div class="popover bottom"><div class="arrow"></div>
									<div class="popover-content">
										<h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
										<h4 class="vc-title-error text-center">
											<i class="fa fa-microphone-slash"></i> Voice command failed
											<br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
											<br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
										</h4>
										<a href="javascript:void(0);" class="btn btn-success" onClick="commands.help()">See Commands</a> 
										<a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onClick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a> 
									</div>
								</div>
							</div>
						</div>
						<!-- end voice command -->

						
						

				<!-- multiple lang dropdown : find all flags in the image folder -->
				<ul class="header-dropdown-list hidden-xs">
					<li>
<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img alt="<?php echo $this->lang->line('lang');?>"
  <?php if($this->lang->line('lang')=='th'){?>
 src="<?=base_url('theme/assets/images/lang/th.png')?>">
 <?php }else if($this->lang->line('lang')=='en' || $lang==''){?>
 src="<?=base_url('theme/assets/images/lang/en.png')?>">
 <?php }?>
<span>  <?php echo $lang;?></span> <i class="fa fa-angle-down"></i> 
 </a>
				<ul class="dropdown-menu pull-right">
<li <?php if($this->lang->line('lang')=='en'){?>class="active"<?php }?>>
<a href="<?=base_url()?>lang/language?lang=english&uri=<?php print(uri_string()); ?>" > <img src="<?=base_url('theme/assets/images/lang/en.png')?>" onClick="lanfTrans('en');" height="25" title="To English"> <?php echo 'English'; ?></a>
</li>
<li <?php if($this->lang->line('lang')=='th'){?>class="active"<?php }?>>
<a href="<?=base_url()?>lang/language?lang=thai&uri=<?php print(uri_string()); ?>" ><img src="<?=base_url('theme/assets/images/lang/th.png')?>" onClick="lanfTrans('th');"  height="25" title="To Thai"> <?php echo 'Thai'; echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?></a>
</li>
					  </ul>
					</li>
				</ul>
				<!-- end multiple lang -->
			</div>
			<!-- end pulled right: nav area -->
		</header>
		<!-- END HEADER -->
<?php
/***********Menu**************/
?>
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">
			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it --> 
					
					<a href="javascript:void(0);" id="show-shortcut">
						<img src="<?php  echo $avatar; ?>" alt="<?php echo $userinput?>" class="online" /> 
						 
						<span>
							<?php echo $userinput?>
						</span>
						<i class="fa fa-angle-down"></i>
					</a> 
					
				</span>
			</div>
		<nav>
			<ul>
				<?php /***********Menu**************/
					echo $ListSelect;
				?>
			</ul>
		</nav>
				<span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i> </span>
		
</aside>
<!-- END NAVIGATION -->
<?php
/***********Menu**************/
?>
<!-- MAIN PANEL -->
 <div id="main" role="main">
	 <!-- RIBBON -->
		 <div id="ribbon">
	<span class="ribbon-button-alignment"> <span id="refresh" class="btn btn-ribbon" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> </span>
		<?php ##################################?>
		<?php ##################################?>
		<!--Start breadcrumb -->
	<ol class="breadcrumb">
 		 <a href="<?php echo base_url(); ?>"><?php echo $language['dashboard'];?></a>
</li>


 <?php if($this->uri->segment(1)=='overview'|| $this->uri->segment(1)=='workflow'){?> 
  <li><a href="<?php echo base_url('control'); ?>"><?php echo $this->lang->line('control');?></a></li>
  <li><a href="<?php echo base_url('sensor'); ?>"><?php echo $this->lang->line('sensormonitor');?></a></li>
 <?php } if($this->uri->segment(1)=='control'){?> 
  <li><a href="<?php echo base_url('sensor'); ?>"><?php echo $this->lang->line('sensormonitor');?></a></li>
 <?php }?>
 
 
<li>
<?php 
if($this->uri->segment(1)=='admin_menu'|| $this->uri->segment(2)=='admin_menu'){
	echo $language['admin_menu'];
}else if($this->uri->segment(1)=='team'|| $this->uri->segment(2)=='team'){
	echo $language['admin_menu'];
}else if($this->uri->segment(1)=='overview'||$this->uri->segment(1)=='control'){
	//echo $language['overview'];
}else  if($this->uri->segment(1)=='workflow'){
	echo $language['workflowmonitor'];
}else  if($this->uri->segment(1)=='locationmonitor'){
	echo $language['floorplan'];
}else  if($this->uri->segment(1)=='floorplan'){
	echo $language['floorplan'];
}else{
	echo '';
}
?>
<?php //echo $HeadTitle?>
</ol>
<!-- end breadcrumb -->
<?php ##################################?>
<?php ##################################?>


</div>
<!-- END RIBBON -->	 
