<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="subcategory/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('subcategory/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<?php echo $language['subcategory'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php //echo $language['type_of_column'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['subcategory'] ?></h3> -->
										<!-- <div class="table-header">
											<?php echo $language['subcategory'] ?>
										</div> -->

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
			if(function_exists('Debug')){
				//Debug($category_name);
				//Debug($cat_arr);
			}

			if(isset($error)){
?>
											<div class="alert alert-danger">
												<button data-dismiss="alert" class="close" type="button">
													<i class="ace-icon fa fa-times"></i>
												</button>
												<strong>
													<i class="ace-icon fa fa-times"></i>
													Oh snap!</strong><?php echo $error?>.
												<br>
											</div>
<?php
			}
?>
									<!-- #section:elements.form -->
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory_name']?> (EN)</label>

										<div class="col-sm-9">

											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['subcategory_name']?>" id="subcategory_en" name="subcategory_en" value="<?php echo ($cat_arr[0]->lang == 'en') ? $cat_arr[0]->subcategory_name : $cat_arr[1]->subcategory_name ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory_name']?> (TH)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['subcategory_name']?>" id="subcategory_th" name="subcategory_th" value="<?php echo ($cat_arr[1]->lang == 'th') ? $cat_arr[1]->subcategory_name : $cat_arr[0]->subcategory_name ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input type="checkbox" name="status" id="cat_status" class="ace ace-switch ace-switch-5" 
														<?php if($cat_arr[0]->status == 1) echo 'value=1 checked'; else echo 'value=0' ?>>

														<span class="lbl"></span>
													</label>
												</div>
										</div>
									</div>

									<input type="hidden" name="subcategory_id" value="<?php echo $cat_arr[0]->subcategory_id_map;?>">
									<input type="hidden" name="subcategory_id_en" value="<?php echo ($cat_arr[0]->lang == 'en') ? $cat_arr[0]->subcategory_id : $cat_arr[1]->subcategory_id ?>">
									<input type="hidden" name="subcategory_id_th" value="<?php echo ($cat_arr[0]->lang == 'th') ? $cat_arr[0]->subcategory_id : $cat_arr[1]->subcategory_id ?>">

									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>

								
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
