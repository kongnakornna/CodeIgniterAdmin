<?php 
$language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
$location_id='1';
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
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('add'); ?> 
											 
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
<div class="col-sm-9"><input name="hardwaretest_name_en" type="text" class="col-xs-5 col-sm-5" id="hardwaretest_name_en" value="" placeholder="<?php echo $language['name']?>">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> EN </label>
<div class="col-sm-9">
<input name="hardwaretest_decription_en" type="text" class="col-xs-8 col-sm-8" id="hardwaretest_decription_en" value="" placeholder="<?php echo $language['decription']?> ">
</div>
</div>
<!-- ################################## -->		
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> TH </label>
<div class="col-sm-9"><input name="hardwaretest_name_th" type="text" class="col-xs-5 col-sm-5" id="hardwaretest_name_th" value="" placeholder="<?php echo $language['name']?>">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> TH </label>
<div class="col-sm-9">
<input name="hardwaretest_decription_th" type="text" class="col-xs-8 col-sm-8" id="hardwaretest_decription_th" value="" placeholder="<?php echo $language['decription']?> ">
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
