<?php $language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
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
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['add'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['sensorsettings'] ?>
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?> ID </label>
<div class="col-sm-9">

<?php echo $ListSelectHardware;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<div class="col-sm-9"><input name="sensor_group_en" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="Hardware [1]" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> EN </label>
<div class="col-sm-9">
<input name="sensor_name_en" type="text" class="col-xs-8 col-sm-4" id="sensor_name_en" value="Sensor X" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> TH </label>
<div class="col-sm-9"><input name="sensor_group_th" type="text" class="col-xs-10 col-sm-5" id="sensor_group" value="ชุดอุปกรณ์ [1]" placeholder="<?php echo $language['mainhardware']?>">
</div>
</div>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> TH </label>
<div class="col-sm-9">
<input name="sensor_name_th" type="text" class="col-xs-8 col-sm-4" id="sensor_name_th" value="เซ็นเชอร์ X" placeholder="<?php echo $language['sensor']?> ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensortype']?> : </label>
<div class="col-sm-9">
<?php echo $ListSelectSensortype;?>
</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statushigh']?> </label>
<div class="col-sm-9"><input name="sensor_high" type="text" class="col-xs-1 col-sm-1" id="sensor_high" size="3" maxlength="3" placeholder="<?php echo $language['statushigh']?>">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statuswarning']?> </label>
<div class="col-sm-9"><input name="sensor_warning" type="text" class="col-xs-1 col-sm-1" id="sensor_warning" size="3" maxlength="3" placeholder="<?php echo $language['statuswarning']?>">
</div>
</div>



<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['alert']?> </label>
<div class="col-sm-9">
<input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['alert']?>" id="alert" name="alert" value="0">
**
</div>
</div>
<!-- ################################## -->	



<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['model']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sn']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn">
</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['vendor']?> </label>
<div class="col-sm-9"><input name="vendor" type="text" class="col-xs-10 col-sm-5" id="vendor" value="Egits" placeholder="<?php echo $language['vendor']?>">
</div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
 <span class="badge badge-success"> 
<?php echo $date ?>
</span>
</div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
<div class="col-xs-3">
<label> <span class="badge badge-success">  ON </span>
<input name="status" type="hidden" value="1" />
 
<span class="lbl"></span></label></div>
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
							</div><br/>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
