<?php 
$admin_type=$this->session->userdata('admin_type');
$language = $this->lang->language; 
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
										<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
								</button> -->

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><?php echo $language['admin_type'] ?></h3>
										<div class="table-header">
											<?php echo $language['admin_type'] ?>
										</div>

<?php
				if(function_exists('Debug')){
					//Debug($admintype);
				}
				/*$result_object = $all_member->result_object;
				if($result_object)
					foreach($result_object as $key ){
									echo $key.'<br>';
					}*/

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

		if(isset($success)){
?>
										<div class="alert alert-block alert-success">
											<button data-dismiss="alert" class="close" type="button">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<p>
												<strong>
													<i class="ace-icon fa fa-check"></i>
													Update Member!
												</strong>
												You successfully read this important alert message.
											</p>
										</div>
<?php
		}
?>
				<div>
											<table id="sample-table-2" class="table table-striped table-bordered table-hover" width="100%">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="4%" class="hidden-480">ID</th>
														<th width="6%"><?php echo $language['no'] ?></th>
														<th width="19%"><?php echo $language['admin_type_title'] ?></th>
														<!--<th class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php #echo $language['create_date'] ?>
														</th>
														-->
														<!-- <th class="hidden-480">															
															<?php echo $language['lastupdate'] ?>
														</th> -->
														<th width="43%" class="hidden-480"><?php echo $language['status'] ?></th>
														<th width="18%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>



	<tbody>
<?php
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));

				$i=1;
				if($admintype)
				foreach($admintype as $key => $arr_field){
						//if(trim($memberlist[$key]->_domain) != ""){

							//$displayexpire = ($displaydate < 0) ? '<span style="color:red">'.$expire_date.'</span>' : $expire_date;

							$admin_type_id = $admintype[$key]->admin_type_id;
							$admin_type_title = $admintype[$key]->admin_type_title;
							$create_date = $admintype[$key]->create_date;
							$create_by = $admintype[$key]->create_by;
							$lastupdate_date = $admintype[$key]->lastupdate_date;
							$lastupdate_by = $admintype[$key]->lastupdate_by;
							$status = $admintype[$key]->status;
?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" />
										<span class="lbl"></span>
								</label>
						</td> -->
						<td class="hidden-480"><?=$admin_type_id?><input type="hidden" name="admin_type_id" value="<?=$admin_type_id?>"></td>
						<td><span class="badge badge-info"><?=$i?></span></td>
						<td><span class="label label-success">  <?=$admin_type_title?></span></td>
<!--
<td class="hidden-480"> 
<?php
/* 
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
*/
?> 
</td>
-->
						<!-- <td class="hidden-480"><? //$lastupdate_date?></td> -->
<td class="hidden-480">
<span class="col-sm-6">
<label class="pull-right inline" id="enable<?=$admin_type_id?>"><small class="muted"></small>					
<?php if($admin_type==1){?>															
<input type="checkbox" name="status" id="status<?=$admin_type_id?>" class="ace ace-switch ace-switch-5" <?php if($status  == 1) echo 'checked';?>  value=1>
<?php }else{?>		
<?php if($status== 1){ $enable=$language['enable']; echo "<b><font color='blue'> $enable </font></b>"; }else{ $disable=$language['disable']; echo "<b><font color='red'> $disable </font></b>";}?>
<?php }?>										
									
									
									
									
								<span class="lbl middle"></span>
				  </label>
				  </span>
				</td>
						<td width="10%"> 
						
<div class="btn-group">
	 <a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#"> <i class="fa fa-cog"></i> <span class="caret"></span> </a>
		<ul role="menu" class="dropdown-menu pull-right">
				 <li role="presentation">
					 <a role="menuitem" tabindex="-1" href="<?php echo site_url('accessmenu/edit/'.$admin_type_id); ?>">
							 <i class="fa fa-edit"></i> <?php $edit=$language['edit']; echo "<b><font color='blue'> $edit </font></b>";?>
					 </a>
				 </li>
		 </ul>
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
									</div>
								</div>
						<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {
<?php

	if($admintype)
	foreach($admintype as $key => $arr_field){
		$admin_type_id = $admintype[$key]->admin_type_id;
?>
		$('#status<?=$admin_type_id?>').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);

				//$("#msg_info").html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Please, wait...');
				//$("#msg_info,#BG_overlay").fadeIn();

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('accessmenu/status/'.$admin_type_id)?>",
					//data: {id: res},
					cache: false,
					success: function(data){
							//$("#msg_info").fadeOut();
											swal({
													title: "Forbiden!",
													text: "Can not Inactive",
													timer: 2000,
													showConfirmButton: false
												});
						/*
							$("#msg_error").attr('style','display:block;');
							AlertError('Can not Inactive');
						*/
/*
									if(data == 0){
											swal({
													title: "<?php //echo $language['inactive'] ?>!",
													text: "<?php //echo $language['savecomplate'] ?>",
													timer: 2000,
													showConfirmButton: false
												});
												//////
											}else{
												////////
												swal({
													title: "<?php //echo $language['active'] ?>!",
													text: "<?php //echo $language['savecomplate'] ?>", 
													timer: 2000,
													showConfirmButton: false
												});
*/											//////
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
<?php

	}
?>
});
</script>
