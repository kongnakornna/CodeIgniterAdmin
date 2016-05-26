<?php 
$language = $this->lang->language; 
$date=date('Y-m-d H:i:s');
$location_id='1';
					#debug($hardwaremonitorsetting);

				    $hardwaremonitor_id=$hardwaremonitorsetting[0]['hardwaremonitor_id'];
					$hardwaremonitor_id_map=$hardwaremonitorsetting[0]['hardwaremonitor_id_map'];
					$hardwaremonitor_type_id_map=$hardwaremonitorsetting[0]['hardwaremonitor_type_id_map'];
					$hardwaremonitor_type_id_map=$hardwaremonitorsetting[0]['hardwaremonitor_type_id_map'];
					$hardwaremonitor_name_en=$hardwaremonitorsetting[0]['hardwaremonitor_name'];
					$hardwaremonitor_decription_en=$hardwaremonitorsetting[0]['hardwaremonitor_decription'];
					$hardwaremonitor_name_th=$hardwaremonitorsetting[1]['hardwaremonitor_name'];
					$hardwaremonitor_decription_th=$hardwaremonitorsetting[1]['hardwaremonitor_decription'];
					$position=$hardwaremonitorsetting[0]['position'];
					$create_date=$hardwaremonitorsetting[0]['create_date'];
					$status=$hardwaremonitorsetting[0]['status'];
				 
					 

?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hardwaremonitorsetting/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('edit'); ?> 
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['hardwaremonitorsetting'] ?>
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
	<input type="hidden"  class="col-xs-2 col-sm-2"  id="hardwaremonitor_id_map" name="hardwaremonitor_id_map" value="<?php echo $hardwaremonitor_id_map; ?>">	
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardwaremonitortype']?>  </label>
<div class="col-sm-9">

<?php echo $ListSelecthardwaretype;?>
 
</div>
</div>
<!-- ################################## -->									
 
<!-- ################################## -->									
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['hardware']?></label>
<div class="col-sm-9"><?php echo $ListSelecthardware;?>
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> TH </label>
<div class="col-sm-9">
<input name="hardwaremonitor_name_th" type="text" class="col-xs-8 col-sm-8" id="hardwaremonitor_name_th" value="<?php echo $hardwaremonitor_name_th;?>" placeholder="<?php echo $language['name']?> ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> TH</label>
<div class="col-sm-9">
<input name="hardwaremonitor_decription_th" type="text" class="col-xs-8 col-sm-10" id="hardwaremonitor_decription_th" value="<?php echo $hardwaremonitor_decription_th;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>
<!-- ################################## -->		
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> EN </label>
<div class="col-sm-9">
<input name="hardwaremonitor_name_en" type="text" class="col-xs-8 col-sm-8" id="hardwaremonitor_name_en" value="<?php echo $hardwaremonitor_name_en;?>" placeholder="<?php echo $language['name']?> ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> EN</label>
<div class="col-sm-9">
<input name="hardwaremonitor_decription_en" type="text" class="col-xs-8 col-sm-10" id="hardwaremonitor_decription_en" value="<?php echo $hardwaremonitor_decription_en;?>" placeholder="<?php echo $language['decription']?> ">
</div>
</div>

<!-- ################################## -->								
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['position']?>  </label>
<div class="col-sm-9"><input name="position" type="text" class="col-xs-2 col-sm-2" id="position" value="<?php echo $position;?>" placeholder="<?php echo $language['position']?>">
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
