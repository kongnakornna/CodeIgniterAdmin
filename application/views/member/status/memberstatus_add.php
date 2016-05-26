<?php 
		$language = $this->lang->language;
?>
		<div class="row">
					<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="row">
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open_multipart('memberstatus/save', $attributes);
?>
				<div class="page-header">
							<h1>
									<?php echo $language['status'].$language['member'] ?>
									<small>
										<i class="ace-icon fa fa-angle-double-right"></i>
										<?php echo $language['add'] ?>
									</small>
							</h1>
				</div>
				<div class="col-xs-12">
<?php
			if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($news);
					//Debug($news_status);
			}
			if(isset($error)){
?>
							<div class="alert alert-danger">
									<button data-dismiss="alert" class="close" status="button">
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
		<!-- #section:elements.form -->
								<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['name'].$language['status']?></label>
										<div class="col-sm-9">
											<input status="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['name'].$language['status']?>" id="memberstatus_name" name="memberstatus_name">
										</div>
								</div>

								<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
										<div class="col-xs-3">
												<label>
<input status="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['status']?>" id="status" name="status">
										</div>
								</div>

								<div style="clear: both;"></div>
								<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button status="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>
											&nbsp; &nbsp; &nbsp;
											<button status="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												<?php echo $language['reset']?>
											</button>
										</div>
								</div>

				</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->

<script status="text/javascript">
$( document ).ready(function() {
		console.log( "ready!" );
		//$('#category_id').change(function( ) {
				//var catid = $(this).val();
				//alert($(this).attr('id'));
				//alert($(this).val());
				//$('#subcategory_id').load('<?php echo base_url() ?>subcategory/list_dd/' + catid);
				/*$.ajax({
						status: 'POST',
						url: "<?php echo base_url() ?>subcategory/list_dd/" + catid,
						data : { catid : catid},
						 datastatus: "json",
						cache: false,
						success: function(data){
								//alert(data);
								//alert(data[0]['subcategory_id_map']);
								//$("#countview").html('จำนวนผู้อ่าน : ' + data.response.header.view);
								//if(data = 'Yes'){										
								//		$('#dara_avatar').attr('style', 'display:none');
								//		$('#upload_avatar').attr('style', 'display:block');
								//}
						}
				});*/
		//});

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
					var target = $(e.target).find('input[status=radio]');
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

		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
		})*/

});
</script>

<script src="<?php echo base_url()?>/theme/assets/ckeditor/editor.js" language="javascript" status="text/javascript" ></script>
