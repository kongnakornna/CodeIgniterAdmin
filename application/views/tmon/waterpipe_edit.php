<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$mainmenu =  $this->uri->segment(3);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('waterpipe/save', $attributes);
?>
									<div class="page-header">
										<h5><i class="ace-icon fa fa-cogs"></i>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['waterpipe'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit']?>
											</small>
										</h5>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($waterpipe_list);
			}
			//Debug($waterpipe_list);Die();
					$waterpipe_id_map=$waterpipe_list[0]['waterpipe_id_map'];
  					$waterpipe_name_en=$waterpipe_list[0]['waterpipe_name'];
                    $waterpipe_name_th=$waterpipe_list[1]['waterpipe_name'];
					$size=$waterpipe_list[0]['size'];
					$status=$waterpipe_list[0]['status'];
 
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
											<input name="waterpipe_name_th" type="text" class="col-xs-10 col-sm-5" id="waterpipe_name_th" value="<?php echo $waterpipe_name_th;?>" placeholder="<?php echo $language['title']?> <?php echo $language['waterpipe'] ?> (TH)"> 
											 
											<?php //echo 'ระบบสั่งอุปกรณ์ทำงาน';//echo $language['hwcontrols']?>
										</div>
									</div>
									<?php ############?>
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['title']?> EN</span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['title']?> <?php echo $language['waterpipe'] ?> (EN)" id="waterpipe_name_en" name="waterpipe_name_en" value="<?php echo $waterpipe_name_en;?>"> 
											 <?php  //echo 'waterpipe_list Control Auto works';//echo $language['hwcontrols']; ?>
										</div>
									</div>
									
<?php ######################?>

<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><span class="label label-warning arrowed-in arrowed-in-right"><?php echo $language['size']?> </span></label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-3 col-sm-3" placeholder="<?php echo $language['size'] ?> " id="size" name="size" value="<?php echo $size;?>"> 
											 <?php  //echo 'waterpipe_list Control Auto works';//echo $language['hwcontrols']; ?>
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
								
								
								<input type="hidden" name="waterpipe_id_map" value="<?php echo $waterpipe_id_map;?>">
								 
								 
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
