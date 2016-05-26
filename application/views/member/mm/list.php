<?php 
		$language = $this->lang->language; 
		$i=0;
		$usedataTables = 1;
		$vdo_type_id = 0;
		$allvdo = count($vdo_list);
		//$maxcat = count($news_type);
		//die();
		//Debug($subcategory_id);
?>
<link rel="stylesheet" href="<?php echo site_url('ace-skins.min.css') ?>" />
<link rel="stylesheet" href="<?php echo site_url('ace-rtl.min.css') ?>" />
<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>

<div class="col-xs-12">

				<div class="col-xs-3">
						<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('vdo/add') ?>';">
								<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['vdo']  ?>
						</button> <?php echo $allvdo." of ".number_format($vdo_count)." record." ?>
				</div>
				<div class="col-xs-5">
				</div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('vdo', $attributes);
?>
				<div class="col-xs-3">
				<?php echo $subcategory_list ?>

				</div>
				<div class="col-xs-1">
						<button class="btn btn-sm btn-primary" type="submit">
								<i class="ace-icon align-top bigger-125"></i><?php echo $language['search']  ?>
						</button>
<?php 
				/*$attributes = array('class' => 'form-horizontal', 'id' => 'catform');
				echo form_open('vdo', $attributes);
				echo $vdo_type_list;
				echo form_close();*/
?>
				</div>
</div>
<?php
	echo form_close();
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
<?php
	//Debug($vdo_list);
	//Debug($vdo_type_list);

	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('vdo', $attributes);
?>									
											<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-vdo">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th width="7%"><?php echo $language['no'] ?></th>
														<th width="6%"><?php echo $language['picture'] ?></th>
														<th width="25%"><?php echo $language['title'] ?></th>
														<th width="6%">ID</th>
														<th width="10%">  SSTV</th>
														<th width="10%">Category</th>
														<th width="7%">HL & MG</th>
														<!-- <th><?php //echo $language['picture'] ?></th> -->
														<th width="4%" class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>														</th>
														<th width="4%" class="hidden-480"><?php echo $language['status'] ?></th>
														<th width="4%" class="hidden-480"><?php echo $language['approve'] ?></th>
														<th width="17%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>
	<tbody>												
<?php
			$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$thumb = '';
			$category_id = 5;
			
			if($vdo_list)
					for($i=0;$i<$allvdo;$i++){
								
								//$pic = ($vdo_list[$i]['avatar'] == '') ? 'theme/assets/avatars/avatar3.png' : 'uploads/vdo/'.$vdo_list[$i]['avatar'];
								//$thumb = $pic;
								$vdo_id = $vdo_list[$i]->video_id;
								$vdo_id2 = $vdo_list[$i]->video_id2;

								$sstv_id = $vdo_list[$i]->sstv_id;
								$title = $vdo_list[$i]->title_name;
								$ref_url = $vdo_list[$i]->ref_url;
								$originalpic = $vdo_list[$i]->originalpic;
								$thumpic = $vdo_list[$i]->thumpic;
								$embed = $vdo_list[$i]->embed;
								$countclick = $vdo_list[$i]->countclick;
								$order_by = $vdo_list[$i]->order_by;
								$create_date = $vdo_list[$i]->create_date;
								$create_by = $vdo_list[$i]->create_by;
								$status = $vdo_list[$i]->status;
								$approve = $vdo_list[$i]->approve;

								$subcategory_id = $vdo_list[$i]->subcategory_id;
								$subcategory_name = $vdo_list[$i]->subcategory_name;

								$file_name = $vdo_list[$i]->file_name;
								$folder = $vdo_list[$i]->folder;

								$thumb = "./uploads/thumb/".$folder."/".$file_name;

								$news_highlight_id = $vdo_list[$i]->news_highlight_id;
								$megamenu_id = $vdo_list[$i]->megamenu_id;

								if($folder != '' && $file_name != '') 
									$show_img = '<img src="'.$thumb.'" width="100" height="57">';
								else{
									if($thumpic != '') 
										$show_img = '<img src="'.$thumpic.'" width="100" height="57">';
									else
										$show_img = '';
								}

								/*if($vdo_list[$i]['file_name'] != ''){
										$thumb_img = base_url('uploads/thumb/').'/'.$vdo_list[$i]['folder'].'/'.$vdo_list[$i]['file_name'];
										$show_img = '<img src="'.$thumb_img.'" width="100" height="57">';
								}else
										$show_img  = '';*/

								$highlight = ($news_highlight_id > 0) ? '<i class="ace-icon fa fa-asterisk" data-rel="tooltip" style="color:#ffcc33;" title="Highlight"></i>' : ''; 
								$megamenu = ($megamenu_id > 0) ? '<i class="ace-icon glyphicon glyphicon-picture" data-rel="tooltip" style="color:#ff9900;" title="Mega menu"></i>' : '';

								$edit_vdo = site_url('vdo/edit/'.$vdo_id2);
								$pic_vdo = site_url('vdo/picture/'.$vdo_id2);
								$previewurl = $this->config->config['www']."/clip/".$category_id."/".$subcategory_id."/".$vdo_id2."?preview=1";
?>
		<tr>
						<td><?=$order_by?></td>
						<td><a href="<?php echo $edit_vdo ?>"><?=$show_img?></a></td>
						<td><a href="<?php echo $edit_vdo ?>"><?=$title?></a></td>
						<td><?=$vdo_id2?><input type="hidden" class="ace" name="selectid[]" value="<?php echo $vdo_id2?>" /></td>
						<td><?=$sstv_id?></td>
						<td><?=$subcategory_name?></td>
						<td><?php echo $highlight.' '.$megamenu?></td>
						<!-- <td class="center"><a href="<?php //echo $pic_vdo ?>"><i class="menu-icon fa fa-picture-o"></i></a></td> -->
						<td class="hidden-480"><?php echo RenDateTime($create_date)?></td>
						<td class="hidden-480"><span class="col-sm-6">
								<label class="pull-right inline" id="enable<?php echo $vdo_id2?>">
								<small class="muted"></small>
									<input type="checkbox" id="status<?=$vdo_id2?>" class="ace ace-switch ace-switch-4 status-buttons" data-value="<?=$vdo_id2?>"
									<?php if($status  == 1) echo 'checked';?>  value=1>
								<span class="lbl middle"></span>								</label>
								</span>						</td>
						<td class="hidden-480"><span class="col-sm-6">
								<label class="pull-right inline" id="enable<?php echo $vdo_id2?>">
								<small class="muted"></small>
									<input type="checkbox" id="approve<?=$vdo_id2?>" class="ace ace-switch ace-switch-7 approve-buttons" data-value="<?=$vdo_id2?>"
									<?php if($approve  == 1) echo 'checked';?>  value=1 <?php if($this->session->userdata('admin_type') > 3) echo 'disabled' ?>>
								<span class="lbl middle"></span>								</label>
								</span>						</td>
						<td>

												<div class="hidden-sm hidden-xs action-buttons">
																<a class="blue" href="<?php echo $previewurl ?>" data-rel="tooltip" title="Preview" target=_blank>
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>																</a>
																<a href="<?php echo $pic_vdo ?>" data-rel="tooltip" title="Picture">
																	<i class="menu-icon fa fa-picture-o"></i>																</a>
																<a class="green" href="<?php echo $edit_vdo ?>" data-rel="tooltip" title="Edit">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>																</a>
																<a class="red del-confirm" href="javascript:void(0);" id="bootbox-confirm<?php echo $vdo_id2?>" data-value="<?php echo $vdo_id2?>" data-name="<?=$title?>" data-cat="<?php echo $subcategory_id?>" data-rel="tooltip" title="Delete">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>																</a>
																<!-- <button id="bootbox-confirm" class="btn btn-info">Confirm</button> -->
												</div>

															<div class="hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="<?php echo $previewurl ?>" class="tooltip-info" data-rel="tooltip" title="Preview" target=_blank>
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>																				</span>																			</a>																		</li>

																		<li>
																			<a href="<?php echo $pic_vdo ?>" class="tooltip-info" data-rel="tooltip" title="Picture">
																				<span class="blue">
																					<i class="ace-icon fa fa-picture-o bigger-120"></i>																				</span>																			</a>																		</li>

																		<li>
																			<a href="<?php echo $edit_vdo ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>																				</span>																			</a>																		</li>

																		<li>
																			<a href="javascript:void(0);" id="bx-confirm<?php echo $vdo_id2?>" class="tooltip-error del-confirm" data-rel="tooltip" data-value="<?php echo $vdo_id2?>" data-cat="<?php echo $subcategory_id?>" title="Delete">
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
<?php
	echo form_close();
?>

									<!-- <button class="btn btn-info" id="bootbox-confirm">Confirm</button> -->
									<!-- <button class="btn btn-primary" id="gritter-center">Center</button> -->
</div><!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->

<script type="text/javascript">
$( document ).ready(function() {

		/*$('#vdo_type_id').on('change', function() {
				document.getElementById("catform").submit();
		});*/

		$('.status-buttons').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);
				var vdoid = $(this).attr('data-value');

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('vdo/status')?>/" + vdoid,
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

		$('.approve-buttons').on('click', function() {

				var id = $(this).attr('id');
				var n = id.length;
				var maxstr = n-6;
				var res = id.substr(6, maxstr);
				var vdoid = $(this).attr('data-value');

<?php
				if($this->session->userdata('admin_type') <= 3){	
?>
						$.ajax({
							type: 'POST',
							url: "<?php echo base_url('vdo/approve')?>/" + vdoid,
							cache: false,
							success: function(data){
									//alert(data);
									if(data == 0){
										$("#msg_error").attr('style','display:block;');
										AlertError('Not approve');
									}else{
										$("#msg_success").attr('style','display:block;');
										AlertSuccess	('Approve');
									}
							}
						});
<?php
				}else AlertError('Can not Approve');
?>				
		});

		$('.del-confirm').on('click', function() {
				var id = $(this).attr('data-value');
				var subcatid = $(this).attr('data-cat');
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							alert('<?php echo base_url('vdo/delete')?>/' + id + '?subcatid=' + subcatid);
							//window.location='<?php echo base_url('vdo/delete')?>/' + id + '?subcatid=' + subcatid;
						}
				});
		});

		$('#saveorder').on('click', function() {
				document.getElementById("jform").submit();
		});		

		<?php if($usedataTables == 1){ ?> $('#dataTables-vdo').dataTable(); <?php } ?>
});
</script>

<?php //echo js_asset('checkall.js'); ?>
