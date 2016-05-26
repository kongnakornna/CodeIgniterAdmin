<?php
			if (!$this->session->userdata('user_name')) {

			} else {
				$userinput = $this->session->userdata('user_name');
			}
?>
			<h1><?php //echo $headtxt; ?> </h1>
					<!-- /section:settings.box -->
					<div class="page-content-area">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- #section:pages/error -->
								<div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-sitemap"></i>
												<?php echo $this->lang->line('error');?> 404
											</span>
											<br>
											<?php echo $this->lang->line('informationinvalid');?>
										</h1>
										<hr />
										<h3 class="lighter smaller"><?php echo $this->lang->line('notdata');?></h3>
										<div>
											<div class="space"></div>
											<h4 class="smaller"><?php echo $this->lang->line('remark');?></h4>
											<ul class="list-unstyled spaced inline bigger-110 margin-15">
											     <li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													<?php echo $this->lang->line('undersystem');?> 
												</li>
												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													<?php echo $this->lang->line('or');?> <?php echo $this->lang->line('notvalidated');?> 
												</li>
												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													<?php echo $this->lang->line('or');?> <?php echo $this->lang->line('loginerror');?>
												</li>
											</ul>
										</div>
										<hr />
										<div class="space"></div>
										<div class="center">
											<a href="javascript:history.back()" class="btn btn-grey">
												<i class="ace-icon fa fa-arrow-left"></i>
												<?php echo $this->lang->line('back');?>
											</a>
											<a href="<?php echo base_url(); ?>" class="btn btn-primary">
												<i class="ace-icon fa fa-tachometer"></i>
												<?php echo $this->lang->line('dashboard');?>
											</a>
										</div>
									</div>
								</div>
								<!-- /section:pages/error -->
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content-area -->
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->