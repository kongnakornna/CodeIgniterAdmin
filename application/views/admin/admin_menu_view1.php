<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($web_menu);
		$parentmenu =  $this->uri->segment(3);
		if($main_menu)
			for($i=0;$i<count($main_menu);$i++){
					if($main_menu[$i]['lang'] == $language['lang']) $main_title = $main_menu[$i]['title'];
			}
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

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin_menu/add/'.$parentmenu) ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
											<a href="<?php echo base_url($this->uri->segment(1)) ?>"><h3 class="header smaller lighter blue"><?php echo $language['admin_menu'] ?></a>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php if(isset($main_title))  echo $main_title ?>
											</small>										
										</h3>
										<div class="table-header">
											<?php echo $language['admin_menu'] ?> 
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($this->session->userdata);
					//Debug($main_menu);
				}
?>
<?php
			if(isset($error)){
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
			}
?>
				<div>
<?php
	//Debug($web_menu);
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('admin_menu', $attributes);
?>
<input type="hidden" name="parent" value="<?php if(isset($web_menu[0]['parent'])) echo $web_menu[0]['parent'] ?>">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th>ID</th>
														<th><?php echo $language['name'] ?></th>
														<th class="hidden-480">
															<?php echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>
															&nbsp;<i class="ace-icon fa fa-floppy-o bigger-120 blue" id="saveorder"></i>
														</th>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>
														</th>
														<th class="hidden-480"><?php echo $language['status'] ?></th>

														<th><?php echo $language['action'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=0;
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
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td> -->
						<td>
							<?=$web_menu[$key]['admin_menu_id']?>
							<input type="hidden" class="ace" name="selectid[]" value="<?=$menu_id?>" />
						</td>
						<td><a href="<?php echo site_url('admin_menu/view/'.$menu_id); ?>"><?=$web_menu[$key]['title']?></a></td>
						<!-- <td><?=$web_menu[$key]['order_by']?></td> -->
						<td><input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?=$web_menu[$key]['order_by']?>"></td>
						<td><?=$web_menu[$key]['create_date']?></td>
						<td><span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status" id="status<?=$menu_id?>" class="ace ace-switch ace-switch-5" <?php if($web_menu[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">																

																<a class="green" href="<?php echo site_url('admin_menu/edit/'.$menu_id); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
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
							$id = $web_menu[$key]['admin_menu_id2'];	
?>
		$('#status<?=$id?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('admin_menu/status/'.$id)?>",
					//data: {id: res},
					cache: false,
					success: function(data){
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
									AlertError('Inactive');
									}else{
									$("#msg_success").attr('style','display:block;');
									AlertSuccess	('Active');
									*/
							}
					}
				});
				
		});

		$('#bootbox-confirm<?=$id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$id)?>';
						}
				});
		});

		$('#bx-confirm<?=$id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin_menu/delete/'.$id)?>';
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