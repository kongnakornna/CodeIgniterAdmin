<?php 
		$language = $this->lang->language;
		$title_name_en = $title_name_th = '';
		$category_id = 5;
		//Debug($get_relate);
?>
<style type="text/css">
.fa-picture-o{font-size: x-large;}
#countitle, #countitle2 {style="margin-left: 4px; color: rgb(83, 95, 222);"}
</style>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
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
			<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open_multipart('vdo/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<?php echo $language['vdo'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'] ?>
											</small>
										</h1>
									</div>
								
<?php
			if(function_exists('Debug')){
				//Debug($vdo_list);
			}
			$title_name_en = StripTxt($vdo_list[0]->title_name);
			if(count($vdo_list) > 1){ $title_name_th = StripTxt($vdo_list[1]->title_name); }
?>			
									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-1 col-md-12 col-sm-12">

											<button type="button" class="btn btn-purple preview" id="preview1">
												<i class="ace-icon fa fa-search-plus bigger-110"></i> Preview
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		if($vdo_list[0]->approve == 0){
				$approve = 0;
?>
											<button type="button" class="btn btn-success admin_approve" data-value="<?php echo $vdo_list[0]->video_id2 ?>">
												<i class="ace-icon fa fa-check bigger-110"></i> Approve
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		}else{
				$approve = 1;
?>
											<button type="button" class="btn" disabled>
												<i class="ace-icon fa fa-check bigger-110"></i> Approved
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		}
?>
											<button type="submit" class="btn btn-info submit_vdo" id="submit_vdo1">
												<i class="ace-icon fa fa-floppy-o bigger-110"></i> Submit
											</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn reset_vdo" id="reset_vdo">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
								&nbsp; &nbsp; &nbsp;
								<button type="button" class="btn btn-success gen_json" id="gen_json1" <?php if($approve == 0) echo "disabled" ?>>
									<i class="ace-icon glyphicon glyphicon-file bigger-110"></i> Generate Json file
								</button>
<?php
		if($vdo_list[0]->approve == 0){
?>
											&nbsp; &nbsp; &nbsp;
											<button type="button" class="btn btn-pink sentmail" data-value="<?php echo $vdo_list[0]->video_id2 ?>">
												<i class="ace-icon fa fa-envelope bigger-110"></i> Sent mail to manager
											</button>
<?php
		}
?>
										</div>
									</div>

			<div class="col-xs-12">
<?php
			$now_date = date('Y-m-d');
			$news_highlight_id = $vdo_list[0]->news_highlight_id;
			$megamenu_id = $vdo_list[0]->megamenu_id;
			$subcategory_id = $vdo_list[0]->subcategory_id;

			echo '<input type="hidden" name="record" value="'.count($vdo_list).'">';
			echo '<input type="hidden" name="vdo_id" value="'.$vdo_list[0]->video_id2.'">';
			echo '<input type="hidden" name="vdo_id_en" value="'.$vdo_list[0]->video_id.'">';
			if(count($vdo_list) > 1) echo '<input type="hidden" name="vdo_id_th" value="'.$vdo_list[1]->video_id.'">';
			
			//Debug($vdo_list);
			$pic_vdo = site_url('vdo/picture/'.$vdo_list[0]->video_id2);
			//$pic_edit = site_url('vdo/picture/'.$vdo_list[0]->video_id2);
			$previewurl = $this->config->config['www']."/clip/".$category_id."/".$subcategory_id."/".$vdo_list[0]->video_id2."?preview=1";

?>
			<input type="hidden" name="category_id" value=<?php echo $category_id ?>>

			<!-- #section:elements.form -->
			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory']?></label>
							<div class="col-sm-9">
								<?php echo $subcategory_list?>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['preview']?> </label>
						<div class="col-sm-9">
								<?php if($vdo_list[0]->embed){ ?>
								<iframe allowfullscreen webkitallowfullscreen mozallowfullscreen  src="<?php echo $vdo_list[0]->embed ?>&w=500&h=400" width="500" height="400" scrolling="no" frameborder="0"></iframe>
								<?php } ?>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (EN) </label>
							<div class="col-sm-9">
								<input value="<?php echo $title_name_en?>" type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="title_en" name="title_en" maxlength="140">
								<div id="countitle"></div>
								<code><i class="menu-icon fa fa-info"></i> ไม่เกิน 140 ตัวอักษร</code>
						</div>
			</div>

<?php if(count($vdo_list) > 1){ ?>
			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (TH) </label>
								<div class="col-sm-9">
									<input value="<?php echo $title_name_th?>" type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="title_th" name="title_th" maxlength="140">
								<div id="countitle2"></div>
								<code><i class="menu-icon fa fa-info"></i> ไม่เกิน 140 ตัวอักษร</code>
								</div>
			</div>
<?php } ?>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Youtube </label>
										<div class="col-sm-9">
											<input value="<?php echo $vdo_list[0]->youtube?>" type="text" class="col-xs-10 col-sm-6" placeholder="URL Youtube" id="youtube" name="youtube" maxlength="100">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['highlight']?> </label>
										<div class="col-sm-9">												
												<div class="checkbox">
													<label>
														<input type="checkbox" class="ace" name="highlight" <?php if($news_highlight_id > 0) echo "checked='checked'" ?> >
														<span class="lbl"> <?php echo $language['use']?></span>
													</label>
												</div>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Mega menu</label>
										<div class="col-sm-9">												
												<div class="checkbox">
													<label>
														<input type="checkbox" class="ace" name="megamenu" <?php if($megamenu_id > 0) echo "checked='checked'" ?> >
														<span class="lbl"> <?php echo $language['use']?></span>
													</label>
												</div>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> URL </label>
										<div class="col-sm-9">
											<?php Debug($vdo_list[0]->ref_url); ?>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Flv </label>
										<div class="col-sm-9">
											<?php Debug($vdo_list[0]->flv); ?>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Mp4 </label>
										<div class="col-sm-9">
											<?php Debug($vdo_list[0]->mp4); ?>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"> Embed </label>
										<div class="col-sm-9">
											<?php Debug($vdo_list[0]->embed); ?>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['dara']?></label>
										<div class="col-sm-3">
											<a href="<?php echo site_url('dara/add'); ?>" target=_blank>
											<i class="ace-icon glyphicon glyphicon-plus"></i>
											<?php echo $language['add'].' '.$language['dara']?></a>
										</div>
										<div class="col-sm-9">
											<select class="chosen-select" id="dara_id" name="dara_id">
<?php 
				echo '<option value=""> --- '.$language['please_select'].' --- </option>';

				$alllist = count($dara_list);
				if($dara_list)
						for($i = 0; $i < $alllist; $i++){
									
								$dara_name = $dara_list[$i]['nick_name'].' '.$dara_list[$i]['first_name'].' '.$dara_list[$i]['last_name'];

								$selected = ($dara_list[$i]['dara_profile_id'] == $vdo_list[0]->dara_id) ? 'selected' : '';
								echo '<option value="'.$dara_list[$i]['dara_profile_id'].'" '.$selected.'>'.$dara_name.'</option>';
						}
?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['credit']?></label>
										<div class="col-sm-9">
											<select class="chosen-select" id="credit_id" name="credit_id">
<?php 
				echo '<option value=""> --- '.$language['please_select'].' --- </option>';

				$alllist = count($credit_list);
				if(isset($credit_list))
						for($i = 0; $i < $alllist; $i++){

									$credit_name = $credit_list[$i]['credit_name'];
									$credit_id = $credit_list[$i]['credit_id'];

									$selected = ($credit_id == $vdo_list[0]->credit_id) ? 'selected' : '';
									echo '<option value="'.$credit_id.'" '.$selected.'>'.$credit_name.'</option>';

						}
?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Keyword</label>
										<div class="col-sm-9">
											<?php echo $tags_list?>
										</div>
									</div>

								<!-- EDITOR 1 -->									
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">
										<?php echo $language['detail']?> (EN) 
										</label>
										<div class="col-sm-9">
												<div id="fullToolbar">											
													<textarea cols="80" id="detail_en" name="detail_en" rows="10"><?php echo $vdo_list[0]->detail?></textarea>
													<?php echo display_ckeditor($detail_en); ?>
												</div>
										</div>
								</div>

<?php if(count($vdo_list) > 1){ ?>
								<!-- EDITOR 2 -->									
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">
										<?php echo $language['detail']?> (TH) 
										</label>
										<div class="col-sm-9">
												<div id="fullToolbar">											
													<textarea cols="80" id="detail_th" name="detail_th" rows="10"><?php if(isset($vdo_list[1]->detail)) echo $vdo_list[1]->detail?></textarea>
													<?php echo display_ckeditor($detail_th); ?>
												</div>
										</div>
								</div>
<?php } ?>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"> <?php echo $language['search for tags news'] ?> </label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="search_news1" maxlength="100">
											<button class="btn btn-purple btn-sm" type="button"><i class="ace-icon glyphicon glyphicon-search"></i></button>
										</div>
										<div class="col-sm-12" id="newslist_tags"></div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"> <?php echo $language['search for tags dara'] ?> </label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['dara']?>" id="search_dara" maxlength="100">
											<button class="btn btn-purple btn-sm" type="button"><i class="ace-icon glyphicon glyphicon-search"></i></button>
										</div>
										<div class="col-sm-12" id="daralist_tags"></div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status" id="vdo_status" class="ace ace-switch ace-switch-4" type="checkbox" value=1 <?php if($vdo_list[0]->status == 1) echo "checked";?> />
														<span class="lbl"></span>
													</label>
										</div>
								</div>

<?php echo form_close();?>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['picture']?></label>

										<div class="col-xs-3">
													<a href="<?php echo $pic_vdo ?>"><i class="menu-icon fa fa-picture-o"></i></a>
										</div>
								</div>

									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-1 col-md-12 col-sm-12">

											<button type="button" class="btn btn-purple preview" id="preview">
												<i class="ace-icon fa fa-search-plus bigger-110"></i> Preview
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		if($vdo_list[0]->approve == 0){
?>
											<button type="button" class="btn btn-success admin_approve" id="admin_approve" data-value="<?php echo $vdo_list[0]->video_id2 ?>">
												<i class="ace-icon fa fa-check bigger-110"></i> Approve
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		}else{
?>
											<button type="button" class="btn" disabled>
												<i class="ace-icon fa fa-check bigger-110"></i> Approved
											</button>
											&nbsp; &nbsp; &nbsp;
<?php
		}
?>
											<button type="submit" class="btn btn-info submit_vdo" id="submit_vdo">
												<i class="ace-icon fa fa-floppy-o bigger-110"></i> Submit
											</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn reset_vdo" id="reset_vdo">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
								&nbsp; &nbsp; &nbsp;
								<button type="button" class="btn btn-success gen_json" id="gen_json1" <?php if($approve == 0) echo "disabled" ?>>
									<i class="ace-icon glyphicon glyphicon-file bigger-110"></i> Generate Json file
								</button>
<?php
		if($vdo_list[0]->approve == 0){
?>
											&nbsp; &nbsp; &nbsp;
											<button type="button" class="btn btn-pink sentmail" id="sentmail" data-value="<?php echo $vdo_list[0]->video_id2 ?>">
												<i class="ace-icon fa fa-envelope bigger-110"></i> Sent mail to manager
											</button>
<?php
		}
?>
										</div>
									</div>

							</div>
						<?php //echo form_close();?>
						</div>


<?php
//****************************************Relate*****************************************************
//Debug($get_relate);
?>
	<div style="clear: both;"></div>
	<div class="page-header">
				<h1><?php echo $language['vdo'] ?>
						<small><i class="ace-icon fa fa-angle-double-right"></i> Relate</small>
				</h1>
	</div>
<?php if(count($get_relate) > 0){ ?>
	<div class="alert alert-success" id="alertorder">
			<button data-dismiss="alert" class="close" type="button">
					<i class="ace-icon fa fa-times"></i>
			</button>
			<strong>
					<i class="ace-icon fa fa-check"></i>
			</strong><span id="msg">Init and Update</span>
	</div>
<?php } ?>
	<div class="form-group">
		<label for="form-relate" class="col-sm-3 control-label no-padding-right"><?php echo $language['relate']?></label>
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'Orderform');
	echo form_open_multipart('vdo/saveorder', $attributes);
	echo '<input type="hidden" name="vdo_id" value="'.$vdo_list[0]->video_id2.'">';

	//if(!isset($mobile)){
		//***********************************$relate_list*******************
		echo $emptyarr = '<pre id = "nestable-output"></pre>';

		$icondelall = '<button class="btn btn-danger btn-sm del-confirm" type="button" id="bx-del-relate-all" data-ref-value="'.$vdo_list[0]->video_id2.'" data-name="">
								<i class="ace-icon fa fa-trash-o bigger-110"> '.$language['del relate'].'</i>
							</button>';
		$icondel = '';
?>
								<div class="col-sm-2">
<?php
		$relate_list=$get_relate;
								if($relate_list){

										echo '<div style="width:100%;height:5px;"></div>';

										for($i=0;$i<count($relate_list);$i++){
												
												$running_number = $i+1;

												$newsrelate_id = $relate_list[$i]->video_id2;
												$title = $relate_list[$i]->title;
												$order = $relate_list[$i]->order;

												//if($i == 0) $relate_box .= $newsrelate_id;
												//else $relate_box .= ", ".$newsrelate_id;

												$icondel = '<a class="red del-confirm" href="javascript:void(0);" id="del-relate'.$newsrelate_id.'" data-value="'.$newsrelate_id.'" data-name="'.$title.'"><i class="ace-icon fa fa-trash-o bigger-130" data-rel="tooltip" title="'.$language['delete'].' '.$language['relate'].' '.$title.'"></i></a>';

												$relatenewsid = '<input type="hidden" name="relate_id[]" value="'.$newsrelate_id.'" class="col-xs-12" style="text-align: center;">';
												$textbox = '<input type="text" name="orderid[]" value="'.$running_number.'" class="col-xs-8" style="text-align: center;">';

												echo '<div id="widget'.$newsrelate_id.'" class="alert alert-info" style="width:100%;height:71px;margin: 1px 0px 5px 0px;" >'.$textbox.' '.$relatenewsid.' '.$icondel.'</div>';
										}
								}
?>
								</div>
								<div class="col-sm-7">
										<div class="dd" id="nestable">
											<ol class="dd-list" width="100%">
											<?php
												$sticker = '
														<span class="sticker">
															<span class="label label-success arrowed-in">
																<i class="ace-icon fa fa-check bigger-110"></i>
															</span>
														</span>';
												$showsticker = '';


												if($relate_list)
														for($i=0;$i<count($relate_list);$i++){

															$newsrelate_id = $relate_list[$i]->video_id2;
															$order = $relate_list[$i]->order;
															$title = DisplayTxt($relate_list[$i]->title, 60);
															$lastupdate_date = $relate_list[$i]->lastupdate_date;

															if($relate_list[$i]->file_name != ''){
																$img_src = base_url('uploads/thumb').'/'.$relate_list[$i]->folder.'/'.$relate_list[$i]->file_name;
																$display_img = (file_exists('uploads/thumb/'.$relate_list[$i]->folder.'/'.$relate_list[$i]->file_name)) ? "<img src=".$img_src."  width='90' height='50'>" : "";
																//$display_img = $relate_list[$i]->file_name;
																$css_tag = 'style="width:78%;"';
															}else{
																$display_img = '';
																$css_tag = 'style="width:78%;margin-left: 90px;"';
															}

															$icondel = '';
																			
															echo '
															<li class="dd-item" id="newsrelate'.$newsrelate_id.'" data-id="'.$newsrelate_id.'" value="'.$order.'" data="'.$order.'">
																<div class="dd-handle" style="width:78%" >
																		'.$display_img.'
																		<div class="tags" '.$css_tag.'>
																			<span class="label-holder"><span class="label label-warning arrowed-in">'.$title.' ID : '.$newsrelate_id.'</span></span><br>
																			<span class="label-holder"><span class="label">'.$language['lastupdate'].' '.$lastupdate_date.'</span></span>'.$showsticker.'
																		</div>
																</div>
																'.$icondel.'																
															</li>';
														}
											?>
											</ol>
											<!-- <button class="btn btn-info btn-sm" type="submit">
													<i class="ace-icon fa fa-floppy-o bigger-110"></i>
													<?php echo $language['save_relate']?>
											</button> -->
											<?php echo $icondelall?>

									</div>
							</div>
<?php //} ?>
<?php echo form_close();?>

					<div class="form-group">
							<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"> <?php echo $language['search for relate'] ?> </label>
							<div class="col-sm-8">
									<input type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="search_relate" data-value="<?php echo $vdo_list[0]->video_id2?>" maxlength="100">
									<button class="btn btn-purple btn-sm" type="button"><i class="ace-icon glyphicon glyphicon-search"></i></button>									
							</div>
							<div class="col-sm-12" id="list_relate"></div>
					</div>

		</div>
</div>


				<div class="col-sm-12">
						<div class="col-sm-4">

										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title"><?php echo $language['create_date']?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="row">
														<div class="col-sm-6">
															<ul>
																<li>
																<?php echo RenDateTime($vdo_list[0]->create_date)?>
																</li>
																<li>
																<?php if(isset($vdo_list[0]->create_by_name)) echo $vdo_list[0]->create_by_name?>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
					</div>

					<div class="col-sm-4">

										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title"><?php echo $language['lastupdate']?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="row">
														<div class="col-sm-6">
															<ul>
																<li>
																<?php echo RenDateTime($vdo_list[0]->lastupdate_date)?>
																</li>
																<li>
																<?php if(isset($vdo_list[0]->lastupdate_by_name)) echo $vdo_list[0]->lastupdate_by_name?>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
					</div>

					<div class="col-sm-4">
										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title"><?php echo $language['approve']?></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="row">
														<div class="col-sm-6">
														<?php if((isset($vdo_list[0]->approve_date)) && ($vdo_list[0]->approve_date != '')){?>
															<ul>
																<li>
																<?php if($vdo_list[0]->approve_date != '') echo RenDateTime($vdo_list[0]->approve_date)?>
																</li>
																<li>
																<?php if(isset($vdo_list[0]->approve_by_name)) echo $vdo_list[0]->approve_by_name?>
																</li>
															</ul>
														<?php } ?>
														</div>
													</div>
												</div>
											</div>
										</div>
						</div>
				</div>

<!-- view_log -->
<?php
if(isset($view_log)){
			//Debug($view_log);
			$alllogs = count($view_log);
?>
<div class="col-sm-12">
			<div style="min-height: 31px;" class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
										
									<div style="opacity: 1;" class="widget-box widget-color-orange ui-sortable-handle collapsed">
											<!-- #section:custom/widget-box.options.collapsed -->
											<div class="widget-header widget-header-small">
												<h6 class="widget-title">
													<i class="ace-icon fa fa-sort"></i>
													<?php echo $language['admin logs activity'] .' '.$alllogs.' record' ?>
												</h6>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
													</a>
													<a href="#" data-action="close">
														<i class="ace-icon fa fa-times"></i>
													</a>
												</div>
											</div>


											<div style="display: none;" class="widget-body">
												<div class="widget-main">
<?php
			echo '<table id="sample-table-1" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>'.$language['title'].'</th>
													<th>'.$language['action'].'</th>
													<th>'.$language['admin'].' '.$language['username'].'</th>
													<th>'.$language['create_date'].'</th>
												</tr>
											</thead>
											<tbody>';
				for($i=0;$i<$alllogs;$i++){
							
							$admin_log_id = $view_log[$i]->admin_log_id;
							//$ref_type = $view_log[$i]->ref_type;
							$ref_id = $view_log[$i]->ref_id;
							$ref_title = $view_log[$i]->ref_title;
							$action = action_view_logs($view_log[$i]->action);
							$admin_username = $view_log[$i]->admin_username;
							$create_date = RenDateTime($view_log[$i]->create_date);

							echo "<tr>
										<td>".$admin_log_id."</td>
										<td>".$ref_title."</td>
										<td>".$action."</td>
										<td>".$admin_username."</td>
										<td>".$create_date."</td>
							</tr>";				
				}

				echo '</tbody></table>';
}
?>
												</div>
											</div>
										</div>
										
									</div>
</div>
<!-- view_log -->

			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->

<script type="text/javascript">
$( document ).ready(function() {

		$('#title_en').on('keypress', function(e){
				var len = $(this).val().length;
				$('#countitle').html(len);
		});

		$('#title_th').on('keypress', function(e){
				var len = $(this).val().length;
				$('#countitle2').html(len);
		});

		$('.submit_vdo').on('click', function() {
			document.getElementById("jform").submit();
		});		

		$('.reset_vdo').on('click', function() {
			document.getElementById("jform").reset();
		});		

		$('.preview').on('click', function() {			
			//document.getElementById("jform").submit();
			//chkform();
			window.open('<?php echo $previewurl ?>');
		});	

		$('.sentmail').on('click', function(e){
				alert('Under Constrction.');
				/*$.ajax({
						type: 'POST',
						data: {id : <?php echo $vdo_list[0]->video_id2?>},
						url: "<?php echo base_url('dara/sentmail')?>",
						cache: false,
						success: function(data){
								AlertSuccess	(data);
						}
				});*/
		});

		$('.gen_json').on('click', function(e){

				alert('Under Constrction.');
				//window.open('http://daraapi.siamsport.co.th/api/rest.php?method=DetailClip&key=5AckEziE&lang=th&clip_id=<?php echo $vdo_list[0]->video_id2?>&gen_file=1');

				/*$('#gen_data').html('<iframe frameborder="0"scrolling="Yes" src="http://daraapi.siamsport.co.th/api/rest.php?method=DetailClip&amp;key=5AckEziE&amp;lang=th&amp;clip_id=<?php echo $vdo_list[0]->video_id2?>&amp;gen_file=1" width="100%" height=100px></iframe>');*/

				/*$.ajax({
						type: 'GET',
						url: "http://daraapi.siamsport.co.th/api/rest.php?method=DetailClip&key=5AckEziE&lang=th&clip_id=<?php echo $vdo_list[0]->video_id2?>&gen_file=1",
						success: function(data){
							alert(data);
							//$('#gen_data').html(data);
						}
				});*/
		});

		$('.del-confirm').on('click', function(e){
				var v = $(this).attr('data-value');
				var ref = $(this).attr('data-ref-value');
				var title = $(this).attr('data-name');
				if(v){
						bootbox.confirm("<?php echo $language['are you sure to delete']?> vdo " + title, function(result) {
							if(result) {
								//alert('del relate id ' + v);
								window.location='<?php echo base_url('vdo/delete_relate/'.$vdo_list[0]->video_id2)?>?picture_id=' + v;
							}
						});
				}else{
						bootbox.confirm("<?php echo $language['are you sure to delete']?>", function(result) {
							if(result) {
								//alert('del all relate ref_id ' + ref);
								window.location='<?php echo base_url('vdo/delete_relate/'.$vdo_list[0]->video_id2)?>?ref_id=' + ref;
							}
						});
				}
		});

		$('.admin_approve').on('click', function() {
<?php
			if($this->session->userdata('admin_type') <= 3){	
?>
				var id = $(this).attr('data-value');
				//alert(id);

				$("#msg_info").html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i> Please, wait...');
				$("#msg_info,#BG_overlay").fadeIn();

				$.ajax({
					type: 'POST',
					url: "<?php echo base_url('vdo/approve/'.$vdo_list[0]->video_id2)?>",
					//data: {id: id},
					cache: false,
					success: function(data){
							$("#msg_info").fadeOut();
							if(data == 0){
								$("#msg_error").attr('style','display:block;');
								AlertError('Not approve');
							}else{
								$("#msg_success").attr('style','display:block;');
								AlertSuccess	('Approve');
								$('.admin_approve').attr('disabled','disabled');
								$('.gen_json').removeAttr('disabled');
								$('.sentmail').attr('style','display:none;');
							}
					}
				});
<?php
			}else AlertError('Can not Approve');
?>
		});

		$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
		});

		$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
		})

		$('#picture').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
		}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
		});

		$('.chosen-select').chosen({allow_single_deselect:true}); 
				//resize the chosen on window resize
				$(window)
				.off('resize.chosen')
				.on('resize.chosen', function() {
					$('.chosen-select').each(function() {
						 var $this = $(this);
						 $this.next().css({'width': $this.parent().width()});
					})
		}).trigger('resize.chosen');
			
		$('#chosen-multiple-style').on('click', function(e){
					var target = $(e.target).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
					 else $('#form-field-select-4').removeClass('tag-input-style');
		});

		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
					$(this).find('.chosen-container').each(function(){
						$(this).find('a:first-child').css('width' , '210px');
						$(this).find('.chosen-drop').css('width' , '210px');
						$(this).find('.chosen-search input').css('width' , '200px');
					});
		})

		/*
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
		})*/

		$('#search_dara').on('change', function(e){

				var v = $(this).val();
				$('#daralist_tags').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>Loading...');
				$.ajax({
						type: 'GET',
						url: "<?php echo base_url('dara/search')?>",
						data: {kw : v},
						cache: false,
						success: function(data){
								$('#daralist_tags').html(data);

						}
				});
		});

		$('#search_news1').on('change', function(e){

				var v = $(this).val();
				$('#newslist_tags').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>Loading...');
				$.ajax({
						type: 'GET',
						url: "<?php echo base_url('news/search')?>",
						data: {kw : v},
						cache: false,
						success: function(data){

								$('#newslist_tags').html(data);

								//$('#newslist_tags').html($(this).val());
								//$("#alertorder").fadeIn();
								//$("#msg").html(data);

						}
				});
		});

		$('#search_relate').on('change', function(e){
				var v = $(this).val();
				var vdoid = $(this).attr('data-value');
				$('#list_relate').html('<i class="ace-icon fa fa-spinner fa-spin orange bigger-125"></i>Loading...');
				$.ajax({
						type: 'GET',
						url: "<?php echo base_url('vdo/search_relate')?>",
						data: {kw : v, vdoid : vdoid},
						cache: false,
						success: function(data){
								$('#list_relate').html(data);
						}
				});
		});

		var updateOutput = function(e){
				var list   = e.length ? e : $(e.target),
					output = list.data('output');
				if (window.JSON) {
					//output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
					output.html(window.JSON.stringify(list.nestable('serialize')));
					<?php if(count($relate_list) > 0){ ?>UpdateRelate(window.JSON.stringify(list.nestable('serialize')));<?php } ?>
				} else {
					output.html('JSON browser support required for this demo.');
					<?php if(count($relate_list) > 0){ ?>UpdateRelate(window.JSON.stringify(list.nestable('serialize')));<?php } ?>
				}
		};

		$('.dd').nestable({
			group: 1
		}).on('change', updateOutput);

		updateOutput($('.dd').data('output', $('#nestable-output')));

});

function UpdateRelate(json){
			//alert(json);
			$.ajax({
					type: 'POST',
					url: "<?php echo base_url('vdo/set_order_relate')?>",
					data: {json: json, videoid : <?php echo $vdo_list[0]->video_id2?>},
					cache: false,
					success: function(data){
							$("#alertorder").fadeIn();
							$("#msg").html(data);
					}
			});

			setTimeout(function(){
					$("#alertorder").fadeOut("slow", function () {});
			}, 3000);
}
</script>

<!-- <script src="<?php echo base_url()?>/theme/assets/ckeditor/editor.js" language="javascript" type="text/javascript" ></script> -->
