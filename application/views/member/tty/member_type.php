<?php 
		$language = $this->lang->language; 
		$i=0;
		$maxcat = count($dara_type);
?>
<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('dara_type/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['dara_type']  ?>
								</button>

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['dara_type'] ?></h3>
										<div class="table-header">
											<?php echo $language['dara_type'] ?>
										</div>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($dara_type);
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
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('subcategory/cat/'.$this->uri->segment(3), $attributes);
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
														<th><?php echo $language['name'] ?></th>
														<!-- <th class="hidden-480">
																<?php //echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>&nbsp;<i class="ace-icon fa fa-floppy-o bigger-120 blue" id="saveorder"></i>
														</th> -->
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

				$maxitem = count($dara_type);
				if($dara_type)
				for($key=0;$key<$maxitem;$key++){
					
					$dara_type_id_map = $dara_type[$key]['dara_type_id_map'];

?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $dara_type[$key]['dara_type_id'] ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td>
								<?=$dara_type[$key]['dara_type_id']?>
								<input type="hidden" class="ace" name="selectid[]" value="<?=$dara_type[$key]['dara_type_id_map']?>" />
						</td>
						<td><?=$dara_type[$key]['dara_type_name']?></td>
						<!-- <td><input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?php //echo $dara_type[$key]['order_by']?>"></td> -->
						<td><?=$dara_type[$key]['create_date']?></td>
						<td><span class="col-sm-6">
								<small class="muted"></small>
									<input type="checkbox" name="status" id="status<?=$dara_type[$key]['dara_type_id_map']?>" class="ace ace-switch ace-switch-4" <?php if($dara_type[$key]['status'] == 1) echo 'checked';?>  value=1 >
								<span class="lbl middle"></span>
								</label>
								</span>
						</td>
						<td> 
						
															<div class="hidden-sm hidden-xs action-buttons">
																<!-- <a class="blue" href="#<?php echo site_url('subcategory/cat/'.$dara_type[$key]['dara_type_id_map']); ?>">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a> -->

																<a class="green" href="<?php echo site_url('dara_type/add/'.$dara_type[$key]['dara_type_id_map']); ?>">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>

																<a class="red del-confirm" href="#" id="bootbox-confirm<?=$dara_type[$key]['dara_type_id_map']?>" data-value="<?=$dara_type[$key]['dara_type_id']?>" data-name="<?=$dara_type[$key]['dara_type_name']?>">
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
																			<a href="#<?php echo site_url('subcategory/cat/'.$dara_type[$key]['dara_type_id']); ?>" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li> -->

																		<li>
																			<a href="<?php echo site_url('dara_type/add/'.$dara_type[$key]['dara_type_id']); ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" id="bootbox-confirm<?=$dara_type[$key]['dara_type_id_map']?>" class="tooltip-error" data-rel="tooltip" title="Delete">
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

<?
							$i++;
				}
?>
	</tbody>
</table>
						</form>
										</div>
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php
		if($dara_type)		
				for($key=0;$key<$maxcat;$key++){
	
?>
		$('#status<?=$dara_type[$key]['dara_type_id_map']?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
		    
				//alert($(this).attr('id'));
				//alert($(this).val());
				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('dara_type/status/'.$dara_type[$key]['dara_type_id_map'])?>",
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

		$('#bootbox-confirm<?=$dara_type[$key]["dara_type_id_map"]?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo base_url('dara_type/delete/'.$dara_type[$key]['dara_type_id_map'])?>';
						}
					});
		});
<?php
				}	
?>
});

</script>

<?php //echo js_asset('checkall.js'); ?>