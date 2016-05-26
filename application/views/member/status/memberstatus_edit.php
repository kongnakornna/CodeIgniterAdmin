<?php 
        $userinput = $this->session->userdata('user_name');
		$user_id= $this->session->userdata('admin_id');
		$user_name =$userinput;
		$admin_type = $this->session->userdata('admin_type');
		$name = $this->session->userdata('name');
		$lastname = $this->session->userdata('lastname');
		$email = $this->session->userdata('email');
		$domain = $this->session->userdata('domain');
		$department = $this->session->userdata('department');
        $language = $this->lang->language; ?>

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<!-- <form role="form" class="form-horizontal" action="memberstatus/save"> -->
<?php
		$attributes = array('class' => 'form-horizontal', 'id' => 'jform');
		echo form_open('memberstatus/save', $attributes);
?>
									<div class="page-header">
										<h1>
											<?php echo $language['status'] ?>
											<small>
												<i class="ace-icon fa fa-angle-double-right"></i>
												<?php echo $language['edit'] ?>
											</small>
										</h1>
									</div>

									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue"><?php echo $language['member'] ?></h3> -->
										<!-- <div class="table-header">
											<?php echo $language['status'] ?>
										</div> -->

				<!-- <code><?php //echo $sql; ?></code> -->
<?php
			if(function_exists('Debug')){
				if($admin_type==1){Debug($memberstatus_arr);}
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
											<input status="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['status']?>" id="memberstatus_name" name="memberstatus_name" value="<?php echo $memberstatus_arr[0]->memberstatus_name ?>">
										</div>
									</div>

<div class="form-group">
											<label for="form-field-1-1" class="col-sm-3 control-label no-padding-right"><?php echo $language['status']?></label>
											<div class="col-xs-3">
												<label>
												 
 											
<input status="text" class="col-xs-10 col-sm-5" placeholder="<?php echo $language['status']?>" id="status" name="status" value="<?php echo $memberstatus_arr[0]->status ?>">
 													
												</label>
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
									<input type="hidden" name="memberstatus_id" value="<?php echo $memberstatus_arr[0]->memberstatus_id ?>">

								
							</div>
						<?php echo form_close();?>
						</div>
			<!-- PAGE CONTENT ENDS -->
			</div><!-- /.col -->
		</div><!-- /.row -->
