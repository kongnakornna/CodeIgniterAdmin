<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($category);
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

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('categorymember/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_category'].$language['member'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['category'] ?></h3>
										<div class="table-header">
											<?php echo $language['category'].$language['member'] ?>
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($category );
					//Debug($this->lang->language);
				}
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
	echo form_open('category', $attributes);
?>				
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>ID</th>
														<th><?php echo $language['name'] ?></th>
														<th class="hidden-480"><?php echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>
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
				if($category)
				for($key=0;$key<$maxcat;$key++){
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
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $category[$key]['category_id'] ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td><?=$category[$key]['category_id']?><input type="hidden" class="ace" name="selectid[]" value="<?=$category[$key]['category_id']?>" /></td>
						<td><a href="<?php echo site_url('subcategorymember/cat/'.$category[$key]['category_id_map']); ?>"><?=$category[$key]['category_name']?></a></td>
						<td>								
								<input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?=$category[$key]['order_by']?>">
						</td>
						<td><?=$category[$key]['create_date']?></td>
						<td>
								<!-- <span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status" id="status<?=$category[$key]['category_id']?>" class="ace ace-switch ace-switch-5" <?php if($category[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span> -->
								<label>
										<input name="status[]" id="status<?=$category[$key]['category_id']?>" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" <?php if($category[$key]['status'] == 1) echo 'checked';?>  value=1>
										<span class="lbl"></span>
								</label>
						</td>
						<td> 

									<div class="hidden-sm hidden-xs action-buttons">

																<!-- <a class="blue" href="<?php echo site_url('subcategorymember/cat/'.$category[$key]['category_id_map']); ?>">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->

																<a class="green" href="<?php echo site_url('categorymember/add/'.$category[$key]['category_id_map']); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$category[$key]['category_id_map']?>" data-value="<?=$category[$key]['category_id']?>" data-name="<?=$category[$key]['category_name']?>">
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
																		<!-- <li>
																			<a href="<?php echo site_url('categorymember/cat/'.$category[$key]['category_id_map']); ?>" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li> -->

																		<li>
																			<a href="<?php echo site_url('categorymember/add/'.$category[$key]['category_id_map']); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bx-confirm<?=$category[$key]['category_id_map']?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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

		$('.ace-switch').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				$.ajax({
						type: 'POST',
						url: "<?php echo base_url('categorymember/status')?>",
						data: {id: res},
						cache: false,
						success: function(data){
								//alert(data)
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

<?php
		if($category)
				for($i=0;$i<$maxcat;$i++){
?>
		$('#bootbox-confirm<?=$category[$i]["category_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('categorymember/delete/'.$category[$i]['category_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$category[$i]["category_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('categorymember/delete/'.$category[$i]['category_id_map'])?>';
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