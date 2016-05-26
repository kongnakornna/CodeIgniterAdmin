<?php 
		
		$language = $this->lang->language; 
		$i=0;
		$cat = $this->uri->segment(3);
		$maxcat = count($subcategory);
		$display_category = '';

		if($language['lang'] == 'en'){
				//$category = 
				if($category_name)
						for($i=0;$i<count($category_name);$i++){
								if($category_name[$i]['lang'] == 'en') 
										$display_category = $category_name[$i]['category_name'];
						}
		}else{
				if($category_name)
						for($i=0;$i<count($category_name);$i++){
								if($category_name[$i]['lang'] == 'th')
										$display_category = $category_name[$i]['category_name'];
						}
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

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('subcategory/add/'.$cat) ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_subcategory'] ?>
								</button>

								<div class="row">
									<div class="col-xs-12">

										<h3  class="header smaller lighter blue">
											<?php echo $language['subcategory'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $display_category?>
											</small>
										</h3>



				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($category_name, 'category_name');
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
	echo form_open('subcategory/cat/'.$this->uri->segment(3), $attributes);
?>
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
				//$maxcat = count($subcategory);
				if($subcategory)
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
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td> -->
						<td>
								<?=$subcategory[$key]['subcategory_id']?>
								<input type="hidden" class="ace" name="selectid[]" value="<?=$subcategory[$key]['subcategory_id_map']?>" />
						</td>
						<td><?=$subcategory[$key]['subcategory_name']?></td>
						<td>
								<input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?=$subcategory[$key]['order_by']?>">
						</td>
						<td><?=$subcategory[$key]['create_date']?></td>
						<td><span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status" id="status<?=$subcategory[$key]['subcategory_id_map']?>" class="ace ace-switch ace-switch-4" <?php if($subcategory[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<!-- <a class="blue" href="#">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->

																<a class="green" href="<?php echo site_url('subcategory/edit/'.$subcategory[$key]['subcategory_id_map'].'?category_id='.$this->uri->segment(3)); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$subcategory[$key]['subcategory_id_map']?>" data-value="<?=$subcategory[$key]['subcategory_id']?>" data-name="<?=$subcategory[$key]['subcategory_name']?>">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline position-relative">

																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<!-- <li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li> -->

																		<li>
																			<a href="<?php echo site_url('subcategory/add/'.$subcategory[$key]['subcategory_id_map'].'?category_id='.$this->uri->segment(3)); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bx-confirm<?=$subcategory[$key]['subcategory_id_map']?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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
<input type="hidden" class="ace" name="category_id" value="<?=$this->uri->segment(3)?>" />
<?php
	echo form_close();
?>
										</div>
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
<?php //Debug($subcategory); ?>
<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($subcategory)		
				for($key=0;$key<$maxcat;$key++){
	
?>
		$('#status<?=$subcategory[$key]['subcategory_id_map']?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('subcategory/status/'.$subcategory[$key]['subcategory_id_map'])?>",
					//data: {id: res},
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

		$('#bootbox-confirm<?=$subcategory[$key]["subcategory_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('subcategory/delete/'.$subcategory[$key]['subcategory_id_map'])?>';
						}
					});
		});

		$('#bx-confirm<?=$subcategory[$key]["subcategory_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('subcategory/delete/'.$subcategory[$key]['subcategory_id_map'])?>';
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