<?php $language = $this->lang->language; 
  $date=date('Y-m-d H:i:s');
 //Debug($hardwarecontrolconfig_list);die();
  $countitem = count($hardwarecontrolconfig_list);
  $hardwarecontrol_config_id_map=$hardwarecontrolconfig_list[0]['hardwarecontrol_config_id_map'];
  $control_name_en=$hardwarecontrolconfig_list[0]['control_name'];
  $control_name_th=$hardwarecontrolconfig_list[1]['control_name'];
  $on=$hardwarecontrolconfig_list[0]['on'];
  $off=$hardwarecontrolconfig_list[0]['off'];
  $auto=$hardwarecontrolconfig_list[0]['auto'];
  $access=$hardwarecontrolconfig_list[0]['access'];
  $status=$hardwarecontrolconfig_list[0]['status'];
 
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwarecontrolconfig/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['add'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['hardwarecontrolconfig'] ?>
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> EN </label>
<div class="col-sm-9"><input name="control_name_en" type="text" class="col-xs-10 col-sm-9" id="control_name_en" value="<?php echo  $control_name_en;?>" placeholder="<?php echo $language['name']?> EN ">
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> TH </label>
<div class="col-sm-9"><input name="control_name_th" type="text" class="col-xs-10 col-sm-9" id="control_name_th" value="<?php echo  $control_name_th;?>" placeholder="<?php echo $language['name']?> TH ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['codecontrol']?> <?php echo $language['on']?></label>
<div class="col-sm-9"><input name="on" type="text" class="col-xs-10 col-sm-9" id="on" value="<?php echo $on;?>" placeholder="<?php echo $language['codecontrol']?> <?php echo $language['on']?>">
</div>
</div>
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['codecontrol']?> <?php echo $language['off']?></label>
<div class="col-sm-9"><input name="off" type="text" class="col-xs-10 col-sm-9" id="off" value="<?php echo $off;?>" placeholder="<?php echo $language['codecontrol']?> <?php echo $language['off']?>">
</div>
</div>
<!-- ################################## -->	
<input name="auto" type="hidden" value="<?php echo $auto;?>" />
<input name="access" type="hidden" value="<?php echo $access;?>" />
 
<input name="hardwarecontrol_config_id_map" type="hidden" value="<?php echo $hardwarecontrol_config_id_map;?>" />	
<div class="form-group">
<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
<div class="col-xs-3">
<label> <span class="badge badge-success">  ON </span>
<input name="status" type="hidden" value="<?php echo $status;?>" />
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
