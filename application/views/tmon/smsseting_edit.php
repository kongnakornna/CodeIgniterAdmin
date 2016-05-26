<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('smsseting/save', $attributes);
?>
									<div class="page-header">
										<h4>&nbsp;&nbsp;
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['smsseting'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit']?>
											</small>
										</h4>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($smsseting);
			}
			#Debug($smsseting);Die();
 
					$sms_id_map=$smsseting[0]['sms_id_map'];
  					$name_en=$smsseting[0]['name'];
                    $name_th=$smsseting[1]['name'];
					$name=$smsseting[0]['name'];
					$number=$smsseting[0]['number'];
					$create_date=$smsseting[0]['create_date'];
					$status=$smsseting[0]['status'];
 
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
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['phone']?></span></label>
										<div class="col-sm-9">
											<input name="number" type="text" class="col-xs-10 col-sm-5" id="number" value="<?php echo $number;?>" placeholder="<?php echo $language['phone']?>"> 
											 
											<?php //echo 'ระบบสั่งอุปกรณ์ทำงาน';//echo $language['hwcontrols']?>
										</div>
									</div>
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
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['name']?> <?php echo $language['smsseting'] ?> (EN)" id="name_en" name="name_en" value="<?php echo $name_en;?>"> 
											  
										</div>
									</div>
									
									 
									
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
								
								
								<input type="hidden" name="sms_id_map" value="<?php echo $sms_id_map;?>">
								 
								 
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