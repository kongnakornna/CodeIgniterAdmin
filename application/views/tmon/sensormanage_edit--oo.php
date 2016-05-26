<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('sensormanage/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['sensorsettings'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$sensorconfig_list[0]['sensor_name'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_menu);
					//Debug($parent);
			}

			$countitem = count($sensorconfig_list);
 
  $sensor_config_id=$sensorconfig_list[0]['sensor_config_id'];
  $hardware_id=$sensorconfig_list[0]['hardware_id'];
  $sensor_group=$sensorconfig_list[0]['sensor_group'];
  $sensor_name=$sensorconfig_list[0]['sensor_name'];
  $sensor_type_id=$sensorconfig_list[0]['sensor_type_id'];
  $sensor_high=$sensorconfig_list[0]['sensor_high'];
  $sensor_warning=$sensorconfig_list[0]['sensor_warning'];
  $sn=$sensorconfig_list[0]['sn'];
  $model=$sensorconfig_list[0]['model'];
  $date=$sensorconfig_list[0]['date'];
  $vendor=$sensorconfig_list[0]['vendor'];
  $sensor_status=$sensorconfig_list[0]['sensor_status'];
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
<div class="col-sm-9"><input type="hidden"  class="col-xs-1 col-sm-1" placeholder="title" id="hardware_id" name="hardware_id" value="<?php echo $hardware_id ?>"><?php echo $hardware_id ?></div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-10 col-sm-5" placeholder="<?php echo $language['mainhardware']?>" id="sensor_group" name="sensor_group" value="<?php echo $sensor_group ?>"> <?php echo $sensor_group ?></div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensor']?> </label>
<div class="col-sm-9"><input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sensor']?> " id="sensor_name" name="sensor_name" value="<?php echo $sensor_name ?>"><?php echo $sensor_name ?></div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sensortype']?> : </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-1 col-sm-1" placeholder="<?php echo $language['sensortype']?>" id="sensor_type_id" name="sensor_type_id" value="<?php echo $sensor_type_id ?>">
<?php 
$sensorconfigjoin=$this->sensormanage_model->getSensorreportwhere($sensor_config_id);
$sensor_type_name=$sensorconfigjoin[0]['sensor_type_name'];
echo $sensor_type_name;
?>

</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statushigh']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statushigh']?>" id="sensor_high" name="sensor_high" value="<?php echo $sensor_high ?>"></div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['statuswarning']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-1 col-sm-1" placeholder="<?php echo $language['statuswarning']?>" id="sensor_warning" name="sensor_warning" value="<?php echo $sensor_warning ?>"></div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['model']?> </label>
<div class="col-sm-9"><input type="hidden"class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" id="model" name="model" value="<?php echo $model ?>"><?php echo $model ?></div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sn']?> </label>
<div class="col-sm-9"><input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>" id="sn" name="sn" value="<?php echo $sn ?>"><?php echo $sn ?></div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['vendor']?> </label>
<div class="col-sm-9"><input type="hidden" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['vendor']?>" id="vendor" name="vendor" value="<?php echo $vendor ?>"><?php echo $vendor ?></div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
 
<?php echo $date ?></div>
</div>

						</div>

								<input type="hidden" name="sensor_config_id" value="<?php echo $sensor_config_id;?>">
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
