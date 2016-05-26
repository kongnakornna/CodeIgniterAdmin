<?php 
			#Debug($hardware_list);Die();	
					$language = $this->lang->language; 
					$date=date('Y-m-d H:i:s');		
					$hardwaretest_name_en=$hardware_list[0]['hardwaretest_name'];
					$hardwaretest_decription_en=$hardware_list[0]['hardwaretest_decription'];
					$hardwaretest_name_th=$hardware_list[1]['hardwaretest_name'];
					$hardwaretest_decription_th=$hardware_list[1]['hardwaretest_decription'];
					
 					$hardwaretest_id=$hardware_list[0]['hardwaretest_id'];
					$hardwaretest_id_map=$hardware_list[0]['hardwaretest_id_map'];
					$electricity_type_id_map=$hardware_list[0]['electricity_type_id_map'];
					$waterpipe_id_map=$hardware_list[0]['waterpipe_id_map'];
					#################3
					$hw_pump_id=$hardware_list[0]['hw_pump_id'];
                    $pump=$this->Hardwaretestsetting_model->get_hardwareapi($hw_pump_id,$status=1);
					#Debug($pump); //Die();
					$pump_name=$pump[0]['hardware_name'];
					$pump_ip=$pump[0]['hardware_ip'];
					//////					
					$flow_id=$hardware_list[0]['flow_id'];
					$flow=$this->Hardwaretestsetting_model->get_hardwareapi($flow_id,$status=1);
					//Debug($flow);
					$flow_name=$flow[0]['hardware_name'];
					$flow_ip=$flow[0]['hardware_ip'];
					/////
					$current_id=$hardware_list[0]['current_id'];
					$current=$this->Hardwaretestsetting_model->get_hardwareapi($current_id,$status=1);
					//Debug($current);
					$current_name=$current[0]['hardware_name'];
					$current_ip=$current[0]['hardware_ip'];
					/////
					$voltage_id=$hardware_list[0]['voltage_id'];
					$voltage=$this->Hardwaretestsetting_model->get_hardwareapi($voltage_id,$status=1);
					//Debug($voltage);
					$voltage_name=$voltage[0]['hardware_name'];
					$voltage_ip=$voltage[0]['hardware_ip'];
					/////
					$power_id=$hardware_list[0]['power_id'];
					$power=$this->Hardwaretestsetting_model->get_hardwareapi($power_id,$status=1);
					//echo '$power_id='.$power_id;Debug($power);die();
					$power_name=$power[0]['hardware_name'];
					$power_ip=$power[0]['hardware_ip'];
					####################
					$create_date=$hardware_list[0]['create_date'];
					$status=$hardware_list[0]['status'];
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwaretestsetting/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['edit'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['hardwaretestsetting'] ?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_menu);
					//Debug($parent);
			}

 
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
<input type="hidden" name="hardwaretest_id_map" value="<?php echo $hardwaretest_id_map;?>">		
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['electricitytype']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectElectricitytype;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['waterpipe']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectwaterpipe;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> EN </label>
<div class="col-sm-9"><input name="hardwaretest_name_en" type="text" class="col-xs-5 col-sm-5" id="hardwaretest_name_en" value="<?php echo $hardwaretest_name_en;?>" placeholder="<?php echo $language['name']?>">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> EN </label>
<div class="col-sm-9">
<input name="hardwaretest_decription_en" type="text" class="col-xs-8 col-sm-8" id="hardwaretest_decription_en" value="<?php echo $hardwaretest_decription_en;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>
<!-- ################################## -->		
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> TH </label>
<div class="col-sm-9"><input name="hardwaretest_name_th" type="text" class="col-xs-5 col-sm-5" id="hardwaretest_name_th" value="<?php echo $hardwaretest_name_th;?>" placeholder="<?php echo $language['name']?>">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> TH </label>
<div class="col-sm-9">
<input name="hardwaretest_decription_th" type="text" class="col-xs-8 col-sm-8" id="hardwaretest_decription_th" value="<?php echo $hardwaretest_decription_th;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['waterpump']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelecthw_pump_id;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['flow']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectflow_id;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['current']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectcurrent_id;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['voltage']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectvoltage_id;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['power']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectpower_id;?>
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['control']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectcontrol_id;?>
</div>
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
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
