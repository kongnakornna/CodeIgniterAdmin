<?php $language = $this->lang->language; ?>


						<!-- <div class="page-header">
							<h1>
							<?php //echo $HeadTitle?>
							<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								<?php //echo $HeadTitle?>
							</small>
							</h1>
						</div> -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['member_list'] ?></h3>
										<div class="table-header">
											<?php echo $language['member_list'] ?>
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($all_member);
					//Debug($memberlist);
				}
				/*echo "<pre>";
				var_dump($this);
				echo "</pre>";*/

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
		
		if(isset($success)){
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

				<div>
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
														<th>ID</th>
														<th><?php echo $language['name'] ?></th>
														<th><?php echo $language['email'] ?></th>
														<th class="hidden-480"><?php echo $language['admin_level'] ?></th>
														<th class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['update'] ?>
														</th>
														<th class="hidden-480"><?php echo $language['status'] ?></th>
														<th><?php echo $language['action'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=0;
				if($memberlist)
				foreach($memberlist as $key => $arr_field){
						//if(trim($memberlist[$key]->_domain) != ""){

							//$displayexpire = ($displaydate < 0) ? '<span style="color:red">'.$expire_date.'</span>' : $expire_date;
							if($memberlist[$key]->_admin_type_id == 1){
								$admin_type_id = "Superadmin";
							}else if($memberlist[$key]->_admin_type_id == 2){
								$admin_type_id = "Admin";
							}else if($memberlist[$key]->_admin_type_id == 3){
								$admin_type_id = "Manager";
							}else
								$admin_type_id = "Web content";
?>
		<tr>
						<td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td>
						<td><?=$memberlist[$key]->_admin_id?></td>
						<td><?=$memberlist[$key]->_admin_name?></td>
						<td><?=$memberlist[$key]->_admin_email?></td>
						<td class="hidden-480"><?=$admin_type_id?></td>
						<td class="hidden-480"></td>
						<td class="hidden-480"><span class="col-sm-6">
								<label class="pull-right inline" id="enable<?=$memberlist[$key]->_admin_id?>">
								<small class="muted"></small>
									<input type="checkbox" name="status"  id="status<?=$memberlist[$key]->_admin_id?>" class="ace ace-switch ace-switch-5" <?php if($memberlist[$key]->_status  == 1) echo 'checked';?>  value=1>
								<span class="lbl middle"></span>
								</label>
								</span>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<!-- <a class="blue" href="#">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->

																<a class="green" href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$memberlist[$key]->_admin_id?>" data-value="<?=$memberlist[$key]->_admin_id?>" data-name="<?=$memberlist[$key]->_admin_name?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>

																<!-- <button id="bootbox-confirm" class="btn btn-info">Confirm</button> -->
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bootbox-confirm" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>						
						</td>
		</tr>
							<!-- 
									<td> &nbsp;<a href="<?php //echo site_url('domains/show/'.$memberlist[$key]->_did); ?>"><b class="icon-pencil "></b> Edit</a> </td>
							</tr> -->
<?
							$i++;
						//}
				}
?>
	</tbody>
</table>
										</div>
									</div>
								</div>


									<div class="col-sm-6">
										<h3 class="row header smaller lighter orange">
											<span class="col-sm-8">
												<i class="ace-icon fa fa-bell"></i>
												Gritter Notifications
											</span><!-- /.col -->

											<span class="col-sm-4">
												<label class="pull-right inline">
													<small class="muted">Dark:</small>

													<input id="gritter-light" checked="" type="checkbox" class="ace ace-switch ace-switch-5" />
													<span class="lbl middle"></span>
												</label>
											</span><!-- /.col -->
										</h3>

										<p>
											<i>Click to see</i>
										</p>

										<!-- #section:plugins/misc.gritter -->
										<p>
											<button class="btn" id="gritter-regular">Regular</button>
											<button class="btn btn-info" id="gritter-sticky">Sticky</button>
											<button class="btn btn-success" id="gritter-without-image">Without Image</button>
										</p>

										<p>
											<button class="btn btn-danger" id="gritter-error">Error</button>
											<button class="btn btn-warning" id="gritter-max3">Max 3</button>
											<button class="btn btn-primary" id="gritter-center">Center</button>
											<button class="btn btn-inverse" id="gritter-remove">Remove</button>
										</p>

										<!-- /section:plugins/misc.gritter -->
									</div><!-- /.col -->


						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php //Debug($memberlist);?>
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($memberlist)
		for($i=0;$i<count($memberlist);$i++){
		//foreach($memberlist as $key => $arr_field){
	
?>
		$('#status<?=$memberlist[$i]->_admin_id?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('admin/status/'.$memberlist[$i]->_admin_id)?>",
					//data: {id: res},
					cache: false,
					success: function(data){
							//$("#testsc").html('จำนวนผู้อ่าน : ' + data.response.header.view);
							//$("#countview").html('จำนวนผู้อ่าน : ' + data.response.header.view);
							//alert(data);
					}
				});
				
		});
<?php
				}	
?>

				$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar1.png',
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
			
					return false;
				});
			
				$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar3.png',
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
					
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});

});

</script>