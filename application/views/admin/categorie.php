<?php
			echo "<pre>";
			print_r($category_list);
			echo "</pre>";
			die();
?>						
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
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i>Add Member
								</button>

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $headtxt; ?></h3>
										<div class="table-header">
											Administrator of SD
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
														<th>Name</th>
														<th class="hidden-480">E-mail</th>
														<th>Admin Level</th>

														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Update
														</th>
														<th class="hidden-480">Status</th>

														<th></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=0;
				if($cat_list)
				foreach($cat_list as $key => $arr_field){
						//if(trim($memberlist[$key]->_domain) != ""){

							//$displayexpire = ($displaydate < 0) ? '<span style="color:red">'.$expire_date.'</span>' : $expire_date;

							/*if($cat_list[$key]->_admin_type_id == 1){
								$admin_type_id = "Superadmin";
							}else if($cat_list[$key]->_admin_type_id == 2){
								$admin_type_id = "Admin";
							}else if($cat_list[$key]->_admin_type_id == 3){
								$admin_type_id = "Manager";
							}else
								$admin_type_id = "Web content";*/
?>
		<tr>
						<td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td>
						<td><?=$cat_list[$key]->_category_id?></td>
						<td><?=$cat_list[$key]->_category_name?></td>
						<td><?=$cat_list[$key]->_lang?></td>
						<td><?=$category_id?></td>
						<td></td>
						<td><?=$cat_list[$key]->_status?></td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="blue" href="#">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a>

																<a class="green" href="<?php echo site_url('admin/memberedit/'.$cat_list[$key]->_category_id); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red" href="#">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
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
																			<a href="<?php echo site_url('admin/memberedit/'.$cat_list[$key]->_category_id); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
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
									<td> &nbsp;<a href="<?php echo site_url('domains/show/'.$memberlist[$key]->_did); ?>"><b class="icon-pencil "></b> Edit</a> </td>
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
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->