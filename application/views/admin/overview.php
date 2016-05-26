<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($admin_team);
?>
<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>
						<!-- <div class="page-header">
							<h1>
							<?php //echo $HeadTitle?>
							<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								<?php //echo $HeadTitle?>
							</small>
							</h1>
						</div> -->
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





<!-- start: PAGE CONTENT -->
					<div class="row">
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-user-4 circle-icon circle-green"></i>
									<h2>Manage Users</h2>
								</div>
								<div class="content">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</div>
								<a class="view-more" href="#">
									View More <i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-clip circle-icon circle-teal"></i>
									<h2>Manage Orders</h2>
								</div>
								<div class="content">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</div>
								<a class="view-more" href="#">
									View More <i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="core-box">
								<div class="heading">
									<i class="clip-database circle-icon circle-bricky"></i>
									<h2>Manage Data</h2>
								</div>
								<div class="content">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
								</div>
								<a class="view-more" href="#">
									View More <i class="clip-arrow-right-2"></i>
								</a>
							</div>
						</div>
					</div>








				<div class="row">
						<div class="col-md-12">
							<!-- start: CIRCLE DIALS PANEL -->
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-external-link-square"></i>
									Circle Dials
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-expand" href="#">
											<i class="fa fa-resize-full"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-info">
												Nice, downward compatible, touchable, jQuery dial
											</div>
										</div>
										<div class="col-md-4">
											<h4>&#215; Disable display input</h4>
											<input class="knob" data-width="100" data-displayInput=false value="35">
										</div>
										<div class="col-md-4">
											<h4>&#215; 'cursor' mode</h4>
											<input class="knob" data-width="150" data-cursor=true data-fgColor="#222222" data-thickness=.3 value="29">
										</div>
										<div class="col-md-4">
											<h4>&#215; Display previous value</h4>
											<input class="knob" data-width="200" data-min="-100" data-displayPrevious=true value="44">
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<h4>&#215; Angle offset</h4>
											<input class="knob" data-angleOffset=90 data-linecap=round value="35">
										</div>
										<div class="col-md-4">
											<h4>&#215; Angle offset and arc</h4>
											<input class="knob" data-angleOffset=-125 data-angleArc=250 data-fgColor="#66EE66" value="35">
										</div>
										<div class="col-md-4">
											<h4>&#215; 5-digit values, step 1000</h4>
											<input class="knob" data-min="-15000" data-displayPrevious=true data-max="15000" data-step="1000" value="-11000">
										</div>
									</div>
								</div>
							</div>
							<!-- end: CIRCLE DIALS PANEL -->
						</div>
					</div>













					<div class="row">
						<div class="col-sm-7">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-stats"></i>
									Site Visits
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body">
									<div class="flot-medium-container">
										<div id="placeholder-h1" class="flot-placeholder"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="row">
								<div class="col-sm-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<i class="clip-pie"></i>
											Acquisition
											<div class="panel-tools">
												<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
												</a>
												<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
													<i class="fa fa-wrench"></i>
												</a>
												<a class="btn btn-xs btn-link panel-refresh" href="#">
													<i class="fa fa-refresh"></i>
												</a>
												<a class="btn btn-xs btn-link panel-close" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
										<div class="panel-body">
											<div class="flot-mini-container">
												<div id="placeholder-h2" class="flot-placeholder"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="panel panel-default">
										<div class="panel-heading">
											<i class="clip-bars"></i>
											Pageviews real-time
											<div class="panel-tools">
												<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
												</a>
												<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
													<i class="fa fa-wrench"></i>
												</a>
												<a class="btn btn-xs btn-link panel-refresh" href="#">
													<i class="fa fa-refresh"></i>
												</a>
												<a class="btn btn-xs btn-link panel-close" href="#">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
										<div class="panel-body">
											<div class="flot-mini-container">
												<div id="placeholder-h3" class="flot-placeholder"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-7">
							<div class="row space12">
								<ul class="mini-stats col-sm-12">
									<li class="col-sm-4">
										<div class="sparkline_bar_good">
											<span>3,5,9,8,13,11,14</span>+10%
										</div>
										<div class="values">
											<strong>18304</strong>
											Visits
										</div>
									</li>
									<li class="col-sm-4">
										<div class="sparkline_bar_neutral">
											<span>20,15,18,14,10,12,15,20</span>0%
										</div>
										<div class="values">
											<strong>3833</strong>
											Unique Visitors
										</div>
									</li>
									<li class="col-sm-4">
										<div class="sparkline_bar_bad">
											<span>4,6,10,8,12,21,11</span>+50%
										</div>
										<div class="values">
											<strong>18304</strong>
											Pageviews
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="row space12">
								<div class="col-sm-6">
									<div class="easy-pie-chart">
										<span class="bounce number" data-percent="44"> <span class="percent">44</span> </span>
										<div class="label-chart">
											Bounce Rate
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="easy-pie-chart">
										<span class="cpu number" data-percent="82"> <span class="percent">82</span> </span>
										<div class="label-chart">
											New Visits
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-7">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-users-2"></i>
									Users
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body panel-scroll" style="height:300px">
									<table class="table table-striped table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">Photo</th>
												<th>Full Name</th>
												<th class="hidden-xs">Email</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="center"><img src="assets/images/avatar-1.jpg" alt="image"/></td>
												<td>Peter Clark</td>
												<td class="hidden-xs">
												<a href="#" rel="nofollow" target="_blank">
													peter@example.com
												</a></td>
												<td class="center">
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
											<tr>
												<td class="center"><img src="assets/images/avatar-2.jpg" alt="image"/></td>
												<td>Nicole Bell</td>
												<td class="hidden-xs">
												<a href="#" rel="nofollow" target="_blank">
													nicole@example.com
												</a></td>
												<td class="center">
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
											<tr>
												<td class="center"><img src="assets/images/avatar-3.jpg" alt="image"/></td>
												<td>Steven Thompson</td>
												<td class="hidden-xs">
												<a href="#" rel="nofollow" target="_blank">
													steven@example.com
												</a></td>
												<td class="center">
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
											<tr>
												<td class="center"><img src="assets/images/avatar-5.jpg" alt="image"/></td>
												<td>Kenneth Ross</td>
												<td class="hidden-xs">
												<a href="#" rel="nofollow" target="_blank">
													kenneth@example.com
												</a></td>
												<td class="center">
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
											<tr>
												<td class="center"><img src="assets/images/avatar-4.jpg" alt="image"/></td>
												<td>Ella Patterson</td>
												<td class="hidden-xs">
												<a href="#" rel="nofollow" target="_blank">
													ella@example.com
												</a></td>
												<td class="center">
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-edit"></i> Edit
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-share"></i> Share
																</a>
															</li>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="#">
																	<i class="fa fa-times"></i> Remove
																</a>
															</li>
														</ul>
													</div>
												</div></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-checkbox"></i>
									To Do
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
										<a class="btn btn-xs btn-link panel-config" href="#panel-config" data-toggle="modal">
											<i class="fa fa-wrench"></i>
										</a>
										<a class="btn btn-xs btn-link panel-refresh" href="#">
											<i class="fa fa-refresh"></i>
										</a>
										<a class="btn btn-xs btn-link panel-close" href="#">
											<i class="fa fa-times"></i>
										</a>
									</div>
								</div>
								<div class="panel-body panel-scroll" style="height:300px">
									<ul class="todo">
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
												<span class="label label-danger" style="opacity: 1;"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
												<span class="label label-danger" style="opacity: 1;"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> Hire developers</span>
												<span class="label label-warning"> tommorow</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc">Staff Meeting</span>
												<span class="label label-warning"> tommorow</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> New frontend layout</span>
												<span class="label label-success"> this week</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> Hire developers</span>
												<span class="label label-success"> this week</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> New frontend layout</span>
												<span class="label label-info"> this month</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> Hire developers</span>
												<span class="label label-info"> this month</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc" style="opacity: 1; text-decoration: none;">Staff Meeting</span>
												<span class="label label-danger" style="opacity: 1;"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc" style="opacity: 1; text-decoration: none;"> New frontend layout</span>
												<span class="label label-danger" style="opacity: 1;"> today</span>
											</a>
										</li>
										<li>
											<a class="todo-actions" href="javascript:void(0)">
												<i class="fa fa-square-o"></i>
												<span class="desc"> Hire developers</span>
												<span class="label label-warning"> tommorow</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					 
<!-- end: PAGE CONTENT-->








				<div class="row">
						<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('team/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'] ?>
								</button>
								<div class="row">
									<div class="col-xs-12">
							<h1><?php echo $language['modules'] ?> 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --> <?php echo $language['admin_team'] ?> 
								</small>
							</h1>
										

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($this->session->userdata);
					//Debug($this->lang->language);
				}
				//Debug($this->session->userdata('admin_id')) ;
?>
<div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('admin_team', $attributes);
?>
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th>ID</th>
														<th><?php echo $language['title'] ?></th>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>
														</th>
														<th><?php echo $language['access'] ?> <?php echo $language['category'] ?></th>
														<th class="hidden-480"><?php echo $language['status'] ?></th>
														<th><?php echo $language['action'] ?></th>
													</tr>
												</thead>
				<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=0;
				//$maxcat = count($category);
				if($admin_team)
				for($key=0;$key<$maxcat;$key++){

?>
		<tr>
						<td>
								<?=$admin_team[$key]['admin_team_id']?>
								<input type="hidden" class="ace" name="selectid[]" value="<?=$admin_team[$key]['admin_team_id']?>" />
						</td>
						<td><a href="<?php echo site_url('team/access/'.$admin_team[$key]['admin_team_id']); ?>"><?=$admin_team[$key]['admin_team_title']?></a></td>
						<td><?=$admin_team[$key]['create_date']?></td>
						<td><a href="<?php echo site_url('team/access/'.$admin_team[$key]['admin_team_id']); ?>">
						<i class="ace-icon glyphicon glyphicon-list"> <?=$language['access']?></i></a></td>
						<td>
								<label>
										<input name="status[]" id="status<?=$admin_team[$key]['admin_team_id']?>" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" <?php if($admin_team[$key]['status'] == 1) echo 'checked';?>  value=1>
										<span class="lbl"></span>
								</label>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">																

																<a class="green" href="<?php echo site_url('team/edit/'.$admin_team[$key]['admin_team_id']); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130" data-rel="tooltip" title="Edit"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$admin_team[$key]['admin_team_id']?>" data-value="<?=$admin_team[$key]['admin_team_id']?>" data-name="<?=$admin_team[$key]['admin_team_title']?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"  data-rel="tooltip" title="Delete"></i>
																</a>
															</div>
															<!-- hidden-lg -->
															<div class="hidden-md hidden-lg">
																<div class="inline position-relative">

																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">

																		<li>
																			<a href="<?php echo site_url('team/edit/'.$admin_team[$key]['admin_team_id']); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bx-confirm<?=$admin_team[$key]['admin_team_id']?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
<?php
	echo form_close();
?>
										</div>
									</div>
								</div>

						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($admin_team)		
				for($key=0;$key<$maxcat;$key++){
						
						$title = $admin_team[$key]['admin_team_title'];
?>
		$('#status<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				
				//alert($(this).attr('id'));			
				//alert($(this).val());

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('team/status/'.$admin_team[$key]['admin_team_id'])?>",
					cache: false,
					success: function(data){
							
							if(data == 0){
								$("#msg_error").attr('style','display:block;');
								AlertError('Inactive');
							}else{
								$("#msg_success").attr('style','display:block;');
								AlertSuccess	('Active');
							}
					}
				});
		});

		$('#bootbox-confirm<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('team/delete/'.$admin_team[$key]['admin_team_id'])?>';
						}
					});
		});

		$('#bx-confirm<?=$admin_team[$key]['admin_team_id']?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('team/delete/'.$admin_team[$key]['admin_team_id'])?>';
						}
					});
		});

<?php
				}	
?>

		$('#saveorder').on('click', function() {
				document.getElementById("jform").submit();
		});		
});

</script>
<?php //echo js_asset('checkall.js'); ?>
