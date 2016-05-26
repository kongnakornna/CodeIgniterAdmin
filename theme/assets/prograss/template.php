 	<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/prograss/lib/nprogress.css" />
	<script src="<?php echo base_url('theme');?>/assets/prograss/src/jquery-latest.min.js"></script>
	<script src="<?php echo base_url('theme');?>/assets/prograss/lib/nprogress.js"></script>
	<script src="<?php echo base_url('theme');?>/assets/prograss/src/animations/jquery.big-counter.js"></script>
	<script src="<?php echo base_url('theme');?>/assets/prograss/src/jquery.html5Loader.js"></script>
	<div id="html5Loader"></div>
	<div id="wrapper" style="opacity:0;filter:alpha(opacity=0)"></div>
	<script type="text/javascript">
	NProgress.start();
	$.html5Loader({
			filesToLoad:'<?php echo base_url('theme');?>/assets/prograss/src/files.json',
			onUpdate: function(perc){
				NProgress.set(perc/100);
			},
			stopExecution:true,
			onComplete: function () {
				NProgress.done(true);
				setTimeout(function(){
					$("#wrapper").animate({
						opacity:1
					},'slow');
				},1000);
				console.log("loaded!");
			},
			onElementLoaded: function ( obj, elm ){
				if(!~$.inArray(obj.type,["TEXT","SCRIPT","CSS"])) {
					$("#wrapper").append(elm);
				}
			}
	});
	</script>
<?php
if($this->uri->segment(1)=='admin'||$this->uri->segment(1)=='accessmenu'|| $this->uri->segment(1)=='admin_menu'|| $this->uri->segment(1)=='events'|| $this->uri->segment(1)=='basic'|| $this->uri->segment(1)=='activity_logsna'|| $this->uri->segment(1)=='databasemanage'|| $this->uri->segment(1)=='calerdarconjobs'|| $this->uri->segment(1)=='uploadplan'|| $this->uri->segment(1)=='hardware'|| $this->uri->segment(1)=='hardwareconfig'|| $this->uri->segment(1)=='hardwaretype'|| $this->uri->segment(1)=='hardwaretype'|| $this->uri->segment(1)=='calibration'|| $this->uri->segment(1)=='setingworktime'|| $this->uri->segment(1)=='setingeventalerm'|| $this->uri->segment(1)=='emailsetting'|| $this->uri->segment(1)=='smsseting'|| $this->uri->segment(1)=='sensormanage'|| $this->uri->segment(1)=='emailalertlog'|| $this->uri->segment(1)=='smsalertlog'|| $this->uri->segment(1)=='sensorlogs'|| $this->uri->segment(1)=='province'|| $this->uri->segment(1)=='amphur'|| $this->uri->segment(1)=='district'|| $this->uri->segment(1)=='village'|| $this->uri->segment(1)=='setingworktime'|| $this->uri->segment(1)=='alarmwaterleakreport'|| $this->uri->segment(1)=='apihw'|| $this->uri->segment(1)=='userlogs'|| $this->uri->segment(1)=='setting'|| $this->uri->segment(1)=='activity_logs'|| $this->uri->segment(1)=='sensorreport'||$this->uri->segment(1)=='alarmlogreport'|| $this->uri->segment(1)=='sensorconfig'|| $this->uri->segment(1)=='team'||$this->uri->segment(1)=='geography'||$this->uri->segment(1)=='countries'|| $this->uri->segment(1)=='report'|| $this->uri->segment(1)=='sensor'|| $this->uri->segment(1)=='conditionscontrols'||$this->uri->segment(1)=='setingeventalarm'||$this->uri->segment(1)=='waterleakreport'||$this->uri->segment(1)=='callsetup'|| $this->uri->segment(1)=='charttmon'|| $this->uri->segment(1)=='flot' || $this->uri->segment(1)=='calibrationsensor' || $this->uri->segment(1)=='alarmconfig'|| $this->uri->segment(1)=='callalertlog'|| $this->uri->segment(1)=='plan'|| $this->uri->segment(1)=='hardwarealert'|| $this->uri->segment(1)=='locationplan'|| $this->uri->segment(1)=='hostmedia'|| $this->uri->segment(1)=='hostmediatype'|| $this->uri->segment(1)=='hardwarecontrolconfig'|| $this->uri->segment(1)=='chartsteelseries'|| $this->uri->segment(1)=='hardwaremonitorsetting'){

$this->load->view('template/header-clip');	

}else if($this->uri->segment(1)=='overview'|| $this->uri->segment(1)=='workflow'|| $this->uri->segment(1)=='floorplan'|| $this->uri->segment(1)=='control'|| $this->uri->segment(1)=='locationmonitor'){ 

$this->load->view('template/header-smart');  

}else{  

$this->load->view('template/header');

}



#start: PAGE CONTENT  
################################## Body Content ################################
if(isset($content_view) && !isset($content_data)){$this->load->view($content_view); 
	}if(isset($content_view) && isset($content_data)){
		foreach($content_data as $key =>$value){$data[$key] = $value;}
		$this->load->view($content_view,$data);
	}
################################## Body Content ################################


#end:PAGE CONTENT 
if($this->uri->segment(1)=='admin'|| $this->uri->segment(1)=='accessmenu'||$this->uri->segment(1)=='admin_menu'||$this->uri->segment(1)=='calendar'|| $this->uri->segment(1)=='events'|| $this->uri->segment(1)=='basic'|| $this->uri->segment(1)=='activity_logsna'|| $this->uri->segment(1)=='databasemanage'|| $this->uri->segment(1)=='calerdarconjobs'|| $this->uri->segment(1)=='uploadplan'|| $this->uri->segment(1)=='hardware'|| $this->uri->segment(1)=='hardwareconfig'|| $this->uri->segment(1)=='hardwaretype'|| $this->uri->segment(1)=='callsetup'|| $this->uri->segment(1)=='calibration'|| $this->uri->segment(1)=='setingworktime'|| $this->uri->segment(1)=='setingeventalerm'|| $this->uri->segment(1)=='emailsetting'|| $this->uri->segment(1)=='smsseting'|| $this->uri->segment(1)=='sensormanage'|| $this->uri->segment(1)=='emailalertlog'|| $this->uri->segment(1)=='smsalertlog'|| $this->uri->segment(1)=='sensorlogs'|| $this->uri->segment(1)=='province'|| $this->uri->segment(1)=='amphur'|| $this->uri->segment(1)=='district'|| $this->uri->segment(1)=='village'|| $this->uri->segment(1)=='setingworktime'|| $this->uri->segment(1)=='alarmwaterleakreport'|| $this->uri->segment(1)=='apihw'|| $this->uri->segment(1)=='userlogs'|| $this->uri->segment(1)=='setting'|| $this->uri->segment(1)=='activity_logs'|| $this->uri->segment(1)=='sensorreport' ||$this->uri->segment(1)=='alarmlogreport'|| $this->uri->segment(1)=='sensorconfig'|| $this->uri->segment(1)=='team'||$this->uri->segment(1)=='geography'||$this->uri->segment(1)=='countries'||$this->uri->segment(1)=='report'|| $this->uri->segment(1)=='sensor'|| $this->uri->segment(1)=='conditionscontrols'||$this->uri->segment(1)=='setingeventalarm'||$this->uri->segment(1)=='waterleakreport'||$this->uri->segment(1)=='callsetup'|| $this->uri->segment(1)=='charttmon'|| $this->uri->segment(1)=='flot' || $this->uri->segment(1)=='calibrationsensor' || $this->uri->segment(1)=='alarmconfig'|| $this->uri->segment(1)=='callalertlog'|| $this->uri->segment(1)=='plan'|| $this->uri->segment(1)=='hardwarealert'|| $this->uri->segment(1)=='locationplan'|| $this->uri->segment(1)=='hostmedia'|| $this->uri->segment(1)=='hostmediatype'|| $this->uri->segment(1)=='hardwarecontrolconfig'|| $this->uri->segment(1)=='chartsteelseries'|| $this->uri->segment(1)=='hardwaremonitorsetting'){ 

$this->load->view('template/footer-clip');

}else if($this->uri->segment(1)=='overview' || $this->uri->segment(1)=='workflow'|| $this->uri->segment(1)=='control'|| $this->uri->segment(1)=='locationmonitor'){ 

$this->load->view('template/footer-smart');

}else if($this->uri->segment(1)=='floorplan'){ 
$this->load->view('template/footer-smart');
}else{ 

$this->load->view('template/footer');

}
?>
