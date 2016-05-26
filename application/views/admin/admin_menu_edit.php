<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('admin_menu/update', $attributes);
?>
									<div class="page-header">
										<h1>
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><?php echo $language['admin_menu'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'].' '.$web_menu[0]['title'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">

<?php
			if(function_exists('Debug')){
					//Debug($web_menu);
					//Debug($parent);
			}

			$countitem = count($web_menu);
			for($i=0;$i<$countitem ;$i++){
					if($web_menu[$i]['lang'] == 'th'){

							$title_th = $web_menu[$i]['title'];
							$admin_menu_id_th = $web_menu[$i]['admin_menu_id'];

					}else if($web_menu[$i]['lang'] == 'en'){

							$title_en = $web_menu[$i]['title'];
							$admin_menu_id_en = $web_menu[$i]['admin_menu_id'];

					}
					$admin_menu_id = $web_menu[$i]['admin_menu_id2'];
					$url = $web_menu[0]['url'];
					$status = $web_menu[0]['status'];
					$icon= $web_menu[0]['icon'];
					$parentid= $web_menu[0]['parent'];
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
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (EN)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="title" id="title_en" name="title_en" value="<?php echo $title_en ?>">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (TH)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="title" id="title_th" name="title_th" value="<?php echo $title_th?>">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">URL</label>

									  <div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="url" id="url" name="url" value="<?php echo $url?>">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">URL</label>

										<div class="col-sm-9">
										<select name="parentid" id="parentid">
											<option value=0>root</option>
										<?php
												//Debug($parent);
												if($parent){
														for($i=0;$i<count($parent);$i++){

																if($parent[$i]['admin_menu_id2'] == $web_menu[0]['parent'] || $parent[$i]['admin_menu_id2'] == $web_menu[1]['parent'])
																		echo "<option value=".$parent[$i]['admin_menu_id2']." selected>".$parent[$i]['title']."</option>";
																else
																		echo "<option value=".$parent[$i]['admin_menu_id2'].">".$parent[$i]['title']."</option>";
														}
												}
										?>
										</select>
										</div>
									</div>

<?php if($parentid==0){?>
<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['icon']?>  </label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="Icon" id="icon" name="icon" value="<?php echo $icon ?>">
										</div>
									</div>
<?php }else{?><input type="hidden"  id="icon" name="icon" value="<?php echo $icon ?>"><?php }?>

									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<!-- <input name="switch-field-1" class="ace ace-switch" type="checkbox"  name="status" <?php if($cat_arr[0]['status'] == 1) echo 'value=1 checked'?>/> -->
														<input type="checkbox" name="status" id="cat_status" class="ace ace-switch ace-switch-5" <?php if($status == 1) echo 'value=1 checked'; else echo 'value=0' ?>>

														<span class="lbl"></span>
													</label>
												</div>
										</div>
									</div>

								<input type="hidden" name="admin_menu_id" value="<?php echo $admin_menu_id;?>">
								<input type="hidden" name="admin_menu_id_en" value="<?php echo $admin_menu_id_en ?>">
								<input type="hidden" name="admin_menu_id_th" value="<?php echo $admin_menu_id_th ?>">

								<input type="hidden" name="parent" value="<?php echo $web_menu[0]['parent'];?>">

									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												 <?php echo $language['save'] ?> 
											</button>

											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<?php echo $language['reset'] ?> 
											</button>
										</div>
									</div>
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
