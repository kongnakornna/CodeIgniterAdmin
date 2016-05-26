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
									<!-- (single &amp; multiple) -->content
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<div class="row">
									<?php
											Debug(json_decode($view_content));
									?>
								</div>

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->

</div><!-- /.col -->
