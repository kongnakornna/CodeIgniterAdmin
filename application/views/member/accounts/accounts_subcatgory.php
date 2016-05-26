<?php 
	$language = $this->lang->language; 
	$i=0;
	$usedataTables = 1;
	$allnews = count($news_list);

	if(!isset($category_id)) $category_id = 0;
	if(!isset($listspage)) $listspage = 10;

	echo css_asset('font-awesome2.css');
	$iconpin = '<i class="icon-pushpin red"> %d </i>';

	//Debug($news_list);
	//Debug($category_id);
	//Debug($subcategory_id);
?>
<style type="text/css">
.col-sm-6 {width: 100%;text-align: center;	}
#saveorder{cursor:pointer;}
.input-small{text-align: center;}
</style>

<div class="col-xs-12">

				<div class="col-xs-4">
									<button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('news/add') ?>';">
											<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['news']  ?>
									</button> <?php echo $allnews." of ".number_format($totalnews)." record." ?>
				</div>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'filterjform');
	echo form_open('news', $attributes);
?>
								<div class="col-xs-3">
									<?php echo $category_list?>
								</div>
								<div class="col-xs-2">
									<select class="form-control" id="subcategory_id" name="subcategory_id"></select>
								</div>
								<div class="col-xs-2">
									<?php if($usedataTables == 0) echo $listspage;?>
								</div>
								<div class="col-xs-1">
									<button class="btn btn-sm btn-primary" type="submit">
											<i class="ace-icon align-top bigger-125"></i><?php echo $language['search']  ?>
									</button>
								</div>
<?php
	echo form_close();
?>
</div>
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
<div class="col-xs-12">
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('news', $attributes);
?>
		<input type="hidden" name="category" value="<?php echo $category_id ?>">
											<table id="dataTables-news" class="table-responsive table table-striped table-bordered table-hover ">
												<thead>
													<tr>
														<!-- <th class="center">
															<label class="position-relative">
																<input type="checkbox" class="ace" id="checkall" />
																<span class="lbl"></span>
															</label>
														</th> -->
														<th>No.</th>
														<th>
															<?php echo @($language['order_by']) ? $language['order_by'] : 'Order by' ?>
															<?php if($category_id > 0){ ?>
																&nbsp;<?php if($category_id > 0){ ?><i class="ace-icon fa fa-floppy-o bigger-120 blue" id="saveorder" data-rel="tooltip" title="Save Order"></i><?php } ?>
															<?php } ?>
														</th>
														<th></th>
														<th width="25%"><?php echo $language['title'] ?></th>
														<th class="hidden-480">ID</th>
														<th class="hidden-480">Cat</th>
														<th class="hidden-480">SubCat</th>
														<th width="5%" class="hidden-480">HL & MG</th>
														<th class="hidden-480">
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															<?php echo $language['create_date'] ?>
														</th>
														<th><?php echo $language['status'] ?></th>
														<th><?php echo $language['approve'] ?></th>
														<th width="15%"><?php echo $language['action'] ?></th>
													</tr>
												</thead>
	<tbody>												
<?php
			$now_date = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
			$thumb = '';
			$list_page = 10;
			$number = 0;

			$datainput = $this->input->get();
			if(isset($datainput['p'])){
				$p = ($datainput['p'] > 0) ? $datainput['p'] : 1;
				if(isset($datainput['list_page'])) $list_page = ($datainput['list_page'] > 0) ? $datainput['list_page'] : 10;
				if($p > 1){
						$number = ($p-1)*$list_page;
				}
			}else{
				$number = 0;
				$p = 1;
			}

			if($news_list)
					for($i=0;$i<$allnews;$i++){
								
								//$pic = ($news_list[$i]['avatar'] == '') ? 'theme/assets/avatars/avatar3.png' : 'uploads/news/'.$news_list[$i]['avatar'];
								//$thumb = $pic;
								$number++;
								$news_id = $news_list[$i]['news_id'];
								$news_id2 = $news_list[$i]['news_id2'];
								$dara_id = $news_list[$i]['dara_id'];
								$category_iddb = $news_list[$i]['category_id'];
								$subcategory_iddb = $news_list[$i]['subcategory_id'];
								$category_name = $news_list[$i]['category_name'];
								$subcategory_name = $news_list[$i]['subcategory_name'];

								$title = $news_list[$i]['title'];
								$description = $news_list[$i]['description'];
								$create_date = $news_list[$i]['create_date'];
								$pin = $news_list[$i]['pin'];
								
								$news_status = $news_list[$i]['status'];
								$approve = $news_list[$i]['approve'];
								$order_by = $news_list[$i]['order_by'];

								$news_highlight_id = $news_list[$i]['news_highlight_id'];
								$megamenu_id = $news_list[$i]['megamenu_id'];

								$highlight = ($news_highlight_id > 0) ? '<i class="ace-icon fa fa-asterisk" data-rel="tooltip" style="color:#ffcc33;"></i>' : '';
								$megamenu = ($megamenu_id > 0) ? '<i class="ace-icon glyphicon glyphicon-picture" data-rel="tooltip" style="color:#ff9900;" title="Mega menu"></i>' : '';

								if($news_list[$i]['file_name'] != ''){
										if(file_exists('uploads/thumb/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'])){
											$thumb_img = base_url('uploads/thumb').'/'.$news_list[$i]['folder'].'/'.$news_list[$i]['file_name'];
											$show_img = '<img src="'.$thumb_img.'" width="100" height="57">';
										}else $show_img  = '';
								}else
										$show_img  = '';

								$edit_news = site_url('news/edit/'.$news_id2);
								$pic_news = site_url('news/picture/'.$news_id2);


				$category_name = RewriteTitle($category_name);
				$subcategory_name = RewriteTitle($subcategory_name);
				$titleUrl = RewriteTitle($title);
				//$previewurl = $this->config->config['www']."/news/".$category_iddb."/".$subcategory_iddb."/".$news_id2."/".$category_name."/".$subcategory_name."/".$titleUrl."?preview=1";
				$previewurl = $this->config->config['www']."/news/".$category_iddb."/".$subcategory_iddb."/".$news_id2."?preview=1";

?>
		<tr>
						<!-- <td class="center">
								<label class="position-relative">
										<input type="checkbox" class="ace" name="selectid[]" value="<?php echo $news_id2 ?>"/>
										<span class="lbl"></span>
								</label>
						</td> -->

						<td><?php echo intval($order_by)?></td>
						<td>								
							<input class="input-small" name="order[]" type="text" id="order_by" placeholder="Not null" value="<?php echo $order_by?>">
						</td>
						<td><a href="<?php echo $edit_news ?>"><?=$show_img ?></a> </td>
						<td><a href="<?php echo $edit_news ?>"><?=$title?> <?php if($pin > 0) echo sprintf($iconpin, $pin)?></a></td>
						<td class="hidden-480"><?=$news_id2?><input type="hidden" class="ace" name="selectid[]" value="<?php echo $news_id2?>" /></td>
						<td class="hidden-480"><?=$category_name?></td>
						<td class="hidden-480"><?=$subcategory_name?></td>
						<td><?php echo $highlight.' '.$megamenu ?></td>
						<td class="hidden-480"><?php echo RenDateTime($create_date)?></td>
						<td class="center">
							<label class="pull-right inline" id="enable<?php echo $news_id2?>">
								<small class="muted"></small>
								<input type="checkbox" name="status"  id="status<?=$news_id2?>" class="ace ace-switch ace-switch-4 status-buttons" 
								<?php if($news_status  == 1) echo 'checked';?>  value=1>
								<span class="lbl middle"></span>
							</label>
						</td>
						<td class="center">
									<label class="pull-right inline" id="adminapprove<?php echo $news_id2?>">
									<small class="muted"></small>
										<input type="checkbox" name="approve"  id="approve<?=$news_id2?>" class="ace ace-switch ace-switch-7 approve-buttons" 
										<?php if($approve  == 1) echo 'checked';?>  value=1 <?php if($this->session->userdata('admin_type') > 3) echo 'disabled' ?>>
									<span class="lbl middle"></span>
									</label>
						</td>
						<td>

												<div class="hidden-sm hidden-xs action-buttons">
																<a class="blue" href="<?php echo $previewurl ?>" data-rel="tooltip" title="Preview" target=_blank>
																	<i class="ace-icon fa fa-search-plus bigger-130" data-rel="tooltip" title="<?php echo $language['preview'] ?>"></i>
																</a> 

																<a href="<?php echo $pic_news ?>" data-rel="tooltip" title="Picture">
																<i class="menu-icon fa fa-picture-o tooltip-info" data-rel="tooltip" title="<?php echo $language['add_edit_picture'] ?>"></i></a>

																<a class="green" href="<?php echo $edit_news ?>" data-rel="tooltip" title="Edit">
																	<i class="ace-icon fa fa-pencil bigger-130" data-rel="tooltip" title="<?php echo $language['edit'] ?>"></i>
																</a>

																<!-- <a class="green" href="<?php echo $edit_news ?>">
																	<i class="ace-icon fa fa-pencil bigger-130" data-rel="tooltip" title="<?php echo $language['edit'] ?>"></i>
																</a> -->

																<a class="red del-confirm" href="javascript:void(0);" id="bootbox-confirm<?=$news_id2?>" data-value="<?=$news_id2?>" data-name="<?=$title?>" data-rel="tooltip" title="Delete">
																	<i class="ace-icon fa fa-trash-o bigger-130" data-rel="tooltip" title="<?php echo $language['delete'] ?>"></i>
																</a>
												</div>

												<div class="hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="<?php echo $previewurl ?>" class="tooltip-info" data-rel="tooltip" title="Preview" target=_blank>
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="<?php echo $pic_news ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-picture-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="<?php echo $edit_news ?>" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="javascript:void(0);" id="bx-confirm<?=$news_id2?>" class="tooltip-error del-confirm" data-value="<?=$news_id2?>" data-rel="tooltip" title="Delete">
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
<?php
					}
?>
	</tbody>
</table>
										<!-- <li>
											<a href="../assets/images/gallery/image-4.jpg" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="../assets/images/gallery/thumb-4.jpg" />
												<div class="tags">
													<span class="label-holder">
														<span class="label label-info arrowed">fountain</span>
													</span>

													<span class="label-holder">
														<span class="label label-danger">recreation</span>
													</span>

												</div>
											</a>

											<div class="tools tools-top">
												<a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a href="#">
													<i class="ace-icon fa fa-times red"></i>
												</a>
											</div>
										</li> -->
									</ul>

<?php
	
	if($usedataTables == 0) echo $GenPage ;
	$userdata = $this->session->all_userdata();
	//Debug($userdata);
	if(($userdata['admin_type'] == 1) || ($userdata['admin_id'] <= 3)){ 
			if($category_id > 0){
?>
		<a href="<?php echo base_url('news/auto_order/'.$category_id) ?>" target=_blank>
				<i class="ace-icon glyphicon glyphicon-align-left"> Auto Sort</i>
		</a>
<?php 
			}
	}
?>
								</div><!-- PAGE CONTENT ENDS -->

							</div><!-- /.col -->
<?php
	echo form_close();
?>

<script type="text/javascript">
$( document ).ready(function() {

		<?php if($usedataTables == 1){ ?> $('#dataTables-news').dataTable(); <?php } ?>

<?php
		if($category_id > 0){
?>
			$('#subcategory_id').load('<?php echo base_url() ?>subcategory/list_dd/' + <?php echo $category_id?> + '/' + <?php echo $subcategory_id?>);
<?php
		}
?>
		$('#category_id').change(function( ) {
				var catid = $(this).val();
				//alert('<?php echo base_url() ?>subcategory/list_dd/' + catid);
				$('#subcategory_id').load('<?php echo base_url() ?>subcategory/list_dd/' + catid);
				$('#category').val(catid);
		});

		$('.status-buttons').on('click', function() {
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-6;
			    var res = id.substr(6, maxstr);

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('news/status')?>/" + res,
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

		$('.approve-buttons').on('click', function() {
<?php
				if($this->session->userdata('admin_type') <= 3){	
?>
				var id = $(this).attr('id');
		    	var n = id.length;
			    var maxstr = n-7;
			    var res = id.substr(7, maxstr);
		    	var GenFile = 0;

				$("#msg_info").html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Please, wait...');
				$("#msg_info,#BG_overlay").fadeIn();

				$.ajax({
						type: 'POST',
						url: "<?php echo base_url('news/approve')?>/" + res,
						//data: {id: res},
						cache: false,
						success: function(data){
								if(data == 1){
									//$("#msg_info").html(data);
									//$("#msg_info").fadeIn();
									//$("#msg_error").fadeOut();
									GenFile = 1;
									$("#msg_success").attr('style','display:block;');
									AlertSuccess	('Approve.');
									//AlertSuccess	('Approve And Generate json file.');
								}else{
									GenFile = 0;
									$("#msg_error").attr('style','display:block;');
									AlertError('Not approve');
								}
						}
				});
<?php
				}else AlertError('Can not Approve');
?>
		});

		$('.del-confirm').on('click', function() {				
				var id = $(this).attr('data-value');
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							//alert('<?php echo base_url('news/delete')?>/' + id + '?cat=<?php echo $category_id ?>');
							window.location='<?php echo base_url('news/delete')?>/' + id + '?cat=<?php echo $category_id ?>' ;
						}
				});
		});

<?php
		/*if($news_list)
		for($i=0;$i<count($news_list);$i++){
				$news_id = $news_list[$i]["news_id2"];*/
?>

		/*$('#bootbox-confirm<?php //echo $news_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							//alert('del');
							window.location='<?php //echo base_url('news/delete/'.$news_list[$i]['news_id2'])?>?cat=<?php //echo $category_id ?>' ;
						}
				});
		});

		$('#bx-confirm<?php //echo $news_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
					if(result) {
							//alert('del');
							window.location='<?php //echo base_url('news/delete/'.$news_list[$i]['news_id2'])?>?cat=<?php //echo $category_id ?>' ;
					}
				});
		});*/

<?php
		//}	//for loop
?>
		$('#saveorder').on('click', function() {
				document.getElementById("jform").submit();
		});		
});
</script>

<?php //echo js_asset('checkall.js'); ?>
