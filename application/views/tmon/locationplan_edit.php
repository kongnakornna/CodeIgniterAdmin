<?php 
$language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
 #Debug($locationplan_list);Die();
					$location_plan_id_map=$locationplan_list[0]['location_plan_id_map'];
					$plan_id_map=$locationplan_list[0]['plan_id_map'];
					$location_plan_name_en=$locationplan_list[0]['location_plan_name'];
					$location_plan_name_th=$locationplan_list[1]['location_plan_name'];
					$create_date=$locationplan_list[0]['create_date'];
					$status=$locationplan_list[0]['status'];
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('locationplan/save', $attributes);
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
 
<input name="location_plan_id_map" type="hidden" value="<?php echo $location_plan_id_map; ?>" />				
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['plan']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelectlocation;?>
<!-- <input type="hidden"  name="sensor_config_id"  value="0" />-->
</div>
</div>
<!-- ################################## -->									
 
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?> EN </label>
<div class="col-sm-9">
<input name="location_plan_name_en" type="text" class="col-xs-8 col-sm-4" id="location_plan_name_en" value="<?php echo $location_plan_name_en;?>" placeholder="<?php echo $language['locationplan']?> ">
</div>
</div>
 
 <!-- ################################## -->	
 
 <div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['locationplan']?> TH </label>
<div class="col-sm-9">
<input name="location_plan_name_th" type="text" class="col-xs-8 col-sm-4" id="location_plan_name_th" value="<?php echo $location_plan_name_th;?>" placeholder="<?php echo $language['locationplan']?> ">
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
