<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('hostmedia/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['emailsetting'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['add']?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($emailsetting);
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
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['hostmediatype']?> </span></label>
										<div class="col-sm-9">
											<?php echo $ListSelectlocation ?>
										</div>
									</div>
									
	<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['name']?> EN</span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['name']?> <?php echo $language['emailsetting'] ?> (EN)" id="name_en" name="name_en"> 
											  
										</div>
									</div>
									
									
									<?php ############?>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['name']?> TH</span></label>
										<div class="col-sm-9">
											<input name="name_th" type="text" class="col-xs-10 col-sm-5" id="name_th" placeholder="<?php echo $language['name'] ?> (TH)"> 
										</div>
									</div>
								
									 
									
									
									
									
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['host']?></span></label>
										<div class="col-sm-9">
											<input name="host" type="text" class="col-xs-10 col-sm-8" id="host" value=" " placeholder="<?php echo $language['host']?>"> 

										</div>
									</div>
<?php ############?>
									
									
									

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['port']?></span></label>
<div class="col-sm-9">
<input name="port" type="text" class="col-xs-10 col-sm-1" id="port" value="465" placeholder="<?php echo $language['port']?>"> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['username']?></span></label>
<div class="col-sm-9">
<input name="username" type="text" class="col-xs-10 col-sm-3" id="username" placeholder="<?php echo $language['username']?>"> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['password']?></span></label>
<div class="col-sm-9">
<input name="password" type="text" class="col-xs-10 col-sm-3" id="password" placeholder="<?php echo $language['password']?>"> 
</div>
</div>
<?php ############?>								
									
 
									
<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['status']?></span></label>

										<div class="col-xs-3">
													<label>
<input name="status" type="checkbox" class="ace ace-switch ace-switch-5" id="cat_status" value="1" checked="checked">

														<span class="lbl"></span>
													</label>
									  </div>
									  </div>
									</div>
								<?php ############?>
								<div style="clear: both;"></div>
									<div class="clearfix form-actions">
									  <div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>
											<input type="reset" name="Reset" value="<?php echo $language['reset']?>" class="btn btn-yellow"/>
									  </div>
									</div>
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->