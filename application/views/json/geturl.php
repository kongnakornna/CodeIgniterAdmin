<?php 
		$language = $this->lang->language; 
		$i=0;
?>
<div class="col-xs-12">

					<div class="page-content-area">
						<div class="page-header">
							<h1> JSON
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									<!-- (single &amp; multiple) -->Content
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									
									<?php
											if(!$view_content){

												$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
												echo form_open_multipart('json/geturl', $attributes);

												echo '<input type="text" class="col-xs-10 col-sm-6" placeholder="URL" id="url" name="url">';
												echo '<button type="submit" class="btn btn-info clear">
												<i class="ace-icon fa fa-check bigger-110"></i>Submit</button>';

												echo form_close();

											}else{
												echo "Json Content";
												Debug(json_decode($view_content));
											}
									?>
								</div>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->

</div><!-- /.col -->
