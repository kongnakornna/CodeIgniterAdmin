<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('electricitytype/save', $attributes);
?>
									<div class="page-header">
										<h5><i class="ace-icon fa fa-cogs"></i>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['electricitytype'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit']?>
											</small>
										</h5>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($electricitytype);
			}
					//Debug($electricitytype);Die();
					$countitem = count($electricitytype);
					//echo'$countitem='.$countitem;Die();
					$electricity_type_id_map=$electricitytype[0]['electricity_type_id_map'];
  					$electricity_type_name_en=$electricitytype[0]['electricity_type_name'];
					$value=$electricitytype[0]['value'];
                    $electricity_type_name_th=$electricitytype[1]['electricity_type_name'];
					$status=$electricitytype[0]['status'];
 
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
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> TH</span></label>
										<div class="col-sm-9">
											<input name="electricity_type_name_th" type="text" class="col-xs-10 col-sm-5" id="electricity_type_name_th" value="<?php echo $electricity_type_name_th;?>" placeholder="<?php echo $language['title']?> <?php echo $language['electricitytype'] ?> (TH)"> 
											 
											<?php //echo 'ระบบสั่งอุปกรณ์ทำงาน';//echo $language['hwcontrols']?>
										</div>
									</div>
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> EN</span></label>
										<?php ############?>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['title']?> <?php echo $language['electricitytype'] ?> (EN)" id="electricity_type_name_en" name="electricity_type_name_en" value="<?php echo $electricity_type_name_en;?>"> 
										</div>
									</div>
										<?php ############?>
<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['value']?> </span></label>
<div class="col-sm-9">
<input type="text" class="col-xs-2 col-sm-2" placeholder="<?php echo $language['value']?>" id="value" name="value" value="<?php echo $value;?>"> 
</div>
									</div>
									
<?php ######################?>
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
								
								
								<input type="hidden" name="electricity_type_id_map" value="<?php echo $electricity_type_id_map;?>">
								 
								 
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
