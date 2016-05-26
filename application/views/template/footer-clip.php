<?php 
########################################################################## 
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
##########################################################################
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
$dark=$this->lang->line('dark');
$blur=$this->lang->line('blur');
$light=$this->lang->line('light');
$allrightsreserved=$this->lang->line('allrightsreserved');
$home=$this->lang->line('home');
$admin=$this->lang->line('admin');
$togglesidebar=$this->lang->line('togglesidebar');
##########################################################################
$web_title=$titleweb;
##########################################################################
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
##########################################################################
?>
				</div>
			</div>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
	<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				<span class="bigger-120">
							<span class="blue bolder">&copy; <?php $year1=date('Y'); $year='2015';  echo $year;?></span>
							  <?php echo $company; echo '   '; echo $allrightsreserved;?> 
							  <br>
							  <?php echo $this->lang->line('copyright');?>
						</span>
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->
		<!-- start: RIGHT SIDEBAR -->
		<div id="page-sidebar">
			<a class="sidebar-toggler sb-toggle" href="#"><i class="fa fa-indent"></i></a>
			
			<div class="sidebar-wrapper">
				<ul class="nav nav-tabs nav-justified" id="sidebar-tab">
					<li class="active">
						<a href="#users" role="tab" data-toggle="tab"><i class="fa fa-users"></i></a>
					</li>
					<li>
						<a href="#favorites" role="tab" data-toggle="tab"><i class="fa fa-heart"></i></a>
					</li>
					<li>
						<a href="#settings" role="tab" data-toggle="tab"><i class="fa fa-gear"></i></a>
					</li>
				</ul>
				
				<!--###################################-->
					
				<div class="tab-content">
					<div class="tab-pane active" id="users">
						<div class="users-list">
							<h5 class="sidebar-title"><?php echo $this->lang->line('notify');?></h5>
							<ul class="media">
								<?php ################
								$url=base_url();
								$json_string=$url.'api/jsonfile/sd_email_lists.json';
								$jsondata=file_get_contents($json_string);
								$data_ret=json_decode($jsondata,true);
								$count=count($data_ret);
								$arr =$data_ret;
								//Debug($data_ret);Die();
								if($count > 0){
								 for($i=0; $i<$count; $i++){
									$email_username[$i]=$arr[$i]['email_username'];
									$email_account[$i]=$arr[$i]['email_account'];
								 }
								}else{
								echo 'Error 200';
								   $urlsend=base_url().'api/sd_email_lists.php';
									// Get cURL resource
									$curl = curl_init();
									// Set some options - we are passing in a useragent too here
									curl_setopt_array($curl, array(
										CURLOPT_RETURNTRANSFER => 1,
										CURLOPT_URL => $urlsend,
										CURLOPT_USERAGENT => 'cURL Request Data'
									));
									// Send the request & save response to $resp
									$resp = curl_exec($curl);
									// Close request to clear up some resources
									curl_close($curl);
								
								}	
											   for($i=0; $i<$count; $i++){
								?>
								<hr/>
								<i class="ace-icon fa fa-square bigger-110"></i>
								<?php echo $this->lang->line('name'); ?><?php  echo "<b><font color='Red'> $email_username[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('email'); ?><?php  echo "<font color='Green'> $email_account[$i] </font>";?>
								<br/>
								<?php }?>		
							</ul>
						</div>
					</div>
					
				<!--###################################-->		
					<div class="tab-pane" id="favorites">
						<div class="users-list">
							<h5 class="sidebar-title"><?php echo $this->lang->line('hardware');?></h5>
							<ul class="media">
								<?php ################
								$url=base_url();
								$json_string=$url.'api/jsonfile/sd_hardware.json';
								$jsondata=file_get_contents($json_string);
								$data_ret=json_decode($jsondata,true);
								$count=count($data_ret);
								$arr =$data_ret;
								//Debug($data_ret);Die();
								if($count > 0){
								 for($i=0; $i<$count; $i++){
									$hardware_id[$i]=$arr[$i]['hardware_id'];
									$hardware_type_id[$i]=$arr[$i]['hardware_type_id'];
									$hardware_name[$i]=$arr[$i]['hardware_name'];
									$hardware_decription[$i]=$arr[$i]['hardware_decription'];
									$hardgroup_name[$i]=$arr[$i]['hardgroup_name'];
									$hardware_ip[$i]=$arr[$i]['hardware_ip'];
									$port[$i]=$arr[$i]['port'];
									$location_id[$i]=$arr[$i]['location_id'];
									$date[$i]=$arr[$i]['date'];
									$vendor[$i]=$arr[$i]['vendor'];
									$sn[$i]=$arr[$i]['sn'];
									$model[$i]=$arr[$i]['model'];
									$status[$i]=$arr[$i]['status'];
									$hardware_type_name[$i]=$arr[$i]['hardware_type_name'];
									$location_name[$i]=$arr[$i]['location_name'];
									$location_address[$i]=$arr[$i]['location_address'];
								 }
								}else{
								echo 'Error 200';
								   $urlsend=base_url().'api/sd_hardware.php';
									// Get cURL resource
									$curl = curl_init();
									// Set some options - we are passing in a useragent too here
									curl_setopt_array($curl, array(
										CURLOPT_RETURNTRANSFER => 1,
										CURLOPT_URL => $urlsend,
										CURLOPT_USERAGENT => 'cURL Request Data'
									));
									// Send the request & save response to $resp
									$resp = curl_exec($curl);
									// Close request to clear up some resources
									curl_close($curl);
								
								}	
											   for($i=0; $i<$count; $i++){
								?>
								<div class="sidebar-content"><label>
								<i class="ace-icon fa fa-square bigger-110"></i>
								<?php echo $this->lang->line('hardware'); ?><?php  echo "<b><fontfont color='Red'> $hardware_name[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('description'); ?><?php  echo "<font color='Green'> $hardware_decription[$i] </font>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('name'); ?><?php  echo "<b><font color='Green'> $hardgroup_name[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('ipaddress'); ?><?php  echo "<b><font color='Red'> $hardware_ip[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo 'Port :';?><?php  echo "<b><font color='Blue'> $port[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('date'); ?><?php  echo "<font color='Green'> $date[$i] </font>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('vendor'); ?><?php  echo "<b><font color='Green'> $vendor[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('sn'); ?><?php  echo "<b><font color='Red'> $sn[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('model'); ?><?php  echo "<b><font color='Red'> $model[$i] </font></b>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('locationmonitor'); ?><?php  echo "<font color='Green'> $location_name[$i] </font>";?>
								<br/>
								<i class="ace-icon fa fa-bullseye bigger-110"></i>
								<?php echo $this->lang->line('address'); ?><?php  echo "<font color='Green'> $location_address[$i] </font>";?>
								</label></div>
								<?php
								}
								?>		
							</ul>
						</div>
					</div>
					<!--###################################-->
					
					<div class="tab-pane" id="settings">
						 
						<h5 class="sidebar-title"><?php echo $this->lang->line('licencedata'); ?></h5>
						<ul class="media-list">
							<li class="media">
							<!--###################################-->
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-bolt bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('systemname'); ?> :<?php 
										 $systemname=$object['systemname'];
										 echo "<b><font color='Red'> $systemname </font></b>";
										 ?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-square bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('description'); ?> :<?php echo $object['description'];?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-book bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('address'); ?> :<?php echo $object['address'];?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-user bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('registerno'); ?> :<?php 
										 $registerno=$object['registerno'];
										 echo "<b><font color='Red'> $registerno </font></b>";
										 ?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-user bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('companyname'); ?> :<?php echo $object['author'];?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-code-fork bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('ipaddress'); ?> :<?php 
										 $ip=$object['ip'];
										 echo "<b><font color='Red'> $ip </font></b>";
										 ?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-home bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('mac_address'); ?> :<?php 
										 $mac_address=$object['mac_address'];
										 echo "<b><font color='Red'> $mac_address </font></b>";
										 ?>
									</label>
								</div>
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-key bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('licence_key'); ?> :<?php 
										 $licence_key=$object['licence_key'];
										 echo "<b><font color='Red'> $licence_key </font></b>";
										 ?>
									</label>
								</div>
								
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-info-circle bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('version'); ?> :<?php echo $object['version'];?>
									</label>
								</div>
								
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-envelope-o bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('email'); ?> :<?php echo $object['admin_email'];?>
									</label>
								</div>
								
							<!--###################################-->	
								<div class="checkbox sidebar-content">
									<label>
										<i class="ace-icon fa fa-mobile-phone bigger-110 hidden-480"></i>
										 <?php echo $this->lang->line('mobile'); ?> :<?php 
										 $mobile=$object['mobile'];
										 echo "<b><font color='Red'> $mobile </font></b>";
										 ?>
									</label>
								</div>
								
							<!--###################################-->	
						 
								
							</li>
						</ul>
					</div>
					<!--###################################-->
			</div>
		</div>

	<!-- end: RIGHT SIDEBAR -->
		<div id="event-management" class="modal fade" tabindex="-1" data-width="760" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title">Event Management</h4>
					</div>
					<div class="modal-body"></div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-light-grey">
							Close
						</button>
						<button type="button" class="btn btn-danger remove-event no-display">
							<i class='fa fa-trash-o'></i> Delete Event
						</button>
						<button type='submit' class='btn btn-success save-event'>
							<i class='fa fa-check'></i> Save
						</button>
					</div>
				</div>
			</div>
		</div>
		
<?php
if(preg_match('~\b(charttmon|flot)\b~i', strtolower($this->uri->segment(1)))){}else{ #charttmon
?>
	
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-2.0.2.min.js"></script>
		<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-2.0.2.min.js"><\/script>');
			}
		</script>

		<!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>-->
		<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-ui-1.10.3.min.js"></script>
		<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo base_url('theme');?>/assets/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
			}
		</script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
		<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->
		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url('theme');?>/assets/js/bootstrap/bootstrap.min.js"></script>
		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo base_url('theme');?>/assets/js/notification/SmartNotification.min.js"></script>
		<!-- JARVIS WIDGETS -->
		<script src="<?php echo base_url('theme');?>/assets/js/smartwidgets/jarvis.widget.min.js"></script>
		<!-- EASY PIE CHARTS -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
		<!-- SPARKLINES -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/sparkline/jquery.sparkline.min.js"></script>
		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/jquery-validate/jquery.validate.min.js"></script>
		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/select2/select2.min.js"></script>
		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
		<!-- browser msie issue fix -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
		<!-- FastClick: For mobile devices -->
		<script src="<?php echo base_url('theme');?>/assets/js/plugin/fastclick/fastclick.js"></script>
		<!--[if IE 7]>
		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>
		<![endif]-->
		<!-- Demo purpose only -->
		<script src="<?php echo base_url('theme');?>/assets/js/demo.js"></script>
		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url('theme');?>/assets/js/app.js"></script>
		<!--[if lt IE 9]>
		<script src="<?php //echo base_url('theme');?>/assets/plugins/respond.min.js"></script>
		<script src="<?php //echo base_url('theme');?>/assets/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?php //echo base_url('theme');?>/assets/plugins/jQuery-lib/1.10.2/jquery.min.js"></script>
		<![endif]-->
<!-- ###############################################################################-->
<!--Export Data --><!--Export Data --><!--Export Data -->
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

		<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/plugins/select2/select2.min.js"></script>
		
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootbox/bootbox.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('theme');?>/assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>

		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/tableExport.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/html2canvas.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/jquery.base64.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/jspdf/libs/sprintf.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/jspdf/jspdf.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/tableExport/jspdf/libs/base64.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/table-export.js"></script>

		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				TableExport.init();
			});
		</script>
<!--Export Data --><!--Export Data --><!--Export Data -->
 
		 <?php
         if(preg_match('~\b(admin_team|team)\b~i', strtolower($this->uri->segment(2)))){
         ?>
         <!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootstrap-paginator/src/bootstrap-paginator.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/jquery.pulsate/jquery.pulsate.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/gritter/js/jquery.gritter.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/ui-elements.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				UIElements.init();
			});
		</script>
        
        <?php }?>
        
<?php
if(preg_match('~\b(activity_logsna|setingworktime)\b~i', strtolower($this->uri->segment(1)))){
?>
<!-- ###############################################################################-->
<!-- ###############################################################################--> 
<!-- ###############################################################################-->		
<!-- ###############################################################################-->
<?php }?>

<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url('theme/assets/js/jquery.mobile.custom.min.js'); ?>'>"+"<"+"/script>");

			function AlertError(txt){
				$("#msg_txt").html(txt);
				$("#msg_error,#BG_overlay").fadeIn();
				$("#msg_error,#msg_info,#BG_overlay").delay(1000).fadeOut();
			}

			function AlertSuccess(txt){
				$("#msg_txt2").html(txt);
				$("#msg_success,#BG_overlay").fadeIn();
				$("#msg_success,#msg_info,#BG_overlay").delay(1000).fadeOut();
			}
			function Waiting(){
				$("#msg_txt3").html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>Waiting...');
				$("#msg_info,#BG_overlay").fadeIn();
				//$("#msg_success,#msg_info,#BG_overlay").delay(1000).fadeOut();
			}
			function WaitingAlert(txt){
				if(txt == '') txt = 'Waiting';
				$("#msg_txt3").html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> ' + txt + '...');
				$("#msg_info,#BG_overlay").fadeIn();
				//$("#msg_success,#msg_info,#BG_overlay").delay(1000).fadeOut();
			}		
		</script>

		<?php echo js_asset('bootstrap.min.js'); ?>
		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>		 
		  <?php echo js_asset('excanvas.min.js'); ?>
		<![endif]-->
<?php 
		echo js_asset('jquery-ui.min.js'); 
		//echo js_asset('jquery-ui.custom.min.js'); 
		echo js_asset('jquery.ui.touch-punch.min.js'); 
		echo js_asset('jquery.colorbox-min.js');

		if(preg_match('~\b(memberadd|memberedit|profile)\b~i', strtolower($this->uri->segment(2)))){

				//echo "<!-- js member form -->";				
				echo js_asset('jquery.easypiechart.min.js'); 
				echo js_asset('date-time/bootstrap-datepicker.min.js'); 
				echo js_asset('jquery.hotkeys.min.js'); 
				echo js_asset('bootstrap-wysiwyg.min.js'); 
				echo js_asset('select2.min.js'); 

				echo js_asset('jquery.knob.min.js'); 
				echo js_asset('jquery.autosize.min.js'); 
				echo js_asset('bootstrap-tag.min.js'); 

				echo js_asset('chosen.jquery.min.js'); 
				echo js_asset('fuelux/fuelux.spinner.js'); 
				echo js_asset('x-editable/bootstrap-editable.min.js'); 
				echo js_asset('x-editable/ace-editable.min.js'); 
				echo js_asset('jquery.maskedinput.min.js'); 
				echo js_asset('jquery.validate.min.js'); 

				//echo js_asset('validate.js'); 
				//echo js_asset('member.js'); 

		}else if(preg_match('~\b(add|edit|import_csv|picture_edit|picture_edit_thumb)\b~i', strtolower($this->uri->segment(2)))){

				echo js_asset('jquery-ui.custom.min.js'); 
				echo js_asset('jquery.ui.touch-punch.min.js'); 
				echo js_asset('jquery.autosize.min.js'); 
				echo js_asset('uncompressed/bootstrap-tag.js'); 
				echo js_asset('chosen.jquery.min.js'); 
				echo js_asset('fuelux/fuelux.spinner.min.js'); 
				echo js_asset('date-time/bootstrap-datepicker.min.js'); 
				echo js_asset('date-time/bootstrap-timepicker.min.js'); 
				echo js_asset('date-time/moment.min.js'); 
				echo js_asset('date-time/daterangepicker.min.js'); 
				echo js_asset('date-time/bootstrap-datetimepicker.min.js'); 
				echo js_asset('bootstrap-colorpicker.min.js'); 
				echo js_asset('jquery.knob.min.js'); 
				echo js_asset('jquery.autosize.min.js'); 
				echo js_asset('jquery.inputlimiter.1.3.1.min.js'); 
				echo js_asset('jquery.maskedinput.min.js'); 
				echo js_asset('typeahead.jquery.min.js'); 
				echo js_asset('markdown/markdown.min.js'); 
				echo js_asset('markdown/bootstrap-markdown.min.js'); 
				echo js_asset('jquery.hotkeys.min.js'); 
				//echo js_asset('bootstrap-wysiwyg.min.js'); 
				echo js_asset('jquery.nestable.js'); 

		}else if(preg_match('~\b(order)\b~i', strtolower($this->uri->segment(1)))){

				echo js_asset('jquery.nestable.js'); 

		}else{//index
				
				echo js_asset('jquery.easypiechart.min.js'); 
				echo js_asset('jquery.sparkline.min.js'); 
		}
?>

<script type="text/javascript">
jQuery(function($) {

		$('#logout').on('click', function() {
				var url = '<?php echo base_url('admin/logout'); ?>';
				//alert('xxxx ' + url);
				//window.open(url);
				bootbox.confirm("<?php echo $logout; ?> ?", function(result) {
					if(result) {
							window.location =  url;
						}
				});
		});

		$('[data-rel=tooltip]').tooltip();
		$('[data-rel=popover]').popover({html:true});

				$("#bootbox-regular").on(ace.click_event, function() {
					bootbox.prompt("What is your name?", function(result) {
						if (result === null) {
							
						} else {
							
						}
						return false;
					});
				});
});
</script>

		<!-- inline scripts related to this page -->
<?php

		if(preg_match('~\b(memberadd|memberedit|profile)\b~i', strtolower($this->uri->segment(2)))){

				echo js_asset('profile.js'); 

		}else if((preg_match('~\b(dara)\b~i', strtolower($this->uri->segment(1)))) && (preg_match('~\b(add|edit)\b~i', strtolower($this->uri->segment(2))))){

				echo js_asset('form.js'); 
				echo js_asset('form-editor.js'); 

		}else if(preg_match('~\b(add|edit)\b~i', strtolower($this->uri->segment(2)))){

				echo js_asset('form.js'); 

		}else if(preg_match('~\b(chart)\b~i', strtolower($this->uri->segment(1)))){

				//echo js_asset('chart.js'); 
				//echo js_asset('morris/raphael-2.1.0.min.js'); 
				//echo js_asset('morris/morris.js'); 
				//echo js_asset('morris/chart-data-morris.js');	//data morris.js Charts panel-primary
				//echo js_asset('morris/morris-demo.js');		//data Charts panel-default
				//echo js_asset('morris/morris-ready.js');
	}else if(preg_match('~\b(overview)\b~i', strtolower($this->uri->segment(1)))){
?>


<script type="text/javascript">
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
	$(document).ready(function() {
			
			pageSetUp();
  $(function(){
      function load_hw1_json(){
      $('#s1_humi').load('<?php echo base_url();?>hwdata/overview/data_s1_humi.php',function(data){
      });

      $('#s1_temp').load('<?php echo base_url();?>hwdata/overview/data_s1_temp.php',function(data){
      });

      $('#s2_temp').load('<?php echo base_url();?>hwdata/overview/data_s2_temp.php',function(data){
      });

      $('#s3_temp').load('<?php echo base_url();?>hwdata/overview/data_s3_temp.php',function(data){
      });

      $('#s4_temp').load('<?php echo base_url();?>hwdata/overview/data_s4_temp.php',function(data){
      });

      $('#s5_temp').load('<?php echo base_url();?>hwdata/overview/data_s5_temp.php',function(data){
      });

      $('#s6_temp').load('<?php echo base_url();?>hwdata/overview/data_s6_temp.php',function(data){
      });

      $('#s7_temp').load('<?php echo base_url();?>hwdata/overview/data_s7_temp.php',function(data){
      });

      $('#s21_humi').load('<?php echo base_url();?>hwdata/overview/data_s21_humi.php',function(data){
      });

      $('#s21_temp').load('<?php echo base_url();?>hwdata/overview/data_s21_temp.php',function(data){
      });

      $('#s22_temp').load('<?php echo base_url();?>hwdata/overview/data_s22_temp.php',function(data){
      });

      $('#s23_temp').load('<?php echo base_url();?>hwdata/overview/data_s23_temp.php',function(data){
      });

      $('#s24_temp').load('<?php echo base_url();?>hwdata/overview/data_s24_temp.php',function(data){
      });

      $('#s25_temp').load('<?php echo base_url();?>hwdata/overview/data_s25_temp.php',function(data){
      });

      $('#s26_temp').load('<?php echo base_url();?>hwdata/overview/data_s26_temp.php',function(data){
      });

      $('#s27_temp').load('<?php echo base_url();?>hwdata/overview/data_s27_temp.php',function(data){
      });

    }
    load_hw1_json();
     setInterval(load_hw1_json,1000);
  });
 



 
	$('#load_sensor_config').load('<?php echo base_url();?>hwdata/overview/loadsensorconfig.php',function(datahw4){
	});

	$('#emailconf').load('<?php echo base_url();?>hwdata/overview/loademailconfig.php',function(datahw4){
	});

	$('#smslists').load('<?php echo base_url();?>hwdata/overview/loadersmslist.php',function(datahw4){
	});

	$('#emaillist').load('<?php echo base_url();?>hwdata/overview/loaderemaillist.php',function(datahw4){
	});



    $(function(){
	      function load_hw3_json(){
	      $('#load_hw3').load('<?php echo base_url();?>hwdata/overview/loadhw3json.php',function(datahw4){
	      });
	    }
	    load_hw3_json();
	     setInterval(load_hw3_json,500);
	}); 

	$(function(){
	      function load_hw4_json(){
	      $('#load_hw4').load('<?php echo base_url();?>hwdata/overview/loadhw4json.php',function(datahw4){
	      });
	    }
	    load_hw4_json();
	     setInterval(load_hw4_json,500);
	}); 
 

	/* Alert Log */
 
				function getDataFromDb()
				{
				  $.ajax({ 
				        url: "<?php echo base_url();?>hwdata/overview/getData.php" ,
				        type: "POST",
				        data: ''
				      })
				      .success(function(result) { 
				        var obj = jQuery.parseJSON(result);
				          if(obj != '')
				          {
				              $("#myBody").empty();
				              $.each(obj, function(key, val) {

				                  if(val["alert_status"] == 'Alert'){
				                    var label_x = "<span class='label label-danger'>";
				                  }else if(val["alert_status"] == 'Warning' ){
				                    var label_x = "<span class='label label-warning'>";
				                  }else{
				                    var label_x = "<span class='label label-success'>";
				                  }
				                    var tr = "<tr>";
				                    tr = tr + "<td>" + val["sensor_alert_log_id"] + "</td>";
                            tr = tr + "<td>" + val["sensor_hwname"] + "</td>";
				                    tr = tr + "<td>" + val["sensor_name"] + "</td>";
				                    tr = tr + "<td>" + val["sensor_type"] + "</td>";
				                    tr = tr + "<td>" + val["sensor_value"] + "</span></td>";
				                    tr = tr + "<td>" + label_x + val["alert_status"] + "</span></td>";
				                    tr = tr + "<td>" + val["datetime_alert"]+ "</td>";
				                    tr = tr + "</tr>";
				                  $('#myTable > tbody:last').append(tr);
				              });
				          }

				      });

				}

				setInterval(getDataFromDb, 1000); // 1000 = 1 second
  
				/* Alert Log */



	});
</script>
	
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE overview ONLY -->
		<script src="<?php echo base_url('theme');?>/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/jQRangeSlider/jQAllRangeSliders-min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/jQuery-Knob/js/jquery.knob.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/js/ui-sliders.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE overview ONLY -->
		<script>
			jQuery(document).ready(function() {
				Index.init();
				//Main.init();
				UISliders.init();
			});
		</script>
		
		
<?php
}else if(preg_match('~\b(sensor|sensorreport)\b~i', strtolower($this->uri->segment(1)))){
?>
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
<?php }else{
				//echo js_asset('index.js'); 
		}
?>
		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
<?php 
		//echo css_asset('ace.onpage-help.css'); 
?>
		<!-- <link rel="stylesheet" href="<?php echo base_url('docs/assets/js/themes/sunburst.css'); ?>" /> -->

		<!-- <script type="text/javascript"> ace.vars['base'] = '..'; </script> -->
<?php 
		//echo js_asset('ace/elements.onpage-help.js'); 
		//echo js_asset('ace/ace.onpage-help.js'); 		
?>

<?php
		/*if((strtolower($this->uri->segment(1)) == "dara") && (strtolower($this->uri->segment(2)) == "edit")){
			echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.js"></script>';
			echo js_asset('jquery.tagbox.js'); 
		}else
			echo js_asset('chosen.jquery.min.js');*/

?>

		<!-- ace scripts -->
<?php 
		echo js_asset('jquery.gritter.min.js'); 	
		echo js_asset('dataTables/jquery.dataTables.js');
		echo js_asset('dataTables/dataTables.bootstrap.js');
		//echo js_asset('spin.min.js'); 
		echo js_asset('bootbox.min.js'); 
		echo js_asset('ace-elements.min.js'); 
		//echo js_asset('ace.min.js'); 
?>

<?php }#charttmon?>	
<!-- ###############################################################################-->
<!-- ###############################################################################-->
<!-- ###############################################################################-->
<!-- ###############################################################################-->

<!-- ###############################################################################-->
<!-- ###############################################################################-->
<!-- ###############################################################################-->
<!-- ###############################################################################-->



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
	<!-- end: BODY -->
</html>