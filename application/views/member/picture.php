<?php 
		$language = $this->lang->language; 
		$i=0;
		//$maxcat = count($dara_type);
?>
<style type="text/css">
ul.ace-thumbnails li img{width: 250px; height: 170px;}
</style>
<!-- PAGE CONTENT BEGINS -->

<div class="col-xs-12">
		<!-- <button class="btn btn-sm btn-primary" onclick="window.location='<?php echo site_url('vdo/addpic') ?>';">
			<i class="ace-icon glyphicon glyphicon-plus align-top bigger-125"></i><?php echo $language['add'].' '.$language['picture']  ?>
		</button> -->
<?php
	list($create_date, $time) = explode(" ", $vdo_list[0]->create_date);
	$create_date = str_replace("-", "", $create_date);

	$title = $vdo_list[0]->title_name;
	$thumpic = $vdo_list[0]->thumpic;
	$originalpic = $vdo_list[0]->originalpic;

	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open_multipart('vdo/upload_pic', $attributes);
?>
								<!-- <div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['picture']?></label>
										<div class="col-sm-9">
											<div class="col-xs-12">

													<div id="upload_avatar"><input type="file" id="picture_vdo" name="picture_vdo[]" multiple /></div>
													<?php echo $language['upload_max_filesize'].' = '.ini_get('upload_max_filesize');?>

											</div>
										</div>
								</div>
								<input type="hidden" name="caption" value="<?php if($picture_list) echo $caption = $picture_list[0]['caption']?>">
								<input type="hidden" name="vdo_id" value="<?php echo $this->uri->segment(3)?>">
								<input type="hidden" name="create_date" value="<?php echo $create_date?>">

								<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">

											<a href="<?php echo base_url('vdo/edit/'.$this->uri->segment(3))?>"><button type="button" class="btn btn-primary"><i class="ace-icon fa fa-pencil align-top bigger-125"></i><?php echo $language['edit'] ?> <?php echo $language['vdo'] ?></button></a>
											&nbsp; &nbsp; &nbsp;

											<button type="submit" class="btn btn-info"><i class="ace-icon glyphicon glyphicon-upload bigger-110"></i>UPLOAD</button>
											&nbsp; &nbsp; &nbsp;

											<a href="<?php echo base_url('elvis/vdo/'.$this->uri->segment(3))?>"><button type="button" class="btn btn-info">
											<i class="ace-icon fa fa-cloud-download bigger-110"></i>Download From Elvis</button></a>&nbsp; &nbsp; &nbsp;

											<a href="<?php echo base_url('vdo/picture_order/'.$this->uri->segment(3))?>"><button type="button" class="btn btn-success"><i class="ace-icon glyphicon glyphicon-align-right"></i>Picture Order</button></a>


										</div>
								</div> -->
			<div>
<?php		
		if($originalpic != ''){
			//$encodeurl = urlencode($originalpic);
			$encodeurl = base64_encode($originalpic);
?>
		<div class="col-xs-12"><img src="<?php echo $originalpic?>" ></div>
		<div style="clear: both;"></div>
		<div class="clearfix form-actions form-group">
				<div class="col-sm-9">
						<div class="col-xs-12">
								<a href="<?php echo base_url('sstv/download/'.$this->uri->segment(3).'?url='.$encodeurl)?>"><button type="button" class="btn btn-warning">
									<i class="ace-icon fa fa-cloud-download bigger-110"></i>Download from clip.siamsport.com</button></a>&nbsp; &nbsp; &nbsp;

								<a href="<?php echo base_url('vdo/edit/'.$this->uri->segment(3))?>"><button type="button" class="btn btn-primary"><i class="ace-icon fa fa-pencil align-top bigger-125"></i><?php echo $language['edit'] ?> <?php echo $language['vdo'] ?></button></a>
											
						</div>
				</div>
		</div>
<?php		
		}
?>
			<span class=""><?php //if($picture_list) echo $caption = $picture_list[0]['caption'];?></span>
			<ul class="ace-thumbnails clearfix">
<?php
			Debug('ภาพประกอบวิดีโอ '.$title);
			//echo $create_date;
			//Debug($vdo_list);
			//Debug($picture_list);

			$allvdo = count($picture_list);
			if($picture_list)
					for($i=0;$i<$allvdo;$i++){
								
								$picture_id = $picture_list[$i]['picture_id'];
								$default = $picture_list[$i]['default'];
								//$file_name = $picture_list[$i]['file_name'];
								$caption = $picture_list[$i]['caption'];
								$folder = $picture_list[$i]['folder'];
								$status = ($picture_list[$i]['status'] == 1) ? '<span class="label label-success arrowed">Enable</span>' : '<span class="label label-danger">Disable</span>';

								$preview_file = 'uploads/vdo/'.$folder.'/'.$picture_list[$i]['file_name'];
								
								//$file_name = ($picture_list[$i]['file_name'] == '') ? 'uploads/vdo/'.$folder.'/'.$picture_list[$i]['file_name'] : 'uploads/thumb/'.$folder.'/'.$picture_list[$i]['file_name'];
								if($picture_list[$i]['file_name'] != ''){

										$file_name = 'uploads/thumb/'.$folder.'/'.$picture_list[$i]['file_name'];
										if(!file_exists($file_name)){
												$file_name = 'uploads/vdo/'.$folder.'/'.$picture_list[$i]['file_name'];
										}

								}else $file_name = 'theme/assets/images/gallery/no-img.jpg';
								
								$pic_del = base_url('vdo/picture_del/'.$picture_id)."?".$this->uri->segment(3);
								
								//$attr_width = 'width="150" height="150" alt="150x150"';
								//picture_edit/1?picture_id=179

								//$edit_thumb = base_url('vdo/picture_edit/'.$picture_id.'?vdo_id='.$this->uri->segment(3));
								$edit_thumb = base_url('vdo/picture_edit/'.$this->uri->segment(3).'?picture_id='.$picture_id);

?>
										<li>
											<a href="<?php echo base_url().$preview_file?>" data-rel="colorbox">
												<img src="<?php echo base_url().$file_name?>" />
												<div class="tags">
													<span class="label-holder">
														<?php echo $status?>
													</span>

													<span class="label-holder">
														<span class="label label-info arrowed"><?php echo $folder?></span>
													</span>

													<span class="label-holder">
														<span class="label label-danger"><?php echo $caption?></span>
													</span>
													<?php if($default == 1){ ?>
													<span class="label-holder">
														<span class="label label-warning arrowed-in"><?php echo $language['default']?></span>
													</span>
													<?php } ?>

												</div>
											</a>

											<div class="tools tools-top">
												<!-- <a href="#">
													<i class="ace-icon fa fa-link"></i>
												</a> -->
												<!-- <a href="#">
													<i class="ace-icon fa fa-paperclip"></i>
												</a> -->
												<a id="bootbox-confirmset<?=$picture_id?>" href="#" title="<?php echo $language['set_default']?>">
													<i class="ace-icon glyphicon glyphicon-bookmark"></i>
												</a>

												<a href="<?php echo $edit_thumb?>" title="<?php echo $language['edit'].' Thumb'?>">
													<i class="ace-icon fa fa-pencil"></i>
												</a>

												<a id="bootbox-confirm<?=$picture_id?>" href="javascript:void(0);<?php //echo $pic_del?>">
													<i class="ace-icon fa fa-times red" title="<?php echo $language['delete'].' '.$language['picture']?>"></i>
												</a>
											</div>
										</li>
<?php
					
					}
?>

			</ul>
	</div><!-- PAGE CONTENT ENDS -->
<?php echo form_close();?>
</div><!-- /.col -->

<?php
echo js_asset('jquery-ui.min.js'); 
echo js_asset('jquery.ui.touch-punch.min.js'); 
?>

<script type="text/javascript">
$( document ).ready(function() {
		console.log( "ready!" );
		$('#picture_vdo').ace_file_input({
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
<?php
			//Debug($picture_list);			
			$allvdo = count($picture_list);
			if($picture_list)
				for($i=0;$i<$allvdo;$i++){
						$picture_id = $picture_list[$i]['picture_id'];

						$pic_setdefault = base_url('vdo/set_default/?id='.$picture_id.'&ref_id='.$this->uri->segment(3));
						//$pic_del = base_url('vdo/picture_del/'.$picture_id.'?ref_id='.$this->uri->segment(3));
						$pic_del = base_url('vdo/picture_del/'.$picture_id)."?".$this->uri->segment(3);
?>
		$('#bootbox-confirmset<?=$picture_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to set default picture']?> ", function(result) {
						if(result) {
								//alert('del');
								window.location='<?php echo $pic_setdefault?>';
								/*$.ajax({
									type: 'POST',
									url: "<?php echo base_url('vdo/set_default')?>",
									data: {id: <?php echo $picture_id ?>, ref_id : <?php echo $this->uri->segment(3) ?>},
									cache: false,
									success: function(data){
											alert(data);
											$("#msg_info").fadeOut();
											if(data == 0){
												$("#msg_error").attr('style','display:block;');
												AlertError('Inactive');
											}else{
												$("#msg_success").attr('style','display:block;');
												AlertSuccess	('Active And Generate json file.');
											}
									}
								});*/
						}
				});
		});

		$('#bootbox-confirm<?=$picture_id?>').on('click', function() {
				bootbox.confirm("<?php echo $language['are you sure to delete']?> ", function(result) {
						if(result) {
								//alert('<?php echo $pic_del?>');
								window.location='<?php echo $pic_del?>';
						}
				});
		});

<?php
			}
?>

})
</script>	

