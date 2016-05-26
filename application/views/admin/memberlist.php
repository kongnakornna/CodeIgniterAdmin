<?php 
	$admin_typena=$this->session->userdata('admin_type');
	$admin_idnana=$this->session->userdata('admin_id');
	 //echo '$admin_typena='.$admin_typena; exit();
	 //echo '$admin_idnana='.$admin_idnana;exit();
	 
	$language = $this->lang->language; 
	$usedataTables = 1;
?>
<style type="text/css">
.user-photo {
    margin: -4px 8px 0px 0px;
    border-radius: 100%;
    border: 2px solid #FFF;
    max-width: 40px;
}	
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
<hr/>	
<div class="col-xs-12">
<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('admin/memberadd') ?>';">
	 <i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add_member'] ?>
</button> 							
</div>
<hr/>	
<?php 
	$attributes = array('class' => 'form-horizontal', 'name' => 'adminform',  'id' => 'adminform');
	echo form_open_multipart('admin/memberlist', $attributes);
	//admin_type_id
?>						
							<!-- PAGE CONTENT BEGINS -->
							<div class="col-xs-12">
                                   
									 <br>
									<div class="table-header">
                                                  
										<?php echo $language['member_list'] ?>
										<?php echo $language['total'] ?>
										<?php echo ' '.count($memberlist).' '; ?>
										<?php echo $language['record'] ?>
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['member_list'] ?></h3>
										<div class="table-header">
											<?php echo $language['member_list'] ?>
										</div> -->
                                              </div>
									
									</div>
                                            
							</div>
<right>                        
 <div class="col-xs-3 right"><?php echo $admin_type_list ?></div>	
 		
</right>  
<?php echo form_close();?>

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($all_member);
					//Debug($memberlist);
					//Debug($getAdminType);
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
		<div class="col-xs-12">
				<form method="post" action="" id="listFrm">
				
<?php ###############?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="clip-cog-2"></i><?php echo $language['member_list'] ?>
									<div class="panel-tools">
										<a class="btn btn-xs btn-link panel-collapse collapses" href="#">
										</a>
								
									</div>
								</div>
<hr />
<?php ###############?>
<div class="table-responsive">
				<table width="100%"  class="table table-striped table-bordered table-hover" id="sample-table-2">
				
									<thead>
										<tr>
											<th><i class="ace-icon fa fa-mobile-phone bigger-110 hidden-480"></i> <?php echo $language['mobile'] ?></th>
											<th><?php echo $language['no'] ?></th>
                                            <th class="center">Picture</th>
											<th class="center"><i class="ace-icon fa fa-user bigger-110 hidden-480"></i><?php echo $language['fullname'] ?></th>
											<th class="center"><i class="ace-icon fa fa-envelope bigger-110 hidden-480"></i><?php echo $language['email'] ?></th>
											<th class="center hidden-480"><?php echo $language['admin_level'] ?></th>
											<th class="hidden-480"><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i><?php echo $language['department'] ?></th>
											<th class="center hidden-480"><?php echo $language['status'] ?></th>
											<th class="center"><?php echo $language['action'] ?></th>
										</tr>
									</thead>

				<tbody>
<?php
				//Debug($memberlist);
				$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
				$i=0;
				if($memberlist)
				foreach($memberlist as $key => $arr_field){

							for($j=0;$j<count($getAdminType);$j++){

									$member_type = (isset($memberlist[$key]->_admin_type_id)) ? $memberlist[$key]->_admin_type_id : $memberlist->_admin_type_id;
									if($member_type == $getAdminType[$j]->admin_type_id){
										$admin_type = $getAdminType[$j]->admin_type_title;
										if($memberlist[$key]->_admin_type_id == 1 || $memberlist[$key]->_admin_type_id == 2)// Develop & admin
												$admin_type = '<span class="label label-success arrowed-in arrowed-in-right">'.$admin_type.'</span>';
										else if($memberlist[$key]->_admin_type_id == 3 || $memberlist[$key]->_admin_type_id == 4) //Manager & Assistant Manager
												$admin_type = '<span class="label label-info arrowed-in arrowed-in-right">'.$admin_type.'</span>';
										else if($memberlist[$key]->_admin_type_id == 5 || $memberlist[$key]->_admin_type_id == 6) //Content 
												$admin_type = '<span class="label label-danger arrowed-in arrowed-in-right">'.$admin_type.'</span>';
										else
												$admin_type = '<span class="label label-warning arrowed-in arrowed-in-right">'.$admin_type.'</span>';
									}											
							}

						 

							//.ace-nav .nav-user-photo
							$fullname=$memberlist[$key]->_admin_name;
							if($memberlist[$key]->_admin_avatar != ''){
								$avatar = $memberlist[$key]->_admin_avatar;
								if(file_exists('./uploads/admin/'.$avatar)){
									$avatar = base_url('uploads/admin/'.$avatar);
									$img_user = '<img class="user-photo" src="'.$avatar.'" height="40" alt="'.$fullname.'\'s Photo">';
									}else{ 	$imguserna=base_url().'theme/system/systmon.png'; 
											$img_user = '<img class="user-photo" src="'.$imguserna.'" height="40" alt="'.$fullname.'\'s Photo">';
											} 
							}else{$imguserna=base_url().'theme/system/systmon.png';  //$img_user = '';
									$img_user = '<img class="user-photo" src="'.$imguserna.'" height="40" alt="'.$fullname.'\'s Photo">';
									}
							//////////////////////////////////////
							$user_id=$memberlist[$key]->_admin_id;
							$fobidden=$this->lang->line('fobidden');
?>
			<tr>
						<td class="left">
						<span class="label label-info">  <i class="ace-icon fa fa-mobile bigger-110 hidden-480"></i> 
						<?php echo $memberlist[$key]->_mobile;?></span></td>
						<td class="center"><?php $i2=$i+1; echo $i2; ?> </td>
						<td class="center"><a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>"><?=$img_user?></a></td>
						<td><?php if($user_id==2){  echo "<b><font color='Red'> System </font></b>";}else{?>
						 <i class="ace-icon fa fa-user  bigger-110 hidden-480"></i>
						<a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>">
						<?=$memberlist[$key]->_admin_name?> <?=$memberlist[$key]->_admin_lastname?>
						</a> 
						<?php }?>
						</td>
						<td><i class="ace-icon fa fa-envelope-o bigger-110 hidden-480"></i><?php if($user_id==2){  echo "<b><font color='Red'> System </font></b>";}else{?>
						<?=$memberlist[$key]->_admin_email?> <?php }?> </td>
						<td class="center hidden-480"><?php if($user_id==2){  echo "<b><font color='Red'> System </font></b>";}else{?><?=$admin_type?><?php }?></td>
						
						
						<td class="hidden-480">
						<?php if($user_id==2){  echo "<b><font color='Red'> System </font></b>";}else{?>
						<span class="label label-success">  
						<?php $department=$memberlist[$key]->_department; 
						if($department<>''){echo $department;}else if($department==''){echo '--------------';}
						?></span>
						<?php }?>
						</td>
						
						
						<td class="hidden-480">
								 
								<label>
<?php if(($admin_typena==1 && $user_id>2) || ($admin_typena==2 && $user_id>3)){ ?>	
<?php if($admin_idnana<>$user_id){?>				 
<input name="status[]" id="status<?=$memberlist[$key]->_admin_id?>" class="ace ace-switch ace-switch-5 btn-empty" type="checkbox" <?php if($memberlist[$key]->_status == 1) echo 'checked';?>  value=1>  
<?php }else{  echo "<b><font color='Red'> $fobidden </font></b>"; }?>                            
<?php }else{  echo "<b><font color='Red'> $fobidden </font></b>"; }?>										
										<span class="lbl"></span>
								</label>
						</td>
						<td> 
						
						
						
						<?php if(($admin_typena==1 && $memberlist[$key]->_admin_id >2) || ($admin_typena==2 && $user_id>3)){ ?>
												<div>
													<div class="btn-group">
														<a class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
															<i class="fa fa-cog"></i> <span class="caret"></span>
														</a>
														
														
													<ul role="menu" class="dropdown-menu pull-right">
													       <?php if($admin_typena==1 || $admin_typena==2 &&($user_id >2)){ ?>
															<li role="presentation">
																<a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>">
																	<i class="fa fa-edit"></i> <?php $edit=$language['edit']; echo "<b><font color='blue'> $edit </font></b>";?>
																</a>
															</li>
															<?php }if($admin_typena==1 || $admin_typena==2 &&($user_id >2)){ ?>
															<li role="presentation">
															<?php if($admin_idnana<>$user_id){?>
											 <a role="menuitem" tabindex="-1" href="#"id="bx-confirm<?=$memberlist[$key]->_admin_id?>" class="tooltip-error" data-rel="tooltip" title="Delete">
														<i class="fa fa-times"></i><?php $delete=$language['delete'];echo "<b><font color='red'> $delete </font></b>";?>
																</a><?php }?>
															</li>
													<?php }?>
														</ul>
													</div>
												</div>	
												<?php }else if($member_type<>1&& $user_id >2){ ?>
												
													 <a role="menuitem" tabindex="-1" href="<?php echo site_url('admin/memberedit/'.$memberlist[$key]->_admin_id); ?>">
													 <i class="fa fa-edit"></i> <?php $edit=$language['edit']; echo "<b><font color='blue'> $edit </font></b>";?></a>
												
													 <?php }else{  echo "<b><font color='Red'> $fobidden </font></b>";}?>	
													 		
					</td>
			</tr>
<?
							$i++;
						//}
				}
?>
					</tbody>
				</table>
			</form>
			</div>
							 
					 <!-- PAGE CONTENT ENDS -->
			 <!-- /.col -->
	 <!-- /.row -->
<script type="text/javascript">
$( document ).ready(function() {
<?php
if($memberlist)
         foreach($memberlist as $key => $arr_field){
              $admin_id = $memberlist[$key]->_admin_id;
              $admin_name = $memberlist[$key]->_admin_name;
?>
$('#status<?=$admin_id?>').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				 //alert('Save Complate');
				 //alert('<?php echo $language['savecomplate'] ?>');
				 //alert($(this).attr('id'));			
				 //alert($(this).val());

				$.ajax({
					type: 'POST',
					url:  '<?php echo base_url('admin/status2/'.$admin_id)?>',
					cache: false,
					success: function(data){
							if(data == 0){
                                ////////
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
							}
					}
				});
		});
			 
		
		$('#bx-confirm<?=$admin_id?>').on('click', function() {
					bootbox.confirm("<?php echo $language['are you sure to delete']?> <?php echo $admin_name;?>", function(result) {
						if(result) {
								window.location='<?php echo base_url('admin/deleteadmin/'.$admin_id)?>';
						}
					});
		});

	

<?php
				}	
?>
 
			$('#admin_type_id').on('change', function() {
					//var admin_type = $(this).val();
					//alert(admin_type);
					document.getElementById("adminform").submit();
			});

/*
				$('#gritter-regular').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a regular notice!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="blue">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar1.png',
						sticky: false,
						time: '',
						class_name: (!$('#gritter-light').get(0).checked ? 'gritter-light' : '')
					});
			
					return false;
				});
			
				$('#gritter-sticky').on(ace.click_event, function(){
					var unique_id = $.gritter.add({
						title: 'This is a sticky notice!',
						text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="red">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar.png',
						sticky: true,
						time: '',
						class_name: 'gritter-info' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-without-image').on(ace.click_event, function(){
					$.gritter.add({
						// (string | mandatory) the heading of the notification
						title: 'This is a notice without an image!',
						// (string | mandatory) the text inside the notification
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="orange">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						class_name: 'gritter-success' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-max3').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a notice with a max of 3 on screen at one time!',
						text: 'This will fade out after a certain amount of time. Vivamus eget tincidunt velit. Cum sociis natoque penatibus et <a href="#" class="green">magnis dis parturient</a> montes, nascetur ridiculus mus.',
						image: $path_assets+'/avatars/avatar3.png',
						sticky: false,
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						class_name: 'gritter-warning' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
			
			
				$('#gritter-center').on(ace.click_event, function(){
					$.gritter.add({
						title: 'This is a centered notification',
						text: 'Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-info gritter-center' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
				
				$('#gritter-error').on(ace.click_event, function(){
					$.gritter.add({

						title: 'This is a warning notification',
						text: 'Just add a "gritter-light" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error' + (!$('#gritter-light').get(0).checked ? ' gritter-light' : '')
					});
			
					return false;
				});
					
			
				$("#gritter-remove").on(ace.click_event, function(){
					$.gritter.removeAll();
					return false;
				});
*/
			
		//$('#dataTables-member').dataTable(); 
<?php if($usedataTables == 1){ ?> 
		//$('#dataTables-article').dataTable();
		$('#dataTables-member').dataTable( {
			//"order": [[ 4, "desc" ]],
			stateSave: true
		} );
<?php } ?>
});

</script>



<?php echo js_asset('checkall.js'); ?>