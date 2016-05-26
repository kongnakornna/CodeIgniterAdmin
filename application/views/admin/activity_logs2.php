<?php 
	$language = $this->lang->language; 
	//Debug($logs_list);
	//Debug($this->db->last_query());
	//die();
?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
								</button> -->

								<div class="row">
									<div class="col-xs-12">
					        <h1><?php 
							$modules=$language['modules'];
							echo " <span style=\"color: #030;\">$modules</span> "; 
							 ?> 
                            
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) --> <?php echo $language['activity_logs'] ?> 
								</small>
							</h1>

<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($all_member);
					//Debug($memberlist);
				}
				/*echo "<pre>";
				var_dump($this);
				echo "</pre>";*/

				/*$result_object = $all_member->result_object;
				if($result_object)
					foreach($result_object as $key ){
									echo $key.'<br>';
					}*/
			
			if(isset($error)){
?>
				<div class="col-xs-12">
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" type="button">
											<i class="ace-icon fa fa-times"></i>
									</button>
									<strong>
											<i class="ace-icon fa fa-times"></i>
											Error!</strong><?php echo $error?>.
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

				<form method="post" action="" id="listFrm">
											<table width="100%" class="table-responsive table table-striped table-bordered table-hover " id="dataTables-logs">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="6%"><?php echo $language['no'] ?></th>
														<th width="14%"><?php echo $language['type'] ?></th>
														<th width="38%"><?php echo $language['title'] ?></th>
														<th width="17%" class="hidden-480"><?php echo $language['username'] ?></th>
														<th width="18%" class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['logs'] ?>
														</th>
														<!-- <th class="hidden-480"><?php echo $language['status'] ?></th> -->
														<th width="7%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>

	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=0;
				if($logs_list)
				foreach($logs_list as $key => $arr_field){

					$admin_log_id = $logs_list[$key]->admin_log_id;
					$admin_id = $logs_list[$key]->admin_id;
					$ref_id = $logs_list[$key]->ref_id;
					$ref_type = $logs_list[$key]->ref_type;
					$title = $logs_list[$key]->ref_title;
					$action = $logs_list[$key]->action;
					$create_date = $logs_list[$key]->create_date;
					$status = $logs_list[$key]->status;
					$admin_username = $logs_list[$key]->admin_username;

					switch($ref_type){
							case 1 : $type = 'Level.1'; break;
							case 2 : $type = 'Level.2'; break;
							case 3 : $type = 'Level.3'; break;
							case 4 : $type = 'Level.4'; break;
							case 5 : $type = 'Level.5'; break;
							case 6 : $type = 'Level.6'; break;
							//case 7 : $type = '-'; break;
							default : $type = 'General'; break;
					
					}
?>
		<tr> 
						<td><?=$admin_log_id ?></td>
						<td><?=$type ?></td>
						<td><?=$title?></td>
						<td class="hidden-480"><?=$admin_username?></td>
						<td class="hidden-480"> 
						
<?php 
		$create_date=$create_date;
        $strDate = $create_date;
		$strMonth1= date("n",strtotime($strDate));
		$strMonthCut1 = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai1=$strMonthCut1[$strMonth1];
	    $strYear2 = date("Y",strtotime($strDate))+543;
		$strHour3= date("H",strtotime($strDate));
		$strMinute3= date("i",strtotime($strDate));
		$strSeconds3= date("s",strtotime($strDate));
        $timena=$strHour3.':'.$strMinute3.':'.$strSeconds3;
		$strYear4 = date("Y",strtotime($strDate))+543;
		$strMonth4= date("n",strtotime($strDate));
		$strDay4= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai3=$strMonthCut[$strMonth4];
		$datena=$strDay4.' '.$strMonthThai3.' พ.ศ.'.$strYear4.' '.$strHour3.':'.$strMinute3.':'.$strSeconds3;
	####################
$lang=$this->lang->line('lang');
if($lang=='th'){
echo $datena;
}else if($lang=='en'){
echo $create_date;
}
?>
						
						</td>
						<!-- <td class="hidden-480">
								<label>
										<input name="status[]" id="status<?=$logs_list[$key]->admin_id?>" class="ace ace-switch ace-switch-4 btn-empty" type="checkbox" <?php if($logs_list[$key]->status == 1) echo 'checked';?>  value=1>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td> 
						
								<div class="hidden-sm hidden-xs action-buttons">
<?php 
$admin_type = $this->session->userdata('admin_type');
if($admin_type=='1' || $admin_type=='2' ){?>
										<a class="red del-confirm" href="javascript:void(0);" id="bootbox-confirm<?=$admin_log_id?>" data-value="<?=$admin_log_id?>" data-name="<?=$title?>">
												<i class="ace-icon fa fa-trash-o bigger-130"></i>
										</a>
<?php }else{ echo $language['fobidden'];}?>
								</div>

								<div class="hidden-md hidden-lg">
											<div class="inline position-relative">
													<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
														<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
													</button>

													<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
													
															<li>
															<?php  if($admin_type=='1'){?>
																<a href="javascript:void(0);" id="bootbox-confirm2<?php echo $admin_log_id?>" class="tooltip-error" data-rel="tooltip" data-value="<?=$admin_log_id?>" data-name="<?=$title?>" title="Delete">
																		<span class="red">
																			<i class="ace-icon fa fa-trash-o bigger-120"></i>
																		</span>
																</a>
																<?php }else{ echo $language['fobidden'];}?>
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
			
			$('#dataTables-logs').dataTable(); 
			/*$('.del-confirm').on('click', function() {
					alert('You can not delete.');
			});*/

<?php
	if($logs_list)
		foreach($logs_list as $key => $arr_field){
					$admin_log_id = $logs_list[$key]->admin_log_id;
					$admin_id = $logs_list[$key]->admin_id;
					$title = $logs_list[$key]->ref_title;

?>
		$('#bootbox-confirm<?php echo $admin_log_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							AlertError('You can not delete.');
							//alert('You can not delete.');

							//window.location='<?php echo base_url('logs/delete/'.$admin_log_id)?>?cat=<?php //echo $category_id ?>' ;
						}
				});
		});

		$('#bootbox-confirm2<?php echo $admin_log_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							AlertError('You can not delete.');
							//window.location='<?php echo base_url('logs/delete/'.$admin_log_id)?>?cat=<?php //echo $category_id ?>' ;
					}
				});
		});

<?php
		}
?>
});
</script>
<?php //echo js_asset('checkall.js'); ?>