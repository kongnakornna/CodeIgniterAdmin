<?php
		$language = $this->lang->language;

		if($language['lang'] == 'en'){
				//$category = 
				if($category_name)
						for($i=0;$i<count($category_name);$i++){
								if($category_name[$i]['lang'] == 'en'){
										$display_category = $category_name[$i]['category_name'];
										$category_id_map = $category_name[$i]['category_id_map'];
								}
						}
		}else{
				if($category_name)
						for($i=0;$i<count($category_name);$i++){
								if($category_name[$i]['lang'] == 'th'){
										$display_category = $category_name[$i]['category_name'];
										$category_id_map = $category_name[$i]['category_id_map'];
								}
						}
		}
		//Debug($category_name, 'category_name');
?>
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
												<?php echo $language['sub_of'].' '.$display_category?>
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
			//Debug($subcategory );
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
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory_name']?>(EN)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['category']?>" id="subcategory_en" name="subcategory_en">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory_name']?>(TH)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['category']?>" id="subcategory_th" name="subcategory_th">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status" id="cat_status" class="ace ace-switch" type="checkbox" value=1 checked/>
														<span class="lbl"></span>
													</label>
												</div>
										</div>
									</div>

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
											<input type="hidden" name="category_id_map" value="<?php echo $category_id_map?>">
										</div>
									</div>

							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
