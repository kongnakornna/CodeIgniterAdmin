<?php 
$language = $this->lang->language; 
$pid = $this->uri->segment(3);  
$geo= $this->uri->segment(4); 
$countries_idc='206';
?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="amphur/save"> -->
<?php
	$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
	echo form_open('amphur/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<?php echo $language['amphur'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['type_of_column'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['amphur'] ?></h3> -->
										<!-- <div class="table-header">
											<?php echo $language['amphur'] ?>
										</div> -->

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
				if(function_exists('Debug')){
					//Debug($this->db) ;
					//Debug($amphur );
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
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['code']?></label>
<div class="col-sm-9">
<input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['code']?>" id="amphur_code" name="amphur_code">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['amphur']?>(TH)</label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['amphur']?>" id="amphur_th" name="amphur_th">
</div>
</div>

<div class="form-group">
<label for="form-field-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['amphur']?>(EN)</label>
<div class="col-sm-9"><input type="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['amphur']?>" id="amphur_en" name="amphur_en">
</div>
</div>
<input name="pid" type="hidden" id="pid" value="<?php echo $pid;?>">
<input name="geo" type="hidden" id="geo" value="<?php echo $geo;?>">
<input name="geo" type="hidden" id="countries_id" value="<?php echo $countries_idc;?>">
<div class="form-group">
		  <label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>

										<div class="col-xs-3">
													<label>
														<input name="status"  class="ace ace-switch ace-switch-4 btn-empty" type="checkbox"  value=1>
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
												Submit
											</button>
											&nbsp; &nbsp; &nbsp;
											<button type="reset" class="btn">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
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