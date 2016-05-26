<link rel="stylesheet" href="<?php echo base_url('theme');?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">

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
		echo form_open_multipart('plan/save', $attributes);	
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;&nbsp;<?php echo $language['add'] ?>
											 
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['plan'] ?>
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> EN </label>
<div class="col-sm-9">
 <input name="status" type="hidden" id="status" value="1">
<input name="plan_name_en" type="text" class="col-xs-8" id="plan_name_en" placeholder="<?php echo $language['name']?>">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name']?> th </label>
<div class="col-sm-9">
<input name="plan_name_th" type="text" class="col-xs-8" id="plan_name_th" placeholder="<?php echo $language['name']?> ">
</div>
</div>
<!-- ################################## -->
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['upload']?> </label>
<div class="col-sm-9">



<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="width: 100px; height: 100px;">
													<img src="<?php echo base_url();?>/images/plan/systmon.png" alt=""/>
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 500px; max-height: 300px; line-height: 20px;"></div>
													<div>
														<span class="btn btn-light-grey btn-file"><span class="fileupload-new">
															<i class="fa fa-picture-o"></i> <?php echo $language['selectimage']?> </span>
															<span class="fileupload-exists">
															<i class="fa fa-picture-o"></i> <?php echo $language['change']?> </span>
															 
															<input type="file" name="fileplan" />
														</span>
														<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
															<i class="fa fa-times"></i> <?php echo $language['remove']?>
														</a>
													</div>
												</div>


</div>
</div>
 
 
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

	
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url('theme');?>/assets/plugins/jquery-inputlimiter/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="<?php echo base_url('theme');?>/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
