<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($membertype_type);
		//Debug($membertype_list);			
?>
<div class="col-xs-12">

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('membertype/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['type'].$language['member']  ?>
								</button>
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
<?php
	//Debug($membertype_list);
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('columnist', $attributes);
?>
											<table width="100%" class="table table-striped table-bordered table-hover" id="sample-table-2">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="9%" height="23"><?php echo $language['no'] ?></th>
														<th width="27%"><?php echo $language['title'].$language['type'].$language['member']?></th>														
														<th width="16%"><?php echo $language['create_date'] ?></th>														
														<th width="15%"><?php echo $language['create_by'] ?></th>														

														<th width="24%" class="hidden-480"><?php echo $language['status'] ?></th>
														<th width="9%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>
	<tbody>												
<?php
			$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$thumb = '';

			$allmembertype = count($membertype_list);
			if(isset($membertype_list))
					for($i=0;$i<$allmembertype;$i++){

								//$pic = ($membertype_list[$i]['avatar'] == '') ? 'theme/assets/avatars/avatar3.png' : 'uploads/membertype/'.$membertype_list[$i]['avatar'];
								//$thumb = $pic;

								$membertype_id = $membertype_list[$i]->membertype_id;
								$title = $membertype_list[$i]->membertype_name;
								$create_date = $membertype_list[$i]->create_date;
								//$create_by = $membertype_list[$i]->create_by;
								$create_by = $membertype_list[$i]->admin;
								$membertype_status = $membertype_list[$i]->status;
?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $membertype_id ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td><?=$membertype_id?></td>
						<td><a href="#">
					    <?=$title?></a></td>
						<td><?=$create_date?></td>
						<td><?=$create_by?></td>

						<td class="hidden-480"><span class="col-sm-6">
								<?php 
								 
								if($membertype_status==1){echo $language['enable'];}else{ echo $language['disable'];}
								
								?>
								 
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<!-- <a class="blue" href="#">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->

																<a class="green" href="<?php echo site_url('membertype/edit/'.$membertype_id) ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$membertype_id?>" data-value="<? //$memberlist[$key]->_admin_id?>" data-name="<?=$title?>">
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
																			<a href="<?php echo site_url('membertype/edit/'.$membertype_id) ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
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
<?php
					}
?>
	</tbody>
</table>
<?php
	echo form_close();
?>
										<!-- <li>
											<a href="../assets/images/gallery/image-4.jpg" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="../assets/images/gallery/thumb-4.jpg" />
												<div class="membertype">
													<span class="label-holder">
														<span class="label label-info arrowed">fountain</span>
													</span>

													<span class="label-holder">
														<span class="label label-danger">recreation</span>
													</span>

												</div>
											</a>

											<div class="tools tools-top">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li> -->

									</ul>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->

