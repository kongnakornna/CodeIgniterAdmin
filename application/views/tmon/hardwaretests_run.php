
<?php 
$language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
$location_id='1';
// Debug($hardwaretestrun_list);Die();
//Debug($hardware_list);Die();

$hardwaretestrun_id_map=$hardwaretestrun_list[0]['hardwaretestrun_id_map'];
$hardwaretest_name=$hardwaretestrun_list[0]['hardwaretest_name'];

$key='0';
$hardwaretest_id=$hardware_list[$key]['hardwaretest_id'];
$hardwaretest_id_map=$hardware_list[$key]['hardwaretest_id_map'];
$electricity_type_id_map=$hardware_list[$key]['electricity_type_id_map'];
$waterpipe_id_map=$hardware_list[$key]['waterpipe_id_map'];
$hardwaretest_name=$hardware_list[$key]['hardwaretest_name'];
$hardwaretest_decription=$hardware_list[$key]['hardwaretest_decription'];
$hw_pump_id=$hardware_list[$key]['hw_pump_id'];
$flow_id=$hardware_list[$key]['flow_id'];
$current_id=$hardware_list[$key]['current_id'];
$voltage_id=$hardware_list[$key]['voltage_id'];
$power_id=$hardware_list[$key]['power_id'];
$control_id=$hardware_list[$key]['control_id'];
$create_date=$hardware_list[$key]['create_date'];
$status=$hardware_list[$key]['status'];

 
 					#################3
					$hw_pump_id=$hardware_list[$key]['hw_pump_id'];
                    $pump=$this->Hardwaretest_model->get_hardwareapi($hw_pump_id,$status=1);
					 //Debug($pump); //Die();
					$pump_name=$pump[0]['hardware_name'];
					$pump_ip=$pump[0]['hardware_ip'];
					//////					
					$flow_id=$hardware_list[$key]['flow_id'];
					$flow=$this->Hardwaretest_model->get_hardwareapi($flow_id,$status=1);
					//Debug($flow);
					$flow_name=$flow[0]['hardware_name'];
					$flow_ip=$flow[0]['hardware_ip'];
					/////
					$current_id=$hardware_list[$key]['current_id'];
					$current=$this->Hardwaretest_model->get_hardwareapi($current_id,$status=1);
					//Debug($current);
					$current_name=$current[0]['hardware_name'];
					$current_ip=$current[0]['hardware_ip'];
					/////
					$voltage_id=$hardware_list[$key]['voltage_id'];
					$voltage=$this->Hardwaretest_model->get_hardwareapi($voltage_id,$status=1);
					//Debug($voltage);
					$voltage_name=$voltage[0]['hardware_name'];
					$voltage_ip=$voltage[0]['hardware_ip'];
					/////
					$power_id=$hardware_list[$key]['power_id'];
					$power=$this->Hardwaretest_model->get_hardwareapi($power_id,$status=1);
					//echo '$power_id='.$power_id;Debug($power);die();
					$power_name=$power[0]['hardware_name'];
					$power_ip=$power[0]['hardware_ip'];
					####################
$min='-100';
$max='500';
$single1='0';
$single2='0';
$single3='0';
$single4='0';
$single5='0';
$single6='0';
$singlemax1='200';
$singlemax2='200';
$singlemax3='200';
$singlemax4='200';
$singlemax5='200';
$singlemax6='200';
$width='90';
$height='30';
?>
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwaretest/save', $attributes);
?>
<body onLoad="init()">
<table width="100%" border="0">
  <tr>
    <td width="4%"> 
         
      <div class="clearfix form-actions">
 
    </div>	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	</td>
    <td width="70%">
<div class="col-xs-12"> <br />

<!-- PAGE CONTENT BEGINS -->						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<button class="btn btn-sm btn-primary">
								<i class="clip-cog-2"></i> <?php echo $language['start'] ?> 
								</button>
								
								<button class="btn btn-sm btn-primary" onClick="window.location='<?php echo site_url('hardwaretest/pcurve') ?>';">
								<i class="clip-cog-2"></i> P-curve
								</button>
								
								<button class="btn btn-sm btn-primary" onClick="window.location='<?php echo site_url('hardwaretest/ecurve') ?>';">
								<i class="clip-cog-2"></i>  E-curve
								</button>

								<button class="btn btn-sm btn-primary" onClick="window.location='<?php echo site_url('hardwaretest/data') ?>';">
								<i class="clip-cog-2"></i>  Data
								</button>

<div>

          <br />

          <div class="col-xs-12">

 <!-- ################################## -->
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Data File Name </label>
              <div class="col-sm-9">
               <input name="hardwaretest_name" type="text" class="col-xs-10 col-sm-10" id="hardwaretest_name" value="<?php echo $hardwaretest_name; ?>" placeholder="<?php echo $language['name']?>"/>
              </div>
            </div>
            <!-- ################################## -->
            
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['electricitytype']?> </label>
              <div class="col-sm-9"> <?php echo $ListSelectElectricitytype;?>
                  <!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
              </div>
            </div>
            <!-- ################################## -->
            <input name="hardwaretest_id_map" type="hidden" id="hardwaretest_id_map" value="<?php echo $hardwaretest_id_map; ?>" />
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['waterpipe']?> </label>
              <div class="col-sm-9"> <?php echo $ListSelectwaterpipe;?> 
			  </div>
            </div>
			
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Pump Head</label>
              <div class="col-sm-9"><canvas id="canvasSingle1" width="120" height="50"></canvas> <b>m.</b></div>
            </div>
            <!-- ################################## -->
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['flow']?> </label>
              <div class="col-sm-9">  <canvas id="canvasSingle2" width="120" height="50"></canvas> <b>gmp.</b></div>
            </div>
            
            <!-- ################################## -->
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['pressure']?> </label>
              <div class="col-sm-9"><canvas id="canvasSingle6" width="120" height="50"></canvas> <b>P</b></div>
            </div>
            <!-- ################################## -->
			
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['current']?> </label>
              <div class="col-sm-9"> <canvas id="canvasSingle3" width="120" height="50"></canvas> <b>A</b></div>
            </div>
            <!-- ################################## -->
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['voltage']?> </label>
              <div class="col-sm-9"> <canvas id="canvasSingle4" width="120" height="50"></canvas> <b>V</b></div>
            </div>
            <!-- ################################## -->
            <div class="form-group">
              <label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['power']?> </label>
              <div class="col-sm-9"> <canvas id="canvasSingle5" width="120" height="50"></canvas> <b>W</b></div>
            </div>
			<!-- ################################## -->
         
        </div>
        </div>
      <!-- PAGE CONTENT ENDS -->
    </div></td>
    <td width="26%"> 
	<br /> 
	<br /> 
	<div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn btn-info"> <?php echo $language['save']?> </button>   <br />
		 
            </div>
    </div>	
<?php echo form_close();?> <br /> 
<!-- ################################## -->
<?php $attributes = array('class' => 'form-horizontal', 'id' => 'jform'); echo form_open('hardwaretest/run', $attributes); ?>
            <?php ###############################?>
			<input name="run" type="hidden" id="run" value="1" />
			<input name="hardwaretestrun_id_map" type="hidden" id="hardwaretestrun_id_map" value="<?php echo $hardwaretestrun_id_map;?>" />
			
			<div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn btn-blue"> <?php echo $language['starttest']?></button> 
            </div>
    		</div>
<?php echo form_close();?> <br />
<!-- ################################## -->
<!-- ################################## -->
<?php $attributes = array('class' => 'form-horizontal', 'id' => 'jform'); echo form_open('hardwaretest/run', $attributes); ?>
            <?php ###############################?>
			<input name="run" type="hidden" id="run" value="0" />
			<input name="hardwaretestrun_id_map" type="hidden" id="hardwaretestrun_id_map" value="<?php echo $hardwaretestrun_id_map;?>" />
			<div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn btn-red"> <?php echo $language['stop']?></button> 
            </div>
    		</div>
<?php echo form_close();?> <br />
<!-- ################################## -->
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /></td>
  </tr>
</table>
<!-- /.col -->
</div>
<!-- /.row -->
<script>
    var scroll = false;
    var single1;
    
    function init() {
        // Initialzing gauge

		//var sections = [steelseries.Section(0, 70, 'rgba(255, 0, 0, 1.0)'),steelseries.Section(70, 95, 'rgba(255, 255, 0, 1.0)'),steelseries.Section(95, 100, 'rgba(0, 255, 0, 1.0)') ];
		 var sections = [steelseries.Section(<?php echo $min;?>, 20,'rgba(0, 255, 0, 1.0)'),steelseries.Section(50, 70, 'rgba(255, 255, 0, 1.0)'),steelseries.Section(95, <?php echo $max;?>, 'rgba(255, 0, 0, 1.0)') ];
////////////////1
        single1 = new steelseries.DisplaySingle('canvasSingle1', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single1.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue1(single1, <?php echo $singlemax1;?>); }, 1500);
///////////////2
        single2 = new steelseries.DisplaySingle('canvasSingle2', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single2.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue2(single2, <?php echo $singlemax2;?>); }, 1500);
///////////////2
        single3 = new steelseries.DisplaySingle('canvasSingle3', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single3.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue3(single3, <?php echo $singlemax3;?>); }, 1500);
///////////////2
        single4 = new steelseries.DisplaySingle('canvasSingle4', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single4.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue5(single4, <?php echo $singlemax4;?>); }, 1500);
///////////////5
        single5 = new steelseries.DisplaySingle('canvasSingle5', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single5.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue5(single5, <?php echo $singlemax5;?>); }, 1500);
			
///////////////6
        single6 = new steelseries.DisplaySingle('canvasSingle6', {
                            width: <?php echo $width;?>,
                            height: <?php echo $height='30';?>,
							section: sections
                            });
		single6.setLcdColor(steelseries.LcdColor.SECTIONS);
        // Start the random update
  			setInterval(function(){ setRandomValue6(single6, <?php echo $singlemax6;?>); }, 1500);
			
///////////////
   }

    function setRandomValue1(gauge, range) {
	    gauge.setValue(<?php echo $single1;?>);
        //gauge.setValue(Math.random() * range);
    }
    function setRandomValue2(gauge, range) {
	 	gauge.setValue(<?php echo $single2;?>);
        //gauge.setValue(Math.random() * range);
    }
	function setRandomValue3(gauge, range) {
	    gauge.setValue(<?php echo $single3;?>);
        //gauge.setValue(Math.random() * range);
    }
	function setRandomValue4(gauge, range) {
		  gauge.setValue(<?php echo $single4;?>);
        //gauge.setValue(Math.random() * range);
    }
	function setRandomValue5(gauge, range) {
	
		gauge.setValue(<?php echo $single5;?>);
        //gauge.setValue(Math.random() * range);
    }
	function setRandomValue6(gauge, range) {
	
		gauge.setValue(<?php echo $single6;?>);
        //gauge.setValue(Math.random() * range);
    }




    function setLcdColor(sel) {
        switch(sel.options[sel.selectedIndex].value) {
            case "BEIGE":
                single1.setLcdColor(steelseries.LcdColor.BEIGE);
                break;
            case "BLUE":
                single2.setLcdColor(steelseries.LcdColor.BLUE);
                break;
            case "ORANGE":
                single3.setLcdColor(steelseries.LcdColor.ORANGE);
                break;
            case "RED":
                single4.setLcdColor(steelseries.LcdColor.RED);
                break;
            case "YELLOW":
                single5.setLcdColor(steelseries.LcdColor.YELLOW);
                break;
            case "WHITE":
                single6.setLcdColor(steelseries.LcdColor.WHITE);
                break;
            case "GRAY":
                single7.setLcdColor(steelseries.LcdColor.GRAY);
                break;
            case "BLACK":
                single8.setLcdColor(steelseries.LcdColor.BLACK);
                break;
            case "GREEN":
                single9.setLcdColor(steelseries.LcdColor.GREEN);
                break;
            case "BLUE2":
                single10.setLcdColor(steelseries.LcdColor.BLUE2);
                break;
            case "BLUE_BLACK":
                single11.setLcdColor(steelseries.LcdColor.BLUE_BLACK);
                break;
            case "BLUE_DARKBLUE":
                single12.setLcdColor(steelseries.LcdColor.BLUE_DARKBLUE);
                break;
            case "BLUE_GRAY":
                single1.setLcdColor(steelseries.LcdColor.BLUE_GRAY);
                 break;
            case "STANDARD":
                single13.setLcdColor(steelseries.LcdColor.STANDARD);
                break;
            case "STANDARD_GREEN":
                single14.setLcdColor(steelseries.LcdColor.STANDARD_GREEN);
                break;
            case "BLUE_BLUE":
                single1.setLcdColor(steelseries.LcdColor.BLUE_BLUE);
                break;
            case "RED_DARKRED":
                single15.setLcdColor(steelseries.LcdColor.RED_DARKRED);
                break;
            case "DARKBLUE":
                single16.setLcdColor(steelseries.LcdColor.DARKBLUE);
                break;
            case "LILA":
                single17.setLcdColor(steelseries.LcdColor.LILA);
                break;
            case "BLACKRED":
                single18.setLcdColor(steelseries.LcdColor.BLACKRED);
                break;
            case "DARKGREEN": 
                single19.setLcdColor(steelseries.LcdColor.DARKGREEN);
                break;
            case "AMBER": 
                single20.setLcdColor(steelseries.LcdColor.AMBER);
                break;
            case "LIGHTBLUE": 
                single21.setLcdColor(steelseries.LcdColor.LIGHTBLUE);
                break;
	        case "SECTIONS": 
	            single22.setLcdColor(steelseries.LcdColor.SECTIONS);
	            break;
        }
    }

</script>
<script src="<?php echo base_url('theme');?>/assets/steelseriescanvas/steelseries-min.js"></script>
</body>