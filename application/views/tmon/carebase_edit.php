<?php 
				   $language = $this->lang->language; 
				   $date=date('Y-m-d H:i:s');
# Debug($carebase_list); Die();
				   $carebase_id=$carebase_list[0]['carebase_id'];
				   $carebase_id_map=$carebase_list[0]['carebase_id_map'];
				   $carebase_id_map=$carebase_list[0]['carebase_id_map'];
				   $carebase_name_en=$carebase_list[0]['carebase_name'];
				   $carebase_name_th=$carebase_list[1]['carebase_name'];
				   $carebase_value=$carebase_list[0]['carebase_value'];
				   $carebase_type=$carebase_list[0]['carebase_type'];
				   $create_date=$carebase_list[0]['create_date'];
				   $status=$carebase_list[0]['status'];

?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('carebase/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['edit'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['carebase'] ?>
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?>  </label>
<div class="col-sm-9">
<input name="carebase_id_map" type="hidden" value="<?php echo $carebase_id_map; ?>" />
<?php echo $ListSelectcarebasetype;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['carebase']?><?php echo $language['name']?> EN </label>
<div class="col-sm-9"><input name="carebase_name_en" type="text" class="col-xs-10 col-sm-5" id="carebase_name_en" value="<?php echo $carebase_name_en;?>" placeholder="<?php echo $language['name']?>">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['carebase']?><?php echo $language['name']?>EN </label>
<div class="col-sm-9">
<input name="carebase_name_th" type="text" class="col-xs-8 col-sm-5" id="carebase_name_th" value="<?php echo $carebase_name_th;?>" placeholder="<?php echo $language['name']?> ">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['value']?>  </label>
<div class="col-sm-9">
<input name="carebase_value" type="text" class="col-xs-2 col-sm-1" id="carebase_value" value="<?php echo $carebase_value;?>" placeholder="<?php echo $language['value']?> ">
</div>
</div>

<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['type']?>  </label>
<div class="col-sm-9">
<input name="carebase_type" type="text" class="col-xs-2 col-sm-1" id="carebase_type" value="<?php echo $carebase_type;?>" placeholder="<?php echo $language['type']?> ">
</div>
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
