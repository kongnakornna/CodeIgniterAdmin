<?php 
		$language = $this->lang->language;
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
											<div class="alert alert-danger">
												<button data-dismiss="alert" class="close" type="button">
													<i class="ace-icon fa fa-times"></i>
												</button>
												<strong>
													<i class="ace-icon fa fa-times"></i>
													Oh snap!</strong><?php echo $error?>.
												<br>
											</div>
<?php
			}
?>

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform', 'name' => 'vdoform');
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
			//Debug($vdo_list[0]->ref_url);
			//Debug($vdo_list[0]->embed);
			//Debug($vdo_list[0]->originalpic);
			//Debug($vdo_list[0]->thumpic);
?>			

	<div class="col-xs-12">
			<input type="hidden" name="record" value=2>
			<input type="hidden" name="category_id" value=<?php echo $category_id ?>>
<?php
			$now_date = date('Y-m-d');

			echo '<input type="hidden" name="video_id" value=0>';
			echo '<input type="hidden" name="video_id2" value=0>';
?>
			<!-- #section:elements.form -->
			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['subcategory']?></label>
							<div class="col-sm-9">
								<?php echo $subcategory_list?>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (EN) </label>
							<div class="col-sm-9">
								<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="title_en" name="title_en" maxlength="140">
								<div id="countitle"></div>
								<code><i class="menu-icon fa fa-info"></i> ไม่เกิน 140 ตัวอักษร</code>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['title']?> (TH) </label>
						<div class="col-sm-9">
								<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="title_th" name="title_th" maxlength="140">
								<button type="button" class="btn btn-sm btn-primary" id="add_vdo">
												<i class="ace-icon glyphicon glyphicon-plus"></i> Add to Server Cilp
								</button>
								<div id="countitle2"></div>
								<code><i class="menu-icon fa fa-info"></i> ไม่เกิน 140 ตัวอักษร</code>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Youtube </label>
						<div class="col-sm-9">
							<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="URL Youtube" id="youtube" name="youtube" maxlength="100">
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">SSTV ID </label>
						<div class="col-sm-9">
							<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="SSTV ID" id="sstv_id" name="sstv_id" maxlength="10" readonly>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">ref url </label>
						<div class="col-sm-9">
							<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="ref url" id="ref_url" name="ref_url" readonly>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Flv</label>
						<div class="col-sm-9">
							<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="Flv" id="flv" name="flv" readonly>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Mp4</label>
						<div class="col-sm-9">
							<input value="" type="text" class="col-xs-10 col-sm-6" placeholder="Mp4" id="mp4" name="mp4" readonly>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['highlight']?> </label>
						<div class="col-sm-9">
								<div class="checkbox">
									<label>
										<input type="checkbox" class="ace" name="highlight">
										<span class="lbl"> <?php echo $language['highlight']?></span>
									</label>
								</div>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right">Mega menu </label>
						<div class="col-sm-9">
								<div class="checkbox">
									<label>
										<input type="checkbox" class="ace" name="megamenu">
										<span class="lbl"> <?php echo $language['use']?></span>
									</label>
								</div>
						</div>
			</div>

			<div class="form-group">
						<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['dara']?></label>
						<div class="col-sm-3">
								<a href="<?php echo site_url('dara/add'); ?>" target=_blank>
									<i class="ace-icon glyphicon glyphicon-plus"></i><?php echo $language['add'].' '.$language['dara']?>
								</a>
						</div>
						<div class="col-sm-9">
								<select class="chosen-select" id="dara_id" name="dara_id">
<?php 
				echo '<option value=""> --- '.$language['please_select'].' --- </option>';
				$selected = '';
				$alllist = count($dara_list);
				if($dara_list)
						for($i = 0; $i < $alllist; $i++){
									
									$dara_name = $dara_list[$i]['nick_name'].' '.$dara_list[$i]['first_name'].' '.$dara_list[$i]['last_name'];
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
				$selected = '';
				$alllist = count($credit_list);
				if($credit_list)
						for($i = 0; $i < $alllist; $i++){
								$credit_name = $credit_list[$i]['credit_name'];
								echo '<option value="'.$credit_list[$i]['credit_id'].'" '.$selected.'>'.$credit_name.'</option>';
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
													<textarea cols="80" id="detail_en" name="detail_en" rows="10"></textarea>
													<?php echo display_ckeditor($detail_en); ?>
												</div>
										</div>
								</div>

								<!-- EDITOR 2 -->									
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right">
										<?php echo $language['detail']?> (TH) 
										</label>
										<div class="col-sm-9">
												<div id="fullToolbar">											
													<textarea cols="80" id="detail_th" name="detail_th" rows="10"></textarea>
													<?php echo display_ckeditor($detail_th); ?>
												</div>
										</div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"> <?php echo $language['search for tags news'] ?> </label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['title']?>" id="search_news1" maxlength="255">
											<button class="btn btn-purple btn-sm" type="button"><i class="ace-icon glyphicon glyphicon-search"></i></button>
										</div>
										<div class="col-sm-12" id="newslist_tags"></div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"> <?php echo $language['search for tags dara'] ?> </label>
										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-6" placeholder="<?php echo $language['dara']?>" id="search_dara" maxlength="255">
											<button class="btn btn-purple btn-sm" type="button"><i class="ace-icon glyphicon glyphicon-search"></i></button>
										</div>
										<div class="col-sm-12" id="daralist_tags"></div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status" id="vdo_status" class="ace ace-switch ace-switch-4" type="checkbox" value=1 />
														<span class="lbl"></span>
													</label>
										</div>
								</div>

								<!-- <div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['picture']?></label>

										<div class="col-xs-3">
													<a href="<?php //echo $pic_vdo ?>"><i class="menu-icon fa fa-picture-o"></i></a>
										</div>
								</div> -->
								<?php echo form_close();?>


									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info" id="submit_vdo" disabled><i class="ace-icon fa fa-floppy-o bigger-110"></i> Submit</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn" id="reset_vdo"><i class="ace-icon fa fa-undo bigger-110"></i>Reset</button>
										</div>
									</div>

							</div>
						<?php //echo form_close();?>
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

		$('#add_vdo').on('click', function(){
				//sstv_id
				//var idtvp = $(this).val();

				var subcategory_id = document.vdoform.subcategory_id.value;
				var title = document.vdoform.title_th.value;
				var youtube = document.vdoform.youtube.value;
				var idtvp = 0;

				if((subcategory_id == 11) || (subcategory_id == 15))
						idtvp = 98;
				else
						idtvp = 64;

				if(subcategory_id > 0 && title != ""){
						
						Waiting();
						if(youtube != ''){
								$.ajax({
										type: 'POST',
										url: "http://clip.siamdara.com/genXML/api/insert_clip.php",
										data: {idtvp : idtvp, title : title, youtube : youtube},
										dataType: "json",
										cache: false,
										success: function(data){												
												//console.log( data.header.code );
												//console.log( data.body.IDClipVDO );
												//console.log( data.body.Url );
												if(data.header.code == 200){
														$('#sstv_id').val(data.body.IDClipVDO);
														$('#ref_url').val(data.body.Url);
														$('#submit_vdo').removeAttr('disabled');
														AlertSuccess	('Insert to http://clip.siamdara.com success.');
												}
										}
								});
						}else{
								$.ajax({
										type: 'POST',
										url: "http://clip.siamdara.com/genXML/api/insert_clip.php",
										data: {idtvp : idtvp, title : title},
										dataType: "json",
										cache: false,
										success: function(data){
												if(data.header.code == 200){
														$('#sstv_id').val(data.body.IDClipVDO);
														$('#ref_url').val(data.body.Url);
														$('#flv').val(data.body.Flv);
														$('#mp4').val(data.body.Mp4);
														$('#submit_vdo').removeAttr('disabled');
														AlertSuccess	('Insert to http://clip.siamdara.com success.');
												}
										}
								});						
						}

				}else{
						alert('กรุณา กรอก <?php echo $language['title']?> และ เลือก <?php echo $language['subcategory']?>');
				}

		});		

		$('#submit_vdo').on('click', function() {
			document.getElementById("jform").submit();
		});		

		$('#reset_vdo').on('click', function() {
			document.getElementById("jform").reset();
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

});

</script>
