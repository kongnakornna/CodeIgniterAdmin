<?php 
$language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
$key='0';
$key2='1';
$hardware_id=$hardware_list[$key]['hardware_id'];
$hardware_id_map=$hardware_list[$key]['hardware_id_map'];
$hardware_type_id=$hardware_list[$key]['hardware_type_id'];
#####
$hardware_name_th=$hardware_list[$key2]['hardware_name'];
$hardgroup_name_th=$hardware_list[$key2]['hardgroup_name'];
$hardware_decription_th=$hardware_list[$key2]['hardware_decription'];
######
$hardware_name_en=$hardware_list[$key]['hardware_name'];
$hardgroup_name_en=$hardware_list[$key]['hardgroup_name'];
$hardware_decription_en=$hardware_list[$key]['hardware_decription'];
######
$hardware_ip=$hardware_list[$key]['hardware_ip'];
$port=$hardware_list[$key]['port'];
$location_id=$hardware_list[$key]['location_id'];
$create_date=$hardware_list[$key]['create_date'];
$vendor=$hardware_list[$key]['vendor'];
$sn=$hardware_list[$key]['sn'];
$model=$hardware_list[$key]['model'];
$status=$hardware_list[$key]['status'];
$alerttime=$hardware_list[$key]['alerttime'];
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardware/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['edit'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['hardware'] ?>
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
<input name="hardware_id" type="hidden" value="<?php echo $hardware_id_map; ?>" />
<input name="hardware_id_map" type="hidden" value="<?php echo $hardware_id_map; ?>" />				
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelecthardwaretype;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectlocation;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->										
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?> EN </label>
<div class="col-sm-9"><input name="hardware_name_en" type="text" class="col-xs-10 col-sm-5" id="hardware_name_en" value="<?php echo $hardware_name_en;?>" placeholder="<?php echo $language['hardware']?>">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['mainhardware']?> EN </label>
<div class="col-sm-9">
<input name="hardgroup_name_en" type="text" class="col-xs-8 col-sm-4" id="hardgroup_name_en" value="<?php echo $hardgroup_name_en;?>" placeholder="<?php echo $language['mainhardware']?> ">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> EN </label>
<div class="col-sm-9">
<input name="hardware_decription_en" type="text" class="col-xs-8 col-sm-4" id="hardware_decription_en" value="<?php echo $hardware_decription_en;?>" placeholder="<?php echo $language['decription']?> ">
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

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> TH </label>
<div class="col-sm-9">
<input name="hardware_decription_th" type="text" class="col-xs-8 col-sm-4" id="hardware_decription_th" value="<?php echo $hardware_decription_th;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>

<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['ip']?> </label>
<div class="col-sm-9"><input name="hardware_ip" type="text" class="col-xs-8 col-sm-4" id="hardware_ip"  value="<?php echo $hardware_ip;?>" placeholder="<?php echo $language['ip']?>">
</div>
</div>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['port']?> </label>
<div class="col-sm-9"><input name="port" type="text" class="col-xs-8 col-sm-4" id="port"  value="<?php echo $port;?>" placeholder="<?php echo $language['port']?>">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['model']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['model']?>" value="<?php echo $model;?>" id="model" name="model">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['sn']?> </label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['sn']?>"value="<?php echo $sn;?>" id="sn" name="sn">
</div>
</div>								
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['vendor']?> </label>
<div class="col-sm-9"><input name="vendor" type="text" class="col-xs-10 col-sm-5" id="vendor"  value="<?php echo $vendor;?>" placeholder="<?php echo $language['vendor']?>">
</div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['alerttime']?> </label>
<div class="col-sm-9"><input name="alerttime" type="text" class="col-xs-1 col-sm-1" id="alerttime"  value="<?php echo $alerttime;?>" placeholder="<?php echo $language['alerttime']?>">
</div>
</div>										
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date ?>">
  <input type="hidden"  class="col-xs-2 col-sm-2"  id="location_id" name="location_id" value="<?php echo $location_id; ?>"> <span class="badge badge-success"> 
<?php echo $date ?></span></div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
<div class="col-xs-3">
<label> <span class="badge badge-success"> ON</span>
<input name="status" type="hidden" value="<?php echo $status; ?>" />
 
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
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
