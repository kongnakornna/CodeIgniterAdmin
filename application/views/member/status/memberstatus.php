<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($memberstatus_status);
		//Debug($memberstatus_list);			
?>
<div class="col-xs-12">

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('memberstatus/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add']?>
								</button>
<?php
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" status="button">
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
									<button data-dismiss="alert" class="close" status="button">
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
	//Debug($memberstatus_list);
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('columnist', $attributes);
?>
											<table width="100%" class="table table-striped table-bordered table-hover" id="sample-table-2">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input status="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="6%" height="23"><?php echo $language['no'] ?></th>
														<th width="30%"><?php echo $language['title'].$language['status'].$language['member']?></th>														
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

			$allmemberstatus = count($memberstatus_list);
			if(isset($memberstatus_list))
					for($i=0;$i<$allmemberstatus;$i++){

								//$pic = ($memberstatus_list[$i]['avatar'] == '') ? 'theme/assets/avatars/avatar3.png' : 'uploads/memberstatus/'.$memberstatus_list[$i]['avatar'];
								//$thumb = $pic;

								$memberstatus_id = $memberstatus_list[$i]->memberstatus_id;
								$title = $memberstatus_list[$i]->memberstatus_name;
								$create_date = $memberstatus_list[$i]->create_date;
								//$create_by = $memberstatus_list[$i]->create_by;
								$create_by = $memberstatus_list[$i]->admin;
								$memberstatus_status = $memberstatus_list[$i]->status;
?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input status="checkbox" class="ace" name="selectid[]" value="<?php echo $memberstatus_id ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td><?=$memberstatus_id?></td>
						<td> 
					    <?=$title?> </td>
						<td><?=$create_date?></td>
						<td><?=$create_by?></td>

						<td class="hidden-480"><span class="col-sm-6">
								<?php echo $memberstatus_status;?>
								 
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<!-- <a class="blue" href="#">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->
                                                                <?php if($memberstatus_id>6){?>
																<a class="green" href="<?php echo site_url('memberstatus/edit/'.$memberstatus_id) ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<?php }?>

																

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
																			<a href="<?php echo site_url('memberstatus/edit/'.$memberstatus_id) ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
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
												<div class="memberstatus">
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

