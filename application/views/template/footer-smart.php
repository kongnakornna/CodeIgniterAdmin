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
		//die();
	}else{
		$userinput=$this->session->userdata('user_name');
		$user_id= $this->session->userdata('admin_id');
          $sessuserid=$user_id;
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
				</section>
				<!-- end widget grid -->
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN PANEL -->
<!-- FOOTER -->
<!-- PAGE FOOTER -->
<!--
<div class="page-footer">
-->
<div>
	<div class="row">
		<div class="col-xs-12 col-sm-6">
		<!-- <span class="txt-color-white"> --> 
		<span class="txt-color-orange"> 
		<center>
			<?php 
			//echo $this->lang->line('titleweb');
			//echo '<br>';?>
			© 
			<?php 
			$year1=date('Y'); $year='2015'; 
			echo $year.' ';
			echo $this->lang->line('company');
			echo '<br>';
			echo $this->lang->line('allrightsreserved');
			//echo '<br>';
			echo $this->lang->line('copyright');
			?> 
		</center>
		 </span>  
		</div>


<?php 
#####################
/*
		<div class="col-xs-6 col-sm-6 text-right hidden-xs">
			<div class="txt-color-white inline-block">
				<i class="txt-color-blueLight hidden-mobile">Activity <i class="fa fa-clock-o"></i>  </i>
				<div class="btn-group dropup">
					<button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
						<i class="fa fa-link"></i> <span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right text-left">
						
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Server Load</p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-success" style="width: 20%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<p class="txt-color-darken font-sm no-margin">Memory Load 
                                        <span class="text-danger"> 
                                        </span></p>
								<div class="progress progress-micro no-margin">
									<div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
								</div>
							</div>
						</li>
						<li class="divider"></li>
						<li>
							<div class="padding-5">
								<button class="btn btn-block btn-default">refresh</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
 
 */ #####################
 ?>
	</div>
</div>
<hr>
<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
	<ul>
		<li>
			<a href="<?php echo base_url('sensor');?>" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-desktop fa-4x"></i> <span><?php echo $this->lang->line('sensormonitor');?> </span> </span> </a>
		</li>
		<li>
			<a href="<?php echo base_url('sensorreport');?>" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-file-text-o fa-4x"></i> <span><?php echo $this->lang->line('report');?></span> </span> </a>
		</li>
		<li>
			<a href="<?php echo base_url('hardware_config');?>" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-wrench fa-4x"></i> <span><?php echo $this->lang->line('hardwaresettings');?> </span> </span> </a>
		</li>
<?php
$alinkprofile=base_url('admin/profile'); 
 if($admin_type>=3){?>
		<li>
			<a href="<?php echo $alinkprofile; echo'/'.$user_id; ?>" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span><?php echo $this->lang->line('profile');?> </span> </span> </a>
		</li>
<?php }?>
	</ul>
</div>
		<!-- END SHORTCUT AREA -->
	</div>
</div>
<!-- ================================================== -->
<?php 
$this->load->view('inc/scripts');
if(preg_match('~\b(overview||control)\b~i', strtolower($this->uri->segment(1)))){?>
<?php 	 $this->load->view('hardware/overview_control');?>
<?php }elseif(preg_match('~\b(sensor)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/sensor'); ?>
<?php }elseif(preg_match('~\b(sensor_config)\b~i', strtolower($this->uri->segment(1)))){ ?>
<?php	$this->load->view('hardware/sensor_config'); ?>
<?php }elseif(preg_match('~\b(email_config)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/email_config');?>
<?php }elseif(preg_match('~\b(sms_config)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/sms_config');?>
<?php }elseif(preg_match('~\b(backupdb)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/backupdb');?>
<?php }elseif(preg_match('~\b(workflow)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/workflow');?>
<?php }elseif(preg_match('~\b(sms_log)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/sms_log');?>
<?php }elseif(preg_match('~\b(email_log)\b~i', strtolower($this->uri->segment(1)))){?>
<?php 	$this->load->view('hardware/email_log');?>
<?php }elseif(preg_match('~\b(hardware_config)\b~i', strtolower($this->uri->segment(1)))){?>
<?php 	$this->load->view('hardware/hardware_config');?>
<?php }elseif(preg_match('~\b(access_log)\b~i', strtolower($this->uri->segment(1)))){?>
<?php 	$this->load->view('hardware/access_log');?>
<?php }elseif(preg_match('~\b(alert_log)\b~i', strtolower($this->uri->segment(1)))){?>
<?php	$this->load->view('hardware/alert_log');?>
<?php }elseif(preg_match('~\b(members)\b~i', strtolower($this->uri->segment(1)))){?>
<?php   $this->load->view('hardware/members');?>
<?php }elseif(preg_match('~\b(event_log)\b~i', strtolower($this->uri->segment(1)))){?>
<?php   $this->load->view('hardware/event_log');?> 
<?php }elseif(preg_match('~\b(profile)\b~i', strtolower($this->uri->segment(1)))){?>
<?php   $this->load->view('hardware/profile');?> 
<?php }elseif(preg_match('~\b(sensorreport)\b~i', strtolower($this->uri->segment(1)))){?>
<?php   $this->load->view('hardware/sensorreport');?> 
<?php }?>
<?php
if(preg_match('~\b(flot)\b~i', strtolower($this->uri->segment(1)))){ 
// $this->load->view('tmon/flotjs'); 
}?>
<?php
//floorplan
if(preg_match('~\b(floorplan)\b~i', strtolower($this->uri->segment(1)))){
 $this->load->view('hardware/hw1_floorplan_locationmonitor');
}
//floorplan
if(preg_match('~\b(locationmonitor)\b~i', strtolower($this->uri->segment(1)))){
 $this->load->view('hardware/hw1_floorplan_locationmonitor');
}
?>
<!-- ================================================== -->
<script type="text/javascript">
	$(document).ready(function() {
		pageSetUp();
			var uloglang = '<?php echo $lang;?>';
			var ulogid = '<?php echo $sessuserid;?>';
				$("#logout_go").click(function(e) {
					$.SmartMessageBox({
							title : "<?php echo $this->lang->line('logout'); ?>!",
							content : "<?php echo $this->lang->line('areyousure'); ?>",
							buttons : '[No][Yes]'
					}, function(ButtonPressed) {

					if (ButtonPressed === "Yes") {
						var logoutUrl = '<?php echo base_url();?>admin/logout'+ulogid+'&ulang='+uloglang;
						window.location.href = logoutUrl
					}
					if (ButtonPressed === "No") {
						$.smallBox({
								title : "Not Logout!",
								content : "<i class='fa fa-clock-o'></i> <i>Cancel...</i>",
								color : "#C46A69",
								iconSmall : "fa fa-times fa-2x fadeInRight animated",
								timeout : 3000
							});
						}

					});
						e.preventDefault();
				});
		});
</script>
<!-- ================================================== -->
		<!-- Your GOOGLE ANALYTICS CODE Below -->
<!--
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>
-->
 </body>
</html> 