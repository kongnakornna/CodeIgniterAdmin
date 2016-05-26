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
											<i class="ace-icon fa fa-times"></i>
											</strong><?php echo $success?>.
									<br>
							</div>
				</div>
<?php
			}
?>
				<div class="row">
						<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('team/add') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'] ?>
								</button>
								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['admin_team'] ?></h3>
										<div class="table-header">
											<?php echo $language['admin_team'] ?>
										</div>

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
														<th class="hidden-480">
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
						<td class="hidden-480"><?=$admin_team[$key]['create_date']?></td>
						<td><a href="<?php echo site_url('team/access/'.$admin_team[$key]['admin_team_id']); ?>">
						<i class="ace-icon glyphicon glyphicon-list"> <?=$language['access']?></i></a></td>
						<td class="hidden-480">
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
