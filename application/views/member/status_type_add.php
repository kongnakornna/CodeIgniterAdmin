<?php $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="category/save"> -->
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('status_type/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<?php echo $language['status_type'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php //echo $language['type_of_column'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['status_type'] ?></h3> -->
										<!-- <div class="table-header">
											<?php echo $language['status_type'] ?>
										</div> -->

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($status_type );
					//Debug($this->lang->language);
				}
?>
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
							
									<!-- #section:elements.form -->
									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status_type']?>(EN)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['status_type']?>" id="status_type_en" name="status_type_en">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status_type']?>(TH)</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['status_type']?>" id="status_type_th" name="status_type_th">
										</div>
									</div>

									<div class="form-group">
										<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status" id="cat_status" class="ace ace-switch" type="checkbox" value=1 checked />
														<span class="lbl"></span>
													</label>
												</div>
										</div>
									</div>

									<div style="clear: both;"></div>
									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-info">
												<i class="ace-icon fa fa-check bigger-110"></i>
												<?php echo $language['save']?>
											</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
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

<script type="text/javascript">
$( document ).ready(function() {
		console.log( "ready!" );

		$('#enable9').click(function( ) {
				alert($(this).attr('id'));
				/*$.ajax({
						url: "http://search.twitter.com/search.json",
						data: {
						q: query
						},
						dataType: "jsonp",
						success: defer.resolve,
						error: defer.reject
				});*/
		});
});

</script>