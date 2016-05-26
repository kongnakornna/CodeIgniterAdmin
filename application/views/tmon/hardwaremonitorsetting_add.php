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
		echo form_open('hardwaremonitorsetting/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('add'); ?> 
											 
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
<input name="hardwaremonitor_name_th" type="text" class="col-xs-8 col-sm-8" id="hardwaremonitor_name_th" value="" placeholder="<?php echo $language['name']?> ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> TH</label>
<div class="col-sm-9">
<input name="hardwaremonitor_decription_th" type="text" class="col-xs-8 col-sm-10" id="hardwaremonitor_decription_th" value="" placeholder="<?php echo $language['decription']?> ">
</div>
</div>
<!-- ################################## -->		
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> EN </label>
<div class="col-sm-9">
<input name="hardwaremonitor_name_en" type="text" class="col-xs-8 col-sm-8" id="hardwaremonitor_name_en" value="" placeholder="<?php echo $language['name']?> ">
</div>
</div>
<!-- ################################## -->		
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['decription']?> EN</label>
<div class="col-sm-9">
<input name="hardwaremonitor_decription_en" type="text" class="col-xs-8 col-sm-10" id="hardwaremonitor_decription_en" value="" placeholder="<?php echo $language['decription']?> ">
</div>
</div>

<!-- ################################## -->								
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['position']?>  </label>
<div class="col-sm-9"><input name="position" type="text" class="col-xs-2 col-sm-2" id="position" value="" placeholder="<?php echo $language['position']?>">
</div>
</div>

 
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['date']?> </label>
<div class="col-sm-9"><input type="hidden"  class="col-xs-2 col-sm-2" placeholder="<?php echo $language['date']?>" id="date" name="date" value="<?php echo $date;?>">
  <input type="hidden"  class="col-xs-2 col-sm-2"  id="location_id" name="location_id" value="<?php echo $location_id; ?>">
 <span class="badge badge-success"> <?php echo $date;?></span></div>
</div>
<!-- ################################## -->											
<div class="form-group">
<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
<div class="col-xs-3">
<label> <span class="badge badge-success"> ON</span>
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
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
