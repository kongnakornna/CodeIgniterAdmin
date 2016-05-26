<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($web_menu);
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
<br/>
								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin_menu/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['admin_menu'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['admin_menu'] ?></h3>
										<div class="table-header">
											<?php echo $language['admin_menu'] ?>
										</div>
<?php
			if(function_exists('Debug')){
				//Debug($this->db) ;
				//Debug($this->session->userdata);
				//Debug($this->lang->language);
			}
			//Debug($this->session->userdata('admin_id')) ;

			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $error?>.
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
											<i class="ace-icon glyphicon glyphicon-ok"></i>
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
														<th><?php echo $language['no'] ?></th>
														<?php if($this->session->userdata('admin_id') == 1){ ?>
														<th>ID2</th>
														<?php } ?>
														<th><?php echo $language['name'] ?></th>
														<th><?php echo $language['submenu'] ?></th>
														<th class="hidden-480">
															<?php echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>
															&nbsp;<i class="ace-icon fa fa-floppy-o bigger-120 blue" id="saveorder"></i>
														</th>
														<th class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>
														</th>
														<th><?php echo $language['status'] ?></th>
														<th><?php echo $language['action'] ?></th>
													</tr>
												</thead>
				<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=1;
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
						<td><?=$web_menu[$key]['admin_menu_id']?><input type="hidden" class="ace" name="selectid[]" value="<?=$menu_id?>" /></td>
						<td><?=$i?></td>
						<?php if($this->session->userdata('admin_id') == 1){ ?>
						<td><?=$menu_id?></td>
						<?php } ?>
						<td><a href="<?php echo site_url('admin_menu/view/'.$menu_id); ?>"><?=$web_menu[$key]['title']?></a></td>
						<td><?=$web_menu[$key]['count_sub']?></td>
						<td class="hidden-480">
								<input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?=$web_menu[$key]['order_by']?>">
								<!-- &nbsp;<i class="fa fa-arrow-up"></i>&nbsp;
								<i class="fa fa-arrow-down"></i> -->
						</td>
						<td class="hidden-480"><?=$web_menu[$key]['create_date']?></td>
						<td>
								<!-- <span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status[]" id="status<?=$menu_id?>" class="ace ace-switch ace-switch-5" <?php if($web_menu[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span> -->

								<label>
										<input name="status[]" id="status<?=$menu_id?>" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" <?php if($web_menu[$key]['status'] == 1) echo 'checked';?>  value=1>
										<span class="lbl"></span>
								</label>
						</td>
						<td> 
						
															 
															<!-- hidden-lg -->
														<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														<ul role="menu" class="dropdown-menu pull-right">
															<li role="presentation">
																<a href="<?php echo site_url('admin_menu/edit/'.$menu_id); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span><?php $edit=$language['edit']; echo "<b><font color='blue'> $edit </font></b>";?>
																			</a>
															</li>
														 
															<li role="presentation">
															<a href="#" id="bx-confirm<?=$menu_id?>" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span><?php $delete=$language['delete'];echo "<b><font color='red'> $delete </font></b>";?>
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
							////////
							if(data == 0){
									swal({
											title: "<?php echo $language['inactive'] ?>!",
											text: "<?php echo $language['savecomplate'] ?>",
											timer: 2000,
											showConfirmButton: false
										});
										//////
									}else{
										////////
										swal({
											title: "<?php echo $language['active'] ?>!",
											text: "<?php echo $language['savecomplate'] ?>", 
											timer: 2000,
											showConfirmButton: false
										});
									//////
									/*
										$("#msg_error").attr('style','display:block;');
										AlertError('<?php //echo $language['inactive'] ?>');
									}else{
										$("#msg_success").attr('style','display:block;');
										AlertSuccess	('<?php //echo $language['active'] ?>');
									*/
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
