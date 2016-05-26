<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($web_menu);
		$lang=$language['lang']; 
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

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin_menu/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
<?php /* ?>
							<h1><?php 
							$modules=$language['modules'];
							echo " <span style=\"color: #030;\">$modules</span> "; 
							 ?>  
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --> <?php echo $language['admin_menu'] ?> 
								</small>
							</h1>									 
<php */?>
				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($this->session->userdata);
					//Debug($this->lang->language);
				}
				//Debug($this->session->userdata('admin_id')) ;
?>
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
				<div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('admin_menu', $attributes);
?>


										<div class="row">
											<div class="col-md-12 space20">
												<div class="btn-group pull-right">
													<button data-toggle="dropdown" class="btn btn-green dropdown-toggle">
														Export <i class="fa fa-angle-down"></i>
													</button>
													<ul class="dropdown-menu dropdown-light pull-right">
														<li>
															<a href="#" class="export-pdf" data-table="#sample-table-1">
																Save as PDF
															</a>
														</li>
														<li>
															<a href="#" class="export-png" data-table="#sample-table-1">
																Save as PNG
															</a>
														</li>
														<li>
															<a href="#" class="export-csv" data-table="#sample-table-1">
																Save as CSV
															</a>
														</li>
														<li>
															<a href="#" class="export-txt" data-table="#sample-table-1">
																Save as TXT
															</a>
														</li>
														<li>
															<a href="#" class="export-xml" data-table="#sample-table-1">
																Save as XML
															</a>
														</li>
														<li>
															<a href="#" class="export-sql" data-table="#sample-table-1">
																Save as SQL
															</a>
														</li>
														<li>
															<a href="#" class="export-json" data-table="#sample-table-1">
																Save as JSON
															</a>
														</li>
														<li>
															<a href="#" class="export-excel" data-table="#sample-table-1">
																Export to Excel
															</a>
														</li>
														<li>
															<a href="#" class="export-doc" data-table="#sample-table-1">
																Export to Word
															</a>
														</li>
														<li>
															<a href="#" class="export-powerpoint" data-table="#sample-table-1">
																Export to PowerPoint
															</a>
														</li>
													</ul>
												</div>
											</div>
										</div>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="sample-table-2">
	
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="42">No.</th>
														<!--<th width="42">ID</th>-->
														<?php if($this->session->userdata('admin_id') == 1){ ?>
														<!--<th width="54">ID2</th>-->
														<?php } ?>
														<th width="534"><?php echo $language['name'] ?></th>
														<th width="74"><?php echo $language['submenu'] ?></th>
														<th width="79" class="hidden-480">
															<?php echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>
															&nbsp;<i class="ace-icon fa fa-floppy-o bigger-120 blue" id="saveorder"></i>														</th>
														<th width="195">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>														</th>
														<th width="179" class="hidden-480"><?php echo $language['status'] ?></th>

														<th width="107"><?php echo $language['action'] ?></th>
													</tr>
												</thead>
				<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=1;
				//$i=0;
				//$maxcat = count($category);
				if($web_menu)
				for($key=0;$key<$maxcat;$key++){
							
							$menu_id = $web_menu[$key]['admin_menu_id2'];

						//if(trim($memberlist[$key]->_domain) != ""){

							//$displayexpire = ($displaydate < 0) ? '<span style="color:red">'.$expire_date.'</span>' : $expire_date;
							/*if($memberlist[$key]->_admin_type_id == 1){
								$admin_type_id = "Superadmin";
							}else if($memberlist[$key]->_admin_type_id == 2){
								$admin_type_id = "Admin";
							}else if($memberlist[$key]->_admin_type_id == 3){
								$admin_type_id = "Manager";
							}else
								$admin_type_id = "Web content";*/
?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="hidden" class="ace" name="selectid[]" value="<?=$menu_id?>" />
										<span class="lbl"></span>
								</label>
						</td> -->
						<td>
						<?php echo $i;?>
						</td>
						<!--<td>
						<?//=$web_menu[$key]['admin_menu_id']?>)<input type="hidden" class="ace" name="selectid[]" value="<?//=$menu_id?>" />
						</td>-->
						<?php if($this->session->userdata('admin_id') == 1){ ?>
						<!--<td><?//=$menu_id?></td>-->
						<?php } ?>
						<td><a href="<?php echo site_url('admin_menu/view/'.$menu_id); ?>"><?=$web_menu[$key]['title']?></a></td>
						<td><a href="<?php echo site_url('admin_menu/view/'.$menu_id); ?>"><?=$web_menu[$key]['count_sub']?></a></td>
						<td>
								<input name="order[]" type="text" class="input-small" id="order_by" value="<?=$web_menu[$key]['order_by']?>" size="5" placeholder="Not null">
								<!-- &nbsp;<i class="fa fa-arrow-up"></i>&nbsp;
								<i class="fa fa-arrow-down"></i> -->
						</td>
						<td>
						<?php 
						
						$create_date=$web_menu[$key]['create_date'];
						if($lang=='th'){echo RenDateTime($create_date);}else{echo  $create_date;} 
						?>
						</td>
						<td>
								<!-- <span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status[]" id="status<?=$menu_id?>" class="ace ace-switch ace-switch-5" <?php if($web_menu[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span> -->

								<label>
 <!--
 <input name="status[]" id="status<?//=$menu_id?>" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" <?php //if($web_menu[$key]['status'] == 1) echo 'checked';?>  value=1>
 --> 
  <?php 
  $disable=$language['disable'];
  $enable=$language['enable'];
  if($web_menu[$key]['status'] == 1){ echo "<font color='green'><b>$enable</b></font>";}else{ echo "<font color='red'><b>$disable</b></font>";}?> 
										<span class="lbl"></span>
								</label>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">																

																<a class="green" href="<?php echo site_url('admin_menu/edit/'.$menu_id); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$menu_id?>" data-value="<?=$web_menu[$key]['admin_menu_id']?>" data-name="<?=$web_menu[$key]['title']?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
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
																			<a href="<?php echo site_url('admin_menu/edit/'.$menu_id); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bx-confirm<?=$menu_id?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
		if($web_menu)		
				for($key=0;$key<$maxcat;$key++){
						
						$title = $web_menu[$key]['title'];
						$menu_id = $web_menu[$key]['admin_menu_id2'];
?>
		$('#status<?=$menu_id?>').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				//alert($(this).attr('id'));
				//alert($(this).val());
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('admin_menu/status/'.$menu_id)?>",
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

		$('#bootbox-confirm<?=$menu_id?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$menu_id)?>';
						}
					});
		});

		$('#bx-confirm<?=$menu_id?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$menu_id)?>';
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
<?php echo js_asset('checkall.js'); ?>
