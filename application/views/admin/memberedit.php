<?php
 $admin_idnana=$this->session->userdata('admin_id');
$adminids=(int)$this->uri->segment(3);
 
//echo '$adminids='.$adminids; Die();
$language = $this->lang->language; 
// Debug($memberlist); Die();
?>
						<div class="page-header">
							<h1>
								<?php echo $headtxt; ?>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<?php echo $language['username'] ?>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="clearfix">

									<!-- <div class="pull-left alert alert-success no-margin">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>
										<i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
										Click on the image below or on profile fields to edit them ...
									</div> -->

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


 //Debug($memberlist); Die();

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
	echo form_open_multipart('admin/member_save', $attributes);
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

														<li>
															<a data-toggle="tab" href="#edit-settings">
																<!-- <i class="purple ace-icon fa fa-cog bigger-125"></i> -->
																<?php //echo $language['settings'] ?>
																<i class="purple ace-icon fa fa-signal bigger-125"></i>
																<?php echo $language['address'] ?>
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																<?php echo $language['password'] ?>
															</a>
														</li>
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<!-- edit-basic -->
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller"><?php echo $language['general'] ?></h4>
															<input type="hidden" name="admin_id" value="<?php echo ($this->uri->segment(3)>0) ? $this->uri->segment(3) : 0 ?>">

															<div class="row">
																	<div class="col-xs-12 col-sm-4">
																	<?php
																	if($memberlist)
																			if($memberlist->_admin_avatar != ''){
																	?>
																	<!-- <span class="profile-picture">
																		<img id="avatar" class="editable img-responsive" alt="<?=$this->session->userdata('user_name')?>'s Avatar" src="<?php echo base_url().'uploads/admin/'.$memberlist->_admin_avatar ?>" />
																	</span> -->
																	<div id='admin_avatar'>
																	<span class="profile-picture">
																		<img class="editable img-responsive" alt="<?=$this->session->userdata('user_name')?>'s Avatar" id="avatar_admin" src="<?php echo base_url().'uploads/admin/'.$memberlist->_admin_avatar ?>" />
																	</span>
																	<a class="red" href="javascript:void(0);" id="bootbox-confirm" title="Delete" data-value="<?php echo $this->uri->segment(3) ?>" data-img="<?='uploads/admin/'.$memberlist->_admin_avatar?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
																	</div>
																	<?php
																			}
																	?>
																	<div id="upload_avatar"><input type="file" name="admin_avatar" /></div>

																</div>

																<div class="vspace-12-sm"></div>

																<div class="col-xs-12 col-sm-8">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="form-field-username"><?php echo $language['username'] ?></label>

																		<div class="col-sm-8">

<?php 
$member=$this->uri->segment(3);
?>
<input class="col-xs-12 col-sm-10" name="admin_username" type="text" id="form-field-username" placeholder="<?php echo $language['username'] ?>" value="<?php if($memberlist) echo $memberlist->_admin_username?>" disabled/>

																	</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="firstname"><?php echo $language['name'] ?> <br> <br> <br> <?php echo $language['lastname'] ?></label>

																		<div class="col-sm-8">
<input class="col-xs-12 col-sm-10"  name="admin_name" type="text" id="firstname" placeholder="<?php echo $language['name'] ?>" value="<?php if($memberlist) echo $memberlist->_admin_name?>" />
<br /><br /><br />
<input class="col-xs-12 col-sm-10"  name="admin_lastname" type="text" id="lastname" placeholder="<?php echo $language['lastname'] ?>" value="<?php if($memberlist) echo $memberlist->_admin_lastname?>" />
																		</div>
																	</div>
																</div>

															</div>

															<!-- <hr />
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-date">Birth Date</label>

																<div class="col-sm-9">
																	<div class="input-medium">
																		<div class="input-group">
																			<input class="input-medium date-picker" id="form-field-date" type="text" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
																			<span class="input-group-addon">
																				<i class="ace-icon fa fa-calendar"></i>
																			</span>
																		</div>
																	</div>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right">Gender</label>

																<div class="col-sm-9">
																	<label class="inline">
																		<input name="form-field-radio" type="radio" class="ace" />
																		<span class="lbl middle"> Male</span>
																	</label>

																	&nbsp; &nbsp; &nbsp;
																	<label class="inline">
																		<input name="form-field-radio" type="radio" class="ace" />
																		<span class="lbl middle"> Female</span>
																	</label>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-comment">Comment</label>

																<div class="col-sm-9">
																	<textarea id="form-field-comment"></textarea>
																</div>
															</div> -->

															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['contact'] ?></h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="email"><?php echo $language['email'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
				 <input name="admin_email" type="email" id="email" value="<?php if($memberlist) echo $memberlist->_admin_email?>" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
																</div>
																<div class="help-block inline"></div>
															</div>

															<div class="space-4"></div>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['phone'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input name="phone" class="input-medium input-mask-phone" type="text" id="form-field-phone" value="<?php if($memberlist) echo $memberlist->_phone?>"  />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-phone"><?php echo $language['mobile'] ?></label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input name="mobile" class="input-medium input-mask-mobile" type="text" id="form-field-phone" value="<?php if($memberlist) echo $memberlist->_mobile?>"  />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-level"><?php echo $language['admin_level'] ?></label>
																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<select id="admin_type_id" name="admin_type_id" class="form-control">
<?php if($admin_type==1 || $memberlist->_admin_type_id == 1){?>															
<option value="1" <?php if($memberlist) if($memberlist->_admin_type_id == 1) echo 'selected' ?>>Super Administrator</option>
<?php }?>		
 <option value="2" <?php if($memberlist) if($memberlist->_admin_type_id == 2) echo 'selected' ?>>Administrator</option>
 <option value="3" <?php if($memberlist) if($memberlist->_admin_type_id == 3) echo 'selected' ?>>Manager(ผู้จัดการ) </option>
 <option value="4" <?php if($memberlist) if($memberlist->_admin_type_id == 4) echo 'selected' ?>>Supervisor(หัวหน้าแผนก) </option>
 <option value="5" <?php if($memberlist) if($memberlist->_admin_type_id == 5) echo 'selected' ?>>Employee(พนักงาน)</option>
 <option value="6" <?php if($memberlist) if($memberlist->_admin_type_id == 6) echo 'selected' ?>>Register(นายทะเบียน)</option>
																			</select>
																	</span>
																</div>
															</div>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
 <div class="form-group">
 <label class="col-sm-3 control-label no-padding-right"><?php echo $language['department'] ?></label>
 <div class="col-sm-9">
 <span class="input-icon input-icon-right">
 <input name="department" type="text" id="department" value="<?php if($memberlist) echo $memberlist->_department?>" />

 </span>
 </div>
 <div class="help-block inline"></div>
 </div>                                                           
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-level"><?php echo $language['admin_team'] ?></label>
																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
<?php
			//Debug($memberlist);
			//Debug($team_list);
			$selected = '';
			if(isset($team_list)){
					echo '<select id="admin_team_id" name="admin_team_id" class="form-control">';
					echo '<option value="0"> === '.$language['please_select'].' === </option>';
					for($i=0;$i<count($team_list);$i++){
							$admin_team_id = $team_list[$i]['admin_team_id'];
							$admin_team_title = $team_list[$i]['admin_team_title'];

							$selected = ($admin_team_id == $memberlist->_admin_team_id) ? 'selected' : '';
							echo '<option value="'.$admin_team_id.'" '.$selected.'> '.$admin_team_title.'</option>';
					}
					echo '</select>';
			}
?>
																	</span>
																</div>
															</div>

															<div class="form-group">
					<?php if($memberlist->_admin_id >3){ ?>
					<?php if($admin_idnana<>$memberlist->_admin_id){?>
					<label class="col-sm-3 control-label no-padding-right" for="form-field-status"><?php echo $language['status'] ?></label>
					<?php }?>
					<?php }?>
																<div class="col-sm-9">
																	<span class="col-sm-2">
																		<label class="pull-right inline">
																			<small class="muted"></small>

																			
																			
<?php if($memberlist->_admin_id >3){ ?>
<?php if($admin_idnana<>$memberlist->_admin_id){?>
<input type="checkbox" name="status" class="ace ace-switch ace-switch-5" <?php if($memberlist) if($memberlist->_status == 1) echo 'checked';?> id="form-field-status" value=1>
<?php }?>
<?php }else{?>
<input name="status" type="hidden" value="1" />
<?php }?>
																			
																			<span class="lbl middle"></span>
																		</label>
																	</span>
																</div>
															</div>

													<div style="display:none;">

															<div class="space"></div>
															<h4 class="header blue bolder smaller"><?php echo $language['social'] ?> (ยังไม่ได้บันทึก)</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-facebook">Facebook</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="facebook" id="form-field-facebook" />
																		<i class="ace-icon fa fa-facebook blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-twitter">Twitter</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="twitter" id="form-field-twitter" />
																		<i class="ace-icon fa fa-twitter light-blue"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-gplus">Google+</label>

																<div class="col-sm-9">
																	<span class="input-icon">
																		<input type="text" name="google" id="form-field-gplus" />
																		<i class="ace-icon fa fa-google-plus red"></i>
																	</span>
																</div>
															</div>
													</div>

											</div>

														<div class="space-4"></div>
														<!-- Settings -->
														<div id="edit-settings" class="tab-pane">
															<div class="space-10"></div>

															<div class="row">
						
																<div class="col-sm-12">

											<!-- <div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">Select Box</h4>

													<span class="widget-toolbar">
														<a data-action="settings" href="#">
															<i class="ace-icon fa fa-cog"></i>
														</a>

														<a data-action="reload" href="#">
															<i class="ace-icon fa fa-refresh"></i>
														</a>

														<a data-action="collapse" href="#">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a data-action="close" href="#">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
												</div>


												<div class="widget-body">	
														<div class="widget-main"> -->

															<div class="row">
																<div>
																	
																	<span class="bigger-110"><!-- Multiple -->
 <?php echo $language['address'] ?>  <br />
 
<textarea name="address" class="ckeditor form-control" cols="100" rows="2" id="address"><?php if($memberlist) echo $memberlist->_address?>
</textarea>
 

                                                                    
                                                                  </span>
																</div><!-- /.span -->
															</div>

															<div class="space"></div>
															<select data-placeholder="Choose a menu..." id="select-menu" class="chosen-select" multiple="" style="display: none;">
<?php
				if($admin_menu){
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
				}
?>
															</select>
													<!-- </div>
												</div>

										</div> -->									

																</div>
															</div>
										
														</div>

														<!-- edit-password -->
														<div id="edit-password" class="tab-pane">
															<div class="space-10"></div>
<?php $adminids=(int)$this->uri->segment(3);?>
															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1"><?php echo $language['new_password'] ?></label>
																
																<div class="col-sm-9"> <!--<input type="password" name="password1" id="form-field-pass1" value='' disabled/> -->
																<?php 
																 
																if($adminids<>1){?>	
																	<input type="password" name="password1" id="form-field-pass1" value='' />
																<?php }else{ echo $this->lang->line('fobidden'); ?>
																<input type="hidden" name="password1" id="form-field-pass1" value='' />
																
																<?php }?>
																</div>
																
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2"><?php echo $language['confirm_password'] ?></label>

																<div class="col-sm-9">
																<?php if($adminids<>1){?>
																	<input type="password" name="password2" id="form-field-pass2" value='' />
																<?php }else{ echo $this->lang->line('fobidden'); ?>
																<input type="hidden"  name="password2" id="form-field-pass2" value='' />
																<?php }?>
																</div>
															</div>
														</div>
														
												<br/>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" id="send">
															<i class="ace-icon fa fa-check bigger-110"></i>
														<?php echo $language['save']?>
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															<?php echo $language['reset']?>
														</button>
													</div>
												</div>
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

		if($memberlist->_admin_avatar != ''){ echo "$('#upload_avatar').attr('style', 'display:none');\n";	} 

?>
		$('#bootbox-confirm').on('click', function() {				
				var v = $(this).attr('data-value');
				var img = $(this).attr('data-img');

				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {

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

						}
				});
		});
});

</script>
<?php echo js_asset('checkall.js'); ?>
<script src="<?php echo base_url('theme');?>/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url('theme');?>/assets/plugins/ckeditor/adapters/jquery.js"></script>