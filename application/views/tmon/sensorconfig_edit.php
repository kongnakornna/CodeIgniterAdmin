<script type='text/javascript' src='<?php echo base_url('theme');?>/assets/tween.js'></script>
<script type='text/javascript' src='<?php echo base_url('theme');?>/assets/steelseries.js'></script>
<body onload='init()'>
<?php 
$admin_type=$this->session->userdata('admin_type');
$language = $this->lang->language; 
#Debug($sensorconfig_list);die();
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('sensorconfig/save', $attributes);
?>
									<div class="page-header">
										<h3>&nbsp;&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['sensorsettings'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$sensorconfig_list[0]['sensor_name'] ?>
											</small>
										</h3>
									</div>
									<div class="col-xs-12">

<?php
if(function_exists('Debug')){
					//Debug($sensorconfig_list);
					//Debug($parent);
			}
//Debug($sensorconfig_list);
  $countitem = count($sensorconfig_list);
  $sensor_config_id=$sensorconfig_list[0]['sensor_config_id'];
  $sensor_config_id_map=$sensorconfig_list[0]['sensor_config_id_map'];
  $hardware_id=$sensorconfig_list[0]['hardware_id'];
  $sensor_group_en=$sensorconfig_list[0]['sensor_group'];
  $sensor_name_en=$sensorconfig_list[0]['sensor_name'];
  $sensor_type_id=$sensorconfig_list[0]['sensor_type_id'];
  $sensor_high=$sensorconfig_list[0]['sensor_high'];
  $sensor_warning=$sensorconfig_list[0]['sensor_warning'];
  $alert=$sensorconfig_list[0]['alert'];
  $sn=$sensorconfig_list[0]['sn'];
  $model=$sensorconfig_list[0]['model'];
  //$date=$sensorconfig_list[0]['date'];
  $date=date('Y-m-d H:i:s');
  $vendor=$sensorconfig_list[0]['vendor'];
  $status=$sensorconfig_list[0]['status'];
  $sensor_type_name=$sensorconfig_list[0]['sensor_type_name'];
  $status=$sensorconfig_list[0]['status'];
  $sensor_type_id_map=$sensorconfig_list[0]['sensor_type_id_map'];
  
  $sensor_group_th=$sensorconfig_list[1]['sensor_group'];
  $sensor_name_th=$sensorconfig_list[1]['sensor_name'];
  
    $lang=$this->lang->line('lang');
	if($lang==='en'){
    $sensor_type_name=$sensorconfig_list[0]['sensor_type_name'];
	}else{
    $sensor_type_name=$sensorconfig_list[1]['sensor_type_name'];
    }
$size='130';			//$_REQUEST['size'];
$min='-20';		//$_REQUEST['min'];
$max='100';			//$_REQUEST['max'];
$width='100';
$height='250';
$width2='70';
$height2='160';
$threshold2=$sensorconfig_list[0]['alert'];  # ไฟกระพริบ
$threshold3=$sensor_high;  # ไฟกระพริบ
$threshold4=$sensor_warning;  # ไฟกระพริบ
$threshold5=$sensorconfig_list[0]['alert'];  # ไฟกระพริบ
$threshold6=$sensorconfig_list[0]['alert'];  # ไฟกระพริบ
$threshold7=$sensorconfig_list[0]['alert'];  # ไฟกระพริบ
$b=$threshold2;	
$c=$threshold3;			 
$d=$threshold4;	
$e=$threshold5;	
$f=$threshold6;	
$g=$threshold7;	
$h=$threshold7;			
$name2=$language['alert'];	 
$name3=$language['alert'];
$name4=$language['statuswarning'];
 if($sensor_type_id_map=='1'){
$type2=' ';
$type3='C';
$type4='C';
}else if($sensor_type_id_map=='2'){
$type2=' ';
$type3='H';
$type4='H';
}else{
$type2='';
$type3='';
$type4='';
}
 
////////////

$name5=$language['alert'];	
$name6=$language['alert'];	
$name7=$language['alert'];	
//////////
$type5='';
$type6='';
$type7='';
	
	
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											Oh snap!</strong><?php echo $error?>.
									<br>
							</div>
				</div>
<?php
			}
?>
									<!-- #section:elements.form -->
 					
<!-- ################################## -->		
 

							
<div class="form-group">

<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?> ID </label>
 <div class="col-sm-9">
 <input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="sensor_config_id" name="sensor_config_id" value="<?php echo $sensor_config_id_map; ?>">


<?php if($admin_type==1){?>
<?php echo $ListSelectHardware;?>
<?php }else{?> <span class="label label-success"> <?php echo $hardware_id ?> </span>
<input type="hidden" class="col-xs-1 col-sm-1" placeholder="title" id="hardware_id" name="hardware_id" value="<?php echo $hardware_id ?>">
<?php //echo $hardware_id; ?>
<?php }?>

</div>
</div>
<!-- ################################## -->									
 
 
 <!-- ################################## -->		
<?php if($admin_type==1){?>							
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<div class="col-sm-9">
<input name="sensor_group_en" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_en; ?>" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>
<?php }else{?>
<input name="sensor_group_en" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_en; ?>" placeholder="<?php echo $language['mainhardware']?>">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<?php echo $sensor_group_en; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> EN </label>
<div class="col-sm-9">
<input name="sensor_name_en" type="text" class="col-xs-8 col-sm-4" id="sensor_name_en" value="<?php echo $sensor_name_en;?>" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<?php }else{?>
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sensor']?> " id="sensor_name_en" name="sensor_name_en" value="<?php echo $sensor_name_en;?>">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> EN </label>
<div class="col-sm-9">
<?php echo $sensor_group_en; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9">
<input name="sensor_group_th" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_th; ?>" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>
<?php }else{?>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9">
<input name="sensor_group_th" type="hidden" class="col-xs-10 col-sm-5" id="sensor_group" value="<?php echo $sensor_group_th; ?>" placeholder="<?php echo $language['mainhardware']?>">
<?php echo $sensor_group_th; ?>
</div>
</div>
<?php }?><?php if($admin_type==1){?>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> TH </label>
<div class="col-sm-9">
<input name="sensor_name_th" type="text" class="col-xs-8 col-sm-4" id="sensor_name_th" value="<?php echo $sensor_name_th;?>" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<?php }else{?>
<input name="sensor_name_th" type="hidden" class="col-xs-8 col-sm-4" id="sensor_name_th" value="<?php echo $sensor_name_th;?>" placeholder="<?php echo $language['sensor']?> ">
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> TH </label>
<div class="col-sm-9">
<?php echo $sensor_name_th;?>
</div>
</div>
<?php }?>
<!-- ################################## -->		
 
 
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensortype']?> : </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<?php echo $ListSelectSensortype; #echo $sensor_type_name; ?>
<?php  }else{?> 
<input type="hidden"  class="col-xs-1 col-sm-1" placeholder="<?php echo $language['sensortype']?>" id="sensor_type_id" name="sensor_type_id" value="<?php echo $sensor_type_id ?>">
 <span class="label label-success"> 
<?php  echo $sensor_type_name;?> </span><?php }?>
</div>
</div>								
<!-- ################################## -->					
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> <canvas id='canvas3' width='100%' height='100%'></canvas>  </label>
<div class="col-sm-9">
<br /><span class="label label-danger"><?php echo $language['statushigh']?></span> <br />
 <input type="text" class="col-xs-3 col-sm-3" placeholder="<?php echo $language['statushigh']?>" id="sensor_high" name="sensor_high" value="<?php echo $sensor_high ?>">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> <canvas id='canvas4' width='100%' height='100%'></canvas>  </label>
<div class="col-sm-9">
<br /><span class="label label-warning"><?php echo $language['statuswarning']?> </span><br />
 <input type="text" class="col-xs-3 col-sm-3" placeholder="<?php echo $language['statuswarning']?>" id="sensor_warning" name="sensor_warning" value="<?php echo $sensor_warning; ?>">
</div>
</div>


<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right">&nbsp;<canvas id="canvasLinear7" width="<?php echo $width2;?>" height="<?php echo $height2;?>"></canvas> &nbsp; &nbsp; &nbsp;</label>
<div class="col-sm-9">
<br /><span class="label label-warning"><?php echo $language['alert']?> </span><br />
<?php if($admin_type==1 || $admin_type==2){?>
<input type="text" class="col-xs-3 col-sm-2" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="<?php echo $alert; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-3 col-sm-2" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="<?php echo $alert; ?>">
<span class="label label-success"> <?php  echo $alert;?> </span><?php }?>
</div>
</div>
<!-- ################################## -->	





<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['model']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model" value="<?php echo $model; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model" value="<?php echo $model; ?>">
<span class="label label-success"> <?php  echo $model;?> </span><?php }?>
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sn']?> </label>
<div class="col-sm-9">


<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn" value="<?php echo $sn; ?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn" value="<?php echo $sn; ?>">
<span class="label label-success"> <?php  echo $sn; ?> </span><?php }?>


</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['vendor']?> </label>
<div class="col-sm-9">
<?php if($admin_type==1){?>
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['vendor']?>" id="vendor" name="vendor" value="<?php echo $vendor;?>">
<?php }else{?> 
<input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['vendor']?>" id="vendor" name="vendor" value="<?php echo $vendor;?>">
<span class="label label-success"> <?php  echo $vendor; ?> </span><?php }?>

</div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
 <span class="label label-success"> 
<?php echo $date ?>
</span>
<input name="status" type="hidden" value="<?php echo $status; ?>" /></div>
</div>
<!-- ################################## -->											
 							
<!-- ################################## -->	
						</div>

								
		                   <div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<?php echo $language['reset']?>
											</button>
										</div>
									</div>
									<br />
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->

<script>
//=================================================================================		
function init(){
// Define some sections
  var sections = Array(steelseries.Section(22, 24, 'rgba(0, 0, 220, 0.3)'),     //  
                       steelseries.Section(25, 27, 'rgba(0, 220, 0, 0.3)'),     //  
                       steelseries.Section(28, 30, 'rgba(220, 0, 0, 0.3)'));    //  
//=================================================================================							   
   valGrad = new steelseries.gradientWrapper(  20, // 
                                               85,
                                             [ 0, 0.33, 0.66, 0.85, 1],
                                             [ new steelseries.rgbaColor(0, 0, 200, 1),    //  
                                               new steelseries.rgbaColor(0, 200, 0, 1),    //  
                                               new steelseries.rgbaColor(200, 200, 0, 1),  //  
                                               new steelseries.rgbaColor(200, 0, 0, 1),    //  
                                               new steelseries.rgbaColor(200, 0, 0, 1) ]);											   
 //=================================================================================		 
// Define one area
  var areas = Array(steelseries.Section(28, 30, 'rgba(220, 0, 0, 0.3)'));
//=================================================================================	
	        
                          
//=================================================================================		
// Create a second radial gauge    
 							
// Create a radial bargraph gauge
  var radial3 = new steelseries.RadialBargraph('canvas3', {
                    gaugeType: steelseries.GaugeType.TYPE3,
					valueGradient: valGrad, //////
					useValueGradient: true,	
					size: <?php echo $size;?>,       // 
					minValue: <?php echo $min;?>,   // 
                    maxValue: <?php echo $threshold3; //echo $max;?>,   // 
					threshold: <?php echo $threshold3;?>,  // 
                    titleString: "<?php echo $name3;?>",                                
                    unitString: "<?php echo $type3;?>",          
                    frameDesign: steelseries.FrameDesign.BLACK_METAL,
                    backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY,
                //    valueColor: steelseries.ColorDef.YELLOW,  //  
               //     lcdColor: steelseries.LcdColor.YELLOW,
               //     ledColor: steelseries.LedColor.YELLOW_LED,  //  
                    }); 
//=================================================================================
// Create a radial bargraph gauge
  var radial4 = new steelseries.RadialBargraph('canvas4', {
                    gaugeType: steelseries.GaugeType.TYPE4, //  
					valueGradient: valGrad,  //////////
					useValueGradient: true,					
					size: <?php echo $size;?>,       //  
					minValue: <?php echo $min;?>,   //  
                    maxValue: <?php echo $threshold4; //echo $max;?>,   //  
					threshold: <?php echo $threshold4;?>,  //  
                    titleString: "<?php echo $name4;?>",                                
                    unitString: "<?php echo $type4;?>",          
                    frameDesign: steelseries.FrameDesign.BLACK_METAL,
                  //  backgroundColor: steelseries.BackgroundColor.LIGHT_GRAY,
                    valueColor: steelseries.ColorDef.YELLOW,  //  
                    lcdColor: steelseries.LcdColor.BLUE,      //  
                    ledColor: steelseries.LedColor.YELLOW_LED,  //  
                    }); 

//=================================================================================					
					
// Let's set some values...  
 
  radial3.setValueAnimated(<?php echo $c; ?>); 
  radial4.setValueAnimated(<?php echo $d; ?>);
//=================================================================================		
 
 
//=================================================================================		
// Initializing gauge
 
//=================================================================================		
// Initializing gauge

  var linear7;
// Initializing gauge
        linear7 = new steelseries.LinearBargraph('canvasLinear7', {
							gaugeType: steelseries.GaugeType.TYPE7,
                            width: <?php echo $width2;?>,
                            height: <?php echo $height2;?>,
							minValue: <?php echo $min;?>,    
                   			maxValue: <?php echo $threshold7; //echo $max;?>, 
							valueGradient: valGrad,
                            useValueGradient: true,
                            titleString: "<?php echo $name7;?>",
                            unitString: "<?php echo $type7;?>",
                            threshold: <?php echo $threshold7;?>,
                            lcdVisible: true });

// Start the random update

        setInterval(function(){ setRandomValue7(linear7, <?php echo $max;?>); }, 1000); 


	 function setRandomValue7(gauge, range) {
		gauge.setValueAnimated(<?php echo $h; ?>); }
        //gauge.setValueAnimated7(Math.random() * range); }

    function setFrameDesign(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "RED":
                linear7.setValueColor(steelseries.ColorDef.RED);
        } }

    function setLcdColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "BEIGE":
                linear7.setLcdColor(steelseries.LcdColor.BEIGE);
        } }
    function setLedColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "RED_LED":
                linear7.setLedColor(steelseries.LedColor.RED_LED);
        } }
      }
</script>
</body>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/tween-min.js"></script>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/steelseries-min.js"></script>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/jquery-1.10.2.js"></script>