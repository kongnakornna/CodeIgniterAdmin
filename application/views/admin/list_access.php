<?php $language = $this->lang->language; ?>
<style type="text/css">
#access_menu{height:400px;}	
</style>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
								</button> -->

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo '<b>'.$language['admin_type'].'</b> '.$admintype->admin_type_title ?></h3>
										

<?php
				if(function_exists('Debug')){
					//Debug($view_obj);
					//Debug($view_subobj);
				}
				//die();

				/*$result_object = $all_member->result_object;
				if($result_object)
					foreach($result_object as $key ){
									echo $key.'<br>';
					}*/

			/*if($error){
?>
											<div class="alert alert-danger">
												<button data-dismiss="alert" class="close" type="button">
													<i class="ace-icon fa fa-times"></i>
												</button>

												<strong>
													<i class="ace-icon fa fa-times"></i>
													Oh snap!
												</strong>
												<?php echo $error?>.
												<br>
											</div>
<?php
			}*/

		if($success){
?>
										<div class="alert alert-block alert-success">
											<button data-dismiss="alert" class="close" type="button">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<p>
												<strong>
													<i class="ace-icon fa fa-check"></i>
													Update Member!
												</strong>
												You successfully read this important alert message.
											</p>
										</div>
										 
<?php
		}
?>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'frmaccessmenu',  'name' => 'frmaccessmenu');
	echo form_open('accessmenu/save', $attributes);
?>		

<div class="col-xs-12 col-sm-4">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title"><?php echo $admintype->admin_type_title ?></h4>

													<span class="widget-toolbar">
														<!-- <a data-action="settings" href="#">
															<i class="ace-icon fa fa-cog"></i>
														</a>

														<a data-action="reload" href="#">
															<i class="ace-icon fa fa-refresh"></i>
														</a> -->

														<a data-action="collapse" href="#">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a data-action="close" href="#">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
												</div>


												<div class="widget-body">	
														<div class="widget-main">
													
															<div class="row">
																<div class="col-sm-6">
																	<span class="bigger-110"> <?php echo  $language['access_menu']?></span>
																	<input type="hidden" name="admin_type_id" value="<?php echo $admintype->admin_type_id?>">
																</div><!-- /.span -->
															</div>

															<!-- <div class="space-2"></div>
															<select data-placeholder="Choose a State..." id="form-field-select-4" class="chosen-select" multiple="" style="display: none;">
<?php
/**
	if($admin_menu){
			$allmenu = count($admin_menu);
			for($m=0;$m<$allmenu;$m++){
					$row = $admin_menu[$m];
					echo '<option value="'.$row->_admin_menu_id.'">'.$row->_title.'</option>';
					
			}
	}*/
?>
															</select> -->
															
															<select multiple="multiple" id="access_menu" name="access_menu[]" class="form-control">
<?php
echo $AccessMenu;
?>
															</select>
											</div></div>
											

									
									</div></div>
</div>								


														<!-- /section:plugins/input.chosen -->

									
									</div>
								</div>
								
						
								
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
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
																	
								<?php echo form_close();?>									
						</div><!-- /.row -->