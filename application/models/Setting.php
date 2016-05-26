<?php
 $language = $this->lang->language;
 if (!$this->session->userdata('user_name')) {
 }else{
 $userinput=$this->session->userdata('user_name');
 $admin_type=$this->session->userdata('admin_type');
 }if($admin_type=='1'){
 #Debug($this->session->userdata);
 #Debug($setting);
 }else{}
?>
<style type="text/css">
div span.input-icon input {border-radius: 5px !important; width:100%}
div.form-group div input {border-radius: 5px !important;width:100%}
div.form-group div textarea {border-radius: 5px !important;width:100%}
.input-icon > .ace-icon {left: 15px;}
</style>
						<div class="page-header">
							<h1>
								<?php echo $language['settingsystem'] ?>
								<small>
									<!-- <i class="ace-icon fa fa-angle-double-right"></i> -->
									<?php //echo $userinput; ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">
									<div class="pull-right"></div>
								</div>

								<div>
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">
											<!-- <div class="well well-sm">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												&nbsp;
												<div class="inline middle blue bigger-110"> Your profile is 70% complete </div>

												&nbsp; &nbsp; &nbsp;
												<div style="width:200px;" data-percent="70%" class="inline middle no-margin progress progress-striped active">
													<div class="progress-bar progress-bar-success" style="width:70%"></div>
												</div>
											</div> -->
											<!-- /.well -->

<!-- message -->		
<?php
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											Error : </strong><?php echo $error?>.
									<br>
							</div>
				</div>
<?php
			}
?>
<?php
			if(isset($success)){
?>
				<div class="col-xs-12">
							<div class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $success?>.
									<br>
							</div>
				</div>
<?php
			}
?>
<!-- Form -->		
			<div class="space"></div>
<?php 
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open_multipart('setting/save', $attributes);
?>
<ul>
	<?php if(@$upload_data) foreach ($upload_data as $item => $value):?>
		<li><?php echo $item;?>: <?php echo $value;?></li>
	<?php endforeach; ?>
</ul>

					<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																<?php echo $language['basic_info'] ?>
															</a>
														</li>

														<!-- <li>
															<a data-toggle="tab" href="#edit-settings">
																<?php //echo $language['settings'] ?>
																<i class="purple ace-icon fa fa-signal bigger-125"></i>
																<?php echo $language['activity'] ?>
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																<?php echo $language['password'] ?>
															</a>
														</li> -->
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<!-- edit-basic -->
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller"><?php echo $language['settingsystem'] ?></h4>

															<div class="row">
																<!-- <div class="col-xs-12 col-sm-4">
																	<div id="upload_avatar"><input type="file" name="admin_avatar" /></div>
																</div> -->

																<div class="vspace-12-sm"></div>

																<div class="col-xs-12 col-sm-9">
																	<div class="form-group">
<label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['systemname'] ?></label>
																		<div class="col-sm-8">
<input class="col-xs-12 col-sm-12" name="systemname" type="text" id="systemname" placeholder="<?php echo $language['systemname'] ?>" value="<?php if($setting['systemname']) echo $setting['systemname'] ?>" />

																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
<label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['description'] ?></label>

																		<div class="col-sm-8">
<textarea class="col-xs-12 col-sm-12" name="description"id="description" placeholder="<?php echo $language['description'] ?>" rows="" cols=""><?php if($setting['description']) echo $setting['description'] ?></textarea>
																		</div>
																	</div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
<div class="form-group">
<label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['address'] ?></label>

																		<div class="col-sm-8">
<textarea class="col-xs-12 col-sm-12" name="address"id="address" placeholder="<?php echo $language['address'] ?>" rows="" cols=""><?php if($setting['address']) echo $setting['address'] ?></textarea>
																		</div>
																	</div>   
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
<div class="space-4"></div>

 <div class="form-group">
 <label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['registerno'] ?></label>
 <div class="col-sm-8">
 <input class="col-xs-12 col-sm-12" name="registerno" type="text" id="registerno" placeholder="<?php echo $language['registerno'] ?>" value="<?php if($setting['registerno']) echo $setting['registerno'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['contact'] ?></label>

																		<div class="col-sm-8">
																					<input class="col-xs-12 col-sm-12" name="author" type="text" id="author" placeholder="<?php echo $language['contact'] ?>" value="<?php if(isset($setting['author'])) echo $setting['author'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

 <div class="form-group">
		 <label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['phone'] ?></label>

<div class="col-sm-8">
 <input class="col-xs-12 col-sm-12" name="phone" type="text" id="phone" placeholder="<?php echo $language['phone'] ?>" value="<?php if(isset($setting['phone'])) echo $setting['phone'] ?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																</div>

															</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['ip'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="ip" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['ip']?>" 
value="<?php if($setting['ip']) echo $setting['ip'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['mac_address'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="mac_address" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['mac_address']?>" 
value="<?php if($setting['mac_address']) echo $setting['mac_address'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['licence_key'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="licence_key" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['licence_key']?>" 
value="<?php if($setting['licence_key']) echo $setting['licence_key'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['version'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="version" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['version']?>" 
value="<?php if($setting['version']) echo $setting['version'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>





															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['contact'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="email"><?php echo $language['email'] ?></label>

 <div class="col-sm-9">
 <span class="input-icon input-icon-right">
<input class="col-xs-12 col-sm-12" name="admin_email" type="email" id="email"  placeholder="<?php echo $language['email'] ?>" value="<?php if($setting['admin_email']) echo $setting['admin_email'] ?>"   />
																		<i class="ace-icon fa fa-envelope"></i>
 																</span>
																</div>
																<div class="help-block inline"></div>
															</div>

															<div class="space-4"></div>
															<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['mobile'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
<input name="mobile" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['mobile']?>" 
value="<?php if($setting['mobile']) echo $setting['mobile'] ?>"/>
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>





<div class="space"></div>
<h4 class="header blue bolder smaller"><?php echo  $language['settings'].$language['address'] ?></h4>
<?php ###########-----------------####################-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['countries'] ?> </label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="countries" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['countries']?>" 
value="<?php if($setting['countries']) echo $setting['countries'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['geography'] ?>  </label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="geography" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['geography']?>" 
value="<?php if($setting['geography']) echo $setting['geography'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['province'] ?> </label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="province" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['province']?>" 
value="<?php if($setting['province']) echo $setting['province'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['amphur'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="amphur" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['amphur']?>" 
value="<?php if($setting['amphur']) echo $setting['amphur'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['district'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="district" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['district']?>" 
value="<?php if($setting['district']) echo $setting['district'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------#########?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['moo'] ?></label>
<div class="col-sm-9">
<span class="input-icon input-icon-right">
<input name="moo" class="input-medium input-mask-phone" type="text" id="form-field-phone" placeholder="<?php echo $language['moo']?>" 
value="<?php if($setting['moo']) echo $setting['moo'] ?>"/>
</span>
</div>
</div>
<?php ###########-----------------####################-----------------#########?>



													<div>
															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['social'] ?></h4>






															
															
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="facebook" id="form-field-facebook" class="col-xs-12 col-sm-12" value="<?php if($setting['facebook']) echo $setting['facebook'] ?>" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="twitter" id="form-field-twitter" class="col-xs-12 col-sm-12" value="<?php if($setting['twitter']) echo $setting['twitter'] ?>" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>



<div class="form-group">
                                                              <label class="col-sm-3 control-label no-padding-right" for="form-field-youtube">Youtube</label>
                                                              <div class="col-sm-9"> <span class="input-icon col-sm-9">
                                                                <input type="text" name="youtube" id="form-field-youtube" class="col-xs-12 col-sm-12" value="<?php if(isset($setting['youtube'])) echo $setting['youtube'] ?>" />
                                                                <i class="ace-icon fa fa-youtube red"></i> </span> </div>
													  </div>



<div class="form-group">
                                                              <label class="col-sm-3 control-label no-padding-right" for="form-field-instagram">Instagram</label>
                                                              <div class="col-sm-9"> <span class="input-icon col-sm-9">
                                                                <input type="text" name="instagram" id="form-field-instagram" class="col-xs-12 col-sm-12" value="<?php if(isset($setting['instagram'])) echo $setting['instagram'] ?>" />
                                                                <i class="ace-icon fa fa-instagram brow"></i> </span> </div>
													  </div>



															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="google" id="form-field-gplus" class="col-xs-12 col-sm-12" value="<?php if($setting['google']) echo $setting['google'] ?>" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>
													</div>
<!--  -->


													<!-- <div>
															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['social'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="facebook" id="form-field-facebook" class="col-xs-12 col-sm-12" value="<?php if($setting['facebook']) echo $setting['facebook'] ?>" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="twitter" id="form-field-twitter" class="col-xs-12 col-sm-12" value="<?php if($setting['twitter']) echo $setting['twitter'] ?>" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon col-sm-9">
																		<input type="text" name="google" id="form-field-gplus" class="col-xs-12 col-sm-12" value="<?php if($setting['google']) echo $setting['google'] ?>" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>
													</div> -->

											</div>
											
											<div class="space-4"></div>

														<!-- Settings -->
														<!-- 
														<div id="edit-settings" class="tab-pane">
															<div class="space-10"></div>

															<div class="row">
						
																<div class="col-sm-12"> -->


															<!-- <div class="row">
																<div class="col-sm-6">
																	
																	<span class="bigger-110"><?php echo $language['activity'] ?></span>
																</div>
															</div>

															<div class="space"></div>
															<select data-placeholder="Choose a menu..." id="select-menu" class="chosen-select" multiple="" style="display: none;">
<?php
				/*if($admin_menu){
						$allmenu = count($admin_menu);
						for($m=0;$m<$allmenu;$m++){
								$row = $admin_menu[$m];
								echo '<option value="'.$row->_admin_menu_id.'">'.$row->_title.'</option>';
								
								$submenu = $this->menufactory->getMenu($row->_admin_menu_id, $admin_id);
								if($submenu){
										$allsubmenu = count($submenu);
										for($n=0;$n<$allsubmenu;$n++){
												$subrow = $submenu[$n];
												echo '<option value="'.$subrow->_admin_menu_id.'"> - '.$subrow->_title.'</option>';
										}
								}

						}
				}*/
?>
															</select>							

																</div>
															</div>
										
														</div> -->

														<!-- edit-password -->
														<!-- <div id="edit-password" class="tab-pane">
															<div class="space-10"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1"><?php echo $language['new_password'] ?></label>

																<div class="col-sm-9">
																	<input type="password" name="password1" id="form-field-pass1" value='' disabled/>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2"><?php echo $language['confirm_password'] ?></label>

																<div class="col-sm-9">
																	<input type="password" name="password2" id="form-field-pass2" value='' disabled/>
																</div>
															</div>
														</div>
													</div> -->

												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" id="send">
															<i class="ace-icon fa fa-check bigger-110"></i>
															<?php echo $language['save'] ?>
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															<?php echo $language['reset'] ?>
														</button>
													</div>
												</div>
											<?php echo form_close();?>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php 

?>
		/*$('#bootbox-confirm').click(function( ) {
				var v = $(this).attr('data-value');
				var img = $(this).attr('data-img');
				$.ajax({
						type: 'POST',
						url: "<?php echo base_url() ?>admin/remove_img/" + v,
						data : { img : img},
						cache: false,
						success: function(data){
								if(data = 'Yes'){
										//alert(data);
										$('#admin_avatar').attr('style', 'display:none');
										$('#upload_avatar').attr('style', 'display:block');
								}
						}
				});
		});*/
});

</script>
<?php //echo js_asset('checkall.js'); ?>

