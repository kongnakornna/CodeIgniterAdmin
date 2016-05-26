<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($member_type);
		//Debug($search_form);
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('member/listview', $attributes);

		if(!isset($search_form['sortby'])) $search_form['sortby'] = 'lastupdate_date';
?>
<div class="col-xs-12">
		<div class="col-xs-2">
				<a href="<?php echo site_url('member/add') ?>"><button class="btn btn-sm btn-primary" type="button">
						<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['member']  ?>
				</button></a> 
				<br><?=$member_all?> record
		</div>
		<div class="col-xs-2">
			<select class="form-control" id="sortby" name="sortby">
					<option value="0">-</option>
					<option value="create_date" <?php echo ($search_form['sortby'] == "create_date") ? 'selected' : '' ?>><?php echo $language['create_date']?></option>
					<option value="lastupdate_date" <?php echo ($search_form['sortby'] == "lastupdate_date") ? 'selected' : '' ?>><?php echo $language['lastupdate']?></option>
					<option value="member_profile_id_map" <?php echo ($search_form['sortby'] == "id") ? 'selected' : '' ?>>ID</option>
					<option value="first_name" <?php echo ($search_form['sortby'] == "first_name") ? 'selected' : '' ?>><?php echo $language['name']?></option>
					<option value="nick_name" <?php echo ($search_form['sortby'] == "nick_name") ? 'selected' : '' ?>><?php echo $language['nickname']?></option>
			</select>		
		</div>
		<div class="col-xs-2">
			<select class="form-control" id="form-field-select-1" name="member_type">
					<option value="0">-</option>
<?php 
				$datamember_type = $this->input->post('member_type');
				$alltype = count($member_type);
				if($member_type)
						for($i = 0; $i < $alltype; $i++){
									$selected = ($datamember_type == $member_type[$i]['member_type_id_map']) ? 'selected' : '';
									echo '<option value="'.$member_type[$i]['member_type_id_map'].'" '.$selected.'>'.$member_type[$i]['member_type_name'].'</option>';
						}
?>
			</select>
		</div>
		<div class="col-xs-2">
			<select class="form-control" id="form-field-select-1" name="gender">
					<option <? //if(!isset($this->input->post()) echo 'selected'; ?>><?php echo $language['all']?></option>
					<option value="m" <?php echo ($this->input->post('gender') =='m') ? 'selected' : '' ?>><?php echo $language['male']?></option>
					<option value="f" <?php echo ($this->input->post('gender') =='f') ? 'selected' : '' ?>><?php echo $language['female']?></option>
			</select>
		</div>
		<div class="col-xs-2">

			<select class="form-control" name="member-status">
					<option><?php echo $language['all']?></option>
					<option value="1" <?php if($this->input->post('member-status') == 1) echo 'selected="selected"'?> ><?php echo $language['publish']?></option>
					<option value="3" <?php if($this->input->post('member-status') == 3) echo 'selected="selected"'?> ><?php echo $language['unpublish']?></option>
			</select>	
		</div>
		<div class="col-xs-1">
			<button class="btn btn-sm btn-primary" type="submit">
					<i class="ace-icon fa fa-glass align-top bigger-125"></i>Filter
			</button>
		</div>
		<div class="col-xs-1">
			&nbsp;<a href="#<?php echo base_url('member/listview'); ?>"><i class="ace-icon glyphicon glyphicon-list icon-only bigger-150" title="List View"></i></a>
			&nbsp;<a href="<?php echo base_url('member/gridview'); ?>"><i class="ace-icon glyphicon glyphicon-th icon-only bigger-150" title="Grid View"></i></a>
		</div>
</div>
<?php
			//Debug($this->input->post());
			//if(function_exists('Debug')) Debug($news);
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
<div class="col-xs-12">
		<div>
<?php
			//Debug($member_list);
?>
											<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-member">
												<thead>
													<tr>
														<th width="69"><?php echo $language['no'] ?>.</th>
														<!-- <th width="129"><?php echo $language['image'] ?></th> -->
														<th width="189"><?php echo $language['full_name'] ?></th>
														<th width="128"><?php echo $language['idcard'] ?></th>
														<th width="174"><?php echo $language['member_type'] ?></th>
														<th width="183" class="hidden-480"> <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i> <?php echo $language['register'] ?> </th>
														<th width="183" class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['dateactive'] ?>														</th>
														<th class="hidden-480" width="94"><?php echo $language['status'] ?></th>
														<th width="111"><?php echo $language['action'] ?></th>
													</tr>
												</thead>
	<tbody>												
<?php
			$allmember = count($member_list);
			if($member_list)
					for($i=0;$i<$allmember;$i++){
								
								$number = $i+1;

								if(isset($member_list[$i]['avatar'])){

									if($member_list[$i]['avatar'] != ''){
											$picture = (!file_exists('uploads/thumb/member/'.$member_list[$i]['avatar'])) ? 'uploads/member/'.$member_list[$i]['avatar'] : 'uploads/thumb/member/'.$member_list[$i]['avatar'];
											//$fulimg = 'uploads/member/'.$member_list[$i]['avatar'];
											$picture = img_src($picture);
									}else
											$picture = 'theme/assets/avatars/avatar3.png';
								}else{
									$picture = 'theme/assets/avatars/avatar3.png';
									//$fulimg = 'theme/assets/avatars/avatar3.png';
								}

								$member_profile_id = $member_list[$i]['member_profile_id'];
								//$full_name = $member_list[$i]['first_name'];
								$full_name = $member_list[$i]['first_name'].' '.$member_list[$i]['last_name'];
								$nickname = $member_list[$i]['nick_name'];
								$member_type_id = $member_list[$i]['member_type_id'];
								$member_type_name = $member_list[$i]['member_type_name'];
                                $idcard= $member_list[$i]['idcard'];
								$create_date= $member_list[$i]['create_date'];
								$belong_to = $member_list[$i]['belong_to'];
								$member_status = $member_list[$i]['status'];
								//$member_status = ($member_list[$i]['status'] == 1) ? $language['status'] : $lang['unpublish'];
								$lastupdate_date = $member_list[$i]['lastupdate_date'];

								$url_preview = $this->config->config['www'].'/member/'.$member_type_id.'/'.$member_profile_id.'/'.RewriteTitle($member_type_name).'/'.RewriteTitle($full_name);

								if($member_status == 2){
										$lnk_member = "javascript:alert('this is deleted.');";
								}else
										$lnk_member = base_url('member/edit/'.$member_profile_id);

?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" name="selectid[]" value="<?php //echo $tag_id ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->
						<td>
								<?=$number?>
								<input type="hidden" class="ace" name="selectid[]" value="<?=$member_profile_id?>" />						</td>
						<!-- <td><?php if($picture != '') echo $picture ?></td> -->
						<td><a href="<?=$lnk_member?>"><?=$full_name?></a></td>
						<td><a href="<?=$lnk_member?>"><?=$idcard?></a></td>
						<td><?=$member_type_name?></td>
						<td class="hidden-480"><?php echo $create_date?></td>
						<td class="hidden-480"><?php echo $lastupdate_date?></td>
						<td class="hidden-480"><span class="col-sm-12">
								<label class="pull-right inline" id="enable<?=$member_profile_id?>">
								<small class="muted"></small>
									<input type="checkbox" name="status"  id="status<?=$member_profile_id?>" class="ace ace-switch ace-switch-4 status-buttons" 
									<?php if($member_status  == 1) echo 'checked';?>  value=1>
								<span class="lbl middle"></span>								</label>
								</span>						</td>
						<td> 
										<div class="hidden-sm hidden-xs action-buttons">
													<a class="blue" href="<?php echo $url_preview ?>" target=_blank>
															<i class="ace-icon fa fa-search-plus bigger-130"></i>													</a>

													<a class="green" href="<?=$lnk_member?>">
															<i class="ace-icon fa fa-pencil bigger-130"></i>													</a>

													<a class="red del-confirm" href="javascript:void(0);" id="bootbox-confirm<?php echo $member_profile_id?>" data-value="<?php echo $member_profile_id?>" data-name="<?php echo $nickname." ".$full_name?>">
															<i class="ace-icon fa fa-trash-o bigger-130"></i>													</a>
													<!-- <button id="bootbox-confirm" class="btn btn-info">Confirm</button> -->
										</div>

										<div class="hidden-md hidden-lg">
													<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="<?php echo $url_preview ?>" class="tooltip-info" data-rel="tooltip" title="Preview" target=_blank>
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>																				</span>																			</a>																		</li>

																		<li>
																			<a href="<?php echo base_url('member/edit/'.$member_profile_id)?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>																				</span>																			</a>																		</li>

																		<li>
																			<a href="javascript:void(0);" id="bx-confirm<?=$member_profile_id?>" class="tooltip-error del-confirm" data-value="<?php echo $member_profile_id?>" data-name="<?php echo $nickname." ".$full_name?>" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>																				</span>																			</a>																		</li>
																	</ul>
										  </div>
						  </div>						</td>
		</tr>
<?php
					}
?>
	</tbody>
</table>

		</div><!-- PAGE CONTENT ENDS -->
<?php
	echo form_close();
?>
</div><!-- /.col -->

<script type="text/javascript">
jQuery(function($) {

		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'100%',
			maxHeight:'100%',
			onOpen:function(){
				$overflow = document.body.style.overflow;
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = $overflow;
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};
		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange'></i>");//let's add a custom loading icon

		$('#dataTables-member').dataTable();

		$('.status-buttons').on('click', function() {

				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);

				//alert('status-buttons ' + res);

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('member/status')?>/" + res,
					//data: {id: res},
					cache: false,
					success: function(data){
							$("#msg_info").fadeOut();
							if(data == 1){
								$("#msg_success").attr('style','display:block;');
								//AlertSuccess	('Active And Generate json file.');
								AlertSuccess	('Active.');
							}else{
								$("#msg_error").attr('style','display:block;');
								AlertError('Inactive');
							}
					}
				});
		});

		$('.del-confirm').on('click', function() {				
				var id = $(this).attr('data-value');
				var name = $(this).attr('data-name');
				bootbox.confirm("<?php echo $language['are you sure to delete']?> " + name, function(result) {
					if(result) {
							//alert('<?php echo base_url('news/delete')?>/' + id + '');
							window.location='<?php echo base_url('member/delete')?>/' + id ;
						}
				});
		});

})
</script>