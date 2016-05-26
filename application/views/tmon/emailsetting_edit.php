<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('emailsetting/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['emailsetting'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit']?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($emailsetting);
			}
			#Debug($emailsetting);Die();
				$email_setting_id=$emailsetting[0]['email_setting_id'];
				$email_setting_id_map=$emailsetting[0]['email_setting_id_map'];
				$name_en=$emailsetting[0]['name'];
				$name_th=$emailsetting[1]['name'];
				$email_host=$emailsetting[0]['email_host'];
				$email_port=$emailsetting[0]['email_port'];
				$email_username=$emailsetting[0]['email_username'];
				$email_password=$emailsetting[0]['email_password'];
				$create_date=$emailsetting[0]['create_date'];
				$status=$emailsetting[0]['status'];
 
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
										<?php ############?>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['name']?> TH</span></label>
										<div class="col-sm-9">
											<input name="name_th" type="text" class="col-xs-10 col-sm-5" id="name_th" value="<?php echo $name_th;?>" placeholder="<?php echo $language['name'] ?> (TH)"> 
										</div>
									</div>
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['name']?> EN</span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['name']?> <?php echo $language['emailsetting'] ?> (EN)" id="name_en" name="name_en" value="<?php echo $name_en;?>"> 
											  
										</div>
									</div>
									
									 
									
									
									
									
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['host']?></span></label>
										<div class="col-sm-9">
											<input name="email_host" type="text" class="col-xs-10 col-sm-8" id="email_host" value="<?php echo $email_host;?>" placeholder="<?php echo $language['host']?>"> 

										</div>
									</div>
<?php ############?>
									
									
									

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['port']?></span></label>
<div class="col-sm-9">
<input name="email_port" type="text" class="col-xs-10 col-sm-1" id="email_port" value="<?php echo $email_port;?>" placeholder="<?php echo $language['port']?>"> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['username']?></span></label>
<div class="col-sm-9">
<input name="email_username" type="text" class="col-xs-10 col-sm-3" id="email_username" value="<?php echo $email_username;?>" placeholder="<?php echo $language['username']?>"> 
</div>
</div>
<?php ############?>				
<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['password']?></span></label>
<div class="col-sm-9">
<input name="email_password" type="text" class="col-xs-10 col-sm-3" id="email_password" value="<?php echo $email_password;?>" placeholder="<?php echo $language['password']?>"> 
</div>
</div>
<?php ############?>								
									
 
									
<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['status']?></span></label>

										<div class="col-xs-3">
													<label>
<input type="checkbox" name="status" id="cat_status" class="ace ace-switch ace-switch-5"  <?php if($status == 1) echo 'value=1 checked'?>>

														<span class="lbl"></span>
													</label>
									  </div>
									  </div>
									</div>
								<?php ############?>
								
								
								<input type="hidden" name="email_setting_id_map" value="<?php echo $email_setting_id_map;?>">
								 
								 
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