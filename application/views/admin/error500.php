<?php
			if (!$this->session->userdata('user_name')) {

			} else {
				$userinput = $this->session->userdata('user_name');
			}
?>
			<h1><?php //echo $headtxt; ?> </h1>

    
			
 <div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-random"></i>
												500											</span>
											Something Went Wrong										</h1>

										<hr />
										<h3 class="lighter smaller">
											But we are working
											<i class="ace-icon fa fa-wrench icon-animated-wrench bigger-125"></i>
											on it!										</h3>

										<div class="space"></div>

										<div>
											<h4 class="lighter smaller">Meanwhile, try one of the following:</h4>

											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Read the faq												</li>

												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													Give us more info on how this specific error occurred!												</li>
											</ul>
										</div>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="javascript:history.back()" class="btn btn-grey">
												<i class="ace-icon fa fa-arrow-left"></i>
												Go Back											</a>

											<a href="<?php echo base_url(); ?>" class="btn btn-primary">
												<i class="ace-icon fa fa-tachometer"></i>
												<?php echo $this->lang->line('dashboard');?>
												</a>										</div>
									</div>
								</div>

 

