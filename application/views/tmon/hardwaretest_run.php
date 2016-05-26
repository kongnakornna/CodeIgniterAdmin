<?php 
					Debug($hardware_list);Die();
					$language = $this->lang->language; 
					$date=date('Y-m-d H:i:s');
		            $hardwaretest_id=$hardware_list[0]['hardwaretest_id'];
					$hardwaretest_id_map=$hardware_list[0]['hardwaretest_id_map'];
					$electricity_type_id_map=$hardware_list[0]['electricity_type_id_map'];
					$waterpipe_id_map=$hardware_list[0]['waterpipe_id_map'];
					$hardwaretest_name=$hardware_list[0]['hardwaretest_name'];
					$hardwaretest_decription=$hardware_list[0]['hardwaretest_decription'];
					$electricity_type_name=$hardware_list[0]['electricity_type_name'];
					$waterpipe_name=$hardware_list[0]['waterpipe_name'];
					#################3
					$hw_pump_id=$hardware_list[0]['hw_pump_id'];
                    $pump=$this->Hardwaretest_model->get_hardwareapi($hw_pump_id,$status=1);
					#Debug($pump); //Die();
					$pump_name=$pump[0]['hardware_name'];
					$pump_ip=$pump[0]['hardware_ip'];
					//////					
					$flow_id=$hardware_list[0]['flow_id'];
					$flow=$this->Hardwaretest_model->get_hardwareapi($flow_id,$status=1);
					//Debug($flow);
					$flow_name=$flow[0]['hardware_name'];
					$flow_ip=$flow[0]['hardware_ip'];
					
					
					
					/////
					$currt_id=$hardware_list[0]['current_id'];
					$currt=$this->Hardwaretest_model->get_hardwareapi($currt_id,$status=1);
					//Debug($currt);
					$currt_name=$currt[0]['hardware_name'];
					$currt_ip=$currt[0]['hardware_ip'];
					/////
					$voltage_id=$hardware_list[0]['voltage_id'];
					$voltage=$this->Hardwaretest_model->get_hardwareapi($voltage_id,$status=1);
					//Debug($voltage);
					$voltage_name=$voltage[0]['hardware_name'];
					$voltage_ip=$voltage[0]['hardware_ip'];
					/////
					$power_id=$hardware_list[0]['power_id'];
					$power=$this->Hardwaretest_model->get_hardwareapi($power_id,$status=1);
					//echo '$power_id='.$power_id;Debug($power);die();
					$power_name=$power[0]['hardware_name'];
					$power_ip=$power[0]['hardware_ip'];
					####################
					$create_date=$hardware_list[0]['create_date'];
					$status=$hardware_list[0]['status'];
					 
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwaretest/hardwaretest_run', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['hardwaretest'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['test'] ?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_mu);
					//Debug($part);
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
									<!-- #section:elemts.form -->
 							
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?>  </label>
<div class="col-sm-9">

<?php echo $hardwaretest_name;?>
<!-- <input type="hidd"  name="ssor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?>  </label>
<div class="col-sm-9">

 
<?php echo $hardwaretest_decription;?>
<!-- <input type="hidd"  name="ssor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?>  </label>
<div class="col-sm-9">

 
<?php echo $electricity_type_name;?>
<!-- <input type="hidd"  name="ssor_config_id"  value="0" />-->
</div>
</div>

<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?>  </label>
<div class="col-sm-9">

 
<?php echo $waterpipe_name;?>
<!-- <input type="hidd"  name="ssor_config_id"  value="0" />-->
</div>
</div>
 
 <!-- ################################## -->	
 
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?>  </label>
<div class="col-sm-9">
<input name="hardgroup_name_" type="text" class="col-xs-8 col-sm-4" id="hardgroup_name_" value="<?php echo $hardgroup_name_;?>" placeholder="<?php echo $language['mainhardware']?> ">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?>  </label>
<div class="col-sm-9">
<input name="hardware_decription_" type="text" class="col-xs-8 col-sm-4" id="hardware_decription_" value="<?php echo $hardware_decription_;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>

<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?> TH </label>
<div class="col-sm-9"><input name="hardware_name_th" type="text" class="col-xs-10 col-sm-5" id="hardware_name_th" value="<?php echo $hardware_name_th;?>" placeholder="<?php echo $language['hardware']?>">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9">
<input name="hardgroup_name_th" type="text" class="col-xs-8 col-sm-4" id="hardgroup_name_th" value="<?php echo $hardgroup_name_th;?>" placeholder="<?php echo $language['mainhardware']?> ">
</div>
</div>

<?php ################?>
 
 
						</div>
 
		                   <div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="strart" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['strart']?>
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="stop" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<?php echo $language['stop']?>
											</button>
										</div>
									</div>
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTT DS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
